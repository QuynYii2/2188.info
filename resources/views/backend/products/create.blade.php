@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

@extends('backend.layouts.master')

@section('content')

    <style>

        .__lk-fileInput {
            cursor: pointer;
        }

        .__lk-fileInput input {
            display: none;
        }

        .__lk-fileInput span {
            color: #fff;
            margin: 0 0 10px;
            padding: 5px 10px;
            text-decoration: none;
            background: #418edb;
            border-radius: 2px;
            font: normal 14px/1.412 Helvetica;
        }

        .__lk-fileInput span:hover {
            background: #2683E1;
        }

        .__lk-fileInput span.withFile:after {
            content: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QTA5OEU0M0REOUIwMTFFMzg4Q0VDNDEwMTU1QkU0MUIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QTA5OEU0M0VEOUIwMTFFMzg4Q0VDNDEwMTU1QkU0MUIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpBMDk4RTQzQkQ5QjAxMUUzODhDRUM0MTAxNTVCRTQxQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpBMDk4RTQzQ0Q5QjAxMUUzODhDRUM0MTAxNTVCRTQxQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PolX3bIAAADWSURBVHjadNHNCkFBFMDxSYq9UsoCC4/gZqFEiXLZSKy8nJ2Pja6FB1A8i/KRuEjXfzSXY3DqV3Nnzpx7TqOCIMhjgAkSUJYkRugjG1VKFeGiBgdz9RmOObvgWWEWvOOMlqiu1745u2OsN9No42YOLqigbNbhXgMp2WsdW5NwE8kbVMM8e8ASrlaLjsyJWAPG1HfEP77+DOiLlo6m3VdLOXRFK3qOAoo4iAIdZPQFT/R8ktXQFH/VMVXmlfVL7qzkkIs9hujpl16G42D9Y+gVFvD0+iHAAMR9gu9PEii4AAAAAElFTkSuQmCC');
            display: inline-block;
            vertical-align: middle;
            margin-left: 8px;
        }


        #upload-gallery-product .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }

        #upload-gallery-product .btn-primary {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        #upload-gallery-product .imgUp {
            margin-bottom: 15px;
        }

        #upload-gallery-product svg {
            width: 20px;
            height: 20px;
        }

        #upload-gallery-product .del {
            position: absolute;
            top: 0px;
            right: 15px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }

        #upload-gallery-product .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #4bd7ef;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }


        #pr-parameter .custom-scrollbar::-webkit-scrollbar, #cat-parameter .custom-scrollbar::-webkit-scrollbar {
            width: 10px;
            background-color: white; /* Màu nền của thanh cuộn */
        }

        #pr-parameter .custom-scrollbar::-webkit-scrollbar-thumb, #cat-parameter .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #888; /* Màu của thanh cuộn */
            border-radius: 6px;
        }

        #pr-parameter .custom-scrollbar::-webkit-scrollbar-thumb:hover, #cat-parameter .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #555; /* Màu của thanh cuộn khi hover */
        }

        .overflow-scroll {
            overflow: scroll;
        }

        @media only screen and (max-width: 575px) {
            .border-right {
                border-right: none;
            }

            .rm-pd-on-mobile {
                padding-right: 0;
                padding-left: 0;
            }

            .border {
                border: none !important;
                border-bottom: 1px solid #dee2e6 !important;
            }
        }


    </style>

    <script src="https://cdn.tiny.cloud/1/rrryhd716ssj0ml91tpdlpyh2bobk9eqsqqrleem5ae0g91g/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>

    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
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

            <div class="col-md-8 col-sm-8 border-right mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <label for="name" class="col-12 control-label">Tên sản phẩm</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="Nhập tên sản phẩm">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-12 control-label">Mã sản phẩm</label>
                    <div class="col-12">
                        <input type="text" class="form-control" name="" id=""
                               placeholder="Nhập mã sản phẩm">
                    </div>
                </div>
                {{--                <div class="form-group">--}}
                {{--                    <label for="less-description" class="col-12 control-label">Mô tả ngắn</label>--}}
                {{--                    <div class="col-sm-12">--}}
                {{--                        <textarea class="tiny"></textarea>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="form-group">--}}
                {{--                    <label for="description" class="col-12 control-label">Mô tả chi tiết</label>--}}
                {{--                    <div class="col-sm-12">--}}
                {{--                        <textarea class="form-control tiny" name="description-ffff" ></textarea>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="form-group">
                    <label for="description" class="col-12 control-label">Mô tả chi tiết</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <label class="col-12 control-label">Giá sản phẩm</label>

                    <div class="col-sm-12 d-inline-block">
                        <label class="control-label small" for="date_start">Giá bán</label>
                        <input type="text" class="form-control" required name="price" id="price"
                               placeholder="Nhập giá bán">

                    </div>
                    <div class="col-12 d-inline-block">
                        <label class="control-label small" for="date_start">Giá khuyến mãi</label>
                        <input type="text" class="form-control" name="qty" id="qty"
                               placeholder="Nhập giá khuyến mãi">
                    </div>

                </div>

                <div class="form-group d-flex">
                    <label for="tech" class="col-8 col-sm-8 control-label">Mua trả góp</label>
                    <div class="col-4 col-sm-4">
                        <input type="checkbox">
                    </div>
                </div>

                <div class="form-group" id="cat-parameter">
                    <label for="category" class="col-sm-12 control-label">Chuyên mục:</label>
                    <div class="col-sm-12 overflow-scroll custom-scrollbar" style="height: 200px;">
                        <ul id="category" class="list-unstyled">
                            @foreach($categories as $category)
                                <li>
                                    <label>
                                        <input type="radio" name="category_id" value="{{ $category->id }}" required>
                                        {{ $category->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>

                <div class="form-group">
                    <label for="attribute">Chọn thuộc tính sản phẩm có sẵn:</label>
                    {{--                    <select class="form-control" name="attribute" id="attribute">--}}
                    {{--                        @foreach($attributes as $attribute)--}}
                    {{--                            <option id="attribute-option-{{$attribute->id}}"--}}
                    {{--                                    value="{{$attribute->id}}">{{ $attribute->name }}</option>--}}
                    {{--                        @endforeach--}}
                    {{--                    </select>--}}
                </div>
                <div class="form-group border pt-3 pb-3 mt-3 mb-3" id="pr-parameter">
                    <label class="col-md-12 control-label">Thông số sản phẩm</label>
                    @foreach($attributes as $attribute)
                        @php
                            $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                        @endphp
                        @if(!$properties->isEmpty())
                            <div id="{{$attribute->name}}-{{$attribute->id}}" class="">
                                <label class="control-label offset-2" for="color">{{$attribute->name}}</label>
                                <div class="col-md-12 overflow-scroll custom-scrollbar">
                                    <ul class="list-unstyled">
                                        @foreach($properties as $property)
                                            <li>
                                                <label>
                                                    <input onchange="checkInput();" class="property-attribute"
                                                           id="property-{{$property->id}}"
                                                           type="checkbox" name="property-{{$attribute->name}}"
                                                           value="{{$attribute->id}}-{{$property->id}}">
                                                    {{$property->name}}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="border">
                        <div class="col-sm-12 d-inline-block ">
                            <label class="control-label small" for="date_start">Hình thức thanh toán</label>
                            <input type="text" class="form-control"
                                   onclick="showDropdown('payment-method', 'payment-dropdownList')"
                                   placeholder="Chọn hình thức thanh toán" id="payment-method">
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
                                   placeholder="Chọn hình thức vận chuyển" id="transport-method">
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
                    <div class="form-group col-12 col-sm-12 pt-3">
                        <label for="thumbnail">Ảnh đại diện:</label>
                        <label class='__lk-fileInput'>
                            <span data-default='Choose file'>Choose file</span>
                            <input type="file" id="thumbnail" class="img-cfg" name="thumbnail" accept="image/*"
                                   required>
                        </label>
                    </div>

                    <div class="form-group col-12 col-sm-12 ">
                        <label for="gallery">Thư viện ảnh:</label>
                        <label class='__lk-fileInput'>
                            <span data-default='Choose file'>Choose file</span>
                            <input type="file" id="gallery" class="img-cfg" name="gallery[]" accept="image/*" required>
                        </label>
                    </div>
                </div>
            </div>
            <input id="input-form-create-attribute" name="attribute_property" type="text" value="1" hidden>
            <div class="form-group col-12 col-md-7 col-sm-8 ">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            localStorage.setItem('attributeArray', attributeArray);
            localStorage.setItem('propertyArray', propertyArray);
        }


    </script>

    <script>

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


        tinymce.init({
            selector: 'textarea.tiny',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });


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


    </script>
@endsection
