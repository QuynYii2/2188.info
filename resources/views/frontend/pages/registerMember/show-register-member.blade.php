@extends('frontend.layouts.master')

@section('title', 'Register Member')

<style>
    .btn-hidden:hover {
        cursor: not-allowed !important;
    }

    .border-bottom {
        width: 100%;
        border-bottom: 5px solid black;
        margin-bottom: 16px;
    }
</style>

@section('content')
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="form-title text-center">
                <h3 style="font-size: 36px">{{ __('home.commit member') }}</h3>
            </div>
            <div class="mt-3">
                <div class="text-center solid p-3 ml-3 mr-3 " style="font-size: 35px; font-weight: 600">
                    <p class="text-primary">
                        @if($member->name == \App\Enums\RegisterMember::LOGISTIC)
                            {{ __('home.commit member logistic') }}
                        @elseif($member->name == \App\Enums\RegisterMember::TRUST)
                            {{ __('home.commit member trust') }}
                        @else
                            {{ __('home.commit member buyer') }}
                        @endif
                    </p>
                </div>
                <div class="row ml-3 mr-3">
                    <div class="col-md-6 solid-3 pt-4 pl-0 pr-0">
                        <h5 class="text-center mix-3 pb-2">{{ __('home.Check the rules you must agree to below') }}</h5>
                        <div class="rules mix-3 pb-5" onclick="validateAll()">
                            <div class="ml-3">
                                <p class="text-warning" style="font-size: 18px">
                                    {{ __('home.Agree to Terms') }}
                                </p>
                                <p class="float-right mr-3">
                                    <input type="checkbox" id="rules" name="rules" required>
                                    <label for="rules">  {{ __('home.I agree to the above Terms') }}</label><br>
                                </p>
                            </div>
                        </div>
                        <div class="getInfo mix-3 pb-5 " onclick="validateAll()">
                            <div class="ml-3">
                                <p class="text-warning" style="font-size: 18px">
                                    {{ __('home.Agree to the Information Collection Policy') }}
                                </p>
                                <p class="float-right mr-3">
                                    <input type="checkbox" id="getInfo" name="getInfo" required>
                                    <label for="getInfo"> {{ __('home.I agree to the above Terms') }}</label><br>
                                </p>
                            </div>
                        </div>
                        <div class="trustInfo pb-3" onclick="validateAll()">
                            <div class="ml-3">
                                <p class="text-warning" style="font-size: 18px">
                                    {{ __('home.Agree to the Terms of Information Use') }}
                                </p>
                                <p class="float-right mr-3">
                                    <input type="checkbox" id="trustInfo" name="trustInfo" required>
                                    <label for="trustInfo"> {{ __('home.I agree to the above Terms') }}</label><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 solid-2 pt-4 pl-0 pr-0">
                        <h5 class="text-center mix-3 pb-2">{{ __('home.Main function only for members') }}</h5>
                        @php
                            $listPermissionID = $member->permission_id;
                            $arrayPermissionID = null;
                            if ($listPermissionID){
                                $arrayPermissionID = explode(',', $listPermissionID);
                            }
                        @endphp
                        <ol class="text-success">
                            <li>{{__('home.permission_one')}}</li>
                            <li>{{__('home.permission_two')}}</li>
                            <li>{{__('home.permission_there')}}</li>
                        </ol>
                    </div>
                </div>
                <input type="text" hidden="" id="price" name="price"
                       value="0">
                <div class="solid-3 ml-3 mr-3">
                    <p class="bg-member-green p-4 mix-3"></p>
                    <div class="row text-center p-3">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="all" onclick="validate()">
                            <span class="text-warning mr-4">
                                {{ __('home.Agree all') }}
                            </span>
                                <input type="checkbox" id="all" name="all">
                                <label for="all"> {{ __('home.all') }}</label><br>
                            </div>
                            <a href="{{route('show.register.member.info', $member->id)}}"
                               id="register" class="d-none btn btn-success mr-3 btn-register">
                                {{ __('home.sign up') }}
                            </a>
                            <button id="register-btn" class="btn-hidden btn btn-secondary mr-3 btn-register">
                                {{ __('home.sign up') }}
                            </button>
                        </div>
                    </div>
                    <p class="bg-member-green p-4 mb-0 mt-3 "></p>
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
            document.getElementById("trustInfo").checked = true;
        } else {
            document.getElementById("rules").checked = false;
            document.getElementById("getInfo").checked = false;
            document.getElementById("trustInfo").checked = false;
        }

        toggle();
    }

    function validateAll() {
        var all = document.getElementById("all");
        var rules = document.getElementById("rules");
        var getInfo = document.getElementById("getInfo");
        var trustInfo = document.getElementById("trustInfo");
        all.checked = !!(rules.checked && getInfo.checked && trustInfo.checked);

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

