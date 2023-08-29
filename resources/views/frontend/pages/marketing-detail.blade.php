@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <div id="body-content">
        <div class="category-banner">
            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-banner-top-layout-2.jpg"
                 alt="">

            <div class="category-name">
                ELECTRONICS
            </div>
        </div>
        <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
        <hr>
        <div class="category-body container-fluid">
            <div class="tab-content">
                <div id="home" class="tab-pane active "><br>
                    <div class="row" id="renderProduct">
                        @foreach($products as $product)
                            <div class="col-xl-3 col-md-4 col-6 section">
                                @include('frontend.pages.list-product')
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade"><br>
                    @foreach($products as $product)
                        <div class="mt-3 category-list section">
                            <div class="item row">
                                <div class="item-img col-md-3 col-5">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                         alt="">
                                    <div class="button-view">
                                        <button type="button" class="btn view_modal" data-toggle="modal"
                                                data-value="{{$product}}"
                                                data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                                    </div>
                                    <div class="text">
                                        <div class="text-sale">
                                            Sale
                                        </div>
                                        <div class="text-new">
                                            New
                                        </div>
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
                                        {{($namenewProduct->name)}}
                                    </div>
                                    <div class="card-title-list">
                                        <a href="{{route('detail_product.show', $product->id)}}">{{  ($product->name)}}</a>
                                    </div>
                                    <div class="card-price d-flex">
                                        @if($product->price)
                                            <div class="card-price d-flex justify-content-between">
                                                @if($product->price != null)
                                                    <div id="productPrice" class="price">{{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</div>
                                                    <strike id="productOldPrice">{{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strike>
                                                @else
                                                    <strike id="productOldPrice">{{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strike>
                                                @endif
                                            </div>
                                        @endif
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
    @include('frontend.pages.modal-products')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection
