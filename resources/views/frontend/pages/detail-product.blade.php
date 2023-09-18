@php
    use App\Models\Attribute;use App\Models\Properties;use Illuminate\Support\Facades\Auth;
    (new \App\Http\Controllers\Frontend\HomeController())->createStatisticShopDetail('views', $product->user_id);
     $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
@endphp

@extends('frontend.layouts.master')
@section('title', 'Detail')
@section('content')
    <style>
        .product-content p {
            margin-bottom: 0;
        }

        #mt-body {
            background: white !important;
        }

        .btn-16 {
            margin: 0 16px;
        }

        #myTabContent .tab-pane {
            padding: 20px;
            border: 1px solid #f5f5f5;
        }

        @media only screen and (min-width: 769px) and (max-width: 991px) {
            .tabs-item a {
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 767px) {


            .tabs-item a {
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 767px) {


            .tabs-item a {
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 365px) {


            .tabs-item a {
                font-size: 12px;
            }
        }

        @media not (min-width: 576px ) and (max-width: 991px) {
            .tablet-button {
                display: none;
            }


            .not-tablet-button {
                display: block !important;
            }
        }

        .radio-toolbar input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .radio-toolbar label {
            display: inline-block;
            background-color: #f9f9f9;
            padding: 10px 20px;
            font-family: sans-serif, Arial;
            font-size: 16px;
            border: 2px solid #f7f7f7;
            border-radius: 4px;
        }

        .radio-toolbar label:hover {
            cursor: pointer;
            background-color: #cccccc;
        }

        .radio-toolbar input[type="radio"]:focus + label {
            border: 2px solid #444;
        }

        .radio-toolbar input[type="radio"]:checked + label {
            background-color: #f7f7f7;
            border-color: #ccc;
        }

        .table-title h3 {
            color: #fafafa;
            font-size: 30px;
            font-weight: 400;
            font-style: normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
        }

        .table-fill {
            width: 100%;
        }

        th {
            background: #b1b5bd;
            border-right: 1px solid #343a45;
        }

        th:first-child {
            border-top-left-radius: 3px;
        }

        th:last-child {
            border-top-right-radius: 3px;
            border-right: none;
        }

        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom-: 1px solid #C1C3D1;
            color: #666B85;
            font-size: 16px;
            font-weight: normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }

        tr i {
            color: #fac325;
        }

        tr:first-child {
            border-top: none;
        }

        tr:last-child {
            border-bottom: none;
        }

        td {
            background: #FFFFFF;
            padding: 20px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 18px;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #C1C3D1;
        }

        td:last-child {
            border-right: 0px;
        }

        th.text-left {
            text-align: left;
        }

        td.text-left {
            text-align: left;
        }

        .card-central-logo.ilvietnam-1-1-2 {
            display: flex;
            justify-content: center;
            margin-top: -15px;
        }

        .ability.ilvietnam-1-1-17 {
            margin: 10px 0;
        }

        .company-basicCapacity.ilvietnam-1-1-19 {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            overflow: hidden;
            margin-bottom: 25px;
            text-align: left;
            font-size: 14px;
        }

        .attr-item {
            width: 50%;
            margin-top: 12px;
        }

        .company-productionServiceCapacity.service-2.ilvietnam-1-1-38 {
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            position: relative;
            margin-bottom: 20px;
            border-top: 1px solid #ccc;
        }

        .attr-title.ilvietnam-2-38-39 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            line-height: 16px;
            position: relative;
            margin: 10px 0;
        }

        .attr-item.ilvietnam-2-38-40 {
            width: 100%;
            margin-top: 0;
        }

        .detail-next-btn.detail-next-medium.detail-next-btn-normal.ilvietnam-2-55-56 {
            border: 1px solid #000;
            border-radius: 20px;
            margin-top: 30px;
            display: ruby-text;
            text-align: center;
        }

        .company-profile.ilvietnam-1-1-55 {
            display: flex;
            justify-content: space-between;
        }

        .toggleBtn {
            width: 130px;
            background: #fd6506;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            line-height: 45px;
            font-weight: 600;
            color: white;
            border: none;
        }

        .content {
            max-height: 6em;
            overflow: hidden;
        }
    </style>
    <div class="container-fluid detail">
        <div class="grid second-nav">
            <div class="column-xs-12">
                <nav>
{{--                    {!! getBreadcrumbs('product', $product) !!}--}}
                </nav>
            </div>
        </div>
        @php
            $name = DB::table('users')->where('id', $product->user_id)->first();
            $productDetails = \App\Models\Variation::where('product_id', $product->id)->get();
            $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
        @endphp
        <div class="row product m-0">
            <div class="col-12 col-md-4">
                <div class="product-gallery">
                    <div class="product-image">
                        <img id="productThumbnail" class="active h-100"
                             src="{{ asset('storage/' . $product->thumbnail) }}">
                        <input type="text" id="urlImage" value="{{asset('storage/')}}" hidden="">
                    </div>
                    <ul class="image-list">
                        @php
                            $gallery = $product->gallery;
                            $arrayGallery = explode(',', $gallery);
                        @endphp
                        <li class="image-item"><img src="{{ asset('storage/' . $product->thumbnail) }}"></li>
                        @if(count($arrayGallery)>1)
                            @foreach($arrayGallery as $gallerys)
                                <li class="image-item"><img src="{{ asset('storage/' . $gallerys) }}"></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="column-xs-12 column-md-5">
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <div class="product-name"><a
                                href="{{ route('shop.information.show', $name->id) }}">{{$name->name}}</a></div>
                    <div class="product-title">
                        @if(locationHelper() == 'kr')
                            <div class="item-text">{{ $product->name_ko }}</div>
                        @elseif(locationHelper() == 'cn')
                            <div class="item-text">{{$product->name_zh}}</div>
                        @elseif(locationHelper() == 'jp')
                            <div class="item-text">{{$product->name_ja}}</div>
                        @elseif(locationHelper() == 'vi')
                            <div class="item-text">{{$product->name_vi}}</div>
                        @else
                            <div class="item-text">{{$product->name_en}}</div>
                        @endif</div>
                    <div class="d-flex">
                        <div class="product-origin">{{ __('home.ORIGIN') }}:
                            @php
                                $ld = new \App\Http\Controllers\TranslateController();
                            @endphp
                            {{ $ld->translateText($product->origin, locationPermissionHelper()) }}
                        </div>
                        <div class="card-rating text-left ml-3">
                            @php
                                $ratings = \App\Models\EvaluateProduct::where('product_id', $product->id)->get();
                                $totalRatings = $ratings->count();
                                $totalStars = 0;
                                foreach ($ratings as $rating) {
                                    $totalStars += $rating->star_number;
                                }
                                $averageRating = $totalRatings > 0 ? $totalStars / $totalRatings : 0;
                                $averageRatingsFormatted = number_format($averageRating, 2);
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star" style="color: {{ $i <= $averageRating ? '#fac325' : '#ccc' }}"></i>
                            @endfor

                            <span>{{ $averageRatingsFormatted }} ({{ $totalRatings }})</span>
                        </div>
                        <div class="eyes ml-3"><i class="fa-regular fa-eye"></i>{{$product->views}}{{ __('home.19 customers are viewing this product') }} </div>
                    </div>
                    <div class="column-xs-12 column-md-11 layout-fixed_rm">
                        <div class="main-actions">
                            <form action="">
                                <div class="express-header">
                                    <p>{{ __('home.The minimum order quantity is 2 pair') }} {{$product->min}} {{ __('home.pair') }}</p>
                                    <div class="item-center d-flex justify-content-between">
                                        <span> {{$product->min}} {{ __('home.pair') }}</span>

                                        @if($product->price != null)
                                            <div id="productPrice"
                                                 class="price">{{ __('home.from') }}{{ number_format(convertCurrency('USD', $currency,$product->price * $product->min) , 0, ',', '.')}}{{$currency}}</div>
                                        @else
                                            <strike id="productOldPrice"> {{ __('home.from') }} {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strike>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="product-price d-flex" style="gap: 3rem">
                        @if($product->price != null)
                            <strike class="productOldPrice" id="productOldPrice">({{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}})</strike>
                            <div id="productPrice"
                                 class="price">{{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</div>
                        @else
                            <strike class="productOldPrice" id="productOldPrice">({{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}})</strike>
                        @endif
                    </div>
                    <div class="description-text">
                        @if(locationHelper() == 'kr')
                            <div class="item-text">{!! $product->short_description_ko !!}</div>
                        @elseif(locationHelper() == 'cn')
                            <div class="item-text">{!! $product->short_description_zh !!}</div>
                        @elseif(locationHelper() == 'jp')
                            <div class="item-text">{!! $product->short_description_ja !!}</div>
                        @elseif(locationHelper() == 'vi')
                            <div class="item-text">{!! $product->short_description_vi !!}</div>
                        @else
                            <div class="item-text">{!! $product->short_description_en !!}</div>
                        @endif
                    </div>
                    @if(!$attributes->isEmpty())
                        <div class="row">
                            @foreach($attributes as $attribute)
                                @php
                                    $att = Attribute::find($attribute->attribute_id);
                                    $properties_id = $attribute->value;
                                    $arrayAtt = array();
                                    $arrayAtt = explode(',', $properties_id);
                                @endphp
                                <div class="col-sm-6 col-6 d-flex">
                                    <label>{{($att->{'name' . $langDisplay->getLangDisplay()})}}</label>
                                    <div class="radio-toolbar ml-3">
                                        @foreach($arrayAtt as $data)
                                            @php
                                                $property = Properties::find($data);
                                            @endphp
                                            <input class="inputRadioButton"
                                                   id="input-{{$attribute->attribute_id}}-{{$loop->index+1}}"
                                                   name="inputProperty-{{$attribute->attribute_id}}" type="radio"
                                                   value="{{$attribute->attribute_id}}-{{$property->id}}">
                                            <label for="input-{{$attribute->attribute_id}}-{{$loop->index+1}}">
                                                @php
                                                    $ld = new \App\Http\Controllers\TranslateController();
                                                @endphp
                                                {{ $ld->translateText($property->name, locationPermissionHelper()) }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
{{--                        <a id="resetSelect" class="btn btn-dark mt-3 "--}}
{{--                           style="color: white">{{ __('home.Reset select') }}</a>--}}
                    @endif
                    <div class="">
                        <input id="product_id" hidden value="{{$product->id}}">
                        <input name="price" id="price" hidden value="{{$product->price}}">
                        @if(count($productDetails)>0)
                            <input name="variable" id="variable" hidden value="{{$productDetails[0]->variation}}">
                        @endif

                    </div>
{{--                    <div class="count__wrapper count__wrapper--ml mt-3">--}}
{{--                        <label for="qty">{{ __('home.remaining') }}<span--}}
{{--                                    id="productQuantity">{{$product->qty}}</span></label>--}}
{{--                    </div><!-- Button to trigger modal -->--}}
                    <!-- Button trigger modal -->
                    @php
                        $price_sales = \App\Models\ProductSale::where('product_id', '=', $product->id)->get();
                    @endphp
{{--                    @if($price_sales)--}}
{{--                        <a class="p-2 btn-light" style="cursor: pointer" data-toggle="modal" data-target="#priceList">--}}
{{--                            {{ __('home.Wholesale price list') }}--}}
{{--                        </a>--}}
{{--                    @endif--}}
                    <!-- Modal -->
                    <div class="modal fade" id="priceList" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Price list') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table-fill">
                                        <thead>
                                        <tr>
                                            <th class="text-left">{{ __('home.Month') }}</th>
                                            <th class="text-left">{{ __('home.sales') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="table-hover">
                                        @php
                                            $price_sales = \App\Models\ProductSale::where('product_id', '=', $product->id)->get();
                                        @endphp
                                        @if(!$price_sales->isEmpty())
                                            @foreach($price_sales as $price_sale)
                                                <tr>
                                                    <td class="text-left">{{$price_sale->quantity}}</td>
                                                    <td class="text-left">-{{$price_sale->sales}} %</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex buy">
                        <div>
                            <input min="{{$product->min}}" value="{{$product->min}}" type="number" class="input"
                                   name="quantity">
                            <div class="spinner">
                                <button type="button" class="up button">&rsaquo;</button>
                                <button type="button" class="down button">&lsaquo;</button>
                            </div>
                        </div>
                        @if(!$attributes->isEmpty())
                            <button type="submit" id="btnAddCard"
                                    class="add-to-cart">{{ __('home.Add To Cart') }}</button>
                        @else
                            <button type="submit" class="add-to-cart">{{ __('home.Add To Cart') }}</button>
                        @endif
                        <button class="share"><i class="fa-regular fa-heart"></i></button>
                        <button class="share"><i class="fa-solid fa-share-nodes"></i></button>
                    </div>
                </form>
            </div>
            <div class="column-xs-12 column-md-3 layout-fixed">
                <div class="main-actions">
                    <form action="">
                        <div class="express-header">
                            <p>{{ __('home.The minimum order quantity is 2 pair') }} {{$product->min}} {{ __('home.pair') }}</p>
                            <div class="item-center d-flex justify-content-between">
                                <span> {{$product->min}} {{ __('home.pair') }}</span>
                                @if($product->price != null)
                                    <div id="productPrice"
                                         class="price">{{ __('home.from') }} {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</div>
                                @else
                                    <strike id="productOldPrice"> {{ __('home.from') }} {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strike>
                                @endif
                            </div>
                            <p class="">{{ __('home.Lead time') }} 15 {{ __('home.day') }} <i
                                        class="fa-solid fa-info"></i></p>
                        </div>
                        <div class="express-body">
                            <div class="item-center d-flex justify-content-between">
                                <span>{{ __('home.shipping') }}</span>
                                @if($product->price != null)
                                    <div id="productPrice"
                                         class="price">{{ __('home.from') }} {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</div>
                                @else
                                    <strike id="productOldPrice"> {{ __('home.from') }} {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strike>
                                @endif
                            </div>
                            <div>
                                <p class="">{{ __('home.Lead time') }} 15 {{ __('home.day') }} <i
                                            class="fa-solid fa-info"></i></p>
                            </div>
                        </div>
                        <div class="express-footer">
{{--                            <a href="#">--}}
{{--                                <div class="button-start">{{ __('home.Start orde') }}</div>--}}
{{--                            </a>--}}
                            <a href="{{ route('shop.information.show', $name->id) }}">
                                <div class="button-call"><i
                                            class="fa-solid fa-envelope"></i> {{ __('home.Contact supplier') }}</div>
                            </a>
                            <a href="{{ route('chat.message.show', $name->name) }}">
                                <div class="button-call"><i class="fa-solid fa-phone"></i> {{ __('home.Call us') }}
                                </div>
                            </a>

                        </div>
                    </form>
                </div>
                @php
                    $shopInformation = \App\Models\ShopInfo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first()
                @endphp
                @if($shopInformation)
                <div class="detail-module">
                    <form action="">
                        <div class="widget-supplier-card company-card-integrated company-card-integrated-lite has-ta origin gps-background ilvietnam-0-0-1 snipcss-Kyhj9 style-v8cHz"
                             data-role="widget-supplier-card" data-aui="supplier-card" id="style-v8cHz">
                            <div class="card-central-logo ilvietnam-1-1-2">
                                <a href="" target="_blank" data-aui="ta-ordered"
                                   rel="nofollow" class="ilvietnam-2-2-3">
                                    <img src="https://img.alicdn.com/imgextra/i1/O1CN01AOhmtZ1HQ08UWY7sf_!!6000000000751-2-tps-266-54.png_240x240.jpg"
                                         class="ilvietnam-3-3-4 style-q27At" id="style-q27At">
                                </a>
                            </div>
                            <div class="company-name-container ilvietnam-1-1-5">
                                <a class="company-name company-name-lite-vb ilvietnam-2-5-6"
                                   href="{{ route('shop.information.show', $name->id) }}"
                                   target="_blank" title="Tên công ty"
                                   data-aui="company-name" data-domdot="id:3317">
                                    {{$name->name}}
                                </a>
                            </div>
                            <div class="company-brand ilvietnam-1-1-7">
                                <span class="ilvietnam-2-7-8">
                                    {{ __('home.Producer') }} {{$shopInformation->product_name}}
                                </span>
                            </div>
                            <div class="card-supplier card-icons-lite ilvietnam-1-1-9">
                                <span class="company-name-country ilvietnam-2-9-10">
                                    <i class="icbu-icon-flag icbu-icon-flag-cn ilvietnam-3-10-11">

                                    </i>
                                    <span class="register-country ilvietnam-3-10-12">
                                       {{$shopInformation->country}}
                                    </span>
                                </span>
                                <a class="verify-info ilvietnam-2-9-13" data-aui="ggs-icon" rel="nofollow">
                                    <span class="join-year ilvietnam-3-13-14">
                                        <span class="value ilvietnam-4-14-15">{{$shopInformation->industry_year}}
                                        </span>
                                        <span class="unit ilvietnam-4-14-16">
                                            YRS
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div class="ability ilvietnam-1-1-17">
                                <img src="https://img.alicdn.com/imgextra/i3/O1CN015NySK71aBmY1PTG9K_!!6000000003292-2-tps-28-28.png"
                                     class="ilvietnam-2-17-18">
                                {{ __('home.Registered Trademark') }} (1)
                            </div>
                            <div class="company-basicCapacity ilvietnam-1-1-19">
                                <a href=""
                                   class="attr-item ilvietnam-2-19-20" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-20-21">
                                        {{ __('home.Store Rating') }}
                                    </div>
                                    <div class="attr-content ilvietnam-3-20-22" title="4,7(21)">
                                        @php
                                            $userId = $name->id;
                                            $evaluates = DB::table('evaluate_products')
                                                ->join('products', 'products.id', '=', 'evaluate_products.product_id')
                                                ->where('products.user_id', $userId)
                                                ->select('evaluate_products.star_number')
                                                ->get();
                                            $totalRating = $evaluates->count();
                                            $totalStars = 0;
                                            foreach ($evaluates as $evaluate) {
                                                $totalStars += $evaluate->star_number;
                                            }
                                            $averageRatings = $totalRating > 0 ? $totalStars / $totalRating : 0;
                                            $averageRatingsFormatted = number_format($averageRatings, 2);
                                        @endphp
                                        {{ $averageRatingsFormatted }} ({{ $totalRating }})

                                    </div>
                                </a>
                                <div class="attr-item ilvietnam-2-19-23" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-23-24">
                                        {{ __('home.On-time delivery rate') }}
                                    </div>
                                    <div class="attr-content ilvietnam-3-23-25" title="95,6%">
                                        95,6%
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-26" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-26-27">
                                        {{ __('home.Response time') }}
                                    </div>
                                    <div class="attr-content ilvietnam-3-26-28" title="≤3h">
                                        ≤3h
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-29" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-29-30">
                                        {{ __('home.Online revenue') }}
                                    </div>
                                    <div class="attr-content ilvietnam-3-29-31" title="$480,000+">
                                        ${{$shopInformation->annual_output}}+
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-32" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-32-33">
                                        {{ __('home.Floor space') }}
                                    </div>
                                    <div class="attr-content ilvietnam-3-32-34" title="1000m²">
                                        {{$shopInformation->acreage}}m²
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-35" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-35-36">
                                        {{ __('home.Staff') }}
                                    </div>
                                    <div class="attr-content ilvietnam-3-35-37" title="14">
                                        {{$shopInformation->inspection_staff}}
                                    </div>
                                </div>
                            </div>
                            <div class="company-productionServiceCapacity service-2 ilvietnam-1-1-38">
                                <div class="attr-title ilvietnam-2-38-39">
                                    {{ __('home.Service') }}
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-40-41" title="tùy chỉnh nhỏ">
                                        {{ __('home.Small customization') }}
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-42-43" title="Tùy chỉnh dựa trên thiết kế">
                                        {{ __('home.Customization based on design') }}
                                    </div>
                                </div>
                            </div>
                            <div class="company-productionServiceCapacity service-2 ilvietnam-1-1-38">
                                <div class="attr-title ilvietnam-2-38-39">
                                    {{ __('home.Quality control') }}
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-40-41"
                                         title="Nhận dạng truy xuất nguồn gốc nguyên liệu">
                                        {{ __('home.Identification of traceability of raw materials') }}
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-42-43" title="Kiểm tra thành phẩm">
                                        {{ __('home.Finished product inspection') }}
                                    </div>
                                </div>
                            </div>
                            <div class="attr-title ilvietnam-2-38-39">{{ __('home.Certificate') }}
                            </div>
                            <a href="{{ route('shop.information.show', $name->id) }}"
                               class="company-qualificationCertificate service-4 ilvietnam-1-1-50">
                                <div class="attr-item ilvietnam-2-50-53" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-53-54">
                                        {{ __('home.Certificate') }}
                                    </div>
                                </div>
                            </a>
                            <div class="company-profile ilvietnam-1-1-55">
                                <a href="{{ route('shop.information.show', $name->id) }}"
                                   class="detail-next-btn detail-next-medium detail-next-btn-normal ilvietnam-2-55-56 attr-item">
                                    <span class="detail-next-btn-helper ilvietnam-3-56-57">
                                       {{ __('home.company profile') }}
                                    </span>
                                </a>
                                <a href="{{ route('shop.information.show', $name->id) }}"
                                   class="detail-next-btn detail-next-medium detail-next-btn-normal ilvietnam-2-55-56 attr-item">
                                    <span class="detail-next-btn-helper ilvietnam-3-58-59">
                                        {{ __('home.Visit the store') }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="productView-description">
        <ul class="nav nav-tabs container-fluid pt-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
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
        <div class="tab-content container-fluid" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="content" id="content1">
                    @if(locationHelper() == 'kr')
                        <div class="item-text">{!! $product->description_ko !!}</div>
                    @elseif(locationHelper() == 'cn')
                        <div class="item-text">{!! $product->description_zh !!}</div>
                    @elseif(locationHelper() == 'jp')
                        <div class="item-text">{!! $product->description_ja !!}</div>
                    @elseif(locationHelper() == 'vi')
                        <div class="item-text">{!! $product->description_vi !!}</div>
                    @else
                        <div class="item-text">{!! $product->description_en !!}</div>
                    @endif
                    {{--                    {!! $product->description!!}--}}
                </div>
                <button id="toggleBtn1" class="toggleBtn"
                        onclick="toggleContent('content1', 'toggleBtn1')">{{ __('home.Show More') }}</button>
            </div>
            @php
                $infos = DB::table('shop_infos')->first();
                $user = DB::table('users')->first();
            @endphp
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @php
                    $shopInformation = \App\Models\ShopInfo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first()
                @endphp

                <div class="content" id="content2">@include('frontend.pages.shop-information.tabs_shop_info')</div>
                <button id="toggleBtn2" class="toggleBtn"
                        onclick="toggleContent('content2', 'toggleBtn2')">{{ __('home.Show More') }}</button>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="mb-4">
                    <div class="">{{ __('home.write a read') }}</div>
                    @php
                        if (Auth::check()){
                            $isMember = \App\Models\MemberRegisterPersonSource::where([
                                ['email', Auth::user()->email],
                                ['status', \App\Enums\MemberRegisterPersonSourceStatus::ACTIVE]
                            ])->first();

                            if (!$isMember){
                                $isMember = \App\Models\MemberRegisterInfo::where('user_id', Auth::user()->id);
                            }
                        }
                    @endphp
                    @if($isMember)
                        <form method="post" action="{{route('create.evaluate')}}">
                            @csrf
                            <input type="text" class="form-control" id="product_id" name="product_id"
                                   value="{{$product->id}}" hidden/>
                            <div class="rating">
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
                            <div id="text-message" class="text-danger d-none">{{ __('home.Please select star rating') }}
                            </div>

                            <div class="form-group row">
                                <label for=""
                                       class="col-sm-12 col-form-label">{{ __('home.your name') }}</label>
                                <div class="col-sm-12">
                                    <input onclick="checkStar()" type="text" class="form-control" id=""
                                           name="username"
                                           placeholder="{{ __('home.your name') }}" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for=""
                                       class="col-sm-12 col-form-label">{{ __('home.your review') }}</label>
                                <div class="col-sm-12">
                                    <textarea onclick="checkStar()" class="form-control" id=""
                                              name="content"
                                              placeholder="{{ __('home.your review') }}"
                                              rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button id="btn-submit" class="btn btn-primary btn-16" type="submit">
                                    {{ __('home.submit') }}
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">{{ __('home.write a review') }}</div>
                        @foreach($result as $res)
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>
                                        <strong>{{$res->username}}</strong>
                                    </td>
                                    @if($res->user_id == Auth::user()->id)
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit-comment" onclick="getCommentById({{ $res->id }})">
                                                {{ __('home.edit-comment') }}
                                            </button>
                                        </td>
                                    @endif

                                </tr>
                                <tr>
                                    <td>
                                        <p>{{$res->content}}</p>
                                        <p class="m-0">{{$res->created_at}}</p>
                                    </td>
                                </tr>
                                @if($res->status == \App\Enums\EvaluateProductStatus::PENDING)
                                    <tr>
                                        <td>
                                            <p class="text-danger">{{ __('home.wait a review') }}</p>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>
                                        <strong class="mr-2">{{ __('home.customer rating') }}: </strong>
                                        @if($res->star_number == 1)
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                        @endif
                                        @if($res->star_number == 2)
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                        @endif
                                        @if($res->star_number == 3)
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                        @endif
                                        @if($res->star_number == 4)
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star-o"></i></span>
                                        @endif
                                        @if($res->star_number == 5)
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                            <span class="fa fa-stack">
                                                    <i class="fa fa-star"></i></span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
    <section class="section-Fifth section pt-3 pb-3 container-fluid">
        <div class="content">{{ __('home.Customers Also Viewed') }}</div>
        <div class="swiper HotDeal">
            <div class="swiper-wrapper">
                @php
                    $products = \App\Models\Product::where([['location','=','vi'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                @endphp
                @foreach($products as $product)
                    <div class="swiper-slide" style="background: #f5f5f5">
                        @include('frontend.pages.list-product')
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    @include('frontend.pages.modal-products')

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
                               value="{{$product->id}}" hidden/>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
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
            console.log(result.join(','));
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
                .catch(error => console.log(error));
        }

        checkBtn();
    </script>
    <script>
        document.body.className += "js";

        var spinner = document.querySelector('.input');
        var buttonUp = document.querySelector('.up');
        var buttonDown = document.querySelector('.down');

        buttonUp.onclick = function () {
            var value = parseInt(spinner.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            spinner.value = value;
        };

        buttonDown.onclick = function () {
            var value = parseInt(spinner.value, 10);
            value = isNaN(value) ? 0 : value;
            value--;
            spinner.value = value;
        };
    </script>
    <script>
        function zoom(e) {
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX / zoomer.offsetWidth * 100
            y = offsetY / zoomer.offsetHeight * 100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }
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
                url: '/vouchers-item',
                method: 'POST',
                data: {
                    'voucher_id': id,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response)
                    if (response == "Error") {
                        alert('Voucher đã có sẵn trong giỏ hàng rồi! Sử dụng thôi!')
                    } else {
                        alert("Nhận voucher thành công")
                    }
                },
                error: function (exception) {
                    console.log(exception)
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
            if (input.value === 0) {
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
            console.log(input.value)
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
            console.log(tabs.length)
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
        function getPercent() {
            let defaultPrice = document.getElementById('priceDefault');
            let discountPrice = document.getElementById('priceDiscount');
            let percentPrice = document.getElementById('percentDiscount');
            let percent = 100 - (parseFloat(discountPrice.innerText) / parseFloat(defaultPrice.innerText)) * 100;
            percent = parseFloat(percent).toFixed(1);
            percentPrice.innerText = percent + '%'
        }

        getPercent();

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
@endsection

