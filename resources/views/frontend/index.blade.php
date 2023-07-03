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

        .megamenu a:hover, a:focus {
            color: #e7ab3c;
            font-weight: 500;
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
    <div id="body-content">

        <section class="header_bottom">
            <div class="container-fluid" id="nav-header">
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-md-3 col-12 col-xl-2 menu-header not-mobile-button"
                         id="left-cate">
                        <nav class="navbar navbar-expand-lg mega-menu-header"
                             style="padding: 0; width: 100%; align-items: start">
                            <div class="vertical-menu">
                                @php
                                    $listCate = DB::table('categories')->where('parent_id', null)->get();
                                @endphp
                                <ul class="navbar-nav" id="side-cate" style="overflow-y: scroll; ">
                                        @foreach($listCate as $cate)
                                        <li class="nav-item d-grid ">
                                            <a class="nav-link text-nowrap text-limit position-relative " href="{{ route('category.show', $cate->id) }}">
                                                <i class="fa fa-laptop" aria-hidden="true"></i>
                                                {{ $cate->name }}
                                            </a>
                                            @if(!$listCate->isEmpty())
                                            <div class="megamenu">
                                                <div class="row">
                                                    @php
                                                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                                                    @endphp
                                                    @foreach($listChild as $child)
                                                    <div class="col-sm-4 mt-1 mb-1">
                                                        <h4><a href="{{ route('category.show', $child->id) }}">{{ $child->name }}</a></h4>
                                                        <ul>
                                                            @php
                                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                                            @endphp
                                                            @foreach($listChild2 as $child2)
                                                                <li>
                                                                    <a href="{{ route('category.show', $child2->id) }}">{{ $child2->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                        </li>
                                        <li class="border-bottom"></li>
                                    @endforeach
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 col-xl-7 mb-2 not-tablet-button">
                        <!-- Hero Section Begin -->
                        <section class="slider-section">
                            <div class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner mt-1" id="carousel__1" role="listbox">
                                    <div class="carousel-item active img-banner-1 img height-banner"
                                         style="background-image: url('{{asset('images/img/banner1.jpeg')}}');">
                                    </div> <!-- End of Carousel Item -->

                                    <div class="carousel-item img-banner-1 img height-banner"
                                         style="background-image: url('{{asset('images/img/banner2.png')}}');">
                                    </div> <!-- End of Carousel Item -->
                                </div> <!-- End of Carousel Content -->

                                <!-- Previous & Next -->
                                <a href="#carousel" class="carousel-control-prev" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only"></span>
                                </a>
                                <a href="#carousel" class="carousel-control-next" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only"></span>
                                </a>
                            </div> <!-- End of Carousel -->
                        </section>
                        <!-- Hero Section End -->
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 mt-2 menu-bottom not-tablet-button" id="mini-img">
                        <div class="single-banner mb-3">
                            <img class="img" src="{{asset('images/img/Screenshot 2023-05-26 at 2.14.36 AM.png')}}"
                                 alt=""
                                 height="100%">
                        </div>

                        <div class="single-banner mb-3">
                            <img class="img" src="{{asset('images/img/banner_sidebar1.jpeg')}}" alt=""
                                 height="100%">
                        </div>

                        <div class="single-banner">
                            <img class="img" src="{{asset('images/img/banner_sidebar2.png')}}" alt="" height="100%">
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-9 col-md-9 col-12 col-xl-10 tablet-button">
                        <div class="row" id="carousel__2">
                            <div class="col-lg-8 col-sm-12 col-md-12 col-12 col-xl-7 ">
                                <!-- Hero Section Begin -->
                                <section class="slider-section">
                                    <div id="carousel2" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner mt-1" role="listbox">
                                            <div class="carousel-item active img-banner-1 img height-banner"
                                                 style="background-image: url('{{asset('images/img/banner1.jpeg')}}');">
                                            </div> <!-- End of Carousel Item -->

                                            <div class="carousel-item img-banner-1 img height-banner"
                                                 style="background-image: url('{{asset('images/img/banner2.png')}}');">
                                            </div> <!-- End of Carousel Item -->
                                        </div> <!-- End of Carousel Content -->

                                        <!-- Previous & Next -->
                                        <a href="#carousel2" class="carousel-control-prev" role="button"
                                           data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only"></span>
                                        </a>
                                        <a href="#carousel2" class="carousel-control-next" role="button"
                                           data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only"></span>
                                        </a>
                                    </div> <!-- End of Carousel -->
                                </section>
                                <!-- Hero Section End -->
                            </div>
                            <div class="col-md-12 col-sm-12 mt-2">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="">
                                            <img class="img"
                                                 src="{{asset('images/img/Screenshot 2023-05-26 at 2.14.36 AM.png')}}"
                                                 alt=""
                                                 height="100%">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="">
                                            <img class="img" src="{{asset('images/img/banner_sidebar1.jpeg')}}" alt=""
                                                 height="100%">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="">
                                            <img class="img" src="{{asset('images/img/banner_sidebar2.png')}}" alt=""
                                                 height="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-lg-2 p-left p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="product-slider owl-carousel">
                        @foreach($productByLocal as $product)
                            <div class="row ">
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                                {{--                                        <span>$35.00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 p-right p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <section class="deal-of-week set-bg spad" data-setbg="{{asset('images/img/time-bg.jpg')}}">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br/> do ipsum dolor sit amet,
                        consectetur adipisicing elit </p>
                    <div class="product-price">
                        $35.00
                        <span>/ HanBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>12</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span>52</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="#" class="primary-btn">Shop Now</a>
            </div>
        </section>
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-lg-2 p-left p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between mb-3">
                        <ul>
                            <li><img class="img border" width="60px" height="40px"
                                     src="{{ asset('images/korea.png') }}" alt=""></li>
                        </ul>
                        <ul>
                            <li><a class="link-read-more"
                                   href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($productByKr as $product)
                            <div class="row ">
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                                {{--                                        <span>$35.00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                                {{--                                        <span>$35.00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 p-right p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-lg-2 p-left p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between mb-3">
                        <ul>
                            <li><img class="img border" width="60px" height="40px"
                                     src="{{ asset('images/japan.webp') }}" alt=""></li>
                        </ul>
                        <ul>
                            <li><a class="link-read-more"
                                   href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($productByJp as $product)
                            <div class="row ">
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                                {{--                                        <span>$35.00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                                {{--                                        <span>$35.00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 p-right p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-lg-2 p-left p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between mb-3">
                        <ul>
                            <li><img class="img" width="60px" height="40px" src="{{ asset('images/china.webp') }}"
                                     alt=""></li>
                        </ul>
                        <ul>
                            <li><a class="link-read-more"
                                   href="{{route('product.index')}}">{{ __('home.read more') }}</a></li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        @foreach($productByCn as $product)
                            <div class="row">
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                                {{--                                        <span>$35.00</span>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{$product->thumbnail}}" alt="">
                                            <div class="sale">Sale</div>
                                            <div class="icon">
                                                <i class="icon_heart_alt"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="catagory-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-2 p-right p-side-tablet">
                    <div class="product-large set-bg m-large p-l-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large p-r-1"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Men’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
        <section class=" mt-4">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>From The Blog</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-blog">
                            <img class="img" src="{{asset('images/img/latest-1.jpg')}}" alt="">
                            <div class="latest-text">
                                <div class="tag-list">
                                    <div class="tag-item">
                                        <i class="fa fa-calendar-o"></i>
                                        May 4,2019
                                    </div>
                                    <div class="tag-item">
                                        <i class="fa fa-comment-o"></i>
                                        5
                                    </div>
                                </div>
                                <a href="#">
                                    <h4>The Best Street Style From London Fashion Week</h4>
                                </a>
                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam
                                    quaerat </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-blog">
                            <img class="img" src="{{asset('images/img/latest-2.jpg')}}" alt="">
                            <div class="latest-text">
                                <div class="tag-list">
                                    <div class="tag-item">
                                        <i class="fa fa-calendar-o"></i>
                                        May 4,2019
                                    </div>
                                    <div class="tag-item">
                                        <i class="fa fa-comment-o"></i>
                                        5
                                    </div>
                                </div>
                                <a href="#">
                                    <h4>Vogue's Ultimate Guide To Autumn/Winter 2019 Shoes</h4>
                                </a>
                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam
                                    quaerat </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-latest-blog">
                            <img class="img" src="{{asset('images/img/latest-3.jpg')}}" alt="">
                            <div class="latest-text">
                                <div class="tag-list">
                                    <div class="tag-item">
                                        <i class="fa fa-calendar-o"></i>
                                        May 4,2019
                                    </div>
                                    <div class="tag-item">
                                        <i class="fa fa-comment-o"></i>
                                        5
                                    </div>
                                </div>
                                <a href="#">
                                    <h4>How To Brighten Your Wardrobe With A Dash Of Lime</h4>
                                </a>
                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam
                                    quaerat </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid latest-blog">
            <div class="col-12 col-sm-12 benefit-items">
                <div class="row">
                    <div class="col-12 col-sm-4 border-right">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img class="img" src="{{asset('images/img/icon-1.png')}}" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Free Shipping</h6>
                                <p>For all order over 99$</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 border-right">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img class="img" src="{{asset('images/img/icon-2.png')}}" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Delivery On Time</h6>
                                <p>If good have prolems</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img class="img" src="{{asset('images/img/icon-3.png')}}" alt="">
                            </div>
                            <div class="sb-text">
                                <h6>Secure Payment</h6>
                                <p>100% secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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