@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp
@extends('backend.layouts.master')
@section('content')
    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
        <h5 class="card-title">{{ __('home.Add new products') }}</h5>
        @if (session('success_update_product'))
            <div class="alert alert-success">
                {{ session('success_update_product') }}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <form action="{{ route('staff.manage.store') }}" method="post" enctype="multipart/form-data"
              class="form-horizontal row" role="form">
            @csrf
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('error_create_product') }}
                </div>
            @endif

            <div class="col-6 col-sm-6 mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <div class="name">{{ __('home.Position') }}</div>
                    <select class="form-control" name="chuc_vu" id="chuc_vu">
                        <option value="1">{{ __('home.Representative') }}</option>
                        <option value="1">{{ __('home.Manager') }}</option>
                    </select>

                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.full name') }}</div>
                    <input type="text" class="form-control" name="name" id="name"
                           placeholder={{ __('home.Nhập Họ tên') }} required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.phone number') }}</div>
                    <input type="text" class="form-control" name="phone" id="phone"
                           placeholder="{{ __('home.Nhập số điện thoại') }}" required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.social network id') }}</div>
                    <input type="text" class="form-control" name="social_media" id="social_media"
                           placeholder={{ __('home.Nhập id mxh') }} required>
                </div>

                <input type="text" hidden name="type_account" id="type_account"
                       value="seller">
            </div>
            <div class="col-6 col-sm-6 mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <div class="name">{{ __('home.Responsibility') }}</div>
                    <select class="form-control" name="phu_trach" id="phu_trach">
                        <option value="1">{{ __('home.Representative') }}</option>
                        <option value="1">{{ __('home.Subscribers') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.Nickname') }}</div>
                    <input type="text" class="form-control" name="nickname" id="nickname"
                           placeholder={{ __('home.Nhập biệt danh') }} required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.email') }}</div>
                    <input type="text" class="form-control" name="email" id="email"
                           placeholder={{ __('home.Nhập email') }} required>
                </div>
                <div class="form-group">
                    <div class="name">{{ __('home.Password') }}</div>
                    <input type="password" class="form-control" name="password" id="password" placeholder={{ __('home.Nhập mật khẩu') }}
                           required>
                </div>
            </div>


            <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
            <div class="form-group col-12 col-md-7 col-sm-8 ">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-success">{{ __('home.Gửi') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
