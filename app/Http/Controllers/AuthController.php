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
                        toast('Tài khoản của bạn không dành cho khu vực này. Vui lòng chọn khu vực khách phù hợp', 'error', 'top-right');
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
                dd($member->member, RegisterMember::BUYER);
                if ($isMember && $member->member != RegisterMember::BUYER) {
                    return redirect()->route('stand.register.member.index', ['id' => $member->id]);
                }
                else {
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

                (new HomeController())->notifiCreate(Auth::user()->id, 'Đăng kí tài khoản thành công', 'Đăng kí tài khoản');
                (new HomeController())->notifiCreate(Auth::user()->id, 'Vui lòng cập nhập mật khẩu cho tài khoản', 'Đăng kí tài khoản');
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
        $listNation = DB::table('countries')->get(['name', 'iso2']);
        return response()->json($listNation);
    }

    public function getListStateByNation($id)
    {
        $listState = DB::table('states')
            ->where([['country_code', '=', $id]])
            ->get(['name', 'state_code']);
        return response()->json($listState);
    }

    public function getListCityByState($id, $code)
    {
        $listCity = DB::table('cities')
            ->where([['state_code', '=', $id], ['country_code', '=', $code]])
            ->get(['name', 'city_code']);
        return response()->json($listCity);
    }

    public function getListWardByCity($id, $code)
    {
        $listWard = DB::table('wards')
            ->where([['city_code', '=', $id], ['country_code', '=', $code]])
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
