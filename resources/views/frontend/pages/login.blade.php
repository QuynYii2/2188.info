@extends('frontend.layouts.master')

@section('title', 'Login')
<style>
    .page-login {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        padding: 20px;
    }

    @media (max-width: 768px) {
        .page-login {
            width: 80%;
            margin: 0 auto;
        }
    }

    .login-title {
        font-size: 24px;
        font-weight: 600;
    }

    .login-element {
        font-size: 12px;
        font-weight: 400;
    }

    .text-password-forget {
        font-size: 16px;
        font-weight: 600;
    }

    #btnLogin {
        width: 240px;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
    }

    .btn-outline-main {
        padding: 12px 18px !important;;
        border: 1px solid #F47621 !important;
        margin: 8px;
    }

    .btn-outline-main:hover {
        background-color: #F47621;
        color: #fff;
    }

    .input_btn {
        background-color: #fff !important;
    }
</style>

@section('content')
    <div class="background-login">
        <div class="container p-5 ">
            <div class="page-login">
                <div class="bg bg-white p-4 rounded">
                    <div class="form-title text-center pt-2 mb-5 ">
                        <div class="title login-title">{{ __('home.sign in') }}</div>
                    </div>
                    <div class="login-form-main">
                        <div class="login-tags">
                            <form method="post" action="{{ route('login.submit') }}" id="formLogin">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail">{{ __('home.email') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend w-25">
                                            <div class="input-group-text input_btn full-width">{{ __('home.email') }}</div>
                                        </div>
                                        <input type="email" class="form-control" id="exampleInputEmail"
                                               name="login_field">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword">{{ __('home.Password') }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend w-25">
                                            <div class="input-group-text input_btn full-width">{{ __('home.Password') }}</div>
                                        </div>
                                        <input type="password" class="form-control" id="exampleInputPassword"
                                               name="password">
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <button type="submit" id="btnLogin"
                                            class="btn bg-main">{{ __('home.sign in') }}</button>
                                </div>
                                <div class="mt-3 text-no-account d-flex align-items-center justify-content-center">
                                    <a href="{{ route('register.show') }}"
                                       class="btn btn-outline-main">{{ __('home.sign up') }}</a>
                                    <a href="#" class="btn btn-outline-main">{{ __('home.Find password/id Login') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
