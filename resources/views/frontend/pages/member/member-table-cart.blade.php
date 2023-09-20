<table class="table">
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
    @if($carts->isNotEmpty())
        @foreach($carts as $cart)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>
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
                    <p class="small text-secondary">
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
                    </p>
                </td>
                <td class="quantity col-md-1" style="vertical-align: middle;">
                    <form>
                        <input class="input-number-cart" type="number" id="quantity{{ $cart->id }}"
                               name="quantity" style="border-radius: 30px; border-color: #ccc"
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
    @endif
    </tbody>
</table>
<script>
    var priceCart = '#priceCart';
    var totalCart = '#totalCart';
    var currency = $('.currency').first().text();
    $(document).ready(function () {
        $('.input-number-cart').on('change', function () {
            let cartID = $(this).data('id');
            let url = '{{ route('cart.api.update', ['id' => ':id']) }}';
            url = url.replace(':id', cartID);
            let quantity = $(this).val();

            const requestData = {
                _token: '{{ csrf_token() }}',
                quantity: quantity,
            };
            $.ajax({
                url: url,
                method: 'PUT',
                data: requestData,
                body: JSON.stringify(requestData),
            })
                .done(function (response) {
                    let cartItem = response['cart'];
                    let total = parseFloat(cartItem['price']) * parseFloat(cartItem['quantity'])
                    main(total, cartID);
                })
                .fail(function (_, textStatus) {
                    console.log(textStatus)
                });

            // using function convertCurrency(total);
            async function main(total, cartID) {
                try {
                    let result = await convertCurrency(total);
                    let totalConvert = result + ' ' + currency;
                    $(totalCart + cartID).text(totalConvert);
                } catch (error) {
                    console.error(error);
                }
            }
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
    })
</script>