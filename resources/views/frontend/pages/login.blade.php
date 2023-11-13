@extends('frontend.layouts.master')

@section('title', 'Login')

<style>
    .login-tags {
        display: inline-block;
        margin: auto;
    }

    .link-tabs {
        color: #cccccc;
        background-color: #f9f9f9 !important;
    }

    .link-tabs:hover {
        color: #c69500;
    !important;
        background-color: #f7f7f7;
    }

    #tableLogin th, #tableLogin td {
        vertical-align: middle !important;
    }
</style>
@section('content')
    <div class="background-login">
        <div class=" container p-5 ">
            <div class="row p-5">
                <div class="col-md-2">

                </div>
                <div class="col-md-8 bg bg-white p-4 rounded">
                    <div class="form-title text-center pt-2 mb-5 ">
                        <div class="title">{{ __('home.sign in') }}</div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-11 login-tags">
                            <form method="post" action="{{ route('login.submit') }}" id="formLogin"
                                  style="border: 3px solid rgb(241, 172, 139); padding: 20px;">
                                @csrf
                                <table class="table element-bordered-pink align-middle" align="center" id="tableLogin">
                                    <tbody>
                                    <tr class="text-center">
                                        <th scope="row" style="width: 160px;">
                                            <label for="login_email_1">{{ __('home.ID') }}: </label>
                                        </th>
                                        <td colspan="2">
                                            <input id="login_email_1" type="email" class="form-control"
                                                   name="login_field"
                                                   placeholder="{{ __('home.input username') }}"
                                                   value="{{ old('login_field') }}" autofocus>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table element-bordered-pink align-middle" align="center" id="tableLogin">
                                    <tbody>
                                    <tr class="text-center">
                                        <th scope="row" style="width: 160px;">
                                            <label for="login_password_1">{{ __('home.Password') }}: </label>
                                        </th>
                                        <td colspan="2">
                                            <input type="password" class="form-control" name="password"
                                                   id="login_password_1"
                                                   placeholder="{{ __('home.input password') }}">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <th scope="row" colspan="3" class="solid-4x-pink" style="width: 160px;">
                                    <button style="    width: 65%; position: relative; left: 36%; height: 75px"
                                            type="button" onclick="submitFormLogin()"
                                            class="btn btn-warning btn-block btn-round"
                                            style="height: 75px">{{ __('home.sign in') }}
                                    </button>
                                </th>
                            </form>
                            <table class="table element-bordered-pink align-middle" align="center">
                                <tbody>
                                <tr class="text-center">
                                    <th scope="row">
                                        <a href="{{route('register.show')}}">{{ __('home.sign up') }}</a>
                                    </th>
                                    <th scope="row" colspan="2">
                                        <a href="#">{{ __('home.Find password/id Login') }}</a>
                                    </th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>
    <script>

        function clearLocal() {
            localStorage.clear();
        }

        clearLocal();

        function submitFormLogin() {
            const checkForm = checkFormInput();
            if (!checkForm) {
                alert('Vui lòng nhập đầy đủ thông tin');
                return;
            }
            document.getElementById('formLogin').submit();
        }

        function checkFormInput() {
            const email = document.getElementById('login_email_1').value;
            const password = document.getElementById('login_password_1').value;

            return !(!email || !password);
        }

    </script>
@endsection
