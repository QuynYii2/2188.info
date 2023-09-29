@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

@extends('backend.layouts.master')

@section('content')

    <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
        <h5 class="card-title">{{ __('home.Thêm mới nhập kho') }}</h5>
        @if (session('success_update_product'))
            <div class="alert alert-success">
                {{ session('success_update_product') }}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <form action="{{ route('storage.manage.store') }}" method="post" enctype="multipart/form-data"
              class="form-horizontal row" role="form">
            @csrf
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('error_create_product') }}
                </div>
            @endif
            <div class="col-12 col-sm-12 border-right mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <div class="name">{{ __('home.Tên sản phẩm') }}</div>
                    <input type="text" class="form-control" name="name" id="name" placeholder={{ __('home.Nhập tên sản phẩm') }} required>
                </div>
                <div class="form-group row">
                    <div class="col-4 d-inline-block">
                        <div class="control-label small name" for="price">{{ __('home.Giá bán') }}</div>
                        <input type="number" class="form-control" required name="price" id="price"
                               placeholder={{ __('home.Nhập giá bán') }} >
                    </div>
                    <div class="col-4 d-inline-block">
                        <div class="control-label small name" for="quantity">{{ __('home.Số lượng') }}</div>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder={{ __('home.Nhập số lượng') }}>
                    </div>
                    <div class="col-4 d-inline-block">
                        <div class="control-label small name" for="origin">{{ __('home.Xuất xứ') }}</div>
                        <input type="text" class="form-control" name="origin" id="origin" placeholder={{ __('home.Nhập xuất xứ') }}>
                    </div>
                </div>
                <div class="form-group col-12 col-sm-12 ">
                    <label for="gallery">{{ __('home.Tên sản phẩm') }}{{ __('home.Ảnh sản phẩm') }}</label>
                    <label class='__lk-fileInput'>
                        <span data-default='Choose file'>{{ __('home.Choose file') }}</span>
                        <input type="file" id="gallery" class="img-cfg" name="gallery[]" accept="image/*" multiple>
                    </label>
                </div>
            </div>
            <div class="form-group col-12 col-md-7 col-sm-8 ">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-success">{{ __('home.Gửi') }}</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('js/backend/storage_manage/create.js')}}"></script>
@endsection
