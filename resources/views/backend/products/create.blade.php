@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp
<style>
    .btn-success {
        color: white !important;
    }
    .labelCheckboxCategory{
        display: inline-table;
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
        display: none;
    }

    #selectAttribute{
        display: block !important;
    }
    .modal_dialog {
        display: none;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
    }

    #modal-dialog {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        width: 480px;
        height: 480px;
        text-align: center;
        justify-content: space-between;
    }
    #modal-dialog button{
        width: 100px;
        color: #FFFFFF;
        background: #00a32a;

    }
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
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
<style>
    /**/
    select {
        display: none;
    }

    #attribute_id,
    #selectAttribute{
        display: block !important;
    }
</style>
@section('content')

    <div id="wpcontent">
        <div id="wpbody" role="main">
            <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
                <h5 class="card-title">{{ __('home.Thêm mới sản phẩm') }}</h5>
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

                    <div class=".col-12 col-md-7 border-right mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">{{ __('home.Tên sản phẩm') }}</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder={{ __('home.Nhập tên sản phẩm')}} required>
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Mã sản phẩm') }}</div>
                            <input type="text" class="form-control" name="product_code" id="product_code"
                                   placeholder={{ __('home.Nhập mã sản phẩm') }} required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">{{ __('home.Mô tả ngắn') }}</label>
                            <textarea id="short_description" class="form-control description" name="short_description" rows="5">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('home.Mô tả chi tiết') }}</label>
                            <textarea id="description" class="form-control description" name="description" rows="5">
                            </textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="name">{{ __('home.Thông số sản phẩm') }}</label>
                            <select class="form-control" name="attribute_id" id="selectAttribute">
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 full-width">
                            @foreach($attributes as $attribute)
                                @php
                                    $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                                @endphp
                                @if(!$properties->isEmpty())
                                    <div id="attributeID_{{$attribute->id}}" class="d-none attribute-form">
                                        <label class="name" for="date_start">{{$attribute->name}}</label>
                                        <input type="text" class="form-control"
                                               onclick="showDropdown('attribute_property{{$attribute->id}}', 'attribute_property-dropdownList{{$attribute->id}}')"
                                               disabled id="attribute_property{{$attribute->id}}">
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
                        <div id="renderInputAttribute" class="row"></div>
                        <a id="btnSaveAttribute" class="btn btn-success mt-4 mb-5" style="color: white; display: none">SaveAttribute</a>
                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">{{ __('home.Giá bán') }}</div>
                            <input type="number" class="form-control" name="giaban" id="name"
                                   placeholder={{ __('home.Nhập giá bán') }}
                                   required min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Nhập giá khuyến mãi(nếu có)') }}</div>
                            <input type="number" class="form-control" name="giakhuyenmai" id="name"
                                    placeholder={{ __('home.Nhập số lượng') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Nhập số lượng') }}</div>
                            <input type="number" class="form-control" name="qty" id="qty"
                                   placeholder={{ __('home.Nhập giá khuyến mãi') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Xuất xứ') }}</div>
                            <input type="text" class="form-control" name="origin" id="origin" placeholder="{{ __('home.Nhập xuất xứ') }}">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Sản phẩm tối thiểu') }}</div>
                            <input type="number" class="form-control" name="min" id="min" placeholder={{ __('home.Nhập số lượng tối thiểu') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="name">{{ __('home.Mua nhiều giảm giá') }}</div>
                            </div>
                            <div>
                                <div class="">
                                    <div class="add-fields" data-af_base="#base-package-fields" data-af_target=".packages">
                                        <div class="packages">

                                        </div>
                                        <button type="button" class="btn add-form-field"><i class="fa-solid fa-plus"></i> {{ __('home.Thêm khoảng giá') }}</button>
                                    </div>
                                    <div id="base-package-fields" hidden>
                                        <div class="form-group form-group-price">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <input type="number" class="form-control form-price" name="starts[]" placeholder={{ __('home.Từ (sản phẩm)') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price" name="ends[]" placeholder={{ __('home.Đến (sản phẩm)') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price" name="sales[]" placeholder={{ __('home.Giảm %') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price" name="days[]" placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price" name="ships[]" placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                </div>
                                                <div class="">
                                                    <button type="button" class="btn remove-form-field"><i class="fa-regular fa-trash-can"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <div class="name">{{ __('home.Tất cả danh mục') }}</div>
                            @php
                                $categories = DB::table('categories')->where('parent_id', null)->get();
                            @endphp
                            <div id="checkboxes" style=" display: block">
                                @foreach($categories as $category)
                                    @if (!in_array($category->id, $categoriesRegister))
                                        <div class="unregister" data-toggle="modal" data-target="#exampleModal-{{$category->id}}">
                                            <label class="ml-2" for="category-{{$category->id}}">
                                                <input type="checkbox" id="category-{{$category->id}}"
                                                       name="category-{{$category->id}}"
                                                       value="{{$category->id}}"
                                                       class="inputCheckboxCategory mr-2 p-3"
                                                        @php
                                                            echo in_array($category->id, $categoriesRegister) ? '' :'disabled';
                                                        @endphp
                                                />
                                                <span class="labelCheckboxCategory">
                                                    @if(locationHelper() == 'kr')
                                                        <div class="text">{{ $category->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="text">{{$category->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="text">{{$category->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="text">{{$category->name_vi}}</div>
                                                    @else
                                                        <div class="text">{{$category->name_en}}</div>
                                                    @endif
                                                </span>
                                            </label>
                                        </div>
                                        <div class="modal fade" id="exampleModal-{{$category->id}}" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            This type of category of yours has not been registered
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary"><a
                                                                        href="{{route('permission.list.show')}}">Buy now</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                    @else
                                            <label class="ml-2" for="category-{{$category->id}}">
                                            <input type="checkbox" id="category-{{$category->id}}"
                                                   name="category-{{$category->id}}"
                                                   value="{{$category->id}}"
                                                   class="inputCheckboxCategory mr-2 p-3"/>
                                            <span class="labelCheckboxCategory">
                                                @if(locationHelper() == 'kr')
                                                    <div class="text">{{$category->name_ko }}</div>
                                                @elseif(locationHelper() == 'cn')
                                                    <div class="text">{{$category->name_zh}}</div>
                                                @elseif(locationHelper() == 'jp')
                                                    <div class="text">{{$category->name_ja}}</div>
                                                @elseif(locationHelper() == 'vi')
                                                    <div class="text">{{$category->name_vi}}</div>
                                                @else
                                                    <div class="text">{{$category->name_en}}</div>
                                                @endif

                                           </span>
                                            </label>
                                    @endif
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            @if(!in_array($child->id, $categoriesRegister))
                                                <div class="unregister" data-toggle="modal" data-target="#exampleModal-{{$child->id}}">
                                                    <label class="ml-4" for="category-{{$child->id}}">
                                                        <input type="checkbox" id="category-{{$child->id}}"
                                                               name="category-{{$child->id}}"
                                                               value="{{$child->id}}"
                                                               class="inputCheckboxCategory mr-2 p-3"
                                                                @php
                                                                    echo in_array($child->id, $categoriesRegister) ? '' :'disabled';
                                                                @endphp
                                                        />
                                                        <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                                <div class="text">{{$child->name_ko }}</div>
                                                            @elseif(locationHelper() == 'cn')
                                                                <div class="text">{{$child->name_zh}}</div>
                                                            @elseif(locationHelper() == 'jp')
                                                                <div class="text">{{$child->name_ja}}</div>
                                                            @elseif(locationHelper() == 'vi')
                                                                <div class="text">{{$child->name_vi}}</div>
                                                            @else
                                                                <div class="text">{{$child->name_en}}</div>
                                                            @endif
                                                        </span>
                                                    </label>
                                                </div>
                                                    <div class="modal fade" id="exampleModal-{{$child->id}}" tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    This type of category of yours has not been registered
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-primary"><a
                                                                                href="{{route('permission.list.show')}}">Buy now</a>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @else
                                                    <label class="ml-2" for="category-{{$child->id}}">
                                                        <input type="checkbox" id="category-{{$child->id}}"
                                                               name="category-{{$child->id}}"
                                                               value="{{$child->id}}"
                                                               class="inputCheckboxCategory mr-2 p-3"/>
                                                        <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                                <div class="text">{{ $child->name_ko }}</div>
                                                            @elseif(locationHelper() == 'cn')
                                                                <div class="text">{{$child->name_zh}}</div>
                                                            @elseif(locationHelper() == 'jp')
                                                                <div class="text">{{$child->name_ja}}</div>
                                                            @elseif(locationHelper() == 'vi')
                                                                <div class="text">{{$child->name_vi}}</div>
                                                            @else
                                                                <div class="text">{{$child->name_en}}</div>
                                                            @endif

                                                        </span>
                                                    </label>
                                            @endif
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                @if(!in_array($child2->id, $categoriesRegister))
                                                    <div class="unregister" data-toggle="modal" data-target="#exampleModal-{{$child->id}}">
                                                        <label class="ml-5" for="category-{{$child2->id}}">
                                                            <input type="checkbox" id="category-{{$child2->id}}"
                                                                   name="category-{{$child2->id}}"
                                                                   value="{{$child2->id}}"
                                                                   class="inputCheckboxCategory mr-2 p-3"
                                                                    @php
                                                                        echo in_array($child2->id, $categoriesRegister) ? '' :'disabled';
                                                                    @endphp
                                                            />
                                                            <span class="labelCheckboxCategory">
                                                                @if(locationHelper() == 'kr')
                                                                    <div class="text">{{ $child2->name_ko }}</div>
                                                                @elseif(locationHelper() == 'cn')
                                                                    <div class="text">{{$child2->name_zh}}</div>
                                                                @elseif(locationHelper() == 'jp')
                                                                    <div class="text">{{$child2->name_ja}}</div>
                                                                @elseif(locationHelper() == 'vi')
                                                                    <div class="text">{{$child2->name_vi}}</div>
                                                                @else
                                                                    <div class="text">{{$child2->name_en}}</div>
                                                                @endif
                                                       </span>
                                                        </label>
                                                    </div>
                                                        <div class="modal fade" id="exampleModal-{{$child2->id}}" tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        This type of category of yours has not been registered
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Cancel</button>
                                                                        <button type="button" class="btn btn-primary"><a
                                                                                    href="{{route('permission.list.show')}}">Buy now</a>
                                                                        </button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @else
                                                        <label class="ml-2" for="category-{{$child2->id}}">
                                                        <input type="checkbox" id="category-{{$child2->id}}"
                                                               name="category-{{$child2->id}}"
                                                               value="{{$child2->id}}"
                                                               class="inputCheckboxCategory mr-2 p-3"/>
                                                        <span class="labelCheckboxCategory">
                                                            @if(locationHelper() == 'kr')
                                                                <div class="text">{{ $child2->name_ko }}</div>
                                                            @elseif(locationHelper() == 'cn')
                                                                <div class="text">{{$child2->name_zh}}</div>
                                                            @elseif(locationHelper() == 'jp')
                                                                <div class="text">{{$child2->name_ja}}</div>
                                                            @elseif(locationHelper() == 'vi')
                                                                <div class="text">{{$child2->name_vi}}</div>
                                                            @else
                                                                <div class="text">{{$child2->name_en}}</div>
                                                            @endif

                                                    </span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12 ">
                                @include('backend.products.modal-media')
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-12 col-sm-12" id="list-img-thumbnail"></div>
                            <div class="form-group col-12 col-sm-12" id="list-img-gallery"></div>
                        </div>
                    </div>
                    <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
                    <input type="text" hidden id="imgGallery" value="" name="imgGallery[]">
                    <input type="text" hidden id="imgThumbnail" value="" name="imgThumbnail[]">
                    <div class="form-group col-12 col-md-7 col-sm-8 ">
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">{{ __('home.Gửi') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- wpbody -->
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
                    // var item = response;
                    renderInputAttribute.append(response);
                },
                error: function (xhr, status, error) {
                    renderInputAttribute.append('<h3>Error</h3>');
                }
            })
        })
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

        $(document).on('change', '.property-attribute', function () {
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

            $('#selectAttribute').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select-attribute')) {
                    $(this).after('<div class="dropdown-select-attribute wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option attribute-create ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
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

        $(document).on('click', '.dropdown-select-attribute .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select-attribute').find('.current').text(text);
            // $(this).closest('.dropdown-select-attribute').prev('#selectCategory').val($(this).data('value')).trigger('change');

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
    </script>
    <script>
        let desc = document.querySelectorAll('.description');
        for (let i = 0; i < desc.length; i++) {
            CKEDITOR.replace( desc[i], {
                filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
            } );
            // CKEDITOR.replace(desc[i]);
        }
    </script>
    <script>
        var expanded = false;

        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            var div = document.getElementById('div-click');
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
                window.addEventListener('click', function (e) {
                    if (checkboxes.contains(e.target) || div.contains(e.target)) {
                        div.on('click', function () {
                            checkboxes.style.display = "block";
                            expanded = true;
                        });
                    } else {
                        checkboxes.style.display = "none";
                        expanded = false;
                    }
                })
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
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
        $('.property-attribute').on('change', function () {
            var tests = document.getElementsByClassName('property-attribute');
            var btn = document.getElementById('btnSaveAttribute');
            var isValid = false;
            for(let i = 0; i<tests.length; i++){
                if(tests[i].checked){
                    isValid = true;
                }
            }
            if(isValid == true){
                btn.style.display = 'block';
            } else {
                btn.style.display = 'none';
            }
        })
    </script>
        </div><!-- wpbody -->
    </div><!-- wpcontent -->
    <script>
        var url = `{{ route('product.v2.create.attribute') }}`;
        var token = `{{ csrf_token() }}`;
    </script>
    <script src="{{ asset('js/backend/products-create.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".unregister").click(function () {
                var categoryID = $(this).val();
                var modalId = 'exampleModal-' + this.value;
                var checkboxId = 'category-' + this.value;
                var unCheck = document.getElementById(categoryID);
                var originalChecked = this.checked;
                var modal = document.getElementById(modalId);
                console.log(categoryID);
                async function setProductHots(categoryID) {
                    let url = '{{ route('categories.register', ['id' => ':categoryID']) }}';
                    url = url.replace(':categoryID', categoryID);
                    try {
                        await $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                console.log(!response.id)
                                if (!response.id) {
                                    var modal = document.getElementById(modalId);
                                    $(modal).modal('show');

                                    var confirmButton = document.querySelector('#' + modalId + ' .btn-primary');
                                    confirmButton.addEventListener('click', function () {
                                        var checkbox = document.getElementById(checkboxId);
                                        checkbox.checked = true;
                                        $(modal).modal('hide');
                                    });

                                    // Xử lý sự kiện đóng Modal
                                    $(modal).on('hidden.bs.modal', function () {
                                        var checkbox = document.getElementById(checkboxId);
                                        if (checkbox.checked !== originalChecked) {
                                            checkbox.checked = originalChecked;
                                        }
                                        $(unCheck).prop('checked', false);

                                    });
                                }
                            },
                            error: function (exception) {

                            }
                        });
                    } catch (error) {
                        throw error;
                    }
                }
                setProductHots(categoryID);
            });
        })
    </script>
@endsection

