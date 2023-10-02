@if($carts->isNotEmpty())
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('home.Product Name') }}</th>
            <th scope="col">{{ __('home.quantity') }}</th>
            <th scope="col">{{ __('home.Price') }}</th>
            <th scope="col">{{ __('home.Grand Total') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($carts as $cart)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>
                    <div class="stand-text-secondary">
                        @if(locationHelper() == 'kr')
                            {{$cart->product->name_ko}}
                        @elseif(locationHelper() == 'cn')
                            {{$cart->product->name_zh}}
                        @elseif(locationHelper() == 'jp')
                            {{$cart->product->name_ja}}
                        @elseif(locationHelper() == 'vi')
                            {{$cart->product->name_vi}}
                        @else
                            {{$cart->product->name_en}}
                        @endif
                    </div>
                    <div class="small text-secondary">
                        @if($cart->values && $cart->values != '')
                            @php
                                $arrayValues = explode(',', $cart->values);
                            @endphp
                            @foreach($arrayValues as $arrayValue)
                                @php
                                    $attribute_property = explode('-', $arrayValue);
                                    $attribute = \App\Models\Attribute::find($attribute_property[0]);
                                    $property = \App\Models\Properties::find($attribute_property[1]);
                                @endphp
                                <span>
                                @if(locationHelper() == 'kr')
                                        {{$attribute->name_ko}}
                                    @elseif(locationHelper() == 'cn')
                                        {{$attribute->name_zh}}
                                    @elseif(locationHelper() == 'jp')
                                        {{$attribute->name_ja}}
                                    @elseif(locationHelper() == 'vi')
                                        {{$attribute->name_vi}}
                                    @else
                                        {{$attribute->name_en}}
                                    @endif
                                :
                                @if(locationHelper() == 'kr')
                                        {{$property->name_ko}}
                                    @elseif(locationHelper() == 'cn')
                                        {{$property->name_zh}}
                                    @elseif(locationHelper() == 'jp')
                                        {{$property->name_ja}}
                                    @elseif(locationHelper() == 'vi')
                                        {{$property->name_vi}}
                                    @else
                                        {{$property->name_en}}
                                    @endif
                                    ,
                            </span>
                            @endforeach
                        @endif
                    </div>
                </td>
                <td class="quantity col-md-1" style="vertical-align: middle;">
                    <form>
                        <input class="input-number-cart" type="number" id="quantity{{ $cart->id }}"
                               name="quantity" style="border-radius: 30px; border-color: #ccc; width: 55px; "
                               value="{{ $cart->quantity }}"
                               data-id="{{ $cart->id }}"
                               min="{{$cart->product->min}}"/>
                    </form>
                </td>
                <td>
                    <span id="priceCart{{ $cart->id }}">{{ number_format(convertCurrency('USD', $currency,$cart->price), 0, ',', '.') }}</span>
                    <span class="currency">{{$currency}}</span>
                </td>
                <td id="totalCart{{ $cart->id }}">{{ number_format(convertCurrency('USD', $currency,$cart->price*$cart->quantity), 0, ',', '.') }} {{$currency}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
<script>
    var urlConvertCurrency = `{{ route('convert.currency', ['total' => ':total']) }}`;
    var token = `{{ csrf_token() }}`;
    var urlCartUpdate = `{{ route('cart.api.update', ['id' => ':id']) }}`;
</script>
<script src="{{ asset('js/frontend/pages/member/member-table-cart.js') }}"></script>