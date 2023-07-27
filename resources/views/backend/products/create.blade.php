@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

<style>

    select {
        display: none !important;
    }

    .dropdown-select {
        background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);
        background-color: #fff;
        border-radius: 6px;
        border: solid 1px #eee;
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        float: left;
        font-size: 14px;
        font-weight: normal;
        height: 42px;
        line-height: 40px;
        outline: none;
        padding-left: 18px;
        padding-right: 30px;
        position: relative;
        text-align: left !important;
        transition: all 0.2s ease-in-out;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        white-space: nowrap;
        width: auto;

    }

    .dropdown-select:focus {
        background-color: #fff;
    }

    .dropdown-select:hover {
        background-color: #fff;
    }

    .dropdown-select:active,
    .dropdown-select.open {
        background-color: #fff !important;
        border-color: #bbb;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
    }

    .dropdown-select:after {
        height: 0;
        width: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #777;
        -webkit-transform: origin(50% 20%);
        transform: origin(50% 20%);
        transition: all 0.125s ease-in-out;
        content: '';
        display: block;
        margin-top: -2px;
        pointer-events: none;
        position: absolute;
        right: 10px;
        top: 50%;
    }

    .dropdown-select.open:after {
        -webkit-transform: rotate(-180deg);
        transform: rotate(-180deg);
    }

    .dropdown-select.open .list {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 1;
        pointer-events: auto;
    }

    .dropdown-select.open .option {
        cursor: pointer;
    }

    .dropdown-select.wide {
        width: 100%;
    }

    .dropdown-select.wide .list {
        left: 0 !important;
        right: 0 !important;
    }

    .dropdown-select .list {
        box-sizing: border-box;
        transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
        -webkit-transform: scale(0.75);
        transform: scale(0.75);
        -webkit-transform-origin: 50% 0;
        transform-origin: 50% 0;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
        background-color: #fff;
        border-radius: 6px;
        margin-top: 4px;
        padding: 3px 0;
        opacity: 0;
        overflow: hidden;
        pointer-events: none;
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 999;
        max-height: 250px;
        overflow: auto;
        border: 1px solid #ddd;
    }

    .dropdown-select .list:hover .option:not(:hover) {
        background-color: transparent !important;
    }

    .dropdown-select .dd-search {
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0.5rem;
    }

    .dropdown-select .dd-searchbox {
        width: 90%;
        padding: 0.5rem;
        border: 1px solid #999;
        border-color: #999;
        border-radius: 4px;
        outline: none;
    }

    .dropdown-select .dd-searchbox:focus {
        border-color: #12CBC4;
    }

    .dropdown-select .list ul {
        padding: 0;
    }

    .dropdown-select .option {
        cursor: default;
        font-weight: 400;
        line-height: 40px;
        outline: none;
        padding-left: 18px;
        padding-right: 29px;
        text-align: left;
        transition: all 0.2s;
        list-style: none;
    }

    .dropdown-select .option:hover,
    .dropdown-select .option:focus {
        background-color: #f6f6f6 !important;
    }

    .dropdown-select .option.selected {
        font-weight: 600;
        color: #12cbc4;
    }

    .dropdown-select .option.selected:focus {
        background: #f6f6f6;
    }

    .dropdown-select a {
        color: #aaa;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .dropdown-select a:hover {
        color: #666;
    }

</style>
@extends('backend.layouts.master')

@section('content')
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
                        <select name="storage-id" class="form-control">
                            @foreach($storages as $storage)
                                <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="name">Tên sản phẩm</div>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm"
                           required>
                </div>
                <div class="form-group">
                    <div class="name">Mã sản phẩm</div>
                    <input type="text" class="form-control" name="product_code" id="product_code"
                           placeholder="Nhập mã sản phẩm" required>
                </div>
                <div class="form-group">
                    <div class="name">Mô tả ngắn</div>
                    <textarea class="form-control tiny" name="short_description"></textarea>
                </div>
                <div class="form-group">
                    <div class="name">Mô tả chi tiết</div>
                    <textarea class="form-control tiny" name="description" required></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-4 d-inline-block">
                        <label class="control-label small name" for="price">Giá bán</label>
                        <input type="number" class="form-control" required name="old_price" id="price"
                               placeholder="Nhập giá bán">
                    </div>
                    <div class="col-4 d-inline-block">
                        <label class="control-label small name" for="qty">Giá khuyến mãi</label>
                        <input type="number" class="form-control" name="price" id="qty" placeholder="Nhập giá khuyến mãi">
                    </div>
                </div>
                <div class="form-group row">
                    @for($i = 0; $i< count($permissionUsers); $i++)
                        @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                            <div class="col-4 d-flex">
                                <label for="hot_product" class="col-8 col-sm-8">Sản phẩm hot</label>
                                <div class="col-4 col-sm-4">
                                    <input class="form-control" type="checkbox" id="hot_product" name="hot_product">
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
                        <input type="file" id="gallery" class="img-cfg" name="gallery[]" accept="image/*" multiple>
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                <div class="form-group" id="cat-parameter">
                    <label for="pet-select">Chuyên mục:</label>

                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
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
            </div>
            <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
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

        var priceInput = document.getElementById('price');
        var qtyInput = document.getElementById('qty');

        qtyInput.addEventListener('input', function () {
            checkPrice();
        });
        priceInput.addEventListener('input', function () {
            checkPrice();
        });

        function checkPrice() {
            var price = parseFloat(priceInput.value);
            var qty = parseFloat(qtyInput.value);

            if (qty > price) {
                alert('Giá khuyến mãi không được lớn hơn giá bán.');
                qtyInput.value = '';
            }
        }

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
        }

        checkInput();

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
            $('select').each(function (i, select) {
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

        // Close when clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter() {
            var valThis = $('#txtSearchValue').val();
            $('.dropdown-select ul > li').each(function () {
                var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();
            });
        };
        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
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

        $(document).ready(function () {
            create_custom_dropdowns();
        });
    </script>
@endsection
