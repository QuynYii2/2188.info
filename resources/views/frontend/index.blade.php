@extends('frontend.layouts.master')

@section('title', 'Home page')

@section('content')
    <style>
        .col-lg-6.item.item-left.text-center:first-child a:before {
            display: block;
            content: '';
            background-image: url("https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/w/sport-icon__06672.original.jpg");
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;

        }

        .col-lg-6.item.item-left.text-center:nth-child(2) > a:before {
            display: block;
            content: '';
            background-image: url("https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/o/apparel-icon__20228.original.jpg");
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(3) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/y/accessories-icon__74809.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(4) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/u/materials-icon__11291.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(5) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/y/machinery-icon__72700.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(6) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/l/bread-icon__67993.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(7) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/u/furniture-icon__64784.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(8) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/j/lights-lighting-icon__35198.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(9) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/z/baby-bottle-icon__56241.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(10) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/j/garden-shears-icon__28465.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        .col-lg-6.item.item-left.text-center:nth-child(11) > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/l/lipstick-icon__92847.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }

        col-lg-6.item.item-left.text-center:last-child > a:before {
            display: block;
            content: '';
            background-image: url('https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/original/d/gifts-crafts-icon__77933.original.jpg');
            width: 50px;
            height: 50px;
            position: relative;
            margin: -15px 50px;
            background-size: 22px;
            background-repeat: no-repeat;
        }
    </style>

    <div class="body" id="body-content">
        <section class="section-First pt-3 pb-3 container-fluid">
            <div class="row m-0">
                <div class="section-First-left section-First-hd col-xl-2 col-12">
                    <span class="content">{{ __('home.SHOP BY CATEGORIES') }}</span>
                    <hr>
                    <div class="row list">
                        @php
                            $listCate = DB::table('categories')->where('parent_id', null)->get();
                        @endphp
                        @if(count($listCate)>10)
                            @for($i =0; $i <10; $i ++)
                                <div class="col-lg-6 item item-left text-center">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $listCate[$i]->id) }}">
                                            {{--                                            <img class="icon_i" alt="">--}}
                                            <div class="text">{{ $listCate[$i]->name }}</div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            {{--                                                <img class="icon_i" alt="">--}}
                                            <div class="text">{{ $listCate[$i]->name }}</div>
                                        </a>
                                    @endif
                                </div>
                            @endfor
                        @else
                            @foreach($listCate as $cate)
                                <div class="col-lg-6 item item-left text-center">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">
                                            {{--                                            <img class="icon_i" alt="">--}}
                                            <div class="text">{{ $cate->name }}</div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            {{--                                            <img class="icon_i" alt="">--}}
                                            <div class="text">{{ $cate->name }}</div>
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="section-First-left section-First-mobile col-12">
                    <span class="content">SHOP BY CATEGORIES</span>
                    <hr>
                    <div class="list d-flex">
                        @php
                            $listCate = DB::table('categories')->where('parent_id', null)->get();
                        @endphp
                        @foreach($listCate as $cate)
                            <div class="item item-left text-center">
                                @if(Auth::check())
                                    <a href="{{ route('category.show', $cate->id) }}">
                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                             alt="">
                                        <div class="text">{{ $cate->name }}</div>
                                    </a>
                                @else
                                    <a class="check_url">
                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                             alt="">
                                        <div class="text">{{ $cate->name }}</div>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="section-First-middle col-xl-6 col-md-8 col-12">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">

                        <div class="swiper-wrapper">
                            @if(!$banner)
                                <div class="swiper-slide">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/742w/carousel/17/slideshow-home2-1.jpg?c=1"
                                         alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/18/slideshow-home2-2.jpg?c=1"
                                         alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/740w/carousel/19/slideshow-home2-3.jpg?c=1"
                                         alt="">
                                </div>
                            @else
                                @php
                                    $listBanner = $banner->thumbnails;
                                    $arrayThumbnails = explode(',', $listBanner);
                                @endphp
                                @foreach($arrayThumbnails as $bannerdemo)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $bannerdemo) }}" alt="">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="section-First-right col-xl-4 col-md-4">
                    <div class="row">
                        @if(!$banner)
                            <div class="col-6 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                     alt="">
                            </div>
                            <div class="col-6 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-2.png"
                                     alt="">
                            </div>
                            <div class="col-6 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-3.png"
                                     alt="">
                            </div>
                            <div class="col-6 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-4.png"
                                     alt="">
                            </div>
                        @else
                            @php
                                $sub_List = $banner->sub_thumbnails;
                                $sub_thumbnail = explode(',', $sub_List);
                            @endphp
                            @if(count($sub_thumbnail)>4)
                                @for($i=0; $i<4; $i++)
                                    <div class="col-6 item">
                                        <img src="{{ asset('storage/' . $sub_thumbnail[$i]) }}"
                                             alt="">
                                    </div>
                                @endfor
                            @else
                                @foreach($sub_thumbnail as $bannerSub)
                                    <div class="col-6 item">
                                        <img src="{{ asset('storage/' . $bannerSub) }}" alt="">
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="section-Second pt-3 pb-3 container-fluid text-center">
            <img src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/banner-custom-home-2.png"
                 alt="">
        </section>
                <section class="section-Third section container-fluid">
                    <div class="content">{{ __('home.SHOP BY CATEGORIES') }}</div>
                    <div class="swiper Categories category-item">
                        <div class="swiper-wrapper">
                            @php
                                $listCate = DB::table('categories')->where('parent_id', null)->get();
                            @endphp

                            @foreach($listCate as $cate)
                                <div class="swiper-slide">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">
                                            <div class="img">
                                                <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                                     alt="">
                                            </div>
                                            <div class="text">
                                                {{$cate->name}}
                                            </div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            <div class="img">
                                                <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                                     alt="">
                                            </div>
                                            <div class="text">
                                                {{$cate->name}}
                                            </div>
                                        </a>
                                    @endif
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
                    <div class="content">{{ __('home.New Products') }}</div>
                    <div class="swiper NewProducts">
                        <div class="swiper-wrapper">
                            @foreach($newProducts as $newProduct)
                                @php
                                    $productDetail = \App\Models\Variation::where('product_id', $newProduct->id)->first();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item">
                                        @if($newProduct->thumbnail)
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $newProduct->thumbnail) }}" alt="">
                                                <div class="button-view">
                                                    <button type="button" class="btn view_modal" data-toggle="modal"
                                                            data-value="{{$newProduct}}" data-id="{{$productDetail}}"
                                                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                </div>
                                                <div class="text">
                                                    <div class="text-new">
                                                        New
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
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
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $newProduct->id)}}">{{$newProduct->name}}</a>
                                                @else
                                                    <a class="check_url">{{$newProduct->name}}</a>
                                                @endif

                                            </div>

                                            @if($newProduct->price)
                                                <div class="card-price d-flex justify-content-between">
                                                    @if($newProduct->price != null)
                                                        <div class="price-sale">
                                                            <strong>${{$newProduct->price}}</strong>
                                                        </div>
                                                        <div class="price-cost">
                                                            <strike>${{$newProduct->old_price}}</strike>
                                                        </div>
                                                    @else
                                                        <div class="price-sale">
                                                            <strong>${{$newProduct->old_price}}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $newProduct->id)}}">{{ __('home.Choose Options') }}</a>
                                                    @else
                                                        <a class="check_url">Choose Options</a>
                                                    @endif
                                                </div>
                                                <div class="card-bottom--right" id-product="{{$newProduct->id}}">
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
                    <div class="content">{{ __('home.Featured Products') }}</div>
                    <div class="swiper FeaturedProducts">
                        <div class="swiper-wrapper">
                            @foreach($productFeatures as $productFeature)
                                @foreach($productFeature as $product)
                                    @php
                                        $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                    @endphp
                                    <div class="swiper-slide">
                                        <div class="item">
                                            @if($product->thumbnail)
                                                <div class="item-img">
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                                                    <div class="button-view">
                                                        <button type="button" class="btn view_modal" data-toggle="modal"
                                                                data-value="{{$product}}" data-id="{{$productDetail}}"
                                                                data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                    </div>
                                                    <div class="text">
                                                        <div class="text-new">
                                                            New
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
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
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                    @else
                                                        <a class="check_url">{{$product->name}}</a>
                                                    @endif
                                                </div>
                                                @if($product->price)
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
                                                @endif
                                                <div class="card-bottom d-flex justify-content-between">
                                                    <div class="card-bottom--left">
                                                        @if(Auth::check())
                                                            <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                        @else
                                                            <a class="check_url">Choose Options</a>
                                                        @endif
                                                    </div>
                                                    <div class="card-bottom--right " id-product="{{$newProduct->id}}">
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
        <div class="modal fade detail" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @php
                        $name = DB::table('users')->where('id', $product->user_id)->first();
                        $productDetails = \App\Models\Variation::where('product_id', $product->id)->get();
                        $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                        $attributes = DB::table('product_attribute')->where([['product_id', $product->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
                    @endphp
                    <div class="modal-body">
                        <div class="grid product">
                            <div class="column-xs-12 column-md-6">
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
                            <div class="column-xs-12 column-md-6">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <div class="product-name">{{$name->name}}</div>
                                    <div class="product-title">{{$product->name}}</div>
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
                                                    $att = \App\Models\Attribute::find($attribute->attribute_id);
                                                    $properties_id = $attribute->value;
                                                    $arrayAtt = array();
                                                    $arrayAtt = explode(',', $properties_id);
                                                @endphp
                                                <div class="col-sm-6 col-6">
                                                    <label>{{$att->name}}</label>
                                                    <div class="radio-toolbar mt-3">
                                                        @foreach($arrayAtt as $data)
                                                            @php
                                                                $property = \App\Models\Properties::find($data);
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
        <section class="section-Fifth section pt-3 pb-3 container-fluid">
            <div class="content"><i class="fa-solid fa-fire-flame-curved"></i>{{ __('home.Hot Deals') }}</div>
            <div class="swiper HotDeals">
                <div class="swiper-wrapper">
                    @foreach($productHots as $productHot)
                        @foreach($productHot as $hotProduct)
                            @php
                                $productDetail = \App\Models\Variation::where('product_id', $hotProduct->id)->first();
                            @endphp
                            <div class="swiper-slide">
                                <div class="item">
                                    <div class="item-img">
                                        <img src="{{ asset('storage/' . $hotProduct->thumbnail) }}" alt="">
                                        <div class="button-view">
                                            <button type="button" class="btn view_modal" data-toggle="modal"
                                                    data-value="{{$hotProduct}}" data-id="{{$productDetail}}"
                                                    data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                        </div>
                                        <div class="text">
                                            <div class="text-new">
                                                New
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
                                            $nameHot = DB::table('users')->where('id', $hotProduct->user_id)->first();
                                        @endphp
                                        <div class="card-brand">
                                            {{$nameHot->name}}
                                        </div>
                                        <div class="card-title">
                                            @if(Auth::check())
                                                <a href="{{route('detail_product.show', $hotProduct->id)}}">{{$hotProduct->name}}</a>
                                            @else
                                                <a class="check_url">{{$hotProduct->name}}</a>
                                            @endif
                                        </div>

                                        @if($hotProduct->price)
                                            <div class="card-price d-flex justify-content-between">
                                                @if($hotProduct->price != null)
                                                    <div class="price-sale">
                                                        <strong>${{$hotProduct->price}}</strong>
                                                    </div>
                                                    <div class="price-cost">
                                                        <strike>${{$hotProduct->old_price}}</strike>
                                                    </div>
                                                @else
                                                    <div class="price-sale">
                                                        <strong>${{$hotProduct->old_price}}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="card-bottom d-flex justify-content-between">
                                            <div class="card-bottom--left">
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                @else
                                                    <a class="check_url">{{ __('home.Choose Options') }}</a>
                                                @endif
                                            </div>
                                            <div class="card-bottom--right " id-product="{{$newProduct->id}}">
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
        </section>
        {{--        <section class="section-Sixth section pt-3 pb-3 container-fluid">--}}
        {{--            <div class="content">{{ __('home.Top Brands') }}</div>--}}
        {{--            <div class="swiper TopBrands">--}}
        {{--                <div class="swiper-wrapper">--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="swiper-slide">--}}
        {{--                        <div class="brand">--}}
        {{--                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/brand3.png"--}}
        {{--                                 alt="">--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="swiper-button-next"></div>--}}
        {{--                <div class="swiper-button-prev"></div>--}}
        {{--            </div>--}}
        {{--        </section>--}}

        {{--        @php--}}
        {{--            $listCate = DB::table('categories')->where('parent_id', null)->get();--}}
        {{--        @endphp--}}
        {{--        @if(!$listCate->isEmpty())--}}
        {{--            @foreach($listCate as $cate)--}}



{{-- Danh Mục Đã Chọn --}}
        <section class="section pt-3 pb-3 container-fluid">
            <div class="content"></div>
            <div class="row">
                <div class="col-md-3 col-xl-2 section-left">
                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/products-block-banner-left-2.jpg"
                         alt="">
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <div class="swiper listProduct">
                        <div class="swiper-wrapper">
                            @php
                                $products = \App\Models\Product::where([['location','=','vi'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item">
                                        @if($product->thumbnail)
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                     alt="">
                                                <div class="button-view">
                                                    <button type="button" class="btn view_modal"
                                                            data-toggle="modal"
                                                            data-value="{{$product}}"
                                                            data-id="{{$productDetail}}"
                                                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                </div>
                                                <div class="text">
                                                    <div class="text-new">
                                                        New
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="item-body">
                                            <div class="card-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                @endfor
                                                <span>(1)</span>
                                            </div>
                                            @php
                                                $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{$nameUser->name}}
                                            </div>
                                            <div class="card-title">
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                @else
                                                    <a class="check_url">{{$product->name}}</a>
                                                @endif
                                            </div>
                                            @if($product->price)
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
                                            @endif
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                    @else
                                                        <a class="check_url">Choose Options</a>
                                                    @endif
                                                </div>
                                                <div class="card-bottom--right " id-product="{{$newProduct->id}}">
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
                @if(!$listCate->isEmpty())
                    @php
                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                    @endphp
                    <div class="col-xl-2 category-right">
                        @if(count($listChild) == 0)
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @else
                            @if(count($listChild) < 3)
                                @foreach($listChild as $child)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $child->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $child->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $listChild[$i]->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $listChild[$i]->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
        <section class="section pt-3 pb-3 container-fluid">
            <div class="product-banner">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images2.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                </div>
            </div>
        </section>
{{-- Việt Nam --}}
        <section class="section pt-3 pb-3 container-fluid">
            <div class="content">Việt Nam</div>
            <div class="row">
                <div class="col-md-3 col-xl-2 section-left">
                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/products-block-banner-left-2.jpg"
                         alt="">
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <div class="swiper listProduct">
                        <div class="swiper-wrapper">
                            @php
                                $products = \App\Models\Product::where([['location','=','vi'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item">
                                        @if($product->thumbnail)
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                     alt="">
                                                <div class="button-view">
                                                    <button type="button" class="btn view_modal"
                                                            data-toggle="modal"
                                                            data-value="{{$product}}"
                                                            data-id="{{$productDetail}}"
                                                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                </div>
                                                <div class="text">
                                                    <div class="text-new">
                                                        New
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="item-body">
                                            <div class="card-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                @endfor
                                                <span>(1)</span>
                                            </div>
                                            @php
                                                $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{$nameUser->name}}
                                            </div>
                                            <div class="card-title">
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                @else
                                                    <a class="check_url">{{$product->name}}</a>
                                                @endif
                                            </div>
                                            @if($product->price)
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
                                            @endif
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                    @else
                                                        <a class="check_url">Choose Options</a>
                                                    @endif
                                                </div>
                                                <div class="card-bottom--right " id-product="{{$newProduct->id}}">
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
                @if(!$listCate->isEmpty())
                    @php
                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                    @endphp
                    <div class="col-xl-2 category-right">
                        @if(count($listChild) == 0)
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @else
                            @if(count($listChild) < 3)
                                @foreach($listChild as $child)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $child->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $child->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $listChild[$i]->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $listChild[$i]->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
        <section class="section pt-3 pb-3 container-fluid">
            <div class="product-banner">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images2.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                </div>
            </div>
        </section>
{{-- Hàn Quốc --}}
        <section class="section pt-3 pb-3 container-fluid">
            <div class="content">Hàn Quốc</div>
            <div class="row">
                <div class="col-md-3 col-xl-2 section-left">
                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/products-block-banner-left-2.jpg"
                         alt="">
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <div class="swiper listProduct">
                        <div class="swiper-wrapper">
                            @php
                                $products = \App\Models\Product::where([['location','=','kr'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item">
                                        @if($product->thumbnail)
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                     alt="">
                                                <div class="button-view">
                                                    <button type="button" class="btn view_modal"
                                                            data-toggle="modal"
                                                            data-value="{{$product}}"
                                                            data-id="{{$productDetail}}"
                                                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                </div>
                                                <div class="text">
                                                    <div class="text-new">
                                                        New
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="item-body">
                                            <div class="card-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                @endfor
                                                <span>(1)</span>
                                            </div>
                                            @php
                                                $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{$nameUser->name}}
                                            </div>
                                            <div class="card-title">
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                @else
                                                    <a class="check_url">{{$product->name}}</a>
                                                @endif
                                            </div>
                                            @if($product->price)
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
                                            @endif
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                    @else
                                                        <a class="check_url">Choose Options</a>
                                                    @endif
                                                </div>
                                                <div class="card-bottom--right " id-product="{{$newProduct->id}}">
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
                @if(!$listCate->isEmpty())
                    @php
                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                    @endphp
                    <div class="col-xl-2 category-right">
                        @if(count($listChild) == 0)
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @else
                            @if(count($listChild) < 3)
                                @foreach($listChild as $child)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $child->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $child->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $listChild[$i]->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $listChild[$i]->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
        <section class="section pt-3 pb-3 container-fluid">
            <div class="product-banner">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images2.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                </div>
            </div>
        </section>
{{-- Trung Quốc --}}
        <section class="section pt-3 pb-3 container-fluid">

            <div class="content">Trung Quốc</div>
            <div class="row">
                <div class="col-md-3 col-xl-2 section-left">
                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/products-block-banner-left-2.jpg"
                         alt="">
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <div class="swiper listProduct">
                        <div class="swiper-wrapper">
                            @php
                                $products = \App\Models\Product::where([['location','=','cn'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item">
                                        @if($product->thumbnail)
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                     alt="">
                                                <div class="button-view">
                                                    <button type="button" class="btn view_modal"
                                                            data-toggle="modal"
                                                            data-value="{{$product}}"
                                                            data-id="{{$productDetail}}"
                                                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                </div>
                                                <div class="text">
                                                    <div class="text-new">
                                                        New
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="item-body">
                                            <div class="card-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                @endfor
                                                <span>(1)</span>
                                            </div>
                                            @php
                                                $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{$nameUser->name}}
                                            </div>
                                            <div class="card-title">
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                @else
                                                    <a class="check_url">{{$product->name}}</a>
                                                @endif
                                            </div>
                                            @if($product->price)
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
                                            @endif
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                    @else
                                                        <a class="check_url">Choose Options</a>
                                                    @endif
                                                </div>
                                                <div class="card-bottom--right " id-product="{{$newProduct->id}}">
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
                @if(!$listCate->isEmpty())
                    @php
                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                    @endphp
                    <div class="col-xl-2 category-right">
                        @if(count($listChild) == 0)
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @else
                            @if(count($listChild) < 3)
                                @foreach($listChild as $child)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $child->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $child->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $listChild[$i]->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $listChild[$i]->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
        <section class="section pt-3 pb-3 container-fluid">
            <div class="product-banner">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images2.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                </div>
            </div>
        </section>
{{-- Nhật Bản --}}
        <section class="section pt-3 pb-3 container-fluid">
            <div class="content">Nhật Bản</div>
            <div class="row">
                <div class="col-md-3 col-xl-2 section-left">
                    <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/products-block-banner-left-2.jpg"
                         alt="">
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <div class="swiper listProduct">
                        <div class="swiper-wrapper">
                            @php
                                $products = \App\Models\Product::where([['location','=','jp'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                            @endphp
                            @foreach($products as $product)
                                @php
                                    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                @endphp
                                <div class="swiper-slide">
                                    <div class="item">
                                        @if($product->thumbnail)
                                            <div class="item-img">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                     alt="">
                                                <div class="button-view">
                                                    <button type="button" class="btn view_modal"
                                                            data-toggle="modal"
                                                            data-value="{{$product}}"
                                                            data-id="{{$productDetail}}"
                                                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                                </div>
                                                <div class="text">
                                                    <div class="text-new">
                                                        New
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="item-body">
                                            <div class="card-rating">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                @endfor
                                                <span>(1)</span>
                                            </div>
                                            @php
                                                $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{$nameUser->name}}
                                            </div>
                                            <div class="card-title">
                                                @if(Auth::check())
                                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                @else
                                                    <a class="check_url">{{$product->name}}</a>
                                                @endif
                                            </div>
                                            @if($product->price)
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
                                            @endif
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    @if(Auth::check())
                                                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                                    @else
                                                        <a class="check_url">Choose Options</a>
                                                    @endif
                                                </div>
                                                <div class="card-bottom--right" id-product="{{$newProduct->id}}">
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
                @if(!$listCate->isEmpty())
                    @php
                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                    @endphp
                    <div class="col-xl-2 category-right">
                        @if(count($listChild) == 0)
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @else
                            @if(count($listChild) < 3)
                                @foreach($listChild as $child)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $child->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $child->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <div class="brand-item d-flex justify-content-between">
                                        <div class="brand-item-text">
                                            <div class="name">{{ $listChild[$i]->name }}</div>
                                            @if(Auth::check())
                                                <a href="{{ route('category.show', $listChild[$i]->id) }}">{{ __('home.shop now') }}</a>
                                            @else
                                                <a class="check_url">{{ __('home.shop now') }}</a>
                                            @endif
                                        </div>
                                        <div class="brand-item-img">
                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/images/stencil/70x70/q/for-men__79756.original.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="brand-item d-flex justify-content-between">
                                <div class="brand-item--all">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">{{ __('home.View all categories') }}</a>
                                    @else
                                        <a class="check_url">View all categories</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
        <section class="section pt-3 pb-3 container-fluid">
            <div class="product-banner">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images2.jpg"
                             alt="">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/banner-two-images1.jpg"
                             alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section-Seven ">
            <div class="container-fluid">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum
                    interdum, nisi lorem egestas vitae scel
                    <span id="dots">...</span>
                    <span id="more">
                    erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa.
                    Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac.
                    In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis.
                    Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.
                </span>
                </p>
                <button onclick="myFunction()" id="myBtn">{{ __('home.Show More') }}</button>
            </div>
        </section>
        <section class="section-Eight">
            <img class="img"
                 src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/bg-with-us2.jpg" alt="">
            <div class="section-content">
                <div class="content">
                    Why shop with us?
                </div>
                <div class="list d-flex">
                    <div class="item">
                        <div class="item-img">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/icon-with-us1.png"
                                 alt="">
                        </div>
                        <div class="item-content">
                            QUALITY AND SAVING
                        </div>
                        <div class="item-text">
                            Comprehensive quality control and affordable prices
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/icon-with-us1.png"
                                 alt="">
                        </div>
                        <div class="item-content">
                            QUALITY AND SAVING
                        </div>
                        <div class="item-text">
                            Comprehensive quality control and affordable prices
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/icon-with-us1.png"
                                 alt="">
                        </div>
                        <div class="item-content">
                            QUALITY AND SAVING
                        </div>
                        <div class="item-text">
                            Comprehensive quality control and affordable prices
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/icon-with-us1.png"
                                 alt="">
                        </div>
                        <div class="item-content">
                            QUALITY AND SAVING
                        </div>
                        <div class="item-text">
                            Comprehensive quality control and affordable prices
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-img">
                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/icon-with-us1.png"
                                 alt="">
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
            <input type="text" id="inputUrl" value="{{asset('storage/')}}">
        </section>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script>
            var url = document.getElementById('inputUrl');
            $('.view_modal').on('click', function () {
                var product = $(this).data('value');
                var productDetail = $(this).data('id');
                let urggg = document.getElementById('url').value;
                $('#form_cart').attr('action', urggg + '/' + product['id']);
                var modal_img = document.getElementById('img-modal')
                modal_img.src = url.value + '/' + product['thumbnail'];
                var modal_name = document.getElementById('productName-modal')
                modal_name.innerText = product['name'];
                var price_sale = document.getElementById('price-sale')
                price_sale.innerText = product['price'];
                var price_old = document.getElementById('price-old')
                price_old.innerText = product['old_price'];
                var description_text = document.getElementById('description-text')
                description_text.innerHTML = productDetail['description'];
                var qty = document.getElementById('qty')
                qty.innerText = product['qty'];
                var variable = document.getElementById('variable_id')
                variable.value = productDetail['variation'];
            })

        </script>
        <script>
            let side_cate = document.getElementById('side-cate');
            let carousel_1 = document.getElementById('carousel__1');
            let carousel_2 = document.getElementById('carousel__2');

            let h_car_1 = carousel_1.offsetHeight;
            let h_car_2 = carousel_2.offsetHeight;

            let heightB = h_car_1 !== 0 ? h_car_1 : h_car_2;
            side_cate.style.height = heightB + 'px';

        </script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script>
            $(document).ready(function ($) {
                $(".card-bottom--right").click(function () {
                    var idProduct = jQuery(this).attr('id-product');
                    console.log(idProduct)

                    $.ajax({
                        url: '/wish-list-store/',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            idProduct: idProduct,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert('Sản phẩm đã được thêm vào danh sách yêu thích.')
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                });
            });
        </script>
@endsection