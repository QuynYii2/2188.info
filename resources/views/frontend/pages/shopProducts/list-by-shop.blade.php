@extends('frontend.layouts.master')

@section('title', 'Product')

@section('content')
    <?php
    $trans = \App\Http\Controllers\TranslateController::getInstance();
    ?>
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
                                        <div class="category-name">{{ $trans->translateText($product->category->name) }}</div>
                                        <a href="{{route('detail_product.show', $product->id)}}">
                                            <h5>{{ $trans->translateText($product->name) }}</h5>
                                        </a>
                                        <div class="product-price">
                                            ${{ $trans->translateText($product->price) }}
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
