@extends('frontend.layouts.master')

@section('title', 'Register Member')

@section('content')
    <?php
    $trans = \App\Http\Controllers\TranslateController::getInstance();
    ?>
    <link rel="stylesheet" href="{{asset('css/register_member.css')}}">
    <div class="start-page mb-3">
        <div class="background container-fluid pt-3 justify-content-center pb-3">
            <div class="row card border">
                <div class="form-title text-center pt-2">
                    <div class="title">Đăng kí thông tin người đăng kí cho hội viên {{ $trans->translateText($registerMember) }}</div>
                </div>
                <div class="mt-5">
                    <form class="p-3" action="{{route('register.member.source')}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="passwordConfirm">Password Confirm</label>
                                <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm"
                                       required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phoneNumber">PhoneNumber</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rank">Rank</label>
                                <select id="rank" name="rank" class="form-control">
                                    <option value="staff">Staff</option>
                                    <option value="seo">SEO</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="member" value="{{$member}}" hidden="">
                        <div class="form-group">
                            <label for="sns_account">SNS Account</label>
                            <input type="text" class="form-control" id="sns_account" name="sns_account" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>

