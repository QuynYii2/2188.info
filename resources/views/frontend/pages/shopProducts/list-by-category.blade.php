@extends('frontend.layouts.master')

@section('title', 'Product')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product-shop spad">
        <div class="container">
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-list">
                    <div class="row">
                        @if(!$products->isEmpty())
                            @foreach($products as $product)
                                <div class="col-lg-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="pi-pic">
                                            <img class="img" src="{{ asset('storage/'.$product->thumbnail) }}" alt="">
                                            <div class="sale pp-sale">Sale</div>
                                            <div class="icon">
                                                <i class="fa fa-heart-o"></i>
                                            </div>
                                        </div>
                                        <div class="pi-text">
                                            <div class="category-name">{{$product->category->name}}</div>
                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                <h5>{{$product->name}}</h5>
                                            </a>
                                            <div class="product-price">
                                                ${{$product->price}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection
@if(!$products->isEmpty())
    @php
          (new \App\Http\Controllers\Frontend\HomeController())->createStatisticShopDetail('access', $product->user_id)
    @endphp
@endif