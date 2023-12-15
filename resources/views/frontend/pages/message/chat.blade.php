@extends('backend.layouts.master')

@section('title', 'Chat')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <div class="container-fluid">
{{--        <h3 class="text-center">{{ __('home.Member booth') }}</h3>--}}
{{--            <div class="d-flex justify-content-between align-items-center p-3">--}}
{{--                <div>--}}
{{--                    <a href=" @if($company->member == "LOGISTIC") {{ route('seller.config.show') }} @endif " class="btn btn-warning mr-2">{{ __('home.Booth') }}</a>--}}
{{--                    <a href="{{route('partner.register.member.index')}}" class="btn btn-primary">{{ __('home.Partner List') }}</a>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <a href="{{route('chat.message.received')}}" class="btn btn-primary mr-2">{{ __('home.Message received') }}</a>--}}
{{--                    <a href="{{route('chat.message.sent')}}" style="" class="btn btn-primary mr-2">{{ __('home.Message sent') }}</a>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModalDemo">{{ __('home.Purchase') }}</a>--}}
{{--                    <a href="#" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModalBuyBulk">{{ __('home.Foreign wholesale order') }}</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @include('frontend.pages.member.tabs_info')--}}
{{--        <br>--}}
        <br>
            @include('frontend.pages.message.chat-detail')
    </div>
@endsection

