@extends('frontend.layouts.master')

@section('title', 'Home page')

@section('content')
    <style>
        .vertical-menu {
            width: 100%;
        }

        .vertical-menu .navbar-nav {
            display: block;
        }

        .vertical-menu .nav-item {
            background: #ffffff;
        }

        li {
            list-style: none;
        }

        .vertical-menu .nav-link {
            color: #757575;
            padding: 10px;
        }

        .img-banner-1 {
            /*height: 30vw;*/
            margin-top: -30px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow-x: hidden;
        }

        .tablet-button {
            display: none;
        }

        /* CSS cho megamenu */
        .megamenu {
            display: none;
        }

        .vertical-menu .nav-item:hover .megamenu {
            display: block;
            position: absolute;
            top: 8px;
            left: 94%;
            z-index: 999;
            width: 700px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 4px 0 rgba(0, 0, 0, .25);
        }


        .depart-hover li:hover .megamenu {
            display: block;
            position: absolute;
            top: 8px;
            left: 94%;
            z-index: 999;
            width: 700px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 4px 0 rgba(0, 0, 0, .25);
        }

        .depart-hover .megamenu li a {
            padding-left: 0 !important;
        }

        @media only screen and (min-width: 1200px) {

        }

        @media only screen and (min-width: 992px) {
            .p-left {
                padding-right: 0;
            }

            .p-right {
                padding-left: 0;
            }
        }

        @media only screen and (min-width: 992px) and (max-width: 1199px) {

        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .menu-header {
                margin-right: -8px;
                margin-left: 0px;
                max-width: 30% !important;
            }

            .mega-menu-header {
                margin-right: -8px;
                margin-left: 0;
            }

            .menu-bottom {
                max-width: 20% !important;
            }
        }

        @media (max-width: 767px) {
            .height-banner {
                height: 40vw;
                width: 100%;
            }

        }

        @media (min-width: 768px) {
            .height-banner {
                height: 30vw;
            }
        }

        @media only screen and (max-width: 480px) {
            .filter-control .mr-5 {
                margin-right: 0 !important;
            }

            .filter-control .ml-5 {
                margin-left: 0 !important;
            }
        }

        .p-side-tablet {
        }

        @media only screen and (min-width: 576px ) and  (max-width: 991px) {
            .tablet-button {
                display: block;
            }

            .not-tablet-button {
                display: none !important;
            }

            .p-side-tablet {
                display: flex;
            }

            .product-large.m-large {
                margin-top: 40px;
                width: 50%;
            }

            .p-left .product-large.m-large.p-l-1 {
                margin-right: 25px;
            }

            .p-right .product-large.m-large.p-r-1 {
                margin-left: 25px;
            }

        }

        @media not (min-width: 576px ) and  (max-width: 991px) {
            .tablet-button {
                display: none;
            }

            .not-tablet-button {
                display: block !important;
            }


        }

        .text-limit {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .not-mobile-button {
            display: none;
        }

        .only-mobile-button {
            display: flex;
        }

        @media only screen and (min-width: 576px) {
            .not-mobile-button {
                display: flex;
            }


            .only-mobile-button {
                display: none;
            }
        }

        @media only screen and (max-width: 575px) {
            .benefit-items .border-right {
                border-right: none;
                border-bottom: 1px solid #dee2e6 !important;
            }
        }
    </style>

    <div class="body">
        <section class="section-First pt-3 pb-3 container-fluid">
            <div class="row">
                <div class="section-First-left section-First-hd col-lg-2 col-12">
                    <span class="content">SHOP BY CATEGORIES</span>
                    <hr>
                    <div class="row list">
                        @php
                            $listCate = DB::table('categories')->where('parent_id', null)->get();
                        @endphp
                        @foreach($listCate as $cate)
                            <div class="col-lg-6 item item-left text-center">
                                <a href="{{ route('category.show', $cate->id) }}">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/w/sport-icon__06672.original.jpg"
                                         alt="">
                                    <div class="text">{{ $cate->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="section-First-left section-First-mobile mt-3 col-lg-2 col-12">
                    <span class="content">SHOP BY CATEGORIES</span>
                    <hr>
                    <div class="list">
                        @php
                            $listCate = DB::table('categories')->where('parent_id', null)->get();
                        @endphp
                        @foreach($listCate as $cate)
                            <div class="item item-left text-center">
                                <a href="{{ route('category.show', $cate->id) }}">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/w/sport-icon__06672.original.jpg"
                                         alt="">
                                    <div class="text">{{ $cate->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="section-First-middle col-lg-6 col-sm-7 col-12">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img
                                        src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/742w/carousel/17/slideshow-home2-1.jpg?c=1"
                                        alt=""></div>
                            <div class="swiper-slide"><img
                                        src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/18/slideshow-home2-2.jpg?c=1"
                                        alt=""></div>
                            <div class="swiper-slide"><img
                                        src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/19/slideshow-home2-3.jpg?c=1"
                                        alt=""></div>
                            <div class="swiper-slide"><img
                                        src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/742w/carousel/17/slideshow-home2-1.jpg?c=1"
                                        alt=""></div>
                            <div class="swiper-slide"><img
                                        src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/18/slideshow-home2-2.jpg?c=1"
                                        alt=""></div>
                            <div class="swiper-slide"><img
                                        src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/19/slideshow-home2-3.jpg?c=1"
                                        alt=""></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="section-First-right col-lg-4 col-sm-5 col-12">
                    <div class="row">
                        <div class="col-6 item">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                 alt="">
                        </div>
                        <div class="col-6 item">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                 alt="">
                        </div>
                        <div class="col-6 item">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                 alt="">
                        </div>
                        <div class="col-6 item">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-Second pt-3 pb-3 container-fluid text-center">
            <img src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/banner-custom-home-2.png"
                 alt="">
        </section>
        <section class="section-Third section pt-3 pb-3 container-fluid">
            <div class="content">Shop by Categories</div>
            <div class="swiper Categories">
                <div class="swiper-wrapper">
                    @php
                        $listCate = DB::table('categories')->where('parent_id', null)->get();
                    @endphp
                    @foreach($listCate as $cate)
                        <div class="swiper-slide">
                            <a href="{{ route('category.show', $cate->id) }}">
                                <div class="img">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-1.png"
                                         alt="">
                                </div>
                                <div class="text">
                                    {{$cate->name}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <section class="section-Fourth section pt-3 pb-3 container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="content">New Products</div>
                    <div class="swiper NewProducts">
                        <div class="swiper-wrapper">
                            @foreach($newProducts as $newProduct)
                                <div class="swiper-slide">
                                    <div class="item">
                                        <div class="item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                                 alt="">
                                            <div class="button-view"><a href="">Quick view</a></div>
                                            <div class="text">
                                                <div class="text-sale">
                                                    Sale
                                                </div>
                                                <div class="text-new">
                                                    New
                                                </div>
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
                                                $namenewProduct = DB::table('users')->where('id', $newProduct->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{$namenewProduct->name}}
                                            </div>
                                            <div class="card-title">
                                                <a href="{{route('detail_product.show', $newProduct->id)}}">{{$newProduct->name}}</a>
                                            </div>
                                            <div class="card-price d-flex justify-content-between">
                                                <!-- <div class="price">
                                                                <strong>$189.000</strong>
                                                            </div> -->
                                                <div class="price-sale">
                                                    <strong>${{$newProduct->price}}</strong>
                                                </div>
                                                <div class="price-cost">
                                                    <strike>${{$newProduct->price}}</strike>
                                                </div>
                                            </div>
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    <a href="">Choose Options</a>
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
                </div>
                <div class="col-md-6">
                    <div class="content">Featured Products</div>
                    <div class="swiper FeaturedProducts">
                        <div class="swiper-wrapper">
                            @foreach($productFeatures as $productFeature)
                                @foreach($productFeature as $product)
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <div class="item-img">
                                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                                     alt="">
                                                <div class="button-view"><a href="">Quick view</a></div>
                                                <div class="text">
                                                    <div class="text-sale">
                                                        Sale
                                                    </div>
                                                    <div class="text-new">
                                                        New
                                                    </div>
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
                                                    $nameFeature = DB::table('users')->where('id', $product->user_id)->first();
                                                @endphp
                                                <div class="card-brand">
                                                    {{$nameFeature->name}}
                                                </div>
                                                <div class="card-title">
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                </div>
                                                <div class="card-price d-flex justify-content-between">
                                                    <!-- <div class="price">
                                                                    <strong>$189.000</strong>
                                                                </div> -->
                                                    <div class="price-sale">
                                                        <strong>${{$product->price}}</strong>
                                                    </div>
                                                    <div class="price-cost">
                                                        <strike>${{$product->price}}</strike>
                                                    </div>
                                                </div>
                                                <div class="card-bottom d-flex justify-content-between">
                                                    <div class="card-bottom--left">
                                                        <a href="">Choose Options</a>
                                                    </div>
                                                    <div class="card-bottom--right">
                                                        <i class="item-icon fa-regular fa-heart"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-Fifth section pt-3 pb-3 container-fluid">
            <div class="content"><i class="fa-solid fa-fire-flame-curved"></i> Hot Deals</div>
            <div class="swiper HotDeals">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                     alt="">
                                <div class="button-view"><a href="">Quick view</a></div>
                                <div class="text">
                                    <div class="text-sale">
                                        Sale
                                    </div>
                                    <div class="text-new">
                                        New
                                    </div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                     alt="">
                                <div class="button-view"><a href="">Quick view</a></div>
                                <div class="text">
                                    <div class="text-sale">
                                        Sale
                                    </div>
                                    <div class="text-new">
                                        New
                                    </div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                     alt="">
                                <div class="button-view"><a href="">Quick view</a></div>
                                <div class="text">
                                    <div class="text-sale">
                                        Sale
                                    </div>
                                    <div class="text-new">
                                        New
                                    </div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                     alt="">
                                <div class="button-view"><a href="">Quick view</a></div>
                                <div class="text">
                                    <div class="text-sale">
                                        Sale
                                    </div>
                                    <div class="text-new">
                                        New
                                    </div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                     alt="">
                                <div class="button-view"><a href="">Quick view</a></div>
                                <div class="text">
                                    <div class="text-sale">
                                        Sale
                                    </div>
                                    <div class="text-new">
                                        New
                                    </div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/180/481/product-loa-2__18151__57560.1623301405.jpg?c=1"
                                     alt="">
                                <div class="text"><a href="">Quick view</a></div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="item">
                            <div class="item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/320w/products/181/483/product-tivi-3__08102__62099.1623301230.jpg?c=1"
                                     alt="">
                                <div class="button-view"><a href="">Quick view</a></div>
                                <div class="text">
                                    <div class="text-sale">
                                        Sale
                                    </div>
                                    <div class="text-new">
                                        New
                                    </div>
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
                                <div class="card-brand">
                                    Benjamin Button
                                </div>
                                <div class="card-title">
                                    <a href="">Delementum milancelos preteus tomuir</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                            <strong>$189.000</strong>
                                        </div> -->
                                    <div class="price-sale">
                                        <strong>$89.000</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>$189.000</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="">Choose Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <section class="section-Sixth section pt-3 pb-3 container-fluid">
            <div class="content">Top Brands</div>
            <div class="swiper TopBrands">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"
                                 alt="">
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        @php
            $listCate = DB::table('categories')->where('parent_id', null)->get();
        @endphp
        @foreach($listCate as $cate)
            <section class="section pt-3 pb-3 container-fluid">
                <div class="content">{{$cate->name}}</div>
                <div class="row">
                    <div class="col-md-2 section-left">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/products-block-banner-left-2.jpg" alt="">
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="swiper listProduct">
                            <div class="swiper-wrapper">
                                @php
                                    $products = \App\Models\Product::where('category_id','=', $cate->id)->get();
                                @endphp
                                @foreach($products as $product)
                                    <div class="swiper-slide">
                                        <div class="item">
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                     alt="">
                                                <div class="button-view"><a href="">Quick view</a></div>
                                                <div class="text">
                                                    <!-- <div class="text-sale">
                                                                    Sale
                                                                </div>
                                                                <div class="text-new">
                                                                    New
                                                                </div> -->
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
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                </div>
                                                <div class="card-price d-flex justify-content-between">
                                                    <!-- <div class="price">
                                                                    <strong>$189.000</strong>
                                                                </div> -->
                                                    <div class="price-sale">
                                                        <strong>${{$product->price}}</strong>
                                                    </div>
                                                    <div class="price-cost">
                                                        <strike>${{$product->price}}</strike>
                                                    </div>
                                                </div>
                                                <div class="card-bottom d-flex justify-content-between">
                                                    <div class="card-bottom--left">
                                                        <a href="">Choose Options</a>
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
                    </div>
                    <div class="col-0 col-md-2">
                        <div class="brand-item d-flex justify-content-between">
                            <div class="brand-item-text">
                                <div class="name">FOR MEN</div>
                                <div><a href="#">Shop now</a></div>
                            </div>
                            <div class="brand-item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg" alt="">
                            </div>
                        </div>
                        <div class="brand-item d-flex justify-content-between">
                            <div class="brand-item-text">
                                <div class="name">FOR MEN</div>
                                <div><a href="#">Shop now</a></div>
                            </div>
                            <div class="brand-item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg" alt="">
                            </div>
                        </div>
                        <div class="brand-item d-flex justify-content-between">
                            <div class="brand-item-text">
                                <div class="name">FOR MEN</div>
                                <div><a href="#">Shop now</a></div>
                            </div>
                            <div class="brand-item-img">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg" alt="">
                            </div>
                        </div>
                        <div class="brand-item d-flex justify-content-between">
                            <div class="brand-item--all">
                                <a href="#">View all categories</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section pt-3 pb-3 container-fluid">
                <div class="product-banner">
                    <div class="row">
                        <div class="col-6">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                                 alt="">
                        </div>
                        <div class="col-6">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images2.jpg"
                                 alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
        <section class="section-Seven container-fluid">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel
                <span id="dots">...</span>
                <span id="more">
                    erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa.
                    Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac.
                    In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis.
                    Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.
                </span>
            </p>
            <button onclick="myFunction()" id="myBtn">Show More</button>
        </section>
        <section>
            <div >
                <img class="img" src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/bg-with-us2.jpg" alt="">
                <div class="content">
                    Why shop with us?
                </div>
                <div class="list">
                    <div class="item">
                        <div class="item-img">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/icon-with-us1.png" alt="">
                        </div>
                        <div class="item-content">
                            QUALITY AND SAVING
                        </div>
                        <div class="item-text">
                            Comprehensive quality control and affordable prices
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--    <div id="body-content">--}}

    {{--        <section class="header_bottom">--}}
    {{--            <div class="container-fluid" id="nav-header">--}}
    {{--                <div class="row">--}}
    {{--                    @if($banner)--}}
    {{--                        <div class="col-lg-3 col-sm-3 col-md-3 col-12 col-xl-2 menu-header not-mobile-button"--}}
    {{--                             id="left-cate">--}}
    {{--                            <nav class="navbar navbar-expand-lg mega-menu-header"--}}
    {{--                                 style="padding: 0; width: 100%; align-items: start">--}}
    {{--                                <div class="vertical-menu">--}}
    {{--                                    @php--}}
    {{--                                        $listCate = DB::table('categories')->where('parent_id', null)->get();--}}
    {{--                                    @endphp--}}
    {{--                                    <ul class="navbar-nav" id="side-cate" style="overflow-y: scroll; ">--}}
    {{--                                        @foreach($listCate as $cate)--}}
    {{--                                            <li class="nav-item d-grid ">--}}
    {{--                                                <a class="nav-link text-nowrap text-limit position-relative "--}}
    {{--                                                   href="{{ route('category.show', $cate->id) }}">--}}
    {{--                                                    <i class="fa fa-laptop" aria-hidden="true"></i>--}}
    {{--                                                    {{ $cate->name }}--}}
    {{--                                                </a>--}}
    {{--                                                @if(!$listCate->isEmpty())--}}
    {{--                                                    <div class="megamenu">--}}
    {{--                                                        <div class="row">--}}
    {{--                                                            @php--}}
    {{--                                                                $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();--}}
    {{--                                                            @endphp--}}
    {{--                                                            @foreach($listChild as $child)--}}
    {{--                                                                <div class="col-sm-4 mt-1 mb-1">--}}
    {{--                                                                    <h4>--}}
    {{--                                                                        <a href="{{ route('category.show', $child->id) }}">{{ $child->name }}</a>--}}
    {{--                                                                    </h4>--}}
    {{--                                                                    <ul>--}}
    {{--                                                                        @php--}}
    {{--                                                                            $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();--}}
    {{--                                                                        @endphp--}}
    {{--                                                                        @foreach($listChild2 as $child2)--}}
    {{--                                                                            <li>--}}
    {{--                                                                                <a href="{{ route('category.show', $child2->id) }}">{{ $child2->name }}</a>--}}
    {{--                                                                            </li>--}}
    {{--                                                                        @endforeach--}}
    {{--                                                                    </ul>--}}
    {{--                                                                </div>--}}
    {{--                                                            @endforeach--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                @endif--}}
    {{--                                            </li>--}}
    {{--                                            <li class="border-bottom"></li>--}}
    {{--                                        @endforeach--}}
    {{--                                    </ul>--}}
    {{--                                </div>--}}
    {{--                            </nav>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-6 col-md-6 col-12 col-xl-7 mb-2 not-tablet-button">--}}
    {{--                            @php--}}
    {{--                                $listThumbnailsBanner = $banner->thumbnails;--}}
    {{--                                $arrayBannerThumbnails = explode(',', $listThumbnailsBanner);--}}
    {{--                            @endphp--}}
    {{--                            <section class="slider-section">--}}
    {{--                                <div class="carousel slide" data-ride="carousel">--}}
    {{--                                    <div class="carousel-inner mt-1" id="carousel__1" role="listbox">--}}
    {{--                                        @for($i = 0; $i<count($arrayBannerThumbnails); $i++)--}}
    {{--                                            <div class="carousel-item active img-banner-1 img height-banner"--}}
    {{--                                                 id="bannerTest[{{$i}}]"--}}
    {{--                                                 style="background-image: url('{{asset('storage/'.$arrayBannerThumbnails[$i])}}');">--}}
    {{--                                            </div>--}}
    {{--                                            <!-- Previous & Next -->--}}
    {{--                                            @if($i==0)--}}
    {{--                                                <a href="#bannerTest[{{count($arrayBannerThumbnails)-1}}]"--}}
    {{--                                                   class="carousel-control-prev" role="button" data-slide="prev">--}}
    {{--                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
    {{--                                                    <span class="sr-only"></span>--}}
    {{--                                                </a>--}}
    {{--                                            @else--}}
    {{--                                                <a href="#bannerTest[{{$i-1}}]" class="carousel-control-prev" role="button"--}}
    {{--                                                   data-slide="prev">--}}
    {{--                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
    {{--                                                    <span class="sr-only"></span>--}}
    {{--                                                </a>--}}
    {{--                                            @endif--}}
    {{--                                            @if($i==count($arrayBannerThumbnails)-1)--}}
    {{--                                                <a href="#bannerTest[0]" class="carousel-control-next" role="button"--}}
    {{--                                                   data-slide="next">--}}
    {{--                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
    {{--                                                    <span class="sr-only"></span>--}}
    {{--                                                </a>--}}
    {{--                                            @else--}}
    {{--                                                <a href="#bannerTest[{{$i+1}}]" class="carousel-control-next" role="button"--}}
    {{--                                                   data-slide="next">--}}
    {{--                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
    {{--                                                    <span class="sr-only"></span>--}}
    {{--                                                </a>--}}
    {{--                                            @endif--}}
    {{--                                        @endfor--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </section>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-3 col-md-3 col-12 mt-2 menu-bottom not-tablet-button" id="mini-img">--}}
    {{--                            @php--}}
    {{--                                $sub_thumbnails = $banner->sub_thumbnails;--}}
    {{--                                $sub_thumbnails = explode(',', $sub_thumbnails);--}}
    {{--                            @endphp--}}
    {{--                            @for($i = 0; $i<count($sub_thumbnails); $i++)--}}
    {{--                                <div class="single-banner mb-3">--}}
    {{--                                    <img class="img" src="{{ asset('storage/'.$sub_thumbnails[$i]) }}"--}}
    {{--                                         alt=""--}}
    {{--                                         height="100%">--}}
    {{--                                </div>--}}
    {{--                            @endfor--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-9 col-sm-9 col-md-9 col-12 col-xl-10 tablet-button">--}}
    {{--                            <div class="row" id="carousel__2">--}}
    {{--                                <div class="col-lg-8 col-sm-12 col-md-12 col-12 col-xl-7 ">--}}
    {{--                                    @php--}}
    {{--                                        $listThumbnailsBanner = $banner->thumbnails;--}}
    {{--                                        $arrayBannerThumbnails = explode(',', $listThumbnailsBanner);--}}
    {{--                                    @endphp--}}
    {{--                                    <section class="slider-section">--}}
    {{--                                        <div id="carousel2" class="carousel slide" data-ride="carousel">--}}
    {{--                                            <div class="carousel-inner mt-1" role="listbox">--}}
    {{--                                                @for($i = 0; $i<count($arrayBannerThumbnails); $i++)--}}
    {{--                                                    <div class="carousel-item active img-banner-1 img height-banner"--}}
    {{--                                                         style="background-image: url('{{asset('storage/'.$arrayBannerThumbnails[$i])}}');">--}}
    {{--                                                    </div>--}}
    {{--                                                @endfor--}}
    {{--                                            </div>--}}
    {{--                                            <a href="#carousel2" class="carousel-control-prev" role="button"--}}
    {{--                                               data-slide="prev">--}}
    {{--                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
    {{--                                                <span class="sr-only"></span>--}}
    {{--                                            </a>--}}
    {{--                                            <a href="#carousel2" class="carousel-control-next" role="button"--}}
    {{--                                               data-slide="next">--}}
    {{--                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
    {{--                                                <span class="sr-only"></span>--}}
    {{--                                            </a>--}}
    {{--                                        </div>--}}
    {{--                                    </section>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-12 col-sm-12 mt-2">--}}
    {{--                                    <div class="row">--}}
    {{--                                        <div class="col-sm-4">--}}
    {{--                                            <div class="">--}}
    {{--                                                <img class="img"--}}
    {{--                                                     src="{{asset('images/img/Screenshot 2023-05-26 at 2.14.36 AM.png')}}"--}}
    {{--                                                     alt=""--}}
    {{--                                                     height="100%">--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="col-sm-4">--}}
    {{--                                            <div class="">--}}
    {{--                                                <img class="img" src="{{asset('images/img/banner_sidebar1.jpeg')}}" alt=""--}}
    {{--                                                     height="100%">--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="col-sm-4">--}}
    {{--                                            <div class="">--}}
    {{--                                                <img class="img" src="{{asset('images/img/banner_sidebar2.png')}}" alt=""--}}
    {{--                                                     height="100%">--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    @endif--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-2 p-left p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    <div class="product-slider owl-carousel">--}}
    {{--                        @foreach($productByLocal as $product)--}}
    {{--                            <div class="row ">--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                                --}}{{--                                        <span>$35.00</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-2 p-right p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <h3 class="text-center">Top seller</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                @foreach($configsTop1 as $config)--}}
    {{--                    <div class="col-md-4 img"--}}
    {{--                         style="background-image: url('{{asset('storage/'.$config->thumbnail)}}');">--}}
    {{--                        <h3 class="text-center">--}}
    {{--                            @php--}}
    {{--                                $url = $config->url;--}}
    {{--                                $value = null;--}}
    {{--                                $item = null;--}}
    {{--                                $checkShop = false;--}}
    {{--                                if ($url == 0){--}}
    {{--                                    $checkShop = true;--}}
    {{--                                    $value = $config->user_id;--}}
    {{--                                } else {--}}
    {{--                                    $item = $config->user_id;--}}
    {{--                                    $value = $url;--}}
    {{--                                }--}}
    {{--                            @endphp--}}
    {{--                            @if($checkShop == true)--}}
    {{--                                <a href="{{route('list.products.shop.show', $value)}}">Go now</a>--}}
    {{--                            @else--}}
    {{--                                <a href="{{route('list.products.shop.category.show', ['category' => $value, 'shop' => $item])}}">Go--}}
    {{--                                    now</a>--}}
    {{--                            @endif--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <h3 class="text-center">Sản phẩm hot nhất</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-2 p-left p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    <div class="product-slider owl-carousel">--}}
    {{--                        @foreach($productHots as $products)--}}
    {{--                            @foreach($products as $product)--}}
    {{--                                <div class="row ">--}}
    {{--                                    @if($product->name)--}}
    {{--                                        <div class="col-12">--}}
    {{--                                            <div class="product-item">--}}
    {{--                                                <div class="pi-pic">--}}
    {{--                                                    <img class="img" src="{{ asset('storage/'.$product->thumbnail) }}"--}}
    {{--                                                         alt="">--}}
    {{--                                                    <div class="sale">Sale</div>--}}
    {{--                                                    <div class="icon">--}}
    {{--                                                        <i class="icon_heart_alt"></i>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="pi-text">--}}
    {{--                                                    <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                                    <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                        <h5>{{$product->name}}</h5>--}}
    {{--                                                    </a>--}}
    {{--                                                    <div class="product-price">--}}
    {{--                                                        ${{$product->price}}--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                            @endforeach--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-2 p-right p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <h3 class="text-center">Top seller</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                @foreach($configsTop2 as $config)--}}
    {{--                    <div class="col-md-4 img"--}}
    {{--                         style="background-image: url('{{asset('storage/'.$config->thumbnail)}}');">--}}
    {{--                        <h3 class="text-center">--}}
    {{--                            @php--}}
    {{--                                $url = $config->url;--}}
    {{--                                $value = null;--}}
    {{--                                $item = null;--}}
    {{--                                $checkShop = false;--}}
    {{--                                if ($url == 0){--}}
    {{--                                    $checkShop = true;--}}
    {{--                                    $value = $config->user_id;--}}
    {{--                                } else {--}}
    {{--                                    $item = $config->user_id;--}}
    {{--                                    $value = $url;--}}
    {{--                                }--}}
    {{--                            @endphp--}}
    {{--                            @if($checkShop == true)--}}
    {{--                                <a href="{{route('list.products.shop.show', $value)}}">Go now</a>--}}
    {{--                            @else--}}
    {{--                                <a href="{{route('list.products.shop.category.show', ['category' => $value, 'shop' => $item])}}">Go--}}
    {{--                                    now</a>--}}
    {{--                            @endif--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <h3 class="text-center">Sản phẩm nổi bật nhất</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-2 p-left p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    <div class="product-slider owl-carousel">--}}
    {{--                        @foreach($productFeatures as $products)--}}
    {{--                            @foreach($products as $product)--}}
    {{--                                <div class="row ">--}}
    {{--                                    <div class="col-12">--}}
    {{--                                        <div class="product-item">--}}
    {{--                                            <div class="pi-pic">--}}
    {{--                                                <img class="img" src="{{ asset('storage/'.$product->thumbnail) }}"--}}
    {{--                                                     alt="">--}}
    {{--                                                <div class="sale">Sale</div>--}}
    {{--                                                <div class="icon">--}}
    {{--                                                    <i class="icon_heart_alt"></i>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="pi-text">--}}
    {{--                                                <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                                <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                    <h5>{{$product->name}}</h5>--}}
    {{--                                                </a>--}}
    {{--                                                <div class="product-price">--}}
    {{--                                                    ${{$product->price}}--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            @endforeach--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-2 p-right p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">--}}
    {{--                        <h2>Women’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <h3 class="text-center">Top seller</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                @foreach($configsTop3 as $config)--}}
    {{--                    <div class="col-md-4 img"--}}
    {{--                         style="background-image: url('{{asset('storage/'.$config->thumbnail)}}');">--}}
    {{--                        <h3 class="text-center">--}}
    {{--                            @php--}}
    {{--                                $url = $config->url;--}}
    {{--                                $value = null;--}}
    {{--                                $item = null;--}}
    {{--                                $checkShop = false;--}}
    {{--                                if ($url == 0){--}}
    {{--                                    $checkShop = true;--}}
    {{--                                    $value = $config->user_id;--}}
    {{--                                } else {--}}
    {{--                                    $item = $config->user_id;--}}
    {{--                                    $value = $url;--}}
    {{--                                }--}}
    {{--                            @endphp--}}
    {{--                            @if($checkShop == true)--}}
    {{--                                <a href="{{route('list.products.shop.show', $value)}}">Go now</a>--}}
    {{--                            @else--}}
    {{--                                <a href="{{route('list.products.shop.category.show', ['category' => $value, 'shop' => $item])}}">Go--}}
    {{--                                    now</a>--}}
    {{--                            @endif--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <section class="deal-of-week set-bg spad" data-setbg="{{asset('images/img/time-bg.jpg')}}">--}}
    {{--            <div class="col-lg-6 text-center">--}}
    {{--                <div class="section-title">--}}
    {{--                    <h2>Deal Of The Week</h2>--}}
    {{--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br/> do ipsum dolor sit amet,--}}
    {{--                        consectetur adipisicing elit </p>--}}
    {{--                    <div class="product-price">--}}
    {{--                        $35.00--}}
    {{--                        <span>/ HanBag</span>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="countdown-timer" id="countdown">--}}
    {{--                    <div class="cd-item">--}}
    {{--                        <span>56</span>--}}
    {{--                        <p>Days</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="cd-item">--}}
    {{--                        <span>12</span>--}}
    {{--                        <p>Hrs</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="cd-item">--}}
    {{--                        <span>40</span>--}}
    {{--                        <p>Mins</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="cd-item">--}}
    {{--                        <span>52</span>--}}
    {{--                        <p>Secs</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <a href="#" class="primary-btn">Shop Now</a>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--        <h3 class="text-center">Top seller</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                @foreach($configsTop4 as $config)--}}
    {{--                    <div class="col-md-4 img"--}}
    {{--                         style="background-image: url('{{asset('storage/'.$config->thumbnail)}}');">--}}
    {{--                        <h3 class="text-center">--}}
    {{--                            @php--}}
    {{--                                $url = $config->url;--}}
    {{--                                $value = null;--}}
    {{--                                $item = null;--}}
    {{--                                $checkShop = false;--}}
    {{--                                if ($url == 0){--}}
    {{--                                    $checkShop = true;--}}
    {{--                                    $value = $config->user_id;--}}
    {{--                                } else {--}}
    {{--                                    $item = $config->user_id;--}}
    {{--                                    $value = $url;--}}
    {{--                                }--}}
    {{--                            @endphp--}}
    {{--                            @if($checkShop == true)--}}
    {{--                                <a href="{{route('list.products.shop.show', $value)}}">Go now</a>--}}
    {{--                            @else--}}
    {{--                                <a href="{{route('list.products.shop.category.show', ['category' => $value, 'shop' => $item])}}">Go--}}
    {{--                                    now</a>--}}
    {{--                            @endif--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="container-fluid mt-4">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-2 p-left p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    <div class="d-flex justify-content-between mb-3">--}}
    {{--                        <ul>--}}
    {{--                            <li><img class="img border" width="60px" height="40px"--}}
    {{--                                     src="{{ asset('images/korea.png') }}" alt=""></li>--}}
    {{--                        </ul>--}}
    {{--                        <ul>--}}
    {{--                            <li><a class="link-read-more"--}}
    {{--                                   href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-slider owl-carousel">--}}
    {{--                        @foreach($productByKr as $product)--}}
    {{--                            <div class="row ">--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                                --}}{{--                                        <span>$35.00</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                                --}}{{--                                        <span>$35.00</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-2 p-right p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <h3 class="text-center">Top seller</h3>--}}
    {{--        <div class="container-fluid mt-2">--}}
    {{--            <div class="row">--}}
    {{--                @foreach($configsTop5 as $config)--}}
    {{--                    <div class="col-md-4 img"--}}
    {{--                         style="background-image: url('{{asset('storage/'.$config->thumbnail)}}');">--}}
    {{--                        <h3 class="text-center">--}}
    {{--                            @php--}}
    {{--                                $url = $config->url;--}}
    {{--                                $value = null;--}}
    {{--                                $item = null;--}}
    {{--                                $checkShop = false;--}}
    {{--                                if ($url == 0){--}}
    {{--                                    $checkShop = true;--}}
    {{--                                    $value = $config->user_id;--}}
    {{--                                } else {--}}
    {{--                                    $item = $config->user_id;--}}
    {{--                                    $value = $url;--}}
    {{--                                }--}}
    {{--                            @endphp--}}
    {{--                            @if($checkShop == true)--}}
    {{--                                <a href="{{route('list.products.shop.show', $value)}}">Go now</a>--}}
    {{--                            @else--}}
    {{--                                <a href="{{route('list.products.shop.category.show', ['category' => $value, 'shop' => $item])}}">Go--}}
    {{--                                    now</a>--}}
    {{--                            @endif--}}
    {{--                        </h3>--}}
    {{--                    </div>--}}
    {{--                @endforeach--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="container-fluid mt-4">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-2 p-left p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    <div class="d-flex justify-content-between mb-3">--}}
    {{--                        <ul>--}}
    {{--                            <li><img class="img border" width="60px" height="40px"--}}
    {{--                                     src="{{ asset('images/japan.webp') }}" alt=""></li>--}}
    {{--                        </ul>--}}
    {{--                        <ul>--}}
    {{--                            <li><a class="link-read-more"--}}
    {{--                                   href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-slider owl-carousel">--}}
    {{--                        @foreach($productByJp as $product)--}}
    {{--                            <div class="row ">--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                                --}}{{--                                        <span>$35.00</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}

    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                                --}}{{--                                        <span>$35.00</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-2 p-right p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="container-fluid mt-4">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-2 p-left p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-8">--}}
    {{--                    <div class="d-flex justify-content-between mb-3">--}}
    {{--                        <ul>--}}
    {{--                            <li><img class="img" width="60px" height="40px" src="{{ asset('images/china.webp') }}"--}}
    {{--                                     alt=""></li>--}}
    {{--                        </ul>--}}
    {{--                        <ul>--}}
    {{--                            <li><a class="link-read-more"--}}
    {{--                                   href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-slider owl-carousel">--}}
    {{--                        @foreach($productByCn as $product)--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                                --}}{{--                                        <span>$35.00</span>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-12">--}}
    {{--                                    <div class="product-item">--}}
    {{--                                        <div class="pi-pic">--}}
    {{--                                            <img class="img" src="{{$product->thumbnail}}" alt="">--}}
    {{--                                            <div class="sale">Sale</div>--}}
    {{--                                            <div class="icon">--}}
    {{--                                                <i class="icon_heart_alt"></i>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="pi-text">--}}
    {{--                                            <div class="catagory-name">{{$product->category->name}}</div>--}}
    {{--                                            <a href="{{route('detail_product.show', $product->id)}}">--}}
    {{--                                                <h5>{{$product->name}}</h5>--}}
    {{--                                            </a>--}}
    {{--                                            <div class="product-price">--}}
    {{--                                                ${{$product->price}}--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-lg-2 p-right p-side-tablet">--}}
    {{--                    <div class="product-large set-bg m-large p-l-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                    <div class="product-large set-bg m-large p-r-1"--}}
    {{--                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">--}}
    {{--                        <h2>Men’s</h2>--}}
    {{--                        <a href="#">Discover More</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <section class=" mt-4">--}}
    {{--            <div class="col-sm-12">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-lg-12">--}}
    {{--                        <div class="section-title">--}}
    {{--                            <h2>From The Blog</h2>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-lg-4 col-md-6">--}}
    {{--                        <div class="single-latest-blog">--}}
    {{--                            <img class="img" src="{{asset('images/img/latest-1.jpg')}}" alt="">--}}
    {{--                            <div class="latest-text">--}}
    {{--                                <div class="tag-list">--}}
    {{--                                    <div class="tag-item">--}}
    {{--                                        <i class="fa fa-calendar-o"></i>--}}
    {{--                                        May 4,2019--}}
    {{--                                    </div>--}}
    {{--                                    <div class="tag-item">--}}
    {{--                                        <i class="fa fa-comment-o"></i>--}}
    {{--                                        5--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <a href="#">--}}
    {{--                                    <h4>The Best Street Style From London Fashion Week</h4>--}}
    {{--                                </a>--}}
    {{--                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam--}}
    {{--                                    quaerat </p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-4 col-md-6">--}}
    {{--                        <div class="single-latest-blog">--}}
    {{--                            <img class="img" src="{{asset('images/img/latest-2.jpg')}}" alt="">--}}
    {{--                            <div class="latest-text">--}}
    {{--                                <div class="tag-list">--}}
    {{--                                    <div class="tag-item">--}}
    {{--                                        <i class="fa fa-calendar-o"></i>--}}
    {{--                                        May 4,2019--}}
    {{--                                    </div>--}}
    {{--                                    <div class="tag-item">--}}
    {{--                                        <i class="fa fa-comment-o"></i>--}}
    {{--                                        5--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <a href="#">--}}
    {{--                                    <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>--}}
    {{--                                </a>--}}
    {{--                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam--}}
    {{--                                    quaerat </p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-lg-4 col-md-6">--}}
    {{--                        <div class="single-latest-blog">--}}
    {{--                            <img class="img" src="{{asset('images/img/latest-3.jpg')}}" alt="">--}}
    {{--                            <div class="latest-text">--}}
    {{--                                <div class="tag-list">--}}
    {{--                                    <div class="tag-item">--}}
    {{--                                        <i class="fa fa-calendar-o"></i>--}}
    {{--                                        May 4,2019--}}
    {{--                                    </div>--}}
    {{--                                    <div class="tag-item">--}}
    {{--                                        <i class="fa fa-comment-o"></i>--}}
    {{--                                        5--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <a href="#">--}}
    {{--                                    <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>--}}
    {{--                                </a>--}}
    {{--                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam--}}
    {{--                                    quaerat </p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </section>--}}
    {{--        <div class="container-fluid latest-blog">--}}
    {{--            <div class="col-12 col-sm-12 benefit-items">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-12 col-sm-4 border-right">--}}
    {{--                        <div class="single-benefit">--}}
    {{--                            <div class="sb-icon">--}}
    {{--                                <img class="img" src="{{asset('images/img/icon-1.png')}}" alt="">--}}
    {{--                            </div>--}}
    {{--                            <div class="sb-text">--}}
    {{--                                <h6>Free Shipping</h6>--}}
    {{--                                <p>For all order over 99$</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-12 col-sm-4 border-right">--}}
    {{--                        <div class="single-benefit">--}}
    {{--                            <div class="sb-icon">--}}
    {{--                                <img class="img" src="{{asset('images/img/icon-2.png')}}" alt="">--}}
    {{--                            </div>--}}
    {{--                            <div class="sb-text">--}}
    {{--                                <h6>Delivery On Time</h6>--}}
    {{--                                <p>If good have prolems</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-12 col-sm-4">--}}
    {{--                        <div class="single-benefit">--}}
    {{--                            <div class="sb-icon">--}}
    {{--                                <img class="img" src="{{asset('images/img/icon-3.png')}}" alt="">--}}
    {{--                            </div>--}}
    {{--                            <div class="sb-text">--}}
    {{--                                <h6>Secure Payment</h6>--}}
    {{--                                <p>100% secure payment</p>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <script>
        let side_cate = document.getElementById('side-cate');
        let carousel_1 = document.getElementById('carousel__1');
        let carousel_2 = document.getElementById('carousel__2');

        let h_car_1 = carousel_1.offsetHeight;
        let h_car_2 = carousel_2.offsetHeight;

        let heightB = h_car_1 !== 0 ? h_car_1 : h_car_2;
        side_cate.style.height = heightB + 'px';

    </script>
@endsection