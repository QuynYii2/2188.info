@extends('frontend.layouts.master')
@section('title', 'Checkout')
@section('content')
    <div class="container-fluid checkout-page">
        <div class="grid second-nav">
            <div class="column-xs-12 category-header" style="padding: 1rem">
                <div class="breadcrumbs_filter">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                            <li class="breadcrumb-item">
                                Product
                            </li>
                            <li class="breadcrumb-item">
                                Detail product
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Payment
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <form action="#" id="checkout-form" method="post">
            @csrf
            <div class="row" style="padding: 0 2rem">
                <div class="col-lg-8 col-md-6 col-sm-12 address-package">
                    <div class="card bg-white address-area">
                        <div class="title d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                 fill="none">
                                <path d="M5 14.7864C3.14864 15.6031 2 16.7412 2 18C2 20.4853 6.47715 22.5 12 22.5C17.5228 22.5 22 20.4853 22 18C22 16.7412 20.8514 15.6031 19 14.7864M18 8.5C18 12.5637 13.5 14.5 12 17.5C10.5 14.5 6 12.5637 6 8.5C6 5.18629 8.68629 2.5 12 2.5C15.3137 2.5 18 5.18629 18 8.5ZM13 8.5C13 9.05228 12.5523 9.5 12 9.5C11.4477 9.5 11 9.05228 11 8.5C11 7.94772 11.4477 7.5 12 7.5C12.5523 7.5 13 7.94772 13 8.5Z"
                                      stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="text">Address</span>
                        </div>
                        <a href="#" class="main-address d-flex justify-content-between align-items-center">
                            <div class="address-detail">
                                <div class="name">
                                    <span class="title">Name: </span>
                                    <span class="value">{{ $address ? $address->username : Auth::user()->name}}</span>
                                </div>
                                <div class="phone">
                                    <span class="title">Phone: </span>
                                    <span class="value">{{ $address ? $address->phone : Auth::user()->phone}}</span>
                                </div>
                                <div class="address">
                                    <span class="title">Address: </span>
                                    <span class="value">{{ $address ? $address->address_detail : Auth::user()->address}}</span>
                                </div>
                            </div>
                            <div class="nav-select">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                     fill="none">
                                    <path d="M12 24L20 16L12 8" stroke="black" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="select-package">
                        <div class="title">Select Package</div>
                        <div class="list-method">
                            <div class="method-detail d-flex justify-content-between align-items-center method-cod">
                                <label for="cod">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         fill="none">
                                        <g clip-path="url(#clip0_3017_12516)">
                                            <path
                                                    d="M3.98761 21.3248C3.90047 21.2376 3.77953 21.1875 3.65625 21.1875C3.53297 21.1875 3.41203 21.2376 3.32484 21.3248C3.23766 21.4121 3.1875 21.533 3.1875 21.6562C3.1875 21.7795 3.23761 21.9005 3.32484 21.9876C3.41203 22.0748 3.53297 22.125 3.65625 22.125C3.77953 22.125 3.90047 22.0748 3.98761 21.9876C4.0748 21.9005 4.125 21.7795 4.125 21.6562C4.125 21.533 4.07484 21.412 3.98761 21.3248Z"
                                                    fill="black"/>
                                            <path
                                                    d="M22.0091 8.57484C21.922 8.48761 21.8015 8.4375 21.6777 8.4375C21.5545 8.4375 21.4335 8.48761 21.3463 8.57484C21.2592 8.66203 21.209 8.78297 21.209 8.90625C21.209 9.02953 21.2591 9.15047 21.3463 9.23761C21.4335 9.3248 21.5545 9.375 21.6777 9.375C21.8015 9.375 21.922 9.32484 22.0091 9.23761C22.0967 9.15047 22.1469 9.02953 22.1469 8.90625C22.1469 8.78297 22.0967 8.66203 22.0091 8.57484Z"
                                                    fill="black"/>
                                            <path
                                                    d="M23.8621 0.137297C23.7742 0.0494062 23.6549 0 23.5305 0L11.9996 0.000609375C11.7407 0.000609375 11.5309 0.210516 11.5309 0.469359V1.80984L7.08764 3.00042C6.83756 3.06745 6.68916 3.32447 6.75619 3.5745L9.05902 12.1687L7.06687 14.1608C6.81333 13.7906 6.38761 13.5471 5.90606 13.5471H1.4062C0.630797 13.5471 0 14.178 0 14.9533V22.5938C0 23.3692 0.630797 24 1.4062 24H5.90611C6.56484 24 7.119 23.5446 7.27087 22.9322L7.82822 23.4182C8.25848 23.7934 8.80973 24 9.38062 24H23.5306C23.7895 24 23.9994 23.7901 23.9994 23.5313V0.46875C23.9993 0.344438 23.95 0.225187 23.8621 0.137297ZM6.37476 22.5938C6.37476 22.8522 6.16448 23.0625 5.90601 23.0625H1.40616C1.14769 23.0625 0.937406 22.8523 0.937406 22.5938V14.9534C0.937406 14.6949 1.14769 14.4846 1.40616 14.4846H3.18736V19.8844C3.18736 20.1432 3.39727 20.3531 3.65611 20.3531C3.91495 20.3531 4.12486 20.1432 4.12486 19.8844V14.4846H5.90606C6.16453 14.4846 6.37481 14.6949 6.37481 14.9534V22.5938H6.37476ZM7.78303 3.78464L11.5309 2.78039V4.51734L11.2167 4.60153C11.0966 4.63373 10.9942 4.71225 10.9321 4.81992C10.8699 4.92759 10.8531 5.05552 10.8853 5.17561C11.0654 5.84784 10.665 6.54127 9.99281 6.72141C9.87258 6.75366 9.77006 6.83231 9.70795 6.94022C9.64584 7.04808 9.62911 7.17623 9.66159 7.29642L11.4887 14.0623H10.548L10.0631 12.1655C10.0477 12.1051 10.0207 12.0495 9.98456 12.0011L7.78303 3.78464ZM11.5309 6.66698V10.6223L10.6759 7.45664C11.0331 7.27223 11.3253 6.99633 11.5309 6.66698ZM18.2651 23.0625H9.38053C9.03623 23.0625 8.70375 22.9379 8.44425 22.7116L7.31226 21.7244V15.2413L9.35873 13.1948L9.72989 14.647C9.78295 14.8545 9.96984 14.9996 10.184 14.9996L19.3998 15.0002C19.7617 15.0002 20.0561 15.2946 20.0561 15.6564C20.0561 16.0183 19.7617 16.3127 19.3998 16.3127H14.6776C14.4188 16.3127 14.2089 16.5226 14.2089 16.7814C14.2089 17.0403 14.4188 17.2502 14.6776 17.2502H20.867C21.2289 17.2502 21.5233 17.5446 21.5233 17.9064C21.5233 18.2683 21.2289 18.5627 20.867 18.5627H14.6776C14.4188 18.5627 14.2089 18.7726 14.2089 19.0314C14.2089 19.2903 14.4188 19.5002 14.6776 19.5002H19.864C20.2259 19.5002 20.5203 19.7946 20.5203 20.1564C20.5203 20.5183 20.2259 20.8127 19.864 20.8127H14.6776C14.4188 20.8127 14.2089 21.0226 14.2089 21.2814C14.2089 21.5403 14.4188 21.7502 14.6776 21.7502H18.2651C18.627 21.7502 18.9214 22.0446 18.9214 22.4064C18.9213 22.7681 18.627 23.0625 18.2651 23.0625ZM23.0619 23.0625H19.7169C19.8078 22.8622 19.8588 22.6402 19.8588 22.4062C19.8588 22.1723 19.8078 21.9503 19.7169 21.75H19.864C20.7428 21.75 21.4577 21.0351 21.4577 20.1563C21.4577 19.9 21.3966 19.6578 21.2886 19.443C21.9634 19.2577 22.4607 18.6391 22.4607 17.9063C22.4607 17.5508 22.3436 17.2222 22.1461 16.9569V11.016C22.1461 10.7571 21.9362 10.5472 21.6773 10.5472C21.4185 10.5472 21.2086 10.7571 21.2086 11.016V16.35C21.0984 16.3258 20.9842 16.3127 20.8669 16.3127H20.8515C20.9424 16.1124 20.9935 15.8903 20.9935 15.6564C20.9935 14.7776 20.2785 14.0627 19.3998 14.0627H18.6463C19.4464 13.7196 20.0083 12.9243 20.0083 12C20.0083 10.763 19.002 9.75666 17.765 9.75666C16.5281 9.75666 15.5217 10.763 15.5217 12C15.5217 12.9243 16.0837 13.7196 16.8838 14.0627H14.3214V5.14983C15.1588 4.96734 15.8196 4.30664 16.002 3.46922H19.528C19.7104 4.30664 20.3712 4.96734 21.2085 5.14983V6.60717C21.2085 6.86602 21.4185 7.07592 21.6773 7.07592C21.9361 7.07592 22.146 6.86602 22.146 6.60717V4.73133C22.146 4.47248 21.9361 4.26258 21.6773 4.26258C20.9813 4.26258 20.4152 3.69638 20.4152 3.00047C20.4152 2.74163 20.2053 2.53172 19.9465 2.53172H15.5835C15.3247 2.53172 15.1148 2.74163 15.1148 3.00047C15.1148 3.69642 14.5486 4.26258 13.8527 4.26258C13.5939 4.26258 13.384 4.47248 13.384 4.73133V14.0627H12.4684V0.938016L23.0619 0.9375V23.0625ZM17.7651 13.3058C17.0451 13.3058 16.4593 12.72 16.4593 12C16.4593 11.28 17.0451 10.6942 17.7651 10.6942C18.4851 10.6942 19.0709 11.28 19.0709 12C19.0709 12.72 18.4852 13.3058 17.7651 13.3058Z"
                                                    fill="black"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3017_12516">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>COD</span>
                                </label>
                                <input type="radio" class="inputTypeCheckout" id="cod" name="method" checked value="cod">
                            </div>
                            <div class="method-detail d-flex justify-content-between align-items-center method-cod">
                                <label for="vn_pay">
                                    <img src="{{ asset('/images/img/icon/vnpay-icon.png') }}" alt=""
                                         style="width: 24px; height: 19px">
                                    <span>{{ __('home.Ví VNPAY') }}</span>
                                </label>
                                <input type="radio" class="inputTypeCheckout" id="vn_pay" name="method" value="vn_pay">
                            </div>
                            <div class="method-detail d-flex justify-content-between align-items-center method-cod">
                                <label for="paypal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         fill="none">
                                        <g clip-path="url(#clip0_3017_12537)">
                                            <path
                                                    d="M20.1043 6.20062C20.1449 5.87039 20.1661 5.53416 20.1661 5.19295C20.1661 2.325 17.8412 0 14.9732 0H6.29465C5.74875 0 5.28267 0.394219 5.19211 0.932531L1.99429 19.9392C1.87954 20.6212 2.40529 21.2427 3.09684 21.2427H6.27079C6.8167 21.2427 7.29154 20.8488 7.38206 20.3104C7.38206 20.3104 7.38736 20.2789 7.39692 20.2221H7.39697L6.95465 22.8511C6.85359 23.4522 7.31695 24 7.92647 24H10.7032C11.1844 24 11.5952 23.6525 11.675 23.178L12.4638 18.4896C12.5998 17.6814 13.2995 17.0896 14.119 17.0896H14.8485C18.8108 17.0896 22.0229 13.8775 22.0229 9.91519C22.0229 8.38195 21.265 7.02666 20.1043 6.20062Z"
                                                    fill="#002987"/>
                                            <path
                                                    d="M20.1029 6.2002C19.6063 10.2398 16.1634 13.3679 11.9895 13.3679H9.56771C9.0211 13.3679 8.54902 13.7319 8.40095 14.2467L6.95335 22.8506C6.85224 23.4517 7.3156 23.9996 7.92512 23.9996H10.7019C11.183 23.9996 11.5938 23.6521 11.6736 23.1776L12.4625 18.4892C12.5985 17.681 13.2982 17.0892 14.1177 17.0892H14.8471C18.8095 17.0892 22.0216 13.8771 22.0216 9.91476C22.0216 8.38152 21.2637 7.02623 20.1029 6.2002Z"
                                                    fill="#0085CC"/>
                                            <path
                                                    d="M9.56916 13.3687H11.991C16.1648 13.3687 19.6078 10.2407 20.1044 6.20112C19.3596 5.67115 18.4495 5.3584 17.4658 5.3584H11.1447C10.425 5.3584 9.81052 5.8781 9.69108 6.58779L8.40234 14.2475C8.55042 13.7328 9.02255 13.3687 9.56916 13.3687Z"
                                                    fill="#00186A"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3017_12537">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>Paypal</span>
                                </label>
                                <input type="radio" class="inputTypeCheckout" id="paypal" name="method" value="paypal">
                            </div>
                            <div class="method-detail d-flex justify-content-between align-items-center method-cod">
                                <label for="apple_pay">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24"
                                         viewBox="0 0 23 24"
                                         fill="none">
                                        <g clip-path="url(#clip0_3017_12545)">
                                            <path
                                                    d="M15.7692 0.613281C15.8222 0.613281 15.8752 0.613281 15.9312 0.613281C16.0612 2.21928 15.4482 3.41928 14.7032 4.28828C13.9722 5.15128 12.9712 5.98828 11.3522 5.86128C11.2442 4.27828 11.8582 3.16728 12.6022 2.30028C13.2922 1.49228 14.5572 0.773281 15.7692 0.613281Z"
                                                    fill="black"/>
                                            <path
                                                    d="M20.6695 17.329C20.6695 17.345 20.6695 17.359 20.6695 17.374C20.2145 18.752 19.5655 19.933 18.7735 21.029C18.0505 22.024 17.1645 23.363 15.5825 23.363C14.2155 23.363 13.3075 22.484 11.9065 22.46C10.4245 22.436 9.60952 23.195 8.25452 23.386C8.09952 23.386 7.94452 23.386 7.79252 23.386C6.79752 23.242 5.99452 22.454 5.40952 21.744C3.68452 19.646 2.35152 16.936 2.10352 13.468C2.10352 13.128 2.10352 12.789 2.10352 12.449C2.20852 9.967 3.41452 7.94899 5.01752 6.97099C5.86352 6.45099 7.02652 6.00799 8.32152 6.20599C8.87651 6.29199 9.44352 6.48199 9.94052 6.66999C10.4115 6.85099 11.0005 7.17199 11.5585 7.15499C11.9365 7.14399 12.3125 6.94699 12.6935 6.80799C13.8095 6.40499 14.9035 5.94299 16.3455 6.15999C18.0785 6.42199 19.3085 7.19199 20.0685 8.37999C18.6025 9.31299 17.4435 10.719 17.6415 13.12C17.8175 15.301 19.0855 16.577 20.6695 17.329Z"
                                                    fill="black"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3017_12545">
                                                <rect width="22.773" height="22.773" fill="white"
                                                      transform="translate(0 0.613281)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span>Apple pay</span>
                                </label>
                                <input type="radio" class="inputTypeCheckout" id="apple_pay" name="method" value="apple_pay">
                            </div>
                            <div class="method-detail d-flex justify-content-between align-items-center method-cod">
                                <label for="master_card">
                                    <img src="{{ asset('/images/img/icon/master-card-icon.png') }}" alt=""
                                         style="width: 24px; height: 24px">
                                    <span>Mastercard</span>
                                </label>
                                <input type="radio" class="inputTypeCheckout" id="master_card" name="method" value="master_card">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 products-package bg-white">
                    <div class="list-product">
                        @foreach($carts as $cart)
                            <div class="product-item d-flex justify-content-between align-items-end">
                                <div class="product-info d-flex align-items-center">
                                    @php
                                        $thumbnail = checkThumbnail($cart->product->thumbnail)
                                    @endphp
                                    <img src="{{ $thumbnail }}" alt="" class="product-image">
                                    <div class="product">
                                        <div class="name">
                                            @if(locationHelper() == 'kr')
                                                {{ ($cart->product->name_ko) }}
                                            @elseif(locationHelper() == 'cn')
                                                {{ ($cart->product->name_zh) }}
                                            @elseif(locationHelper() == 'jp')
                                                {{ ($cart->product->name_ja) }}
                                            @elseif(locationHelper() == 'vi')
                                                {{ ($cart->product->name_vi) }}
                                            @else
                                                {{ ($cart->product->name_en) }}
                                            @endif
                                        </div>
                                        <div class="price">
                                        <span class="real-price">
                                            {{ number_format(convertCurrency('USD', $currency,$cart->price), 0, ',', '.') }} {{$currency}}
                                        </span>
                                            <del>
                                                {{ number_format(convertCurrency('USD', $currency,$cart->product->old_price), 0, ',', '.') }} {{$currency}}
                                            </del>
                                        </div>
                                        <div class="attribute small">
                                            @if($cart->values)
                                                @php
                                                    $value = $cart->values;
                                                    $arrayValue = explode(',', $value);
                                                    $attribute_property = null;
                                                    foreach ($arrayValue as $item){
                                                        $att_pro = explode('-', $item);
                                                        $attribute = \App\Models\Attribute::find($att_pro[0]);
                                                        $property = \App\Models\Properties::find($att_pro[1]);
                                                        if ($attribute && $property){
                                                            if ($attribute_property){
                                                                 $attribute_property = $attribute_property . ', ' . $attribute->name . ': ' . $property->name;
                                                            } else{
                                                                $attribute_property = $attribute->name . ': ' . $property->name;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                {{ $attribute_property }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    x{{$cart->quantity}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="checkout">
                        <div class="price-product d-flex justify-content-between align-items-center">
                            <div class="title">
                                Total product cost
                            </div>
                            <div class="value" id="valueProductCheckout">
                                0
                            </div>
                        </div>
                        <div class="price-ship d-flex justify-content-between align-items-center">
                            <div class="title">
                                Shipping fee
                            </div>
                            <div class="value" id="valueShipCheckout">
                                0
                            </div>
                        </div>
                        <div class="price-discount d-flex justify-content-between align-items-center">
                            <div class="title">
                                Discount fee
                            </div>
                            <div class="value" id="valueDiscountCheckout">
                                0
                            </div>
                        </div>
                        <div class="price-total d-flex justify-content-between align-items-center">
                            <div class="title">
                                Order total
                            </div>
                            <div class="value" id="valueTotalCheckout">
                                0
                            </div>
                        </div>
                        <button type="submit" class="btn btnConfirm">
                            {{ __('home.Confirm') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="d-none">
                <p id="valueCurrency">{{ $currency }}</p>
                <input type="text" name="fullname" id="fullname"
                       value="{{ $address ? $address->username : Auth::user()->name}}">
                <input type="email" name="email" id="email"
                       value="{{ Auth::user()->email}}">
                <input type="text" name="phone" id="phone"
                       value="{{ $address ? $address->phone : Auth::user()->phone}}">
                <input type="text" name="address" id="address"
                       value="{{ $address ? $address->address_detail : Auth::user()->address}}">

                <input type="text" id="total_price" name="total_price" value="0">
                <input type="text" id="shipping_price" name="shipping_price" value="0">
                <input type="text" id="discount_price" name="discount_price" value="0">
                <input type="text" id="price_id" name="priceID" value="0">
                <input type="text" id="voucher_id" name="voucherID" value="0">

                <input type="text" id="discount_price_by_rank" name="discount_price_by_rank"
                       value="{{$totalSaleByRank}}">
                <input value="{{asset('/detail-product')}}" id="url">
                <input type="text" id="voucher_discount_price" value="0">
            </div>
        </form>
    </div>
    <script>
        let currency = $('#valueCurrency').text();
        let urlConvertCurrency = '{{ route('convert.currency', ['total' => ':total']) }}'
        let urlAllCart = '{{ route('member.all.cart') }}';
        let urlProductSale = '{{route('member.product.sales')}}';
        let urlCheckoutByDirect = '{{route('checkout.create.imm')}}';
        let urlCheckoutByVnPay = '{{route('checkout.create.vnpay')}}';
        /* List text show*/
        let textProductPrice = $('#valueProductCheckout');
        let textSalePriceProduct = $('#valueDiscountCheckout');
        let textShipPriceProduct = $('#valueShipCheckout');
        let textCheckoutPriceProduct = $('#valueTotalCheckout');
        /* List ID hidden */
        let inputTotalPriceProduct = $('#total_price');
        let inputShipPriceProduct = $('#shipping_price');
        let inputDiscountPriceProduct = $('#discount_price');
        let inputPriceIdProduct = $('#price_id');

        getVoucher();

        $(document).ready(function () {
            calculationTotalCart();
            $('.inputTypeCheckout').on('click', function () {
                loadActionForm();
            })
        })

        loadActionForm();

        function loadActionForm() {
            if ($('#cod:checked').length > 0) {
                $('#checkout-form').attr('action', urlCheckoutByDirect);
            } else {
                $('#checkout-form').attr('action', urlCheckoutByVnPay);
            }
        }

        async function calculationTotalCart() {
            let results = await getAllCart();
            let total = 0;
            let ship = 0;
            let sales = 0;
            for (let i = 0; i < results.length; i++) {
                total = parseFloat(total) + parseFloat(results[i]['price']) * parseFloat(results[i]['quantity']);
                let productSale = await getProductSale(results[i]['product_id'], results[i]['quantity']);
                if (productSale) {
                    ship = parseFloat(ship) + parseFloat(productSale['ship']);
                }
            }

            inputShipPriceProduct.val(ship);
            inputDiscountPriceProduct.val(sales);
            inputTotalPriceProduct.val(total);
            let checkout = total + ship - sales;
            inputPriceIdProduct.val(checkout);
            /* Convert total product */
            let result = await convertCheckoutCurrency(parseFloat(total));
            let totalText = result + ' ' + currency;
            /* Convert ship price */
            let shipPrice = await convertCheckoutCurrency(parseFloat(ship));
            let shipPriceText = shipPrice + ' ' + currency;
            /* Convert sale price */
            let salePrice = await convertCheckoutCurrency(parseFloat(sales));
            let salePriceText = salePrice + ' ' + currency;
            /* Convert checkout price */
            let checkoutPrice = await convertCheckoutCurrency(parseFloat(checkout));
            let checkoutPriceText = checkoutPrice + ' ' + currency;
            /* Append data */
            textShipPriceProduct.text(shipPriceText)
            // Không có trong design
            textSalePriceProduct.text(salePriceText)

            textCheckoutPriceProduct.text(checkoutPriceText);
            textProductPrice.text(totalText);
        }

        function getVoucher() {
            $('#voucher option').each(function () {
                if ($(this).is(':selected')) {
                    let myArray = this.value.split("-");
                    let arrayProducts = myArray[0].split(",");
                    let arrayPrice = [];
                    for (let i = 0; i < arrayProducts.length; i++) {
                        var url = document.getElementById('url').value;

                        function myfunction(id) {
                            fetch(url + '/' + id, {
                                method: 'GET'
                            })
                                .then(response => {
                                    if (response.status == 200) {

                                        return response.json();
                                    }
                                })
                                .then((response) => {

                                    let price = response['price'];
                                    let pricePercent = price * myArray[1] / 100;
                                    arrayPrice.push(pricePercent)
                                    let totalPriceDiscount = 0;
                                    for (let i = 0; i < arrayPrice.length; i++) {
                                        totalPriceDiscount = parseFloat(totalPriceDiscount) + parseFloat(arrayPrice[i]);
                                    }
                                    let salePrice = document.getElementById('voucher_discount_price');
                                    salePrice.value = totalPriceDiscount;

                                    let voucherID = document.getElementById('voucher_id');
                                    voucherID.value = myArray[2];

                                    getAllTotal();

                                })
                                .catch(error => console.log(error));
                        }

                        myfunction(arrayProducts[i]);
                    }
                }
            })
        }

        async function convertCheckoutCurrency(total) {
            let url = urlConvertCurrency;
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

        async function getAllCart() {
            try {
                let response = await $.ajax({
                    url: urlAllCart,
                    method: 'GET',
                });
                return response;
            } catch (error) {
                throw error;
            }
        }

        async function getProductSale(product, quantity) {
            const requestData = {
                productID: product,
                quantity: quantity,
            };

            try {
                let productSale = await $.ajax({
                    url: urlProductSale,
                    method: 'GET',
                    data: requestData,
                    body: JSON.stringify(requestData),
                })
                return productSale;
            } catch (error) {
                throw error;
            }
        }
    </script>
@endsection
