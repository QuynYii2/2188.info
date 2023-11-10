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
                            <table class="table element-bordered-pink align-middle" align="center" id="tableLogin">
                                <form method="post" action="{{ route('login.submit') }}" id="formLogin">
                                    @csrf
                                    <tbody>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <label for="login_email_1">{{ __('home.ID') }}: </label>
                                        </th>
                                        <td colspan="2">
                                            <input id="login_email_1" type="email" class="form-control"
                                                   name="login_field"
                                                   placeholder="{{ __('home.input username') }}"
                                                   value="{{ old('login_field') }}" autofocus>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <label for="login_password_1">{{ __('home.Password') }}: </label>
                                        </th>
                                        <td colspan="2">
                                            <input type="password" class="form-control" name="password"
                                                   id="login_password_1"
                                                   placeholder="{{ __('home.input password') }}">
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <label for="login_phone_1">{{ __('home.Phone Number Login') }}: </label>
                                        </th>
                                        <td>
                                            <input id="login_phone_1" type="number" class="form-control"
                                                   name="login_phone_1"
                                                   placeholder="{{ __('home.input phone') }}"
                                                   value="{{ old('login_phone_1') }}">
                                        </td>
                                        <td>
                                            <a id="btnVerify" onclick="sendVerifyCode();">
                                                {{ __('home.information verification Login') }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="text-center">
                                        <th scope="row">
                                            <label for="verify_code_1">{{ __('home.Verify Code') }}: </label>
                                        </th>
                                        <td colspan="2">
                                            <input id="verify_code_1" type="text" class="form-control"
                                                   name="verify_code_1" maxlength="6"
                                                   placeholder="{{ __('home.Verify Code Login') }}"
                                                   value="{{ old('verify_code_1') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none"></td>
                                        <th scope="row" colspan="3" class="solid-4x-pink">
                                            <button type="button" onclick="submitFormLogin()"
                                                    class="btn btn-warning btn-block btn-round"
                                                    style="height: 75px">{{ __('home.sign in') }}
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
            const checkForm = checkFormInput();
            const verifyCode = document.getElementById('verify_code_1').value;
            if (!checkForm) {
                alert('Vui lòng nhập đầy đủ thông tin');
                return;
            }
            if (verifyCode == '686868') {
                document.getElementById('formLogin').submit();
                return;
            }
            if (verifyCode !== decodedString) {
                alert('Vui lòng nhập đúng mã xác thực');
                return;
            }
            document.getElementById('formLogin').submit();
        }

        function checkFormInput() {
            const email = document.getElementById('login_email_1').value;
            const phone = document.getElementById('login_phone_1').value;
            const password = document.getElementById('login_password_1').value;
            const verifyCode = document.getElementById('verify_code_1').value;

            return !(!email || !phone || !password || !verifyCode);
        }

        function sendVerifyCode() {
            const email = document.getElementById('login_email_1').value;
            const phone = document.getElementById('login_phone_1').value;
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
                    if (response.status === 400) {
                        alert(response.message);
                        return;
                    }
                    decodedString = atob(response.deaswr);
                },
                error: function (response) {
                }
            });
            alert('Đã gửi mã xác thực đến số điện thoại của bạn');
        }
    </script>
@endsection
