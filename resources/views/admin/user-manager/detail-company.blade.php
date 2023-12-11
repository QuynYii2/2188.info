@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <div class="">
        <h3 class="text-center mt-3">Company Information</h3>
        <a class="btn btn-info" href="{{route('admin.list.users')}}">{{ __('home.Quay lại danh sách') }}</a>
    </div>
    <div class="container">
        @php
            $isAdminUpdate = $company;
        @endphp
        @include('frontend.pages.member.detail-company')
        <div class="row mb-3">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex justify-content-between align-items-center">
                <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

@endsection
