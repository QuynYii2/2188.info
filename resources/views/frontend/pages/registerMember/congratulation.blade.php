@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container">
        <h3 class="text-center mt-5">{{ __('home.Congratulations, you have registered as a member') }} {{$company->member}}</h3>
        <div class="d-flex justify-content-start align-items-center mt-5">
            @php
                $listPermissionID = $member->permission_id;
                $arrayPermissionID = null;
                if ($listPermissionID){
                    $arrayPermissionID = explode(',', $listPermissionID);
                }
            @endphp
            <div class="">
                <p>{{ __('home.Membership benefits') }}</p>
                <ol class="text-success">
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
            </div>
        </div>
    </div>
@endsection