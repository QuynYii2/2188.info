@extends('frontend.layouts.master')

@section('title', 'Profile')

@section('content')
    <style>
        body {
            background-color: #ebebeb;
        }
    </style>

    <div class="container">
        <div class="row mb-5">
            <div class="col-3 ">
                @include('frontend.pages.profile.side-bar')
            </div>
            <div class="col-9 ">
                @yield('sub-content')
            </div>
        </div>
    </div>
@endsection
