@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div class="container-fluid p-3 bg-white">
        <a class="back text-black d-flex align-items-center" href="{{route('admin.list.users')}}">
            <i class="fa-solid fa-angle-left mr-2" style="font-size: 20px"></i>
            <span class="s24w6">{{ __('home.back_to') }}</span>
        </a>
        <h5 class="text-center s20w6 mt-3">{{ __('home.detail_account') }}</h5>
        <form action="{{route('admin.update.users', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="s12w6" for="name">FullName</label>
                    <input disabled required type="text" class="form-control input-custom" id="name" name="name"
                           placeholder="Full Name"
                           value="{{$user->name}}">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="email">Email</label>
                    <input disabled required type="email" class="form-control input-custom" id="email" name="email"
                           placeholder="Email"
                           value="{{$user->email}}">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="phone">PhoneNumber</label>
                    <input disabled required type="text" class="form-control input-custom" id="phone" name="phone"
                           placeholder="06845655"
                           value="{{$user->phone}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="s12w6" for="password">Password</label>
                    <input disabled type="password" class="form-control input-custom" id="password" name="password">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="password_confirm">Password Confirm</label>
                    <input disabled type="password" class="form-control input-custom" id="password_confirm"
                           name="password_confirm">
                </div>
                <div class="form-group col-md-4">
                    <label class="s12w6" for="new_password_confirm">New Password Confirm</label>
                    <input disabled type="password" class="form-control input-custom" id="new_password_confirm"
                           name="new_password_confirm">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label class="s12w6" for="address">Address</label>
                    <input disabled required type="text" class="form-control input-custom" id="address" name="address"
                           placeholder="1234 Main St"
                           value="{{$user->address}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="role">Role</label>
                    <select disabled id="role" class="form-control input-custom" name="role">
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
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class="s12w6" for="inputRegion">Region</label>
                    <select disabled id="inputRegion" class="form-control input-custom" name="region">
                        <option {{ $user->region == 'kr' ? 'selected' : '' }}
                                value="kr">
                            Korea
                        </option>
                        <option {{ $user->region == 'vn' ? 'selected' : '' }}
                                value="vn">
                            Viet Nam
                        </option>
                        <option {{ $user->region == 'cn' ? 'selected' : '' }}
                                value="cn">
                            China
                        </option>
                        <option {{ $user->region == 'jp' ? 'selected' : '' }}
                                value="jp">
                            Japan
                        </option>
                        <option {{ $user->region == 'en' ? 'selected' : '' }}
                                value="en">
                            Other
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="s12w6" for="thumbnail">Image</label>
                    <input disabled type="file" class="form-control input-custom" id="thumbnail" name="thumbnail"
                           accept="image/*">
                    <img width="100px" height="100px" src="{{ asset('storage/'.$user->image) }}" alt="Avatar">
                </div>
                <div class="form-group col-md-3">
                    <label class="s12w6" for="inputMember">Member</label>
                    <select id="inputMember" class="form-control input-custom" name="member">
                        <option {{ $user->member == \App\Enums\RegisterMember::LOGISTIC ? 'selected' : '' }}
                                value="{{\App\Enums\RegisterMember::LOGISTIC}}">
                            LOGISTIC
                        </option>
                        <option {{ $user->member == \App\Enums\RegisterMember::TRUST ? 'selected' : '' }}
                                value="{{\App\Enums\RegisterMember::TRUST}}">
                            TRUST
                        </option>
                        <option {{ $user->member == \App\Enums\RegisterMember::BUYER ? 'selected' : '' }}
                                value="{{\App\Enums\RegisterMember::BUYER}}">
                            BUYER
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label class="s12w6" for="inputState">Status</label>
                    <select id="inputState" class="form-control input-custom" name="status">
                        <option {{ $user->status == \App\Enums\UserStatus::ACTIVE ? 'selected' : '' }}
                                value="{{\App\Enums\UserStatus::ACTIVE}}">
                            ACTIVE
                        </option>
                        <option {{ $user->status == \App\Enums\UserStatus::INACTIVE ? 'selected' : '' }}
                                value="{{\App\Enums\UserStatus::INACTIVE}}">
                            INACTIVE
                        </option>
                        <option {{ $user->status == \App\Enums\UserStatus::BAN ? 'selected' : '' }}
                                value="{{\App\Enums\UserStatus::BAN}}">
                            BAN
                        </option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btnCreateDefault">Save</button>
        </form>
        <div class="row mb-3 mt-5">
            <div class="col-md-6 d-flex align-items-center">
                <a href="{{route('admin.detail.users.company', $user->id)}}"
                   class="btn btn-warning">{{ __('home.info_company') }}</a>
                <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin/update-user.js') }}"></script>
@endsection