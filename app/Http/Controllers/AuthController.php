<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\HomeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        (new HomeController())->getLocale($request);
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


    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('login');

        return redirect('/');
    }
}
