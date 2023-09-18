@extends('frontend.layouts.master')

@section('title', 'Register')

@section('content')
    <style>
        mt-body {
            background: rgb(255, 235, 225);
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2">
                <h3 class="title">{{ __('home.sign up member') }}</h3>
            </div>
            <div class="mt-3 row">
                @if(!empty($members))
                    @foreach($members as $member)
                        <div class="col-md-4 mb-5">
                            <h6 class="text-center mt-2 mb-3 member-name">
                                @if(locationHelper() == 'kr')
                                    {{ ($member->lang_kr) }}
                                @elseif(locationHelper() == 'cn')
                                    {{ ($member->lang_cn) }}
                                @elseif(locationHelper() == 'jp')
                                    {{ ($member->lang_jp) }}
                                @elseif(locationHelper() == 'vi')
                                    {{ ($member->name) }}
                                @else
                                    {{ ($member->lang_en) }}
                                @endif
                            </h6>
                            <div class="card">
                                <div class="card-body">
{{--                                    <h3 class="card-title text-danger text-center">--}}
{{--                                        ${{$member->price}}--}}
{{--                                    </h3>--}}
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        @if(locationHelper() == 'kr')
                                            {{ ($member->text_kr) }}
                                        @elseif(locationHelper() == 'cn')
                                            {{ ($member->text_cn) }}
                                        @elseif(locationHelper() == 'jp')
                                            {{ ($member->text_jp) }}
                                        @elseif(locationHelper() == 'vi')
                                            {{ ($member->text_vi) }}
                                        @else
                                            {{ ($member->text_en) }}
                                        @endif
{{--                                        {{$member->name}}--}}
                                    </h6>
                                    <ol class="text-success">
                                        @php
                                            $listPermissionID = $member->permission_id;
                                            $arrayPermissionID = null;
                                            if ($listPermissionID){
                                                $arrayPermissionID = explode(',', $listPermissionID);
                                            }
                                                        $ld = new \App\Http\Controllers\TranslateController();
                                            $lastElement = end($arrayPermissionID);
                                            array_pop($arrayPermissionID);
                                        @endphp
                                        @if($arrayPermissionID)
                                            @foreach($arrayPermissionID as $permissionID)
                                                <li>
                                                    @php
                                                        $permission = \App\Models\Permission::find($permissionID);

                                                    @endphp
                                                    @if(locationHelper() == 'kr')
                                                        {{ ($permission->lang_kr) }}
                                                    @elseif(locationHelper() == 'cn')
                                                        {{ ($permission->lang_cn) }}
                                                    @elseif(locationHelper() == 'jp')
                                                        {{ ($permission->lang_jp) }}
                                                    @elseif(locationHelper() == 'vi')
                                                        {{ ($permission->name) }}
                                                    @else
                                                        {{ ($permission->lang_en) }}
                                                    @endif
                                                </li>
                                            @endforeach
                                                @php
                                                    $permission = \App\Models\Permission::find($lastElement);

                                                @endphp
                                                <p>
                                                    @if(locationHelper() == 'kr')
                                                        {{ ($permission->lang_kr) }}
                                                    @elseif(locationHelper() == 'cn')
                                                        {{ ($permission->lang_cn) }}
                                                    @elseif(locationHelper() == 'jp')
                                                        {{ ($permission->lang_jp) }}
                                                    @elseif(locationHelper() == 'vi')
                                                        {{ ($permission->name) }}
                                                    @else
                                                        {{ ($permission->lang_en) }}
                                                    @endif
                                                </p>
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
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
