@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container-fluid" style="margin-top: 150px">
        <h3 class="text-center" style="font-size: 36px">{{ __('home.Subscription options') }}</h3>
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2 solid-3x bg-member-green" style="font-size: 35px; font-weight: 600">
                <div class="title">{{ __('home.Subscription options') }}</div>
            </div>
            <div class="">
                <table class="table element-bordered align-middle">
                    <tbody>
                    <tr>
                        <th colspan="4">
                            <label for="position">1. {{ __('home.Registered member represent') }}</label>
                        </th>
                        <td>
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
                        <td>
                            <a href="{{route('show.register.member.congratulation', $member->id)}}"
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