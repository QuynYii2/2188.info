@extends('backend.layouts.master')
@section('title', __('home.Member'))
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    @include('frontend.pages.registerMember.member-ship-show')
@endsection