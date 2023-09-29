@extends('frontend.layouts.master')
@section('title', 'Partner Register Members')
@section('content')
    @php
        $memberPer = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
        $mentor = \App\Models\User::where('email', $memberPer->email)->first();
    @endphp
    <div class="container">
        <h3 class="text-center">{{ __('home.해외 B2B 도매상 명단') }}</h3>
        @include('frontend.pages.member.header_member')
        @include('frontend.pages.member.tabs_info')

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">{{ __('home.Customer code') }}</th>
                <th scope="col">{{ __('home.Nation') }}</th>
                <th scope="col">{{ __('home.Company Name') }}</th>
                <th scope="col">{{ __('home.Area') }}</th>
                <th scope="col">{{ __('home.Day trading') }}</th>
                <th scope="col">{{ __('home.Membership classification') }}</th>
                <th scope="col">{{ __('home.Status') }}</th>
                <th scope="col">{{ __('home.Customer level') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!$memberList->isEmpty())
                @foreach($memberList as $memberItem)
                    <tr>
                        <td scope="row">{{$memberItem->number_business}}</td>
                        <td>
                            {{$locale}}
                        </td>
                        <td>{{$memberItem->name}}</td>
                        <td>{{$memberItem->address}}</td>
                        <td>{{ \Carbon\Carbon::parse($memberItem->created_at)->format('d/m/Y') }}</td>
                        <td>{{$memberItem->member}}</td>
                        <td>
                            @php
                                $isValid = false;
                                $companyItem = \App\Models\MemberPartner::where([
                                    ['company_id_source', $memberItem->id],
                                    ['company_id_follow', $company->id],
                                    ['status', \App\Enums\MemberPartnerStatus::ACTIVE],
                                ])->first();
                            @endphp

                            @if(!$companyItem)
                                <form method="post" action="{{route('stands.register.member')}}">
                                    @csrf
                                    <input type="text" name="company_id_source"
                                           value="{{$memberItem->id}} "
                                           hidden>
                                    <button class="btn btn-primary" id="btnFollow" type="submit">
                                        {{ __('home.Follow') }}
                                    </button>
                                </form>
                            @else
                                <form method="post" action="{{ route('stands.unregister.member', $memberItem->id) }}">
                                    @csrf
                                    <input type="text" name="company_id_source"
                                           value="{{ $memberItem->id }}" hidden>
                                    <button class="btn btn-danger" id="btnUnfollow" type="submit">
                                        {{ __('home.Unfollow') }}
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td>
                            <i class="fa-solid fa-trophy"></i>
                            <i class="fa-solid fa-trophy"></i>
                            <i class="fa-solid fa-trophy"></i>
                        </td>

                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection