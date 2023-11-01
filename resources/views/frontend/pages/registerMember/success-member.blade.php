@extends('frontend.layouts.master')

@section('title', 'Payment Register Member')

@section('content')
    @php

    @endphp
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.Payment Register Member') }}</div>
                </div>
                <h3 class="text-center">
                    {{ __('home.Join member') }}
                </h3>
                <div class="mt-5">
                    <div class="row p-5">
                        <br>
                        @php
                            $memberRegister = \App\Models\MemberRegisterInfo::where('id', $registerMember)->first();
                        @endphp
                        @if($memberRegister)
                            <h5>{{ __('home.account information') }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('home.full name') }}</th>
                                    <th scope="col">{{ __('home.phone number') }}</th>
                                    <th scope="col">{{ __('home.Fax') }}</th>
                                    <th scope="col">{{ __('home.Company Name') }}</th>
                                    <th scope="col">{{ __('home.address') }}</th>
                                    <th scope="col">{{ __('home.Status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ ($memberRegister->name) }}</td>
                                    <td>{{ ($memberRegister->phone) }}</td>
                                    <td>{{ ($memberRegister->fax) }}</td>
                                    <td>{{ ($memberRegister->code_business) }}</td>
                                    <td>{{ ($memberRegister->address) }}</td>
                                    <td>
                                        @if($memberRegister->status == \App\Enums\MemberRegisterInfoStatus::ACTIVE)
                                            <span class="text-success">{{ __('home.PAID') }}</span>
                                        @else
                                            <span class="text-danger">{{ __('home.UNPAID') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @php
                                $memberRegisterSource = \App\Models\MemberRegisterPersonSource::where([
                                    ['member_id', $registerMember],
                                    ['type', \App\Enums\MemberRegisterType::SOURCE]])->orderBy('created_at', 'desc')->first();
                            @endphp
                            <h5>{{ __('home.Account Member Source') }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('home.full name') }}</th>
                                    <th scope="col">{{ __('home.phone number') }}</th>
                                    <th scope="col">{{ __('home.email') }}</th>
                                    <th scope="col">{{ __('home.Status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ ($memberRegisterSource->name) }}</td>
                                    <td>{{ ($memberRegisterSource->phone) }}</td>
                                    <td>{{ ($memberRegisterSource->email) }}</td>
                                    <td>{{ ($memberRegisterSource->status) }}</td>
                                </tr>
                                </tbody>
                            </table>
                            @php
                                $memberRegisterRepresent = \App\Models\MemberRegisterPersonSource::where([
                                    ['person', $memberRegisterSource->id],
                                    ['type', \App\Enums\MemberRegisterType::REPRESENT]])->orderBy('created_at', 'desc')->first();
                            @endphp
                            <h5>{{ __('home.Account Member Represent') }}</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('home.full name') }}</th>
                                    <th scope="col">{{ __('home.phone number') }}</th>
                                    <th scope="col">{{ __('home.email') }}</th>
                                    <th scope="col">{{ __('home.Status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ ($memberRegisterRepresent->name) }}</td>
                                    <td>{{ ($memberRegisterRepresent->phone) }}</td>
                                    <td>{{ ($memberRegisterRepresent->email) }}</td>
                                    <td>{{ ($memberRegisterRepresent->status) }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-md-6 border">
                                <h5 class="text-center">{{ __('home.Membership benefits') }}</h5>
                                <ol class="text-success">
                                    <li>{{ __('home.Find products') }}</li>
                                    <li>{{ __('home.Manage and search transactions') }}</li>
                                    <li>{{ __('home.Messaging and product promotion') }}</li>
                                </ol>
                            </div>
                            <div class="col-md-6 border">
                                <h5 class="text-center">{{ __('home.Price') }}</h5>
                                @if($registerMember == \App\Enums\RegisterMember::VENDOR)
                                    {{ __('home.Price') }}:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::VENDOR}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::VENDOR}}">
                                @elseif($registerMember == \App\Enums\RegisterMember::POWER_VENDOR)
                                    {{ __('home.Price') }}:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::POWER_VENDOR}}">
                                @elseif($registerMember == \App\Enums\RegisterMember::PRODUCTION)
                                    {{ __('home.Price') }}:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::PRODUCTION}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::PRODUCTION}}">
                                @else
                                    {{ __('home.Price') }}:
                                    <span class="text-danger" style="font-weight: 600; font-size: 36px">
                                    $ {{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}
                                </span>
                                    <input hidden="" type="text" name="price"
                                           value="{{\App\Enums\RegisterMemberPrice::POWER_PRODUCTION}}">
                                @endif
                                <p class="text-success small">{{ __('home.Payment success') }}</p>
                                <div class="float-right mt-5">
                                    <a href="{{route('homepage')}}" class="btn btn-success">
                                        {{ __('home. Back to home') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script></script>

