<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">

@php
    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
@endphp
<div class="item item-hover bg-white">
    @if($product->thumbnail)
        @php
            $thumbnail = checkThumbnail($product->thumbnail);
        @endphp
        <div class="item-img p-2">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}">
                    <img src="{{ $thumbnail }}" alt="" class="image-product"></a>
            @else
                <a href="#"><img src="{{ $thumbnail }}" alt="" class="image-product"></a>
            @endif
        </div>
    @endif
    <div class="item-body p-2">
        @php
            $nameSeller = DB::table('users')->where('id', $product->user_id)->first();
        @endphp
        <div class="card-title1">
            @if(Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}">
                    @if(locationHelper() == 'kr')
                        {{ ($product->name_ko) }}
                    @elseif(locationHelper() == 'cn')
                        {{ ($product->name_zh) }}
                    @elseif(locationHelper() == 'jp')
                        {{ ($product->name_ja) }}
                    @elseif(locationHelper() == 'vi')
                        {{ ($product->name_vi) }}
                    @else
                        {{ ($product->name_en) }}
                    @endif
                </a>
            @else
                <a href="#">
                    @if(locationHelper() == 'kr')
                        {{ ($product->name_ko) }}
                    @elseif(locationHelper() == 'cn')
                        {{ ($product->name_zh) }}
                    @elseif(locationHelper() == 'jp')
                        {{ ($product->name_ja) }}
                    @elseif(locationHelper() == 'vi')
                        {{ ($product->name_vi) }}
                    @else
                        {{ ($product->name_en) }}
                    @endif
                </a>
            @endif
        </div>
        <div class="card-price">
            <div class="price-sale">
                {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}
            </div>
        </div>
    </div>
    <div class="icon-hover">
        <div class="list-icon float-right">
            <a class="icon-item" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a class="icon-item" href="#"><i class="fa-solid fa-rotate-right"></i></a>
            <a class="icon-item" href="#"><i class="fa-regular fa-heart"></i></a>
            <a class="icon-item" href="#"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>
    </div>
    <div class="button-hover">
        <div class="button-view">
            <button class="btn btnQuickAdd">{{ __('home.Add To Cart') }}</button>
        </div>
    </div>
    <div class="top-left">
        <div class="more-gifcode">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="39" viewBox="0 0 32 39" fill="none">
                <path d="M0 0H32V37.7962C32 38.6554 30.9881 39.1146 30.3415 38.5488L16.6585 26.5762C16.2815 26.2463 15.7185 26.2463 15.3415 26.5762L1.6585 38.5488C1.01192 39.1146 0 38.6554 0 37.7962V0Z"
                      fill="#E80000"/>
            </svg>
            <div class="text-svg">
                new
            </div>
        </div>
    </div>
    <div class="top-left-2">
        <div class="more-gifcode">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="39" viewBox="0 0 32 39" fill="none">
                <path d="M0 0H32V37.7962C32 38.6554 30.9881 39.1146 30.3415 38.5488L16.6585 26.5762C16.2815 26.2463 15.7185 26.2463 15.3415 26.5762L1.6585 38.5488C1.01192 39.1146 0 38.6554 0 37.7962V0Z"
                      fill="#FFA800"/>
            </svg>
            <div class="text-svg">
                75%
            </div>
        </div>
    </div>
</div>

