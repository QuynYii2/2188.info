@extends('backend.layouts.master')
@section('title')
    User Manager
@endsection
@section('content')
    <div class="container">
        <h3 class="text-center mt-3">{{ __('home.info_company') }}</h3>
        <a class="btn btn-info" href="{{route('admin.list.users')}}">{{ __('home.back_to') }}</a>
    </div>
    <div class="container">
        <form action="{{route('admin.edit.users', $user->id)}}" method="post" enctype="multipart/form-data">
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
                    <input required type="email" disabled class="form-control" id="email" placeholder="Email"
                           value="{{$user->email}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="phone">PhoneNumber</label>
                    <input required type="text" class="form-control" id="phone" name="phone" placeholder="06845655"
                           value="{{$user->phone}}">
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input required type="text" class="form-control" id="address" name="address" placeholder="1234 Main St"
                       value="{{$user->address}}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="region">Region</label>
                    <input required type="text" class="form-control" id="region" name="region"
                           value="{{$user->region}}">
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
                <div class="form-group col-md-4">
                    <label for="thumbnail">Image</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                    <img width="100px" height="100px" src="{{ asset('storage/'.$user->image) }}" alt="Avatar">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
        <div class="row mb-3">
            <div class="col-md-6"></div>
            <div class="col-md-6 d-flex justify-content-between align-items-center">
                <a href="{{route('admin.detail.users.company', $user->id)}}" class="btn btn-warning">{{ __('home.info_company') }}</a>
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-secondary">{{ __('home.edit_user_up') }}
                </button>
                <form action="{{route('admin.delete.users', $user->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông tin cao cấp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Chỉnh sửa thông tin quan trọng bao gồm: mật khẩu, quyền hạn của user</h5>
                    <p>Điều này sẽ có thể ảnh hướng đến hoạt động của user và dự án</p>
                    <p class="text-danger">(Chúng tôi không khuyến khích điều này)</p>
                    <div class="form-check">
                        <input type="checkbox" id="inputCheckboxApply">
                        <label for="inputCheckboxApply">
                            Tôi đã hiểu
                        </label>
                    </div>
                    <a id="btnContinue" class="btn btn-primary mt-3">Continue</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#inputCheckboxApply').on('change', function () {
                if ($('#inputCheckboxApply').is(':checked')) {
                    let url = '{{route('admin.private.update.users', $user->id)}}';
                    $('#btnContinue').attr("href", url);
                } else {
                    $('#btnContinue').attr("href", '');
                }
            })
        })
    </script>
@endsection
