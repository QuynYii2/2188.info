@extends('frontend.layouts.master')

@section('title', 'Register Member')
<style>
    #tableMemberShip th, #tableMemberShip td {
        vertical-align: middle !important;
    }
</style>
@section('content')
   @include('frontend.pages.registerMember.member-ship-show')
@endsection