@if(!$price_sales->isEmpty())
    @foreach($price_sales as $price_sale)
        @php
            $product = \App\Models\Product::find($price_sale->product_id);
        @endphp
        <tr>
            <td class="12">{{$price_sale->quantity}}</td>
            <td>{{ number_format(convertCurrency('USD', $currency,($product->price - ($product->price * $price_sale->sales / 100)) * $price_sale->quantity), 0, ',', '.') }} {{$currency}} </td>
            <td class="11111">{{$price_sale->days}} {{ __('home.ngày kể từ ngày đặt hàng') }}</td>
        </tr>
    @endforeach
@endif