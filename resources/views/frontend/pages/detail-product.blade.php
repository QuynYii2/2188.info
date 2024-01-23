@php
    use Illuminate\Support\Facades\Auth;
    (new \App\Http\Controllers\Frontend\HomeController())->createStatisticShopDetail('views', $product->user_id);
     $langDisplay = new \App\Http\Controllers\Frontend\HomeController();

    $route = Route::currentRouteName();
    $isDetail = null;
    if ($route == 'detail_product.show'){
        $isDetail = true;
    }

    session()->forget('isDetail');
    session()->push('isDetail', $isDetail);

    $productItem = $product;
@endphp
<style>
    .fa-stack {
        color: #fac325;
    }
</style>
@extends('frontend.layouts.master')
@section('title', 'Detail')
@section('content')
    <div id="detail-product" class="body">
        <div class="modal-order" id="showOrder">
            <div class="order-detail bg-white">
                <div class="main-order-detail">
                    <div class="order-title d-flex justify-content-between align-items-center">
                        <div class="title">
                            Choose variant and quantity
                        </div>
                        <div class="close" onclick="closeVariableModalOrder();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <path d="M18 6L6 18M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="list-variable" id="list-variable">
                        <div class="title">
                            Show variant
                        </div>
                        @php
                            $price_sales = \App\Models\ProductSale::where('product_id', '=', $productItem->id)->get();
                        @endphp
                        @foreach($price_sales as $price_sale)
                            <div class="variable-item d-flex justify-content-between align-items-center">
                                <div class="about-quantity normal-text">
                                    {{$price_sale->quantity}}
                                </div>
                                <div class="price bold-text">
                                    {{ number_format(convertCurrency('USD', $currency,$price_sale->sales), 0, ',', '.') }} {{$currency}}
                                    /{{ __('home.Product') }}
                                </div>
                                <div class="days normal-text">
                                    {{$price_sale->days}} {{ __('home.ngày kể từ ngày đặt hàng') }}
                                </div>
                                <div class="ship bold-text">
                                    {{ number_format(convertCurrency('USD', $currency,$price_sale->ship), 0, ',', '.') }} {{$currency}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="ordered">
                        <div class="title">
                            Cart Item
                        </div>
                        @php
                            if (Auth::check()){
                                $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->where('status', \App\Enums\CartStatus::WAIT_ORDER)->get();
                            }
                        @endphp
                        @if(isset($carts))
                            @foreach($carts as $cart)
                                <div class="cart-item d-flex justify-content-between align-items-center">
                                    <div class="product-name bold-text">
                                        @if(locationHelper() == 'kr')
                                            {{$cart->product->name_ko}}
                                        @elseif(locationHelper() == 'cn')
                                            {{$cart->product->name_zh}}
                                        @elseif(locationHelper() == 'jp')
                                            {{$cart->product->name_ja}}
                                        @elseif(locationHelper() == 'vi')
                                            {{$cart->product->name_vi}}
                                        @else
                                            {{$cart->product->name_en}}
                                        @endif
                                        <div class="small text-secondary">
                                            @if($cart->values && $cart->values != '')
                                                @php
                                                    $arrayValues = explode(',', $cart->values);
                                                @endphp
                                                @foreach($arrayValues as $arrayValue)
                                                    @php
                                                        $attribute_property = explode('-', $arrayValue);

                                                        $attribute = \App\Models\Attribute::where('status', \App\Enums\AttributeStatus::ACTIVE)
                                                            ->where('id', $attribute_property[0])->first();
                                                        $property = \App\Models\Properties::where('status', \App\Enums\PropertiStatus::ACTIVE)
                                                            ->where('id', $attribute_property[1])->first();
                                                    @endphp
                                                    <span>
                                    @if($attribute)
                                                            @if(locationHelper() == 'kr')
                                                                {{$attribute->name_ko}}
                                                            @elseif(locationHelper() == 'cn')
                                                                {{$attribute->name_zh}}
                                                            @elseif(locationHelper() == 'jp')
                                                                {{$attribute->name_ja}}
                                                            @elseif(locationHelper() == 'vi')
                                                                {{$attribute->name_vi}}
                                                            @else
                                                                {{$attribute->name_en}}
                                                            @endif
                                                            :
                                                            @if($property)
                                                                @if(locationHelper() == 'kr')
                                                                    {{$property->name_ko}}
                                                                @elseif(locationHelper() == 'cn')
                                                                    {{$property->name_zh}}
                                                                @elseif(locationHelper() == 'jp')
                                                                    {{$property->name_ja}}
                                                                @elseif(locationHelper() == 'vi')
                                                                    {{$property->name_vi}}
                                                                @else
                                                                    {{$property->name_en}}
                                                                @endif
                                                            @endif
                                                            ,
                                                        @endif
                            </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-quantity">
                                        <input class="input-number-cart" type="number" id="quantity{{ $cart->id }}"
                                               name="quantity"
                                               style="border-radius: 30px; border-color: #ccc; width: 55px; "
                                               value="{{ $cart->quantity }}"
                                               data-id="{{ $cart->id }}"
                                               min="{{$cart->product->min}}"/>
                                    </div>
                                    <div class="price bold-text">
                                        <span id="priceCart{{ $cart->id }}">{{ number_format(convertCurrency('USD', $currency,$cart->price), 0, ',', '.') }}</span>
                                        <span class="currency">{{$currency}}</span>
                                    </div>
                                    <div class="price bold-text" id="totalCart{{ $cart->id }}">
                                        {{ number_format(convertCurrency('USD', $currency,$cart->price*$cart->quantity), 0, ',', '.') }} {{$currency}}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="render-order w-100">
                        <div class="title">
                            Show order
                        </div>
                        @php
                            $productVariables = \App\Models\Variation::where('product_id', $productItem->id)->where('status', \App\Enums\VariationStatus::ACTIVE)->get();
                        @endphp
                        @if($productVariables->isNotEmpty())
                            @foreach($productVariables as $productVariable)
                                <div class="order-item d-flex justify-content-between align-items-center">
                                    <div class="variable-name">
                                        @php
                                            $variation = $productVariable->variation;
                                            $variationArray = explode(',', $variation);
                                        @endphp
                                        @foreach($variationArray as $item)
                                            @php
                                                $attribute_property = explode('-', $item);
                                                $attribute = \App\Models\Attribute::find($attribute_property[0]);
                                                $property = \App\Models\Properties::find($attribute_property[1]);
                                            @endphp
                                            <span>
                                            @if($attribute)
                                                    @if(locationHelper() == 'kr')
                                                        {{ ($attribute->name_ko) }}
                                                    @elseif(locationHelper() == 'cn')
                                                        {{ ($attribute->name_zh) }}
                                                    @elseif(locationHelper() == 'jp')
                                                        {{ ($attribute->name_ja) }}
                                                    @elseif(locationHelper() == 'vi')
                                                        {{ ($attribute->name_vi) }}
                                                    @else
                                                        {{ ($attribute->name_en) }}
                                                    @endif
                                                    :
                                                    @if($property)
                                                        @if(locationHelper() == 'kr')
                                                            {{ ($property->name_ko) }}
                                                        @elseif(locationHelper() == 'cn')
                                                            {{ ($property->name_zh) }}
                                                        @elseif(locationHelper() == 'jp')
                                                            {{ ($property->name_ja) }}
                                                        @elseif(locationHelper() == 'vi')
                                                            {{ ($property->name_vi) }}
                                                        @else
                                                            {{ ($property->name_en) }}
                                                        @endif
                                                    @endif
                                                @endif
                                            ,
                                        @endforeach
                                    </div>

                                    <div class="price bold-text">
                                    <span>
                                        <span id="textPrice_{{ $productVariable->id }}">
                                             {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                        </span>
                                    </span>
                                        <span class="currency">
                                        {{$currency}}
                                     </span>
                                    </div>

                                    <div class="d-none">
                                        <label for="productPrice_{{ $productVariable->id }}"></label>
                                        <input value="{{$productVariable->price}}"
                                               id="productPrice_{{ $productVariable->id }}">
                                        <label for="inputQuantityVariable_{{ $productVariable->id }}"></label>
                                    </div>

                                    <div class="quantity quantityVariable">
                                    <span class="decrease" data-id="{{ $productVariable->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                          <path d="M4 8H12" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                        <input type="number" value="0" min="0" class="inputQuantityVariable"
                                               id="inputQuantityVariable_{{ $productVariable->id }}"
                                               data-id="{{ $productVariable->id }}" data-product="{{$productVariable}}"
                                               data-variable="{{$productVariable->variation}}">
                                        <span class="increase" data-id="{{ $productVariable->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                          <path d="M4 8H12" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                          <path d="M8 12V4" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    </div>

                                    <div class="price-ship bold-text" id="priceShip_{{ $productVariable->id }}">
                                        0 <span class="currency">{{$currency}}</span>
                                    </div>
                                    <div class="total-price bold-text" id="totalValue_{{ $productVariable->id }}">
                                        0 <span class="currency">{{$currency}}</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="order-item d-flex justify-content-between align-items-center">
                                <div class="variable-name">
                                    None
                                </div>

                                <div class="price bold-text">
                                <span>
                                    <span id="textPrice_0">
                                        {{ number_format(convertCurrency('USD', $currency,$productItem->price), 0, ',', '.') }}
                                    </span>
                                </span>
                                    <span class="currency">{{$currency}}</span>
                                </div>

                                <div class="d-none">
                                    <label for="productPrice_0"></label>
                                    <input value="{{$productItem->price}}"
                                           id="productPrice_0">
                                    <label for="inputQuantityVariable_0"></label>
                                </div>

                                <div class="quantity quantityVariable">
                                <span class="decrease" data-id="0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                          <path d="M4 8H12" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                </span>
                                    <input type="number" value="0" min="0" class="inputQuantityVariable"
                                           id="inputQuantityVariable_0"
                                           data-id="0" data-product="{{ $productItem }}"
                                           data-variable="">
                                    <span class="increase" data-id="0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             viewBox="0 0 16 16" fill="none">
                                          <path d="M4 8H12" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                          <path d="M8 12V4" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>

                                <div class="price-ship bold-text" id="priceShip_0">
                                    0 <span class="currency">{{$currency}}</span>
                                </div>
                                <div class="total-price bold-text" id="totalValue_0">
                                    0 <span class="currency">{{$currency}}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="confirm-order">
                    <div class="price-product d-flex justify-content-between align-items-center">
                        <div class="title">
                            Total product cost
                        </div>
                        <div class="value" id="valueProduct">
                            599,000 $
                        </div>
                    </div>
                    <div class="price-ship d-flex justify-content-between align-items-center">
                        <div class="title">
                            Shipping fee
                        </div>
                        <div class="value" id="valueShip">
                            29,000 $
                        </div>
                    </div>
                    <div class="price-total d-flex justify-content-between align-items-center">
                        <div class="title">
                            Order total
                        </div>
                        <div class="value" id="valueTotal">
                            29,000 $
                        </div>
                    </div>
                    <button id="supBtnOrder" type="button" class="btn">
                        {{ __('home.Tiếp nhận đặt hàng') }}
                    </button>
                </div>
            </div>
        </div>
        <div class="container-fluid detail">
            <div class="grid second-nav">
                <div class="column-xs-12 category-header">
                    <div class="breadcrumbs_filter">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('category.show', $productItem->category->id) }}">
                                        @if(locationHelper() == 'kr')
                                            {{ $productItem->category->name_ko }}
                                        @elseif(locationHelper() == 'cn')
                                            {{ $productItem->category->name_zh }}
                                        @elseif(locationHelper() == 'jp')
                                            {{ $productItem->category->name_ja }}
                                        @elseif(locationHelper() == 'vi')
                                            {{ $productItem->category->name_vi }}
                                        @else
                                            {{ $productItem->category->name_en }}
                                        @endif
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    @if(locationHelper() == 'kr')
                                        {{ ($productItem->name_ko) }}
                                    @elseif(locationHelper() == 'cn')
                                        {{ ($productItem->name_zh) }}
                                    @elseif(locationHelper() == 'jp')
                                        {{ ($productItem->name_ja) }}
                                    @elseif(locationHelper() == 'vi')
                                        {{ ($productItem->name_vi) }}
                                    @else
                                        {{ ($productItem->name_en) }}
                                    @endif
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @php
                $userProduct = DB::table('users')->where('id', $productItem->user_id)->first();
                $productID = $productItem->id;
                $productDetails = \App\Models\Variation::where('product_id', $productItem->id)->get();
                $productDetail = \App\Models\Variation::where('product_id', $productItem->id)->first();
            @endphp
            <div class="row product m-0">
                <div class="col-12 col-md-4">
                    <div class="product-gallery">
                        <div class="product-image">
                            @php
                                $thumbnail = checkThumbnail($productItem->thumbnail);
                            @endphp
                            <img alt="" id="productThumbnail" class="main-image-product active h-100"
                                 src="{{ $thumbnail }}">
                            <input type="text" id="urlImage" value="{{ $thumbnail }}" hidden="">
                        </div>

                        <ul class="image-list">
                            @php
                                $gallery = $productItem->gallery;
                                $arrayGallery = explode(',', $gallery);
                            @endphp
                            @php
                                $thumbnail = checkThumbnail($productItem->thumbnail);
                            @endphp
                            <li class="image-item"><img alt="" src="{{ $thumbnail }}"></li>
                            @if(count($arrayGallery)>1)
                                @foreach($arrayGallery as $gallery)
                                    @php
                                        $gallery = checkThumbnail($gallery);
                                    @endphp
                                    <li class="image-item"><img alt="" src="{{ $gallery }}"></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="column-xs-12 column-md-5 product-show">
                    <div class="product-item">
                        <div class="product-title">
                            @if(locationHelper() == 'kr')
                                <div class="item-text">{{ $productItem->name_ko }}</div>
                            @elseif(locationHelper() == 'cn')
                                <div class="item-text">{{$productItem->name_zh}}</div>
                            @elseif(locationHelper() == 'jp')
                                <div class="item-text">{{$productItem->name_ja}}</div>
                            @elseif(locationHelper() == 'vi')
                                <div class="item-text">{{$productItem->name_vi}}</div>
                            @else
                                <div class="item-text">{{$productItem->name_en}}</div>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="card-rating text-left">
                                @php
                                    $ratings = \App\Models\EvaluateProduct::where('product_id', $productItem->id)->get();
                                    $totalRatings = $ratings->count();
                                    $totalStars = 0;
                                    foreach ($ratings as $rating) {
                                        $totalStars += $rating->star_number;
                                    }
                                    $averageRating = $totalRatings > 0 ? $totalStars / $totalRatings : 0;
                                    $averageRatingsFormatted = number_format($averageRating, 2);
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star"
                                       style="color: {{ $i <= $averageRating ? '#fac325' : '#ccc' }}"></i>
                                @endfor

                                <span class="total-rating"> ({{ $totalRatings }})</span>
                            </div>
                            <div class="eyes ml-3">
                                <i class="fa-regular fa-eye"></i>
                                {{$productItem->views}}{{ __('home.19 customers are viewing this product') }}
                            </div>
                        </div>

                        <div class="product-price d-flex justify-content-between">
                            <div class="price-area d-flex align-items-center" style="gap: 2rem">
                                @if($productItem->price != null)
                                    <div id="productPrice" class="price">
                                        {{ number_format(convertCurrency('USD', $currency,$productItem->price), 0, ',', '.') }} {{$currency}}
                                    </div>
                                    <strike class="productOldPrice" id="productOldPrice">
                                        {{ number_format(convertCurrency('USD', $currency,$productItem->old_price), 0, ',', '.') }} {{$currency}}
                                    </strike>
                                @else
                                    <strike class="productOldPrice" id="productOldPrice">
                                        {{ number_format(convertCurrency('USD', $currency,$productItem->price), 0, ',', '.') }} {{$currency}}
                                    </strike>
                                @endif
                            </div>
                            <div class="product-list-social d-flex justify-content-between align-items-center m-auto">
                                <div class="social-item social-product-facebook mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"
                                         fill="none">
                                        <g clip-path="url(#clip0_45_13518)">
                                            <path d="M20 0C16.0444 0 12.1776 1.17298 8.8886 3.37061C5.59962 5.56824 3.03617 8.69181 1.52242 12.3463C0.00866564 16.0009 -0.387401 20.0222 0.384303 23.9018C1.15601 27.7814 3.06082 31.3451 5.85787 34.1421C8.65492 36.9392 12.2186 38.844 16.0982 39.6157C19.9778 40.3874 23.9992 39.9913 27.6537 38.4776C31.3082 36.9638 34.4318 34.4004 36.6294 31.1114C38.827 27.8224 40 23.9556 40 20C40 14.6957 37.8929 9.60859 34.1421 5.85786C30.3914 2.10714 25.3043 0 20 0V0ZM25.6895 13.0158C25.6895 13.3921 25.5316 13.5421 25.1632 13.5421C24.4553 13.5421 23.7474 13.5421 23.0421 13.5711C22.3369 13.6 21.9526 13.9211 21.9526 14.6579C21.9368 15.4474 21.9526 16.2211 21.9526 17.0263H24.9816C25.4132 17.0263 25.5605 17.1737 25.5605 17.6079C25.5605 18.6605 25.5605 19.7184 25.5605 20.7816C25.5605 21.2105 25.4237 21.3447 24.9895 21.3474H21.9263V29.9105C21.9263 30.3684 21.7842 30.5132 21.3316 30.5132H18.0369C17.6395 30.5132 17.4842 30.3579 17.4842 29.9605V21.3605H14.8684C14.4579 21.3605 14.3105 21.2105 14.3105 20.7974C14.3105 19.7325 14.3105 18.6684 14.3105 17.6053C14.3105 17.1947 14.4658 17.0395 14.8711 17.0395H17.4842V14.7368C17.4532 13.7025 17.7014 12.679 18.2026 11.7737C18.7237 10.8598 19.5587 10.1659 20.5526 9.82105C21.1977 9.58636 21.8794 9.46872 22.5658 9.47368H25.1526C25.5237 9.47368 25.679 9.63684 25.679 10C25.6921 11.0132 25.6921 12.0158 25.6895 13.0158Z"
                                                  fill="black"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_45_13518">
                                                <rect width="40" height="40" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="social-item social-product-whatapp mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
                                         fill="none">
                                        <g clip-path="url(#clip0_45_13522)">
                                            <path d="M20.6665 0C9.6225 0 0.666504 8.95599 0.666504 20C0.666504 31.044 9.6225 40 20.6665 40C31.7105 40 40.6665 31.044 40.6665 20C40.6665 8.95599 31.7105 0 20.6665 0ZM21.0904 31.6446C21.0901 31.6446 21.0907 31.6446 21.0904 31.6446H21.0855C19.082 31.6437 17.1133 31.1414 15.365 30.188L9.01947 31.8521L10.7178 25.6509C9.6701 23.8364 9.11896 21.7776 9.11987 19.6686C9.12262 13.0707 14.4925 7.70294 21.0904 7.70294C24.2923 7.70416 27.298 8.9505 29.5578 11.2122C31.8179 13.4741 33.0618 16.4807 33.0606 19.678C33.0579 26.2762 27.6874 31.6446 21.0904 31.6446Z"
                                                  fill="black"/>
                                            <path d="M21.0952 9.72412C15.6072 9.72412 11.144 14.1855 11.1416 19.6695C11.141 21.5488 11.6671 23.3789 12.6629 24.9625L12.8994 25.3387L11.8942 29.0091L15.6597 28.0215L16.0232 28.237C17.5506 29.1434 19.3017 29.6228 21.087 29.6234H21.0909C26.5746 29.6234 31.0378 25.1617 31.0403 19.6774C31.0412 17.0197 30.0073 14.5209 28.1289 12.641C26.2505 10.7611 23.7524 9.72504 21.0952 9.72412ZM26.9473 23.9456C26.6979 24.6439 25.5032 25.2814 24.9285 25.3674C24.4131 25.4443 23.7612 25.4764 23.0447 25.249C22.6101 25.1111 22.0532 24.9271 21.3394 24.6191C18.3392 23.324 16.3796 20.304 16.2301 20.1044C16.0806 19.9048 15.0088 18.483 15.0088 17.0111C15.0088 15.5396 15.7815 14.816 16.0555 14.5169C16.3299 14.2175 16.654 14.1428 16.8533 14.1428C17.0526 14.1428 17.2521 14.1446 17.4264 14.1531C17.6101 14.1623 17.8567 14.0833 18.0993 14.6664C18.3486 15.2652 18.9468 16.7368 19.0215 16.8863C19.0963 17.0361 19.1461 17.2107 19.0466 17.4103C18.9468 17.6099 18.6154 18.0405 18.2989 18.4329C18.1661 18.5974 17.9931 18.7439 18.1677 19.0433C18.3419 19.3423 18.9425 20.3217 19.8315 21.1145C20.9741 22.1332 21.9378 22.4487 22.2369 22.5986C22.5356 22.7481 22.7102 22.7231 22.8848 22.5238C23.059 22.3242 23.6324 21.6507 23.8317 21.3513C24.031 21.0519 24.2306 21.102 24.5046 21.2018C24.779 21.3013 26.2493 22.0248 26.5484 22.1744C26.8475 22.3242 27.0468 22.399 27.1215 22.5238C27.1966 22.6486 27.1966 23.2471 26.9473 23.9456Z"
                                                  fill="black"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_45_13522">
                                                <rect width="40" height="40" fill="white"
                                                      transform="translate(0.666504)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="social-item social-product-ins mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="41" height="40" viewBox="0 0 41 40"
                                         fill="none">
                                        <g clip-path="url(#clip0_45_13525)">
                                            <path d="M24.1616 20C24.1616 22.1143 22.4478 23.8281 20.3335 23.8281C18.2192 23.8281 16.5054 22.1143 16.5054 20C16.5054 17.8857 18.2192 16.1719 20.3335 16.1719C22.4478 16.1719 24.1616 17.8857 24.1616 20Z"
                                                  fill="black"/>
                                            <path d="M29.2874 13.227C29.1033 12.7283 28.8098 12.277 28.4283 11.9065C28.0578 11.525 27.6068 11.2314 27.1078 11.0474C26.7031 10.8903 26.0952 10.7032 24.9755 10.6522C23.7643 10.597 23.4011 10.5851 20.3347 10.5851C17.268 10.5851 16.9048 10.5967 15.6939 10.6519C14.5742 10.7032 13.966 10.8903 13.5616 11.0474C13.0627 11.2314 12.6113 11.525 12.2411 11.9065C11.8597 12.277 11.5661 12.728 11.3818 13.227C11.2246 13.6317 11.0375 14.2399 10.9866 15.3596C10.9313 16.5705 10.9194 16.9337 10.9194 20.0004C10.9194 23.0668 10.9313 23.4299 10.9866 24.6412C11.0375 25.7609 11.2246 26.3688 11.3818 26.7734C11.5661 27.2724 11.8594 27.7234 12.2408 28.0939C12.6113 28.4754 13.0624 28.769 13.5613 28.953C13.966 29.1105 14.5742 29.2975 15.6939 29.3485C16.9048 29.4037 17.2677 29.4153 20.3344 29.4153C23.4014 29.4153 23.7646 29.4037 24.9752 29.3485C26.0949 29.2975 26.7031 29.1105 27.1078 28.953C28.1094 28.5667 28.901 27.775 29.2874 26.7734C29.4445 26.3688 29.6316 25.7609 29.6829 24.6412C29.7381 23.4299 29.7497 23.0668 29.7497 20.0004C29.7497 16.9337 29.7381 16.5705 29.6829 15.3596C29.6319 14.2399 29.4448 13.6317 29.2874 13.227ZM20.3347 25.8973C17.0776 25.8973 14.4372 23.2572 14.4372 20.0001C14.4372 16.7429 17.0776 14.1028 20.3347 14.1028C23.5916 14.1028 26.2319 16.7429 26.2319 20.0001C26.2319 23.2572 23.5916 25.8973 20.3347 25.8973ZM26.4651 15.2479C25.704 15.2479 25.0869 14.6308 25.0869 13.8697C25.0869 13.1086 25.704 12.4915 26.4651 12.4915C27.2262 12.4915 27.8433 13.1086 27.8433 13.8697C27.843 14.6308 27.2262 15.2479 26.4651 15.2479Z"
                                                  fill="black"/>
                                            <path d="M20.3335 0C9.28949 0 0.333496 8.95599 0.333496 20C0.333496 31.044 9.28949 40 20.3335 40C31.3775 40 40.3335 31.044 40.3335 20C40.3335 8.95599 31.3775 0 20.3335 0ZM31.7486 24.7348C31.6931 25.9573 31.4987 26.792 31.2148 27.5226C30.6182 29.0652 29.3987 30.2847 27.8561 30.8813C27.1258 31.1652 26.2908 31.3593 25.0686 31.4151C23.8439 31.4709 23.4527 31.4844 20.3338 31.4844C17.2146 31.4844 16.8237 31.4709 15.5987 31.4151C14.3765 31.3593 13.5415 31.1652 12.8112 30.8813C12.0446 30.593 11.3506 30.141 10.7769 29.5566C10.1928 28.9832 9.74084 28.2889 9.45245 27.5226C9.16864 26.7923 8.97424 25.9573 8.9187 24.7351C8.86224 23.5101 8.84912 23.1189 8.84912 20C8.84912 16.8811 8.86224 16.4899 8.9184 15.2652C8.97394 14.0427 9.16803 13.208 9.45184 12.4774C9.74023 11.7111 10.1925 11.0168 10.7769 10.4434C11.3503 9.85901 12.0446 9.40704 12.8109 9.11865C13.5415 8.83484 14.3762 8.64075 15.5987 8.5849C16.8234 8.52905 17.2146 8.51562 20.3335 8.51562C23.4524 8.51562 23.8436 8.52905 25.0683 8.58521C26.2908 8.64075 27.1255 8.83484 27.8561 9.11835C28.6224 9.40674 29.3167 9.85901 29.8904 10.4434C30.4745 11.0172 30.9268 11.7111 31.2148 12.4774C31.499 13.208 31.6931 14.0427 31.7489 15.2652C31.8047 16.4899 31.8179 16.8811 31.8179 20C31.8179 23.1189 31.8047 23.5101 31.7486 24.7348Z"
                                                  fill="black"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_45_13525">
                                                <rect width="40" height="40" fill="white"
                                                      transform="translate(0.333496)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="social-item social-product-twitter">
                                    <img src="{{ asset('images/tter.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="description-text">
                            @if(locationHelper() == 'kr')
                                <div class="item-text">{!! $productItem->short_description_ko !!}</div>
                            @elseif(locationHelper() == 'cn')
                                <div class="item-text">{!! $productItem->short_description_zh !!}</div>
                            @elseif(locationHelper() == 'jp')
                                <div class="item-text">{!! $productItem->short_description_ja !!}</div>
                            @elseif(locationHelper() == 'vi')
                                <div class="item-text">{!! $productItem->short_description_vi !!}</div>
                            @else
                                <div class="item-text">{!! $productItem->short_description_en !!}</div>
                            @endif
                        </div>
                        <div class="">
                            <input id="product_id" hidden value="{{$productItem->id}}">
                            <input name="price" id="price" hidden value="{{$productItem->price}}">
                            @if(count($productDetails)>0)
                                <input name="variable" id="variable" hidden value="{{$productDetails[0]->variation}}">
                            @endif

                        </div>
                    </div>
                    <div class="show-order-area row align-items-end">
                        <button type="button" class="btn btnOrder" onclick="showVariableModalOrder()">Start ordering
                        </button>
                        <button type="button" class="btn btnContact">Contact</button>
                        <button type="button" class="btn btnCart">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <path d="M2 2H3.30616C3.55218 2 3.67519 2 3.77418 2.04524C3.86142 2.08511 3.93535 2.14922 3.98715 2.22995C4.04593 2.32154 4.06333 2.44332 4.09812 2.68686L4.57143 6M4.57143 6L5.62332 13.7314C5.75681 14.7125 5.82355 15.2031 6.0581 15.5723C6.26478 15.8977 6.56108 16.1564 6.91135 16.3174C7.30886 16.5 7.80394 16.5 8.79411 16.5H17.352C18.2945 16.5 18.7658 16.5 19.151 16.3304C19.4905 16.1809 19.7818 15.9398 19.9923 15.6342C20.2309 15.2876 20.3191 14.8247 20.4955 13.8988L21.8191 6.94969C21.8812 6.62381 21.9122 6.46087 21.8672 6.3335C21.8278 6.22177 21.7499 6.12768 21.6475 6.06802C21.5308 6 21.365 6 21.0332 6H4.57143ZM10 21C10 21.5523 9.55228 22 9 22C8.44772 22 8 21.5523 8 21C8 20.4477 8.44772 20 9 20C9.55228 20 10 20.4477 10 21ZM18 21C18 21.5523 17.5523 22 17 22C16.4477 22 16 21.5523 16 21C16 20.4477 16.4477 20 17 20C17.5523 20 18 20.4477 18 21Z"
                                      stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="column-xs-12 column-md-3 layout-fixed">
                    <div class="main-actions main-profile text-center">
                        <div class="profile-user">
                            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="img-profile">
                            <div class="profile-name">
                                <a href="{{ route('shop.information.show', $productItem->user->id) }}">{{ $productItem->user->name }}</a>
                            </div>
                        </div>
                        <div class="list-action ">
                            <button class="btn btn-contact" data-toggle="modal" data-target="#modalContact">
                                <i class="fa-solid fa-envelope"></i>Contact supplier
                            </button>
                            <br/>
                            <button class="btn btn-call">
                                <i class="fa-solid fa-phone-volume"></i>Call the supplier
                            </button>
                        </div>
                    </div>
                    <div class="main-actions main-shop">
                        <div class="banner-shop">
                            <img src="https://png.pngtree.com/thumb_back/fh260/back_pic/00/02/44/5056179b42b174f.jpg"
                                 alt="" class="banner">
                            <div class="shop-info d-flex align-items-center">
                                <img src="https://vn4u.vn/wp-content/uploads/2023/09/logo-co-tinh-nhat-quan-2.png"
                                     alt="" class="logo-shop">
                                <div class="shop-name">
                                    @if($company)
                                        {{ $company->name }}
                                    @else
                                        New company
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="review-shop p-2">
                            <div class="rank-shop d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path d="M19.0345 2.48279H4.96552L0 7.4483L12 21.5172L24 7.4483L19.0345 2.48279Z"
                                          fill="#00C3FF"/>
                                    <path d="M19.0345 2.48279L12 21.5172L24 7.4483L19.0345 2.48279Z" fill="#87DAFF"/>
                                    <path d="M4.96552 2.48279L6.80081 7.4483H0L4.96552 2.48279Z" fill="#00AAF0"/>
                                    <path d="M12 2.48279L6.80078 7.4483H17.1992L12 2.48279Z" fill="#87DAFF"/>
                                    <path d="M17.1992 7.4483H24L19.0345 2.48279L17.1992 7.4483Z" fill="#A5E9FF"/>
                                    <path d="M0 7.44824H6.80081L12 21.5172L0 7.44824Z" fill="#0096DC"/>
                                </svg>
                                <span>Diamond member</span>
                            </div>
                            <div class="review-shop d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <g clip-path="url(#clip0_87_11682)">
                                        <path d="M17.9359 8.59202C17.9799 8.01602 17.9999 7.41602 17.9999 6.78802V3.99202C17.9999 3.69602 17.7719 3.46002 17.4879 3.45202C12.7239 3.32402 10.3879 1.42802 9.5599 0.556024C9.3599 0.348024 9.0399 0.348024 8.8399 0.556024C8.0119 1.42802 5.6759 3.32402 0.911902 3.45202C0.627902 3.46002 0.399902 3.69602 0.399902 3.99202V6.78802C0.399902 18.228 7.4599 20.76 8.9319 21.164C9.1079 21.212 9.2919 21.212 9.4679 21.164C9.8159 21.068 10.4679 20.856 11.2679 20.436L17.9359 8.59202Z"
                                              fill="#C9EFF4"/>
                                        <path d="M16.372 7.88797C16.392 7.53197 16.4 7.16397 16.4 6.78797V5.35597C16.4 5.15197 16.24 4.97997 16.036 4.95997C12.796 4.62797 10.68 3.50797 9.444 2.57997C9.3 2.46797 9.1 2.46797 8.956 2.57997C7.72 3.50797 5.604 4.62797 2.364 4.95997C2.16 4.97997 2 5.15197 2 5.35597V6.78797C2 16.46 7.408 18.988 9.08 19.536C9.16 19.564 9.24 19.564 9.32 19.536C9.448 19.496 9.6 19.44 9.768 19.372L16.372 7.88797Z"
                                              fill="#39BC71"/>
                                        <path d="M23.4361 23.036L23.0361 23.436C22.8161 23.656 22.4561 23.656 22.2361 23.436L19.6081 20.808L19.6001 20.4L20.4001 19.6L20.8081 19.608L23.4361 22.236C23.6561 22.456 23.6561 22.816 23.4361 23.036Z"
                                              fill="#7F3633"/>
                                        <path d="M18.564 19.7677L19.7641 18.5676L20.8041 19.6076L19.604 20.8077L18.564 19.7677Z"
                                              fill="#91C0C1"/>
                                        <path d="M14.4001 21.2C18.1556 21.2 21.2001 18.1555 21.2001 14.4C21.2001 10.6444 18.1556 7.59998 14.4001 7.59998C10.6446 7.59998 7.6001 10.6444 7.6001 14.4C7.6001 18.1555 10.6446 21.2 14.4001 21.2Z"
                                              fill="#2BB5E2"/>
                                        <path d="M14.4002 21.6C10.4302 21.6 7.2002 18.37 7.2002 14.4C7.2002 10.43 10.4302 7.19995 14.4002 7.19995C18.3702 7.19995 21.6002 10.43 21.6002 14.4C21.6002 18.37 18.3702 21.6 14.4002 21.6ZM14.4002 7.99995C10.8714 7.99995 8.0002 10.8712 8.0002 14.4C8.0002 17.9288 10.8714 20.8 14.4002 20.8C17.929 20.8 20.8002 17.9288 20.8002 14.4C20.8002 10.8712 17.929 7.99995 14.4002 7.99995Z"
                                              fill="#B7E1E5"/>
                                        <path d="M13.2002 17.2C13.0942 17.2 12.9926 17.1584 12.9174 17.0828L11.7174 15.8828C11.561 15.7264 11.561 15.4736 11.7174 15.3172C11.8738 15.1608 12.1266 15.1608 12.283 15.3172L13.157 16.1912L16.4806 11.7604C16.6134 11.584 16.8638 11.548 17.0402 11.6804C17.217 11.8128 17.253 12.0636 17.1202 12.24L13.5202 17.04C13.4506 17.1328 13.3446 17.1908 13.2286 17.1988C13.219 17.1996 13.2094 17.2 13.2002 17.2Z"
                                              fill="white"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_87_11682">
                                            <rect width="24" height="24" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>Suppliers are audited</span>
                            </div>
                            <div class="rating-shop">
                                @for($i=1; $i < 6; $i++)
                                    <i class="fa-solid fa-star"
                                       style="color: {{ $i <= $calcStar ? '#fac325' : '#ccc' }}"></i>
                                @endfor
                                <span class="total-rating"> ({{ $calcStar }})</span>
                            </div>
                        </div>
                        <div class="description-shop m-2">
                            Manufacturer/Factory & Trading Company
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="productView-description">
            <ul class="nav nav-tabs pt-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                       aria-controls="home"
                       aria-selected="true">{{ __('home.description') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="false">{{ __('home.company information') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                       aria-controls="contact" aria-selected="false">{{ __('home.review') }}</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @if($product)
                        @if(locationHelper() == 'kr')
                            <div class="item-text">{!! $productItem->description_ko !!}</div>
                        @elseif(locationHelper() == 'cn')
                            <div class="item-text">{!! $productItem->description_zh !!}</div>
                        @elseif(locationHelper() == 'jp')
                            <div class="item-text">{!! $productItem->description_ja !!}</div>
                        @elseif(locationHelper() == 'vi')
                            <div class="item-text">{!! $productItem->description_vi !!}</div>
                        @else
                            <div class="item-text">{!! $productItem->description_en !!}</div>
                        @endif
                    @endif
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="shop-info d-flex align-items-center">
                        <div class="info d-flex align-items-center w-50">
                            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="avt">
                            <div class="show-info">
                                <div class="name">
                                    {{ $productItem->user->name }}
                                </div>
                                <div class="rating-shop">
                                    @for($i=1; $i < 6; $i++)
                                        <i class="fa-solid fa-star"
                                           style="color: {{ $i <= $calcStar ? '#fac325' : '#ccc' }}"></i>
                                    @endfor
                                    <span class="total-rating"> ({{ $calcStar }})</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-category w-25">
                            <div class="product">
                                <span>Products: {{ $products->count() }}</span>
                            </div>
                            <div class="category">
                                <span class="title-category">Category: </span> <span class="value-category">{{ $nameCategory }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-shop">
                        <div class="product-title">
                            Product from shop
                        </div>
                        <div class="list-product d-flex flex-wrap">
                            @foreach($listProducts as $product)
                                <div class=" mb-3 product-item">
                                    @include('frontend.pages.list-product')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="form-review d-none" id="formReview">
                        <form method="post" action="{{route('create.evaluate')}}">
                            <h5 class="text-center">Write a review</h5>
                            @csrf
                            <input type="text" class="form-control" id="product_id" name="product_id"
                                   value="{{$productItem->id}}" hidden/>
                            <div class="rating text-center">
                                <input type="radio" name="star_number" id="star1" value="1" hidden="">
                                <label for="star1" onclick="starCheck(1)"><i id="icon-star-1"
                                                                             class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star2" value="2" hidden="">
                                <label for="star2" onclick="starCheck(2)"><i id="icon-star-2"
                                                                             class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star3" value="3" hidden="">
                                <label for="star3" onclick="starCheck(3)"><i id="icon-star-3"
                                                                             class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star4" value="4" hidden="">
                                <label for="star4" onclick="starCheck(4)"><i id="icon-star-4"
                                                                             class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star5" value="5" hidden="" checked>
                                <label for="star5" onclick="starCheck(5)"><i id="icon-star-5"
                                                                             class="fa fa-star"></i></label>
                            </div>
                            <input id="input-star" value="0" hidden="">
                            <div id="text-message"
                                 class="text-danger text-center d-none">{{ __('home.Please select star rating') }}
                            </div>

                            <div class="form-group row">
                                <label for=""
                                       class="col-sm-12 col-form-label label-item">{{ __('home.your name') }}</label>
                                <div class="col-sm-12">
                                    <input onclick="checkStar()" type="text" class="form-control" id=""
                                           name="username"
                                           placeholder="{{ __('home.your name') }}" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for=""
                                       class="col-sm-12 col-form-label label-item">{{ __('home.your review') }}</label>
                                <div class="col-sm-12">
                                    <textarea onclick="checkStar()" class="form-control" id=""
                                              name="content"
                                              placeholder="{{ __('home.your review') }}"
                                              rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="form-group text-center list-button-action">
                                <button class="btn btn-cancel btn-16" type="button">
                                    {{ __('home.Cancel') }}
                                </button>
                                <button id="btn-submit" class="btn btn-send btn-16" type="submit">
                                    {{ __('home.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="calc-review" class="calc-review reviewed justify-content-between align-items-center mt-3">
                        <div class="rating-review">
                            <div class="title">
                                Nhận xét đánh giá trung bình
                            </div>
                            <div class="point">
                                {{ number_format($calcStar,1) }}
                            </div>
                            <div class="rating">
                                @for($i=1; $i < 6; $i++)
                                    <i class="fa-solid fa-star"
                                       style="color: {{ $i <= $calcStar ? '#fac325' : '#ccc' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="review-detail">
                            <div class="title text-center">
                                Chi tiết
                            </div>
                            <div class="show-review  float-right">
                                <div class="range">
                                    <label for="vol">5 sao</label>
                                    <input type="range" id="vol" name="vol" min="0" max="100" disabled value="{{ $arrayStar[4] }}">
                                    <span>{{ $arrayStar[4] }}</span>
                                </div>
                                <div class="range">
                                    <label for="vol">4 sao</label>
                                    <input type="range" id="vol" name="vol" min="0" max="100" disabled value="{{ $arrayStar[3] }}">
                                    <span>{{ $arrayStar[3] }}</span>
                                </div>
                                <div class="range">
                                    <label for="vol">3 sao</label>
                                    <input type="range" id="vol" name="vol" min="0" max="100" disabled value="{{ $arrayStar[2] }}">
                                    <span>{{ $arrayStar[2] }}</span>
                                </div>
                                <div class="range">
                                    <label for="vol">2 sao</label>
                                    <input type="range" id="vol" name="vol" min="0" max="100" disabled value="{{ $arrayStar[1] }}">
                                    <span>{{ $arrayStar[1] }}</span>
                                </div>
                                <div class="range">
                                    <label for="vol">1 sao</label>
                                    <input type="range" id="vol" name="vol" min="0" max="100" disabled value="{{ $arrayStar[0] }}">
                                    <span>{{ $arrayStar[0] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="add-review mt-3 mb-3 reviewed" id="addReview">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M26.6668 14.0001V9.06675C26.6668 6.82654 26.6668 5.70643 26.2309 4.85079C25.8474 4.09814 25.2354 3.48622 24.4828 3.10272C23.6271 2.66675 22.507 2.66675 20.2668 2.66675H11.7335C9.49329 2.66675 8.37318 2.66675 7.51753 3.10272C6.76489 3.48622 6.15296 4.09814 5.76947 4.85079C5.3335 5.70643 5.3335 6.82654 5.3335 9.06675V22.9334C5.3335 25.1736 5.3335 26.2937 5.76947 27.1494C6.15296 27.902 6.76489 28.5139 7.51753 28.8974C8.37318 29.3334 9.49329 29.3334 11.7335 29.3334H16.0002M18.6668 14.6667H10.6668M13.3335 20.0001H10.6668M21.3335 9.33341H10.6668M24.0002 28.0001V20.0001M20.0002 24.0001H28.0002"
                                  stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Write a review</span>
                    </div>
                    <div id="listReview" class="list-review reviewed">
                        @foreach($result as $res)
                            @php
                                $userReview = $res->user_id;
                            @endphp
                            <div class="review-item">
                                <div class="review-user d-flex justify-content-between align-items-center">
                                    <div class="user d-flex align-items-center">
                                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="" class="avt">
                                        <div class="name">
                                            {{$res->username}}
                                        </div>
                                    </div>
                                    <div class="review-rating">
                                        <div class="rating">
                                            @if($res->star_number == 1)
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                            @endif
                                            @if($res->star_number == 2)
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                            @endif
                                            @if($res->star_number == 3)
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                            @endif
                                            @if($res->star_number == 4)
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #ccc"></i>
                                            @endif
                                            @if($res->star_number == 5)
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325"></i>
                                            @endif
                                        </div>
                                        <div class="time">
                                            {{$res->created_at}}
                                        </div>
                                    </div>
                                </div>
                                <div class="review-content">
                                    {{$res->content}}
                                </div>
                                @if($res->user_id == Auth::user()->id)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#edit-comment"
                                            onclick="getCommentById({{ $res->id }})">
                                        {{ __('home.edit-comment') }}
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="d-flex justify-content-start align-items-center">
                <div class="content-products">
                    {{ __('home.Related Products') }}
                </div>
            </div>

            <div class="swiper DetailProducts">
                <div class="swiper-wrapper " style="max-height: 50%; overflow: hidden">
                    @foreach($related_products as $product)
                        <div class="swiper-slide swiper-slide-product">
                            @include('frontend.layouts.branch.list-product-feature')
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <div class="section margin-layout-index margin-top-layout container-fluid mt-3">
            <div class="d-flex justify-content-start align-items-center">
                <div class="content-products">
                    {{ __('detail-product.Recently viewed products') }}
                </div>
            </div>

            <div class="swiper DetailProducts">
                <div class="swiper-wrapper " style="max-height: 50%; overflow: hidden">
                    @foreach($view_products as $product)
                        <div class="swiper-slide swiper-slide-product">
                            @include('frontend.layouts.branch.list-product-feature')
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <div class="modal fade" id="edit-comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{route('update.evaluate.id')}}">
                        <div class="modal-body">
                            @csrf
                            <input type="text" hidden id="id-cmt-edit" name="id">

                            <input type="text" class="form-control" id="product_id" name="product_id"
                                   value="{{$productItem->id}}" hidden/>
                            <div class="rating">
                                <input type="radio" name="star_number" id="star-edit-1" value="1" hidden="">
                                <label for="star-edit-1" onclick="starCheckEdit(1)"><i id="icon-star-edit-1"
                                                                                       class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star-edit-2" value="2" hidden="">
                                <label for="star-edit-2" onclick="starCheckEdit(2)"><i id="icon-star-edit-2"
                                                                                       class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star-edit-3" value="3" hidden="">
                                <label for="star-edit-3" onclick="starCheckEdit(3)"><i id="icon-star-edit-3"
                                                                                       class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star-edit-4" value="4" hidden="">
                                <label for="star-edit-4" onclick="starCheckEdit(4)"><i id="icon-star-edit-4"
                                                                                       class="fa fa-star"></i></label>
                                <input type="radio" name="star_number" id="star-edit-5" value="5" hidden="" checked>
                                <label for="star-edit-5" onclick="starCheckEdit(5)"><i id="icon-star-edit-5"
                                                                                       class="fa fa-star"></i></label>
                            </div>
                            <input id="input-star-edit" value="0" hidden="">
                            <div id="text-message" class="text-danger d-none">{{ __('home.Please select star rating') }}
                            </div>

                            <div class="form-group row">
                                <label for=""
                                       class="col-sm-12 col-form-label">{{ __('home.your name') }}</label>
                                <div class="col-sm-12">
                                    <input onclick="checkStar()" type="text" class="form-control" id="name-edit"
                                           name="username"
                                           placeholder="{{ __('home.your name') }}" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for=""
                                       class="col-sm-12 col-form-label">{{ __('home.your review') }}</label>
                                <div class="col-sm-12">
                                    <textarea onclick="checkStar()" class="form-control" id="content-edit"
                                              name="content"
                                              placeholder="{{ __('home.your review') }}"
                                              rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ __('home.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalContact" tabindex="-1" aria-labelledby="modalContactLabel" aria-hidden="true">
            <div class="modal-dialog modalShowContact">
                <div class="modal-content modalContact">
                    <form action="{{ route('user.send.mail.seller') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title text-left" id="modalContactLabel">Send require</h5>
                            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path d="M15 9L9 15M9 9L15 15M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z"
                                          stroke="black" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="product-main modal-body">
                            <div class="row render-product">
                                <div class="col-xl-10 col-md-8 col-xs-6">
                                    <div class="product-item">
                                        <div class="product-show d-flex justify-content-between align-items-center">
                                            <div class="product d-flex align-items-center">
                                                @php
                                                    $thumbnail = checkThumbnail($productItem->thumbnail);
                                                @endphp
                                                <img src="{{ $thumbnail }}" alt="" class="img-product">
                                                <div class="product-info">
                                                    <div class="product-name">
                                                        {{ $productItem->name }}
                                                    </div>
                                                    <div class="product-price">
                                                        <span class="real-price"> {{ number_format(convertCurrency('USD', $currency,$productItem->price), 0, ',', '.') }} {{$currency}}</span>
                                                        <span>
                                                        <del> {{ number_format(convertCurrency('USD', $currency,$productItem->old_price), 0, ',', '.') }} {{$currency}}</del>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="quantity">
                                            <span class="decrease modal-decrease">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     viewBox="0 0 16 16" fill="none">
                                                  <path d="M4 8H12" stroke="#292D32" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                                <input class="input_number" id="modal_input_number" type="number"
                                                       name="product_quantity"
                                                       value="{{ isset($productItem->min) ? $productItem->min : 1  }}"
                                                       min="{{ isset($productItem->min) ? $productItem->min : 1  }}">
                                                <span class="increase modal-increase">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     viewBox="0 0 16 16" fill="none">
                                                  <path d="M4 8H12" stroke="#292D32" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"/>
                                                  <path d="M8 12V4" stroke="#292D32" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-4 col-xs-6">
                                    <div class="sup">
                                        <select class="form-control" id="form-select" name="product_fn">
                                            <option>FOB</option>
                                            <option>EXW</option>
                                            <option>FCA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="content-item">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" rows="5" name="content"
                                          placeholder="Your review"></textarea>
                            </div>
                            <div class="email-item">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="d-none">
                            <input type="text" name="product_id" value="{{ $productItem->id }}">
                        </div>
                        <div class="modal-footer d-flex justify-content-end align-items-end">
                            <div class="button">
                                <button type="submit" class="btn btnSend">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-none">
            <form action="{{route('member.add.cart', $productItem)}}" method="post" id="formOrderMember">
                @csrf
                <input type="text" name="productInfo" id="productInfo">
                <button id="btnOrder" type="submit" class="btn btn-success float-right">Submit</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#addReview').on('click', function () {
                $('#formReview').removeClass('d-none');
                $('.reviewed').addClass('d-none');

            })


            $('.btn-cancel').on('click', function () {
                $('#formReview').addClass('d-none');
                $('.reviewed').removeClass('d-none');
            })

            $('.modal-decrease').on('click', function () {
                let quantity = $('#modal_input_number');
                let value = quantity.val();
                if (value > 0) {
                    --value;
                    quantity.val(value);
                }
            })

            $('.modal-increase').on('click', function () {
                let quantity = $('#modal_input_number');
                let value = quantity.val();
                ++value;
                quantity.val(value);
            })
        })
    </script>
    <script>
        $(window).on('load', function () {
            var largestHeight = 50;
            if ($('#content1').height() < largestHeight) {
                $('#toggleBtn1').addClass('d-none');
            } else {
                $('#toggleBtn1').removeClass('d-none');
            }
        });

        $(window).on('load1', function () {
            var largestHeight1 = 50;
            if ($('#content2').height() < largestHeight1) {
                $('#toggleBtn2').addClass('d-none');
            } else {
                $('#toggleBtn2').removeClass('d-none');
            }
        });

        function toggleContent(contentId, btnId) {
            var content = document.getElementById(contentId);
            var toggleBtn = document.getElementById(btnId);

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                toggleBtn.innerHTML = "{{ __('home.Show More') }}";
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
                toggleBtn.innerHTML = "{{ __('home.Show Less') }}";
            }
        }
    </script>
    <script>
        var result = [];
        var product_id = document.getElementById('product_id')
        var radio = document.getElementsByClassName('inputRadioButton');
        let isCheck = false
        $('#resetSelect').on('click', function () {
            for (let i = 0; i < radio.length; i++) {
                radio[i].checked = false;
            }
            result = [];
        })
        var urlImg = document.getElementById('urlImage').value;
        var productThumbnail = document.getElementById('productThumbnail')
        var productPrice = document.getElementById('productPrice')
        var productOldPrice = document.getElementById('productOldPrice')
        var productQuantity = document.getElementById('productQuantity')
        var variable = document.getElementById('variable')
        $('.inputRadioButton').on('change', function () {
            let text = $(this).val();

            let [prefix, value] = text.split('-');

            let prefixExists = false;
            for (let i = 0; i < result.length; i++) {
                let [existingPrefix, existingValue] = result[i].split('-');
                if (existingPrefix === prefix) {
                    result[i] = text;
                    prefixExists = true;
                    break;
                }
            }

            if (!prefixExists) {
                result.push(text);
            }
            result.sort();
            myfunction(product_id.value, result);

            checkBtn();
        });

        var price = document.getElementById('price')

        function checkBtn() {
            for (let i = 0; i < radio.length; i++) {
                if (radio[i].checked == true) {
                    isCheck = true;
                }
            }
            if (!isCheck) {
                $('#resetSelect').attr("disabled", true);
                $('#btnAddCard').attr("disabled", true);
                $('#btnAddCard').removeClass('add-to-cart');
                $('#btnAddCard').addClass('btn btn-secondary');
            } else {
                $('#resetSelect').attr("disabled", false);
                $('#btnAddCard').attr("disabled", false);
                $('#btnAddCard').addClass('add-to-cart');
            }
        }

        function myfunction(id, value) {
            let url = '/product-variable'
            fetch(url + '/' + id + '/' + value, {
                method: 'GET',
            })
                .then(response => {
                    if (response.status == 200) {
                        return response.json();
                    }
                })
                .then((response) => {
                    productThumbnail.src = urlImg + '/' + response['thumbnail'];
                    productPrice.innerText = response['price'];
                    price.value = response['price'];
                    productOldPrice.innerText = response['old_price'];
                    productQuantity.innerText = response['quantity'];
                    variable.value = response['variation'];
                })
                .catch(error => {
                });
        }

        checkBtn();
    </script>
    <script>
        const activeImage = document.querySelector(".product-image .active");
        const productImages = document.querySelectorAll(".image-list img");
        const navItem = document.querySelector('a.toggle-nav');

        function changeImage(e) {
            activeImage.src = e.target.src;
        }

        function toggleNavigation() {
            this.nextElementSibling.classList.toggle('active');
        }

        productImages.forEach(image => image.addEventListener("click", changeImage));
        navItem.addEventListener('click', toggleNavigation);
    </script>
    <script>
        function createVoucherItems(id) {
            $.ajax({
                url: `{{route('vouchers.item.create')}}`,
                method: 'POST',
                data: {
                    'voucher_id': id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {

                    if (response == "Error") {
                        alert('Voucher đã có sẵn trong giỏ hàng rồi! Sử dụng thôi!')
                    } else {
                        alert("Nhận voucher thành công")
                    }
                },
                error: function (exception) {

                    if (exception['status'] == 403) {
                        alert('Error, please try again!')
                    } else if (exception['status'] == 401) {
                        alert('Please login to continue!')
                        window.location.href = '/login';
                    } else {
                        alert('Error, please try again!')
                    }
                }
            });
        }
    </script>
    <script>
        function checkProductReviews() {
            let product_id = document.getElementById('product_id').value;


            const arrayID = [];
            if (localStorage.getItem('productIDs') != null) {
                const oldValue = localStorage.getItem('productIDs');
                const result = oldValue.split(',');
                for (let i = 0; i < result.length; i++) {
                    if (result[i] != product_id) {
                        arrayID.push(result[i])
                    }
                }
                arrayID.push(product_id);
            } else {
                arrayID.push(product_id);
            }
            localStorage.setItem('productIDs', arrayID.toString());
        }


        checkProductReviews();
    </script>
    <script>
        function zoomImg(x) {
            imgDf = document.getElementById('img-default');
            imgDf.src = x.src;
        }

        function normalImg() {
            imgDf = document.getElementById('img-default');
            imgRollback = document.getElementById('img-rollback').value;
            imgDf.src = imgRollback;
        }

        function zoomImgModal(x) {
            imgDf = document.getElementById('img-modal');
            imgDf.src = x.src;
        }

        function orderClick() {
            btnOrder = document.getElementById('btn-order-now');
            btnOrder.click();
        }

        function checkStar() {
            let btn = document.getElementById('btn-submit');
            let input = document.getElementById('input-star');
            let message = document.getElementById('text-message');
            if (input.value == 0) {
                message.classList.remove("d-none");
                btn.disabled = true;
            } else {
                message.classList.add("d-none");
                btn.disabled = false;
            }
        }

        function starCheck(value) {
            let input = document.getElementById('input-star');
            let star = document.getElementById('star' + value);
            let icon = document.getElementById('icon-star-' + value);

            let isChecked = star.checked;

            // Toggle the clicked star
            star.checked = !isChecked;

            for (let i = 1; i <= 5; i++) {
                let currentStar = document.getElementById('star' + i);
                let currentIcon = document.getElementById('icon-star-' + i);

                if (i <= value) {
                    currentStar.checked = true;
                    currentIcon.classList.add("checked");
                } else {
                    currentStar.checked = false;
                    currentIcon.classList.remove("checked");
                }
            }

            // Update the input value based on the checked state of the clicked star
            input.value = star.checked ? value : value - 1;

            checkStar();
        }

        function starCheckEdit(value) {
            let input = document.getElementById('input-star-edit');
            let star = document.getElementById('star-edit-' + value);
            let icon = document.getElementById('icon-star-edit-' + value);

            let isChecked = star.checked;

            // Toggle the clicked star
            star.checked = !isChecked;

            for (let i = 1; i <= 5; i++) {
                let currentStar = document.getElementById('star-edit-' + i);
                let currentIcon = document.getElementById('icon-star-edit-' + i);

                if (i <= value) {
                    currentStar.checked = true;
                    currentIcon.classList.add("checked");
                } else {
                    currentStar.checked = false;
                    currentIcon.classList.remove("checked");
                }
            }

            input.value = star.checked ? value : value - 1;
        }

        function toggleReadMore() {
            var moreLink = document.getElementById("more-link");
            var moreContent = document.getElementById("more");
            var readMore = '{{ __("home.read more") }}';
            var readLess = '{{ __("home.read less") }}';


            if (moreContent.classList.contains("show")) {
                moreLink.textContent = readMore;
            } else {
                moreLink.textContent = readLess;
            }
        }

        let urlParams = window.location.href;
        let myParam = urlParams.split('/');
        let num = myParam.length;
        document.getElementById("product_id").value = myParam[num - 1];

        function myFunction(x) {
            let tabs = document.getElementById('id-tabs-product');
            if (x.matches) {
                tabs.classList.remove("card");
                tabs.classList.add("border");
            }
        }

        var x = window.matchMedia("(max-width: 770px)")
        myFunction(x)
        x.addListener(myFunction)

        function responsiveTable(y) {
            let tabs = document.getElementsByClassName('product-other');

            var i;
            for (i = 0; i < tabs.length; i++) {
                if (y.matches) {
                    tabs[i].classList.remove("col-md-3");
                    tabs[i].classList.add("col-sm-6");
                }
            }


        }

        var y = window.matchMedia("(max-width: 991px)")
        responsiveTable(y);
        x.addListener(responsiveTable)


        var elements = document.getElementsByClassName('random-color');


        // for (var i = 0; i < elements.length; i++) {
        // let random_color = Math.floor(Math.random()*16777215).toString(16);
        // elements[i].style.backgroundColor = '#' + random_color;
        // }


        for (var i = 0; i < elements.length; i++) {
            let random_color = getBrightRandomColor();
            elements[i].style.backgroundColor = '#' + random_color;
        }


        // chỉ lấy màu sáng
        function getBrightRandomColor() {
            var minBrightness = 128; // Độ sáng tối thiểu
            var maxBrightness = 255; // Độ sáng tối đa

            var color;
            var brightness;

            do {
                color = Math.floor(Math.random() * 16777215).toString(16);
                brightness = getBrightness(color);
            } while (brightness < minBrightness || brightness > maxBrightness);


            return color;
        }


        function getBrightness(color) {
            var hexColor = color.replace('#', '');
            var red = parseInt(hexColor.substr(0, 2), 16);
            var green = parseInt(hexColor.substr(2, 2), 16);
            var blue = parseInt(hexColor.substr(4, 2), 16);


// Áp dụng công thức để tính độ sáng
            var brightness = (red * 299 + green * 587 + blue * 114) / 1000;
            return brightness;
        }
    </script>
    <script>
        async function getCommentById(id) {
            let url = '{{ route('find.evaluate.id', ['id' => ':id']) }}';
            url = url.replace(':id', id);

            const response = await fetch(url);

            if (response.ok) {
                const data = await response.json();
                document.getElementById('id-cmt-edit').value = data[0].id;
                document.getElementById('name-edit').value = data[0].username;
                document.getElementById('content-edit').value = data[0].content;
                starCheckEdit(data[0].star_number)
            }
        }
    </script>
    <script>
        let productItemInfo = [];
        let inputQuantity = $('.inputQuantityVariable');

        $(document).ready(function () {
            /* Handle button when process order*/
            function checkInput() {
                let listInput = document.getElementsByClassName('inputQuantityVariable');
                let check = false;
                for (let i = 0; i < listInput.length; i++) {
                    if (listInput[i].value > 0) {
                        check = true;
                        break;
                    }
                }

                document.getElementById("supBtnOrder").disabled = check !== true;
            }

            checkInput();

            $('.decrease').on('click', function () {
                let dataID = $(this).data('id');
                let quantity = $('#inputQuantityVariable_' + dataID);
                let value = quantity.val();
                if (value > 0) {
                    --value;
                    quantity.val(value);
                    loadQuantity(dataID);
                }
            })

            $('.increase').on('click', function () {
                let dataID = $(this).data('id');
                let quantity = $('#inputQuantityVariable_' + dataID);
                let value = quantity.val();
                ++value;
                quantity.val(value);
                loadQuantity(dataID);
            })

            /* Check data previous of input, set data-val of input*/
            inputQuantity.on('focusin', function () {
                $(this).data('val', parseInt($(this).val()));
            });

            /* Handle logic code when change data of input quantity in product*/
            inputQuantity.on('change', function () {
                let variableID = $(this).data('id');
                loadQuantity(variableID);
            })

            function loadQuantity(variableID) {
                let inputElement = $('#inputQuantityVariable_' + variableID);
                let priceShipElement = $('#priceShip_' + variableID);
                // get price
                let idPrice = 'productPrice_' + variableID;
                let textPrice = 'textPrice_' + variableID;

                checkInput();

                // get data-val of input change
                let prevValue = parseInt(inputElement.data('val'));
                // get current value of input change
                let itemValue = parseInt(inputElement.val());

                let product = inputElement.data('product');

                let priceOld = product['price'];

                let productMin = product['min'];

                //Compare prev value with current value
                if (itemValue > prevValue) {
                    // Set min of input
                    if (itemValue < productMin) {
                        itemValue = productMin;
                        inputElement.val(productMin);
                    }
                } else if (itemValue < prevValue) {
                    // Set value of input = 0
                    if (itemValue < productMin) {
                        itemValue = 0;
                        inputElement.val(0);
                    }
                }

                // Re-set data-val of input
                inputElement.data('val', itemValue);

                let currencies = document.getElementsByClassName('currency');
                let currency = currencies[0].innerText;

                // get product sale
                async function getSales() {
                    try {
                        let productSale = await getProductSale(itemValue);
                        if (productSale) {
                            let priceSale = productSale['sales'];
                            let result = await convertNewCurrency(priceSale);
                            $('#' + textPrice).text(result);
                            $('#' + idPrice).val(priceSale);
                            let priceShip = await convertNewCurrency(productSale['ship']);
                            let priceShipText = priceShip + ' ' + currency;
                            priceShipElement.text(priceShipText)
                            await changeDataTotal(productSale['ship']);
                        } else {
                            let result = await convertNewCurrency(priceOld);
                            $('#' + textPrice).text(result);
                            $('#' + idPrice).val(priceOld);
                            priceShipElement.text(0 + ' ' + currency);
                            await changeDataTotal(0);
                        }
                    } catch (error) {
                        console.error(error);
                    }
                }

                getSales();

                async function changeDataTotal(ship) {
                    let price = $('#' + idPrice).val();
                    //total
                    let total = parseFloat(price) * itemValue + ship;
                    // render total
                    await mainConvertTotal(total);
                }

                // using function convertNewCurrency(total);
                async function mainConvertTotal(total) {
                    try {
                        let result = await convertNewCurrency(total);
                        let totalConvert = result + ' ' + currency;
                        $('#totalValue_' + variableID).text(totalConvert);
                    } catch (error) {
                        console.error(error);
                    }
                }

                changeDataTotal(0);

                // order
                let variable = inputElement.data('variable');
                let quantity = inputElement.val();
                let item = quantity + '&' + variable;

                let index = productItemInfo.findIndex(element => {
                    return element.endsWith(variable);
                });

                if (quantity > 0) {
                    if (index !== -1) {
                        productItemInfo[index] = item;
                    } else {
                        productItemInfo.push(item);
                    }
                } else {
                    if (index !== -1) {
                        productItemInfo.splice(index, 1);
                    }
                }

                let value = null;
                if (productItemInfo.length > 0) {
                    for (let i = 0; i < productItemInfo.length; i++) {
                        if (!value) {
                            value = productItemInfo[i];
                        } else {
                            value = value + '#' + productItemInfo[i];
                        }
                    }
                }

                $('#productInfo').val(value);
            }

            /* Get product sales*/
            async function getProductSale(quantity) {
                const requestData = {
                    _token: `{{ csrf_token() }}`,
                    productID: `{{ $productItem->id }}`,
                    quantity: quantity,
                };

                try {
                    let productSale = await $.ajax({
                        url: `{{route('member.product.sales')}}`,
                        method: 'GET',
                        data: requestData,
                        body: JSON.stringify(requestData),
                    })
                    return productSale;
                } catch (error) {
                    throw error;
                }
            }

            /* Submit form*/
            $('#supBtnOrder').on('click', function () {
                $('#formOrderMember').trigger("submit");
            })
        })

        function debounce(func, delay) {
            let timeout;
            return function executedFunc(...args) {
                if (timeout) {
                    clearTimeout(timeout);
                }
                timeout = setTimeout(() => {
                    func(...args);
                    timeout = null;
                }, delay);
            };
        }

        function setMoreValueOther(price, ship, total) {
            $('#valueProduct').text(price);
            $('#valueShip').text(ship);
            $('#valueTotal').text(total);
        }

        /* Convert currency*/
        async function convertNewCurrency(total) {
            let url = `{{ route('convert.currency', ['total' => ':total']) }}`;
            url = url.replace(':total', total);

            try {
                let response = await $.ajax({
                    url: url,
                    method: 'GET',
                });
                return response;
            } catch (error) {
                throw error;
            }
        }
    </script>
    <script>
        function showVariableModalOrder() {
            document.querySelector('.order-detail').classList.add('active-modal')
            document.querySelector('.closeModalOrder').classList.add('show-modal')
        }

        function closeVariableModalOrder() {
            document.querySelector('.order-detail').classList.remove('active-modal')
            document.querySelector('.closeModalOrder').classList.remove('show-modal')
        }
    </script>
    <script>
        let priceCart = '#priceCart';
        let totalCart = '#totalCart';
        let currency = $('.currency').first().text();
        $(document).ready(function () {
            $('.input-number-cart').on('change', function () {
                let cartID = $(this).data('id');
                let url = `{{ route('cart.api.update', ['id' => ':id']) }}`;
                url = url.replace(':id', cartID);
                let quantity = $(this).val();

                const requestData = {
                    _token: `{{ csrf_token() }}`,
                    quantity: quantity,
                };
                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: requestData,
                    body: JSON.stringify(requestData),
                })
                    .done(function (response) {
                        let cartItem = response['cart'];
                        let total = parseFloat(cartItem['price']) * parseFloat(cartItem['quantity'])
                        convertPriceCart(cartItem['price'], cartID);
                        convertTotalCart(total, cartID);
                    })
                    .fail(function (_, textStatus) {

                    });

                /* Using function convertNewCurrency(total)*/
                async function convertTotalCart(total, cartID) {
                    try {
                        let result = await convertNewCurrency(total);
                        let totalConvert = result + ' ' + currency;
                        $(totalCart + cartID).text(totalConvert);
                    } catch (error) {
                        console.error(error);
                    }
                }

                async function convertPriceCart(price, cartID) {
                    try {
                        let result = await convertNewCurrency(price);
                        $(priceCart + cartID).text(result);
                    } catch (error) {
                        console.error(error);
                    }
                }
            })
        })
    </script>
    <script>
        var urla = '{{route('user.wish.lists')}}';
        var token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/frontend/index.js') }}"></script>
@endsection

