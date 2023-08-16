@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.sign up member') }}</div>
                </div>
                <div class="mt-5 row">
                    @if(!$members->isEmpty())
                        @foreach($members as $member)
                            <div class="col-md-3">
                                <h5 class="text-center mt-2 mb-3 member-name">
                                    {{$member->name}}
                                </h5>
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title text-danger text-center">
                                            ${{$member->price}}
                                        </h3>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            Hội viên {{$member->name}}
                                        </h6>
                                        <h6 class="text-nowrap">
                                            Xem chi tiết
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
                                                        {{$permission->name}}
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ol>
                                        <a href="{{route('show.register.member', $member->id)}}"
                                           class="btn btn-primary">Đăng kí ngay</a>
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
<script></script>

