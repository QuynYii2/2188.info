@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <style>
        #tableMemberRegister th, #tableMemberRegister td {
            vertical-align: middle !important;
        }
    </style>
    <div class="container-fluid" style="margin-top: 150px">
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2 solid-3x bg-member-green" style="font-size: 35px; font-weight: 600">
                <div class="title">{{ __('home.Subscription options') }}</div>
            </div>
            <div class="">
                <table class="table element-bordered" id="tableMemberRegister">
                    <tbody>
                    <tr>
                        <th colspan="4">
                            <label for="position">1. {{ __('home.Registered member represent') }}</label>
                        </th>
                        <td class="text-center">
                            <a href="{{route('show.register.member.person.represent', [
                                'person_id' => $member->id,
                                'registerMember' => $register->member
                            ]) }}" class="btn btn-warning" style="font-size: 36px; font-weight: 600">
                                {{ __('home.Confirm') }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <label for="position">2. {{ __('home.Registered staff') }}</label>
                        </th>
                        <td class="text-center">
                            <a href="{{route('show.register.member.ship', $member->id)}}"
                               class="btn btn-primary" style="font-size: 36px; font-weight: 600">
                                {{ __('home.Confirm') }}
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection