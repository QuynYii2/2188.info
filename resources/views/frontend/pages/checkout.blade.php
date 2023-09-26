@php use App\Enums\AddressOrderStatus;use App\Enums\OrderMethod;use App\Models\OrderAddress;use App\Models\Product;use App\Models\RankSale;use App\Models\User;use App\Models\Voucher;use Illuminate\Support\Facades\Auth; @endphp

@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <div class="checkout-bg">
        <div class="container checkout">
            <div class="card" id="check-out" style="border: none">
                @if($carts->isEmpty())
                    <div>
                        <img src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no order') }}</p>
                    </div>
                @else
                    <form id="checkout-form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 col-12 checkout-item">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>{{ __('home.Billing Address') }}</h3>
                                        <label for="fname">
                                            <i class="fa fa-user"></i>{{ __('home.full name') }}
                                        </label>
                                        <input type="text" id="fname" name="fullname" placeholder="John M. Doe"
                                               value="{{$user->name}}" required>
                                        <label for="email"><i class="fa fa-envelope"></i>{{ __('home.email') }}</label>
                                        <input type="text" id="email" name="email" placeholder="john@example.com"
                                               value="{{$user->email}}" pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$" required>
                                        <label for="phone"><i
                                                    class="fa fa-address-card-o"></i>{{ __('home.phone number') }}
                                        </label>
                                        <input type="number" id="phone" name="phone" placeholder="035985935"
                                               value="{{$user->phone}}" required>
                                        <label for="address">
                                            <i class="fa fa-institution"></i>{{ __('home.address') }}</br>
                                        </label>
                                        <input type="text" id="address" name="address" placeholder="542 W. 15th Street"
                                               value="{{$user->address}}" required>
                                        <input onclick="check();" class="input-m0" type="radio" id="address-order2"
                                               name="address-order">
                                        <span>{{ __('home.Use Different Address') }}</span><br>
                                        <select id="address2" name="address2" disabled class="form-control mt-2 mb-2"
                                                onchange="check();">
                                            @php
                                                $addresses = OrderAddress::where([['user_id', Auth::user()->id], ['status', AddressOrderStatus::ACTIVE]])->get();
                                            @endphp
                                            @foreach($addresses as $address)
                                                <option value="{{$address}}">{{$address->address_detail}}
                                                    -{{$address->location}}-{{$address->province}}
                                                    -{{$address->city}}</option>
                                            @endforeach
                                        </select>
                                        <label for="voucher">
                                            <i class="fa fa-user"></i>{{ __('home.Mã giảm giá có sẵn') }}
                                        </label>
                                        <select name="voucher" id="voucher" class="form-control mb-3"
                                                onchange="getvoucher()">
                                            @foreach($voucherItems as $item)
                                                @php
                                                    $voucher = Voucher::find($item->voucher_id);
                                                    $listCategory = $voucher->apply;
                                                    $arrayCategory = explode(',', $listCategory);
                                                    $productIDs = null;
                                                    foreach ($carts as $cart){
                                                        $productIDs[] = $cart->product_id;
                                                    }
                                                    $allArr = array_intersect($arrayCategory, $productIDs);
                                                    $voucherConvert = implode(',', $allArr);
                                                @endphp
                                                @if($allArr!=null)
                                                    <option class="choose"
                                                            value="{{$voucherConvert}}-{{$voucher->percent}}-{{$voucher->id}}">
                                                        {{($voucher->name)}} - {{$voucher->code}}
                                                    </option>
                                                @else
                                                    <option disabled>{{(($voucher->name))}}
                                                        - {{ __('home.Không thể sử dụng') }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12" id="choose-method-payment">
                                        <h4>{{ __('home.Payment Methods') }}</h4>
                                        <input type="radio" class="input-m0" name="order_method" id="order-by-immediate"
                                               checked
                                               value="{{OrderMethod::IMMEDIATE}}"/><span
                                                class="ml-1">{{ __(OrderMethod::IMMEDIATE) }}</span><br>
                                        <input type="radio" class="input-m0" name="order_method" id="order-by-card"
                                               value="{{OrderMethod::CardCredit}}"/><span
                                                class="ml-1">{{ __(OrderMethod::CardCredit) }}</span><br>
                                        <input type="radio" class="input-m0" name="order_method" id="order-by-e-wallet"
                                                {{OrderMethod::ElectronicWallet}}/>
                                        <span class="ml-1">{{ __(OrderMethod::ElectronicWallet) }}</span><br>
                                        <input type="radio" class="input-m0" name="order_method" id="order-by-coin"
                                                {{OrderMethod::SHOPPING_MALL_COIN}}/>
                                        <span class="ml-1">{{ __(OrderMethod::SHOPPING_MALL_COIN) }}</span>
                                    </div>
                                    <div class="col-12" id="payment-info">
                                        <h3>{{ __('home.Payment') }}</h3>
                                        <label for="fname">{{ __('home.Accepted Cards') }}</label>
                                        <div class="icon-container">
                                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                                        </div>
                                        <label for="cname">{{ __('home.Name on Card') }}</label>
                                        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                        <label for="ccnum">{{ __('home.Card Number') }}</label>
                                        <input type="text" id="ccnum" name="cardnumber"
                                               placeholder="1111-2222-3333-4444">
                                        <label for="expmonth">{{ __('home.Expiration Month') }}</label>
                                        <input type="text" id="expmonth" name="expmonth" placeholder="September">
                                        <div class="row">
                                            <div class="col-50">
                                                <label for="expyear">{{ __('home.Expiration Year') }}</label>
                                                <input type="text" id="expyear" name="expyear" placeholder="2018">
                                            </div>
                                            <div class="col-50">
                                                <label for="cvv">CVV</label>
                                                <input type="text" id="cvv" name="cvv" placeholder="352">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit"
                                        class=" mt-3 mb-3 btn btn-danger">{{ __('home.Pay Now') }}</button>

                            </div>
                            <div class="col-md-4 col-12 orderSummary">
                                <div class="d-flex justify-content-between orderSummary-header">
                                    <span class="summary">{{ __('home.Order Summary') }}</span>
                                    <span><a href="{{route ('cart.index') }}">{{ __('home.Edit Cart') }}</a></span>
                                </div>
                                <div class="orderSummary-body ">
                                    @foreach ($carts as $cartItem)
                                        <div class="mb-3 row">
                                            <div class="col-3 img">
                                                <img src="{{ asset('storage/' . $cartItem->product->thumbnail) }}">
                                            </div>
                                            <div class="col-5 name d-flex">
                                                {{ $cartItem->quantity }} x {{ ($cartItem->product->name) }}
                                            </div>
                                            @php
                                                $currencyController = new \App\Http\Controllers\CurrencyController();
                                                $currencyValue = $currencyController->getCurrency(request(), $cartItem->price*$cartItem->quantity);
                                            @endphp
                                            <div class="col-4 price d-flex" style="color:black">
                                                <span>{{ $currencyValue }}</span>
                                            </div>
                                            <span class="price-quantity d-none"
                                                  id="total-quantity-{{ $cartItem->id }}">{{ $cartItem->price*$cartItem->quantity }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="orderSummary-footer" id="space-price">
                                    <div class="grandtotal d-flex justify-content-between">
                                        <span class="total">{{ __('home.Total Product Cost') }}: </span>
                                        <span id="max-total"> {{ $cartItem->price*$cartItem->quantity }}</span>
                                    </div>
                                    <div class="grandtotal d-flex justify-content-between">
                                        <span class="total">{{ __('home.Shipping Fee') }}: </span>
                                        <span class="price" id="shipping-price"><span>--</span></span>
                                    </div>
                                    <div class="grandtotal d-flex justify-content-between">
                                        <span class="total">{{ __('home.Discount') }}: </span>
                                        <span class="price" id="sale-price"><span>--</span></span>
                                    </div>
                                    <div class="grandtotal d-flex justify-content-between">
                                        <span class="total">{{ __('home.Total Payment') }}:</span>
                                        <span class="price" id="checkout-price">0</span>
                                    </div>
                                </div>

                            </div>
                            <input type="text" id="total_price" name="total_price" value="0" hidden="">
                            <input type="text" id="shipping_price" name="shipping_price" value="0" hidden="">
                            <input type="text" id="discount_price" name="discount_price" value="0" hidden="">
                            <input type="text" id="price_id" name="priceID" value="0" hidden="">
                            <input type="text" id="voucher_id" name="voucherID" value="0" hidden="">

                            <input type="text" id="discount_price_by_rank" name="discount_price_by_rank"
                                   value="{{$totalSaleByRank}}" hidden="">
                            <input type="text" id="voucher_discount_price" value="0" hidden="">
                            <input hidden value="{{asset('/detail-product')}}" id="url">
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
{{--    <button class="btn btn-primary" id="GetProductPrice">Get Profile</button>--}}
    <div class="d-none">
        @php
            $homeController = new \App\Http\Controllers\Frontend\HomeController();
            $currency = $homeController->getLocation(request());
        @endphp
        <p id="valueCurrency">{{$currency}}</p>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        let currency = $('#valueCurrency').text();
        $(document).ready(function () {
            function getvoucher() {
                $('#voucher option').each(function () {
                    if ($(this).is(':selected')) {
                        let myArray = this.value.split("-");
                        let arrayProducts = myArray[0].split(",");
                        let arrayPrice = [];
                        for (let i = 0; i < arrayProducts.length; i++) {
                            var url = document.getElementById('url').value;

                            function myfunction(id) {
                                fetch(url + '/' + id, {
                                    method: 'GET'
                                })
                                    .then(response => {
                                        if (response.status == 200) {

                                            return response.json();
                                        }
                                    })
                                    .then((response) => {

                                        let price = response['price'];
                                        let pricePercent = price * myArray[1] / 100;
                                        arrayPrice.push(pricePercent)
                                        let totalPriceDiscount = 0;
                                        for (let i = 0; i < arrayPrice.length; i++) {
                                            totalPriceDiscount = parseFloat(totalPriceDiscount) + parseFloat(arrayPrice[i]);
                                        }
                                        let salePrice = document.getElementById('voucher_discount_price');
                                        salePrice.value = totalPriceDiscount;

                                        let voucherID = document.getElementById('voucher_id');
                                        voucherID.value = myArray[2];

                                        getAllTotal();

                                    })
                                    .catch(error => );
                            }

                            myfunction(arrayProducts[i]);
                        }
                    }
                })
            }

            function getAllTotal() {
                let totalMax = document.getElementById('max-total');
                let totalPrice = document.getElementById('total-price');
                let shippingPrice = document.getElementById('shipping-price');
                let salePrice = document.getElementById('sale-price');
                let salePriceByRank = document.getElementById('discount_price_by_rank');
                let salePriceByVoucher = document.getElementById('voucher_discount_price');
                let checkOutPrice = document.getElementById('checkout-price');
                let valuePrice = document.getElementsByClassName('price-quantity');


            }

            getAllTotal();

            getvoucher();

            let textSalePrice = $('#sale-price');
            let textCheckoutPrice = $('#checkout-price');
            let inputTotalPrice = $('#total_price');
            let textShipPrice = $('#shipping-price');
            let inputShipPrice = $('#shipping_price');
            let inputDiscountPrice = $('#discount_price');
            let inputPriceId = $('#price_id');

            async function calculationTotalCart() {
                let results = await getAllCart();
                let total = 0;
                let ship = 0;
                let sales = 0;
                for (let i = 0; i < results.length; i++) {
                    total = total + results[i]['price'] * results[i]['quantity'];
                    let productSale = await getProductSale(results[i]['product_id'], results[i]['quantity']);
                    if (productSale) {
                        ship = ship + productSale['ship'];
                    }
                }
                inputShipPrice.val(ship);
                inputDiscountPrice.val(sales);
                inputTotalPrice.val(total);
                let checkout = total + ship - sales;
                inputPriceId.val(checkout);
                let result = await convertCurrency(parseFloat(total));
                let totalText = result + ' ' + currency;
                let shipPrice = await convertCurrency(parseFloat(ship));
                let shipPriceText = shipPrice + ' ' + currency;
                let salePrice = await convertCurrency(parseFloat(sales));
                let salePriceText = salePrice + ' ' + currency;
                let checkoutPrice = await convertCurrency(parseFloat(checkout));
                let checkoutPriceText = checkoutPrice + ' ' + currency;
                textShipPrice.text(shipPriceText)
                textSalePrice.text(salePriceText)
                textCheckoutPrice.text(checkoutPriceText);
                $('#max-total').text(totalText);
            }

            calculationTotalCart();

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

            async function getAllCart() {
                let url = '{{ route('member.all.cart') }}';

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

            async function getProductSale(product, quantity) {
                const requestData = {
                    _token: '{{ csrf_token() }}',
                    productID: product,
                    quantity: quantity,
                };

                try {
                    let productSale = await $.ajax({
                        url: `{{route('member.product.sales')}}`,
                        method: 'GET',
                        data: requestData,
                        body: JSON.stringify(requestData),
                    })
                    return productSale;
                } catch (error) {
                    throw error;
                }
            }
        })

        $(document).ready(function () {
            if ($("#order-by-immediate").prop("checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
            } else if ($("#order-by-card").is(":checked")) {
                $("#payment-info").removeClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
            } else if ($("#order-by-e-wallet").is(":checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.vnpay')}}');
            } else if ($("#order-by-coin").is(":checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.coin')}}');
            }
        })

        $("#choose-method-payment input").change(function () {
            if ($("#order-by-immediate").prop("checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
            } else if ($("#order-by-card").is(":checked")) {
                $("#payment-info").removeClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
            } else if ($("#order-by-e-wallet").is(":checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.vnpay')}}');
            } else if ($("#order-by-coin").is(":checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.coin')}}');
            }
        });

    </script>
    <script>
        function check() {
            let btnRadio = document.getElementById('address-order2')
            let inputSelect = document.getElementById('address2')

            if (btnRadio.checked === true) {
                inputSelect.disabled = false;
                addressObj = JSON.parse(inputSelect.value);
                change(addressObj)
            }
        }

        function change(addressObj) {
            let fname = document.getElementById('fname')
            let phone = document.getElementById('phone')
            let address = document.getElementById('address')

            fname.value = addressObj.username;
            phone.value = addressObj.phone
            address.value = addressObj.address_detail + ', ' + addressObj.location + '-' + addressObj.province + '-' + addressObj.city;
        }
    </script>
@endsection
