@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp
<style>
    .upload__box {
        padding: 40px;
    }

    .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn {
        display: inline-block;
        font-weight: 600;
        color: #fff;
        text-align: center;
        min-width: 116px;
        padding: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        background-color: #4045ba;
        border-color: #4045ba;
        border-radius: 10px;
        line-height: 26px;
        font-size: 14px;
    }

    .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
    }

    .upload__btn-box {
        margin-bottom: 10px;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

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
{{--                    <div class="upload__box">--}}
{{--                        <div class="upload__btn-box">--}}
{{--                            <label class="upload__btn">--}}
{{--                                <p>Upload images</p>--}}
{{--                                <input type="file" multiple name="gallery[]" id="gallery" data-max_length="20"--}}
{{--                                       accept="image/*" class="upload__inputfile">--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="upload__img-wrap">--}}
{{--                                                    @php--}}
{{--                                                        $input = $storage->gallery;--}}
{{--                                                        $array = json_decode($input, true);--}}
{{--                                                        $modifiedArray = explode(",", $input);--}}
{{--                                                    @endphp--}}
{{--                                                    @foreach($modifiedArray as $image )--}}
{{--                                                        <div class='upload__img-box'><div style='background-image: url({{ asset('storage') . '/' . $image }})' data-number="1" data-file="1" class='img-bg'><div class='upload__img-close'></div></div></div>--}}
{{--                                                    @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="form-group col-12 col-md-7 col-sm-8 ">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-success">{{ __('home.Gửi') }}</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>


        $(function () {
            $('input.img-cfg').change(function () {
                const label = $(this).parent().find('span');
                let name = '';
                if (typeof (this.files) != 'undefined') {
                    let lengthListImg = this.files.length;
                    if (lengthListImg === 0) {
                        label.removeClass('withFile').text(label.data('default'));
                    } else {
                        name = lengthListImg === 1 ? lengthListImg + ' file' : lengthListImg + ' files';
                        let size = 0;
                        for (let i = 0; i < this.files.length; i++) {
                            const file = this.files[i];
                            let sizeImg = (file.size / 1048576).toFixed(3);
                            size = size + Number(sizeImg);
                        }
                        label.addClass('withFile').text(name + ' (' + size + 'mb)');
                    }
                } else {
                    name = this.value.split("\\");
                    label.addClass('withFile').text(name[name.length - 1]);
                }
                return false;
            });
        });

        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];
            @php
                $input = $storage->gallery;
                $array = json_decode($input, true);
                $modifiedArray = explode(",", $input);
            @endphp
            @foreach($modifiedArray as $img)
            imgArray.push('{{ $img }}')
            @endforeach

            for (let i = 0; i < imgArray; i++) {

            }
            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');
                    var html = "";
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";

                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }

    </script>
@endsection
