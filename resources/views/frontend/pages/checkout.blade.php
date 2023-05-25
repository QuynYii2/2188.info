@php use Illuminate\Support\Facades\Auth; @endphp

@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <div class="container mt-5">
        <div class="card">
            <h2 class="mt-3 mb-3 text-center">Orders</h2>
            @if($carts->isEmpty())
                <div>
                    <img src="{{asset('images/empty.jpg')}}" alt="">
                    <p>{{ __('home.you have no order') }}</p>
                </div>
            @else
                <div class="row">
                    <div class="col-75">
                        <div class="container">
                            <form method="post" action="{{route('checkout.create')}}">
                                @csrf
                                <div class="col-25">
                                    <div class="container">
                                        <h4>
                                            Cart
                                            <span class="price" style="color:black">
                                            <i class="fa fa-shopping-cart"></i>
                                            <b>{{$number}}</b>
                                        </span>
                                        </h4>
                                        <p>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Giá</th>
                                                <th class="float-end">Tổng</th>
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
                                        </p>
                                        <hr>
                                        <p>Total: <span class="price" style="color:black"><b>$ <span
                                                            id="max-total">{{ $cartItem->price*$cartItem->quantity }}</span></b></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-50">
                                        <h3>Billing Address</h3>
                                        <label for="fname">
                                            <i class="fa fa-user"></i>
                                            Full Name
                                        </label>
                                        <input type="text" id="fname" name="fullname" placeholder="John M. Doe"
                                               value="{{$user->name}}">
                                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                        <input type="text" id="email" name="email" placeholder="john@example.com"
                                               value="{{$user->email}}">
                                        <label for="adr"><i class="fa fa-address-card-o"></i> Phone</label>
                                        <input type="text" id="phone" name="phone" placeholder="035985935"
                                               value="{{$user->phone}}">
                                        <label for="city"><i class="fa fa-institution"></i> Address</label>
                                        <input type="radio" id="address-order1" name="address-order" checked>
                                        <span for="address-order1">Use Address Default</span><br>
                                        <input type="text" id="address1" name="address" placeholder="542 W. 15th Street"
                                               value="{{$user->address}}">
                                        <input type="radio" id="address-order2" name="address-order" disabled>
                                        <span for="address-order2">Use Address Setting</span><br>
                                        <input type="text" id="address2" name="address" placeholder="542 W. 15th Street"
                                               value="" disabled>

                                    </div>

                                    <div class="col-50" hidden="">
                                        <h3>Payment</h3>
                                        <label for="fname">Accepted Cards</label>
                                        <div class="icon-container">
                                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                                        </div>
                                        <label for="cname">Name on Card</label>
                                        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                                        <label for="ccnum">Credit card number</label>
                                        <input type="text" id="ccnum" name="cardnumber"
                                               placeholder="1111-2222-3333-4444">
                                        <label for="expmonth">Exp Month</label>
                                        <input type="text" id="expmonth" name="expmonth" placeholder="September">
                                        <div class="row">
                                            <div class="col-50">
                                                <label for="expyear">Exp Year</label>
                                                <input type="text" id="expyear" name="expyear" placeholder="2018">
                                            </div>
                                            <div class="col-50">
                                                <label for="cvv">CVV</label>
                                                <input type="text" id="cvv" name="cvv" placeholder="352">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <h4>Payment Methods</h4>
                                        <input type="radio" name="order_method" checked
                                               value="{{\App\Enums\OrderMethod::IMMEDIATE}}"/><span
                                                class="ml-1">{{\App\Enums\OrderMethod::IMMEDIATE}}</span><br>
                                        <input type="radio" name="order_method" disabled
                                               value="{{\App\Enums\OrderMethod::CardCredit}}"/><span
                                                class="ml-1"
                                                style="color: #ccc">{{\App\Enums\OrderMethod::CardCredit}}</span><br>
                                        <input type="radio" name="order_method"
                                               disabled {{\App\Enums\OrderMethod::ElectronicWallet}}/>
                                        <span class="ml-1"
                                              style="color: #ccc">{{\App\Enums\OrderMethod::ElectronicWallet}}</span>
                                    </div>

                                    <div class="mt-4" style="background-color: #fffefb">
                                        <div class="mt-3">
                                            <p>Tổng tiền hàng:<span class="text-warning ml-5">
                                            <span class="">$<input class="text-warning bg-white"
                                                                   name="total_price"
                                                                   style="border: none;" disabled
                                                                   id="total-price" value="0"></span>
                                            </span></p>
                                        </div>
                                        <div class="">
                                            <p>Phí vận chuyển: <span class="text-warning ml-5">
                                                 <span class="">$<input class="text-warning bg-white"
                                                                        name="shipping_price"
                                                                        style="border: none;" disabled
                                                                        id="shipping-price" value="1"></span>
                                            </span></p>
                                        </div>
                                        <div class="">
                                            <p>Được giảm giá: <span class="text-warning ml-5">
                                            <span class="">$<input class="text-warning bg-white"
                                                                   name="discount_price"
                                                                   style="border: none;" disabled
                                                                   id="sale-price" value="1"></span>
                                            </span></p>
                                        </div>
                                        <div class="">
                                            <p>Tổng thanh toán: <span class="text-danger ml-4"
                                                                      style="font-size: 36px"><span
                                                            class="">$<input class="text-danger bg-white"
                                                                             name="total"
                                                                             style="border: none;" disabled
                                                                             id="checkout-price" value="0"></span>
                                            </span></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="">
                                    {{--                                <button type="submit" class="mr-5 mt-3 btn btn-primary">Continue to checkout</button>--}}
                                    <button type="submit" class=" mt-3 btn btn-danger">Checkout Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script>
        function getAllTotal() {
            let totalMax = document.getElementById('max-total');
            let totalPrice = document.getElementById('total-price');
            let shippingPrice = document.getElementById('shipping-price').value;
            let salePrice = document.getElementById('sale-price').value;
            let checkOutPrice = document.getElementById('checkout-price');
            var firstCells = document.querySelectorAll('td:nth-child(4)');
            var cellValues = [];
            firstCells.forEach(function (singleCell) {
                cellValues.push(singleCell.innerText);
            });
            let i, total = 0;
            for (i = 0; i < cellValues.length; i++) {
                total = parseFloat(total) + parseFloat(cellValues[i]);
            }
            totalMax.innerText = total;
            totalPrice.value = total;

            checkOutPrice.value = parseFloat(total) + parseFloat(shippingPrice) - parseFloat(salePrice);

        }

        getAllTotal();

    </script>
@endsection
