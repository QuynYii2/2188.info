@extends('frontend.layouts.master')

@section('title', 'Home page')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <!-- Carousel Start -->
    <div style="height: 30px" class="text-center-x-y">{{ __('home.all categories') }}</div>
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-3">
                <div class="row">
                    <div class="">
                        <div class="nav-item dropdown" id="fixMenu">
                            <button class="btn bg-white w-100 dropdown-toggle-split" type="button"
                                    data-toggle="dropdown"
                                    aria-expanded="true">
                                {{ __('home.category') }}
                            </button>
                            <ul class="dropdown-menu show" id="dropdown">
                                @foreach($categories as $category)
                                    <li>
                                        <a class="dropdown-item" href="/category/{{ $category->id }}">
                                            {{ $category->name }}
                                            @if($category->children->count() > 0)
                                                &raquo;
                                            @endif
                                        </a>
                                        @if($category->children->count() > 0)
                                            <ul class="submenu dropdown-menu">
                                                @foreach ($category->children as $subcategory)
                                                    <li>
                                                        <a class="dropdown-item" href="/category/{{ $subcategory->id }}">
                                                            {{ $subcategory->name }}
                                                            @if($subcategory->children->count() > 0)
                                                                &raquo;
                                                            @endif
                                                        </a>
                                                        @if($subcategory->children->count() > 0)
                                                            @include('frontend.layouts.partials.subcategories', ['subcategories' => $subcategory->children])
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6" style="padding: 0">
                <div id="header-carousel" class="carousel slide carousel-fade " data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 450px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('images//carousel-1.jpg') }}"
                                 style="object-fit: cover;">
                        </div>
                        <div class="carousel-item position-relative" style="height: 450px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('images//carousel-2.jpg') }}"
                                 style="object-fit: cover;">
                        </div>
                        <div class="carousel-item position-relative" style="height: 450px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('images//carousel-3.jpg') }}"
                                 style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="padding: 0">
                <div class="product-offer " style="height: 150px;">
                    <img class="img-fluid" src="{{ asset('images//offer-1.jpg') }}" alt="">
                </div>
                <div class="product-offer " style="height: 100px;">
                    <img class="img-fluid" src="{{ asset('images//product-3.jpg') }}" alt="">
                </div>
                <div class="product-offer " style="height: 200px;">
                    <img class="img-fluid" src="{{ asset('images//offer-2.jpg') }}" alt="">
                </div>
            </div>
        </div>
        <p class="text-center mt-3">{{ __('home.recommended new products') }}</p>
    </div>
    <!-- Carousel End -->

    <!-- Products Start -->
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-md-2">
                <div class="row ">
                    <div class="col-md-11">
                        <div class="pb-2">
                            <div class="product-item bg-light border-product">
                                <div class="text-center-x-y height-side">
                                    <h4>
                                        {{ __('home.logistics champion') }}
                                        <br>
                                        <br>
                                        {{ __('home.international logistics co') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-1.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="/detail/1">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row py-2">
                    @foreach ($productByLocal as $product)
                        <div class="col-auto rounded">
                            <div class="product-item bg-light rounded ">
                                <div class="product-img position-relative overflow-hidden rounded">
                                    <img class=" height-img w-100" src="{{ $product->thumbnail }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-sync-alt"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4 text-limit">
                                    <a class="h6 text-decoration-none text-truncate" id="link-product" href="/detail/{{ $product->id }}">{{ $product->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ convertCurrency($product->price, $countryCode) }}
                                        </h5><h6 class="text-muted ml-2"></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-2">
                <div class="row ">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="pb-2">
                            <div class="product-item bg-light border-product">
                                <div class="text-center-x-y height-side">
                                    <h4 style="line-height: 50px; ">
                                        {{ __('home.online shopping center') }}
                                        <br>
                                        {{ __('home.settled') }}
                                        <br>
                                        {{ __('home.sales') }}
                                        <br>
                                        {{ __('home.management') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-1.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white">
        <div class="row">
            <div class="col-md-2">
                <div class="row pb-2">
                    <div class="col-md-11 ">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-1.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-2.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row py-2">
                    <div class="col-auto">

                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class="custom-flag"
                                     src="{{ asset('images/china.webp') }}"
                                     alt="">
                                <img class=" height-img w-100" src="{{ asset('images/product-3.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-4.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-7.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-6.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-5.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-auto">

                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-3.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-4.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-7.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-6.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-5.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="row pb-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-8.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-9.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="row pb-2">
                    <div class="col-md-11 ">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-1.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-2.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row py-2">
                    <div class="col-auto">

                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class="custom-flag"
                                     src="{{ asset('images/japan.webp') }}"
                                     alt="">
                                <img class=" height-img w-100" src="{{ asset('images/product-3.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-4.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-7.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-6.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-5.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-auto">

                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-3.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-4.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-7.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-6.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-5.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="row pb-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-8.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-9.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="row pb-2">
                    <div class="col-md-11 ">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-1.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('images/product-2.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes
                                    123123123Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row py-2">
                    <div class="col-auto">

                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class="custom-flag"
                                     src="{{ asset('images/vietnam.webp') }}"
                                     alt="">
                                <img class=" height-img w-100" src="{{ asset('images/product-3.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-4.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-7.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-6.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-5.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-auto">

                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-3.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-4.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-7.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-6.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="product-item bg-light rounded ">
                            <div class="product-img position-relative overflow-hidden rounded">
                                <img class=" height-img w-100" src="{{ asset('images/product-5.jpg') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="row pb-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-8.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-md-1"></div>
                    <div class="col-md-11">
                        <div class="product-item bg-light border-product">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 " src="{{ asset('images/product-9.jpg') }}"
                                     alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4 text-limit">
                                <a class="h6 text-decoration-none text-truncate" href="">123Product1231 Name Goes
                                    Here</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$123.00</h5><h6 class="text-muted ml-2"></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Products End -->
@endsection

