@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <div class="container-fluid bg-white p-3">
        <a class="back text-black d-flex align-items-center" href="{{route('admin.list.users')}}">
            <i class="fa-solid fa-angle-left mr-2" style="font-size: 20px"></i>
            <span class="s24w6">{{ __('home.back_to') }}</span>
        </a>
        <h5 class="text-center s20w6 mt-3">Company Information</h5>
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>

@endsection
