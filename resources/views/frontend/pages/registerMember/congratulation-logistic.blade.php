@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container-fluid">
        <div class="d-flex mt-5">
            <a href="{{route('login')}}" class="btn btn-success mr-3">{{ __('home.info_company') }}</a>
            <a href="{{route('login')}}" class="btn btn-success mr-3">{{ __('home.Registrator Information') }}</a>
            <a href="{{route('login')}}" class="btn btn-success mr-3">{{ __('home.Representative Information') }}</a>
            <a href="{{route('login')}}" class="btn btn-success mr-3">{{ __('home.Staffs Information') }}</a>
            <a href="{{route('homepage')}}" class="btn btn-success">{{ __('home.Home') }}</a>
        </div>

        <h3 class="text-center mt-5">{{ __('home.Congratulations, you have registered as a member') }} {{$company->member}}</h3>
        <div class="d-flex justify-content-around mt-5">
            <img style="margin-bottom: 100px" src="{{asset('images/img/logo-carousel/kasa22.jpg')}}">

            @php
                $listPermissionID = $member->permission_id;
                $arrayPermissionID = null;
                if ($listPermissionID){
                    $arrayPermissionID = explode(',', $listPermissionID);
                }
            @endphp
        </div>
    </div>

@endsection