@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

@extends('backend.layouts.master')

@section('content')

    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h5 class="category">Thêm mới sản phẩm</h5>
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

            <div class="col-12 col-md-6 border-right mt-2 rm-pd-on-mobile">
                <div class="form-group">
                    <div class="name">Tên sản phẩm</div>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <div class="name">Mã sản phẩm</div>
                    <input type="text" class="form-control" name="" id="" placeholder="Nhập mã sản phẩm">
                </div>
                <div class="form-group">
                    <div class="name">Mô tả ngắn</div>
                    <textarea class="form-control tiny" name="description-ffff"></textarea>
                </div>
                <div class="form-group">
                    <div class="name">Mô tả chi tiết</div>
                    <textarea class="form-control tiny" name="description-ffff"></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-6 d-inline-block">
                        <div class="control-label small name" for="date_start">Giá bán</div>
                        <input type="text" class="form-control" required name="price" id="price" placeholder="Nhập giá bán">
                    </div>
                    <div class="col-6 d-inline-block">
                        <div class="control-label small name" for="date_start">Giá khuyến mãi</div>
                        <input type="text" class="form-control" name="qty" id="qty" placeholder="Nhập giá khuyến mãi">
                    </div>
                </div>
{{--                <div class="form-group d-flex">--}}
{{--                    <div for="tech" class="col-8 col-sm-8 control-label name">Mua trả góp</div>--}}
{{--                    <div class="col-4 col-sm-4">--}}
{{--                        <input type="checkbox">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group" id="cat-parameter">
                    <div for="category" class="col-sm-12 control-label name">Chuyên mục:</div>
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
            </div>
            <div class="col-12 col-md-6 mt-2 rm-pd-on-mobile">

                {{--                <div class="form-group">--}}
                {{--                    <label for="attribute">Chọn thuộc tính sản phẩm có sẵn:</label>--}}
                {{--                    <select class="form-control" name="attribute" id="attribute">--}}
                {{--                        @foreach($attributes as $attribute)--}}
                {{--                            <option id="attribute-option-{{$attribute->id}}"--}}
                {{--                                    value="{{$attribute->id}}">{{ $attribute->name }}</option>--}}
                {{--                        @endforeach--}}
                {{--                    </select>--}}
                {{--                </div>--}}
                <div class="form-group border p-3 " id="pr-parameter">
                    <label class="name">Thông số sản phẩm</label>
                    @foreach($attributes as $attribute)
                        @php
                            $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                        @endphp
                        @if(!$properties->isEmpty())
                            <div id="{{$attribute->name}}-{{$attribute->id}}" class="">
                                <label class="control-label">{{$attribute->name}}</label>
                                <div class="col-md-12 ">
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
                            <label class="name" for="date_start">Hình thức thanh toán</label>
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
                    <button type="submit" class="btn btn-success">Gửi</button>
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
