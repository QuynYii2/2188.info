@php
    use App\Enums\PermissionUserStatus;use App\Enums\PropertiStatus;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;
@endphp

@extends('backend.layouts.master')
@section('title')
    Update Product
@endsection
@php
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
    .btn-success {
        color: white !important;
    }

    .labelCheckboxCategory {
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

    #selectAttribute {
        display: block !important;
    }
</style>
</style>
@section('content')
    <div class="container-fluid update-product-page bg-white">
        <h5 class="title-page s24w6">Chỉnh sửa sản phẩm: {{($product->name)}}</h5>
        <div class="main-page">
            <form action="{{ route('seller.products.update', $product->id) }}" method="post"
                  class="form-create-product pb-3" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="name" class="s12w5">{{ __('home.Tên sản phẩm') }} <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="{{ __('home.Nhập tên sản phẩm')}}" value="{{($product->name)}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="product_code" class="s12w5">{{ __('home.Mã sản phẩm') }} <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="product_code" id="product_code"
                                   placeholder="{{ __('home.Nhập mã sản phẩm') }}" value="{{($product->product_code)}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="short_description" class="s12w5">{{ __('home.Mô tả ngắn') }} <span
                                        class="text-danger">*</span></label>
                            <textarea id="short_description" class="form-control description" name="short_description"
                                      rows="5">{{$product->short_description}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" class="s12w5">{{ __('home.Mô tả chi tiết') }} <span
                                        class="text-danger">*</span></label>
                            <textarea id="description" class="form-control description" name="description" rows="5">
                                {{$product->description}}
                            </textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="label_item-member s12w5">
                                    Photo
                                    <span class="text-danger">*</span>
                                </div>
                                <label id="imgThumbnailLabel" for="imgThumbnail"
                                       class="upload-item-input d-flex justify-content-between align-items-center labelUploadImage">
                                    <div class="upload-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61"
                                             viewBox="0 0 60 61" fill="none">
                                            <path d="M30 13V48M12.5 30.5H47.5" stroke="#929292" stroke-width="6"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </label>
                                <input type="file" class="form-control" id="imgThumbnail" accept="image/*"
                                       style="visibility:hidden;"
                                       name="imgThumbnail">
                            </div>
                            <div class="form-group col-md-6">
                                <div class="label_item-member s12w5">
                                    Gallery
                                    <span class="text-danger">*</span>
                                </div>
                                <label id="imgGalleryLabel" for="imgGallery"
                                       class="upload-item-input d-flex justify-content-between align-items-center labelUploadImage">
                                    <div class="upload-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61"
                                             viewBox="0 0 60 61" fill="none">
                                            <path d="M30 13V48M12.5 30.5H47.5" stroke="#929292" stroke-width="6"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </label>
                                <input type="file" class="form-control" id="imgGallery" accept="image/*"
                                       multiple="multiple"
                                       style="visibility:hidden;"
                                       name="imgGallery[]">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            @include('backend.products.demo')
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="giaban" class="s12w5">{{ __('home.Giá bán') }} <span
                                        class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="giaban" id="giaban"
                                   placeholder="{{ __('home.Nhập giá bán') }}"
                                   value="{{$product->old_price}}"
                                   required min="1">
                        </div>
                        <div class="form-group">
                            <label for="giakhuyenmai" class="s12w5">{{ __('home.Nhập giá khuyến mãi(nếu có)') }}</label>
                            <input type="number" class="form-control" name="giakhuyenmai" id="giakhuyenmai"
                                   placeholder="{{ __('home.Nhập số lượng') }}" min="1" value="{{$product->price}}">
                        </div>
                        <div class="form-group">
                            <label for="qty" class="s12w5">{{ __('home.Nhập số lượng') }}</label>
                            <input type="number" class="form-control" name="qty" id="qty"
                                   placeholder="{{ __('home.Nhập giá khuyến mãi') }}" min="1" value="{{$product->qty}}">
                        </div>
                        <div class="form-group">
                            <label for="origin" class="s12w5">{{ __('home.Xuất xứ') }}</label>
                            <input type="text" class="form-control" name="origin" id="origin"
                                   placeholder="{{ __('home.Nhập xuất xứ') }}" value="{{$product->origin}}">
                        </div>
                        <div class="form-group">
                            <label for="min" class="s12w5">{{ __('home.Sản phẩm tối thiểu') }} <span
                                        class="text-danger">*</span></label>
                            <input type="number" value="{{$product->min}}" class="form-control" name="min" id="min"
                                   placeholder={{ __('home.Nhập số lượng tối thiểu') }} min="1">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="s12w5 mb-3">{{ __('home.Mua nhiều giảm giá') }} <span
                                            class="text-danger">*</span></div>
                            </div>
                            <div class="form-show">
                                <div class="">
                                    <div class="add-fields" data-af_base="#base-package-fields"
                                         data-af_target=".packages">
                                        <div class="packages">
                                            @if(!$price_sales->isEmpty())
                                                @foreach($price_sales as $price_sale)
                                                    <div class="form-group form-group-price">
                                                        <div class="d-flex align-items-center">
                                                            @php
                                                                $quantity = $price_sale->quantity;
                                                                $arrayQuantity = explode('-', $quantity);
                                                            @endphp
                                                            <div class="d-flex align-items-center">
                                                                <div class="">
                                                                    <input type="number" value="{{$arrayQuantity[0]}}"
                                                                           class="form-control form-price"
                                                                           name="starts[]" required
                                                                           placeholder={{ __('home.Từ (sản phẩm)') }}>
                                                                </div>
                                                                <div class="">
                                                                    <input value="{{$arrayQuantity[1]}}" type="number"
                                                                           class="form-control form-price"
                                                                           name="ends[]" required
                                                                           placeholder={{ __('home.Đến (sản phẩm)') }}>
                                                                </div>
                                                                <div class="">
                                                                    <input value="{{$price_sale->sales}}" type="number"
                                                                           class="form-control form-price"
                                                                           name="sales[]"
                                                                           required
                                                                           placeholder={{ __('home.Giảm %') }}>
                                                                </div>
                                                                <div class="">
                                                                    <input value="{{$price_sale->days}}" type="number"
                                                                           class="form-control form-price" name="days[]"
                                                                           required
                                                                           placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                                </div>
                                                                <div class="">
                                                                    <input value="{{$price_sale->ship}}" type="number"
                                                                           class="form-control form-price"
                                                                           name="ships[]"
                                                                           required
                                                                           placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                                </div>
                                                                <div class="">
                                                                    <button type="button" class="btn remove-form-field">
                                                                        <i class="fa-regular fa-trash-can"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn add-form-field"><i
                                                    class="fa-solid fa-plus"></i> {{ __('home.Thêm khoảng giá') }}
                                        </button>
                                    </div>
                                    <div id="base-package-fields" hidden>
                                        <div class="form-group form-group-price">
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <input type="number" class="form-control form-price"
                                                           name="starts[]" required placeholder={{ __('home.Từ (sản phẩm)') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price"
                                                           name="ends[]" required placeholder={{ __('home.Đến (sản phẩm)') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price"
                                                           name="sales[]" required
                                                           placeholder={{ __('home.Giảm %') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price"
                                                           name="days[]" required
                                                           placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                </div>
                                                <div class="">
                                                    <input type="number" class="form-control form-price"
                                                           name="ships[]" required
                                                           placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                </div>
                                                <div class="">
                                                    <button type="button" class="btn remove-form-field"><i
                                                                class="fa-regular fa-trash-can"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="name s12w5">{{ __('home.Tất cả danh mục') }} <span class="text-danger">*</span>
                            </div>
                            <div id="checkboxes" style="display: block">
                                @php
                                    $productListCategory = $product->list_category;
                                    $productArrayCategory = explode(',', $productListCategory);
                                @endphp
                                @foreach($categories as $category)
                                    @if (!in_array($category->id, $categoriesRegister))
                                        <div class="unregister" data-toggle="modal" data-id="{{$category->id}}"
                                             data-target="#exampleModal-{{$category->id}}">
                                            <label class="ml-2" for="category-{{$category->id}}">
                                                <input type="checkbox" id="category-{{$category->id}}"
                                                       name="category-{{$category->id}}"
                                                       value="{{$category->id}}"
                                                       class="inputCheckboxCategory mr-2 p-3"
                                                        @php
                                                            echo in_array($category->id, $categoriesRegister) ? '' :'disabled';
                                                        @endphp/>
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
                                        <div class="modal fade" id="exampleModal-{{$category->id}}" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true"
                                             data-backdrop="static">
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
                                                        This type of category of yours has not been registered.<br>
                                                        Would you like to add this category?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <button type="button" class="btn btn-primary addCategory"
                                                                data-cate="{{$category->id}}"
                                                                href="{{route('categories.register', $category->id)}}">
                                                            Add now
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
                                                   {{ in_array($category->id, $productArrayCategory) ? 'checked' : '' }}
                                                   class="inputCheckboxCategory mr-2 p-3"/>
                                            <span class="labelCheckboxCategory">{{($category->name)}}</span>
                                        </label>
                                    @endif
                                    @if(!$categories->isEmpty())
                                        @php
                                            $categories = DB::table('categories')->where('parent_id', $category->id)->get();
                                        @endphp
                                        @foreach($categories as $child)
                                            @if(!in_array($child->id, $categoriesRegister))
                                                <div class="unregister" data-toggle="modal" data-id="{{$child->id}}"
                                                     data-target="#exampleModal-{{$child->id}}">
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
                                                <div class="modal fade" id="exampleModal-{{$child->id}}" tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                     data-backdrop="static">
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
                                                                This type of category of yours has not been
                                                                registered.<br>
                                                                Would you like to add this category?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-primary addCategory"
                                                                        data-cate="{{$child->id}}"
                                                                        href="{{route('categories.register', $child->id)}}">
                                                                    Add now
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <label class="ml-4" for="category-{{$child->id}}">
                                                    <input type="checkbox" id="category-{{$child->id}}"
                                                           name="category-{{$child->id}}"
                                                           value="{{$child->id}}"
                                                           {{ in_array($child->id, $productArrayCategory) ? 'checked' : '' }}
                                                           class="inputCheckboxCategory mr-2 p-3"/>
                                                    <span class="labelCheckboxCategory">{{($child->name)}}</span>
                                                </label>
                                            @endif
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
                                                @if(!in_array($child2->id, $categoriesRegister))
                                                    <div class="unregister" data-toggle="modal"
                                                         data-id="{{$child2->id}}"
                                                         data-target="#exampleModal-{{$child2->id}}">
                                                        <label class="ml-5" for="category-{{$child2->id}}">
                                                            <input type="checkbox" id="category-{{$child2->id}}"
                                                                   name="category-{{$child2->id}}"
                                                                   value="{{$child2->id}}"
                                                                   class="inputCheckboxCategory mr-2 p-3"
                                                                    @php
                                                                        echo in_array($child2->id, $categoriesRegister) ? '' :'disabled';
                                                                    @endphp/>
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
                                                    <div class="modal fade" id="exampleModal-{{$child2->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                         data-backdrop="static">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    This type of category of yours has not been
                                                                    registered.<br>
                                                                    Would you like to add this category?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Cancel
                                                                    </button>
                                                                    <button type="button"
                                                                            class="btn btn-primary addCategory"
                                                                            data-cate="{{$child2->id}}"
                                                                            href="{{route('categories.register', $child2->id)}}">
                                                                        Add now
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <label class="ml-5" for="category-{{$child2->id}}">
                                                        <input type="checkbox" id="category-{{$child2->id}}"
                                                               name="category-{{$child2->id}}"
                                                               value="{{$child2->id}}"
                                                               {{ in_array($child2->id, $productArrayCategory) ? 'checked' : '' }}
                                                               class="inputCheckboxCategory mr-2 p-3"/>
                                                        <span class="labelCheckboxCategory">{{($child2->name)}}</span>
                                                    </label>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="list-images">
                            <div class="thumbnail">
                                <div class="title s12w5 mb-3">Thumbnail</div>
                                @php
                                    $thumbnail = checkThumbnail($product->thumbnail);
                                @endphp
                                <img src="{{ $thumbnail }}" alt=""
                                     style="max-width: 100px; width: 100%; object-fit: cover">
                            </div>
                            <div class="gallery">
                                <div class="title s12w5 mb-3">Gallery</div>
                                @php
                                    $gallery = $product->gallery;
                                    $arrayGallery = explode(',', $gallery);
                                @endphp
                                <div class="gallery-images d-flex flex-wrap">
                                    @foreach($arrayGallery as $image)
                                        @php
                                            $thumbnail = checkThumbnail($image);
                                        @endphp
                                        <img src="{{ $thumbnail }}" alt="" class="p-3"
                                             style="max-width: 100px; width: 100%; object-fit: cover;">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="removeInputAttributeEdit" class="form-group row">
                    @if(!$productDetails->isEmpty())
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Attribute</th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Old Price</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productDetails as $productDetail)
                                @if($productDetail->variation && $productDetail->variation != 0)
                                    <tr>
                                        @php
                                            $variable = $productDetail->variation;
                                            $arrayVariation = explode(',', $variable);
                                        @endphp
                                        <td>
                                            @foreach($arrayVariation as $itemVariation)
                                                @php
                                                    $arrayItemVariation = explode('-', $itemVariation);
                                                    $attributeVariation = \App\Models\Attribute::where('id', $arrayItemVariation[0])
                                                        ->where('status', \App\Enums\AttributeStatus::ACTIVE)->first();
                                                    $propertyVariation = \App\Models\Properties::where('id', $arrayItemVariation[1])
                                                        ->where('status', PropertiStatus::ACTIVE)->first();
                                                @endphp
                                                @if($attributeVariation)
                                                    {{$attributeVariation->name}}:
                                                    @if($propertyVariation)
                                                        {{$propertyVariation->name}}
                                                    @endif,
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $thumbnail = checkThumbnail($productDetail->thumbnail);
                                            @endphp
                                            @if ($thumbnail)
                                                <img class="mt-2 mb-2"
                                                     style="height: 100px"
                                                     src="{{ $thumbnail }}"
                                                     alt="Thumbnail">
                                            @endif
                                            <input type="file"
                                                   class="form-control-file"
                                                   id="thumbnail"
                                                   name="thumbnail{{$productDetail->id}}"
                                                   accept="image/*">
                                        </td>
                                        <td>
                                            <input type="number" required
                                                   class="form-control"
                                                   id="price{{$productDetail->id}}"
                                                   name="old_price{{$productDetail->id}}"
                                                   value="{{ $productDetail->old_price }}">
                                        </td>
                                        <td>
                                            <input type="number" required
                                                   class="form-control"
                                                   id="qty{{$productDetail->id}}"
                                                   name="price{{$productDetail->id}}"
                                                   value="{{$productDetail->price }}">
                                        </td>
                                        <td>
                                            <input type="number" required
                                                   class="form-control"
                                                   id="quantity{{$productDetail->id}}"
                                                   name="quantity{{$productDetail->id}}"
                                                   value="{{$productDetail->quantity }}">
                                        </td>
                                        <td>
                                                    <textarea class="form-control"
                                                              name="description{{$productDetail->id}}"
                                                              rows="5">
                                                    {{$productDetail->description }}
                                                    </textarea>
                                        </td>
                                        <td>
                                            <input hidden="" name="id{{$loop->index+1}}"
                                                   value="{{$productDetail->id}}">
                                            <a class="btnRemove btn btn-danger mb-3" style="color: white"
                                               data-value="{{$productDetail->id}}">Remove</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <input type="text" hidden="" name="count" value="{{count($productDetails)}}">
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="row mb-5" id="renderInputAttribute">

                </div>
                <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
                <div class="form-group text-center">
                    <button type="submit" class="btn btnSave">{{ __('home.Save') }}</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        var url = `{{ route('product.v2.create.attribute') }}`;
        var urla = `{{asset('/seller/delete-variable-v2')}}`;
        var token = `{{ csrf_token() }}`;
        var urlCategory = `{{ route('categories.register', ['id' => ':categoryID']) }}`;
    </script>
    <script src="{{ asset('js/backend/products-edit.js') }}"></script>
@endsection
