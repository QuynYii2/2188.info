@extends('frontend.layouts.master')
@section('title', 'Partner Register Members')
@section('content')
    <div class="container">
        <h3 class="text-center">{{ __('home.Partner List') }}</h3>
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
            @php

            @endphp
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

<table>
    <tbody>
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
        @php

            $member = \App\Models\MemberRegisterPersonSource::where('member_id',$id)->value('id');
            $memberRepresent = \App\Models\MemberRegisterPersonSource::find($member);
                if (!$memberRepresent) {
                    return back();
                }
                $memberSource = \App\Models\MemberRegisterPersonSource::find($memberRepresent->person);
            if ($memberSource){
              $user1 = \App\Models\User::where('email', $memberSource->email)->first();
            }
            $memberSource = \App\Models\MemberRegisterPersonSource::find($memberRepresent->person);
            $findMember = $memberRepresent->email;
            $userRepresent = \App\Models\User::where('email', $findMember)->first();
            $staffUsers = \App\Models\StaffUsers::where('parent_user_id', $userRepresent->id)->get();
            $staffs = null;
            if ($memberRepresent && $memberSource){
                $user2 = \App\Models\User::where('email', $memberRepresent->email)->first();
                $staffs = \App\Models\StaffUsers::where('parent_user_id', $user1->id)->orWhere('parent_user_id', $user2->id)->get();
            }
        @endphp
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
