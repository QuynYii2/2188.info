@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center mt-5">{{ __('home.Congratulations, you have registered as a member') }} {{$company->member}}</h3>
        <div class="d-flex justify-content-around mt-5">
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
                                    $ld = new \App\Http\Controllers\TranslateController();
                                @endphp
                                {{ $ld->translateText($permission->name, locationPermissionHelper()) }}
                            </li>
                        @endforeach
                    @endif
                </ol>
            </div>
            <div class="">
                @if($memberSource)
                    <p>{{ __('home.Representative member') }}:{{$memberSource->name}}</p>
                @endif

                @if($memberRepresent)
                    <p>{{ __('home.Registered member') }}:{{$memberRepresent->name}}</p>
                @endif
                <p>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                </p>
            </div>
        </div>
    </div>
@endsection