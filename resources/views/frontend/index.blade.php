@extends('frontend.layouts.master')

@section('title', 'Home page')

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
            height: 350px;
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

        .img-banner-1 {
            height: 400px;
            margin-top: -30px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .img-banner-2 {
            height: 400px;
            margin-top: -30px;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        @media only screen and (min-width: 1200px) {

        }

        @media only screen and (min-width: 992px) and (max-width: 1199px) {

        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .menu-header {
                margin-right: -8px;
                margin-left: 8px;
                max-width: 30% !important;
            }

            .mega-menu-header {
                margin-right: -8px;
                margin-left: 8px;
            }

            .menu-bottom {
                max-width: 20% !important;
            }
        }

        @media only screen and (max-width: 767px) {

        }
    </style>
    <!-- Hero Section Begin -->
    <section class="header_bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-lg-3 menu-header">
                    <nav class="navbar navbar-expand-lg mega-menu-header">
                        <div class="vertical-menu">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-laptop"
                                                                                          aria-hidden="true"></i>&ensp;
                                        Electronic Devices</a>
                                    <div class="megamenu">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="/category/1">All-In-One</a></li>
                                                    <li><a href="/category/1">Gaming Desktops</a></li>
                                                    <li><a href="/category/1">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="/category/1">Traditional Laptops</a></li>
                                                    <li><a href="/category/1">Gaming Laptops</a></li>
                                                    <li><a href="/category/1">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="/category/1">Headphones & Headsets</a></li>
                                                    <li><a href="/category/1">Portable Speakers</a></li>
                                                    <li><a href="/category/1">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="/category/1">All-In-One</a></li>
                                                    <li><a href="/category/1">Gaming Desktops</a></li>
                                                    <li><a href="/category/1">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="/category/1">Traditional Laptops</a></li>
                                                    <li><a href="/category/1">Gaming Laptops</a></li>
                                                    <li><a href="/category/1">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="/category/1">Headphones & Headsets</a></li>
                                                    <li><a href="/category/1">Portable Speakers</a></li>
                                                    <li><a href="/category/1">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-television"
                                                                                          aria-hidden="true"></i>&ensp;
                                        TV & Home Appliances</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-laptop"
                                                                                          aria-hidden="true"></i>&ensp;
                                        Electronic Devices</a>
                                    <div class="megamenu">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="/category/1">All-In-One</a></li>
                                                    <li><a href="/category/1">Gaming Desktops</a></li>
                                                    <li><a href="/category/1">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="/category/1">Traditional Laptops</a></li>
                                                    <li><a href="/category/1">Gaming Laptops</a></li>
                                                    <li><a href="/category/1">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="/category/1">Headphones & Headsets</a></li>
                                                    <li><a href="/category/1">Portable Speakers</a></li>
                                                    <li><a href="/category/1">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="/category/1">All-In-One</a></li>
                                                    <li><a href="/category/1">Gaming Desktops</a></li>
                                                    <li><a href="/category/1">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="/category/1">Traditional Laptops</a></li>
                                                    <li><a href="/category/1">Gaming Laptops</a></li>
                                                    <li><a href="/category/1">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="/category/1">Headphones & Headsets</a></li>
                                                    <li><a href="/category/1">Portable Speakers</a></li>
                                                    <li><a href="/category/1">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"
                                                                                aria-hidden="true"></i>&ensp; TV & Home
                                        Appliances</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"
                                                                                aria-hidden="true"></i>&ensp; Electronic
                                        Devices</a>
                                    <div class="megamenu">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="#">All-In-One</a></li>
                                                    <li><a href="#">Gaming Desktops</a></li>
                                                    <li><a href="#">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="#">Traditional Laptops</a></li>
                                                    <li><a href="#">Gaming Laptops</a></li>
                                                    <li><a href="#">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="#">Headphones & Headsets</a></li>
                                                    <li><a href="#">Portable Speakers</a></li>
                                                    <li><a href="#">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="#">All-In-One</a></li>
                                                    <li><a href="#">Gaming Desktops</a></li>
                                                    <li><a href="#">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="#">Traditional Laptops</a></li>
                                                    <li><a href="#">Gaming Laptops</a></li>
                                                    <li><a href="#">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="#">Headphones & Headsets</a></li>
                                                    <li><a href="#">Portable Speakers</a></li>
                                                    <li><a href="#">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"
                                                                                aria-hidden="true"></i>&ensp; TV & Home
                                        Appliances</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"
                                                                                aria-hidden="true"></i>&ensp; Electronic
                                        Devices</a>
                                    <div class="megamenu">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="#">All-In-One</a></li>
                                                    <li><a href="#">Gaming Desktops</a></li>
                                                    <li><a href="#">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="#">Traditional Laptops</a></li>
                                                    <li><a href="#">Gaming Laptops</a></li>
                                                    <li><a href="#">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="#">Headphones & Headsets</a></li>
                                                    <li><a href="#">Portable Speakers</a></li>
                                                    <li><a href="#">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h5>Desktops Computers</h5>
                                                <ul>
                                                    <li><a href="#">All-In-One</a></li>
                                                    <li><a href="#">Gaming Desktops</a></li>
                                                    <li><a href="#">DIY</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Laptops</h5>
                                                <ul>
                                                    <li><a href="#">Traditional Laptops</a></li>
                                                    <li><a href="#">Gaming Laptops</a></li>
                                                    <li><a href="#">2-in-1s</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-4">
                                                <h5>Audio</h5>
                                                <ul>
                                                    <li><a href="#">Headphones & Headsets</a></li>
                                                    <li><a href="#">Portable Speakers</a></li>
                                                    <li><a href="#">Home Audio</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"
                                                                                aria-hidden="true"></i>&ensp; TV & Home
                                        Appliances</a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>
                <div class="col-lg-6 col-md-6">
                    <!-- Hero Section Begin -->
                    <section class="slider-section">
                        <div id="carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner mt-1" role="listbox">
                                <div class="carousel-item active img-banner-1 img"
                                     style="background-image: url('{{asset('images/img/banner.webp')}}');">
                                </div> <!-- End of Carousel Item -->

                                <div class=" carousel-item img-banner-2 img"
                                     style="background-image: url('{{asset('images/img/banner2.webp')}}');">
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
                    </section> <!-- End of Slider -->
                    <!-- Hero Section End -->
                </div>

                <div class="col-lg-3 col-md-3 mt-2 menu-bottom">
                    <div class="single-banner mb-3">
                        <img class="img" src="{{asset('images/img/Screenshot 2023-05-26 at 2.14.36 AM.png')}}" alt=""
                             height="100%">
                    </div>

                    <div class="single-banner mb-3">
                        <img class="img" src="{{asset('images/img/banner_sidebar1.jpeg')}}" alt="" height="100%">
                    </div>

                    <div class="single-banner">
                        <img class="img" src="{{asset('images/img/banner_sidebar2.png')}}" alt="" height="100%">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Women Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 ">
                    <div class="product-large set-bg m-large"
                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large"
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
                <div class="col-lg-2">
                    <div class="product-large set-bg m-large"
                         data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                    <div class="product-large set-bg m-large"
                         data-setbg="{{asset('images/img/products/women-large.jpg')}}">
                        <h2>Women’s</h2>
                        <a href="#">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->

    <section class="deal-of-week set-bg spad" data-setbg="{{asset('images/img/time-bg.jpg')}}">
        <div class="container">
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
        </div>
    </section>

    @for($i = 0; $i< count($permissionUsers); $i++)
        @if($permissionUsers[0] != null)
            @if($permissionUsers[$i]->name == 'view_product_language')
                <section class="man-banner spad">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class=" filter-control d-flex justify-content-between">
                                    <ul class="ml-5">
                                        <li><img class="img border" width="60px" height="40px"
                                                 src="{{ asset('images/korea.png') }}" alt=""></li>
                                    </ul>
                                    <ul class="mr-5">
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
                            <div class="col-lg-2">
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="man-banner spad">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class=" filter-control d-flex justify-content-between">
                                    <ul class="ml-5">
                                        <li><img class="img border" width="60px" height="40px"
                                                 src="{{ asset('images/japan.webp') }}" alt=""></li>
                                    </ul>
                                    <ul class="mr-5">
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
                            <div class="col-lg-2">
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="man-banner spad">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class=" filter-control d-flex justify-content-between">
                                    <ul class="ml-5">
                                        <li><img class="img" width="60px" height="40px"
                                                 src="{{ asset('images/china.webp') }}"
                                                 alt=""></li>
                                    </ul>
                                    <ul class="mr-5">
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
                                                            {{--                                        <span>$35.00</span>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                                <div class="product-large set-bg m-large"
                                     data-setbg="{{asset('images/img/products/man-large.jpg')}}">
                                    <h2>Men’s</h2>
                                    <a href="#">Discover More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            @if($permissionUsers[$i]->name == 'view_all_blogs')
                <section class="latest-blog spad">
                    <div class="container">
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
                        <div class="benefit-items">
                            <div class="row">
                                <div class="col-lg-4">
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
                                <div class="col-lg-4">
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
                                <div class="col-lg-4">
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
                </section>
            @endif
        @endif
    @endfor
@endsection


