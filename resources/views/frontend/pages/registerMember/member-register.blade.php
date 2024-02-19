@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="form-title text-center pt-2">
                <h3 class="title">{{ __('home.sign up member') }}</h3>
            </div>
            <div class="mt-5 m-5 row">
                @if(!empty($members))
                    @foreach($members as $member)
                        <div class="col-md-4 mb-5">
                            <h5 class="text-center mt-2 mb-3 member-name">
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
                            </h5>
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title text-danger text-center">
                                        @if($member->price > 0)
                                            ${{$member->price}}
                                        @endif
                                    </h3>
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
                                    </h6>
                                    <ol class="text-success">
                                        @php
                                            $listPermissionID = $member->permission_id;
                                            $arrayPermissionID = null;
                                            if ($listPermissionID){
                                                $arrayPermissionID = explode(',', $listPermissionID);
                                            }
                                                        $ld = new \App\Http\Controllers\TranslateController();

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
                                        @endif
                                    </ol>
                                    <div class="col-12 justify-content-center d-flex">
                                        @if($member->name == \App\Enums\RegisterMember::BUYER)
                                            <a href="{{route('show.register.member', $member->id)}}"
                                               class="btn btn-primary">{{ __('auth.Buy register member') }}</a>
                                        @elseif($member->name == \App\Enums\RegisterMember::TRUST)
                                            <a href="{{route('show.register.member', $member->id)}}"
                                               class="btn btn-primary">{{ __('auth.Buy register member trust') }}</a>
                                        @else
                                            <a href="{{route('show.register.member', $member->id)}}"
                                               class="btn btn-primary">{{ __('auth.Buy register member logistic') }}</a>
                                        @endif
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

