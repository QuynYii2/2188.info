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
    <div>
        <div class="background container p-5 ">
            <div class="row p-5" style="background: rgb(253,229,136)">
                <div class="col-md-2">

                </div>
                <div class="col-md-8 bg bg-white p-4 rounded" >
                    <div class="form-title text-center pt-2 mb-5 ">
                        <div class="title">{{ __('home.sign in') }}</div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-11 login-tags">
{{--                            <nav>--}}
{{--                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">--}}
{{--                                    <a class="nav-item nav-link active link-tabs" id="nav-member-tab" data-toggle="tab"--}}
{{--                                       href="#nav-member" role="tab"--}}
{{--                                       aria-controls="nav-member">{{ __('home.Member') }}</a>--}}
{{--                                </div>--}}
{{--                            </nav>--}}
{{--                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">--}}
{{--                                <div class="tab-pane fade show active" id="nav-member" role="tabpanel"--}}
{{--                                     aria-labelledby="nav-member-tab">--}}
                                    <table class="table element-bordered-pink align-middle" align="center" id="tableLogin">
                                        <form method="post" action="{{ route('login.submit') }}" id="formLogin">
                                            @csrf
                                            <tbody>
                                            <tr class="text-center">
                                                <th scope="row">
                                                    <label for="login_email">{{ __('home.ID') }}: </label>
                                                </th>
                                                <td colspan="2">
                                                    <input id="login_email" type="email" class="form-control"
                                                           name="login_field"
                                                           placeholder="{{ __('home.input username') }}"
                                                           value="{{ old('login_field') }}" required autofocus>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <th scope="row">
                                                    <label for="login_password">{{ __('home.Password') }}: </label>
                                                </th>
                                                <td colspan="2">
                                                    <input type="password" class="form-control" name="password"
                                                           id="login_password"
                                                           placeholder="{{ __('home.input password') }}" required>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <th scope="row">
                                                    <label for="login_phone">{{ __('home.Phone Number Login') }}: </label>
                                                </th>
                                                <td>
                                                    <input id="login_phone" type="text" class="form-control"
                                                           name="login_phone"
                                                           placeholder="{{ __('home.input phone') }}"
                                                           value="{{ old('login_phone') }}" required>
                                                </td>
                                                <td>
                                                    <a id="btnVerify" onclick="sendVerifyCode();">
                                                        {{ __('home.information verification Login') }}
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <th scope="row">
                                                    <label for="verify_code">{{ __('home.Verify Code') }}: </label>
                                                </th>
                                                <td colspan="2">
                                                    <input id="verify_code" type="text" class="form-control"
                                                           name="verify_code" maxlength="6"
                                                           placeholder="{{ __('home.Verify Code Login') }}"
                                                           value="{{ old('verify_code') }}" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: none"></td>
                                                <th scope="row" colspan="3" class="solid-4x-pink">
                                                    <button type="button" onclick="submitFormLogin();"
                                                            class="btn btn-warning btn-block btn-round" style="height: 75px">{{ __('home.sign in') }}
                                                    </button>
                                                </th>
                                            </tr>
                                            <tr class="text-center">
                                                <th scope="row">
                                                    <a href="{{route('register.show')}}">{{ __('home.sign up') }}</a>
                                                </th>
                                                <th scope="row" colspan="2">
                                                    <a href="#">{{ __('home.Find password/id Login') }}</a>
                                                </th>
                                            </tr>
                                            </tbody>
                                        </form>
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

        let decodedString = '';
        function clearLocal() {
            localStorage.clear();
        }

        clearLocal();

        function submitFormLogin() {
            document.getElementById('formLogin').submit();
        }

        function sendVerifyCode() {
            const email = document.getElementById('login_email').value;
            const phone = document.getElementById('login_phone').value;
            const apiUrl = "{{ route('user.get.number.phone') }}";
            const data = {
                _token: "{{ csrf_token() }}",
                email: email,
                phone: phone
            };

            $.ajax({
                url: apiUrl,
                type: 'POST',
                data: data,
                success: function (response) {
                    decodedString = atob(response.deaswr);
                    console.log(decodedString)
                },
                error: function (response) {
                }
            });
        }
    </script>
@endsection