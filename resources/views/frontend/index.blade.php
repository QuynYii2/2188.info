@extends('frontend.layouts.master')
@section('title', 'Home page')
@section('content')
    <style>
        body{
            background: #f5f5f5;
        }
        @media (min-width: 1900px) {
            .col-xl-2{
                max-width: 14%;
            }
            .col-xl-8{
                max-width: 72%;
            }
        }
        .swiper {
            width: 100%;
            height: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide1 {
            text-align: center;
            font-size: 18px;
            background: #fff;
            height: calc((100% - 30px) / 2) !important;

            /* Center slide text vertically */
            display: grid;
            justify-content: center;
            align-items: center;
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
{{--                <div class="section-First-left section-First-hd col-xl-2 col-12">--}}
{{--                    <span class="content">{{ __('home.SHOP BY CATEGORIES') }}</span>--}}
{{--                    <hr>--}}
{{--                    <div class="row list">--}}
{{--                        @php--}}
{{--                            $listCate = DB::table('categories')->where('parent_id', null)->get();--}}
{{--                            $langDisplay = new \App\Http\Controllers\Frontend\HomeController();--}}
{{--                        @endphp--}}
{{--                        @if(count($listCate)>10)--}}
{{--                            @for($i =0; $i <10; $i ++)--}}
{{--                                <div class="col-lg-6 item item-left text-center">--}}
{{--                                    @if(Auth::check())--}}
{{--                                        <a href="{{ route('category.show', $listCate[$i]->id) }}">--}}
{{--                                            <div class="text">--}}
{{--                                                @if(locationHelper() == 'kr')--}}
{{--                                                    <div class="text">{{ $listCate[$i]->name_ko }}</div>--}}
{{--                                                @elseif(locationHelper() == 'cn')--}}
{{--                                                    <div class="text">{{$listCate[$i]->name_zh}}</div>--}}
{{--                                                @elseif(locationHelper() == 'jp')--}}
{{--                                                    <div class="text">{{$listCate[$i]->name_ja}}</div>--}}
{{--                                                @elseif(locationHelper() == 'vi')--}}
{{--                                                    <div class="text">{{$listCate[$i]->name_vi}}</div>--}}
{{--                                                @else--}}
{{--                                                    <div class="text">{{$listCate[$i]->name_en}}</div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    @else--}}
{{--                                        <a class="check_url">--}}
{{--                                            @if(locationHelper() == 'kr')--}}
{{--                                                <div class="text">{{ $listCate[$i]->name_ko }}</div>--}}
{{--                                            @elseif(locationHelper() == 'cn')--}}
{{--                                                <div class="text">{{$listCate[$i]->name_zh}}</div>--}}
{{--                                            @elseif(locationHelper() == 'jp')--}}
{{--                                                <div class="text">{{$listCate[$i]->name_ja}}</div>--}}
{{--                                            @elseif(locationHelper() == 'vi')--}}
{{--                                                <div class="text">{{$listCate[$i]->name_vi}}</div>--}}
{{--                                            @else--}}
{{--                                                <div class="text">{{$listCate[$i]->name_en}}</div>--}}
{{--                                            @endif--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            @endfor--}}
{{--                        @else--}}
{{--                            @foreach($listCate as $cate)--}}
{{--                                <div class="col-lg-6 item item-left text-center">--}}
{{--                                    @if(Auth::check())--}}
{{--                                        <a href="{{ route('category.show', $cate->id) }}">--}}
{{--                                             <img class="icon_i" alt="">--}}
{{--                                            <div class="text">{{($cate->{'name_' .$langDisplay->getLangDisplay()})}}</div>--}}
{{--                                        </a>--}}
{{--                                    @else--}}
{{--                                        <a class="check_url">--}}
{{--                                             <img class="icon_i" alt="">--}}
{{--                                            <div class="text">{{($cate->{'name_' .$langDisplay->getLangDisplay()})}}</div>--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="section-First-left section-First-mobile col-12">--}}
{{--                    <span class="content">SHOP BY CATEGORIES</span>--}}
{{--                    <hr>--}}
{{--                    <div class="list d-flex justify-content-center">--}}
{{--                        @php--}}
{{--                            $listCate = DB::table('categories')->where('parent_id', null)->get();--}}
{{--                        @endphp--}}
{{--                        @foreach($listCate as $cate)--}}
{{--                            <div class="item item-left text-center">--}}
{{--                                @if(Auth::check())--}}
{{--                                    <a href="{{ route('category.show', $cate->id) }}">--}}
{{--                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"--}}
{{--                                             alt="">--}}
{{--                                        <div class="text">{{($cate->{'name' . $langDisplay->getLangDisplay()})}}</div>--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <a class="check_url">--}}
{{--                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"--}}
{{--                                             alt="">--}}
{{--                                        <div class="text">{{($cate->{'name' . $langDisplay->getLangDisplay()})}}</div>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
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
                <div class="section-First-right col-xl-6 col-md-4">
                    <div class="row">
                        @if(!$banner)
                            <div class="col-4 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                     alt="">
                            </div>
                            <div class="col-4 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-2.png"
                                     alt="">
                            </div>
                            <div class="col-4 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-3.png"
                                     alt="">
                            </div>
                            <div class="col-4 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-4.png"
                                     alt="">
                            </div>
                            <div class="col-4 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-1.png"
                                     alt="">
                            </div>
                            <div class="col-4 item">
                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/right-banner-home-2.png"
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
        <div class="section margin-layout-index container-fluid mt-3">
            <div class="row">
                <div class="col-md-3 col-xl-2">
                    @php
                        $detailMarketing = \App\Models\SetupMarketing::all();
                    @endphp
                    @for($i=0; $i<count($detailMarketing); $i++)
                        @if($i % 2 != 0)
                            <div class="section-left banner_categories">
                                <a href="{{ route('detail-marketing.show', $detailMarketing[$i]->id) }}">
                                    <img src="{{ asset('storage/' . $detailMarketing[$i]->thumbnail) }}"
                                         alt="">
                                    <span class="section-left--name">
                                        @php
                                            $ld = new \App\Http\Controllers\TranslateController();
                                        @endphp
                                        {{ $ld->translateText($detailMarketing[$i]->name, locationPermissionHelper()) }}
                                    </span>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
                <div class="col-12 col-md-9 col-xl-8">
                    <section class="topSearch mb-3">
                        <div class="content_topSearch d-flex justify-content-between">
                            <h5>TÌM KIẾM HÀNG ĐẦU</h5>
                            <a href="#">Xem Tất Cả ></a>
                        </div>
                        <div class="swiper swipertopSearch">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide topSearch-item">
                                        <div class="topSearch-header">
                                            <img src="https://down-vn.img.susercontent.com/file/4e9ad6627f7ae59588d947d44f4fb575" alt="">
                                        </div>
                                        <div class="topSearch-body">

                                        </div>
                                    </div>
                                    <div class="swiper-slide">Slide 2</div>
                                    <div class="swiper-slide">Slide 3</div>
                                    <div class="swiper-slide">Slide 4</div>
                                    <div class="swiper-slide">Slide 5</div>
                                    <div class="swiper-slide">Slide 6</div>
                                    <div class="swiper-slide">Slide 7</div>
                                    <div class="swiper-slide">Slide 8</div>
                                    <div class="swiper-slide">Slide 9</div>
                                </div>
                            </div>
                    </section>
                    <section class="section-Fourth section">
                        <div class="content">{{ __('home.New Products') }}</div>
                        <div class="swiper NewProducts row">
                            <div class="swiper-wrapper ">
                                @foreach($newProducts as $product)
                                    <div class="swiper-slide">
                                        @include('frontend.pages.list-product')
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div class="content mt-4">{{ __('home.Featured Products') }}</div>
                        <div class="swiper FeaturedProducts">
                            <div class="swiper-wrapper">
                                @foreach($productFeatures as $productFeature)
                                    @foreach($productFeature as $product)
                                        <div class="swiper-slide">
                                            @include('frontend.pages.list-product')
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </section>

                    <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
                    <section class="section-Fifth section mt-3">
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
                    <div class="category-img section pt-3 pb-3">
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
                            <div class="category-img section pt-3 pb-3">
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
                <div class="col-md-3 col-xl-2">
                    @php
                        $detailMarketing = \App\Models\SetupMarketing::all();
                    @endphp
                    @for($i=0; $i<count($detailMarketing); $i++)
                        @if($i % 2 == 0)
                            <div class="section-left banner_categories">
                                <a href="{{ route('detail-marketing.show', $detailMarketing[$i]->id) }}">
                                    <img src="{{ asset('storage/' . $detailMarketing[$i]->thumbnail) }}"
                                         alt="">
                                    <span class="section-left--name">
                                        @php
                                            $ld = new \App\Http\Controllers\TranslateController();
                                        @endphp
                                        {{ $ld->translateText($detailMarketing[$i]->name, locationPermissionHelper()) }}
                                    </span>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        <section class="section-Seven ">
            <div class="container-fluid">
                <p>{{ __('home.If you are looking for a website to buy and sell online is a great choice for you.') }}
                    <span id="dots">...</span>
                    <span id="more">
                        {{ __('home.long description') }}
                    </span>
                </p>
                <button onclick="myFunction()" id="myBtn">{{ __('home.Show More') }}</button>
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

