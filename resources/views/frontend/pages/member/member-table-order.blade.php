@php
    $sessionValue = session()->get('isDetail');
    $isDetail = $sessionValue[0];
@endphp
<table class="table table-bordered" id="table-selected-att">
    <thead>
    <tr>
        <th scope="col" style="width: 80px; text-align: center;">{{ __('home.thumbnail') }}</th>
        <th scope="col">{{ __('home.property') }}</th>
        <th scope="col">{{ __('home.quantity') }}</th>
        <th scope="col">{{ __('home.Unit price') }}</th>
        <th class="{{ $isDetail ? 'shipping' : '' }}" scope="col">{{ __('home.vận chuyển') }}</th>
        <th scope="col">{{ __('home.Grand Total') }}</th>
    </tr>
    </thead>
    <tbody>
    @if($productVariables && $productVariables->isNotEmpty())
        @foreach($productVariables as $productVariable)
            <tr>
                <td scope="row">
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                </td>
                <td>
                    <div class="stand-text-secondary">
                        @if(locationHelper() == 'kr')
                            {{$product->name_ko}}
                        @elseif(locationHelper() == 'cn')
                            {{$product->name_zh}}
                        @elseif(locationHelper() == 'jp')
                            {{$product->name_ja}}
                        @elseif(locationHelper() == 'vi')
                            {{$product->name_vi}}
                        @else
                            {{$product->name_en}}
                        @endif
                    </div>
                    @php
                        $item = $productVariable->variation;
                        $arrayItem = null;
                        if ($item){
                            $arrayItem = explode(',', $item);
                        }
                    @endphp
                    <div class="small text-secondary">
                        @if($arrayItem)
                            @foreach($arrayItem as $value)
                                @php
                                    $arrayValue = explode('-', $value);
                                    $attribute = \App\Models\Attribute::where('status', \App\Enums\AttributeStatus::ACTIVE)
                                        ->where('id', $arrayValue[0])->first();
                                     $property = \App\Models\Attribute::where('status', \App\Enums\ProductStatus::ACTIVE)
                                        ->where('id', $arrayValue[1])->first();
                                @endphp
                                @if($attribute)
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
                                    @if($property)
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
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </td>
                <td>
                    <input type="number" min="0" value="0" name="quantity[]"
                           class="input_quantity"
                           data-id="{{$loop->index + 1}}" data-product="{{$productVariable}}"
                           data-variable="{{$productVariable->variation}}" style="width: 55px;">
                </td>

                <td>
                    <span>
                        <span>
                            <span id="textPrice{{$loop->index + 1}}">
                                {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                            </span>
                            <input class="d-none" value="{{$productVariable->price}}"
                                   id="productPrice{{$loop->index + 1}}">
                        </span>
                         <span class="currency">
                            {{$currency}}
                         </span>
                    </span>
                </td>
                <td class="priceTransport">0</td>
                <td id="total-price{{$loop->index + 1}}">
                    0
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td scope="row">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
            </td>
            <td>{{ __('home.None') }}</td>
            <td>
                <input type="number" min="0" value="0" name="quantity[]"
                       class="input_quantity" data-id="0" data-product="{{$product}}"
                       data-variable="" style="width: 55px;">
            </td>
            <td>
                <span>
                    <span>
                        <span id="textPrice0">
                            {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                        </span>
                        <input class="d-none" value="{{$product->price}}" id="productPrice0">
                    </span>
                     <span class="currency">
                        {{$currency}}
                     </span>
                </span>
            </td>
            <td class="priceTransport">0</td>
            <td id="total-price0">
                0
            </td>
        </tr>
    @endif
    </tbody>
</table>
@php
    $sessionValue = session()->get('isDetail');
    $isDetail = $sessionValue[0];
@endphp

<button id="supBtnOrder" type="button"
        class="float-right {{ $isDetail ? 'payment' : 'btn btn-success' }}">{{ __('home.Tiếp nhận đặt hàng') }}</button>

<div class="d-none">
    <form action="{{route('member.add.cart', $product)}}" method="post" id="formOrderMember">
        @csrf
        <input type="text" name="productInfo" id="productInfo">
        <button id="btnOrder" type="submit" class="btn btn-success float-right">Submit</button>
    </form>
</div>
<script>
    var urlConvertCurrency = `{{ route('convert.currency', ['total' => ':total']) }}`;
    var token = `{{ csrf_token() }}`;
    var productID = `{{$product->id}}`;
    var urlProductSale = `{{route('member.product.sales')}}`;
</script>
<script src="{{ asset('js/frontend/pages/member/member-table-order.js') }}"></script>
