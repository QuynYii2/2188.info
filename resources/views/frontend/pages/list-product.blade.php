<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">

@php
    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
@endphp
<div class="item item-hover">
    @if($product->thumbnail)
        @php
            $thumbnail = checkThumbnail($product->thumbnail);
        @endphp
        <div class="item-img">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}"><img src="{{ $thumbnail }}" alt=""></a>
            @else
                <a href="#"><img src="{{ $thumbnail }}" alt=""></a>
            @endif
        </div>
    @endif
    <div class="item-body">
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
</div>

