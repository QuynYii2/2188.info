@php
    use App\Models\Attribute;
    use App\Models\VoucherItem;
    use App\Models\Properties;use Illuminate\Support\Facades\Auth;
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


        @media only screen and (min-width: 1200px) {
            .tabs-product {


            }


            .img-focus {
                width: 80px;
                height: 80px;
                cursor: pointer;
            }
        }


        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .tabs-product {

            }

            .img-focus {
                width: 80px;
                height: 80px;
            }
        }


        @media only screen and (min-width: 769px) and (max-width: 991px) {
            .tabs-item a {
                font-size: 15px;
            }


            .tabs-product {
                display: flex !important;
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


            .img-focus {
                width: 80px;
                height: 80px;
            }
        }


        @media only screen and (max-width: 365px) {


            .tabs-item a {
                font-size: 12px;
            }


            .btn-block {
                display: block;
            }


            .img-focus {
                width: 60px;
                height: 60px;
            }
        }


        .col-2_5 {
            width: 20%;
            position: relative;
            padding-right: 10px;
            padding-left: 10px;
        }


        .col-2_5 .card {
            height: 100%;
        }


        .col-2_5 .card .d-flex {
            height: 100%;
            flex-wrap: wrap;
            align-content: center;
        }


        .tablet-button {
            display: none;
        }


        @media only screen and (min-width: 576px ) and (max-width: 991px) {
            .tablet-button {
                display: block;
            }


            .not-tablet-button {
                display: none !important;
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

    </style>
    <div class="container-fluid detail">
        <div class="grid second-nav">
            <div class="column-xs-12">
                <nav>
                    <ol class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Household Plants</a></li>
                        <li class="breadcrumb-item active">Bonsai</li>
                    </ol>
                </nav>
            </div>
        </div>
        @php
            $name = DB::table('users')->where('id', $product->user_id)->first();
            $productDetails = \App\Models\Variation::where('product_id', $product->id)->get();
            $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
        @endphp
        <div class="grid product">
            <div class="column-xs-12 column-md-7">
                <div class="product-gallery">
                    <div class="product-image">
                        <img id="productThumbnail" class="active"
                             src="{{ asset('storage/' . $productDetail->thumbnail) }}">
                        <input type="text" id="urlImage" value="{{asset('storage/')}}" hidden="">
                    </div>
                    <ul class="image-list">
                        @php
                            $gallery = $product->gallery;
                            $arrayGallery = explode(',', $gallery);
                        @endphp
                        <li class="image-item"><img src="{{ asset('storage/' . $productDetail->thumbnail) }}"></li>
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
                    <div class="product-name">{{$name->name}}</div>
                    <div class="product-title">{{$product->name}}</div>
                    <div class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>4.7(21)</span>
                    </div>
                    <div class="product-price d-flex" style="gap: 3rem">
                        <div id="productPrice" class="price">${{$productDetail->price}}</div>
                        <strike id="productOldPrice">${{$productDetail->old_price}}</strike>
                    </div>
                    <div class="description-text">
                        {{ $product->description }}
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
                                    <label>{{$att->name}}</label>
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
                        <a id="resetSelect" class="btn btn-warning mt-3">Reset select</a>
                    @endif
                    <div class="">
                        <input id="product_id" hidden value="{{$product->id}}">
                        <input name="variable" id="variable" hidden value="{{$variables[0]->variation}}">
                    </div>
                    <div class="count__wrapper count__wrapper--ml mt-3">
                        <label for="qty">Còn lại: <span id="productQuantity">{{$product->qty}}</span></label>

                    </div>
                    <div class="d-flex buy justify-content-around">
                        <div>
                            <input min="1" value="1" type="number" class="input" name="quantity">
                            <div class="spinner">
                                <button type="button" class="up button">&rsaquo;</button>
                                <button type="button" class="down button">&lsaquo;</button>
                            </div>
                        </div>
                        @if(!$attributes->isEmpty())
                            <button type="submit" id="btnAddCard" class="add-to-cart">Add To Cart</button>
                        @else
                            <button type="submit" class="add-to-cart">Add To Cart</button>
                        @endif
                        <button class="share"><i class="fa-regular fa-heart"></i></button>
                        <button class="share"><i class="fa-solid fa-share-nodes"></i></button>
                    </div>
                    <div class="eyes"><i class="fa-regular fa-eye"></i> 19 customers are viewing this product</div>
                </form>
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
                   aria-controls="profile" aria-selected="false">{{ __('home.specification') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                   aria-controls="contact" aria-selected="false">{{ __('home.review') }}</a>
            </li>
        </ul>
        <div class="tab-content container-fluid" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-xl-12 mb-5">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati del cupiditate
                        non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et
                        dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum
                        soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere
                        possimus.
                    </div>
                    <div class="col-xl-8 mb-5">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/product-description-1.jpg"
                             alt="">
                    </div>
                    <div class="col-xl-4 m-auto text-center">
                        <p>Lorem ipsum dolor sit amet, consectetur delos adipiscing elit. Duis risus leo milance
                            elementum in malesuada an darius ut augue. Cras sit amet lectus et justo feugiat
                            euismod...</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="tab-title">
                    profile-tabTo edit this page, log in to your control panel and go to Storefront › Web Pages. Click
                    Edit next to the Shipping & Returns page and you can change this text. A sample returns policy is
                    shown below which you can edit as needed.

                    Returns Policy

                    You may return most new, unopened items within 30 days of delivery for a full refund. We'll also pay
                    the return shipping costs if the return is a result of our error (you received an incorrect or
                    defective item, etc.).

                    You should expect to receive your refund within four weeks of giving your package to the return
                    shipper, however, in many cases you will receive a refund more quickly. This time period includes
                    the transit time for us to receive your return from the shipper (5 to 10 business days), the time it
                    takes us to process your return once we receive it (3 to 5 business days), and the time it takes
                    your bank to process our refund request (5 to 10 business days).

                    If you need to return an item, please Contact Us with your order number and details about the
                    product you would like to return. We will respond quickly with instructions for how to return items
                    from your order.

                    Shipping

                    We can ship to virtually any address in the world. Note that there are restrictions on some
                    products, and some products cannot be shipped to international destinations.

                    When you place an order, we will estimate shipping and delivery dates for you based on the
                    availability of your items and the shipping options you choose. Depending on the shipping provider
                    you choose, shipping date estimates may appear on the shipping quotes page.

                    Please also note that the shipping rates for many items we sell are weight-based. The weight of any
                    such item can be found on its detail page. To reflect the policies of the shipping companies we use,
                    all weights will be rounded up to the next full pound.
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="">{{ __('home.write a read') }}</div>
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
        <div class="content">Related Products</div>
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
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="">
                                <div class="button-view">
                                    <button>Quick view</button>
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
                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                                    <strong>$189.000</strong>
                                                </div> -->
                                    <div class="price-sale">
                                        <strong>${{$product->qty}}</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>${{$product->price}}</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        @if(Auth::check())
                                            <a href="{{route('detail_product.show', $product->id)}}">Choose Options</a>
                                        @else
                                            <a class="check_url">Choose Options</a>
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
        <div class="content">Customers Also Viewed</div>
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
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="">
                                <div class="button-view">
                                    <button>Quick view</button>
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
                                    <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    <!-- <div class="price">
                                                    <strong>$189.000</strong>
                                                </div> -->
                                    <div class="price-sale">
                                        <strong>${{$product->qty}}</strong>
                                    </div>
                                    <div class="price-cost">
                                        <strike>${{$product->price}}</strike>
                                    </div>
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        @if(Auth::check())
                                            <a href="{{route('detail_product.show', $product->id)}}">Choose Options</a>
                                        @else
                                            <a class="check_url">Choose Options</a>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        var result = '';
        var product_id = document.getElementById('product_id')
        var radio = document.getElementsByClassName('inputRadioButton');
        let isCheck = false
        $('#resetSelect').on('click', function () {
            for (let i = 0; i < radio.length; i++) {
                radio[i].checked = false;
            }
            result = '';
        })
        var urlImg = document.getElementById('urlImage').value;
        var productThumbnail = document.getElementById('productThumbnail')
        var productPrice = document.getElementById('productPrice')
        var productOldPrice = document.getElementById('productOldPrice')
        var productQuantity = document.getElementById('productQuantity')
        var variable = document.getElementById('variable')
        $('.inputRadioButton').on('change', function () {
            let text = $(this).val();
            if (result == '') {
                result = text
            } else {
                result = result.concat(",", text);
            }

            let url = '/product-variable'

            function myfunction(id, value) {
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

