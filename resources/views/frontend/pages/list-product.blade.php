<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">

@php
    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
@endphp
<input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
<div class="item item-hover">
    @if($product->thumbnail)
        <div class="item-img">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}"><img src="{{ asset('storage/' . $product->thumbnail) }}" alt=""></a>
            @else
                <a href="#"><img src="{{ asset('storage/' . $product->thumbnail) }}" alt=""></a>
            @endif
            <div class="button-view">
                <button type="button" class="btn view_modal" data-toggle="modal"
                        data-value="{{$product}}"
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
            <a href="{{route('shop.information.show', $nameSeller->id)}}">
            {{($nameSeller->name)}}
            </a>
        </div>
        <div class="card-title">
            @if(Auth::check())
                <a href="{{route('detail_product.show', $product->id)}}">
                    @if($locale == 'kr')
                        {{ ($product->name_ko) }}
                    @elseif($locale == 'cn')
                        {{ ($product->name_zh) }}
                    @elseif($locale == 'jp')
                        {{ ($product->name_ja) }}
                    @elseif($locale == 'vi')
                        {{ ($product->name_vi) }}
                    @else
                        {{ ($product->name_en) }}
                    @endif
                </a>
            @else
                <a class="check_url">{{($product->name)}}</a>
            @endif
        </div>

        @if($product->price)
            <div class="card-price d-flex justify-content-between">
                @if($product->price != null)
                    <div class="price-sale">
                        <strong> {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strong>
                    </div>
                    <div class="price-cost">
                        <strike>{{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strike>
                    </div>
                @else
                    <div class="price-sale">
                        <strong>{{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strong>
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