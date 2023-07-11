@php use App\Enums\AddressOrderStatus;use App\Enums\OrderMethod;use App\Models\OrderAddress;use App\Models\Product;use App\Models\RankUserSeller;use App\Models\User;use App\Models\Voucher;use Illuminate\Support\Facades\Auth; @endphp

@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')
    <style>
        @media (max-width: 800px) {
            #space-price .row {
                flex-direction: row;
            }
        }

        @media (min-width: 1200px) {
            #payment-info {
                border: 1px solid #dee2e6 !important;
            }
        }

        #table-checkout th,
        #table-checkout tr,
        #table-checkout td {
            white-space: nowrap;
            width: 100%;
        }

        #space-price th,
        #space-price tr,
        #space-price td {
            white-space: nowrap;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <div class="container mt-5">
        <div class="card" id="check-out" style="border: none">
            <h2 class="mt-3 mb-3 text-center">{{ __('home.order') }}</h2>
            @if($carts->isEmpty())
                <div>
                    <img src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no order') }}</p>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        <form id="checkout-form" method="post">
                            @csrf
                            <div class="col-12">
                                <h4>
                                    {{ __('home.Cart') }}
                                    <span class="price" style="color:black">
                                            <i class="fa fa-shopping-cart"></i>
                                            <b>{{$number}}</b>
                                        </span>
                                </h4>
                                <div class="table-responsive-sm">
                                    <table id="table-checkout" class="table">
                                        <thead>
                                        <tr>
                                            <th>{{ __('home.Product Name') }}</th>
                                            <th>{{ __('home.quantity') }}</th>
                                            <th>{{ __('home.Price') }}</th>
                                            <th class="float-end">{{ __('home.Total Amount') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($carts as $cartItem)
                                            <tr>
                                                <td>{{ $cartItem->product->name }}</td>
                                                <td class="text-center">{{ $cartItem->quantity }}</td>
                                                <td class="text-center"
                                                    id="price-{{ $cartItem->id }}">{{ $cartItem->price }}</td>
                                                <td class="float-end text-center"
                                                    id="total-quantity-{{ $cartItem->id }}">{{ $cartItem->price*$cartItem->quantity }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <p>{{ __('home.Total Payment') }}: <span class="price" style="color:black"><b>$ <span
                                                    id="max-total">{{ $cartItem->price*$cartItem->quantity }}</span></b></span>
                                </p>
                            </div>
                            <div class="col-12">
                                <div class="row mt-5">
                                    <div class="col-12 col-md-12 col-xl-8">
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
                                        <input onclick="check();" type="radio" id="address-order2" name="address-order">
                                        <span>{{ __('home.Use Different Address') }}</span><br>
                                        <select id="address2" name="address2" disabled class="form-control"
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
                                            <i class="fa fa-user"></i>Mã giảm giá có sẵn
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
                                                        {{$voucher->name}} - {{$voucher->code}}
                                                    </option>
                                                @else
                                                    <option disabled>{{$voucher->name}} - Không thể sử dụng</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-12 col-xl-4" id="payment-info">
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

                                    <div class="col-12 col-md-6 col-xl-7" id="choose-method-payment">
                                        <h4>{{ __('home.Payment Methods') }}</h4>
                                        <input type="radio" name="order_method" id="order-by-immediate" checked
                                               value="{{OrderMethod::IMMEDIATE}}"/><span
                                                class="ml-1">{{ __(OrderMethod::IMMEDIATE) }}</span><br>
                                        <input type="radio" name="order_method" id="order-by-card"
                                               value="{{OrderMethod::CardCredit}}"/><span
                                                class="ml-1">{{ __(OrderMethod::CardCredit) }}</span><br>
                                        <input type="radio" name="order_method" id="order-by-e-wallet"
                                                {{OrderMethod::ElectronicWallet}}/>
                                        <span class="ml-1">{{ __(OrderMethod::ElectronicWallet) }}</span><br>
                                        <input type="radio" name="order_method" id="order-by-coin"
                                                {{OrderMethod::SHOPPING_MALL_COIN}}/>
                                        <span class="ml-1">{{ __(OrderMethod::SHOPPING_MALL_COIN) }}</span>
                                    </div>

                                    <div class="mt-4 col-12 col-md-6 col-xl-5" style="" id="space-price">
                                        <table>
                                            <tr>
                                                <td>{{ __('home.Total Product Cost') }}:</td>
                                                <td><span class="text-warning bg-white">$</span>
                                                    <span class="text-warning bg-white" id="total-price">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('home.Shipping Fee') }}:</td>
                                                <td><span class="text-warning bg-white">$</span>
                                                    <span class="text-warning bg-white" id="shipping-price">0</span>
                                            </tr>
                                            <tr>
                                                <td>{{ __('home.Discount') }}:</td>
                                                <td><span class="text-warning bg-white">$</span>
                                                    <span class="text-warning bg-white" id="sale-price">0</span>
                                            </tr>
                                            <tr>
                                                <td>{{ __('home.Total Payment') }}:</td>
                                                <td><span class="text-danger bg-white">$</span>
                                                    <span class="text-danger bg-white" id="checkout-price">0</span>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                                <button type="submit"
                                        class=" mt-3 mb-3 btn btn-danger">{{ __('home.Pay Now') }}</button>

                            </div>
                            <input type="text" id="total_price" name="total_price" value="0" hidden="">
                            <input type="text" id="shipping_price" name="shipping_price" value="0" hidden="">
                            <input type="text" id="discount_price" name="discount_price" value="0" hidden="">
                            <input type="text" id="price_id" name="priceID" value="0" hidden="">
                            <input type="text" id="voucher_id" name="voucherID" value="0" hidden="">

                            @php
                                $user = User::find(Auth::user()->id);

                                $order_items = DB::table('order_items')
                                        ->join('orders', 'orders.id', '=', 'order_items.order_id')
                                        ->join('products', 'products.id', '=', 'order_items.product_id')
                                        ->where('orders.user_id', '=', Auth::user()->id)
                                        ->select('order_items.*', 'products.user_id')
                                        ->get();

//                                dd($order_items);
                                $totalSaleByRank = 0;
                                if (!$order_items->isEmpty()){
                                    foreach ($order_items as $order_item){
                                    $userOrderIDs[] = $order_item->user_id;
                                }
                                $userOrderIDs = array_unique($userOrderIDs);
//                                dd($userOrderIDs);
                                $arrayIDShops = null;
                                for($i = 0; $i < count($userOrderIDs); $i++) {
                                  $orderItems = DB::table('order_items')
                                        ->join('orders', 'orders.id', '=', 'order_items.order_id')
                                        ->join('products', 'products.id', '=', 'order_items.product_id')
                                        ->where([['orders.user_id', '=', Auth::user()->id], ['products.user_id', $userOrderIDs[$i]]])
                                        ->select('order_items.*', 'products.user_id')
                                        ->get();
//                                  dd($orderItems);
                                  $total = $orderItems->sum('price');
                                  $arrayIDShops[] = $userOrderIDs[$i] . '-' . $total;
                                }
//                                dd($arrayIDShops);
                                $rank = null;
                                $totalArray = null;
                                for ($i = 0; $i<count($arrayIDShops); $i++){
                                    $split = explode('-', $arrayIDShops[$i]);
                                    $setup = \App\Models\RankSetUpSeller::where('user_id', $split[0])->first();
                                    $numberTalk = (int)$split[1];
                                    $rankSetup = $setup->setup;
                                    $myArrayRankSetup = explode(',', $rankSetup);
                                    for($i = 0; $i < count($myArrayRankSetup)-1; $i++) {
                                        $listItem = $myArrayRankSetup[$i];
                                        $arrayItem = explode(':', $listItem);
                                        $value = (int)$arrayItem[1];
                                        $string = str_replace(' ', '', $arrayItem[0]);
                                        $upNUmber = explode(':', $myArrayRankSetup[$i+1])[1];
                                        $upNUmber = (int)$upNUmber;
//                                        dd($numberTalk);
                                        if ($value < $numberTalk && $numberTalk < $upNUmber){
                                            $rank[] = $split[0].'-'.$string;
                                        } else{
                                            $rank[] = $split[0] . '-' . \App\Enums\RankSetupSeller::COPPER;
                                        }
                                    }
                                }
                                $rank = array_unique($rank);
//                                dd($rank);
                                for($i = 0; $i < count($rank); $i++) {
                                    $arrayShops = null;
                                    $rankUsers = RankUserSeller::all();
                                    foreach ($rankUsers as $rankUser){
                                        $listRanks = $rankUser->apply;
                                        $array = explode(',', $listRanks);
                                            for ($j = 0; $j<count($array); $j++){
                                                $rankCurrent = explode('-', $rank[$i]);
                                                if ($rankCurrent[1] == $array[$j]){
                                                    $arrayShops[] = $rankUser->user_id."-".$rankUser->percent;
                                                }
                                            }
                                    }
//                                  dd($arrayShops);
                                    $arrayProducts = null;
                                    if ($arrayShops != null){
                                        for ($j = 0; $j<count($arrayShops); $j++){
                                            $myArray = explode('-', $arrayShops[$j]);

                                            foreach ($carts as $cart){
                                                $product = Product::find($cart->product_id);
                                                    if ($product->user_id == $myArray[0]){
                                                        $arrayProducts[] = $cart->price."-".$cart->quantity."-".$myArray[1]."-".$cart->product_id;
                                                    }
                                            }
                                       }
                                    }
//                                    dd($arrayProducts);
                                    if ($arrayProducts!= null){
                                        for ($j = 0; $j<count($arrayProducts); $j++){
                                            $saleArray = explode('-', $arrayProducts[$j]);
                                            $totalPrice = $saleArray[0]*$saleArray[1]*$saleArray[2]/100;
                                            $totalSaleByRank = $totalSaleByRank + $totalPrice;
                                        }
                                    }
                                }
                                }
                            @endphp

                            <input type="text" id="discount_price_by_rank" name="discount_price_by_rank"
                                   value="{{$totalSaleByRank}}" hidden="">
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        function getvoucher() {
            $('#voucher option').each(function () {
                if ($(this).is(':selected')) {
                    // this.value.split("-")
                    let array = this.value.split("-");
                    // let arrayProducts = getDiscount(array);
                    let myArray = this.value.split("-");
                    let arrayProducts = myArray[0].split(",");
                    let arrayPrice = [];
                    for (let i = 0; i < arrayProducts.length; i++) {
                        $.ajax({
                            url: '/detail-product/' + arrayProducts[i],
                            method: 'GET',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                let price = response['price'];
                                let pricePercent = price * myArray[1] / 100;
                                arrayPrice.push(pricePercent)
                                let totalPriceDiscount = 0;
                                for (let i = 0; i < arrayPrice.length; i++) {
                                    totalPriceDiscount = parseFloat(totalPriceDiscount) + parseFloat(arrayPrice[i]);
                                }
                                let salePrice = document.getElementById('sale-price');
                                salePrice.innerText = totalPriceDiscount;

                                let voucherID = document.getElementById('voucher_id');
                                voucherID.value = myArray[2];

                                getAllTotal();
                            },
                            error: function (exception) {
                                console.log(exception)
                            }
                        })
                    }
                }
            })
        }

        function getAllTotal() {
            let totalMax = document.getElementById('max-total');
            let totalPrice = document.getElementById('total-price');
            let shippingPrice = document.getElementById('shipping-price').innerText;
            let salePrice = document.getElementById('sale-price');
            let salePriceByRank = document.getElementById('discount_price_by_rank');
            let checkOutPrice = document.getElementById('checkout-price');
            var firstCells = document.querySelectorAll('#table-checkout td:nth-child(4)');
            var cellValues = [];
            firstCells.forEach(function (singleCell) {
                cellValues.push(singleCell.innerText);
            });
            let i, total = 0;
            for (i = 0; i < cellValues.length; i++) {
                total = parseFloat(total) + parseFloat(cellValues[i]);
            }
            totalMax.innerText = total;
            totalPrice.innerHTML = total;
            salePrice.innerText = salePriceByRank.value;
            let max = parseFloat(total) + parseFloat(shippingPrice) - parseFloat(salePrice.innerText)

            checkOutPrice.innerHTML = max.toFixed(1);
            let price = document.getElementById('price_id');
            price.value = checkOutPrice.innerHTML;
            let discount_price = document.getElementById('discount_price');
            discount_price.value = salePriceByRank.value;
        }

        getAllTotal();

        getvoucher();

        $(document).ready(function () {
            if ($("#order-by-immediate").prop("checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
            } else if ($("#order-by-card").is(":checked")) {
                $("#payment-info").removeClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
            } else if ($("#order-by-e-wallet").is(":checked")) {
                $("#payment-info").addClass("d-none");
                $('#checkout-form').attr('action', '{{route('checkout.create.paypal')}}');
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
                $('#checkout-form').attr('action', '{{route('checkout.create.paypal')}}');
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
