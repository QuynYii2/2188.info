@extends('frontend.layouts.master')

@section('title', 'Register Member')
<style>
    #tableMemberShip th, #tableMemberShip td {
        vertical-align: middle !important;
    }
</style>
@section('content')
    @if($memberName->name == \App\Enums\RegisterMember::LOGISTIC)
        @include('frontend.pages.registerMember.member-ship-show')
    @else
        @include('frontend.pages.registerMember.member-staff-trust-show')
    @endif
@endsection