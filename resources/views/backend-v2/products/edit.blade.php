@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

@extends('backend-v2.layouts.master')
@section('title')
    Update Product
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
                <h5 class="card-title">Chỉnh sửa sản phẩm: {{$product->name}}</h5>
                @if (session('success_update_product'))
                    <div class="alert alert-success">
                        {{ session('success_update_product') }}
                    </div>
                @endif
            </div>
            <div class="container-fluid">
                <form action="{{ route('product.v2.update', $product->id) }}" method="post" enctype="multipart/form-data"
                      class="form-horizontal row" role="form">
                    @csrf
                    @if (session('success_update_product'))
                        <div class="alert alert-success">
                            {{ session('error_create_product') }}
                        </div>
                    @endif

                    <div class="col-12 col-md-7 border-right mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">Tên sản phẩm</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm" value="{{$product->name}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <div class="name">Mã sản phẩm</div>
                            <input type="text" class="form-control" name="product_code" id="product_code" value="{{$product->product_code}}"
                                   placeholder="Nhập mã sản phẩm" required>
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
                        <div class="form-group row">
                            <div class="col-4 d-inline-block">
                                <label class="control-label small name" for="price">Giá bán</label>
                                <input type="number" class="form-control" required name="old_price" id="price"
                                       placeholder="Nhập giá bán" value="{{$product->old_price}}">
                            </div>
                            <div class="col-4 d-inline-block">
                                <label class="control-label small name" for="qty">Giá khuyến mãi</label>
                                <input type="number" class="form-control" name="price" id="qty" value="{{$product->price}}"
                                       placeholder="Nhập giá khuyến mãi">
                            </div>
                        </div>
                        <input id="inputHotProduct" type="text" class="d-none" value="{{ $product->hot }}">
                        <input id="inputFeatureProduct" type="text" class="d-none" value="{{ $product->feature }}">
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
                        <div class="form-group col-12 col-sm-12 pt-3">
                            <label for="thumbnail">Ảnh đại diện:</label>
                            <label class='__lk-fileInput'>
                                <span data-default='Choose file'>Choose file</span>
                                <input type="file" id="thumbnail" class="img-cfg" name="thumbnail" accept="image/*">
                            </label>
                            @if ($product->thumbnail)
                                <a href="{{ asset('storage/' . $product->thumbnail) }}" data-fancybox="group"
                                   data-caption="This image has a caption 1">
                                    <img class="mt-2" style="height: 100px" src="{{ asset('storage/' . $product->thumbnail) }}"
                                         alt="Thumbnail">
                                </a>
                            @endif
                        </div>
                        <div class="form-group col-12 col-sm-12 ">
                            <label for="gallery">Thư viện ảnh:</label>
                            <label class='__lk-fileInput'>
                                <span data-default='Choose file'>Choose file</span>
                                <input type="file" id="gallery" class="img-cfg" name="gallery[]" accept="image/*"
                                       multiple>
                                @php
                                    $input = $product->gallery;
                                    $array = json_decode($input, true);
                                    $modifiedArray = explode(",", $input);
                                @endphp
                                @if ($product->gallery )
                                    @foreach ($modifiedArray as $image)
                                        <a href="{{ asset('storage/' . $image) }}" data-fancybox="group"
                                           data-caption="This image has a caption 1">
                                            <img class="mt-2" style="height: 100px; width: 100px "
                                                 src="{{ asset('storage/' . $image) }}" alt="Gallery Image" width="100">
                                        </a>
                                    @endforeach
                                @endif
                            </label>
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
                                                    @php
                                                        $isChecked = false
                                                    @endphp
                                                    @foreach($att_of_product as $att)
                                                        @if($att->attribute_id == $attribute->id )
                                                            @php
                                                                $value = explode(',', $att->value);
                                                            foreach($value as $item){
                                                                if($item == $property->id ){
                                                                    $isChecked = true;
                                                                    }
                                                                }
                                                            @endphp
                                                        @endif

                                                    @endforeach
                                                    <input class="property-attribute checkbox{{$attribute->id}}" type="checkbox"
                                                           value="{{$attribute->id}}-{{$property->id}}" {{ $isChecked ? 'checked' : '' }}
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
                    </div>
                    <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
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
        function checkHotAndFeature() {
            var hot = document.getElementById('inputHotProduct');
            var feature = document.getElementById('inputFeatureProduct');
            console.log(hot, feature);
            if (hot.value == 1){
                document.getElementById("hot_product").checked = true;
            }
            if (feature.value == 1){
                document.getElementById("feature_product").checked = true;
            }
        }
        checkHotAndFeature();
    </script>
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
            console.log(attPro.value)
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
