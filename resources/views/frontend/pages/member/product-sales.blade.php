@if(!$price_sales->isEmpty())
    @foreach($price_sales as $price_sale)
        <tr>
            <td>{{$price_sale->quantity}}</td>
            <td>-{{$price_sale->sales}} %</td>
            <td>{{$price_sale->days}} ngày kể từ ngày đặt hàng</td>
        </tr>
    @endforeach
@endif
