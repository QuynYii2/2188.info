@php
    use App\Enums\PropertiStatus;use Illuminate\Support\Facades\DB;
@endphp


<style>
    .btn-success {
        color: white !important;
    }

    .name {
        margin-top: 20px;
        font-size: 14px;
        margin-bottom: 5px;
    }

    @media all {

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

    .attribute-form {
        background: white;
        padding: 20px;
    }

    #checkboxes {
        background-color: white;
        height: 30vh;
        overflow-y: auto !important;
        display: none;
        border: 1px #dadada solid;
    }

    .dropdown-content {
        margin-top: 10px;
    }

    #checkboxes label {
        display: block;
    }

    /**/
    select {
        display: none !important;
    }
</style>
@extends('backend.layouts.master')
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
                <h5 class="card-title">Chỉnh sửa sản phẩm: {{($product->name)}}</h5>
                @if (session('success_update_product'))
                    <div class="alert alert-success">
                        {{ session('success_update_product') }}
                    </div>
                @endif
            </div>
            <div class="container-fluid">
                <form action="{{ route('seller.products.update', $product->id) }}" method="post"
                      enctype="multipart/form-data"
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
                                   placeholder="Nhập tên sản phẩm" value="{{($product->name)}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">Mô tả ngắn</label>
                            <textarea id="short_description" class="form-control description" name="short_description"
                                      rows="5">{{$product->short_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả chi tiết</label>
                            <textarea id="description" class="form-control description" name="description"
                                      rows="5">{{$product->description}}</textarea>
                        </div>
                        <input id="inputHotProduct" type="text" class="d-none" value="{{ $product->hot }}">
                        <input id="inputFeatureProduct" type="text" class="d-none" value="{{ $product->feature }}">
                        <div class="form-group row ">
                            @for($i = 0; $i< count($permissionUsers); $i++)
                                @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                                    <div class="col-4 d-flex align-items-center">
                                        <label for="hot_product">Sản phẩm hot</label>
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
                                    <div class="col-4 d-flex align-items-center">
                                        <label for="feature_product" class="">Sản phẩm nổi bật</label>
                                        <div class="col-4 col-sm-4">
                                            <input class="form-control" type="checkbox" id="feature_product"
                                                   name="feature_product">
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endfor
                        </div>

                        <div class="form-group col-12 col-sm-12 ">
                            <label for="gallery">Thư viện ảnh:</label>
                            @include('backend.products.modal-media')
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
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12" id="list-img-thumbnail"></div>
                            <div class="form-group col-12 col-sm-12" id="list-img-gallery"></div>
                        </div>
                        <div id="removeInputAttribute " class="form-group row">
                            @if(!$productDetails->isEmpty())
                                @foreach($productDetails as $productDetail)
                                    @if($productDetail->variation && $productDetail->variation != 0)
                                        <div class="form-group col-12">
                                            @php
                                                $variable = $productDetail->variation;
                                                $arrayVariation = explode(',', $variable);
                                            @endphp
                                            @foreach($arrayVariation as $itemVariation)
                                                @php
                                                    $arrayItemVariation = explode('-', $itemVariation);
                                                    $attributeVariation = \App\Models\Attribute::find($arrayItemVariation[0]);
                                                    $propertyVariation = \App\Models\Properties::find($arrayItemVariation[1]);
                                                @endphp
                                                <div class="">
                                                    <label class="control-label"
                                                           for="color">{{($attributeVariation->name)}}</label>
                                                    <div class="overflow-scroll custom-scrollbar">
                                                        <input class="form-control" type="text"
                                                               value="{{$propertyVariation->name}}" disabled>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group  col-6">
                                            <label for="price">Giá bán</label>
                                            <input type="number"
                                                   class="form-control"
                                                   id="price{{$productDetail->id}}"
                                                   name="old_price{{$productDetail->id}}"
                                                   value="{{ $productDetail->old_price }}">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="qty">Giá khuyến mãi</label>
                                            <input type="number"
                                                   class="form-control"
                                                   id="qty{{$productDetail->id}}"
                                                   name="price{{$productDetail->id}}"
                                                   value="{{$productDetail->price }}">
                                        </div>

                                        <label for="thumbnail">Thumbnail</label>
                                        <div class="form-group col-12">
                                            @if ($productDetail->thumbnail)
                                                <img class="mt-2 mb-2"
                                                     style="height: 100px"
                                                     src="{{ asset('storage/' . $productDetail->thumbnail) }}"
                                                     alt="Thumbnail">
                                                </a>
                                            @endif
                                            <input type="file"
                                                   class="form-control-file"
                                                   id="thumbnail"
                                                   name="thumbnail{{$productDetail->id}}"
                                                   accept="image/*">
                                        </div>
                                    @endif
                                    <div>
                                        <input hidden="" name="id{{$loop->index+1}}"
                                               value="{{$productDetail->id}}">
                                        <a class="btnRemove btn btn-danger mb-3" style="color: white"
                                           data-value="{{$productDetail->id}}">Remove</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
                        <div class="form-group col-6 mt-2 row">
                            <label class="name">Thông số sản phẩm</label>
                            <select class="form-control" name="attribute_id" id="selectAttribute">
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{  ($attribute->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row pl-2">
                            @foreach($attributes as $attribute)
                                @php
                                    $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                                @endphp
                                @if(!$properties->isEmpty())
                                    <div id="attributeID_{{$attribute->id}}" class="d-none">
                                        <label class="name" for="date_start">{{($attribute->name)}}</label>
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
                                                    <input class="property-attribute checkbox{{$attribute->id}}"
                                                           type="checkbox"
                                                           value="{{$attribute->id}}-{{$property->id}}"
                                                           {{ $isChecked ? 'checked' : '' }}
                                                           name="property-{{$attribute->id}}"
                                                           onchange="updateSelectedOptions(this, 'attribute_property{{$attribute->id}}', 'attribute_property-dropdownList{{$attribute->id}}')">
                                                    {{($property->name)}}
                                                @endforeach
                                            </label>
                                        </div>
                                        <div class="">
                                            <a class="btn btn-success" onclick="selectAllAttribute({{$attribute->id}})">
                                                SelectAll
                                            </a>
                                            <a class="btn btn-success" onclick="removeAllAttribute({{$attribute->id}})">
                                                Remove All
                                            </a>
                                            <a class="btn btn-secondary" onclick="hiddenAttribute({{$attribute->id}})">
                                                Hidden
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div id="renderInputAttribute">
                        </div>
                        <a id="btnSaveAttribute" class="btn btn-success mb-1 mt-1">SaveAttribute11</a>
                        <input type="text" hidden="" name="isNew" id="isNew" value="0">

                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">Giá bán</div>
                            <input type="number" class="form-control" name="giaban" id="name"
                                   placeholder="Nhập giá bán" value="{{$product->old_price}}"
                                   required min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">Nhập giá khuyến mãi(nếu có)</div>
                            <input type="number" class="form-control" name="giakhuyenmai" id="name"
                                   placeholder="Nhập giá khuyến mãi" value="{{$product->price}}" min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">Nhập số lượng</div>
                            <input type="number" class="form-control" name="qty" id="qty"
                                   placeholder="Nhập giá khuyến mãi" value="{{$product->qty}}" min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">Xuất xứ</div>
                            <input type="text" class="form-control" name="origin" id="origin" placeholder="Nhập xuất xứ"
                                   value="{{$product->origin}}">
                        </div>
                        <div class="form-group">
                            <div class="name">Sản phẩm tối thiểu</div>
                            <input type="number" value="{{$product->min}}" class="form-control" name="min" id="min"
                                   placeholder="Nhập số lượng tối thiểu" min="1">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="name">Mua nhiều giảm giá</div>
                            </div>
                            <div>
                                <div class="">
                                    <div class="add-fields" data-af_base="#base-package-fields"
                                         data-af_target=".packages">
                                        <div class="packages">

                                        </div>
                                        <button type="button" class="btn add-form-field"><i
                                                    class="fa-solid fa-plus"></i> Thêm khoảng giá
                                        </button>
                                    </div>
                                    <div id="base-package-fields" hidden>
                                        @if(!$price_sales->isEmpty())
                                            @foreach($price_sales as $price_sale)
                                                <div class="form-group form-group-price">
                                                    <div class="d-flex align-items-center">
                                                        <div class="">
                                                            <input value="{{$price_sale->quantity}}" type="number"
                                                                   class="form-control form-price" name="quantity[]"
                                                                   placeholder="Từ (sản phẩm)">
                                                        </div>
                                                        <div class="">
                                                            <input value="{{$price_sale->sales}}" type="number"
                                                                   class="form-control form-price" name="sales[]"
                                                                   placeholder="Giảm %">
                                                        </div>
                                                        <div class="">
                                                            <input value="{{$price_sale->days}}" type="number"
                                                                   class="form-control form-price" name="days[]"
                                                                   placeholder="Ngay gia hang du kien">
                                                        </div>
                                                        <div class="">
                                                            <button type="button" class="btn remove-form-field"><i
                                                                        class="fa-regular fa-trash-can"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="name">Tất cả danh mục</div>
                            @php
                                $categories = DB::table('categories')->where('parent_id', null)->get();
                                $productListCategory = $product->list_category;
                                $productArrayCategory = explode(',', $productListCategory);
                            @endphp
                            <div id="checkboxes" style=" display: block">
                                @foreach($categories as $category)
                                    @php
                                        $isValid = false;
                                        foreach ($productArrayCategory as $productArrayCategoryItem){
                                            if ($category->id == $productArrayCategoryItem){
                                                $isValid = true;
                                            }
                                        }
                                    @endphp
                                    <label class="ml-2" for="category-{{$category->id}}">
                                        <input type="checkbox" id="category-{{$category->id}}"
                                               name="category-{{$category->id}}"
                                               value="{{$category->id}}"
                                               {{ $isValid ? 'checked' : '' }}
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory">{{($category->name)}}</span>
                                    </label>
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            @php
                                                $isValidChild = false;
                                                foreach ($productArrayCategory as $productArrayCategoryItem){
                                                    if ($child->id == $productArrayCategoryItem){
                                                        $isValidChild = true;
                                                    }
                                                }
                                            @endphp
                                            <label class="ml-4" for="category-{{$child->id}}">
                                                <input type="checkbox" id="category-{{$child->id}}"
                                                       name="category-{{$child->id}}"
                                                       value="{{$child->id}}"
                                                       {{ $isValidChild ? 'checked' : '' }}
                                                       class="inputCheckboxCategory mr-2 p-3"/>
                                                <span class="labelCheckboxCategory">{{($child->name)}}</span>
                                            </label>
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                @php
                                                    $isValidChild2 = false;
                                                    foreach ($productArrayCategory as $productArrayCategoryItem){
                                                        if ($child2->id == $productArrayCategoryItem){
                                                            $isValidChild2 = true;
                                                        }
                                                    }
                                                @endphp
                                                <label class="ml-5" for="category-{{$child2->id}}">
                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                           name="category-{{$child2->id}}"
                                                           value="{{$child2->id}}"
                                                           {{ $isValidChild2 ? 'checked' : '' }}
                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory">{{($child2->name)}}</span>
                                                </label>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="" width="60px" height="60px">
                        </div>
                    </div>
                    <input type="text" hidden id="imgGallery" value="" name="imgGallery[]">
                    <input type="text" hidden id="imgThumbnail" value="" name="imgThumbnail[]">
                    <div class="border-top form-group col-12 col-md-7 col-sm-8 ">
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- wpbody -->
        <div class="clear"></div>
        <form action="#" id="formDeleteVariable" class="d-none" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" id="btnDeleteVariable">Delete</button>
        </form>
    </div><!-- wpcontent -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#btnSaveAttribute').on('click', function () {
            let attribute = document.getElementById('input-form-create-attribute').value;
            let isNew = document.getElementById('isNew');
            isNew.value = 100;
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
                    // var item = response;
                    renderInputAttribute.append(response);
                },
                error: function (xhr, status, error) {
                    renderInputAttribute.append('<h3>Error</h3>');
                }
            })
        })

        $('.btnRemove').on('click', function () {
            let attribute = $(this).data('value');
            removeVariable(attribute);
        })

        function removeVariable(value) {
            let url = '{{asset('/seller/delete-variable-v2')}}' + '/' + value;
            $('#formDeleteVariable').attr('action', url);
            $('#btnDeleteVariable').click();
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
    <script>
        function checkHotAndFeature() {
            var hot = document.getElementById('inputHotProduct');
            var feature = document.getElementById('inputFeatureProduct');
            console.log(hot, feature);
            if (hot.value == 1) {
                document.getElementById("hot_product").checked = true;
            }
            if (feature.value == 1) {
                document.getElementById("feature_product").checked = true;
            }
        }

        checkHotAndFeature();
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

        function selectAllAttribute(id) {
            var listProperties = document.getElementsByClassName("checkbox" + id);

            for (let i = 0; i < listProperties.length; i++) {
                listProperties[i].click();
            }
            checkInput();
        }

        function removeAllAttribute(id) {
            var listProperties = document.getElementsByClassName("checkbox" + id);

            for (let i = 0; i < listProperties.length; i++) {
                listProperties[i].checked = false;
            }
            document.getElementById('attribute_property' + id).value = '';
        }

        function hiddenAttribute(id) {
            var attribute = document.getElementById("attributeID_" + id);
            attribute.classList.add("d-none");
        }
    </script>
    <script>
        let desc = document.querySelectorAll('.description');
        for (let i = 0; i < desc.length; i++) {
            CKEDITOR.replace(desc[i], {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            } );
        }
    </script>
    <script>
        $('.add-fields').each(function(index, el) {
            var warp = $(this);
            var target = $(this).data('af_target') || '.content';
            var index = $(target).children('div, tr').length;
            var baseEl =$($(this).data('af_base')) || $(target).find('.form-field-base');
            var base = baseEl.html();
            baseEl.remove();
            //alert(base);

            warp.find(target).append(base.replace('.form-price', index));
            index ++;

            warp.on('click', '.add-form-field', function(e) {
                e.preventDefault();
                warp.find(target).append(base.replace('.form-price', index));
                index++;
            });

            warp.on('click', '.remove-form-field', function(e) {
                e.preventDefault();
                $(this).parents($(this).data('target') || '.form-group-price').remove();
            });
        });
    </script>
@endsection
