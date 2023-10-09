@php
    use App\Enums\PropertiStatus;use Illuminate\Support\Facades\DB;
@endphp

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
<style>
    /**/
    select {
        display: none;
    }

    #selectAttribute {
        display: block !important;
    }

    #attribute_id {
        display: block !important;
    }
</style>
@section('content')
    <div id="wpcontent" class="wpcontent">
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
                            <div class="name">{{ __('home.Tên sản phẩm') }}</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm" value="{{($product->name)}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="short_description">{{ __('home.Mô tả ngắn') }}</label>
                            <textarea id="short_description" class="form-control description" name="short_description"
                                      rows="5">{{$product->short_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('home.Mô tả chi tiết') }}</label>
                            <textarea id="description" class="form-control description" name="description"
                                      rows="5">{{$product->description}}</textarea>
                        </div>
                        <input id="inputHotProduct" type="text" class="d-none" value="{{ $product->hot }}">
                        <input id="inputFeatureProduct" type="text" class="d-none" value="{{ $product->feature }}">
                        <div class="form-group row ">
                            @for($i = 0; $i< count($permissionUsers); $i++)
                                @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                                    <div class="col-4 d-flex align-items-center">
                                        <label for="hot_product">{{ __('home.Sản phẩm hot') }}</label>
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
                                        <label for="feature_product" class="">{{ __('home.Sản phẩm nổi bật') }}</label>
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
                            <label for="gallery">{{ __('home.Thư viện ảnh') }}:</label>
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
                                                    @if ($productDetail->thumbnail)
                                                        <img class="mt-2 mb-2"
                                                             style="height: 100px"
                                                             src="{{ asset('storage/' . $productDetail->thumbnail) }}"
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

                        <div class="form-group mt-2">
                            @include('backend.products.demo')
                        </div>

                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">{{ __('home.Giá bán') }}</div>
                            <input type="number" class="form-control" name="giaban" id="name"
                                   placeholder="Nhập giá bán" value="{{$product->old_price}}"
                                   required min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Nhập giá khuyến mãi(nếu có)') }}</div>
                            <input type="number" class="form-control" name="giakhuyenmai" id="name"
                                   placeholder="Nhập giá khuyến mãi" value="{{$product->price}}" min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Nhập số lượng') }}</div>
                            <input type="number" class="form-control" name="qty" id="qty"
                                   placeholder="Nhập giá khuyến mãi" value="{{$product->qty}}" min="1">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Xuất xứ') }}</div>
                            <input type="text" class="form-control" name="origin" id="origin" placeholder="Nhập xuất xứ"
                                   value="{{$product->origin}}">
                        </div>
                        <div class="form-group">
                            <div class="name">{{ __('home.Sản phẩm tối thiểu') }}</div>
                            <input type="number" value="{{$product->min}}" class="form-control" name="min" id="min"
                                   placeholder="Nhập số lượng tối thiểu" min="1">
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="name">{{ __('home.Mua nhiều giảm giá') }}</div>
                            </div>
                            <div>
                                <div class="">
                                    <div class="add-fields" data-af_base="#base-package-fields"
                                         data-af_target=".packages">
                                        <div class="packages">

                                        </div>
                                        <button type="button" class="btn add-form-field"><i
                                                    class="fa-solid fa-plus"></i> {{ __('home.Thêm khoảng giá') }}
                                        </button>
                                    </div>
                                    <div id="base-package-fields" hidden>
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
                                                                       class="form-control form-price" name="sales[]"
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
                                                                       class="form-control form-price" name="ships[]"
                                                                       required
                                                                       placeholder={{ __('home.Ngày giao hàng dự kiến') }}>
                                                            </div>
                                                            <div class="">
                                                                <button type="button" class="btn remove-form-field"><i
                                                                            class="fa-regular fa-trash-can"></i>
                                                                </button>
                                                            </div>
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
                            <div class="name">{{ __('home.Tất cả danh mục') }}</div>
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
                                                        <button type="button" class="btn btn-primary addCategory" data-cate="{{$category->id}}" href="{{route('categories.register', $category->id)}}">Add now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <label class="ml-2" for="category-{{$category->id}}">
                                            <input type="checkbox" id="category-{{$category->id}}"
                                                   name="category-{{$category->id}}"
                                                   value="{{$category->id}}"
                                                   {{ $isValid ? 'checked' : '' }}
                                                   class="inputCheckboxCategory mr-2 p-3"/>
                                            <span class="labelCheckboxCategory">{{($category->name)}}</span>
                                        </label>
                                    @endif
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
                                                                This type of category of yours has not been registered.<br>
                                                                Would you like to add this category?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="button" class="btn btn-primary addCategory" data-cate="{{$child->id}}" href="{{route('categories.register', $child->id)}}">Add now</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <label class="ml-4" for="category-{{$child->id}}">
                                                    <input type="checkbox" id="category-{{$child->id}}"
                                                           name="category-{{$child->id}}"
                                                           value="{{$child->id}}"
                                                           {{ $isValidChild ? 'checked' : '' }}
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
                                                               {{ $isValidChild2 ? 'checked' : '' }}
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
            <button type="submit" id="btnDeleteVariable">{{ __('home.Delete') }}</button>
        </form>
    </div><!-- wpcontent -->
    <script src="{{ asset('js/backend/products-create.js') }}"></script>
    <script>
        var url = `{{ route('product.v2.create.attribute') }}`;
        var urla = `{{asset('/seller/delete-variable-v2')}}`;
        var token = `{{ csrf_token() }}`;
        var urlCategory = `{{ route('categories.register', ['id' => ':categoryID']) }}`;
    </script>
    <script src="{{ asset('js/backend/products-edit.js') }}"></script>
@endsection
