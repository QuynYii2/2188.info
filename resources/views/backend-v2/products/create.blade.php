@php
    use App\Models\Properties;use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

<style>

    .file-upload__label {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 30px;
        color: #000;
        font-size: 16px;
        left: 50%;
        padding: 5px 10px;
        cursor: pointer;
        outline: none;
        padding: 15px;
        pointer-events: none;
        position: absolute;
        text-align: center;
        top: 50%;
        -moz-transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-user-select: none;
        white-space: nowrap;
        width: 200px;
    }

    .file-upload__input {
        bottom: 0;
        color: transparent;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: relative;
        right: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .selected-image {
        border: 2px solid blue;
    }

    @media all {

        .media-frame-router {
            position: absolute;
            top: 50px;
            left: 200px;
            right: 0;
            height: 36px;
            z-index: 200;
        }

        .media-frame {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            font-size: 12px;
            -webkit-overflow-scrolling: touch;
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .media-modal-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: auto;
            min-height: 300px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .7);
            background: #fff;
            -webkit-font-smoothing: subpixel-antialiased;
        }

        .media-modal {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            font-size: 12px;
            -webkit-overflow-scrolling: touch;
            position: fixed;
            top: 30px;
            left: 30px;
            right: 30px;
            bottom: 30px;
            z-index: 160000;
        }

        .media-router .media-menu-item {
            position: relative;
            float: left;
            border: 0;
            margin: 0;
            padding: 8px 10px 9px;
            height: 18px;
            line-height: 1.28571428;
            font-size: 14px;
            text-decoration: none;
            background: 0 0;
            cursor: pointer;
            transition: none;
        }

        .media-menu-item:active, .media-menu-item:hover {
            color: #2271b1;
        }

        .attachments-wrapper {
            position: absolute;
            top: 72px;
            left: 0;
            right: 300px;
            bottom: 0;
            overflow: auto;
            outline: 0;
        }

        .media-frame .attachments-browser {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .media-frame-content {
            position: absolute;
            top: 84px;
            left: 200px;
            right: 0;
            bottom: 61px;
            height: auto;
            width: auto;
            margin: 0;
            overflow: auto;
            background: #fff;
            border-top: 1px solid #dcdcde;
        }

        .attachments {
            margin: 0;
            -webkit-overflow-scrolling: touch;
            padding: 2px 8px 8px;
        }

        .load-more-wrapper {
            clear: both;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
        }

        .load-more-wrapper:after {
            content: "";
            min-width: 100%;
            order: 1;
        }

        .attachment {
            position: relative;
            float: left;
            padding: 8px;
            margin: 0;
            color: #3c434a;
            list-style: none;
            text-align: center;
            -webkit-user-select: none;
            user-select: none;
            width: 25%;
            box-sizing: border-box;
        }

        .media-frame-content[data-columns="9"] .attachment {
            width: 11.11%;
        }

        .spinner {
            background: url(http://localhost/wordpress/wp-admin/images/spinner.gif) no-repeat;
            background-size: 20px 20px;
            display: inline-block;
            visibility: hidden;
            float: right;
            vertical-align: middle;
            opacity: .7;
            width: 20px;
            height: 20px;
            margin: 4px 10px 0;
            background-image: url("http://localhost/wordpress/wp-admin/images/spinner.gif");
            background-position-x: initial;
            background-position-y: initial;
            background-repeat-x: no-repeat;
            background-repeat-y: no-repeat;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
        }

        .spinner {
            background: url(http://localhost/wordpress/wp-includes/images/spinner.gif) no-repeat;
            background-size: 20px 20px;
            float: right;
            display: inline-block;
            visibility: hidden;
            opacity: .7;
            width: 20px;
            height: 20px;
            margin: 0;
            vertical-align: middle;
            background-image: url("http://localhost/wordpress/wp-includes/images/spinner.gif");
            background-position-x: initial;
            background-position-y: initial;
            background-repeat-x: no-repeat;
            background-repeat-y: no-repeat;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
        }

        .load-more-wrapper .load-more-count {
            min-width: 100%;
            margin: 0 0 1em;
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .hidden {
            display: none;
        }

        .load-more-wrapper .load-more {
            margin: 0;
        }

        .button.hidden {
            display: none;
        }

        .button:hover {
            background: #f0f0f1;
            border-color: #0a4b78;
            color: #0a4b78;
        }

        .load-more-wrapper .load-more-jump {
            margin: 0 0 0 12px;
        }

        .button:disabled, .button[disabled] {
            color: #a7aaad !important;
            border-color: #dcdcde !important;
            background: #f6f7f7 !important;
            box-shadow: none !important;
            cursor: default;
            transform: none !important;
        }

        .attachment-preview {
            position: relative;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, .1), inset 0 0 0 1px rgba(0, 0, 0, .05);
            background: #f0f0f1;
            cursor: pointer;
        }

        .attachment-preview:before {
            content: "";
            display: block;
            padding-top: 100%;
        }

        .attachment .thumbnail {
            overflow: hidden;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 1;
            transition: opacity .1s;
        }

        .attachment .thumbnail:after {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .1);
            overflow: hidden;
        }

        .attachment .thumbnail .centered {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: translate(50%, 50%);
        }


        .attachment .portrait img {
            max-width: 100%;
        }

        .attachment .thumbnail img {
            top: 0;
            left: 0;
            position: absolute;
        }

        .attachment .thumbnail .centered img {
            transform: translate(-50%, -50%);
        }

        .attachment .landscape img {
            max-height: 100%;
        }
    }


</style>

@extends('backend-v2.layouts.master')
@section('title')
    Create Product
@endsection
@php
    use Illuminate\Support\Facades\Auth;
    use App\Enums\PermissionUserStatus;

    if (auth()->check() != null){
        $permissionUsers = DB::table('permissions')
        ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
        ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
        ->select('permissions.*')
        ->get();
    } else {
        $permissionUsers[]= null;
    }

@endphp
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div id="wpcontent">
        <div id="wpbody" role="main">
            <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
                <h5 class="card-title">Thêm mới sản phẩm</h5>
                @if (session('success_update_product'))
                    <div class="alert alert-success">
                        {{ session('success_update_product') }}
                    </div>
                @endif
            </div>

            <div class="container-fluid">
                <form action="{{ route('product.v2.create') }}" method="post" enctype="multipart/form-data"
                      class="form-horizontal row" role="form">
                    @csrf
                    @if (session('success_update_product'))
                        <div class="alert alert-success">
                            {{ session('error_create_product') }}
                        </div>
                    @endif

                    <input type="text" hidden="" name="storage_id" value="{{$product->storage_id}}">
                    <input type="text" hidden="" name="qty" value="{{$product->qty}}">
                    <input type="text" hidden="" name="user_id" value="{{$product->user_id}}">
                    <input type="text" hidden="" name="location" value="{{$product->location}}">
                    <input type="text" hidden="" name="slug" value="{{$product->slug}}">

                    <div class="col-12 col-md-7 border-right mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">Tên sản phẩm</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm" value="{{$product->name}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <div class="name">Mã sản phẩm</div>
                            <input type="text" class="form-control" name="product_code" id="product_code"
                                   placeholder="Nhập mã sản phẩm" required value="{{$product->product_code}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả ngắn</label>
                            <textarea id="description" class="form-control description" name="description"
                                      rows="5">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description-detail">Mô tả chi tiết</label>
                            <textarea id="description-detail" class="form-control description" name="description-detail"
                                      rows="5">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="category_id">Danh mục sản phẩm</label>
                            <input type="text" class="form-control"
                                   required value="{{$product->category->name}}" disabled>
                            <input type="text" class="form-control" name="category_id" id="category_id"
                                   value="{{$product->category_id}}" hidden="">
                        </div>
                        <div class="form-group row">
                            @for($i = 0; $i< count($permissionUsers); $i++)
                                @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                                    <div class="col-4 d-flex">
                                        <label for="hot_product" class="col-8 col-sm-8">Sản phẩm hot</label>
                                        <div class="col-4 col-sm-4">
                                            <input class="form-control" type="checkbox" id="hot_product"
                                                   name="hot_product">
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endfor
                            @for($i = 0; $i< count($permissionUsers); $i++)
                                @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm nổi bật')
                                    <div class="col-4 d-flex">
                                        <label for="feature_product" class="col-8 col-sm-8">Sản phẩm nổi bật</label>
                                        <div class="col-4 col-sm-4">
                                            <input class="form-control" type="checkbox" id="feature_product"
                                                   name="feature_product">
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        @foreach($testArray as $item)
                            @php
                                $attributeProperty = explode(',', $item);
                            @endphp
                            <div class="form-group">
                                @foreach($attributeProperty as $attpro)
                                    @php
                                        $attproArray =  explode('-', $attpro);
                                        $attribue = \App\Models\Attribute::find($attproArray[0]);
                                        $property = Properties::find($attproArray[1]);
                                    @endphp
                                    <label for="attribute{{$item}}">{{$attribue->name}}</label>
                                    <input disabled class="form-control" name="attribute{{$item}}"
                                           id="attribute{{$item}}" value=" {{$property->name}}">
                                @endforeach
                            </div>
                            <a id="btnEdit{{$loop->index+1}}" onclick="showFormEdit({{$loop->index+1}});"
                               class="btn btn-primary">Editor</a>
                            <div id="formCreate{{$loop->index+1}}" class="d-none">
                                <div class="form-row">
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name" for="price">Giá bán</label>
                                        <input onchange="validInput({{$loop->index+1}});" type="number"
                                               class="value-check form-control" required
                                               name="old_price{{$loop->index+1}}"
                                               id="price{{$loop->index+1}}"
                                               placeholder="Nhập giá bán">
                                    </div>
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name" for="qty">Giá khuyến mãi</label>
                                        <input onchange="validInput({{$loop->index+1}});" type="number"
                                               class="value-check form-control"
                                               name="price{{$loop->index+1}}" id="qty{{$loop->index+1}}"
                                               placeholder="Nhập giá khuyến mãi">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-12 col-sm-12 pt-3">
                                        <label for="thumbnail">Ảnh đại diện:</label>
                                        <label class='__lk-fileInput'>
                                            <span data-default='Choose file'>Choose file</span>
                                            <input type="file" id="thumbnail" class="img-cfg"
                                                   name="thumbnail{{$loop->index+1}}"
                                                   accept="image/*"
                                                   required>
                                        </label>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 ">
                                        <label for="gallery">Thư viện ảnh:</label>
                                        @include('backend-v2.products.modal-media')
                                    </div>


                                </div>
                            </div>
                            <input type="text" hidden="" name="attribute_property{{$loop->index+1}}" value="{{$item}}">
                            <br>
                            <br>
                        @endforeach
                    </div>
                    <input type="text" hidden name="imgGallery" id="imgGallery" value="">

                    <input type="text" hidden="" name="count" value="{{count($testArray)}}">
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div><!-- wpbody -->
        <div class="clear"></div>
    </div><!-- wpcontent -->

    <form action="{{ route('file.img.save') }}" method="post" id="uploadForm" hidden>
        @csrf
        <input type="file" class="file-upload__input" name="uploaded_files[]" multiple id="uploaded_files">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showFormEdit(id) {
            var formEdit = document.getElementById('formCreate' + id);
            formEdit.classList.remove('d-none');
        }

        $('#btnSubmit').on('click', function () {
            checkValue();
        })

        function checkValue() {
            var inputValue = document.getElementsByClassName('value-check');
            for (let i = 0; i < inputValue.length; i++) {
                if (inputValue[i].value == '') {
                    alert('Vui lòng nhập đầy đủ thông tin sản phẩm')
                    break;
                }
            }
        }

        function validInput(id) {
            var priceInput = document.getElementById('price' + id);
            var qtyInput = document.getElementById('qty' + id);

            function checkPrice() {
                var price = parseFloat(priceInput.value);
                var qty = parseFloat(qtyInput.value);

                if (qty > price) {
                    alert('Giá khuyến mãi không được lớn hơn giá bán.');
                    qtyInput.value = '';
                }
            }
        }

    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description-detail'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
