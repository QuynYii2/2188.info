<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend/pages/login');
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
            $request->session()->put('login', $isEmail);
        } else {
            $credentials = [
                'phone' => $loginField,
                'password' => $request->input('password'),
            ];
            $request->session()->put('login', $loginField);
        }

        if (Auth::attempt($credentials)) {
            if ($request->session()->has('login')) {
                $login = $request->session()->get('login');
                $dataUser = User::where(function ($query) use ($login, $isEmail) {
                    if ($isEmail) {
                        $query->where('email', $login);
                    } else {
                        $query->where('phone', $login);
                    }
                })->first();
                return view('frontend.layouts.master', ['infoUser' => $dataUser]);


            }
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
