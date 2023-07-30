@php
    use App\Enums\PropertiStatus;use Illuminate\Support\Facades\DB;
@endphp


<style>

    #checkboxes {
        height: 40vh;
        overflow-y: auto!important;
        display: none;
        border: 1px #dadada solid;
    }
    .dropdown-content{
        margin-top: 10px;
    }

    /**/
    select {
        display: none !important;
    }
    #checkboxes label {
        display: block;
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
                <h5 class="card-title">Chỉnh sửa sản phẩm: {{$product->name}}</h5>
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
                                   placeholder="Nhập tên sản phẩm" value="{{$product->name}}"
                                   required>
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
                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">Tất cả danh mục</div>
                            @php
                                $categories = DB::table('categories')->where('parent_id', null)->get();
                            @endphp
                            <div id="checkboxes" style=" display: block">
                                @foreach($categories as $category)
                                    <label class="ml-2" for="category-{{$category->id}}">
                                        <input type="checkbox" id="category-{{$category->id}}"
                                               name="category-{{$category->id}}"
                                               value="{{$category->id}}"
                                               class="inputCheckboxCategory mr-2 p-3"/>
                                        <span class="labelCheckboxCategory">{{$category->name}}</span>
                                    </label>
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            <label class="ml-4" for="category-{{$child->id}}">
                                                <input type="checkbox" id="category-{{$child->id}}"
                                                       name="category-{{$child->id}}"
                                                       value="{{$child->id}}"
                                                       class="inputCheckboxCategory mr-2 p-3"/>
                                                <span class="labelCheckboxCategory">{{$child->name}}</span>
                                            </label>
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                <label class="ml-5" for="category-{{$child2->id}}">
                                                    <input type="checkbox" id="category-{{$child2->id}}"
                                                           name="category-{{$child2->id}}"
                                                           value="{{$child2->id}}"
                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory">{{$child2->name}}</span>
                                                </label>
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12 ">
                                <label for="gallery">Thư viện ảnh:</label>
                                @include('backend.products.modal-media')
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
                    console.log(response)
                    $('#removeInputAttribute').remove();
                    // var item = response;
                    renderInputAttribute.append(response);
                },
                error: function (xhr, status, error) {
                    renderInputAttribute.append('<h3>Alooo</h3>');
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
