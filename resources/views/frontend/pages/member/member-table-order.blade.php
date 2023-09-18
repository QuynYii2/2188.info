@if($testArray)
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
        @if(count($testArray)>0)
            <form action="" method="post">
                @foreach($testArray as $productAttribute)
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
                            <input type="number" min="0" value="0" name="quantity" id="quantity">
                        </td>
                        <td>
                        <span>
                            <span id="productPrice">
                                {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }}
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
            </form>
        @endif
        </tbody>
    </table>
@endif
