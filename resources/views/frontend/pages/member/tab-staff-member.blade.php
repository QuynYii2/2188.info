@extends('frontend.layouts.master')
@section('title', 'Partner Register Members')
@section('content')
    @php
        $memberPer = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
        $mentor = \App\Models\User::where('email', $memberPer->email)->first();
    @endphp
    <div class="container">
        <h3 class="text-center">{{ __('home.Staffs Information') }}</h3>
        @include('frontend.pages.member.header_member')
        @include('frontend.pages.member.tabs_info')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" scope="col">{{ __('home.Responsibility') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.Position') }}</th>
                    <th colspan="2" scope="col">{{ __('home.namess') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.ID') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.Phone Number') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.email') }}</th>
                    <th rowspan="2" scope="col">{{ __('home.SNS Account') }}</th>
                </tr>
                <tr>
                    <th scope="col">{{ __('home.Name English') }}</th>
                    <th scope="col">{{ __('home.Name Korea') }}</th>
                </tr>
            </thead>
            <tbody>
                @if($staffUsers)
                    @if($staffUsers->isNotEmpty())
                        @foreach($staffUsers as $staff)
                            <tr>
                                <td>{{$staff->phu_trach}}</td>
                                <td>{{$staff->chuc_vu}}</td>
                                @php
                                    $infoStaff = \App\Models\User::where('id',$staff->user_id)->first();
                                @endphp
                                <td>{{$infoStaff->nickname}}</td>
                                <td>{{$infoStaff->name}}</td>
                                <td>{{$infoStaff->rental_code}}</td>
                                <td>{{$infoStaff->phone}}</td>
                                <td>{{$infoStaff->email}}</td>
                                <td>{{$infoStaff->social_media}}</td>
                            </tr>
                        @endforeach

                    @endif
                @endif
            </tbody>
        </table>
    </div>
@endsection


