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
            <div class="form-title text-center">
                <h3>{{ __('home.sign up member') }}</h3>
            </div>
            <div class="mt-3">
                <div class="text-center mb-4">
                    {{ __('home.Agree to the terms and conditions of the member') }} {{$member->name}}
                </div>
                <div class="row ml-3 mr-3">
                    <div class="col-md-6 border pt-4">
                        <h5 class="text-center">{{ __('home.Check the rules you must agree to below') }}</h5>
                        <div class="rules" onclick="validateAll()">
                            <p class="text-warning">
                                {{ __('home.Agree to Terms') }}
                            </p>
                            <input type="checkbox" id="rules" name="rules" required>
                            <label for="rules">  {{ __('home.I agree to the above Terms') }}</label><br>
                        </div>
                        <div class="getInfo" onclick="validateAll()">
                            <p class="text-warning">
                                {{ __('home.Agree to the Information Collection Policy') }}
                            </p>
                            <input type="checkbox" id="getInfo" name="getInfo" required>
                            <label for="getInfo"> {{ __('home.I agree to the above Terms') }}</label><br>
                        </div>
                        <div class="trustInfo" onclick="validateAll()">
                            <p class="text-warning">
                                {{ __('home.Agree to the Terms of Information Use') }}
                            </p>
                            <input type="checkbox" id="trustInfo" name="trustInfo" required>
                            <label for="getInfo"> {{ __('home.I agree to the above Terms') }}</label><br>
                        </div>
                        <div class="all" onclick="validate()">
                            <p class="text-warning">
                                {{ __('home.Agree all') }}
                            </p>
                            <input type="checkbox" id="all" name="all">
                            <label for="all"> {{ __('home.all') }}</label><br>
                        </div>
                    </div>
                    <div class="col-md-6 border pt-4">
                        <h5 class="text-center">{{ __('home.Main function only for members') }}</h5>
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
                <p class="bg-success full-width p-3 ml-3 mr-3"></p>
                <div class="mt-3 mb-3">
                    <h5 class="text-center">
                        {{ __('home.Join member') }} {{$member->name}}
                        <p class="text-danger text-center">{{ __('home.Price') }}:
                            ${{$member->price}}</p>
                    </h5>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('show.register.member.info', $member->id)}}"
                           id="register" class="d-none btn btn-success mr-3">
                            {{ __('home.sign up') }}
                        </a>
                        <button id="register-btn" class="btn-hidden btn btn-secondary mr-3">
                            {{ __('home.sign up') }}
                        </button>
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

