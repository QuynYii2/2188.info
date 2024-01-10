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

    .text-no-account {
        font-size: 18px;
    }

    .text-no-account p {
        font-weight: 400;
    }

    .text-no-account a {
        font-weight: 600;
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
                                    <label for="exampleInputEmail1" class="login-element">{{ __('home.email') }}:</label>
                                    <input type="email" name="login_field" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword" class="login-element">{{ __('home.Password') }}:</label>
                                    <input type="password" name="password" class="form-control"
                                           id="exampleInputPassword">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="login-element">{{ __('home.Phone Number') }}:</label>
                                    <input type="number" name="phone" class="form-control" id="phone">
                                </div>
                                <div class="float-right">
                                    <a href="#" class="text-decoration-none text-password-forget">{{ __('home.Find password/id Login') }}</a>
                                </div>
                                <div class="text-center mt-5">
                                    <button type="submit" id="btnLogin" class="btn bg-main">{{ __('home.sign in') }}</button>
                                </div>
                                <div class="text-center mt-3 text-no-account">
                                    <p>Do not have an account?<span> <a class="text-main" href="{{ route('register.show') }}">{{ __('home.sign up') }}</a></span></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
