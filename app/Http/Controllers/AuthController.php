<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatus;
use App\Enums\PermissionUserStatus;
use App\Http\Controllers\Frontend\HomeController;
use App\Libraries\GeoIP;
use App\Models\Notification;
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
use function Symfony\Component\String\u;


class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        (new HomeController())->getLocale($request);
        if (Auth::check()) {
            // nếu đăng nhập thàng công thì
            return redirect()->route('home');
        } else {
            return view('frontend/pages/login');
        }
    }

    public function showLoginForm($locale)
    {
//        (new HomeController())->getLocale($request);
        app()->setLocale($locale);
        if (Auth::check()) {
            // nếu đăng nhập thàng công thì
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

        if (Auth::attempt($credentials)) {
            $request->session()->put('login', $loginField);
            $login = $request->session()->get('login');
//            $dataUser = User::where(function ($query) use ($login, $isEmail) {
//                if ($isEmail) {
//                    $query->where('email', $login);
//                } else {
//                    $query->where('phone', $login);
//                }
//            })->first();
            (new HomeController())->getLocale($request);
            //
//                return view('frontend.layouts.master', ['infoUser' => $dataUser]);
            return redirect()->route('home');


        }

        return redirect()->route('login')->with('error', 'Email hoặc mật khẩu không chính xác');
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
            $locale = $geoIp->get_country_from_ip('183.80.130.4');

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
                $newUser->type_account = "buyer";
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

    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('login');

        return redirect('/');
    }
}
