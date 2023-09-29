@php use Illuminate\Support\Facades\Auth;
// $user = \App\Models\User::find(Auth::user()->id)
 $user = Auth::user();
@endphp

@extends('frontend.layouts.master')

@section('title', 'Profile')

@section('content')
    @php
        (new \App\Http\Controllers\Frontend\HomeController())->createStatistic();
    @endphp
    <style>
        body {
            background-color: #ebebeb;
        }
    </style>

    <div class="container-fluid pb-4 pt-3">
        <div class="row">
            <div class="col-2 col-md-4 col-sm-12 col-lg-2">
                @include('frontend.pages.profile.side-bar')
            </div>
            <div class="col-10 col-md-8 col-sm-12 col-lg-10">
                @yield('sub-content')
            </div>
        </div>
    </div>
@endsection
