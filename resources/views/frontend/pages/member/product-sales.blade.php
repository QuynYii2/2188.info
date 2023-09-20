<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">{{ __('home.quantity') }}</th>
        <th scope="col"> Giảm giá</th>
        <th scope="col">{{ __('home.ngày kể từ ngày đặt hàng') }}</th>
        <th scope="col">{{ __('home.Ship') }}</th>
    </tr>
    </thead>
    <tbody >
    @if(!$price_sales->isEmpty())
        @foreach($price_sales as $price_sale)
            @php
                $product = \App\Models\Product::find($price_sale->product_id);
            @endphp
            <tr>
                <td class="">{{$price_sale->quantity}}</td>
                <td>
                    {{ number_format(convertCurrency('USD', $currency,$price_sale->sales), 0, ',', '.') }} {{$currency}}/product
                </td>
                <td class="">{{$price_sale->days}} {{ __('home.ngày kể từ ngày đặt hàng') }}</td>
                <td class="">{{ number_format(convertCurrency('USD', $currency,$price_sale->ship), 0, ',', '.') }} {{$currency}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>