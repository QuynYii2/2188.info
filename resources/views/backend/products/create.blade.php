@extends('backend.layouts.master')

@section('content')

    <style>

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
    </style>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <div class="container-fluid">
        <h3 class="">Thêm mới sản phẩm</h3>

        <div class="row">
            <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data"
                  class="form-horizontal row" role="form">
                @csrf
                @if (session('success_update_product'))
                    <div class="alert alert-success">
                        {{ session('error_create_product') }}
                    </div>
                @endif

                <div class="col-md-9 col-sm-8 border-right">
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Tên sản phẩm</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Mã sản phẩm</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập mã sản phẩm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="less-description" class="col-sm-3 control-label">Mô tả ngắn</label>
                        <div class="col-sm-12">
                            <textarea id="tiny"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Mô tả chi tiết</label>
                        <div class="col-sm-12">
                            <textarea id="tiny" class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Giá sản phẩm</label>

                        <div class="col-sm-12 d-inline-block">
                            <label class="control-label small" for="date_start">Giá bán</label>
                            <input type="text" class="form-control" required name="price" id="price"
                                   placeholder="Nhập giá bán">

                        </div>
                        <div class="col-sm-12 d-inline-block">
                            <label class="control-label small" for="date_start">Giá khuyến mãi</label>
                            <input type="text" class="form-control" name="qty" id="qty"
                                   placeholder="Nhập giá khuyến mãi">

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="tech" class="col-sm-12 control-label">Mua trả góp</label>
                        <div class="col-sm-12">
                            <input type="checkbox">
                        </div>
                    </div>

                    <div class="form-group" id="cat-parameter">
                        <label for="category" class="col-sm-12 control-label">Chuyên mục:</label>
                        <div class="col-sm-12 overflow-scroll custom-scrollbar" style="height: 200px;">

                            {{--                                <select id="category" name="category_id" class="form-control" required>--}}
                            {{--                                    @foreach($categories as $category)--}}
                            {{--                                        <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}

                            <ul id="category" class="list-unstyled overflow-auto">
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
                        <select class="form-control" name="attribute" id="attribute">
                            @foreach($attributes as $attribute)
                                <option id="attribute-option-{{$attribute->id}}"
                                        value="{{$attribute->id}}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group" id="pr-parameter">
                        <label class="col-md-12 control-label">Thông số sản phẩm</label>
                        @foreach($attributes as $attribute)
                            <div id="{{$attribute->name}}-{{$attribute->id}}" class="d-none">
                                <label class="control-label small offset-2" for="color">{{$attribute->name}}</label>
                                <div class="col-md-12 overflow-scroll custom-scrollbar" style="height: 150px;">
                                    <ul class="list-unstyled">
                                        <li>
                                            <label>
                                                <input type="radio" name="color" value="" required>
                                                Đỏ
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="radio" name="color" value="texnolog2">
                                                Cam
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="radio" name="color" value="texnolog3">
                                                Vàng
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input type="radio" name="color" value="texnolog3">
                                                Tím
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-sm-12 d-inline-block">
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

                    <div class="col-sm-12 d-inline-block">
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

                    <div class="form-group">
                        <label for="thumbnail">Ảnh đại diện:</label>
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="gallery">Thư viện ảnh:</label>
                        <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="d-none">
            <form id="form-create-attribute">

            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

        })
    </script>

    <script>
        $(".imgAdd").click(function () {
            $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" accept=".jpg, .png" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><svg xmlns="http://www.w3.org/2000/svg" class="del" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg></div>');
        });

        $(document).on("click", ".del", function () {
            // Xóa khối div
            $(this).parent().remove();
            // Xóa ảnh
        });

        $(document).on("change", ".uploadFile", function () {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // Không có tệp nào được chọn hoặc không hỗ trợ FileReader

            if (/^image/.test(files[0].type)) {
                // Chỉ chấp nhận tệp ảnh
                var reader = new FileReader(); // Đối tượng FileReader
                reader.readAsDataURL(files[0]); // Đọc tệp cục bộ

                reader.onloadend = function () {
                    // Đặt dữ liệu ảnh làm nền cho div
                    uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                }
            }
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


        tinymce.init({
            selector: 'textarea#tiny',
            plugins: [
                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +
                'bullist numlist checklist outdent indent | removeformat | code table help'
        })

    </script>
@endsection
