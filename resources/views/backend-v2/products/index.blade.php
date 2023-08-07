<link rel="stylesheet" href="{{asset('css/backend_products_v2.css')}}">
@extends('backend-v2.layouts.master')

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

@endphp
@section('content')
    <div id="wpbody-content" class="snipcss-PfbzX">
        <div class="wrap">
            <h1 class="wp-heading-inline">
                Products
            </h1>
            <a href="{{route('product.v2.processCreate')}}" class="page-title-action">
                Add New
            </a>
            <a href="#" class="page-title-action">
                Import
            </a>
            <a href="#" class="page-title-action">
                Export
            </a>
            <hr class="wp-header-end">

            <h2 class="screen-reader-text">
                Filter products
            </h2>
            <ul class="subsubsub">
                <li class="all">
                    <a href="#" class="current" aria-current="page">
                        Tất cả
                        <span class="count">
            (1)
          </span>
                    </a>
                    |
                </li>
                <li class="publish">
                    <a href="#">
                        Đã xuất bản
                        <span class="count">
            (1)
          </span>
                    </a>
                    |
                </li>
                <li class="byorder">
                    <a href="#">
                        Sorting
                    </a>
                </li>
            </ul>
            <form id="posts-filter" method="get">
                <p class="search-box">
                    <label class="screen-reader-text" for="post-search-input">
                        Search products:
                    </label>
                    <input type="search" id="post-search-input" name="s" value="">
                    <input type="submit" id="search-submit" class="button" value="Search products">
                </p>
            </form>
            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <label for="bulk-action-selector-top" class="screen-reader-text">
                        Lựa chọn thao tác hàng loạt
                    </label>
                    <select name="action" id="bulk-action-selector-top">
                        <option value="-1">
                            Hành động
                        </option>
                        <option value="edit" class="hide-if-no-js">
                            Chỉnh sửa
                        </option>
                        <option value="trash">
                            Bỏ vào thùng rác
                        </option>
                    </select>
                    <input type="submit" id="doaction" class="button action" value="Áp dụng">
                </div>
                <div class="alignleft actions">
                    <select name="product_cat" id="product_cat" class="dropdown_product_cat">
                        <option value="" selected="selected">
                            Select a category
                        </option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                    <select name="product_type" id="dropdown_product_type">
                        <option value="">
                            Filter by product type
                        </option>
                        <option value="simple">
                            Simple product
                        </option>
                        <option value="downloadable">
                            → Downloadable
                        </option>
                        <option value="virtual">
                            → Virtual
                        </option>
                        <option value="grouped">
                            Grouped product
                        </option>
                        <option value="external">
                            External/Affiliate product
                        </option>
                        <option value="variable">
                            Variable product
                        </option>
                    </select>
                    <select name="stock_status">
                        <option value="">
                            Filter by stock status
                        </option>
                        <option value="instock">
                            In stock
                        </option>
                        <option value="outofstock">
                            Out of stock
                        </option>
                        <option value="onbackorder">
                            On backorder
                        </option>
                    </select>
                    <input type="submit" name="filter_action" id="post-query-submit" class="button" value="Lọc">
                </div>
                <div class="tablenav-pages one-page">
          <span class="displaying-num">
            0 mục
          </span>
                    <span class="pagination-links">
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              «
            </span>
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              ‹
            </span>
            <span class="paging-input">
              <label for="current-page-selector" class="screen-reader-text">
                Trang hiện tại
              </label>
              <input class="current-page" id="current-page-selector" type="text" name="paged" value="1" size="1"
                     aria-describedby="table-paging">
              <span class="tablenav-paging-text">
                trên
                <span class="total-pages">
                  1
                </span>
              </span>
            </span>
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              ›
            </span>
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              »
            </span>
          </span>
                </div>
                <br class="clear">
            </div>
            <h2 class="screen-reader-text">
                Products list
            </h2>

            {{--START TABLE--}}
            <table class="wp-list-table widefat fixed striped table-view-list posts">
                {{--START THEAD TABLE--}}
                <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">
                            Chọn toàn bộ
                        </label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="thumb" class="manage-column column-thumb">
              <span class="wc-image tips">
                Image
              </span>
                    </th>
                    <th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
                        <a href="#">
                <span>
                  Name
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" id="sku" class="manage-column column-sku sortable desc">
                        <a href="#">
                <span>
                  SKU
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" id="is_in_stock" class="manage-column column-is_in_stock">
                        Stock
                    </th>
                    <th scope="col" id="price" class="manage-column column-price sortable desc">
                        <a href="#">
                <span>
                  Price
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" id="product_cat" class="manage-column column-product_cat">
                        Categories
                    </th>
                    <th scope="col" id="product_tag" class="manage-column column-product_tag">
                        Tags
                    </th>
                    <th scope="col" id="hot" class="manage-column column-hot style-RlVfN">
                              <span class="wc-hot parent-tips" data-tip="Hot">
                                Hot
                              </span>
                    </th>
                    <th scope="col" id="featured" class="manage-column column-featured style-RlVfN">
                        Featured
                    </th>
                    <th scope="col" id="date" class="manage-column column-date sortable asc">
                        <a href="#">
                                <span>
                                    Date
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
                        @php
                            $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                        @endphp
                        <tr id="product-{{$product->id}}"
                            class="iedit author-self level-0 post-42 type-product status-publish hentry product_cat-uncategorized entry">
                            <th scope="row" class="check-column">
                                <label class="screen-reader-text" for="cb-select-42">
                                    Chọn {{$product->name}}
                                </label>
                                <input id="cb-select-{{$product->id}}" type="checkbox" name="post[]"
                                       value="{{$product->id}}">
                                <div class="locked-indicator">
                                    <span class="locked-indicator-icon" aria-hidden="true"></span>
                                    <span class="screen-reader-text">“{{$product->name}}” đã bị khóa</span>
                                </div>
                            </th>
                            <td class="thumb column-thumb" data-colname="Image">
                                <a href="#">
                                    @if($productDetail && $productDetail->thumbnail)
                                        <img width="150" height="150"
                                             src="{{ asset('storage/'.$productDetail->thumbnail) }}"
                                             class="woocommerce-placeholder wp-post-image" alt="Placeholder"
                                             decoding="async"
                                             loading="lazy">
                                    @else
                                        <img width="150" height="150"
                                             src="{{ asset('storage/'.$product->thumbnail) }}"
                                             class="woocommerce-placeholder wp-post-image" alt="Placeholder"
                                             decoding="async"
                                             loading="lazy">
                                    @endif
                                </a>
                            </td>
                            <td class="name column-name has-row-actions column-primary" data-colname="Name">
                                <strong>
                                    <a class="row-title"
                                       href="{{route('product.v2.edit', $product->id)}}">
                                        {{$product->name}}
                                    </a>
                                </strong>
                                <div class="row-actions">
                                    <span class="id">
                                      ID: {{$product->id}} |
                                    </span>
                                    <span class="edit">
                                          <a href="{{route('product.v2.edit', $product->id)}}"
                                             aria-label="Sửa “{{$product->name}}”">
                                            Chỉnh sửa
                                          </a>
                                      |
                                    </span>
                                    <span class="inline hide-if-no-js">
                                          <button type="button" class="button-link editinline"
                                                  aria-label="Chỉnh sửa nhanh “{{$product->name}}”"
                                                  aria-expanded="false" data-toggle="modal"
                                                  onclick="checkHotAndFeature({{$product->id}});"
                                                  data-target="#exampleQuickEditProduct{{$product->id}}">
                                            Sửa nhanh
                                          </button>
                                          |
                                        <!-- Modal -->
                                            <div class="modal fade" id="exampleQuickEditProduct{{$product->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                 <form action="{{ route('product.v2.update.quick', $product->id) }}"
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
                                                                <label for="name">Name</label>
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name"
                                                                       value="{{ $product->name }}">
                                                              </div>

                                                               <div class="form-group">
                                                                    <label for="category">Category</label>
                                                                    <select class="form-control" id="category"
                                                                            name="category_id">
                                                                        <option value="">-- Select Category --</option>
                                                                        @foreach ($categories as $category)
                                                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                                {{ $category->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    @if(!$productDetails->isEmpty())
                                                                        @if(count($productDetails)>1)
                                                                            @foreach($productDetails as $productDetail)
                                                                                @if($productDetail->variation && $productDetail->variation != 0)
                                                                                    <div class="form-group">
                                                                                <label class="control-label">Thông số sản phẩm</label>
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
                                                                                    <label for="price">Giá bán</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="price{{$productDetail->id}}"
                                                                                           name="old_price{{$productDetail->id}}"
                                                                                           value="{{ $productDetail->old_price }}">
                                                                            </div>

                                                                                    <div class="form-group">
                                                                                    <label for="qty">Giá khuyến mãi</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="qty{{$productDetail->id}}"
                                                                                           name="price{{$productDetail->id}}"
                                                                                           value="{{$productDetail->price }}">
                                                                            </div>

                                                                                    <div class="form-group">
                                                                                <label for="thumbnail">Thumbnail</label>
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
                                                                                    <input hidden="" name="id{{$loop->index+1}}"
                                                                                           value="{{$productDetail->id}}">
                                                                            @endforeach
                                                                                <input hidden="" name="countBegin"
                                                                                       value="{{count($productDetails)}}">
                                                                        @else
                                                                            @php
                                                                                $productDetail = $productDetails[0];
                                                                            @endphp
                                                                            <div class="form-group">
                                                                                    <label for="price">Giá bán</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="price{{$productDetail->id}}"
                                                                                           name="old_price1"
                                                                                           value="{{ $productDetail->old_price }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                    <label for="qty">Giá khuyến mãi</label>
                                                                                    <input type="number"
                                                                                           class="form-control"
                                                                                           id="qty{{$productDetail->id}}"
                                                                                           name="price1"
                                                                                           value="{{$productDetail->price }}">
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="thumbnail">Thumbnail</label>
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
                                                                                       class="col-8 col-sm-8">Sản phẩm hot</label>
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
                                                                                       class="col-8 col-sm-8">Sản phẩm nổi bật</label>
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
                                                                    data-dismiss="modal">Close</button>
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
                                                        Delete
                                                    </a>
                                        <!-- Modal -->
                                                    <div class="modal fade text-black"
                                                         id="modalDeleteProduct{{$product->id}}" tabindex="-1"
                                                         role="dialog" aria-labelledby="exampleModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{route('product.v2.delete', $product->id)}}"
                                                                  method="post">
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
                                                                        Bạn có chắc chắn muốn xoá product: {{$product->name}}
                                                                    </h5>
                                                                    <p class="text-danger">
                                                                        Nếu xoá bạn sẽ không thể không thể tìm thấy nó!
                                                                        Chúng tôi sẽ không chịu trách nhiệm cho việc này!
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
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
              <span class="na">
                –
              </span>
                            </td>
                            <td class="is_in_stock column-is_in_stock" data-colname="Stock">
                                <mark class="instock">
                                    In stock
                                </mark>
                            </td>
                            <td class="price column-price" data-colname="Price">
                                {{$product->price}}
                            </td>
                            <td class="product_cat column-product_cat" data-colname="Categories">
                                <a href="">
                                    {{$product->category->name}}
                                </a>
                            </td>
                            <td class="product_tag column-product_tag" data-colname="Tags">
              <span class="na">
                –
              </span>
                            </td>
                            <td class="hot column-hot" data-colname="Hot">
                                @for($i = 0; $i< count($permissionUsers); $i++)
                                    @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
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
                                        @break
                                    @endif
                                @endfor
                            </td>
                            <td class="featured column-featured" data-colname="Featured">
                                @for($i = 0; $i< count($permissionUsers); $i++)
                                    @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm nổi bật')
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
                                        @break
                                    @endif
                                @endfor
                            </td>
                            <td class="date column-date" data-colname="Date">
                                Đã xuất bản
                                <br>
                                18/07/2023 lúc 3:18 sáng
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                {{--END TBODY TABLE--}}

                {{--START TFOOT TABLE--}}
                <tfoot>
                <tr>
                    <td class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-2">
                            Chọn toàn bộ
                        </label>
                        <input id="cb-select-all-2" type="checkbox">
                    </td>
                    <th scope="col" class="manage-column column-thumb">
              <span class="wc-image tips">
                Image
              </span>
                    </th>
                    <th scope="col" class="manage-column column-name column-primary sortable desc">
                        <a href="#">
                <span>
                  Name
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" class="manage-column column-sku sortable desc">
                        <a href="#">
                <span>
                  SKU
                </span>
                            <span class="sorting-indicator">
                </span>
                        </a>
                    </th>
                    <th scope="col" class="manage-column column-is_in_stock">
                        Stock
                    </th>
                    <th scope="col" class="manage-column column-price sortable desc">
                        <a href="#">
                                <span>
                                  Price
                                </span>
                            <span class="sorting-indicator">
                                </span>
                        </a>
                    </th>
                    <th scope="col" class="manage-column column-product_cat">
                        Categories
                    </th>
                    <th scope="col" class="manage-column column-product_tag">
                        Tags
                    </th>
                    <th scope="col" class="manage-column column-hot style-DCT76" id="style-DCT76">
                              <span class="wc-hot parent-tips" data-tip="Hot">
                                Hot
                              </span>
                    </th>
                    <th scope="col" class="manage-column column-featured">
                        Featured
                    </th>
                    <th scope="col" class="manage-column column-date sortable asc">
                        <a href="#">
                                <span>
                                  Date
                                </span>
                            <span class="sorting-indicator">
                                </span>
                        </a>
                    </th>
                </tr>
                </tfoot>
                {{--END TFOOT TABLE--}}
            </table>
            {{--END TABLE--}}

            {{--START ACTION--}}
            <div class="tablenav bottom">
                <div class="alignleft actions bulkactions">
                    <label for="bulk-action-selector-bottom" class="screen-reader-text">
                        Lựa chọn thao tác hàng loạt
                    </label>
                    <select name="action2" id="bulk-action-selector-bottom">
                        <option value="-1">
                            Hành động
                        </option>
                        <option value="edit" class="hide-if-no-js">
                            Chỉnh sửa
                        </option>
                        <option value="trash">
                            Bỏ vào thùng rác
                        </option>
                    </select>
                    <input type="submit" id="doaction2" class="button action" value="Áp dụng">
                </div>
                <div class="alignleft actions">
                </div>
                <div class="tablenav-pages one-page">
          <span class="displaying-num">
            0 mục
          </span>
                    <span class="pagination-links">
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              «
            </span>
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              ‹
            </span>
            <span class="screen-reader-text">
              Trang hiện tại
            </span>
            <span id="table-paging" class="paging-input">
              <span class="tablenav-paging-text">
                1 trên
                <span class="total-pages">
                  1
                </span>
              </span>
            </span>
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              ›
            </span>
            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">
              »
            </span>
          </span>
                </div>
                <br class="clear">
            </div>
            {{--END ACTION--}}
            <div id="ajax-response">
            </div>
            <div class="clear">
            </div>
        </div>
        <div>
            <div class="woocommerce-embedded-layout__primary" id="woocommerce-embedded-layout__primary">
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".inputHotCheckbox").click(function () {
                var productID = jQuery(this).val();
                console.log(productID);

                function setProductHots(productID) {
                    $.ajax({
                        url: '/toggle-products-hot/' + productID,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            console.log('success')
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                }

                setProductHots(productID);
            });

            $(".inputFeatureCheckbox").click(function () {
                var productID = jQuery(this).val();

                function setProductFeatures(productID) {
                    $.ajax({
                        url: '/toggle-products-feature/' + productID,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            console.log('success')
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                }

                setProductFeatures(productID);
            });
        });
    </script>
    <script>
        function checkHotAndFeature(id) {
            var hot = document.getElementById('inputHotProduct' + id);
            var feature = document.getElementById('inputFeatureProduct' + id);
            console.log(hot, feature);
            if (hot.value == 1) {
                document.getElementById("hot_product" + id).checked = true;
            }
            if (feature.value == 1) {
                document.getElementById("feature_product" + id).checked = true;
            }

            callFunction(id);
        }

    </script>
    <script>
        function callFunction(id) {
            var properties = document.getElementsByClassName('property-attribute')
            var number = properties.length

            var priceInput = document.getElementById('price' + id);
            var qtyInput = document.getElementById('qty' + id);

            qtyInput.addEventListener('input', function () {
                var price = parseFloat(priceInput.value);
                var qty = parseFloat(qtyInput.value);

                if (qty > price) {
                    alert('Giá khuyến mãi không được lớn hơn giá bán.');
                    qtyInput.value = ''; // Xóa giá trị khuyến mãi
                }
            });

            myID = id;

            function checkInput(myID) {
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
                var attPro = document.getElementById('input-form-create-attribute' + myID)
                attPro.value = myArray;
            }

            checkInput(myID);

            $('[data-fancybox]').fancybox({
                buttons: [
                    'close'
                ],
                wheel: false,
                transitionEffect: "slide",
                loop: true,
                toolbar: false,
                clickContent: false
            });

            qtyInput.addEventListener('input', function () {
                var price = parseFloat(priceInput.value);
                var qty = parseFloat(qtyInput.value);

                if (qty > price) {
                    alert('Giá khuyến mãi không được lớn hơn giá bán.');
                    qtyInput.value = ''; // Xóa giá trị khuyến mãi
                }
            });
        }
    </script>
@endsection