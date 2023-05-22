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
    </style>

    <div class="container">

        <section class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Thêm mới sản phẩm</h3>
            </div>
            <div class="panel-body">

                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data"
                      class="form-horizontal" role="form">
                    @csrf

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
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="more-description" class="col-sm-3 control-label">Mô tả chi tiết</label>
                        <div class="col-sm-12">
                            <textarea class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-12 control-label">Giá sản phẩm</label>

                        <div class="col-sm-3 d-inline-block">
                            <label class="control-label small" for="date_start">Giá bán</label>
                            <input type="text" class="form-control" name="qty" id="qty" placeholder="Nhập giá bán">

                        </div>
                        <div class="col-sm-3 d-inline-block">
                            <label class="control-label small" for="date_start">Giá khuyến mãi</label>
                            <input type="text" class="form-control" name="qty" id="qty"
                                   placeholder="Nhập giá khuyến mãi">

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Danh mục sản phẩm</label>
                        <div class="col-sm-3">
                            <select id="category" class="form-control" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-sm-12 control-label">Thông số sản phẩm</label>

                        <div class="col-sm-3 d-inline-block">
                            <label class="control-label small" for="date_start">Màu sắc</label>
                            <select class="form-control">
                                <option value="">Đỏ</option>
                                <option value="texnolog2">Cam</option>
                                <option value="texnolog3">Vàng</option>
                            </select>
                        </div>
                        <div class="col-sm-3 d-inline-block">
                            <label class="control-label small" for="date_start">Size</label>
                            <select class="form-control">
                                <option value="">S</option>
                                <option value="texnolog2">M</option>
                                <option value="texnolog3">L</option>
                            </select></div>
                        <div class="col-sm-3 d-inline-block">
                            <label class="control-label small" for="date_finish">Khối lượng</label>
                            <input type="text" class="form-control" name="date_finish" id="date_finish"
                                   placeholder="Khối lượng">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="tech" class="col-sm-3 control-label">Mua trả góp</label>
                        <div class="col-sm-3">
                            <input type="checkbox">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="images" class="col-sm-3 control-label">Ảnh sản phẩm</label>
                        <br>
                        <div class="container" id="upload-gallery-product">
                            <div class="row">
                                <div class="col-sm-2 imgUp">
                                    <div class="imagePreview"></div>
                                    <label class="btn btn-primary">
                                        Upload<input type="file" class="uploadFile img" accept=".jpg, .png"
                                                     value="Upload Photo"
                                                     style="width: 0px;height: 0px;overflow: hidden;">
                                    </label>
                                </div><!-- col-2 -->
                                <div class="imgAdd p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                                    </svg>
                                </div>
                            </div><!-- row -->
                        </div><!-- container -->

                        <div class="form-group ">
                            <label class="col-sm-12 control-label">Thông số sản phẩm</label>

                            <div class="col-sm-3 d-inline-block">
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

                            <div class="col-sm-3 d-inline-block">
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

                        <hr>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </div>
                    </div>

                </form>

            </div>
        </section>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

    </script>
@endsection
