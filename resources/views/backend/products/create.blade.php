@php
    use Illuminate\Support\Facades\DB;
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
@extends('backend.layouts.master')

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
                <form action="{{ route('seller.products.store') }}" method="post" enctype="multipart/form-data"
                      class="form-horizontal row" role="form">
                    @csrf
                    @if (session('success_update_product'))
                        <div class="alert alert-success">
                            {{ session('error_create_product') }}
                        </div>
                    @endif

                    <div class="col-12 col-md-7 border-right mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">Chọn sản phẩm từ kho</div>
                            <div class="main">
                                <select id="selectStorage" name="storage-id" class="form-control">
                                    @foreach($storages as $storage)
                                        <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="name">Tên sản phẩm</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm"
                                   required>
                        </div>
                        <div class="form-group">
                            <div class="name">Mã sản phẩm</div>
                            <input type="text" class="form-control" name="product_code" id="product_code"
                                   placeholder="Nhập mã sản phẩm" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả ngắn</label>
                            <textarea id="description" class="form-control description" name="description"
                                      rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description-detail">Mô tả chi tiết</label>
                            <textarea id="description-detail" class="form-control description" name="description-detail"
                                      rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        <div class="form-group" id="cat-parameter">
                            <label for="selectCategory">Chuyên mục:</label>
                            <select class="form-control" name="category_id" id="selectCategory">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group  p-3 mt-3">
                            <label class="name">Thông số sản phẩm</label>
                            <select class="form-control" name="attribute_id" id="selectAttribute">
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="border mt-5 mb-3 full-width">
                            @foreach($attributes as $attribute)
                                @php
                                    $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                                @endphp
                                @if(!$properties->isEmpty())
                                    <div id="attributeID_{{$attribute->id}}" class="d-none">
                                        <label class="name" for="date_start">{{$attribute->name}}</label>
                                        <input type="text" class="form-control"
                                               onclick="showDropdown('attribute_property{{$attribute->id}}', 'attribute_property-dropdownList{{$attribute->id}}')"
                                               disabled id="attribute_property{{$attribute->id}}" required>
                                        <div class="dropdown-content"
                                             id="attribute_property-dropdownList{{$attribute->id}}">
                                            <label>
                                                @foreach($properties as $property)
                                                    <input class="property-attribute checkbox{{$attribute->id}}"
                                                           type="checkbox"
                                                           value="{{$attribute->id}}-{{$property->id}}"
                                                           name="property-{{$attribute->id}}"
                                                           onchange="updateSelectedOptions(this, 'attribute_property{{$attribute->id}}', 'attribute_property-dropdownList{{$attribute->id}}')">
                                                    {{$property->name}}
                                                @endforeach
                                            </label>
                                        </div>
                                        <div class="">
                                            <a class="btn btn-primary addALlNavberBtn">
                                                SelectAll
                                            </a>
                                            <a class="btn btn-warning removeAllNavberBtn">
                                                Remove All
                                            </a>
                                            <a class="btn btn-secondary hiddenNavberBtn">
                                                Hidden
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <a id="btnSaveAttribute" class="btn btn-success mt-2 mb-5">SaveAttribute</a>

                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12 ">
                                <label for="gallery">Thư viện ảnh:</label>
                                @include('backend.products.modal-media')
                            </div>
                        </div>

                        <div class="border">
                            <div class="col-sm-12 d-inline-block ">
                                <label class="name" for="date_start">Hình thức thanh toán</label>
                                <input type="text" class="form-control"
                                       onclick="showDropdown('payment-method', 'payment-dropdownList')"
                                       placeholder="Chọn hình thức thanh toán" id="payment-method" required>
                                <div class="dropdown-content" id="payment-dropdownList">
                                    <label>
                                        <input type="checkbox" value="option1"
                                               onchange="updateSelectedOptions(this, 'payment-method', 'payment-dropdownList')">
                                        Nhận hàng thanh toán
                                    </label>
                                    <label>
                                        <input type="checkbox" value="option2"
                                               onchange="updateSelectedOptions(this, 'payment-method', 'payment-dropdownList')">
                                        Thanh toán thẻ nội địa
                                    </label>
                                    <label>
                                        <input type="checkbox" value="option3"
                                               onchange="updateSelectedOptions(this, 'payment-method', 'payment-dropdownList')">
                                        Thanh toán qua paypal
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12 d-inline-block">
                                <label class="control-label small" for="date_start">Hình thức vận chuyển</label>
                                <input type="text" class="form-control"
                                       onclick="showDropdown('transport-method', 'transport-dropdownList')"
                                       placeholder="Chọn hình thức vận chuyển" id="transport-method" required>
                                <div class="dropdown-content" id="transport-dropdownList">
                                    <label>
                                        <input type="checkbox" value="option1"
                                               onchange="updateSelectedOptions(this, 'transport-method', 'transport-dropdownList')">
                                        Đường bộ
                                    </label>
                                    <label>
                                        <input type="checkbox" value="option2"
                                               onchange="updateSelectedOptions(this, 'transport-method', 'transport-dropdownList')">
                                        Đường thủy
                                    </label>
                                    <label>
                                        <input type="checkbox" value="option3"
                                               onchange="updateSelectedOptions(this, 'transport-method', 'transport-dropdownList')">
                                        Đường hàng không
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="renderInputAttribute" class="">

                        </div>
                    </div>
                    <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
                    <input type="text" hidden id="imgGallery" value="" name="imgGallery[]">
                    <input type="text" hidden id="imgThumbnail" value="" name="imgThumbnail[]">
                    <div class="form-group col-12 col-md-7 col-sm-8 ">
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- wpbody -->
        <div class="clear"></div>
    </div><!-- wpcontent -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#btnSaveAttribute').on('click', function () {
            let attribute = document.getElementById('input-form-create-attribute').value;
            var renderInputAttribute = $('#renderInputAttribute');
            $.ajax({
                url: '{{ route('product.v2.create.attribute') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    'attribute_property': attribute
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response)
                    // var item = response;
                    renderInputAttribute.append(response);
                },
                error: function (xhr, status, error) {
                    renderInputAttribute.append('<h3>Alooo</h3>');
                }
            })
        })

        {{--function callSaveAttribute(value) {--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('product.v2.create.attribute') }}',--}}
        {{--        type: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: '{{ csrf_token() }}',--}}
        {{--            'attribute_property': value--}}
        {{--        },--}}
        {{--        dataType: 'json',--}}
        {{--        success: function (response) {--}}
        {{--            console.log(response[1])--}}
        {{--            renderAttributeViewSession();--}}
        {{--        },--}}
        {{--        error: function (xhr, status, error) {--}}
        {{--            console.error(error);--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}

        {{--function setCookie(name, value, days) {--}}
        {{--    var expires = "";--}}
        {{--    if (days) {--}}
        {{--        var date = new Date();--}}
        {{--        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));--}}
        {{--        expires = "; expires=" + date.toUTCString();--}}
        {{--    }--}}
        {{--    document.cookie = name + "=" + (value || "") + expires + "; path=/";--}}
        {{--}--}}

        {{--function renderAttributeView(response) {--}}
        {{--    @php--}}
        {{--        Cookie::forget('testArray');--}}
        {{--    @endphp--}}

        {{--    var renderInputAttribute = $('#renderInputAttribute');--}}
        {{--    setCookie('testArray', response[1], 1);--}}
        {{--    @php--}}
        {{--        $array= null;--}}
        {{--        $att = null;--}}
        {{--        if(isset($_COOKIE['testArray'])) {--}}
        {{--            $att = $_COOKIE['testArray'];--}}
        {{--        }--}}
        {{--        if (!$att){--}}
        {{--            $att = null;--}}
        {{--        }--}}
        {{--          $mainArray = null;--}}
        {{--    if ($att){--}}
        {{--      $newArray = [];--}}
        {{--                    $elements = explode(',', $att);--}}
        {{--                    foreach ($elements as $element) {--}}
        {{--                            $parts = explode('-', $element);--}}
        {{--                            $prefix = $parts[0];--}}
        {{--                            $value = $parts[1];--}}
        {{--                            if (!isset($newArray[$prefix])) {--}}
        {{--                                $newArray[$prefix] = $prefix . '-' . $value;--}}
        {{--                            } else {--}}
        {{--                                $newArray[$prefix] .= '-' . $value;--}}
        {{--                            }--}}
        {{--                    }--}}
        {{--                    $newArray = array_values($newArray);--}}

        {{--                    if ($newArray) {--}}
        {{--                            foreach ($newArray as $myItem) {--}}
        {{--                                $key = explode("-", $myItem);--}}
        {{--                                $demoArray = null;--}}
        {{--                                for ($j = 1; $j < count($key); $j++) {--}}
        {{--                                    $demoArray[] = $key[0] . '-' . $key[$j];--}}
        {{--                                }--}}
        {{--                                $testArray[] = $demoArray;--}}
        {{--                            }--}}
        {{--                    }--}}

        {{--                    $array = $testArray;--}}

        {{--                    if ($array) {--}}
        {{--                        if (count($array) == 1) {--}}
        {{--                            $mainArray = $array;--}}
        {{--                        }--}}
        {{--                        $newArray1 = $array[0];--}}
        {{--                        for ($i = 1; $i < count($array); $i++) {--}}
        {{--                            $arrayList = [];--}}
        {{--                            for ($j = 0; $j < count($array1); $j++) {--}}
        {{--                                for ($z = 0; $z < count($array2); $z++) {--}}
        {{--                                    $arrayList[] = $array1[$j] . "," . $array2[$z];--}}
        {{--                                }--}}
        {{--                            }--}}
        {{--                            $newArray1 = $arrayList;--}}
        {{--                        }--}}
        {{--                        $mainArray =  $newArray1;--}}
        {{--                    }--}}
        {{--    }--}}
        {{--    @endphp--}}
        {{--    var item = `@include('backend-v2/products/attribute', ['testArray' => $mainArray])`;--}}
        {{--    renderInputAttribute.append(item);--}}
        {{--}--}}

        {{--function renderAttributeViewSession() {--}}
        {{--    var renderInputAttribute = $('#renderInputAttribute');--}}
        {{--    @php--}}
        {{--        $mainArray = session()->get('testArray');--}}
        {{--        $mainArray = $mainArray[0];--}}
        {{--    @endphp--}}
        {{--    var item = `@include('backend-v2/products/attribute', ['testArray' => $mainArray])`;--}}
        {{--    renderInputAttribute.append(item);--}}
        {{--}--}}

        {{--renderAttributeViewSession();--}}
    </script>
    <script>
        var properties = document.getElementsByClassName('property-attribute')
        var number = properties.length

        function checkInput() {
            var propertyArray = [];
            var attributeArray = [];
            var myArray = [];
            for (i = 0; i < number; i++) {
                if (properties[i].checked) {
                    const ArrPro = properties[i].value.split('-');
                    myArray.push(properties[i].value);
                    let attribute = ArrPro[0];
                    let property = ArrPro[1];
                    attributeArray.push(attribute);
                    propertyArray.push(property);
                }
            }
            var attPro = document.getElementById('input-form-create-attribute')
            attPro.value = myArray;
            localStorage.setItem('keys', myArray)
        }

        checkInput();

        $(document).on('change', '.property-attribute', function (event) {
            checkInput();
        });

        function showDropdown(inputId, dropdownId) {
            var dropdownList = document.getElementById(dropdownId);
            if (dropdownList.style.display === "block") {
                dropdownList.style.display = "none";
            } else {
                dropdownList.style.display = "block";
            }
        }

        function updateSelectedOptions(checkbox, inputId, dropdownId) {
            var selectedOptionsInput = document.getElementById(inputId);
            var selectedLabels = Array.from(document.querySelectorAll('#' + dropdownId + ' input[type="checkbox"]:checked'))
                .map(function (checkbox) {
                    return checkbox.nextSibling.textContent.trim();
                });
            selectedOptionsInput.value = selectedLabels.join(", ");
        }

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

        function create_custom_dropdowns() {
            $('#selectStorage').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');

            $('#selectCategory').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select-category')) {
                    $(this).after('<div class="dropdown-select-category wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });
            $('.dropdown-select-category ul').before('<div class="dd-search"><input id="txtSearchCategory" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');

            $('#selectAttribute').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select-attribute')) {
                    $(this).after('<div class="dropdown-select-attribute wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select-attribute ul').before('<div class="dd-search"><input id="txtSearchAttribute" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
        }

        // Event listeners

        // Open/close
        $(document).on('click', '.dropdown-select', function (event) {
            if ($(event.target).hasClass('dd-searchbox')) {
                return;
            }
            $('.dropdown-select').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        $(document).on('click', '.dropdown-select-category', function (event) {
            if ($(event.target).hasClass('dd-searchbox')) {
                return;
            }
            $('.dropdown-select-category').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        $(document).on('click', '.dropdown-select-attribute', function (event) {
            if ($(event.target).hasClass('dd-searchbox')) {
                return;
            }
            $('.dropdown-select-attribute').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        // Close when clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select-category').length === 0) {
                $('.dropdown-select-category').removeClass('open');
                $('.dropdown-select-category .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select-attribute').length === 0) {
                $('.dropdown-select-attribute').removeClass('open');
                $('.dropdown-select-attribute .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter() {
            var valThis = $('#txtSearchValue').val();
            $('.dropdown-select ul > li').each(function () {
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
            });

            var valThisCategoey = $('#txtSearchCategory').val();
            $('.dropdown-select-category ul > li').each(function () {
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThisCategoey.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
            });

            var valThisAttribute = $('#txtSearchAttribute').val();
            $('.dropdown-select-attribute ul > li').each(function () {
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThisAttribute.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
            });
        }

        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('#selectStorage').val($(this).data('value')).trigger('change');
        });

        $(document).on('click', '.dropdown-select-category .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select-category').find('.current').text(text);
            $(this).closest('.dropdown-select-category').prev('#selectCategory').val($(this).data('value')).trigger('change');
        });

        $(document).on('click', '.dropdown-select-attribute .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select-attribute').find('.current').text(text);
            $(this).closest('.dropdown-select-attribute').prev('#selectCategory').val($(this).data('value')).trigger('change');

            let attributeID = $(this).attr('data-value');
            var attribute = document.getElementById("attributeID_" + attributeID);
            attribute.classList.remove("d-none");
            var listProperties = document.getElementsByClassName("checkbox" + attributeID);

            $(document).on('click', '.addALlNavberBtn', function (event) {
                for (let i = 0; i < listProperties.length; i++) {
                    listProperties[i].click();
                }
                checkInput();
            });

            $(document).on('click', '.removeAllNavberBtn', function (event) {
                for (let i = 0; i < listProperties.length; i++) {
                    listProperties[i].checked = false;
                }
                document.getElementById('attribute_property' + attributeID).value = '';
            });

            $(document).on('click', '.hiddenNavberBtn', function (event) {
                attribute.classList.add("d-none");
            });
        });

        // Keyboard events
        $(document).on('keydown', '.dropdown-select', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).on('keydown', '.dropdown-select-category', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).on('keydown', '.dropdown-select-attribute', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).ready(function () {
            create_custom_dropdowns();
        });
    </script>
    <script>
        let desc = document.querySelectorAll('.description');
        for (let i = 0; i < desc.length; i++) {
            ClassicEditor
                .create(desc[i])
                .catch(error => {
                    console.error(error);
                });
        }
    </script>

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

@endsection

