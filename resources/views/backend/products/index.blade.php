@extends('backend.layouts.master')

@section('title')
    List Products
@endsection
@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
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

    $isAdmin = (new  \App\Http\Controllers\Frontend\HomeController())->checkAdmin();
@endphp
@section('content')
    <div id="wpbody-content" class="snipcss-PfbzX">
        <div class="">
            {{--START TABLE--}}
            <table class="wp-list-table widefat fixed striped table-view-list posts">
                {{--START THEAD TABLE--}}
                <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">
                            {{ __('home.chọn toàn bộ') }}
                        </label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="thumb" class="manage-column column-thumb">
              <span class="wc-image tips">
                {{ __('home.Image') }}
              </span>
                    </th>
                    <th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
                        <a href="#">
                <span>
                  {{ __('home.Name') }}
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" id="sku" class="manage-column column-sku sortable desc">
                        <a href="#">
                <span>
                  {{ __('home.người đăng') }}
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" id="is_in_stock" class="manage-column column-is_in_stock">
                        {{ __('home.stock') }}
                    </th>
                    <th scope="col" id="price" class="manage-column column-price sortable desc">
                        <a href="#">
                <span>
                  {{ __('home.Price') }}
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" id="product_cat" class="manage-column column-product_cat">
                        {{ __('home.CATEGORIES') }}
                    </th>
                    <th scope="col" id="hot" class="manage-column column-hot style-RlVfN">
                              <span class="wc-hot parent-tips" data-tip="Hot">
                                Hot
                              </span>
                    </th>
                    <th scope="col" id="featured" class="manage-column column-featured style-RlVfN">
                        {{ __('home.featured') }}
                    </th>
                    <th scope="col" id="date" class="manage-column column-date sortable asc">
                        <a href="#">
                                <span>
                                    {{ __('home.Date') }}
                                </span>
                            <span class="sorting-indicator">
                                </span>
                        </a>
                    </th>
                </tr>
                </thead>
                {{--END THEAD TABLE--}}

                {{--START TBODY TABLE--}}
                <tbody id="the-list">
                @if(!$products->isEmpty())
                    @foreach($products as $product)
                        <tr id="product-{{$product->id}}"
                            class="iedit author-self level-0 post-42 type-product status-publish hentry product_cat-uncategorized entry">
                            <th scope="row" class="check-column">
                                <label class="screen-reader-text" for="cb-select-42">
                                    {{ __('home.chọn') }} {{$product->name}}
                                </label>
                                <input id="cb-select-{{$product->id}}" type="checkbox" name="post[]"
                                       value="{{$product->id}}">
                                <div class="locked-indicator">
                                    <span class="locked-indicator-icon" aria-hidden="true"></span>
                                    <span class="screen-reader-text">“{{$product->name}}” {{ __('home.đã bị khóa') }}</span>
                                </div>
                            </th>
                            <td class="thumb column-thumb" data-colname="Image">
                                <a href="#">
                                    @if($product->thumbnail)
                                        <img width="150" height="150"
                                             src="{{ asset('storage/'.$product->thumbnail) }}"
                                             class="woocommerce-placeholder wp-post-image" alt="Placeholder"
                                             decoding="async"
                                             loading="lazy">
                                    @else
                                        <img width="150" height="150"
                                             src="data:image/png;base64,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"
                                             class="woocommerce-placeholder wp-post-image" alt="Placeholder"
                                             decoding="async"
                                             loading="lazy">
                                    @endif
                                </a>
                            </td>
                            <td class="name column-name has-row-actions column-primary" data-colname="Name">
                                <strong>
                                    <a class="row-title"
                                       href="{{route('seller.products.edit', $product->id)}}">
                                        @php
                                            $ld = new \App\Http\Controllers\TranslateController();
                                        @endphp
                                        {{ $ld->translateText($product->name, locationPermissionHelper()) }}

                                    </a>
                                </strong>
                                <div class="row-actions">
                                    <span class="id">
                                      ID: {{$product->id}} |
                                    </span>
                                    <span class="edit">
                                          <a href="{{route('seller.products.edit', $product->id)}}"
                                             aria-label="Sửa “{{$product->name}}”">
                                            {{ __('home.chỉnh sửa') }}
                                          </a>
                                      |
                                    </span>
                                    <span class="inline hide-if-no-js">
                                          <button type="button" class="button-link editinline"
                                                  aria-label="Chỉnh sửa nhanh “{{$product->name}}”"
                                                  aria-expanded="false" data-toggle="modal"
                                                  onclick="checkHotAndFeature({{$product->id}});"
                                                  data-target="#exampleQuickEditProduct{{$product->id}}">
                                            {{ __('home.Sửa nhanh') }}
                                          </button>
                                          |
                                        <!-- Modal -->
                                         <div class="modal fade" id="exampleQuickEditProduct{{$product->id}}"
                                              tabindex="-1" role="dialog"
                                              aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                 <form action="{{ route('seller.products.update', $product->id) }}"
                                                       method="POST"
                                                       enctype="multipart/form-data">
                                                     @csrf
                                                    <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title text-black"
                                                                id="exampleModalLabel">Quick Edit {{$product->name}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                                @php
                                                                    $att_of_product = DB::table('product_attribute')->where('product_id', $product->id)->get();
                                                                    $productDetails = \App\Models\Variation::where('product_id', $product->id)->get();
                                                                @endphp
                                                          <div class="modal-body">

                                                              <div class="form-group">
                                                                <label for="name">{{ __('home.Name') }}</label>
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name"
                                                                       value="{{ $product->name }}">
                                                              </div>

                                                               <div class="form-group">
                                                                    <label for="category">{{ __('home.category') }}</label>
                                                                    <select class="form-control" id="category"
                                                                            name="category_id">
                                                                        <option value="">-- Select Category --</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
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
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
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
                                                    class="fa-solid fa-plus"></i> {{ __('home.Thêm khoảng giá') }}</button>
                                    </div>
                                    <div id="base-package-fields" hidden>
                                        @php
                                            $price_sales = \App\Models\ProductSale::where('product_id', '=', $product->id)->get();
                                        @endphp
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
                                                            <button type="button" class="btn remove-form-field"><i
                                                                        class="fa-regular fa-trash-can"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="form-group form-group-price">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <input type="number" class="form-control form-price"
                                                               name="quantity[]" placeholder="Từ (sản phẩm)">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="form-control form-price"
                                                               name="sales[]" placeholder="Giảm %">
                                                    </div>
                                                    <div class="">
                                                        <button type="button" class="btn remove-form-field"><i
                                                                    class="fa-regular fa-trash-can"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                                                                <div class="form-group">
                                                                    @if(!$productDetails->isEmpty())
                                                                        @if(count($productDetails)>1)
                                                                            @foreach($productDetails as $productDetail)
                                                                                @if($productDetail->variation && $productDetail->variation != 0)
                                                                                    <div class="form-group">
                                                                                <label class="control-label">{{ __('home.Thông số sản phẩm') }}</label>
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
                                                                                                   for="color">{{$attributeVariation->name}}</label>
                                                                                        <div class="col-md-12 overflow-scroll custom-scrollbar">
                                                                                                <ul class="list-unstyled">
                                                                                                        <li>
                                                                                                            <input onchange="checkInput();"
                                                                                                                   class="property-attribute"
                                                                                                                   id="property-{{$propertyVariation->id}}"
                                                                                                                   type="checkbox"
                                                                                                                   name="attribute-property-{{$loop->index+1}}"
                                                                                                                   value="{{$attributeVariation->id}}-{{$propertyVariation->id}}"
                                                                                                                   checked
                                                                                                                   disabled>
                                                                                                            {{$propertyVariation->name}}
                                                                                                        </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach
                                                                            </div>

                                                                                    <div class="form-group">
                                                                                    <label for="price">{{ __('home.Giá bán') }}</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="price{{$productDetail->id}}"
                                                                                           name="old_price{{$productDetail->id}}"
                                                                                           value="{{ $productDetail->old_price }}">
                                                                            </div>

                                                                                    <div class="form-group">
                                                                                    <label for="qty">{{ __('home.Giá khuyến mãi') }}</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="qty{{$productDetail->id}}"
                                                                                           name="price{{$productDetail->id}}"
                                                                                           value="{{$productDetail->price }}">
                                                                            </div>

                                                                                    <div class="form-group">
                                                                                        <div class="name">{{ __('home.Nhập số lượng') }}</div>
                                                                                        <input type="number"
                                                                                               class="form-control"
                                                                                               name="qty" id="qty"
                                                                                               placeholder="Nhập giá khuyến mãi"
                                                                                               value="{{$product->qty}}"
                                                                                               min="1">
                                                                                    </div>

                                                                                    <div class="form-group">
                                                                                <label for="thumbnail">{{ __('home.thumbnail') }}</label>
                                                                                <input type="file"
                                                                                       class="form-control-file"
                                                                                       id="thumbnail"
                                                                                       name="thumbnail{{$productDetail->id}}"
                                                                                       accept="image/*">
                                                                                @if ($productDetail->thumbnail)
                                                                                            <img class="mt-2"
                                                                                                 style="height: 100px"
                                                                                                 src="{{ asset('storage/' . $productDetail->thumbnail) }}"
                                                                                                 alt="Thumbnail">
                                                                                            </a>
                                                                                        @endif
                                                                            </div>
                                                                                @endif
                                                                                <input hidden=""
                                                                                       name="id{{$loop->index+1}}"
                                                                                       value="{{$productDetail->id}}">
                                                                            @endforeach
                                                                            <input hidden="" name="countBegin"
                                                                                   value="{{count($productDetails)}}">
                                                                        @else
                                                                            @php
                                                                                $productDetail = $productDetails[0];
                                                                            @endphp
                                                                            <div class="form-group">
                                                                                    <label for="price">{{ __('home.Giá bán') }}</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="price{{$productDetail->id}}"
                                                                                           name="old_price1"
                                                                                           value="{{ $productDetail->old_price }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="qty">{{ __('home.Giá khuyến mãi') }}</label>
                                                                                <input type="number"
                                                                                       class="form-control"
                                                                                       id="qty{{$productDetail->id}}"
                                                                                       name="price1"
                                                                                       value="{{$productDetail->price }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="thumbnail">{{ __('home.thumbnail') }}</label>
                                                                                <input type="file"
                                                                                       class="form-control-file"
                                                                                       id="thumbnail"
                                                                                       name="thumbnail{{$loop->index+1}}"
                                                                                       accept="image/*">
                                                                                @if ($productDetail->thumbnail)
                                                                                    <img class="mt-2"
                                                                                         style="height: 100px"
                                                                                         src="{{ asset('storage/' . $productDetail->thumbnail) }}"
                                                                                         alt="Thumbnail">
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                            <input hidden="" name="countBegin"
                                                                                   value="1">
                                                                        @endif
                                                                    @endif
                                                                </div>

                                                                <input id="inputHotProduct{{$product->id}}" type="text"
                                                                       class="d-none"
                                                                       value="{{ $product->hot }}">
                                                                <input id="inputFeatureProduct{{$product->id}}"
                                                                       type="text"
                                                                       class="d-none"
                                                                       value="{{ $product->feature }}">

                                                                <div class="form-group row">
                                                                    @for($i = 0; $i< count($permissionUsers); $i++)
                                                                        @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                                                                            <div class="col-4 d-flex">
                                                                                <label for="hot_product"
                                                                                       class="col-8 col-sm-8">{{ __('home.Sản phẩm hot') }}</label>
                                                                                <div class="col-4 col-sm-4">
                                                                                    <input class="form-control"
                                                                                           type="checkbox"
                                                                                           id="hot_product{{$product->id}}"
                                                                                           name="hot_product">
                                                                                </div>
                                                                            </div>
                                                                            @break
                                                                        @endif
                                                                    @endfor
                                                                    @for($i = 0; $i< count($permissionUsers); $i++)
                                                                        @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm nổi bật')
                                                                            <div class="col-4 d-flex">
                                                                                <label for="feature_product"
                                                                                       class="col-8 col-sm-8">{{ __('home.Sản phẩm nổi bật') }}</label>
                                                                                <div class="col-4 col-sm-4">
                                                                                    <input class="form-control"
                                                                                           type="checkbox"
                                                                                           id="feature_product{{$product->id}}"
                                                                                           name="feature_product">
                                                                                </div>
                                                                            </div>
                                                                            @break
                                                                        @endif
                                                                    @endfor
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="gallery">Gallery</label>
                                                                    <input type="file" class="form-control-file"
                                                                           id="gallery"
                                                                           name="gallery[]" accept="image/*"
                                                                           multiple>
                                                                    @php
                                                                        $input = $product->gallery;
                                                                        $array = json_decode($input, true);
                                                                        $modifiedArray = explode(",", $input);
                                                                    @endphp
                                                                    @if ($product->gallery )
                                                                        @foreach ($modifiedArray as $image)
                                                                            <a href="{{ asset('storage/' . $image) }}"
                                                                               data-fancybox="group"
                                                                               data-caption="This image has a caption 1">
                                                                                <img class="mt-2"
                                                                                     style="height: 100px; width: 100px "
                                                                                     src="{{ asset('storage/' . $image) }}"
                                                                                     alt="Gallery Image" width="100">
                                                                            </a>
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                               <input id="input-form-create-attribute{{$product->id}}"
                                                                      name="attribute_property"
                                                                      type="text" hidden>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('home.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-primary">Save changes</button>
                                                          </div>
                                                     </div>
                                                </form>
                                              </div>
                                            </div>
                                    </span>
                                    <span class="trash">
                                         <a class="delete" data-toggle="modal"
                                            data-target="#modalDeleteProduct{{$product->id}}">
                                                       {{ __('home.delete') }}
                                                    </a>
                                        <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteProduct{{$product->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('seller.products.destroy', $product)}}"
                                                                  method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="text-center">
                                                                        {{ __('home.Bạn có chắc chắn muốn xoá') }} : {{$product->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        {{ __('home.Nếu xoá bạn sẽ không thể không thể tìm thấy nó!Chúng tôi sẽ không chịu trách nhiệm cho việc này!') }}
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('home.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">Yes</button>
                                                                  </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                          |
                                    </span>
                                    <span class="view">
                                          <a href="#" rel="bookmark"
                                             aria-label="Xem “{{$product->name}}”">
                                            Xem
                                          </a>
                                          |
                                    </span>
                                    <span class="duplicate">
                                        <a href="#"
                                           aria-label="Make a duplicate from this product" rel="permalink">
                                            Duplicate
                                        </a>
                                    </span>
                                </div>
                                <button type="button" class="toggle-row">
                                    <span class="screen-reader-text">
                                        Hiển thị chi tiết
                                    </span>
                                </button>
                            </td>
                            <td class="sku column-sku" data-colname="SKU">
                                @php
                                    $namenewProduct = DB::table('users')->where('id', $product->user_id)->first();
                                @endphp
                                <span class="na">
                                {{$namenewProduct->name}}
                              </span>
                            </td>
                            <td class="is_in_stock column-is_in_stock" data-colname="Stock">
                                <mark class="instock">
                                    {{$product->status}}
                                </mark>
                            </td>
                            <td class="price column-price" data-colname="Price">
                                {{$product->price}}
                            </td>
                            <td class="product_cat column-product_cat" data-colname="Categories">
                                @php
                                    $listCate = $product->list_category;
                                    $cate1 = explode(',', $listCate);
                                @endphp
                                @foreach($cate1 as $cates)
                                    @php
                                        $category = \App\Models\Category::find($cates);
                                    @endphp
                                    @if($category)
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
                                    @endif
                                @endforeach
                            </td>
                            <td class="hot column-hot" data-colname="Hot">
                                    @if($product->hot == 1)
                                        <label class="switch">
                                            <input value="{{$product->id}}" class="inputHotCheckbox"
                                                   name="inputHot-{{$product->id}}" id="inputHot-{{$product->id}}"
                                                   type="checkbox" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    @else
                                        <label class="switch">
                                            <input value="{{$product->id}}" class="inputHotCheckbox"
                                                   name="inputHot-{{$product->id}}" id="inputHot-{{$product->id}}"
                                                   type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    @endif
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" role="dialog"
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
                                                {{ __('home.Bạn có muốn nâng cấp sản phẩm không') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('home.Close') }}</button>
                                                <button type="button" class="btn btn-primary"><a
                                                            href="{{route('permission.list.show')}}">{{ __('home.Sign up to upgrade') }}</a>
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="featured column-featured" data-colname="Featured">
                                    @if($product->feature == 1)
                                        <label class="switch">
                                            <input value="{{$product->id}}" class="inputFeatureCheckbox"
                                                   name="inputFeature-{{$product->id}}"
                                                   id="inputFeature-{{$product->id}}"
                                                   type="checkbox" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    @else
                                        <label class="switch">
                                            <input value="{{$product->id}}" class="inputFeatureCheckbox"
                                                   name="inputFeature-{{$product->id}}"
                                                   id="inputFeature-{{$product->id}}"
                                                   type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    @endif
                            </td>
                            <td>
                                {{ __('home.Đã xuất bản') }} <br>
                                {{$product->created_at}}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                {{--END TBODY TABLE--}}

            </table>
        </div>
    </div>
    <script>
        var url =  `{{ route('seller.products.hot', ['id' => ':productID']) }}`;
        var urla = `{{ route('seller.products.feature', ['id' => ':productID']) }}`;
    </script>
    <script src="{{ asset('js/backend/products-index.js') }}"> </script>
@endsection