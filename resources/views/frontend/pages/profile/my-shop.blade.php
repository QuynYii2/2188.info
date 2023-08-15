@extends('frontend.layouts.profile')

@section('title', 'Shop My')

<style>
    .link-tabs {
        background-color: #f7f7f7 !important;
    }

    .link-tabs:hover {
        color: #c69500 !important;
    }
</style>

@section('sub-content')
    <div class="container">
        <h5 class="text-center">My Shop</h5>
        <div class="row">
            @if(!$products->isEmpty())
                @foreach($products as $product)
                    <div class="col-xl-3 col-md-4 col-6 section">
                        <div class="item">
                            <div class="item-img">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                     alt="">
                                <div class="button-view">
                                    <button class="quickView" data-value="{{$product}}">Quick view</button>
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
                                    $namenewProduct = DB::table('users')->where('id', $product->user_id)->first();
                                @endphp
                                <div class="card-brand">
                                    {{ ($namenewProduct->name) }}
                                </div>
                                <div class="card-title">
                                    <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                                </div>
                                <div class="card-price d-flex justify-content-between">
                                    @if($product->price)
                                        <div class="card-price d-flex justify-content-between">
                                            @if($product->price != null)
                                                <div class="price-sale">
                                                    <strong>${{ ($product->price) }}</strong>
                                                </div>
                                                <div class="price-cost">
                                                    <strike>${{ ($product->old_price) }}</strike>
                                                </div>
                                            @else
                                                <div class="price-sale">
                                                    <strong>${{ ($product->old_price) }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="card-bottom d-flex justify-content-between">
                                    <div class="card-bottom--left">
                                        <a href="{{route('detail_product.show', $product->id)}}">Choose
                                            Options</a>
                                    </div>
                                    <div class="card-bottom--right">
                                        <i class="item-icon fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
