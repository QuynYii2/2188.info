<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $googleUser = Socialite::driver('google')->stateless()->user();
            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                auth()->login($existingUser, true);
            } else {
                $newUser = new User;
                $newUser->provider_name = "google";
                $newUser->provider_id = $googleUser->getId();
                $newUser->name = $googleUser->getName();
                $newUser->email = $googleUser->getEmail();
                $newUser->phone = "social";
                $newUser->address = "social";
                $newUser->region = "social";
                $newUser->type_account = "social";
                $newUser->email_verified_at = now();
                $newUser->image = $googleUser->getAvatar();

                $newUser->save();
                auth()->login($newUser, true);
            }

            $request->session()->put('login', $googleUser);
            $login = $request->session()->get('login');
            (new HomeController())->getLocale($request);
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
