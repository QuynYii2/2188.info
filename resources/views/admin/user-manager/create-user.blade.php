@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <h3 class="text-center">Create User</h3>
    <div class="container">
        <form method="post" action="{{route('admin.create.users')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">FullName</label>
                    <input required type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">PhoneNumber</label>
                    <input required type="text" class="form-control" name="phone" id="phone" placeholder="012345678910">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" name="email" id="email"
                           placeholder="email@example.com">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input required type="password" class="form-control" name="password" id="password"
                           placeholder="password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="region">Region</label>
                    <select id="region" class="form-control" name="region">
                        <option value="kr">Korea</option>
                        <option value="cn">China</option>
                        <option value="jp">Japan</option>
                        <option value="vi">VietNam</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_of_birth">Birthday</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                           placeholder="Birthday">
                </div>
                <div class="form-group col-md-3">
                    <label for="type_account">TypeAccount</label>
                    <select id="type_account" class="form-control" name="type_account">
                        <option value="personal">Personal</option>
                        <option value="business">Business</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input required type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="image">Avatar</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="form-group col-md-3">
                    <label for="status">Status</label>
                    <select id="status" class="form-control" name="status">
                        <option value="{{\App\Enums\UserStatus::ACTIVE}}">{{\App\Enums\UserStatus::ACTIVE}}</option>
                        <option value="{{\App\Enums\UserStatus::INACTIVE}}">{{\App\Enums\UserStatus::INACTIVE}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="member">Member</label>
                    <select id="member" class="form-control" name="member">
                        @if($members->isNotEmpty())
                            @foreach($members as $member)
                                <option value="{{$member->id}}">{{$member->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="role">Role</label>
                    <select id="role" class="form-control" name="role">
                        <option value="BUYER">BUYER</option>
                        <option value="SELLER">SELLER</option>
                        <option value="SELLER">ADMIN</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
