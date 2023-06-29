@php use Illuminate\Support\Facades\Auth; @endphp

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
                                                <td>{{ $cartItem->quantity }}</td>
                                                <td id="price-{{ $cartItem->id }}">{{ $cartItem->price }}</td>
                                                <td class="float-end"
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
                                        <label for="adr"><i
                                                    class="fa fa-address-card-o"></i>{{ __('home.phone number') }}
                                        </label>
                                        <input type="number" id="phone" name="phone" placeholder="035985935"
                                               value="{{$user->phone}}" required>
                                        <label for="city"><i class="fa fa-institution"></i>{{ __('home.address') }}
                                        </label>
                                        <input type="radio" id="address-order1" name="address-order" checked>
                                        <span for="address-order1">{{ __('home.Use Default Address') }}</span><br>
                                        <input type="text" id="address1" name="address" placeholder="542 W. 15th Street"
                                               value="{{$user->address}}">
                                        <input type="radio" id="address-order2" name="address-order">
                                        <span for="address-order2">{{ __('home.Use Different Address') }}</span><br>
                                        <input type="text" id="address2" name="address" placeholder="542 W. 15th Street"
                                               value="" disabled>

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
                                               value="{{\App\Enums\OrderMethod::IMMEDIATE}}"/><span
                                                class="ml-1">{{ __(\App\Enums\OrderMethod::IMMEDIATE) }}</span><br>
                                        <input type="radio" name="order_method" id="order-by-card"
                                               value="{{\App\Enums\OrderMethod::CardCredit}}"/><span
                                                class="ml-1">{{ __(\App\Enums\OrderMethod::CardCredit) }}</span><br>
                                        <input type="radio" name="order_method" id="order-by-e-wallet"
                                                {{\App\Enums\OrderMethod::ElectronicWallet}}/>
                                        <span class="ml-1">{{ __(\App\Enums\OrderMethod::ElectronicWallet) }}</span><br>
                                        <input type="radio" name="order_method" id="order-by-coin"
                                                {{\App\Enums\OrderMethod::SHOPPING_MALL_COIN}}/>
                                        <span class="ml-1">{{ __(\App\Enums\OrderMethod::SHOPPING_MALL_COIN) }}</span>
                                    </div>

                                    <div class="mt-4 col-12 col-md-6 col-xl-5" style="" id="space-price">
                                        <table>
                                            <tr>
                                                <td>{{ __('home.Total Product Cost') }}:</td>
                                                <td><span class="text-warning bg-white">$</span>
                                                    <span class="text-warning bg-white" id="total-price"
                                                          name="total_price">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('home.Shipping Fee') }}:</td>
                                                <td><span class="text-warning bg-white">$</span>
                                                    <span class="text-warning bg-white" id="shipping-price"
                                                          name="shipping_price">0</span>
                                            </tr>
                                            <tr>
                                                <td>{{ __('home.Discount') }}:</td>
                                                <td><span class="text-warning bg-white">$</span>
                                                    <span class="text-warning bg-white" id="sale-price"
                                                          name="discount_price">0</span>
                                            </tr>
                                            <tr>
                                                <td>{{ __('home.Total Payment') }}:</td>
                                                <td><span class="text-danger bg-white">$</span>
                                                    <span class="text-danger bg-white" id="checkout-price" name="total">0</span>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                                <button type="submit"
                                        class=" mt-3 mb-3 btn btn-danger">{{ __('home.Pay Now') }}</button>

                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        function getAllTotal() {
            let totalMax = document.getElementById('max-total');
            let totalPrice = document.getElementById('total-price');
            let shippingPrice = document.getElementById('shipping-price').innerText;
            let salePrice = document.getElementById('sale-price').innerText;
            let checkOutPrice = document.getElementById('checkout-price');
            var firstCells = document.querySelectorAll('#table-checkout td:nth-child(4)');
            console.log(firstCells)
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

            checkOutPrice.innerHTML = parseFloat(total) + parseFloat(shippingPrice) - parseFloat(salePrice);

        }

        getAllTotal();

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
@endsection
