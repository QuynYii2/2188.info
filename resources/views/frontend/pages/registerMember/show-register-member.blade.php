@extends('frontend.layouts.master')

@section('title', 'Register Member')

<style>
    .btn-hidden:hover {
        cursor: not-allowed !important;
    }
</style>

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">{{ __('home.sign up member') }}</div>
                </div>
                <div class="mt-5">
                    <div class="card border">
                        <h3 class="text-center">
                            Đồng ý với điều khoản quy định của hội
                            viên {{$member->name}}
                        </h3>
                        <div class="row ml-3 mr-3">
                            <div class="col-md-6 border">
                                <h5 class="text-center">Kiểm tra nội quy định phải đồng ý ở bên dưới</h5>
                                <div class="rules" onclick="validateAll()">
                                    <p class="text-warning">
                                        Đồng ý với quy định và điều khoản mà chúng tôi cung cấp
                                    </p>
                                    <input type="checkbox" id="rules" name="rules" required>
                                    <label for="rules"> Trust</label><br>
                                </div>
                                <div class="getInfo" onclick="validateAll()">
                                    <p class="text-warning">
                                        Cho phép thu thập thông tin
                                    </p>
                                    <input type="checkbox" id="getInfo" name="getInfo" required>
                                    <label for="getInfo"> Trust</label><br>
                                </div>
                                <div class="all" onclick="validate()">
                                    <p class="text-warning">
                                        Đồng ý tất cả
                                    </p>
                                    <input type="checkbox" id="all" name="all">
                                    <label for="all"> All</label><br>
                                </div>
                            </div>
                            <div class="col-md-6 border">
                                <h5 class="text-center">Chức năng chính dành riêng cho hội viên</h5>
                                @php
                                    $listPermissionID = $member->permission_id;
                                    $arrayPermissionID = null;
                                    if ($listPermissionID){
                                        $arrayPermissionID = explode(',', $listPermissionID);
                                    }
                                @endphp
                                <ol class="text-success">
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
                            </div>
                        </div>
                        <input type="text" hidden="" id="price" name="price"
                               value="0">
                        <p class="bg-success full-width p-3 ml-3 mr-3"></p>
                        <div class="mt-3 mb-3">
                            <h5 class="text-center">
                                Gia nhập hội viên {{$member->name}}
                                <p class="text-danger text-center">Price:
                                    ${{$member->price}}</p>
                            </h5>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('show.register.member.info', $member->id)}}"
                                   id="register" class="d-none btn btn-success mr-3">
                                    Đăng ký
                                </a>
                                <button id="register-btn" class="btn-hidden btn btn-secondary mr-3">
                                    Đăng ký
                                </button>
                            </div>
                        </div>
                        <p class="bg-success mt-3 full-width p-3 ml-3 mr-3"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validate() {
        var all = document.getElementById("all");
        if (all.checked) {
            document.getElementById("rules").checked = true;
            document.getElementById("getInfo").checked = true;
        } else {
            document.getElementById("rules").checked = false;
            document.getElementById("getInfo").checked = false;
        }

        toggle();
    }

    function validateAll() {
        var all = document.getElementById("all");
        var rules = document.getElementById("rules");
        var getInfo = document.getElementById("getInfo");
        all.checked = !!(rules.checked && getInfo.checked);

        toggle();
    }

    function toggle() {
        var all = document.getElementById("all");
        if (all.checked) {
            document.getElementById("register").classList.remove('d-none');
            document.getElementById("register-btn").classList.add('d-none');
        } else {
            document.getElementById("register").classList.add('d-none');
            document.getElementById("register-btn").classList.remove('d-none');
        }
    }
</script>

