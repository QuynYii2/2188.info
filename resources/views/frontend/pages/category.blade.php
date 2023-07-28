@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    <div id="body-content">
    <div class="category-banner">
        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-banner-top-layout-2.jpg"
             alt="">
        <div class="category-name">
            ELECTRONICS
        </div>
    </div>
    <section class="section container-fluid">
        <div class="content">Jump to:</div>
        <div class="swiper CategoriesOne category-item">
            <div class="swiper-wrapper">
                @php
                    $listCate = DB::table('categories')->where('parent_id', null)->get();
                @endphp
                @foreach($listCate as $cate)
                    <div class="swiper-slide">
                        <a href="{{ route('category.show', $cate->id) }}">
                            <div class="img">
                                <img src="{{ asset('storage/' . $cate->thumbnail) }}"
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
    <div class="category-header align-items-center mt-4 mb-3 container-fluid d-flex justify-content-between">
        <div class="category-header--left">
            <a href="{{route('home')}}">Home</a> / <a href="#">Electronics</a>
        </div>
        <div class="category-header--right">
            <div class="show-item mr-4 align-items-center">
                <span class="mr-3">Show</span>
                <div class="dropdown">
                    <button class="drop btn dropdown-toggle" type="button" id="dropdownMenu2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">10 products per page</button>
                        <button class="dropdown-item" type="button">20 products per page</button>
                        <button class="dropdown-item" type="button">30 products per page</button>
                        <button class="dropdown-item" type="button">40 products per page</button>
                        <button class="dropdown-item" type="button">50 products per page</button>
                    </div>
                </div>
            </div>
            <div class="SortBy align-items-center mr-4">
                    <span class="mr-3">Sort By</span>
                    <div class="dropdown">
                        <button class="drop btn dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item" type="button">Featured Items</button>
                            <button class="dropdown-item" type="button">Newest Items</button>
                            <button class="dropdown-item" type="button">Best Selling</button>
                            <button class="dropdown-item" type="button">A to Z</button>
                            <button class="dropdown-item" type="button">Z to A</button>
                            <button class="dropdown-item" type="button">By Review</button>
                            <button class="dropdown-item" type="button">Price: Ascending</button>
                            <button class="dropdown-item" type="button">Price: Descending</button>
                        </div>
                    </div>

                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item layout-horizontal">
                        <a class="nav-link active" data-toggle="tab" href="#home"><i class="fa-solid fa-grip"></i></a>
                    </li>
                    <li class="nav-item layout-vertical">
                        <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fa-solid fa-list"></i></a>
                    </li>
                </ul>
        </div>
    </div>
    <hr>
    <div class="category-body container-fluid">
        <div class="row">
            <div class="col-xl-2 category-body-left">
                <div class="content">CATEGORIES</div>
                <div class="MenuContainer">
                    @foreach($listCate as $cate)
                        <div class="OptionContainer">
                            <div class="OptionHead">
                                <a class="item d-flex" href="{{ route('category.show', $cate->id) }}">{{ $cate->name }}</a>
                                <div>
                                    <svg onclick="ToggleOption(this)" style="cursor: pointer;"
                                         xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                         viewBox="0 0 30 30">
                                        <path d="M 24.990234 8.9863281 A 1.0001 1.0001 0 0 0 24.292969 9.2929688 L 15 18.585938 L 5.7070312 9.2929688 A 1.0001 1.0001 0 0 0 4.9902344 8.9902344 A 1.0001 1.0001 0 0 0 4.2929688 10.707031 L 14.292969 20.707031 A 1.0001 1.0001 0 0 0 15.707031 20.707031 L 25.707031 10.707031 A 1.0001 1.0001 0 0 0 24.990234 8.9863281 z"></path>
                                    </svg>
                                </div>
                            </div>
                            @if(!$listCate->isEmpty())
                                <div class="OptionBody">
                                    @php
                                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                                    @endphp
                                    @foreach($listChild as $child)
                                        <div class="OptionContainer">
                                            <div class="OptionHead">
                                                <a class="item d-flex"
                                                   href="{{ route('category.show', $child->id) }}">{{ $child->name }}</a>
                                                <div>
                                                    <svg onclick="ToggleOption(this)" style="cursor: pointer;"
                                                         xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                         height="20" viewBox="0 0 30 30">
                                                        <path d="M 24.990234 8.9863281 A 1.0001 1.0001 0 0 0 24.292969 9.2929688 L 15 18.585938 L 5.7070312 9.2929688 A 1.0001 1.0001 0 0 0 4.9902344 8.9902344 A 1.0001 1.0001 0 0 0 4.2929688 10.707031 L 14.292969 20.707031 A 1.0001 1.0001 0 0 0 15.707031 20.707031 L 25.707031 10.707031 A 1.0001 1.0001 0 0 0 24.990234 8.9863281 z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="OptionBody">
                                                @php
                                                    $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                                @endphp
                                                @foreach($listChild2 as $child2)
                                                    <div class="OptionContainer">
                                                        <div class="OptionHead">
                                                            <a class="item d-flex"
                                                               href="{{ route('category.show', $child2->id) }}">{{ $child2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="content">PRICE</div>
                <div class="category-price">
                    <div class="wrapper">
                        <div class="price-input d-flex">
                            <div class="field">
                                <span>Min</span>
                                <input type="number" class="input-min" value="2500">
                            </div>
                            <div class="separator">-</div>
                            <div class="field">
                                <span>Max</span>
                                <input type="number" class="input-max" value="7500">
                            </div>
                        </div>
                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                            <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="content">BRANDS</div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content col-xl-10">
                <div id="home" class="tab-pane active "><br>
                    <div class="row">
                        @foreach($listProduct as $product)
                            <div class="col-xl-3 col-md-4 col-6 section">
                                <div class="item">
                                    <div class="item-img">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                             alt="">
                                        <div class="button-view">
                                            <button>Quick view</button>
                                        </div>
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
                                            $namenewProduct = DB::table('users')->where('id', $product->user_id)->first();
                                        @endphp
                                        <div class="card-brand">
                                            {{$namenewProduct->name}}
                                        </div>
                                        <div class="card-title">
                                            <a href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>
                                        </div>
                                        <div class="card-price d-flex justify-content-between">
                                            <!-- <div class="price">
                                                            <strong>$189.000</strong>
                                                        </div> -->
                                            <div class="price-sale">
                                                <strong>${{ $product->price }}</strong>
                                            </div>
                                            <div class="price-cost">
                                                @if($product->old_price !=  null)
                                                    <strike>${{ $product->old_price }}</strike>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-bottom d-flex justify-content-between">
                                            <div class="card-bottom--left">
                                                <a href="{{route('detail_product.show', $product->id)}}">Choose Options</a>
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
                </div>
                <div id="menu1" class="tab-pane fade"><br>
                    @foreach($listProduct as $product)
                        <div class="mt-3 category-list section">
                        <div class="item row">
                            <div class="item-img col-md-3 col-5">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="">
                                <div class="button-view">
                                    <button>Quick view</button>
                                </div>
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
                            <div class="item-body col-md-9 col-7">
                                <div class="card-rating">
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                    <span>(1)</span>
                                </div>
                                @php
                                    $namenewProduct = DB::table('users')->where('id', $product->user_id)->first();
                                @endphp
                                <div class="card-brand">
                                    {{$namenewProduct->name}}
                                </div>
                                <div class="card-title-list">
                                    <a href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>
                                </div>
                                <div class="card-price d-flex">
                                    <!-- <div class="price">
                                                    <strong>$189.000</strong>
                                                </div> -->
                                    <div class="price-sale mr-4">
                                        <strong>${{ $product->price }}</strong>
                                    </div>
                                    <div class="price-cost">
                                        @if($product->old_price != null)
                                            <strike>${{ $product->old_price }}</strike>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-desc">
                                    {{ $product->description }}
                                </div>
                                <div class="card-bottom d-flex mt-3">
                                    <div class="card-bottom--left mr-4">
                                        <a href="{{route('detail_product.show', $product->id)}}">Choose Options</a>
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
                </div>
        </div>
    </div>
    </div>
{{--    <div class="container">--}}
{{--        <div id="header-carousel" class="carousel slide carousel-fade desktop-button" data-ride="carousel">--}}
{{--            <ol class="carousel-indicators">--}}
{{--                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>--}}
{{--                <li data-target="#header-carousel" data-slide-to="1"></li>--}}
{{--                <li data-target="#header-carousel" data-slide-to="2"></li>--}}
{{--            </ol>--}}
{{--            <div class="carousel-inner">--}}
{{--                <div class="carousel-item position-relative active" style="height: 450px;">--}}
{{--                    <img class="position-absolute w-100 h-100 img" src="{{ asset('images//carousel-1.jpg') }}"--}}
{{--                         style="object-fit: cover;">--}}
{{--                </div>--}}
{{--                <div class="carousel-item position-relative" style="height: 450px;">--}}
{{--                    <img class=" img position-absolute w-100 h-100" src="{{ asset('images//carousel-2.jpg') }}"--}}
{{--                         style="object-fit: cover;">--}}
{{--                </div>--}}
{{--                <div class="carousel-item position-relative" style="height: 450px;">--}}
{{--                    <img class="img position-absolute w-100 h-100" src="{{ asset('images//carousel-3.jpg') }}"--}}
{{--                         style="object-fit: cover;">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--                <div class="bg-white mt-3 only-desktop">--}}
{{--                    <h3 class="ml-3">{{ __('home.brands') }}</h3>--}}
{{--                    <table class="table table-bordered ">--}}

{{--                        <tr>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-8.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/cat-2.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/cat-3.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/cat-4.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/cat-1.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-2.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}

{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-3.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-4.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-1.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-5.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle img">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-6.jpg')}}"--}}
{{--                                            class="w-100"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="col-2 align-middle">--}}
{{--                                <a href="#!">--}}
{{--                                    <img--}}
{{--                                            src="{{asset('images/vendor-7.jpg')}}"--}}
{{--                                            class="w-100 img"--}}
{{--                                    />--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--    </div>--}}
{{--    <div class="container mt-5">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3 col-4">--}}
{{--                <div class="card mb-5">--}}
{{--                    <div class='wrapper'>--}}
{{--                        <ul class='items p-2'>--}}
{{--                            <li>--}}
{{--                                <h4>Màu sắc</h4>--}}
{{--                            @php--}}
{{--                                $listProperties = DB::table('properties')->get();--}}
{{--                            @endphp--}}
{{--                            @foreach($listProperties as $propertie)--}}
{{--                                <li>--}}
{{--                                    <input id="check{{ $propertie->id }}" type="checkbox"/>--}}
{{--                                    <label style="text-indent: 0px"--}}
{{--                                           for="check{{ $propertie->id }}">{{ $propertie->name }}</label>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        <ul class='items p-2'>--}}
{{--                            <h4>{{ __('home.brands') }}</h4>--}}
{{--                            <li>--}}
{{--                                <input id="box1" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box1">Mercedes</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box2" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box2">Toyota</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box3" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box3">Mitsubishi</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box4" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box4">Honda</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box5" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box5">Nissan</label>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <ul class='items p-2'>--}}
{{--                            <li>--}}
{{--                                <h4>Khoảng giá</h4>--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="wrapper">--}}
{{--                                        <div class="price-input">--}}
{{--                                            <div class="field">--}}
{{--                                                <span style="font-size: 16px">Min</span>--}}
{{--                                                <input type="number" class="input-min" value="2500">--}}
{{--                                            </div>--}}
{{--                                            <div class="separator">-</div>--}}
{{--                                            <div class="field">--}}
{{--                                                <span style="font-size: 16px">Max</span>--}}
{{--                                                <input type="number" class="input-max" value="7500">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="slider">--}}
{{--                                            <div class="progress"></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="range-input">--}}
{{--                                            <input type="range" class="range-min" min="0" max="10000" value="2500"--}}
{{--                                                   step="100">--}}
{{--                                            <input type="range" class="range-max" min="0" max="10000" value="7500"--}}
{{--                                                   step="100">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <ul class='items p-2'>--}}
{{--                            <li>--}}
{{--                                <h4>Kích thước</h4>--}}
{{--                            <li>--}}
{{--                                <input id="box10" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box10">XS</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box11" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box11">SM</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box12" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box12">LG</label>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <input id="box13" type="checkbox"/>--}}
{{--                                <label style="text-indent: 0px" for="box13">XXL</label>--}}
{{--                            </li>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

{{--                </div>--}}


{{--            </div>--}}

{{--            <div class="col-md-9 col-8">--}}
{{--                <header class="border-bottom mb-4 pb-3 ">--}}
{{--                    <div class="form-inline">--}}
{{--                        <span class="mr-md-auto">{{$listProduct->total()}} {{ __('home.items found') }}</span>--}}
{{--                        <select class="form-control">--}}
{{--                            <option>{{ __('home.latest items') }}</option>--}}
{{--                            <option>{{ __('home.trending') }}</option>--}}
{{--                            <option>{{ __('home.most popular') }}</option>--}}
{{--                            <option>{{ __('home.cheapest') }}</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </header>--}}

{{--                <div class="row py-2">--}}
{{--                    @foreach($listProduct as $product)--}}
{{--                        <div class="col-md-4 col-sm-6 col-12 rounded product-map">--}}
{{--                            <div class="product-item bg-light rounded ">--}}
{{--                                <div class="product-img position-relative overflow-hidden rounded">--}}
{{--                                    <img class=" height-img w-100 img"--}}
{{--                                         src="{{ asset('storage/' . $product->thumbnail) }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="text-center py-4 text-limit">--}}
{{--                                    <a class="h6 text-decoration-none text-truncate tabs-product-detail"--}}
{{--                                       href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>--}}
{{--                                    <div class="d-flex align-items-center justify-content-center mt-2">--}}
{{--                                        <h5 class="text-danger">${{ $product->price }}</h5><h6--}}
{{--                                                class="text-muted ml-2"></h6>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <nav class="mt-4 mb-5 d-flex justify-content-center" aria-label="Page navigation sample">--}}
{{--                    <ul class="pagination">--}}
{{--                        @foreach($listProduct->links()->elements[0] as $index => $page)--}}
{{--                            <li class="page-item"><a class="page-link" href="{{ $page }}">{{ $index }}</a></li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </nav>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function responsiveTable(y) {
            let tabs = document.getElementsByClassName('product-map');
            var i;
            for (i = 0; i < tabs.length; i++) {
                if (y.matches) {
                    tabs[i].classList.remove("col-md-4");
                    tabs[i].classList.add("col-sm-6");
                }
            }
        }

        var y = window.matchMedia("(max-width: 991px)")
        responsiveTable(y);
        y.addListener(responsiveTable)

        function myFunciton(x) {
            //filter-content
            let tabs = document.getElementsByClassName('toggle-link');
            let items = document.getElementsByClassName('filter-content');
            var i;
            for (i = 0; i < tabs.length; i++) {
                if (x.matches) {
                    tabs[i].classList.add("collapsed");
                    tabs[i].setAttribute('aria-expanded', 'false');
                    items[i].classList.remove("show");
                    items[i].classList.add("in");
                    console.log('a')
                }
            }
        }

        var x = window.matchMedia("(max-width: 767px)")
        myFunciton(x);
        x.addListener(myFunciton)


        $(".items > li > a").click(function (e) {
            e.preventDefault();
            var $this = $(this);
            if ($this.hasClass("expanded")) {
                $this.removeClass("expanded");
            } else {
                $(".items a.expanded").removeClass("expanded");
                $this.addClass("expanded");
                $(".sub-items").filter(":visible").slideUp("normal");
            }
            $this.parent().children("ul").stop(true, true).slideToggle("normal");
        });

        $(".sub-items a").click(function () {
            $(".sub-items a").removeClass("current");
            $(this).addClass("current");
        });


        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [130, 250],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        });

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });

    </script>
@endsection
