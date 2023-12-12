<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">

@php
    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
@endphp
<div class="item item-hover bg-white">
    @if($product->thumbnail)
        @php
            $thumbnail = checkThumbnail($product->thumbnail);
        @endphp
        <div class="item-img p-2">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}">
                    <img src="{{ $thumbnail }}" alt="" class="image-product"></a>
            @else
                <a href="#"><img src="{{ $thumbnail }}" alt="" class="image-product"></a>
            @endif
        </div>
    @endif
    <div class="item-body p-2">
        @php
            $nameSeller = DB::table('users')->where('id', $product->user_id)->first();
        @endphp
        <div class="card-title1">
            @if(Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}">
                    @if(locationHelper() == 'kr')
                        {{ ($product->name_ko) }}
                    @elseif(locationHelper() == 'cn')
                        {{ ($product->name_zh) }}
                    @elseif(locationHelper() == 'jp')
                        {{ ($product->name_ja) }}
                    @elseif(locationHelper() == 'vi')
                        {{ ($product->name_vi) }}
                    @else
                        {{ ($product->name_en) }}
                    @endif
                </a>
            @else
                <a href="#">
                    @if(locationHelper() == 'kr')
                        {{ ($product->name_ko) }}
                    @elseif(locationHelper() == 'cn')
                        {{ ($product->name_zh) }}
                    @elseif(locationHelper() == 'jp')
                        {{ ($product->name_ja) }}
                    @elseif(locationHelper() == 'vi')
                        {{ ($product->name_vi) }}
                    @else
                        {{ ($product->name_en) }}
                    @endif
                </a>
            @endif
        </div>
        <div class="card-price">
            <div class="price-sale">
                {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}
            </div>
        </div>
    </div>
    <div class="icon-hover">
        <div class="list-icon float-right">
            <a class="icon-item" data-toggle="modal" data-target="#modalProductItem_{{$product->id}}"><i
                        class="fa-solid fa-magnifying-glass"></i></a>
            <a class="icon-item" href="#"><i class="fa-solid fa-rotate-right"></i></a>
            <a class="icon-item icon-heart" data-id="{{ $product->id }}"><i class="fa-regular fa-heart"></i></a>
            <a class="icon-item" data-toggle="modal" data-target="#modalProductCart__{{$product->id}}"><i
                        class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </div>
    <div class="button-hover">
        <div class="button-view">
            <button class="btn btnQuickAdd">{{ __('home.Add To Cart') }}</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalProductItem_{{$product->id}}" tabindex="-1"
     aria-labelledby="modalProductItemLabel_{{$product->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modalProductItem">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body">
                <div class="col-xl-4 col-md-6 col-sm-12 product-images">
                    @php
                        $thumbnail = checkThumbnail($product->thumbnail);
                    @endphp
                    <img src="{{ $thumbnail }}" alt="" class="product-image-main">
                    @php
                        $gallery = $product->gallery;
                        $arrayGallery = explode(',', $gallery);
                    @endphp
                    <ul class="images-gallery">
                        <li class="image-item"><img alt="" src="{{ $thumbnail }}"></li>
                        @foreach($arrayGallery as $gallery)
                            @php
                                $gallery = checkThumbnail($gallery);
                            @endphp
                            <li class="image-item"><img alt="" src="{{ $gallery }}"></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-xl-8 col-md-6 col-sm-12 product-info">
                    <div class="product-name">
                        {{ $product->name }}
                    </div>
                    <div class="product-rate">
                        <i class="fa-solid fa-star"
                           style="color: #fac325"></i>
                        <i class="fa-solid fa-star"
                           style="color: #fac325"></i>
                        <i class="fa-solid fa-star"
                           style="color: #fac325"></i>
                        <i class="fa-solid fa-star"
                           style="color: #ccc"></i>
                        <i class="fa-solid fa-star"
                           style="color: #ccc"></i>
                    </div>
                    <div class="product-price">
                        <span class="real-price">
                            {{ $product->price }}
                        </span>
                        <div class="del-price">
                            <del>{{ $product->old_price }}</del>
                        </div>
                    </div>
                    <div class="share">
                        <span class="title">Share: </span>
                        <span class="list-social">
                            <span class="social-item social-product-facebook mr-2">
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
                                </span>
                            <span class="social-item social-product-whatapp mr-2">
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
                            </span>
                            <span class="social-item social-product-ins mr-2">
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
                            </span>
                            <span class="social-item social-product-twitter">
                                    <img src="{{ asset('images/tter.svg') }}" alt="">
                            </span>
                        </span>
                    </div>
                    <div class="show-order d-flex justify-content-between align-items-center">
                        <div class="input-quantity">
                            <span class="decrease-input" data-id="{{ $product->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none">
                                  <path d="M4 8H12" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <input type="number" value="{{$product->min}}" min="{{$product->min}}" class="inputQuantity"
                                   id="inputQuantity{{ $product->id }}" data-min="{{$product->min}}"
                                   data-id="{{ $product->id }}" data-product="{{$product}}"
                                   data-variable="{{$product->variation}}">
                            <span class="increase-input" data-id="{{ $product->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 16 16" fill="none">
                                  <path d="M4 8H12" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                  <path d="M8 12V4" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                        @php
                            $isFavourite = null;
                            if (Auth::check()){
                                $isFavourite = \App\Models\WishList::where('product_id', $product->id)->where('user_id', Auth::user()->id)->first();
                            }
                        @endphp
                        <div class="heart">
                            <a class="icon-heart" data-id="{{ $product->id }}"><i
                                        class="fa-regular fa-heart" style="{{ $isFavourite ? 'color: red' : '' }}"></i></a>
                        </div>
                        <div class="order">
                            <button class="btn disabled">Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalProductCart__{{$product->id}}" tabindex="-1"
     aria-labelledby="modalProductCartLabel_{{$product->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modalProductCart">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductCartLabel_{{$product->id}}">Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mainModalCart">
                @foreach($listCart as $cart)

                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Cancel') }}</button>
                <a href="{{ route('checkout.show') }}" class="btn btn-primary">{{ __('home.Check out') }}</a>
            </div>
        </div>
    </div>
</div>
