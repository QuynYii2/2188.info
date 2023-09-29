<table class="table table-bordered" id="table-selected-att">
    <thead>
    <tr>
        <th scope="col" style="    width: 80px; text-align: center;">{{ __('home.thumbnail') }}</th>
        <th scope="col">{{ __('home.property') }}</th>
        <th scope="col">{{ __('home.quantity') }}</th>
        <th scope="col">{{ __('home.Unit price') }}</th>
        <th scope="col">{{ __('home.Ship') }}</th>
        <th scope="col">{{ __('home.Grand Total') }}</th>
    </tr>
    </thead>
    <tbody>
    @if($testArray)
        @php
            $productID = $product->id;
        @endphp
        @if(count($testArray) == 1)
            @php
                $item = $testArray[0];
            @endphp
            @if(is_array($item))
                @if(count($item) == 1)
                    @php
                        $attproArray =  explode('-', $item[0]);
                        $attribute = \App\Models\Attribute::find($attproArray[0]);
                        $property = \App\Models\Properties::find($attproArray[1]);
                        $productVariable =  \App\Models\Variation::where([
                            ['product_id', $productID],
                            ['variation', $item],
                            ['status', \App\Enums\VariationStatus::ACTIVE]
                        ])->first();
                    @endphp
                    <tr>
                        <th scope="row">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                        </th>
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
                            <div class="small text-secondary">
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
                            </div>
                        </td>
                        <td>
                            @if($productVariable)
                                <input type="number" min="0" value="0" name="quantity[]"
                                       class="input_quantity"
                                       data-id="0" data-product="{{$product}}"
                                       data-variable="{{$item[0]}}" style="width: 55px;">
                            @else
                                <input type="number" min="0" value="0" name="quantity[]"
                                       class="input_quantity" data-id="0" data-product="{{$product}}"
                                       data-variable="{{$item[0]}}" style="width: 55px;">
                            @endif
                        </td>

                        <td>
                            <span>
                                <span>
                                      @if($productVariable)
                                        <span id="textPrice0">
                                            {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                        </span>
                                        <input class="d-none" value="{{$productVariable->price}}"
                                               id="productPrice0">
                                    @else
                                        <span id="textPrice0">
                                            {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                        </span>
                                        <input class="d-none" value="{{$product->price}}" id="productPrice0">
                                    @endif
                                </span>
                                 <span class="currency">
                                    {{$currency}}
                                 </span>
                            </span>
                        </td>
                        <td class="priceTransport">0</td>
                        <td id="total-price0">
                            @if($productVariable)
                                {{ number_format(convertCurrency('USD', $currency,$productVariable->price*$product->min), 0, ',', '.') }}  {{$currency}}
                            @else
                                {{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}
                            @endif
                        </td>
                    </tr>
                @else
                    @php
                        $productVariable =  \App\Models\Variation::where([
                                    ['product_id', $productID],
                                    ['variation', $item],
                                    ['status', \App\Enums\VariationStatus::ACTIVE]
                                ])->first();
                    @endphp
                    @foreach($item as $key => $attpro)
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                            </th>
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
                                    $attproArray =  explode('-', $attpro);
                                    $attribute = \App\Models\Attribute::find($attproArray[0]);
                                    $property = \App\Models\Properties::find($attproArray[1]);
                                @endphp
                                <div class="small text-secondary">
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
                                </div>
                            </td>
                            <td>
                                @if($productVariable)
                                    <input type="number" min="0" value="0"
                                           name="quantity[]"
                                           class="input_quantity"
                                           data-id="{{$loop->index + 1}}" data-product="{{$product}}"
                                           data-variable="{{$attpro}}">
                                @else
                                    <input type="number" min="0" value="0"
                                           name="quantity[]"
                                           class="input_quantity" data-id="{{$loop->index + 1}}"
                                           data-product="{{$product}}"
                                           data-variable="{{$attpro}}">
                                @endif
                            </td>
                            <td>
                                <span>
                                    <span>
                                          @if($productVariable)
                                            <span id="textPrice{{$loop->index + 1}}">
                                                {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                            </span>
                                            <input class="d-none" value="{{$productVariable->price}}"
                                                   id="productPrice{{$loop->index + 1}}">
                                        @else
                                            <span id="textPrice{{$loop->index + 1}}">
                                                {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                            </span>
                                            <input class="d-none" value="{{$product->price}}"
                                                   id="productPrice{{$loop->index + 1}}">
                                        @endif
                                    </span>
                                     <span class="currency">
                                        {{$currency}}
                                     </span>
                                </span>
                            </td>
                            <td class="priceTransport">0</td>
                            <td id="total-price{{$loop->index + 1}}">
                                @if($productVariable)
                                    {{ number_format(convertCurrency('USD', $currency,$productVariable->price*$product->min), 0, ',', '.') }}  {{$currency}}
                                @else
                                    {{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            @else
                @php
                    $myArray =  explode(',', $item);
                    $productVariable =  \App\Models\Variation::where([
                                    ['product_id', $productID],
                                    ['variation', $item],
                                    ['status', \App\Enums\VariationStatus::ACTIVE]
                            ])->first();
                @endphp
                <tr>
                    <th scope="row">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                    </th>
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
                        <div class="small text-secondary">
                            @foreach($myArray as $item)
                                @php
                                    $attribute_property = explode('-', $item);
                                    $attribute = \App\Models\Attribute::find($attribute_property[0]);
                                    $property = \App\Models\Properties::find($attribute_property[1]);
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
                        </div>
                    </td>
                    <td>
                        @if($productVariable)
                            <input type="number" min="0" value="0" name="quantity[]"
                                   class="input_quantity"
                                   data-id="0" data-product="{{$product}}"
                                   data-variable="{{$item}}">
                        @else
                            <input type="number" min="0" value="0" name="quantity[]"
                                   class="input_quantity" data-id="0" data-product="{{$product}}"
                                   data-variable="{{$item}}">
                        @endif
                    </td>
                    <td>
                        <span>
                            <span>
                                  @if($productVariable)
                                    <span id="textPrice0">
                                        {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                    </span>
                                    <input class="d-none" value="{{$productVariable->price}}" id="productPrice0">
                                @else
                                    <span id="textPrice0">
                                        {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                    </span>
                                    <input class="d-none" value="{{$product->price}}" id="productPrice0">
                                @endif
                            </span>
                             <span class="currency">
                                {{$currency}}
                            </span>
                        </span>
                    </td>
                    <td class="priceTransport">0</td>
                    <td id="total-price0">
                        @if($productVariable)
                            {{ number_format(convertCurrency('USD', $currency,$productVariable->price*$product->min), 0, ',', '.') }}  {{$currency}}
                        @else
                            {{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}
                        @endif
                    </td>
                </tr>
            @endif
        @else
            @foreach($testArray as $productAttribute)
                @php
                    $productVariable =  \App\Models\Variation::where([
                                    ['product_id', $productID],
                                    ['variation', $productAttribute],
                                    ['status', \App\Enums\VariationStatus::ACTIVE]
                            ])->first();
                @endphp
                <tr>
                    <th scope="row">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                    </th>
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
                            $items = null;
                            $items = explode(',', $productAttribute);
                        @endphp
                        <div class="small text-secondary">
                            @foreach($items as $item)
                                @php
                                    $attribute_property = null;
                                    $attribute_property = explode('-', $item);
                                    $attribute = \App\Models\Attribute::find($attribute_property[0]);
                                    $property = \App\Models\Properties::find($attribute_property[1]);
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
                        </div>
                    </td>

                    <td>
                        @if($productVariable)
                            <input type="number" min="0" value="0" name="quantity[]"
                                   class="input_quantity"
                                   data-id="{{$loop->index + 1}}" data-product="{{$product}}"
                                   data-variable="{{$productAttribute}}">
                        @else
                            <input type="number" min="0" value="0" name="quantity[]"
                                   class="input_quantity"
                                   data-id="{{$loop->index + 1}}" data-product="{{$product}}"
                                   data-variable="{{$productAttribute}}">
                        @endif
                    </td>
                    <td>

                        <span>
                            <span>
                                  @if($productVariable)
                                    <span id="textPrice{{$loop->index + 1}}">
                                        {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                    </span>
                                    <input class="d-none" value="{{$productVariable->price}}"
                                           id="productPrice{{$loop->index + 1}}">
                                @else
                                    <span id="textPrice{{$loop->index + 1}}">
                                            {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                        </span>
                                    <input class="d-none" value="{{$product->price}}"
                                           id="productPrice{{$loop->index + 1}}">
                                @endif
                            </span>
                            <span class="currency">
                                {{$currency}}
                            </span>
                        </span>
                    </td>
                    <td class="priceTransport">0</td>
                    <td id="total-price{{$loop->index + 1}}">
                        @if($productVariable)
                            {{ number_format(convertCurrency('USD', $currency,$productVariable->price*$product->min), 0, ',', '.') }}  {{$currency}}
                        @else
                            {{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
    @endif
    </tbody>
</table>
@if($testArray)
    <button id="supBtnOrder" type="button"
            class="btn btn-success float-right">{{ __('home.Tiếp nhận đặt hàng') }}</button>
@endif
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
