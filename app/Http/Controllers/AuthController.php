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
use App\Models\City;
use App\Models\Coin;
use App\Models\Member;
use App\Models\MemberRegisterInfo;
use App\Models\MemberRegisterPersonSource;
use App\Models\Permission;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
            return redirect()->route('homepage');
        } else {
            return view('frontend/pages/login');
        }
    }

    public function showLoginForm($locale)
    {
        app()->setLocale($locale);
        if (Auth::check()) {
            return redirect()->route('homepage');
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

        $locale = app()->getLocale();

        $isAdmin = false;
        if ($user) {
            $role_id = DB::table('role_user')->where('user_id', $user->id)->get();

            foreach ($role_id as $item) {
                if ($item->role_id == 1) {
                    $isAdmin = true;
                }
            }

        }

        if (Auth::attempt($credentials)) {
            $request->session()->put('login', $loginField);
            $login = $request->session()->get('login');
            $token = md5(uniqid());
            User::where('id', Auth::id())->update(['token' => $token]);

            $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();

            $memberLogistic = Member::where('name', RegisterMember::LOGISTIC)->first();
            $memberTrust = Member::where('name', RegisterMember::TRUST)->first();

            $isMember = null;
            if ($memberPerson) {
                $member = MemberRegisterInfo::where([
                    ['id', $memberPerson->member_id],
                    ['status', MemberRegisterInfoStatus::ACTIVE]
                ])->first();
                if ($member) {
                    $isMember = true;
                }

                if ($isAdmin == true) {
                    return redirect()->route('seller.products.home');
                }

                if ($isMember && $member->member_id == $memberLogistic->id) {
                    return redirect()->route('stand.register.member.index', ['id' => $member->id]);
                } elseif ($isMember && $member->member_id == $memberTrust->id) {
                    return redirect()->route('trust.register.member.index');
                } else {
                    return redirect()->route('homepage');
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

            return redirect()->route('homepage');

        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function getListNation()
    {
        $listNation = DB::table('countries')->where('isShow', '1')->orderBy('continents')->orderBy('name')->get([
            'name',
            'iso2',
            'continents'
        ]);
        return response()->json($listNation);
    }

    public function getListRegionByNation($id)
    {
        $states = State::where('country_code', $id)
            ->orderBy('name')
            ->cursor()
            ->map(function ($state) {
                $cities = City::where('state_code', $state->state_code)
                    ->where('country_code', $state->country_code)
                    ->get(['name', 'city_code', 'state_code']);

                return [
                    'name' => $state->name,
                    'state_code' => $state->state_code,
                    'country_code' => $state->country_code,
                    'total_child' => $cities->count(),
                    'child' => $cities->toArray(),
                ];
            });

        return $states;
    }


    public function generateIso2($table, $column)
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $maxAttempts = strlen($characters) * strlen($characters); // Số lần cố gắng tối đa

        for ($i = 0; $i < $maxAttempts; $i++) {
            $random_char1 = $characters[rand(0, strlen($characters) - 1)];
            $random_char2 = $characters[rand(0, strlen($characters) - 1)];
            $random_string = $random_char1 . $random_char2;

            // Kiểm tra xem $random_string đã tồn tại trong bảng hay chưa
            $existingIsoCodes = DB::table($table)->pluck($column)->toArray();

            // Nếu không tồn tại, trả về chuỗi ngẫu nhiên
            if (!in_array($random_string, $existingIsoCodes)) {
                return $random_string;
            }
        }

        return null;
    }

    public function generateIso3($table, $column)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $maxAttempts = strlen($characters) * strlen($characters) * strlen($characters);
        for ($i = 0; $i < $maxAttempts; $i++) {
            $random_char1 = $characters[rand(0, strlen($characters) - 1)];
            $random_char2 = $characters[rand(0, strlen($characters) - 1)];
            $random_char3 = $characters[rand(0, strlen($characters) - 1)];
            $random_string = $random_char1 . $random_char2 . $random_char3;

            $existingIsoCodes = DB::table($table)->pluck($column)->toArray();

            if (!in_array($random_string, $existingIsoCodes)) {
                return $random_string;
            }
        }

        return null;
    }


    public function createLocation(Request $request)
    {
        $request = $request->input();
        $id_reg = Cache::get('id-member-reg');

        switch ($request['what_create']) {
            case "0":
                $this->createNation($request);
                break;
            case "1":
                $this->createProvince($request);
                break;
            case "2":
                $this->createDistrict($request);
        }
        return back();
    }

    public function createNation($request)
    {
        $name = $request['nation-input'];
        $tableCheck = 'countries';
        $columnCheckIso2 = 'iso2';
        $columnCheckIso3 = 'iso3';
        $iso2 = $this->generateIso2($tableCheck, $columnCheckIso2);
        $iso3 = $this->generateIso3($tableCheck, $columnCheckIso3);
        DB::table('countries')->insert([
            'name' => $name,
            'iso2' => $iso2,
            'iso3' => $iso3,
            'continents' => $request['continents'],
        ]);
    }

    public function createProvince($request)
    {
        $province_name = $request['province-input'];

        if ($province_name) {
            $nation_id = $request['nation-select'];
            $countryIn4 = $this->getIn4FromCodeNation($nation_id);
            $tableCheck = 'states';
            $columnCheckIso2 = 'state_code';
            $iso2 = $this->generateIso2($tableCheck, $columnCheckIso2);
            DB::table('states')->insert([
                'name' => $province_name,
                'country_id' => $countryIn4->id,
                'country_name' => $countryIn4->name,
                'country_code' => $nation_id,
                'state_code' => $iso2
            ]);
        }
    }

    public function createDistrict($request)
    {
        $district_name = $request['district-input'];
        if ($district_name) {
            $province_id = $request['province-select'];
            $districtIn4 = $this->getIn4FromCodeProvince($province_id);
            $tableCheck = 'cities';
            $columnCheckIso2 = 'city_code';
            $iso2 = $this->generateIso2($tableCheck, $columnCheckIso2);
            DB::table($tableCheck)->insert([
                'name' => $district_name,
                'city_code' => $iso2,
                'state_id' => $districtIn4->id,
                'state_code' => $districtIn4->state_code,
                'state_name' => $districtIn4->name,
                'country_id' => $districtIn4->country_id,
                'country_code' => $districtIn4->country_code,
                'country_name' => $districtIn4->country_name,
            ]);
        }
    }

    public function createCommune($request)
    {

    }

    public function getIn4FromCodeNation($code)
    {
        return DB::table('countries')->where('iso2', $code)->first(['id', 'name']);
    }

    public function getIn4FromCodeProvince($code)
    {
        return DB::table('states')->where('state_code', $code)->first([
            'id',
            'name',
            'state_code',
            'country_id',
            'country_code',
            'country_name'
        ]);
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

    public function logout()
    {
        Auth::logout();
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
