<?php

namespace App\Http\Controllers;

use App\Enums\CoinStatus;
use App\Enums\MemberRegisterInfoStatus;
use App\Enums\MemberRegisterPersonSourceStatus;
use App\Enums\MemberRegisterType;
use App\Enums\MemberStatus;
use App\Enums\PermissionUserStatus;
use App\Enums\RegisterMember;
use App\Enums\RegisterMemberPrice;
use App\Enums\UserStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Libraries\GeoIP;
use App\Models\Category;
use App\Models\Coin;
use App\Models\Member;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            //
//            $statisticAccess = StatisticAccess::where([
//                ['user_id', Auth::user()->id],
//                ['datetime', '<', Carbon::now()->addHours(7)->copy()->endOfDay()],
//                ['datetime', '>', Carbon::now()->addHours(7)->copy()->startOfDay()],
//                ['status', StatisticStatus::ACTIVE],
//            ])->first();
//
//            if ($statisticAccess) {
//                $statisticAccess->numbers = $statisticAccess->numbers + 1;
//                $statisticAccess->save();
//            } else {
//                $statisticRevenue = [
//                    'user_id' => Auth::user()->id,
//                    'numbers' => 1,
//                    'datetime' => Carbon::now()->addHours(7),
//                ];
//
//                StatisticAccess::create($statisticRevenue);
//            }
            // nếu đăng nhập thàng công thì
            return redirect()->route('home');
        } else {
            return view('frontend/pages/login');
        }
    }

    public function showLoginForm($locale)
    {
        app()->setLocale($locale);
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('frontend/pages/login');
        }
    }

    public function login(Request $request)
    {
        $loginField = $request->input('login_field');
        $isEmail = filter_var($loginField, FILTER_VALIDATE_EMAIL);

        if ($isEmail) {
            $credentials = [
                'email' => $loginField,
                'password' => $request->input('password'),
            ];
        } else {
            $credentials = [
                'phone' => $loginField,
                'password' => $request->input('password'),
            ];
        }

        $user = User::where($isEmail ? 'email' : 'phone', $loginField)->first();


        if ($user && $user->status !== UserStatus::ACTIVE) {
            toast('Tài khoản của bạn đã bị khóa.', 'error', 'top-right');
            return back();
        }

        $locale = $this->getLocale($request);
//        dd($locale, $user->region);

        if ($user) {
            $role_id = DB::table('role_user')->where('user_id', $user->id)->get();

            $isAdmin = false;
            foreach ($role_id as $item) {
                if ($item->role_id == 1) {
                    $isAdmin = true;
                }
            }

            if ($isAdmin == false) {
                if ($locale != 'en') {
                    if ($user->region != $locale) {
                        toast('Tài khoản của bạn không dành cho khu vực này. Vui lòng chọn khu vực khách phù hợp',
                            'error', 'top-right');
                        return back();
                    }
                }
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->put('login', $loginField);
            $login = $request->session()->get('login');
            $token = md5(uniqid());
            User::where('id', Auth::id())->update(['token' => $token]);

            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
            $isMember = null;
            if ($memberPerson) {
                $member = MemberRegisterInfo::where([
                    ['id', $memberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();
                if ($member) {
                    $isMember = true;
                }
//                dd($isMember, $member->member, RegisterMember::BUYER);
                if ($isMember && $member->member == RegisterMember::LOGISTIC) {
                    return redirect()->route('stand.register.member.index', ['id' => $member->id]);
                } elseif ($isMember && $member->member == RegisterMember::TRUST) {
                    return redirect()->route('trust.register.member.index');
                } else {
                    return redirect()->route('home');
                }
            }
        } else {
            toast('Tên đăng nhập hoặc mật khẩu không chính xác', 'error', 'top-right');
        }

        return back();
    }

    public function getGoogleSignInUrl()
    {
        try {
            $url = Socialite::driver('google')->stateless()
                ->redirect()->getTargetUrl();
            return redirect($url);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function loginCallback(Request $request)
    {
        try {
            $ipAddress = $request->ip();
            $geoIp = new GeoIP();
            $locale = 'kr';

            $googleUser = Socialite::driver('google')->stateless()->user();

            if ($googleUser->getEmail() == null || $googleUser->getName() == null) {
                return redirect()->route('login')->with('error', 'Error');
            }

            $existingUser = User::where('email', $googleUser->email)->first();

            $password = (new HomeController())->generateRandomString(8);
            $passwordHash = Hash::make($password);

            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                $newUser = new User;
                $newUser->provider_name = "google";
                $newUser->provider_id = $googleUser->getId();
                $newUser->name = $googleUser->getName();
                $newUser->email = $googleUser->getEmail();
                $newUser->phone = "null";
                $newUser->address = "null";
                $newUser->region = $locale;
                $newUser->password = $passwordHash;
                $newUser->type_account = "null";
                $newUser->email_verified_at = now();
                $newUser->image = $googleUser->getAvatar();

                $newUser->save();
                auth()->login($newUser, true);

                $defaultPermission1 = Permission::where('name', 'view_all_products')->first();
                $defaultPermission2 = Permission::where('name', 'view_profile')->first();

                $permissionUser1 = [
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now()->addHours(7),
                    'permission_id' => $defaultPermission1->id,
                    'status' => PermissionUserStatus::ACTIVE
                ];

                $permissionUser2 = [
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now()->addHours(7),
                    'permission_id' => $defaultPermission2->id,
                    'status' => PermissionUserStatus::ACTIVE
                ];

                DB::table('permission_user')->insert($permissionUser1);
                DB::table('permission_user')->insert($permissionUser2);

                $email = $googleUser->getEmail();
                $data = array('mail' => $email, 'name' => $email, 'password' => $password);

                Mail::send('frontend/widgets/mailWelcome', $data, function ($message) use ($email) {
                    $message->to($email, 'Welcome mail!')->subject
                    ('Welcome mail');
                    $message->from('supprot.ilvietnam@gmail.com', 'Support IL');
                });

                (new HomeController())->notifiCreate(Auth::user()->id, 'Đăng kí tài khoản thành công',
                    'Đăng kí tài khoản');
                (new HomeController())->notifiCreate(Auth::user()->id, 'Vui lòng cập nhập mật khẩu cho tài khoản',
                    'Đăng kí tài khoản');
            }

            $request->session()->put('login', $googleUser);
            $login = $request->session()->get('login');

            return redirect()->route('home');

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getListNation()
    {
        $listNation = DB::table('countries')->orderBy('continents')->orderBy('name')->get([
            'name',
            'iso2',
            'continents'
        ]);
        return response()->json($listNation);
    }

    public function getListRegionByNation($id)
    {
        $sql = "SELECT
    s.name,
    s.state_code,
    s.country_code,
    COUNT(c.city_code) AS total_child,
    CONCAT('[', GROUP_CONCAT(CONCAT('{\"name\":\"', c.name, '\",\"city_code\":\"', c.city_code, '\",\"state_code\":\"', c.state_code, '\"}')), ']') AS child
FROM
    states s
LEFT JOIN
    cities c ON s.state_code = c.state_code AND s.country_code = c.country_code
WHERE
    s.country_code =  :country_code GROUP BY
    s.name, s.state_code, s.country_code
ORDER BY
    s.name;
";
        $listState = DB::select($sql, ['country_code' => $id]);

        return response()->json($listState);
    }


    public function generateIso2($name, $table, $column)
    {
        //        Xóa dấu tiếng việt
        $name = $this->removeVietnameseAccents($name);

        // Lấy 2 ký tự đầu tiên của $name
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Tạo 2 ký tự ngẫu nhiên từ chuỗi
        $random_char1 = $characters[rand(0, strlen($characters) - 1)];
        $random_char2 = $characters[rand(0, strlen($characters) - 1)];

        // Tạo chuỗi 2 ký tự
        $random_string = $random_char1.$random_char2;

        // Kiểm tra xem $isoCode đã tồn tại trong bảng hay chưa
        $existingIsoCodes = DB::table($table)->pluck($column)->toArray();

        $index = 1;

        // Nếu $isoCode đã tồn tại, thay đổi $isoCode bằng ký tự 1 và 3 hoặc 1 và 4, ...
        while (in_array($isoCode, $existingIsoCodes)) {
            $isoCode = substr($name, 0, 1).substr($name, $index, 1);
            $index++;
        }

        return $isoCode;
    }

    public function generateIso3($name, $table, $column)
    {
        //        Xóa dấu tiếng việt
        $name = $this->removeVietnameseAccents($name);

        // Lấy 3 ký tự đầu tiên của $name
        $isoCode = substr($name, 0, 3);

        // Kiểm tra xem $isoCode đã tồn tại trong bảng hay chưa
        $existingIso3 = DB::table($table)->pluck($column)->toArray();

        $index = 1;

        // Nếu $isoCode đã tồn tại, thay đổi $isoCode bằng ký tự 1 và 3 hoặc 1 và 4, ...
        while (in_array($isoCode, $existingIso3)) {
            $isoCode = substr($isoCode, 0, 1).substr($isoCode, $index, 1);
            $index++;
        }

        return $isoCode;
    }

    public function removeVietnameseAccents($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return ($str);
    }

    public function createLocation(Request $request)
    {
        $request = $request->input();
        switch ($request['what_create']) {
            case "0":
                $this->createNation($request);
                return redirect(route('show.register.member.info', 16));
            case "1":
                $this->createProvince($request);
                break;
            case "2":
                $this->createDistrict($request);
                break;
            case "3":
                $this->createCommune($request);
                break;
        }
    }

    public function createNation($request)
    {
        $name = $request['nation-input'];
        $tableCheck = 'countries';
        $columnCheckIso2 = 'iso2';
        $columnCheckIso3 = 'iso3';
        $iso2 = $this->generateIso2($name, $tableCheck, $columnCheckIso2);
        $iso3 = $this->generateIso3($name, $tableCheck, $columnCheckIso3);
        DB::table('countries')->insert([
            'name' => $name,
            'iso2' => strtoupper(($iso2)),
            'iso3' => strtoupper(($iso3)),
            'continents' => $request['continents'],
        ]);
    }


    public function createProvince($request)
    {
        $country_id = $this->getIdFromCodeNation($request['nation-select']);
        dd($request);

    }

    public function createDistrict($request)
    {

    }

    public function createCommune($request)
    {

    }

    public function getIdFromCodeNation($code)
    {
        return DB::table('countries')->where('iso2', $code)->first('id');
    }

    public function getListStateByNation($id)
    {
        $listState = DB::table('states')
            ->where([['country_code', '=', $id]])
            ->get(['name', 'state_code', 'country_code']);
        return response()->json($listState);
    }

    public function getListCityByState($id, $code)
    {
        $listCity = DB::table('cities')
            ->where([['state_code', '=', $id], ['country_code', '=', $code]])
            ->orderBy('name')
            ->get(['name', 'city_code']);
        return response()->json($listCity);
    }

    public function getListWardByCity($id, $code)
    {
        $listWard = DB::table('wards')
            ->where([['city_code', '=', $id], ['country_code', '=', $code]])
            ->orderBy('name')
            ->get(['name', 'id']);
        return response()->json($listWard);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('login');

        return redirect('/');
    }

    private function getLocale(Request $request)
    {
        $ipAddress = $request->ip();
        $geoIp = new GeoIP();
        $locale = 'kr';
        if ($locale !== null && is_array($locale)) {
            $locale = $locale['countryCode'];
        }
        return $locale;
    }
}
