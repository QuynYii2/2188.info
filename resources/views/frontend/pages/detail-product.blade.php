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
        <div class="grid product">
            <div class="column-xs-12 column-md-7">
                <div class="product-gallery">
                    <div class="product-image">
                        <img class="active" src="{{ asset('storage/' . $product->thumbnail) }}">
                    </div>
                    <ul class="image-list ">
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
            <div class="column-xs-12 column-md-5">
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    @php
                        $name = DB::table('users')->where('id', $product->user_id)->first();
                    @endphp
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
                        <div class="price">${{$product->qty}}</div>
                        <strike>${{$product->price}}</strike>
                    </div>
                    <div class="description-text">
                        {{ $product->description }}
                    </div>
                    <div class="row">
                        @foreach($attributes as $attribute)
                            @php
                                $att = Attribute::find($attribute->attribute_id);
                                $properties_id = $attribute->value;
                                $arrayAtt = array();
                                $arrayAtt = explode(',', $properties_id);
                            @endphp
                            <div class="col-sm-6 col-6">
                                <label for="{{$att->name}}">{{$att->name}}</label>
                                <select id="{{$att->name}}" name="{{$att->name}}" class="form-control">
                                    @foreach($arrayAtt as $data)
                                        @php
                                            $property = Properties::find($data);
                                        @endphp
                                        <option value="{{$data}}">{{$property->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                    <div class="">
                        <input id="product_id" hidden value="{{$product->id}}">
                    </div>
                    <div class="count__wrapper count__wrapper--ml mt-3">
                        <label for="qty">Còn lại: {{$product->qty}}</label>

                    </div>
                    <div class="d-flex buy justify-content-around">
                        <div>
                            <input type="number" class="input">
                            <div class="spinner">
                                <button type="button" class="up button">&rsaquo;</button>
                                <button type="button" class="down button">&lsaquo;</button>
                            </div>
                        </div>
                        <button class="add-to-cart">Add To Cart</button>
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
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('home.description') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('home.specification') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{ __('home.review') }}</a>
            </li>
        </ul>
        <div class="tab-content container-fluid" id="myTabContent">
            <div class="tab-pane fade show active"  id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-xl-12 mb-5">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati del cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus.
                    </div>
                    <div class="col-xl-8 mb-5">
                        <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/product-description-1.jpg" alt="">
                    </div>
                    <div class="col-xl-4 m-auto text-center">
                        <p>Lorem ipsum dolor sit amet, consectetur delos adipiscing elit. Duis risus leo milance elementum in malesuada an darius ut augue. Cras sit amet lectus et justo feugiat euismod...</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="tab-title">
                    profile-tabTo edit this page, log in to your control panel and go to Storefront › Web Pages. Click Edit next to the Shipping & Returns page and you can change this text. A sample returns policy is shown below which you can edit as needed.

                    Returns Policy

                    You may return most new, unopened items within 30 days of delivery for a full refund. We'll also pay the return shipping costs if the return is a result of our error (you received an incorrect or defective item, etc.).

                    You should expect to receive your refund within four weeks of giving your package to the return shipper, however, in many cases you will receive a refund more quickly. This time period includes the transit time for us to receive your return from the shipper (5 to 10 business days), the time it takes us to process your return once we receive it (3 to 5 business days), and the time it takes your bank to process our refund request (5 to 10 business days).

                    If you need to return an item, please Contact Us with your order number and details about the product you would like to return. We will respond quickly with instructions for how to return items from your order.

                    Shipping

                    We can ship to virtually any address in the world. Note that there are restrictions on some products, and some products cannot be shipped to international destinations.

                    When you place an order, we will estimate shipping and delivery dates for you based on the availability of your items and the shipping options you choose. Depending on the shipping provider you choose, shipping date estimates may appear on the shipping quotes page.

                    Please also note that the shipping rates for many items we sell are weight-based. The weight of any such item can be found on its detail page. To reflect the policies of the shipping companies we use, all weights will be rounded up to the next full pound.
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
{{--        <div class="row mb-5 mt-5 container-fluid" id="mainDetailProduct">--}}
{{--            <div class="col-md-12 tablet-button">--}}
{{--                <div class="bg-white rounded mt-5">--}}
{{--                    <div style="border: 1px solid black; border-radius: 5px ">--}}
{{--                        <div class="card-text">--}}
{{--                            <div class="card-header text-center"--}}
{{--                                 style="font-weight: 400; font-size: 1.25rem">{{ __('home.why choose IL') }}--}}
{{--                            </div>--}}
{{--                            <div class="card-body row">--}}
{{--                                <div class="col-2_5 mb-3 mb-md-0">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="d-flex px-2 py-3 random-color text-center">--}}
{{--                                            <h5 class="">{{ __('home.reputable brand') }}<br>--}}
{{--                                            </h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-2_5 mb-3 mb-md-0">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="d-flex px-2 py-3 random-color text-center">--}}
{{--                                            <h5 class="">{{ __('home.best price') }}<br>--}}
{{--                                            </h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-2_5 mb-3 mb-md-0">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="d-flex px-2 py-3 random-color text-center">--}}
{{--                                            <h5 class="">{{ __('home.genuine products') }}<br>--}}
{{--                                            </h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-2_5 mb-3 mb-md-0">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="d-flex px-2 py-3 random-color text-center">--}}
{{--                                            <h5 class="">{{ __('home.support installment') }}<br>--}}
{{--                                            </h5>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-2_5 mb-3 mb-md-0">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="d-flex px-2 py-3 random-color text-center">--}}
{{--                                            <div class="">--}}
{{--                                                <div class="d-flex">--}}
{{--                                                    <h5 class="">{{ __('home.super fast delivery') }}<br>--}}
{{--                                                    </h5>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="row" id="product-other">--}}
{{--                    @foreach($otherProduct as $product)--}}
{{--                        <div class="product-other mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                            <div class="card h-100">--}}
{{--                                <img class="img" src="{{$product->thumbnail}}" alt="">--}}
{{--                                <div class="card-body position-relative d-flex flex-column">--}}
{{--                                    <h3 class="text-success">${{$product->price}}</h3>--}}
{{--                                    <div class="rating text-warning">--}}
{{--                                        <i class="fa fa-star"></i>--}}
{{--                                        <i class="fa fa-star"></i>--}}
{{--                                        <i class="fa fa-star"></i>--}}
{{--                                        <i class="fa fa-star"></i>--}}
{{--                                        <i class="fa fa-star-half-o"></i>--}}
{{--                                    </div>--}}
{{--                                    <h4>{{$product->name}}</h4>--}}
{{--                                    <p>{{$product->description}}</p>--}}
{{--                                    <a href="{{route('detail_product.show', $product->id)}}"--}}
{{--                                       class="btn btn-success btn-block mt-auto">--}}
{{--                                        <i class="fa fa-eye"></i>--}}
{{--                                        {{ __('home.see now') }}--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="row">--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">--}}
{{--                                    <path d="M80 0C44.7 0 16 28.7 16 64V448c0 35.3 28.7 64 64 64H304c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H80zm80 432h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.phone case') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">--}}
{{--                                    <path d="M80 0C44.7 0 16 28.7 16 64V448c0 35.3 28.7 64 64 64H304c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H80zm80 432h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H160c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.phone case') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="40">--}}
{{--                                    <path d="M4.1 38.2C1.4 34.2 0 29.4 0 24.6C0 11 11 0 24.6 0H133.9c11.2 0 21.7 5.9 27.4 15.5l68.5 114.1c-48.2 6.1-91.3 28.6-123.4 61.9L4.1 38.2zm503.7 0L405.6 191.5c-32.1-33.3-75.2-55.8-123.4-61.9L350.7 15.5C356.5 5.9 366.9 0 378.1 0H487.4C501 0 512 11 512 24.6c0 4.8-1.4 9.6-4.1 13.6zM80 336a176 176 0 1 1 352 0A176 176 0 1 1 80 336zm184.4-94.9c-3.4-7-13.3-7-16.8 0l-22.4 45.4c-1.4 2.8-4 4.7-7 5.1L168 298.9c-7.7 1.1-10.7 10.5-5.2 16l36.3 35.4c2.2 2.2 3.2 5.2 2.7 8.3l-8.6 49.9c-1.3 7.6 6.7 13.5 13.6 9.9l44.8-23.6c2.7-1.4 6-1.4 8.7 0l44.8 23.6c6.9 3.6 14.9-2.2 13.6-9.9l-8.6-49.9c-.5-3 .5-6.1 2.7-8.3l36.3-35.4c5.6-5.4 2.5-14.8-5.2-16l-50.1-7.3c-3-.4-5.7-2.4-7-5.1l-22.4-45.4z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.screen protector') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">--}}
{{--                                    <path d="M464 160c8.8 0 16 7.2 16 16V336c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V176c0-8.8 7.2-16 16-16H464zM80 96C35.8 96 0 131.8 0 176V336c0 44.2 35.8 80 80 80H464c44.2 0 80-35.8 80-80V320c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32V176c0-44.2-35.8-80-80-80H80zm368 96H96V320H448V192z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.power bank') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
{{--                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->--}}
{{--                                    <path d="M256 80C149.9 80 62.4 159.4 49.6 262c9.4-3.8 19.6-6 30.4-6c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48c-44.2 0-80-35.8-80-80V384 336 288C0 146.6 114.6 32 256 32s256 114.6 256 256v48 48 16c0 44.2-35.8 80-80 80c-26.5 0-48-21.5-48-48V304c0-26.5 21.5-48 48-48c10.8 0 21 2.1 30.4 6C449.6 159.4 362.1 80 256 80z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.headphone') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">--}}
{{--                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->--}}
{{--                                    <path d="M128 64c0-17.7-14.3-32-32-32S64 46.3 64 64V213.6L23.2 225.2c-17 4.9-26.8 22.6-22 39.6s22.6 26.8 39.6 22L64 280.1V448c0 17.7 14.3 32 32 32H352c17.7 0 32-14.3 32-32s-14.3-32-32-32H128V261.9l136.8-39.1c17-4.9 26.8-22.6 22-39.6s-22.6-26.8-39.6-22L128 195.3V64z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.accessories') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">--}}
{{--                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->--}}
{{--                                    <path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.phone charger') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 col-xl-3 col-md-4 col-sm-6 col-12 mb-3 mb-md-0">--}}
{{--                        <div class="card">--}}
{{--                            <div class="d-flex px-3 py-4 align-items-center">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
{{--                                    <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->--}}
{{--                                    <path d="M256 80C141.1 80 48 173.1 48 288V392c0 13.3-10.7 24-24 24s-24-10.7-24-24V288C0 146.6 114.6 32 256 32s256 114.6 256 256V392c0 13.3-10.7 24-24 24s-24-10.7-24-24V288c0-114.9-93.1-208-208-208zM80 352c0-35.3 28.7-64 64-64h16c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H144c-35.3 0-64-28.7-64-64V352zm288-64c35.3 0 64 28.7 64 64v64c0 35.3-28.7 64-64 64H352c-17.7 0-32-14.3-32-32V320c0-17.7 14.3-32 32-32h16z"/>--}}
{{--                                </svg>--}}
{{--                                <h5 class="ml-3 text-center">{{ __('home.bluetooth speaker') }}--}}
{{--                                </h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <section class="section-Fifth section pt-3 pb-3 container-fluid">
        <div class="content">Related Products</div>
        <div class="swiper HotDeals">
            <div class="swiper-wrapper">
                @php
                    $products = DB::table('products')->get();
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




    <script>
        document.body.className += "js";

        var spinner = document.querySelector('.input');
        var buttonUp = document.querySelector('.up');
        var buttonDown = document.querySelector('.down');

        buttonUp.onclick = function() {
            var value = parseInt(spinner.value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            spinner.value = value;
        };

        buttonDown.onclick = function() {
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

        {{--function createPromotionItems(id) {--}}
        {{--    $.ajax({--}}
        {{--        url: '/promotions-item',--}}
        {{--        method: 'POST',--}}
        {{--        data: {--}}
        {{--            'promotion_id': id,--}}
        {{--            _token: '{{ csrf_token() }}'--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            console.log(response)--}}
        {{--            if (response == "Error") {--}}
        {{--                alert('Bạn đã tham gia chương trình rồi!')--}}
        {{--            } else {--}}
        {{--                alert("Tham gia chương trình thành công!")--}}
        {{--                let btn = document.getElementById('btn-join-now');--}}
        {{--                btn.innerText = "Sử dụng ngay";--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (exception) {--}}
        {{--            console.log(exception)--}}
        {{--            if (exception['status'] == 403) {--}}
        {{--                alert('Error, please try again!')--}}
        {{--            } else if (exception['status'] == 401) {--}}
        {{--                alert('Please login to continue!')--}}
        {{--                window.location.href = '/login';--}}
        {{--            } else {--}}
        {{--                alert('Error, please try again!')--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
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

