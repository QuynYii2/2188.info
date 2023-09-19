<table class="table" id="table-selected-att">
    <thead>
    <tr>
        <th scope="col">Mã SP</th>
        <th scope="col">Thuộc tính</th>
        <th scope="col">Số lượng</th>
        <th scope="col">Đơn giá</th>
        <th scope="col">Giảm giá</th>
        <th scope="col">Thành tiền</th>
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
                        $attribue = \App\Models\Attribute::find($attproArray[0]);
                        $property = \App\Models\Properties::find($attproArray[1]);
                        $productVariable =  \App\Models\Variation::where([
                            ['product_id', $productID],
                            ['variation', $item],
                            ['status', \App\Enums\VariationStatus::ACTIVE]
                        ])->first();
                    @endphp
                    <tr>
                        <th scope="row">{{$product->product_code}}</th>
                        <td>
                            @if($attribue)
                                {{$attribue->name}}:
                                @if($property)
                                    {{$property->name}},
                                @endif
                            @endif
                        </td>
                        <td>
                            <input type="number" min="{{$product->min}}" value="{{$product->min}}" name="quantity[]"
                                   class="input_quantity"
                                   data-id="0" data-variable="{{$item[0]}}">
                        </td>

                        <td>
                            <span>
                                <span>
                                      @if($productVariable)
                                        {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                        <input class="d-none" value="{{$productVariable->price}}"
                                               id="productPrice0">
                                    @else
                                        {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                        <input class="d-none" value="{{$product->price}}" id="productPrice0">
                                    @endif
                                </span>
                                 <span class="currency">
                                    {{$currency}}
                                 </span>
                            </span>
                        </td>
                        <td id="discount-price0">0</td>
                        <td id="total-price0">{{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}</td>
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
                            <th scope="row">{{$product->product_code}}</th>
                            <td>
                                @php
                                    $attproArray =  explode('-', $attpro);
                                    $attribute = \App\Models\Attribute::find($attproArray[0]);
                                    $property = \App\Models\Properties::find($attproArray[1]);
                                @endphp
                                @if($attribue)
                                    {{$attribue->name}}:
                                    @if($property)
                                        {{$property->name}},
                                    @endif
                                @endif
                            </td>
                            <td>
                                <input type="number" min="{{$product->min}}" value="{{$product->min}}" name="quantity[]" class="input_quantity"
                                       data-id="{{$loop->index + 1}}" data-variable="{{$attpro}}">
                            </td>
                            <td>
                                <span>
                                    <span>
                                          @if($productVariable)
                                            {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                            <input class="d-none" value="{{$productVariable->price}}"
                                                   id="productPrice{{$loop->index + 1}}">
                                        @else
                                            {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                            <input class="d-none" value="{{$product->price}}"
                                                   id="productPrice{{$loop->index + 1}}">
                                        @endif
                                    </span>
                                     <span class="currency">
                                        {{$currency}}
                                     </span>
                                </span>
                            </td>
                            <td id="discount-price{{$loop->index + 1}}">0</td>
                            <td id="total-price{{$loop->index + 1}}">{{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}</td>
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
                    <th scope="row">{{$product->product_code}}</th>
                    <td>
                        @foreach($myArray as $item)
                            @php
                                $attribue_property = explode('-', $item);
                                $attribue = \App\Models\Attribute::find($attribue_property[0]);
                                $property = \App\Models\Properties::find($attribue_property[1]);
                            @endphp
                            @if($attribue)
                                {{$attribue->name}}:
                                @if($property)
                                    {{$property->name}},
                                @endif
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <input type="number" min="{{$product->min}}" value="{{$product->min}}" name="quantity[]" class="input_quantity" data-id="0"
                               data-variable="{{$item}}">
                    </td>
                    <td>
                        <span>
                            <span>
                                  @if($productVariable)
                                    {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                    <input class="d-none" value="{{$productVariable->price}}" id="productPrice0">
                                @else
                                    {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                    <input class="d-none" value="{{$product->price}}" id="productPrice0">
                                @endif
                            </span>
                             <span class="currency">
                                {{$currency}}
                            </span>
                        </span>
                    </td>
                    <td id="discount-price0">0</td>
                    <td id="total-price0">{{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}</td>
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
                    <th scope="row">{{$product->product_code}}</th>
                    <td>
                        @php
                            $items = null;
                            $items = explode(',', $productAttribute);
                        @endphp
                        @foreach($items as $item)
                            @php
                                $attribue_property = null;
                                $attribue_property = explode('-', $item);
                                $attribue = \App\Models\Attribute::find($attribue_property[0]);
                                $property = \App\Models\Properties::find($attribue_property[1]);
                            @endphp
                            @if($attribue)
                                {{$attribue->name}}:
                                @if($property)
                                    {{$property->name}},
                                @endif
                            @endif
                        @endforeach
                    </td>

                    <td>
                        <input type="number" min="{{$product->min}}" value="{{$product->min}}" name="quantity[]" class="input_quantity"
                               data-id="{{$loop->index + 1}}" data-variable="{{$productAttribute}}">
                    </td>
                    <td>

                        <span>
                            <span>
                                  @if($productVariable)
                                    {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                    <input class="d-none" value="{{$productVariable->price}}"
                                           id="productPrice{{$loop->index + 1}}">
                                @else
                                    {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                    <input class="d-none" value="{{$product->price}}"
                                           id="productPrice{{$loop->index + 1}}">
                                @endif
                            </span>
                            <span class="currency">
                                {{$currency}}
                            </span>
                        </span>
                    </td>
                    <td id="discount-price{{$loop->index + 1}}">0</td>
                    <td id="total-price{{$loop->index + 1}}">{{ number_format(convertCurrency('USD', $currency,$product->price*$product->min), 0, ',', '.') }}  {{$currency}}</td>
                </tr>
            @endforeach
        @endif
        <button id="supBtnOrder" type="button"
                class="btn btn-success float-right">{{ __('home.Tiếp nhận đặt hàng') }}</button>
    @endif
    </tbody>
</table>
<div class="d-none">
    <form action="{{route('member.add.cart', $product)}}" method="post" id="formOrderMember">
        @csrf
        <input type="text" name="productInfo" id="productInfo">
        <button id="btnOrder" type="submit" class="btn btn-success float-right">Submit</button>
    </form>
</div>
<script>
    var productItemInfo = [];
    $(document).ready(function () {
        $('.input_quantity').on('change', function () {
            let number = $(this).data('id');
            // get price
            let idPrice = 'productPrice' + number;
            let price = $('#' + idPrice).val();
            // get price discount
            let idPriceDiscount = 'productPrice' + number;
            let priceDiscount = $('#' + idPriceDiscount).text();
            //total
            let total = parseFloat(price) * $(this).val() - priceDiscount;

            let currencies = document.getElementsByClassName('currency');
            let currency = currencies[0].innerText;

            // using function convertCurrency(total);
            async function main() {
                try {
                    let result = await convertCurrency(total);
                    let totalConvert = result + ' ' + currency;
                    $('#total-price' + number).text(totalConvert);
                } catch (error) {
                    console.error(error);
                }
            }

            // render total
            main();

            // order
            let variable = $(this).data('variable');
            let quantity = $(this).val();
            let item = quantity + '&' + variable;

            let index = productItemInfo.findIndex(element => {
                return element.endsWith(variable);
            });

            if (quantity > 0) {
                if (index !== -1) {
                    productItemInfo[index] = item;
                } else {
                    productItemInfo.push(item);
                }
            } else {
                if (index !== -1) {
                    productItemInfo.splice(index, 1);
                }
            }

            let value = null;
            if (productItemInfo.length > 0) {
                for (let i = 0; i < productItemInfo.length; i++) {
                    if (!value) {
                        value = productItemInfo[i];
                    } else {
                        value = value + '#' + productItemInfo[i];
                    }
                }
            }

            $('#productInfo').val(value);
        })

        // call api convert currency
        async function convertCurrency(total) {
            let url = '{{ route('convert.currency', ['total' => ':total']) }}';
            url = url.replace(':total', total);

            try {
                let response = await $.ajax({
                    url: url,
                    method: 'GET',
                });
                return response;
            } catch (error) {
                throw error;
            }
        }

        $('#supBtnOrder').on('click', function () {
            $('#formOrderMember').trigger("submit");
        })
    })
</script>
