@php use Illuminate\Support\Facades\Auth;
 $user = \App\Models\User::find(Auth::user()->id)
@endphp

@extends('frontend.layouts.profile')

@section('title', 'Information')

@section('sub-content')
    <style>
        #dateOfBirth select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .size-img {
            width: 20px;
            height: 20px;
        }

        .avatar-upload img {
            max-width: none;
        }

        @media (max-width: 991px) {
            .border-right {
                border-right: none !important;
            }

            #form-info {
                padding-bottom: 3rem;
            }
        }

        @media (min-width: 992px) {
            .border-bottom {
                border-bottom: none !important;
            }
        }

        .cus-mr-modal {
        }

        @media (max-width: 575px) {
            .list-group .list-group-item {
                padding: 0.75rem 0;
            }

            .cus-mr-modal {
                width: 100vw;
                margin: 0 !important;
            }
        }

        @media (max-width: 481px) {
            .avatar-upload .preview, .image-upload .preview {
                width: 60px;
                height: 60px;
                position: relative;
                border: 6px solid #c9c9c9;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
            }

            .avatar-upload .avatar-edit input + label, .image-upload .image-edit input + label {
                display: inline-block;
                width: 15px;
                height: 15px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #e0dfdf;
                border: 1px solid;
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all 0.2s ease-in-out;
            }

            .size-img {
                width: 10px;
                height: 10px;
                display: flex;
            }
        }

    </style>
    <div class="d-flex rounded mt-5 bg-white m-auto">
        <div id="form-info" class="col-md-12 col-lg-6 border-bottom border-right">
            <form action="{{ route('user.updateInfo') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row align-items-center justify-content-center">
                    <div class="col-auto">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="file" id="avatarUpload" class="imageUpload" name="avatar"
                                       accept="image/*" onchange="previewImage(event)">
                                <label for="avatarUpload" class="bg-white text-center">
                                    <svg class="size-img" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg>
                                </label>
                            </div>
                            <img class=" img preview mb-3" id="avatarPreview"
                                 src="{{ asset('storage/'.$user->image) }}">
                        </div>
                    </div>
                    <div class="d-inline-block ml-3 dropbtn mobile-button">
                        <label for="">Avatar</label>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="staticEmail"
                                   class="col-md-2 col-12 col-form-label">{{ __('home.full name') }}</label>
                            <div class="col-md-10 col-12">
                                <input type="text" class="form-control" id="staticEmail" name="name"
                                       value="{{ ($user->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword"
                                   class="col-md-2 col-12 col-form-label">{{ __('home.nickname') }}</label>
                            <div class="col-md-10 col-12">
                                <input type="text" class="form-control" id="inputPassword" name="nickname"
                                       value="{{ ($user->nickname) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group" id="dateOfBirth">
                    <label for="date_of_birth"
                           class="col-md-2 col-12 col-form-label">{{ __('home.date of birth') }}</label>
                    <div class="col-md-10 col-12">
                        <input type="date" class="form-control" name="date_of_birth"
                               value="{{ ($user->date_of_birth) }}">
                    </div>
                </div>

                <div class="row form-group">
                    <label for="day" class="col-md-2 col-12 col-form-label">{{ __('home.gender') }}</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class=" col-sm-4 col-4">
                                <input class="" type="radio" name="gender"
                                       id="exampleRadios1"
                                       value="1" <?php if (Auth::user()->gender == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="exampleRadios1">
                                    {{ __('home.male') }}
                                </label>
                            </div>
                            <div class=" col-sm-4 col-4">
                                <input class="" type="radio" name="gender"
                                       id="exampleRadios2"
                                       value="2" <?php if (Auth::user()->gender == 2) echo 'checked'; ?>>
                                <label class="form-check-label" for="exampleRadios2">
                                    {{ __('home.female') }}
                                </label>
                            </div>
                            <div class=" col-sm-4 col-4">
                                <input class="" type="radio" name="gender"
                                       id="exampleRadios3"
                                       value="3" <?php if (Auth::user()->gender == 3) echo 'checked'; ?>>
                                <label class="form-check-label" for="exampleRadios3">
                                    {{ __('home.other') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="day" class="col-md-2 col-12 col-form-label">{{ __('home.nationality') }}</label>

                    <div class="col-md-10 col-12">
                        <select class="form-control" id="country" name="region">
                        </select>
                    </div>
                </div>

                <div class="row pl-2 pt-3">
                    <label for="day" class="col-sm-3 col-form-label col-12"></label>

                    <div class="col-md-10 col-12">
                        <button class="btn btn-outline-primary align-center" type="submit">{{ __('home.save changes') }}</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-md-12 col-lg-6 col-12">
            <div class="pt-2">
                <div class="d-flex justify-content-between align-items-center experience">
                    <span>{{ __('home.phone number and email') }}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            @if($user->phone == null)
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                    </svg>
                                    {{ __('home.phone number') }}
                                </h6>
                                <h6 class="mb-0" style="margin-left: 32px">{{ __('home.add phone') }}</h6>
                            @else
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                    </svg>
                                    {{ __('home.phone number') }}
                                </h6>
                                <h6 class="mb-0" style="margin-left: 32px">{{ ($user->phone) }}</h6>
                            @endif
                        </div>
                        <button class="btn-outline-primary btn desktop-button" data-toggle="modal"
                                data-target="#modal-edit-phone">
                            {{ __('home.update') }}
                        </button>
                        <svg class="mobile-button" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512" data-toggle="modal" data-target="#modal-edit-phone">
                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            @if($user->email == null)
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                    </svg>
                                    {{ __('home.email') }}
                                </h6>
                                <h6 class="mb-0" style="margin-left: 32px">{{ __('home.add email') }}</h6>
                            @else
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                    </svg>
                                    {{ __('home.email') }}
                                </h6>
                                <h6 class="mb-0" style="margin-left: 32px">{{ ($user->email) }}</h6>
                            @endif
                        </div>
                        <button class="btn-outline-primary btn desktop-button" data-toggle="modal"
                                data-target="#modal-edit-email">
                            {{ __('home.update') }}
                        </button>
                        <svg class="mobile-button" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512" data-toggle="modal" data-target="#modal-edit-phone">
                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </li>
                </ul>
            </div>
            <div class="pb-3">
                <div class="d-flex justify-content-between align-items-center experience">
                    <span>{{ __('home.security') }}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                            </svg>
                            {{ __('home.change password') }}
                        </h6>
                        <button class="btn-outline-primary btn desktop-button" data-toggle="modal"
                                data-target="#modal-edit-password">
                            {{ __('home.update') }}
                        </button>
                        <svg class="mobile-button" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512" data-toggle="modal" data-target="#modal-edit-phone">
                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                        </svg>
                    </li>
                </ul>
            </div>

            <div class="pb-3">
                <div class="d-flex justify-content-between align-items-center experience">
                    <span>{{ __('home.link social network') }}</span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                            </svg>
                            Facebook
                        </h6>
                        <button class="btn-outline-primary btn">{{ __('home.link') }}</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                            </svg>
                            Google
                        </h6>
                        <button class="btn-outline-primary btn">{{ __('home.link') }}</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-phone" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật số điện thoại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.changePhoneNumber') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Số điện thoại</label>
                            <div>
                                <input type="number" class="form-control" value="{{ Auth::user()->phone }}"
                                       id="edit-phone-input" required name="edit-phone" inputmode="numeric"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-email" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.changeEmail') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                            <div>
                                <input type="email" value="{{ Auth::user()->email }}" required class="form-control"
                                       pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
                                       name="edit-email"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-password" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered cus-mr-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <form action="{{route('user.changePassword')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Mật khẩu hiện tại</label>
                            <div>
                                <input type="password" class="form-control" name="current-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Mật khẩu mới</label>
                            <div>
                                <input type="password" class="form-control" name="new-password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-form-label">Nhập lại mật khẩu mới</label>
                            <div>
                                <input type="password" class="form-control" name="renew-password"
                                       onchange="checkPasswordMatch()">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('avatarPreview');
                output.src = reader.result;
                output.style.backgroundSize = "cover";
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function checkPasswordMatch() {
            var newPassword = document.getElementsByName("new-password")[0].value;
            var renewPassword = document.getElementsByName("renew-password")[0].value;

            if (newPassword !== renewPassword) {
                alert("Mật khẩu mới và nhập lại mật khẩu không khớp nhau.");
            }
        }

        patternPhoneNumber();

        function patternPhoneNumber() {
            let phoneNumberInput = document.getElementById('edit-phone-input');
            var patternVN = /^(84|0[3|5|7|8|9])+([0-9]{8})\b/;
            var patternDefault = /^\+(?:[0-9] ?){6,14}[0-9]$/;
            let phoneNumberPattern;
            const VN = 'vn';
            let regionUser = "{{ Auth::user()->region }}";
            switch (regionUser) {
                case VN:
                    phoneNumberPattern = patternVN;
                    break;
                default:
                    phoneNumberPattern = patternDefault;
            }

            phoneNumberInput.setAttribute('pattern', phoneNumberPattern.source);
        }

        var countrySelect = document.getElementById('country');
        fetch('https://restcountries.com/v2/all')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                const regionUser = "{{ Auth::user()->region }}";
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    let codeRegion = data[i].alpha2Code.toLowerCase();
                    option.value = codeRegion;
                    option.text = data[i].name;
                    if (codeRegion === regionUser) {
                        option.selected = true;
                    }
                    countrySelect.add(option);
                }
            })
            .catch(function (error) {

            });
    </script>
@endsection