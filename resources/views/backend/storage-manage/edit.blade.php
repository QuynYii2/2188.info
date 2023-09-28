@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp
<style>

    .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__img-close:after {
        content: "✖";
        font-size: 14px;
        color: white;
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }
</style>
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
        <form action="{{ route('storage.manage.update', $storage->id ) }}" method="post" enctype="multipart/form-data"
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
                    <input type="text" class="form-control" name="name" id="name" value="{{ $storage->name }}"
                           placeholder="Nhập tên sản phẩm" required>
                </div>
                <div class="form-group row">
                    <div class="col-4 d-inline-block">
                        <div class="control-label small name" for="price">{{ __('home.Giá bán') }}</div>
                        <input type="number" class="form-control" required name="price" id="price"
                               value="{{ $storage->price }}"
                               placeholder="Nhập giá bán">
                    </div>
                    <div class="col-4 d-inline-block">
                        <div class="control-label small name" for="quantity">{{ __('home.Số lượng') }}</div>
                        <input type="number" class="form-control" name="quantity" id="quantity"
                               placeholder="Nhập số lượng" value="{{ $storage->quantity }}">
                    </div>
                    <div class="col-4 d-inline-block">
                        <div class="control-label small name" for="origin">{{ __('home.Xuất xứ') }}</div>
                        <input type="text" class="form-control" name="origin" id="origin" placeholder="Nhập Xuất xứ"
                               value="{{ $storage->origin }}">
                    </div>
                </div>
                <div class="form-group col-12 col-sm-12 ">
                    <label for="gallery">{{ __('home.Ảnh sản phẩm') }}</label>
                                        <label class='__lk-fileInput'>
                                            <span data-default='Choose file'>Choose file</span>
                                            <input type="file" id="gallery" class="img-cfg" name="gallery[]" accept="image/*" multiple>
                                        </label>
                    @php
                        $input = $storage->gallery;
                        $array = json_decode($input, true);
                        $modifiedArray = explode(",", $input);
                    @endphp
                    @if ($storage->gallery )
                        @foreach ($modifiedArray as $image)
                            <a href="{{ asset('storage/' . $image) }}" data-fancybox="group"
                               data-caption="This image has a caption 1">
                                <img class="mt-2" style="height: 100px; width: 100px "
                                     src="{{ asset('storage/' . $image) }}" alt="Gallery Image" width="100">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-group col-12 col-md-7 col-sm-8 ">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-success">{{ __('home.Gửi') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
