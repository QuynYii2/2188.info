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
                <div class="text-sale">
                    {{ __('home.sales') }}
                </div>
                <div class="text-new">
                    {{ __('home.new') }}
                </div>
            </div>
        </div>
    @endif
    <div class="item-body">
        @php
            $nameSeller = DB::table('users')->where('id', $product->user_id)->first();
        @endphp
{{--        <div class="card-brand">--}}
{{--            @if(Auth::check())--}}
{{--                <a href="{{route('shop.information.show', $nameSeller->id)}}">{{($nameSeller->name)}}</a>--}}
{{--            @else--}}
{{--                <a class="check_url">{{($nameSeller->name)}}</a>--}}
{{--            @endif--}}
{{--        </div>--}}
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
{{--        @if($product->price)--}}
{{--            <div class="card-price">--}}
{{--                @if($product->price != null)--}}
{{--                    <div class="price-sale">--}}
{{--                        <strong> {{ number_format(convertCurrency($product->location, $currency,$product->price), 0, ',', '.') }} {{$currency}}</strong>--}}
{{--                    </div>--}}
{{--                    <div class="price-cost">--}}
{{--                        <strike>{{ number_format(convertCurrency($product->location, $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strike>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="price-sale">--}}
{{--                        <strong>{{ number_format(convertCurrency($product->location, $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strong>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div class="card-bottom d-flex justify-content-between">--}}
{{--            <div class="card-bottom--left">--}}
{{--                @if(Auth::check())--}}
{{--                    <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>--}}
{{--                @else--}}
{{--                    <a>{{ __('home.Choose Options') }}</a>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class="card-bottom--right " id-product="{{$product->id}}">--}}
{{--                <i class="item-icon fa-regular fa-heart"></i>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>