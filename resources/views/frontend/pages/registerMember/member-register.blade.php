@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card-container">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.sign up member') }}</div>
                </div>
                <div class="mt-5 m-5 row">
                    @if(!empty($members))
                        @foreach($members as $member)
                            <div class="col-md-4 mb-5">
                                <h5 class="text-center mt-2 mb-3 member-name">

                                    @if(locationHelper() == 'kr')
                                        <div class="item-text">
                                            @if($member->name_ko == null)
                                                {{$member->name}}
                                            @else
                                                {{ $member->name_ko }}
                                            @endif
                                            </div>
                                    @elseif(locationHelper() == 'cn')
                                        <div class="item-text">
                                            @if($member->name_zh == null)
                                                {{$member->name}}
                                            @else
                                                {{ $member->name_zh }}
                                            @endif
                                        </div>
                                    @elseif(locationHelper() == 'jp')
                                        <div class="item-text">
                                            @if($member->name_ja == null)
                                                {{$member->name}}
                                            @else
                                                {{ $member->name_ja }}
                                            @endif</div>
                                    @elseif(locationHelper() == 'vi')
                                        <div class="item-text">
                                            @if($member->name_vi == null)
                                                {{$member->name}}
                                            @else
                                                {{ $member->name_vi }}
                                            @endif
                                        </div>
                                    @else
                                        <div class="item-text">
                                            @if($member->name_en == null)
                                                {{$member->name}}
                                            @else
                                                {{ $member->name_en }}
                                            @endif
                                        </div>
                                    @endif
                                </h5>
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title text-danger text-center">
                                            ${{$member->price}}
                                        </h3>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            {{ __('home.Member') }} @if(locationHelper() == 'kr')
                                                <div class="item-text">
                                                    @if($member->name_ko == null)
                                                        {{$member->name}}
                                                    @else
                                                        {{ $member->name_ko }}
                                                    @endif
                                                </div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="item-text">
                                                    @if($member->name_zh == null)
                                                        {{$member->name}}
                                                    @else
                                                        {{ $member->name_zh }}
                                                    @endif
                                                </div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="item-text">
                                                    @if($member->name_ja == null)
                                                        {{$member->name}}
                                                    @else
                                                        {{ $member->name_ja }}
                                                    @endif</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="item-text">
                                                    @if($member->name_vi == null)
                                                        {{$member->name}}
                                                    @else
                                                        {{ $member->name_vi }}
                                                    @endif
                                                </div>
                                            @else
                                                <div class="item-text">
                                                    @if($member->name_en == null)
                                                        {{$member->name}}
                                                    @else
                                                        {{ $member->name_en }}
                                                    @endif
                                                </div>
                                            @endif
                                        </h6>
                                        <h6 class="text-nowrap">
                                            {{ __('home.Xem chi tiết') }}
                                        </h6>
                                        <ol class="text-success">
                                            @php
                                                $listPermissionID = $member->permission_id;
                                                $arrayPermissionID = null;
                                                if ($listPermissionID){
                                                    $arrayPermissionID = explode(',', $listPermissionID);
                                                }
                                            @endphp
                                            @if($arrayPermissionID)
                                                @foreach($arrayPermissionID as $permissionID)
                                                    <li>
                                                        @php
                                                            $permission = \App\Models\Permission::find($permissionID);
                                                        @endphp
                                                        @if(locationHelper() == 'kr')
                                                            <div class="item-text">
                                                                @if($permission->name_ko == null)
                                                                    {{$permission->name}}
                                                                @else
                                                                    {{ $permission->name_ko }}
                                                                @endif
                                                            </div>
                                                        @elseif(locationHelper() == 'cn')
                                                            <div class="item-text">
                                                                @if($permission->name_zh == null)
                                                                    {{$permission->name}}
                                                                @else
                                                                    {{ $permission->name_zh }}
                                                                @endif
                                                            </div>
                                                        @elseif(locationHelper() == 'jp')
                                                            <div class="item-text">
                                                                @if($permission->name_ja == null)
                                                                    {{$permission->name}}
                                                                @else
                                                                    {{ $permission->name_ja }}
                                                                @endif</div>
                                                        @elseif(locationHelper() == 'vi')
                                                            <div class="item-text">
                                                                @if($permission->name_vi == null)
                                                                    {{$permission->name}}
                                                                @else
                                                                    {{ $permission->name_vi }}
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="item-text">
                                                                @if($permission->name_en == null)
                                                                    {{$permission->name}}
                                                                @else
                                                                    {{ $permission->name_en }}
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ol>
                                        <div class="col-12 justify-content-center d-flex">
                                            <a href="{{route('show.register.member', $member->id)}}"
                                               class="btn btn-primary">{{ __('home.Sign up now') }}</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

