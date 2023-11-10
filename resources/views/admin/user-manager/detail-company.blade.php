@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div class="">
        <h3 class="text-center mt-3">Company Information</h3>
        <a class="btn btn-info" href="{{route('admin.list.users')}}">{{ __('home.Quay lại danh sách') }}</a>
    </div>
    <div class="container">
        @if($company)
            <form action="{{route('admin.edit.users.company', $company->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name_kr">Name KOREA</label>
                        <input required type="text" class="form-control" id="name_kr" name="name_kr"
                               placeholder="Name KOREA"
                               value="{{$company->name_kr}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name_en">Name ENGLISH</label>
                        <input required type="text" class="form-control" id="name_en" name="name_en"
                               placeholder="Name ENGLISH"
                               value="{{$company->name_en}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone">PhoneNumber</label>
                        <input required type="text" class="form-control" id="phone" name="phone" placeholder="06845655"
                               value="{{$company->phone}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input required type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"
                           value="{{$company->address}}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="member">Member</label>
                        <input required type="text" class="form-control" id="member" name="member"
                               value="{{$company->member}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                            @if($company->status == \App\Enums\MemberRegisterInfoStatus::ACTIVE)
                                <option value="{{\App\Enums\MemberRegisterInfoStatus::ACTIVE}}">ACTIVE</option>
                                <option value="{{\App\Enums\MemberRegisterInfoStatus::INACTIVE}}">INACTIVE</option>
                            @else
                                <option value="{{\App\Enums\MemberRegisterInfoStatus::ACTIVE}}">INACTIVE</option>
                                <option value="{{\App\Enums\MemberRegisterInfoStatus::ACTIVE}}">ACTIVE</option>
                            @endif
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        @endif
        <div class="row mb-3">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex justify-content-between align-items-center">
                <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

@endsection
