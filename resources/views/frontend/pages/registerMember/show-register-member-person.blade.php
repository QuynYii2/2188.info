@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')

    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2 solid-3x bg-member-green" style="font-size: 35px; font-weight: 600">
                <div class="title">{{ __('home.Register source information for members') }}</div>
            </div>
            <div class="">
                @php
                    $create = null;
                    if(session('create')){
                          $create =  session('create');
                    }
                @endphp
                @include('frontend.pages.registerMember.member-person')
            </div>
        </div>
    </div>
@endsection

