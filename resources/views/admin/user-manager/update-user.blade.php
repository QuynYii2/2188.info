@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div class="">
        <h3 class="text-center mt-3">User More Information</h3>
        <a class="btn btn-info" href="{{route('admin.list.users')}}">Quay lại danh sách</a>
    </div>
    <div class="container">
        <form action="{{route('admin.update.users', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">FullName</label>
                    <input required type="text" class="form-control" id="name" name="name" placeholder="Full Name"
                           value="{{$user->name}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" id="email" name="email" placeholder="Email"
                           value="{{$user->email}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">PhoneNumber</label>
                    <input required type="text" class="form-control" id="phone" name="phone" placeholder="06845655"
                           value="{{$user->phone}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="password">Password</label>
                    <input required type="password" class="form-control" id="password" name="password">
                    <input type="checkbox" id="inputCheckboxPassword">
                    <label for="inputCheckboxPassword">
                        Không cập nhập password
                    </label>
                </div>
                <div class="form-group col-md-4">
                    <label for="role">Role</label>
                    <select id="role" class="form-control" name="role">
                        @if($isAdmin == true)
                            <option value="ADMIN">ADMIN</option>
                            <option value="SELLER">SELLER</option>
                            <option value="USER">USER</option>
                        @elseif($isAdmin == false && $isSeller == true)
                            <option value="SELLER">SELLER</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="USER">USER</option>
                        @else
                            <option value="USER">USER</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="SELLER">SELLER</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Status</label>
                    <select id="inputState" class="form-control" name="status">
                        @if($user->status == \App\Enums\UserStatus::ACTIVE)
                            <option value="{{\App\Enums\UserStatus::ACTIVE}}">ACTIVE</option>
                            <option value="{{\App\Enums\UserStatus::INACTIVE}}">INACTIVE</option>
                            <option value="{{\App\Enums\UserStatus::BAN}}">BAN</option>
                        @elseif($user->status == \App\Enums\UserStatus::INACTIVE)
                            <option value="{{\App\Enums\UserStatus::INACTIVE}}">INACTIVE</option>
                            <option value="{{\App\Enums\UserStatus::ACTIVE}}">ACTIVE</option>
                            <option value="{{\App\Enums\UserStatus::ACTIVE}}">BAN</option>
                        @else
                            <option value="{{\App\Enums\UserStatus::BAN}}">BAN</option>
                            <option value="{{\App\Enums\UserStatus::ACTIVE}}">ACTIVE</option>
                            <option value="{{\App\Enums\UserStatus::ACTIVE}}">INACTIVE</option>
                        @endif
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <div class="row mb-3">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex justify-content-between align-items-center">
                <a href="{{route('admin.detail.users.company', $user->id)}}" class="btn btn-warning">Xem thông tin công ty</a>
                <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#inputCheckboxPassword').on('change', function () {
                if ($('#inputCheckboxPassword').is(':checked')) {
                    $('#password').prop('disabled', true);
                    $('#password').prop('required', false);
                } else {
                    $('#password').prop('disabled', false);
                    $('#password').prop('required', true);
                }
            })
        })
    </script>
@endsection
