@extends('frontend.layouts.master')

@section('title', 'Product')

@section('content')
    <section class="product-shop spad">
        <div class="container">
            <div class="product-list">
                <div class="row">
                    @if(!$products->isEmpty())
                        @foreach($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        @php
                                            $thumbnail = checkThumbnail($product->thumbnail);
                                        @endphp
                                        <img class="img" src="{{ $thumbnail }}" alt="">
                                        <div class="sale pp-sale">Sale</div>
                                        <div class="icon">
                                            <i class="fa fa-heart-o"></i>
                                        </div>
                                    </div>
                                    <div class="pi-text">
                                        <div class="category-name">{{ ($product->category->name) }}</div>
                                        <a href="{{route('detail_product.show', $product->id)}}">
                                            <h5>{{ ($product->name) }}</h5>
                                        </a>
                                        <div class="product-price">
                                            ${{ ($product->price) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@if(!$products->isEmpty())
    @php
          (new \App\Http\Controllers\Frontend\HomeController())->createStatisticShopDetail('access', $product->user_id)
    @endphp
@endif
