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
        <form action="" method="post">
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
                            <th scope="row">1</th>
                            <td>
                                @if($attribue)
                                    {{$attribue->name}}:
                                    @if($property)
                                        {{$property->name}},
                                    @endif
                                @endif
                            </td>
                            <td>
                                <input type="number" min="0" value="0" name="quantity[]" class="input_quantity"
                                       data-id="0">
                            </td>
                            <td>
                                <span>
                                    <span id="productPrice0">
                                        @if($productVariable)
                                            {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                        @else
                                            {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                        @endif
                                    </span>
                                    <span>
                                        {{$currency}}
                                    </span>
                                </span>
                            </td>
                            <td>0</td>
                            <td>0</td>
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
                                <th scope="row">{{$loop->index + 1}}</th>
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
                                    <input type="number" min="0" value="0" name="quantity[]" class="input_quantity"
                                           data-id="{{$loop->index + 1}}">
                                </td>
                                <td>
                                    <span>
                                        <span id="productPrice{{$loop->index + 1}}">
                                              @if($productVariable)
                                                {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                            @else
                                                {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                            @endif
                                        </span>
                                        <span>
                                            {{$currency}}
                                        </span>
                                    </span>
                                </td>
                                <td>0</td>
                                <td>0</td>
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
                        <th scope="row">1</th>
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
                            <input type="number" min="0" value="0" name="quantity[]" class="input_quantity" data-id="0">
                        </td>
                        <td>
                        <span>
                            <span id="productPrice0">
                                  @if($productVariable)
                                    {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                @else
                                    {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                @endif
                            </span>
                            <span>
                                {{$currency}}
                            </span>
                        </span>
                        </td>
                        <td>0</td>
                        <td>0</td>
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
                        <th scope="row">{{$loop->index + 1}}</th>
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
                            <input type="number" min="0" value="0" name="quantity[]" class="input_quantity"
                                   data-id="{{$loop->index + 1}}">
                        </td>
                        <td>
                        <span>
                            <span id="productPrice{{$loop->index + 1}}">
                                  @if($productVariable)
                                    {{ number_format(convertCurrency('USD', $currency,$productVariable->price), 0, ',', '.') }}
                                @else
                                    {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
                                @endif
                            </span>
                            <span>
                                {{$currency}}
                            </span>
                        </span>
                        </td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                @endforeach
            @endif
        </form>
    @endif
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('.input_quantity').on('change', function () {
            let number = $(this).data('id');
        })
    })
</script>
