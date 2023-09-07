@extends('frontend.layouts.master')

@section('title', 'Register Member')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Chúc mừng bạn đã đăng ký hội viên {{$company->member}}</h3>
        <div class="d-flex justify-content-around mt-5">
            @php
                $listPermissionID = $member->permission_id;
                $arrayPermissionID = null;
                if ($listPermissionID){
                    $arrayPermissionID = explode(',', $listPermissionID);
                }
            @endphp
            <div class="">
                <p>Quyền lợi của hội viên</p>
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
                    <p>Hội viên đăng kí:{{$memberSource->name}}</p>
                @endif

                @if($memberRepresent)
                    <p>Hội viên đại diện:{{$memberRepresent->name}}</p>
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
        <div class="d-flex justify-content-center">
            <a href="{{route('login')}}" class="btn btn-success mb-5">Đăng nhập ngay</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection