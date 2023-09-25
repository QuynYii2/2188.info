@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')

    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="form-title text-center">
            <h3 style="font-size: 36px">{{ __('home.Register source information for members') }}</h3>
        </div>
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2 solid-3x bg-member-green" style="font-size: 35px; font-weight: 600">
                <div class="title">{{ __('home.Register source information for members') }}</div>
            </div>
            <div class="">
                @include('frontend.pages.registerMember.member-person')
            </div>
        </div>
    </div>
@endsection

