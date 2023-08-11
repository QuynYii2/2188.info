@php
    use App\Models\Attribute;
    use App\Models\VoucherItem;
    use App\Models\Properties;use Illuminate\Support\Facades\Auth;

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

        .btn-16 {
            margin: 0 16px;
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
            font-style:normal;
            font-family: "Roboto", helvetica, arial, sans-serif;
            text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
        }
        .modal-content{
            width: 400px;
            margin: auto;
        }
        .table-fill{
            width: 100%;
        }
        th {
            background: #b1b5bd;
            border-right: 1px solid #343a45;
        }
        th:first-child {
                border-top-left-radius:3px;
        }

        th:last-child {
                border-top-right-radius:3px;
                border-right:none;
        }

        tr {
            border-top: 1px solid #C1C3D1;
            border-bottom-: 1px solid #C1C3D1;
                color:#666B85;
                font-size:16px;
                font-weight:normal;
            text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
        }
        tr:first-child {
                border-top:none;
        }

        tr:last-child {
                border-bottom:none;
        }

        td {
                background:#FFFFFF;
                padding:20px;
                text-align:left;
                vertical-align:middle;
                font-weight:300;
                font-size:18px;
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

            display:flex ;
            justify-content: center;
            margin-top: -15px;
        }

        .ability.ilvietnam-1-1-17 {
            margin-top: 15px;
            margin-bottom: 15px;
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
            margin-bottom: 15px;
            position: relative;
            margin-top: 25px;
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
        #myButton {
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
    </style>
    <div class="container-fluid detail">
        <div class="grid second-nav">
            <div class="column-xs-12">
                <nav>
                    <ol class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('home.Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('home.Household Plants') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('home.Bonsai') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <?php

        ?>
        @php
            $name = DB::table('users')->where('id', $product->user_id)->first();
            $productDetails = \App\Models\Variation::where('product_id', $product->id)->get();
            $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
        @endphp
        <div class="grid product">
            <div class="column-xs-12 column-md-4">
                <div class="product-gallery">
                    <div class="product-image">
                        <img id="productThumbnail" class="active"
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
                    <div class="product-name"><a href="{{ route('shop.information.show', $name->id) }}">{{$name->name}}</a></div>
                    <div class="product-title">{{($product->name)}}</div>
                    <div class="product-origin">Xuất xứ: {{$product->origin}}</div>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>4.7(21)</span>
                    </div>
                    <div class="product-price d-flex" style="gap: 3rem">
                        @if($product->price != null)
                            <div id="productPrice" class="price">${{$product->price}}</div>
                            <strike id="productOldPrice">${{$product->old_price}}</strike>
                        @else
                            <strike id="productOldPrice">${{$product->price}}</strike>
                        @endif
                    </div>
                    <div class="description-text">
                        {!! $product->short_description!!}
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
                                <div class="col-sm-6 col-6">
                                    <label>{{($att->{'name' . $langDisplay->getLangDisplay()})}}</label>
                                    <div class="radio-toolbar mt-3">
                                        @foreach($arrayAtt as $data)
                                            @php
                                                $property = Properties::find($data);
                                            @endphp
                                            <input class="inputRadioButton"
                                                   id="input-{{$attribute->attribute_id}}-{{$loop->index+1}}"
                                                   name="inputProperty-{{$attribute->attribute_id}}" type="radio"
                                                   value="{{$attribute->attribute_id}}-{{$property->id}}">
                                            <label for="input-{{$attribute->attribute_id}}-{{$loop->index+1}}">{{$property->name}}</label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a id="resetSelect" class="btn btn-dark mt-3 " style="color: white"> Reset select</a>
                    @endif
                    <div class="">
                        <input id="product_id" hidden value="{{$product->id}}">
                        @if(count($productDetails)>0)
                            <input name="variable" id="variable" hidden value="{{$productDetails[0]->variation}}">
                        @endif

                    </div>
                    <div class="count__wrapper count__wrapper--ml mt-3">
                        <label for="qty">{{ __('home.remaining') }}<span id="productQuantity">{{$product->qty}}</span></label>
                    </div><!-- Button to trigger modal -->
                    <!-- Button trigger modal -->
                    @php
                        $price_sales = \App\Models\ProductSale::where('product_id', '=', $product->id)->get();
                    @endphp
                    <a class="p-2 btn-light" style="cursor: pointer" data-toggle="modal" data-target="#exampleModal">
                        Bảng giá sỉ
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bảng giá</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table-fill">
                                        <thead>
                                        <tr>
                                            <th class="text-left">Month</th>
                                            <th class="text-left">Sales</th>
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
                    <div class="d-flex buy justify-content-around">
                        <div>
                            <input min="{{$product->min}}" value="{{$product->min}}" type="number" class="input"
                                   name="quantity">
                            <div class="spinner">
                                <button type="button" class="up button">&rsaquo;</button>
                                <button type="button" class="down button">&lsaquo;</button>
                            </div>
                        </div>
                        @if(!$attributes->isEmpty())
                            <button type="submit" id="btnAddCard" class="add-to-cart">{{ __('home.Add To Cart') }}</button>
                        @else
                            <button type="submit" class="add-to-cart">{{ __('home.Add To Cart') }}</button>
                        @endif
                        <button class="share"><i class="fa-regular fa-heart"></i></button>
                        <button class="share"><i class="fa-solid fa-share-nodes"></i></button>
                    </div>
                    <div class="eyes"><i class="fa-regular fa-eye"></i> 19 customers are viewing this product</div>
                </form>
            </div>
            <div class="column-xs-12 column-md-3 layout-fixed">
                <div class="main-actions">
                    <form action="">
                        <div class="express-header">
                            <p>The minimum order quantity is 2 pair</p>
                            <div class="item-center d-flex justify-content-between">
                                <span>0/2 pair</span>
                                <span>from <b>$12.98$</b></span>
                            </div>
                            <p class="">Lead time 15 days <i class="fa-solid fa-info"></i></p>
                        </div>
                        <div class="express-body">
                            <div class="item-center d-flex justify-content-between">
                                <span>Shipping</span>
                                <span>from <b>$12.98$</b></span>
                            </div>
                            <div>
                                <p class="">Lead time 15 days <i class="fa-solid fa-info"></i></p>
                            </div>
                        </div>
                        <div class="express-footer">
                            <a href="#">
                                <div class="button-start">Start order</div>
                            </a>
                            <a href="#">
                                <div class="button-call"><i class="fa-solid fa-envelope"></i> Contact supplier</div>
                            </a>
                            <a href="#">
                                <div class="button-call"><i class="fa-solid fa-phone"></i> Call us</div>
                            </a>

                        </div>
                    </form>
                </div>
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
                                    nhà sản xuất
                                </span>
                            </div>
                            <div class="card-supplier card-icons-lite ilvietnam-1-1-9">
                                <span class="company-name-country ilvietnam-2-9-10">
                                    <i class="icbu-icon-flag icbu-icon-flag-cn ilvietnam-3-10-11">

                                    </i>
                                    <span class="register-country ilvietnam-3-10-12">
                                        CN

                                    </span>
                                </span>
                                <a class="verify-info ilvietnam-2-9-13" data-aui="ggs-icon" rel="nofollow">
                                    <span class="join-year ilvietnam-3-13-14">
                                        <span class="value ilvietnam-4-14-15">&nbsp;&nbsp;&nbsp;14
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
                                        Nhãn hiệu đã đăng ký (1)
                            </div>
                            <div class="company-basicCapacity ilvietnam-1-1-19">
                                <a href=""
                                   class="attr-item ilvietnam-2-19-20" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-20-21">
                                                xếp hạng cửa hàng
                                    </div>
                                    <div class="attr-content ilvietnam-3-20-22" title="4,7(21)">
                                                4,7(21)
                                    </div>
                                </a>
                                <div class="attr-item ilvietnam-2-19-23" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-23-24">
                                                Tỷ lệ giao hàng đúng hạn
                                    </div>
                                    <div class="attr-content ilvietnam-3-23-25" title="95,6%">
                                                95,6%
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-26" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-26-27">
                                                Thời gian đáp ứng
                                    </div>
                                    <div class="attr-content ilvietnam-3-26-28" title="≤3h">
                                                ≤3h
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-29" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-29-30">
                                                doanh thu trực tuyến
                                    </div>
                                    <div class="attr-content ilvietnam-3-29-31" title="$480,000+">
                                                $480,000+
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-32" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-32-33">
                                                Không gian sàn
                                    </div>
                                    <div class="attr-content ilvietnam-3-32-34" title="1000m²">
                                                1000m²
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-19-35" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-title ilvietnam-3-35-36">
                                                Nhân viên
                                    </div>
                                    <div class="attr-content ilvietnam-3-35-37" title="14">
                                                14
                                    </div>
                                </div>
                            </div>
                            <div class="company-productionServiceCapacity service-2 ilvietnam-1-1-38">
                                <div class="attr-title ilvietnam-2-38-39">
                                            Dịch vụ
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-40-41" title="tùy chỉnh nhỏ">
                                                tùy chỉnh nhỏ
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-42-43" title="Tùy chỉnh dựa trên thiết kế">
                                                Tùy chỉnh dựa trên thiết kế
                                    </div>
                                </div>
                            </div>
                            <div class="company-productionServiceCapacity service-2 ilvietnam-1-1-38">
                                <div class="attr-title ilvietnam-2-38-39">
                                            kiểm soát chất lượng
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-40-41"
                                         title="Nhận dạng truy xuất nguồn gốc nguyên liệu">
                                                Nhận dạng truy xuất nguồn gốc nguyên liệu
                                    </div>
                                </div>
                                <div class="attr-item ilvietnam-2-38-40" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-42-43" title="Kiểm tra thành phẩm">
                                                Kiểm tra thành phẩm
                                    </div>
                                </div>
                            </div>
                            <div class="attr-title ilvietnam-2-38-39">
                                Chứng chỉ
                            </div>
                            <a href="{{ route('shop.information.show', $name->id) }}"
                               class="company-qualificationCertificate service-4 ilvietnam-1-1-50">
                                <div class="attr-item ilvietnam-2-50-53" aria-haspopup="true" aria-expanded="false">
                                    <div class="attr-content ilvietnam-3-53-54">
                                                giấy chứng nhận
                                    </div>
                                </div>
                            </a>
                            <div class="company-profile ilvietnam-1-1-55">
                                <a href="{{ route('shop.information.show', $name->id) }}"
                                   class="detail-next-btn detail-next-medium detail-next-btn-normal ilvietnam-2-55-56 attr-item">
                                    <span class="detail-next-btn-helper ilvietnam-3-56-57">
                                       Hồ sơ công ty
                                    </span>
                                </a>
                                <a href="{{ route('shop.information.show', $name->id) }}"
                                   class="detail-next-btn detail-next-medium detail-next-btn-normal ilvietnam-2-55-56 attr-item">
                                    <span class="detail-next-btn-helper ilvietnam-3-58-59">
                                                Ghé thăm cửa hàng
                                    </span>
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
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
                {!! $product->description!!}
            </div>
            @php
                $infos = DB::table('shop_infos')->first();
                $user = DB::table('users')->first();
            @endphp
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @php
                    $shopInformation = \App\Models\ShopInfo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->first()
                @endphp
{{--                @if(!$shopInformation)--}}
                <p id="less">
                <div class="title-information">
                    <div class="title-information-container">Hồ sơ</div>
                    <div class="title-information-download">
                        <a href="">Tải xuống báo cáo</a></div>
                </div>
                <dl>
                    <dt>
                        <span>Tổng quan</span>
                    </dt>
                    <dd>
                        <div>
                            <div>
                                <span>Ngày đăng ký công ty</span>
                                <strong>{{ \Carbon\Carbon::parse($shopInformation->created_at)->format('d/m/Y') }}</strong>
                            </div>
                            <div>
                                <span>Diện tích sàn(㎡)</span>
                                <strong>{{$shopInformation->acreage}}</strong>
                            </div>
                            <div>
                                <span>Doanh thu xuất khẩu hàng năm (USD)</span>
                                <strong>1644968</strong>
                            </div>
                            <div>
                                <span>Ngôn ngữ được chấp nhận</span>
                                <strong>{{$shopInformation->country}}</strong>
                            </div>
                            <div>
                                <span>Năm xuất khẩu</span>
                                <strong>{{$shopInformation->industry_year}}</strong>
                            </div>
                            <div>
                                <span>Năm trong ngành</span>
                                <strong>{{$shopInformation->industry_year}}</strong>
                            </div>
                        </div>
                    </dd></p>
                </dl>
                <div id="more" style="display: none;">@include('frontend.pages.shop-information.tabs_shop_info')</div>
                <button onclick="myFunctionDetail()" id="myButton">{{ __('home.Show More') }}</button>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="card mb-4">
                    <div class="card-body">
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
                                <input type="radio" name="star_number" id="star5" value="5" hidden="">
                                <label for="star5" onclick="starCheck(5)"><i id="icon-star-5"
                                                                             class="fa fa-star"></i></label>
                            </div>
                            <input id="input-star" value="0" hidden="">
                            <div id="text-message" class="text-danger d-none">Please select star rating
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
                                    Submit
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">{{ __('home.write a review') }}</div>
                        @foreach($result as $res)
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td colspan="2">
                                        <strong>{{$res->username}}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p>{{$res->content}}</p>
                                        <p class="m-0">{{$res->created_at}}</p>
                                    </td>
                                </tr>
                                @if($res->status == \App\Enums\EvaluateProductStatus::PENDING)
                                    <tr>
                                        <td colspan="2">
                                            <p class="text-danger">{{ __('home.wait a review') }}</p>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="2">
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
    <section class="section-Fifth section pt-3 pb-3 container-fluid">
        <div class="content">{{ __('home.Related Products') }}</div>
        <div class="swiper HotDeals">
            <div class="swiper-wrapper">
                @php
                    $products = DB::table('products')->where('category_id', $product->category_id)->get();
                    $products = $products->unique('slug');
                @endphp
                @foreach($products as $product)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                @php
                                    $thumbnail = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="">
                                <div class="button-view">
                                    <button>{{ __('home.Quick view') }}</button>
                                </div>
                                <div class="text">
                                    <div class="text-sale">
                                        Hot
                                    </div>
                                </div>
                            </div>
                            <div class="item-body">
                                <div class="card-rating">
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <span>(1)</span>
                                </div>
                                @php
                                    $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                @endphp
                                <div class="card-brand">
                                    {{$nameUser->name}}
                                </div>
                                <div class="card-title">
                                    <a href="{{route('detail_product.show', $product->id)}}">{{($product->name)}}</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    @if($product->price != null)
                                        <div class="price-sale">
                                            <strong>${{$product->price}}</strong>
                                        </div>
                                        <div class="price-cost">
                                            <strike>${{$product->old_price}}</strike>
                                        </div>
                                    @else
                                        <div class="price-sale">
                                            <strong>${{$product->old_price}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        @if(Auth::check())
                                            <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                        @else
                                            <a class="check_url">{{ __('home.Choose Options') }}</a>
                                        @endif
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
    <section class="section-Fifth section pt-3 pb-3 container-fluid">
        <div class="content">{{ __('home.Customers Also Viewed') }}</div>
        <div class="swiper HotDeals">
            <div class="swiper-wrapper">
                @php
                    $products = DB::table('products')->get();
                    $products = $products->unique('slug');
                @endphp
                @foreach($products as $product)
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                @php
                                    $thum = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="">
                                <div class="button-view">
                                    <button>{{ __('home.Quick view') }}</button>
                                </div>
                                <div class="text">
                                    <div class="text-sale">
                                        Hot
                                    </div>
                                    {{--                                            <div class="text-new">--}}
                                    {{--                                                New--}}
                                    {{--                                            </div>--}}
                                    <!-- <div class="text-bundle">
                                                Bundle
                                            </div> -->
                                </div>
                            </div>
                            <div class="item-body">
                                <div class="card-rating">
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <span>(1)</span>
                                </div>
                                @php
                                    $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                @endphp
                                <div class="card-brand">
                                    {{$nameUser->name}}
                                </div>
                                <div class="card-title">
                                    <a href="{{route('detail_product.show', $product->id)}}">{{($product->name)}}</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    @if($product->price != null)
                                        <div class="price-sale">
                                            <strong>${{$product->price}}</strong>
                                        </div>
                                        <div class="price-cost">
                                            <strike>${{$product->old_price}}</strike>
                                        </div>
                                    @else
                                        <div class="price-sale">
                                            <strong>${{$product->old_price}}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        @if(Auth::check())
                                            <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                        @else
                                            <a class="check_url">{{ __('home.Choose Options') }}</a>
                                        @endif
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
{{--  Show more  --}}
    <script>
        function myFunctionDetail() {
            var dots = document.getElementById("less");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myButton");

            if (moreText.style.display === "none") {
                dots.style.display = "none";
                btnText.innerHTML = "{{__('home.Show Less') }}";
                moreText.style.display = "block";
            } else {
                dots.style.display = "inline";
                btnText.innerHTML = "{{__('home.Show More') }}";
                moreText.style.display = "none";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
            if (input.value == 0) {
                message.classList.remove("d-none");
                btn.disabled = true;
            } else {
                message.classList.add("d-none");
                btn.disabled = false;
            }
        }


        function starCheck(value) {
            let star1 = document.getElementById('star1');
            let star2 = document.getElementById('star2');
            let star3 = document.getElementById('star3');
            let star4 = document.getElementById('star4');
            let star5 = document.getElementById('star5');
            let input = document.getElementById('input-star');
//
            let icon1 = document.getElementById('icon-star-1');
            let icon2 = document.getElementById('icon-star-2');
            let icon3 = document.getElementById('icon-star-3');
            let icon4 = document.getElementById('icon-star-4');
            let icon5 = document.getElementById('icon-star-5');


            switch (value) {
                case 1:
                    star1.checked = true;
                    input.value = 1;
                    icon1.classList.add("checked");
                    break;
                case 2:
                    star2.checked = true;
                    input.value = 2;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    break;
                case 3:
                    star3.checked = true;
                    input.value = 3;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    icon3.classList.add("checked");
                    break;
                case 4:
                    star4.checked = true;
                    input.value = 4;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    icon3.classList.add("checked");
                    icon4.classList.add("checked");
                    break;
                default:
                    star5.checked = true;
                    input.value = 5;
                    icon1.classList.add("checked");
                    icon2.classList.add("checked");
                    icon3.classList.add("checked");
                    icon4.classList.add("checked");
                    icon5.classList.add("checked");
                    break;
            }
            checkStar();
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
    </script>
@endsection

