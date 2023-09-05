@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.Register registrant information for members') }} {{ ($registerMember) }}</div>
                </div>
                <div class="mt-5">
                    <form class="p-3" action="{{route('register.member.represent')}}" method="post">
                        @csrf
                        @if($memberPerson)
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="position">Chức vụ:</label>
                                    <input type="text" class="form-control" id="position" name="position"
                                           value="{{$memberPerson->position}}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="responsibility">Chức trách:</label>
                                    <input type="text" class="form-control" id="responsibility" name="responsibility"
                                           value="{{$memberPerson->responsibility}}"
                                           required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rank">{{ __('home.Rank') }}:</label>
                                    <select id="rank" name="rank" class="form-control">
                                        <option value="staff">{{ __('home.Staff') }}</option>
                                        <option value="seo">SEO</option>
                                        <option value="other">{{ __('home.Other') }}:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name_en">Tên English:</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en"
                                           value="{{$memberPerson->name_en}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Tên hiện tại:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{$memberPerson->name}}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="phoneNumber">{{ __('home.phone number') }}:</label>
                                    <input type="text" class="form-control" id="phoneNumber"
                                           value="{{$memberPerson->phoneNumber}}" name="phoneNumber"
                                           required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">{{ __('home.email') }}:</label>
                                    <input type="email" class="form-control" id="email" value="{{$memberPerson->email}}"
                                           name="email" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sns_account">{{ __('home.SNS Account') }}:</label>
                                    <input type="text" class="form-control" id="sns_account" name="sns_account"
                                           value="{{$memberPerson->sns_account}}" required>
                                </div>
                            </div>
                        @else
                            <input type="text" class="form-control" name="person" value="{{ ($person) }}" hidden="">
                            <div class="form-group">
                                <label for="datetime_register">Ngày giờ đăng ký:</label>
                                <input type="text" class="form-control" id="datetime_register" name="datetime_register"
                                       disabled>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="position">Chức vụ:</label>
                                    <input type="text" class="form-control" id="position" name="position"
                                           required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="responsibility">Chức trách:</label>
                                    <input type="text" class="form-control" id="responsibility" name="responsibility"
                                           required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rank">{{ __('home.Rank') }}:</label>
                                    <select id="rank" name="rank" class="form-control">
                                        <option value="staff">{{ __('home.Staff') }}</option>
                                        <option value="seo">SEO</option>
                                        <option value="other">{{ __('home.Other') }}:</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name_en">Tên English:</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Tên hiện tại:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="code">ID: </label>
                                    <input type="text" class="form-control" id="code" name="code" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">{{ __('home.Password') }}:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passwordConfirm">{{ __('home.Password') }}
                                        : {{ __('home.Confirm') }}</label>
                                    <input type="password" class="form-control" id="passwordConfirm"
                                           name="passwordConfirm"
                                           required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="phoneNumber">{{ __('home.phone number') }}:</label>
                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                           required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">{{ __('home.email') }}:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sns_account">{{ __('home.SNS Account') }}:</label>
                                    <input type="text" class="form-control" id="sns_account" name="sns_account"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" value="" id="register_membership">
                                <label for="register_membership">
                                    Đăng ký nhân viên
                                </label>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">{{ __('home.sign up') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#register_membership').on('change', function () {
                if ($('#register_membership').is(":checked")) {
                    localStorage.setItem('register_membership', 'yes');
                } else {
                    localStorage.removeItem('register_membership');
                }
            })
        })

        function getDate() {
            let nowTime = new Date().toLocaleString();
            $('#datetime_register').val(nowTime);
        }

        getDate();
    </script>
@endsection

