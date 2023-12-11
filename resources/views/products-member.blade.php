<div class="row infinite-scroll">
    @foreach($products as $product)
        <button type="button" class="btn thumbnailProduct col-xl-4 col-md-3" data-toggle="modal"
                data-target="#exampleModal" data-value="{{$product}}" data-id="{{$product->id}}" data-name="
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
                         ">
            <div class="standsMember-item section" style="background-color: white">
                @php
                    $thumbnail = checkThumbnail($product->thumbnail);
                @endphp
                <img data-id="{{$product->id}}"
                     src="{{ $thumbnail }}" alt=""
                     class="thumbnailProduct" data-value="{{$product}}"

                     width="150px" height="150px">
                <div class="item-body">
                    <div class="card-rating text-left">
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
                    <div class="card-brand text-left">
                        <a href="{{route('shop.information.show', $nameSeller->id)}}">
                            {{($nameSeller->name)}}
                        </a>
                    </div>
                    <div class="card-title text-left">
                        @if(Auth::check())
                            <a>
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
                            <a>
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
                    @if($product->price)
                        <div class="card-price text-left">
                            @php
                                $prises = $product->old_price;
                            @endphp
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
                    <div class="card-bottom--left" hidden="">
                        @if(Auth::check())
                            <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                        @else
                            <a class="check_url">{{ __('home.Choose Options') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </button>
    @endforeach
</div>
<script>
    var token = `{{ csrf_token() }}`;
    var urlGetProductSale = `{{asset('get-products-sale')}}`;
    var imageUrlMain = `{{ asset('storage') }}`;
    var detailProductModal = `{{ route('detail_product.data.modal', ['id' => ':id']) }}`;
    var detailProductAttribute = `{{ route('detail_product.member.attribute', ['id' => ':id']) }}`;
    var memberViewCart = `{{route('member.view.carts')}}`;
</script>
<script src="{{ asset('js/frontend/pages/member/stand-member.js') }}"></script>
