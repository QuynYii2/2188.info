<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@php
    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
@endphp
<div class="swiper-slide">
    <div class="item">
        @if($product->thumbnail)
            <div class="item-img">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                <div class="button-view">
                    <button type="button" class="btn view_modal" data-toggle="modal"
                            data-value="{{$product}}" data-id="{{$productDetail}}"
                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                </div>
                <div class="text">
                    <div class="text-new">
                        New
                    </div>
                </div>
            </div>
        @endif
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
                $nameSeller = DB::table('users')->where('id', $product->user_id)->first();
            @endphp
            <div class="card-brand">
                {{($nameSeller->name)}}
            </div>
            <div class="card-title">
                @if(Auth::check())
                    <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                @else
                    <a class="check_url">{{($product->name)}}</a>
                @endif
            </div>
            @if($product->price)
                <div class="card-price d-flex justify-content-between">
                    @if($product->price != null)
                        <div class="price-sale">
                            <strong>${{$product->price}}</strong>
                        </div>
                        <div class="price-cost">
                            <strike>${{$product->old_price}}</strike>
                        </div>
                    @else
                        <div class="price-sale">
                            <strong>${{$product->old_price}}</strong>
                        </div>
                    @endif
                </div>
            @endif


            <div class="card-bottom d-flex justify-content-between">
                <div class="card-bottom--left">
                    @if(Auth::check())
                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                    @else
                        <a class="check_url">{{ __('home.Choose Options') }}</a>
                    @endif
                </div>
                <div class="card-bottom--right " id-product="{{$product->id}}">
                    <i class="item-icon fa-regular fa-heart"></i>
                </div>
            </div>
        </div>
    </div>
</div>


