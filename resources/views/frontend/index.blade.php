@extends('frontend.layouts.master')


@section('title', 'Home page')

@section('content')
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
                                            {{-- <img class="icon_i" alt="">--}}
                                            <div class="text">{{($listCate[$i]->{'name' . $langDisplay->getLangDisplay()})}}</div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            {{-- <img class="icon_i" alt="">--}}
                                            <div class="text">{{($listCate[$i]->{'name' . $langDisplay->getLangDisplay()})}}</div>
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
                                            <div class="text">{{($cate->{'name' . $langDisplay->getLangDisplay()})}}</div>
                                        </a>
                                    @else
                                        <a class="check_url">
                                            {{-- <img class="icon_i" alt="">--}}
                                            <div class="text">{{($cate->{'name' . $langDisplay->getLangDisplay()})}}</div>
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
                                        {{($cate->{'name' . $langDisplay->getLangDisplay()})}}
                                    </div>
                                </a>
                            @else
                                <a class="check_url">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                             alt="">
                                    </div>
                                    <div class="text">
                                        {{($cate->{'name' . $langDisplay->getLangDisplay()})}}
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
                            @foreach($newProducts as $product)
                                @include('frontend.pages.list-product')
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
                                    @include('frontend.pages.list-product')

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
                    <div class="modal-body">
                        <div class="grid product">
                            <div class="column-xs-12 column-md-5">
                                <div class="product-gallery">
                                    <div class="product-image">
                                        <img src="#" alt="" id="img-modal">
                                    </div>
                                    <ul class="image-list ">
                                        {{-- <li class="image-item"><img src="{{ asset('storage/' . $product->thumbnail) }}"></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="column-xs-12 column-md-7">
                                <form action="" method="post" id="form_cart">
                                    @csrf
                                    <div class="product-name" id="category-modal">Name seller</div>
                                    <div class="product-title" id="productName-modal">name</div>
                                    <div class="product-rating" id="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <span>4.7(21)</span>
                                    </div>
                                    <div class="product-price d-flex" style="gap: 3rem">
                                        <div class="price" id="price-sale">price sale</div>
                                        <strike id="price-old">price old</strike>
                                    </div>
                                    <div class="description-text" id="description-text">
                                    </div>
                                    <div class="row">
                                    </div>
                                    <input id="variable_id" name="variable" hidden>
                                    <div class="">
                                        <input id="product_id" hidden value="">
                                    </div>
                                    <div class="count__wrapper count__wrapper--ml mt-3">
                                        <span>Còn lại: </span>
                                        <label for="qty" id="qty"></label>


                                    </div>
                                    <div class="d-flex buy justify-content-around">
                                        <div>
                                            <input type="number" class="input" value="1" min="1">
                                            <div class="spinner">
                                                <button type="button" class="up button">&rsaquo;</button>
                                                <button type="button" class="down button">&lsaquo;</button>
                                            </div>
                                        </div>
                                        <button class="add-to-cart" id="add-to-cart">Add To Cart</button>
                                        <button class="share"><i class="fa-regular fa-heart"></i></button>
                                        <button class="share"><i class="fa-solid fa-share-nodes"></i></button>
                                    </div>
                                    <div class="eyes"><i class="fa-regular fa-eye"></i> 19 customers are viewing this
                                        product
                                    </div>
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
                        @foreach($productHot as $product)
                            @php
                                $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
                            @endphp
                            @include('frontend.pages.list-product')
                        @endforeach
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <div class="section container-fluid">
            <div class="row">
                <div class="col-md-3 col-xl-2 pt-3 pb-3">
                    @php
                        $listCate = DB::table('categories')->where('parent_id', null)->get();
                    @endphp
                    @for($i=0; $i<9; $i++)
                        <div class="section-left">
                            <a href="{{ route('category.show', $listCate[$i]->id) }}">
                                <img src="{{ asset('storage/' . $listCate[$i]->thumbnail) }}"
                                     alt="">
                                <div class="section-left--name">
                                    {{$listCate[$i] -> name}}
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
                <div class="col-12 col-md-9 col-xl-8">
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
                                    @foreach($currentProducts as $product)
                                        @include('frontend.pages.list-product')
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
                                            @include('frontend.pages.list-product')
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
                        $listCate = DB::table('categories')->where('parent_id', null)->get();
                    @endphp
                    @foreach($listCate as $cate => $cate_info)
                        @if ($cate < 8)
                            @continue
                        @endif
                        <div class="section-left">
                            <a href="{{ route('category.show', $cate_info->id) }}">
                                <img src="{{ asset('storage/' . $cate_info->thumbnail) }}"
                                     alt="">
                                <div class="section-left--name">
                                    {{$cate_info -> name}}
                                </div>
                            </a>
                        </div>
                    @endforeach
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
            <input type="text" hidden="" id="inputUrl" value="{{asset('storage/')}}">
        </section>
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
@endsection

