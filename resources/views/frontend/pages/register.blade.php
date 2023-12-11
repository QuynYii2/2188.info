@extends('frontend.layouts.master')

@section('title', 'Register')

@section('content')
    <style>
        .member-item {
            border-radius: 6px;
        }

        .member-item:hover {
            border: 1px solid #F47621;
        }

        .member-name {
            font-size: 32px;
            font-weight: 600;
        }

        .btnRegister {
            color: #F47621;
            padding: 16px 20px;
        }

        .btnRegister:hover {
            color: #fff;
            background-color: #F47621;
        }

        .list-permission {
            margin: 0 16px;
            width: 250px;
            height: 500px;
            overflow-y: auto;
        }

        .item-permission {
            list-style: inside;
            font-size: 18px;
            font-weight: 500;
        }

        @media (min-width: 768px) {
            .page-register {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .list-permission {
                margin: 0 16px;
                width: 250px;
                height: auto;
            }
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="background-login" style="min-height: 100vh;">
        <div class="background container pt-3 justify-content-center pb-3">
            <div class="row page-register">
                @if(!empty($members))
                    @foreach($members as $member)
                        <div class="col-md-4 mb-2">
                            <div class="member-item">
                                <div class="card">
                                    <h6 class="text-center mt-2 mb-3 member-name mt-3">
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
                                    <div class="card-body">
                                        <ul class="list-permission">
                                            @php
                                                $listPermissionID = $member->permission_id;
                                                \Illuminate\Support\Facades\Cache::put('id-member-reg', $member->id);
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
                                                    <li class="item-permission">
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
                                            @endif
                                        </ul>
                                        <div class="col-12 d-flex justify-content-center text-main">
                                            <a href="{{route('show.register.member.info', $member->id)}}"
                                               class="btn btnRegister border-org">{{ __('home.Sign up now') }}</a>
                                        </div>
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
