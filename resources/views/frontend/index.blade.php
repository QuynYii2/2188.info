@extends('frontend.layouts.master')
@section('title', 'Home page')
@section('content')
    <style>
        body{
            background: #f5f5f5;
        }
    </style>
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <link rel="stylesheet" href="{{asset('css/frontend.css')}}">
    <!-- test nhanh -->
    <div class="body" id="body-content">
        <section class="section-First pt-3 pb-3 container-fluid">
            <div class="row m-0">
                <div class="section-First-left section-First-hd col-xl-2 col-12">
                    <span class="content">{{ __('home.SHOP BY CATEGORIES') }}</span>
                    <hr>
                    <div class="row list">
                        @php
                            $listCate = DB::table('categories')->where('parent_id', null)->get();
                            $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
                        @endphp
                        @if(count($listCate)>10)
                            @for($i =0; $i <10; $i ++)
                                <div class="col-lg-6 item item-left text-center">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $listCate[$i]->id) }}">
                                            <div class="text">
                                                @if(locationHelper() == 'kr')
                                                    <div class="text">{{ $listCate[$i]->name_ko }}</div>
                                                @elseif(locationHelper() == 'cn')
                                                    <div class="text">{{$listCate[$i]->name_zh}}</div>
                                                @elseif(locationHelper() == 'jp')
                                                    <div class="text">{{$listCate[$i]->name_ja}}</div>
                                                @elseif(locationHelper() == 'vi')
                                                    <div class="text">{{$listCate[$i]->name_vi}}</div>
                                                @else
                                                    <div class="text">{{$listCate[$i]->name_en}}</div>
                                                @endif
                                            </div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            @if(locationHelper() == 'kr')
                                                <div class="text">{{ $listCate[$i]->name_ko }}</div>
                                            @elseif(locationHelper() == 'cn')
                                                <div class="text">{{$listCate[$i]->name_zh}}</div>
                                            @elseif(locationHelper() == 'jp')
                                                <div class="text">{{$listCate[$i]->name_ja}}</div>
                                            @elseif(locationHelper() == 'vi')
                                                <div class="text">{{$listCate[$i]->name_vi}}</div>
                                            @else
                                                <div class="text">{{$listCate[$i]->name_en}}</div>
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            @endfor
                        @else
                            @foreach($listCate as $cate)
                                <div class="col-lg-6 item item-left text-center">
                                    @if(Auth::check())
                                        <a href="{{ route('category.show', $cate->id) }}">
                                            {{-- <img class="icon_i" alt="">--}}
                                            <div class="text">{{($cate->{'name_' .$langDisplay->getLangDisplay()})}}</div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            {{-- <img class="icon_i" alt="">--}}
                                            <div class="text">{{($cate->{'name_' .$langDisplay->getLangDisplay()})}}</div>
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
                    <div class="list d-flex justify-content-center">
                        @php
                            $listCate = DB::table('categories')->where('parent_id', null)->get();
                        @endphp
                        @foreach($listCate as $cate)
                            <div class="item item-left text-center">
                                @if(Auth::check())
                                    <a href="{{ route('category.show', $cate->id) }}">
                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                             alt="">
                                        <div class="text">{{($cate->{'name' . $langDisplay->getLangDisplay()})}}</div>
                                    </a>
                                @else
                                    <a class="check_url">
                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                             alt="">
                                        <div class="text">{{($cate->{'name' . $langDisplay->getLangDisplay()})}}</div>
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
        <div class="section margin-layout-index container-fluid">
            <div class="row">
                <div class="col-md-3 col-xl-2 pt-3 pb-3">
                    @php
                        $listBanner = \Illuminate\Support\Facades\DB::table('top_seller_configs')->get();
                    @endphp
                    @for($i=0; $i<count($listBanner); $i++)
                        @if($i % 2 != 0)
                            <div class="section-left item-img banner_categories">
                                <a href="{{$listBanner[$i]->url}}">
                                    <img src="{{ asset('storage/' . $listBanner[$i]->thumbnail) }}"
                                         alt="">
                                    <div class="section-left--name">
                                        @php
                                            $ld = new \App\Http\Controllers\TranslateController();

                                        @endphp

                                        {{ $ld->translateText($listBanner[$i]->name_custom, locationPermissionHelper()) }}
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <section class="section-Fourth section pt-3 pb-3 container-fluid">
                        <div class="row">
                            <div class="col-12 col-xl-12 col-xxl-6">
                                <div class="content">{{ __('home.New Products') }}</div>
                                <div class="swiper NewProducts row">
                                    <div class="swiper-wrapper ">
                                        @foreach($newProducts as $product)
                                            <div class="col-6 col-xxl-4">
                                                <div class="swiper-slide">
                                                    @include('frontend.pages.list-product')
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-12 col-xxl-6">
                                <div class="content">{{ __('home.Featured Products') }}</div>
                                <div class="swiper FeaturedProducts">
                                    <div class="swiper-wrapper">
                                        @foreach($productFeatures as $productFeature)
                                            @foreach($productFeature as $product)
                                                <div class="col-6 col-xxl-4">
                                                    <div class="swiper-slide">
                                                        @include('frontend.pages.list-product')
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

                    <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
                    <section class="section-Fifth section pt-3 pb-3 container-fluid">
                        <div class="content"><i class="fa-solid fa-fire-flame-curved"></i>{{ __('home.Hot Deals') }}
                        </div>
                        <div class="swiper HotDeals">
                            <div class="swiper-wrapper">
                                @foreach($productHots as $productHot)
                                    @foreach($productHot as $product)
                                        <div class="swiper-slide">
                                            @include('frontend.pages.list-product')
                                        </div>
                                    @endforeach
                                @endforeach

                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </section>
                    <div class="category-img section pt-3 pb-3 container-fluid">
                        <div class="category-img">
                            @if($locale == 'vi')
                                <div class="content ">Viet Nam
                                    <img class="flag-ct"
                                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/1280px-Flag_of_Vietnam.svg.png">
                                </div>
                            @elseif($locale == 'kr')
                                <div class="content ">Korea
                                    <img class="flag-ct"
                                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Flag_of_South_Korea.svg/1280px-Flag_of_South_Korea.svg.png">
                                </div>
                            @elseif($locale == 'cn')
                                <div class="content ">China
                                    <img class="flag-ct"
                                         src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/1280px-Flag_of_the_People%27s_Republic_of_China.svg.png">
                                </div>
                            @else
                                <div class="content ">Japan
                                    <img class="flag-ct"
                                         src="https://upload.wikimedia.org/wikipedia/en/thumb/9/9e/Flag_of_Japan.svg/1280px-Flag_of_Japan.svg.png">
                                </div>
                            @endif
                            <div class="swiper listProduct">
                                <div class="swiper-wrapper">
                                    @php
                                        $products = \App\Models\Product::where([['location','=','vi'],['status',\App\Enums\ProductStatus::ACTIVE]])->get();
                                    @endphp
                                    @foreach($products as $product)
                                        <div class="swiper-slide">
                                            @include('frontend.pages.list-product')
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                    @foreach($arrayProducts as $keys => $arrayProduct)
                        @if($keys != $locale)
                            <div class="category-img section pt-3 pb-3 container-fluid">
                                @if($keys == 'vi')
                                    <div class="content ">Japan
                                        <img class="flag-ct"
                                             src="https://upload.wikimedia.org/wikipedia/en/thumb/9/9e/Flag_of_Japan.svg/1280px-Flag_of_Japan.svg.png">
                                    </div>
                                @elseif($keys == 'kr')
                                    <div class="content ">Korea
                                        <img class="flag-ct"
                                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Flag_of_South_Korea.svg/1280px-Flag_of_South_Korea.svg.png">
                                    </div>
                                @elseif($keys == 'cn')
                                    <div class="content ">China
                                        <img class="flag-ct"
                                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Flag_of_the_People%27s_Republic_of_China.svg/1280px-Flag_of_the_People%27s_Republic_of_China.svg.png">
                                    </div>
                                @else
                                    <div class="content ">Viet Nam
                                        <img class="flag-ct"
                                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/1280px-Flag_of_Vietnam.svg.png">
                                    </div>
                                @endif
                                <div class="swiper listProduct">
                                    <div class="swiper-wrapper">
                                        @foreach($arrayProduct as $product)
                                            @php
                                                $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                                            @endphp
                                            <div class="swiper-slide">
                                                @include('frontend.pages.list-product')
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-md-3 col-xl-2 pt-3 pb-3">
                    @php
                        $listCate = \Illuminate\Support\Facades\DB::table('top_seller_configs')->get();
                    @endphp
                    @for($i=0; $i<count($listCate); $i++)
                        @if($i % 2 == 0)
                            <div class="section-left item-img banner_categories">
                                <a href="{{$listBanner[$i]->url}}">
                                <img src="{{ asset('storage/' . $listCate[$i]->thumbnail) }}"
                                         alt="">
                                    <div class="section-left--name">
                                        @php
                                            $ld = new \App\Http\Controllers\TranslateController();
                                        @endphp
                                        {{ $ld->translateText($listCate[$i]->name_custom, locationPermissionHelper()) }}
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
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
                 src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/bg-with-us2.jpg"
                 alt="">
            <div class="section-content">
                <div class="content">
                    Why shop with us?
                </div>
                <div class="list d-flex justify-content-center">
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
        </section>
        @include('frontend.pages.modal-products')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script>
            let side_cate = document.getElementById('side-cate');
            let carousel_1 = document.getElementById('carousel__1');
            let carousel_2 = document.getElementById('carousel__2');

            let h_car_1 = carousel_1.offsetHeight;
            let h_car_2 = carousel_2.offsetHeight;

            let heightB = h_car_1 !== 0 ? h_car_1 : h_car_2;
            side_cate.style.height = heightB + 'px';
        </script>
        <script>
            $(document).ready(function ($) {
                $(".card-bottom--right").click(function () {
                    var idProduct = $(this).attr('id-product');
                    console.log(idProduct)

                    $.ajax({
                        url: '{{route('user.wish.lists')}}',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            idProduct: idProduct,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert(response.message);
                        },
                        error: function (exception) {
                            // console.log(exception)
                        }
                    });
                });
            });
        </script>
@endsection

