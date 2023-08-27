@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    @php

            @endphp
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.Register registrant information for members') }} {{ ($registerMember) }}</div>
                </div>
                <div class="mt-5">
                    <form class="p-3" action="{{route('register.member.source')}}" method="post">
                        @csrf
                        @if($memberPersonSource)
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fullName">{{ __('home.full name') }}:</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName"
                                           value="{{$memberPersonSource->name}}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="phoneNumber">{{ __('home.phone number') }}:</label>
                                    <input type="text" class="form-control" id="phoneNumber"
                                           value="{{$memberPersonSource->phone}}" name="phoneNumber" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="email">{{ __('home.email') }}:</label>
                                    <input type="email" class="form-control" id="email"
                                           value="{{$memberPersonSource->email}}" name="email" required>
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

                            <input type="text" class="form-control" name="member" value="{{$member}}" hidden="">

                            <div class="form-group">
                                <label for="sns_account">{{ __('home.SNS Account') }}:</label>
                                <input type="text" class="form-control" id="sns_account"
                                       value="{{$memberPersonSource->sns_account}}" name="sns_account" required>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('home.sign up') }}</button>

                        @else
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fullName">{{ __('home.full name') }}:</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">{{ __('home.Password') }}:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passwordConfirm">{{ __('home.Password') }}: {{ __('home.Confirm') }}</label>
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
                                    <label for="rank">{{ __('home.Rank') }}:</label>
                                    <select id="rank" name="rank" class="form-control">
                                        <option value="staff">{{ __('home.Staff') }}</option>
                                        <option value="seo">SEO</option>
                                        <option value="other">{{ __('home.Other') }}:</option>
                                    </select>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="member" value="{{$member}}" hidden="">
                            <div class="form-group">
                                <label for="sns_account">{{ __('home.SNS Account') }}:</label>
                                <input type="text" class="form-control" id="sns_account" name="sns_account" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('home.sign up') }}</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>

