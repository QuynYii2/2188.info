@extends('frontend.layouts.profile')

@section('title', 'Information')

@section('sub-content')
    <div class="container row rounded mt-5 bg-white">
        <div class="row rounded pt-1">
            <h5>{{ __('home.account information') }}</h5>
        </div>
        <div class="border-bottom"></div>
        <div class="row">
            <div class="col-md-7 border-right">
                <div class="p-3 py-3">
                    <div class="d-flex align-items-center experience">
                        <span>{{ __('home.personal information') }}</span>
                    </div>
                </div>
                <form>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type="file" id="avatarUpload" class="imageUpload" name="avatar"
                                           accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                                    <label for="avatarUpload" class="bg-white text-center">
                                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 512 512">
                                            <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                        </svg>
                                    </label>
                                </div>
                                <img class="preview" id="avatarPreview" src="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">{{ __('home.full name') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">{{ __('home.nickname') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputPassword">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group pl-2">
                        <label for="day" class="col-sm-3 col-form-label ">{{ __('home.date of birth') }}</label>

                        <div class="col-sm-3">
                            <select class="form-control" id="day">
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="month">
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="year">
                            </select>
                        </div>
                    </div>

                    <div class="row form-group pl-2">
                        <label for="day" class="col-sm-3 col-form-label">{{ __('home.gender') }}</label>
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                                   value="1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                {{ __('home.male') }}
                            </label>
                        </div>
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
                                   value="2">
                            <label class="form-check-label" for="exampleRadios2">
                                {{ __('home.female') }}
                            </label>
                        </div>
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
                                   value="3">
                            <label class="form-check-label" for="exampleRadios3">
                                {{ __('home.other') }}
                            </label>
                        </div>
                    </div>
                    <div class="row form-group pl-2">
                        <label for="day" class="col-sm-3 col-form-label">{{ __('home.nationality') }}</label>

                        <div class="col-md-9">
                            <select class="form-control" id="country">
                            </select>
                        </div>
                    </div>
                    <div class="row pl-2 pt-3">
                        <label for="day" class="col-sm-3 col-form-label"></label>

                        <div class="col-md-9">
                            <button class="btn btn-outline-primary -align-center" type="submit">{{ __('home.save changes') }}</button>

                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-5">
                <div class="p-3 pt-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>{{ __('home.phone number and email') }}</span>
                    </div>
                    <br>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div>
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                                    </svg>
                                    {{ __('home.phone number') }}
                                </h6>
                                <h6 class="mb-0" style="margin-left: 32px">0123456789</h6>
                            </div>
                            <button class="btn-outline-primary btn" data-toggle="modal" data-target="#modal-edit-phone">
                                {{ __('home.update') }}
                            </button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div>


                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                    </svg>
                                    {{ __('home.email') }}
                                </h6>
                                <h6 class="mb-0" style="margin-left: 32px">{{ __('home.add email') }}</h6>
                            </div>
                            <button class="btn-outline-primary btn" data-toggle="modal" data-target="#modal-edit-email">
                                {{ __('home.update') }}
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="p-3 pb-3">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>{{ __('home.security') }}</span>
                    </div>
                    <br>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/>
                                </svg>
                                {{ __('home.change password') }}
                            </h6>
                            <button class="btn-outline-primary btn" data-toggle="modal"
                                    data-target="#modal-edit-password">{{ __('home.update') }}
                            </button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0z"/>
                                </svg>
                                {{ __('home.set pin code') }}
                            </h6>
                            <button class="btn-outline-primary btn">{{ __('home.update') }}</button>
                        </li>
                    </ul>
                </div>

                <div class="p-3 pb-3">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>{{ __('home.link social network') }}</span>
                    </div>
                    <br>
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
    </div>

    <div class="modal fade" id="modal-edit-phone" tabindex="-1" aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật số điện thoại</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span >&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Số điện thoại</label>
                            <div>
                                <input type="tel" class="form-control" name="edit-phone">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-email" tabindex="-1" aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span >&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Email</label>
                            <div>
                                <input type="tel" class="form-control" name="edit-email">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-password" tabindex="-1" aria-labelledby="exampleModalLabel"
         >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đổi mật khẩu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span >&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
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
                                <input type="password" class="form-control" name="renew-password">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var yearSelect = document.getElementById('year');
        var currentYear = new Date().getFullYear();
        var daySelect = document.getElementById('day');
        var monthSelect = document.getElementById('month');

        for (var i = currentYear; i >= currentYear - 100; i--) {
            var option = document.createElement('option');
            option.value = i;
            option.text = i;
            yearSelect.add(option);
        }
        for (var i = 1; i <= 12; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.text = i;
            monthSelect.add(option);
        }

        var year = parseInt(yearSelect.value);
        var month = parseInt(monthSelect.value);
        var daysInMonth = new Date(year, month, 0).getDate();

        for (var i = 1; i <= daysInMonth; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.text = i;
            daySelect.add(option);
        }

        function updateDaysInMonth() {
            var year = parseInt(yearSelect.value);
            var month = parseInt(monthSelect.value);
            var daysInMonth = new Date(year, month, 0).getDate();
            daySelect.innerHTML = '';
            for (var i = 1; i <= daysInMonth; i++) {
                var option = document.createElement('option');
                option.value = i;
                option.text = i;
                daySelect.add(option);
            }
        }

        var countrySelect = document.getElementById('country');
        fetch('https://restcountries.com/v2/all')
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    option.value = data[i].alpha2Code;
                    option.text = data[i].name;
                    countrySelect.add(option);
                }
            })
            .catch(function (error) {
                console.log(error);
            });


        monthSelect.addEventListener('change', updateDaysInMonth);
        yearSelect.addEventListener('change', updateDaysInMonth);


        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('avatarPreview');
                output.src = reader.result;
                output.style.backgroundSize = "cover";
            }
            reader.readAsDataURL(event.target.files[0]);
        }

    </script>
@endsection
