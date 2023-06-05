@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')
    <style>
        #table-cart th,
        #table-cart tr,
        #table-cart td {
            white-space: nowrap;
            width: 100%;
        }
    </style>
    <div class="container mt-5" style="margin-bottom: 30px">
        <div class="card" style="border: none">
            <h2>{{ __('home.Cart') }}</h2>

            @if ($cartItems->isEmpty())
                <p>Chưa có sản phẩm trong giỏ hàng.</p>
            @else
                <div class="table-responsive-sm">
                    <table id="table-cart" class="table">
                        <thead>
                        <tr>
                            <th>{{ __('home.Product Name') }}</th>
                            <th>{{ __('home.quantity') }}</th>
                            <th>{{ __('home.Price') }}</th>
                            <th>{{ __('home.Total Amount') }}</th>
                            <th>{{ __('home.Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>{{ $cartItem->product->name }}</td>
                                <td>
                                    <form>
                                        <input type="text" id="id-cart" value="{{ $cartItem->id }}" hidden/>
                                        <input type="text" id="id-link" value="{{ asset('/') }}" hidden/>
                                        <input class="col-12" type="number" id="quantity-{{ $cartItem->id }}"
                                               name="quantity"
                                               value="{{ $cartItem->quantity }}"
                                               onchange="myfunction({{ $cartItem->id }}); "
                                               min="1"/>
                                    </form>
                                </td>
                                <td id="price-{{ $cartItem->id }}">{{ $cartItem->price }}</td>
                                <td id="total-quantity-{{ $cartItem->id }}">{{ $cartItem->price*$cartItem->quantity }}</td>
                                <td>
                                    <form action="{{ route('cart.delete', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{ __('home.Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="ml-2">Tổng: $ <span id="max-total">{{ $cartItem->price*$cartItem->quantity }}</span></p>
                    <div class="mr-2">
                        <form action="{{route('cart.clear')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">{{ __('home.Clear Cart') }}</button>
                        </form>
                    </div>
                </div>

                <a href="{{route('checkout.show')}}" class="btn btn-primary mt-2">{{ __('home.Pay') }}</a>
            @endif
        </div>
    </div>
    <script>
        function myfunction(id) {

            let quantity = document.getElementById('quantity-' + id).value;
            let totalQuantity = document.getElementById('total-quantity-' + id);
            let price = document.getElementById('price-' + id).innerText;
            let link = document.getElementById('id-link').value;

            const data = {
                quantity: quantity,
            };

            fetch(link + 'api/cart/update/' + id, {
                method: 'PUT',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify(data),
            }).then(response => {
                if (response.status == 200) {
                    totalQuantity.innerText = parseFloat(price) * parseFloat(quantity)

                    getAllTotal();
                }
                // window.location.reload()
            }).catch(error => console.log(error));
        }

        function getAllTotal() {
            let totalMax = document.getElementById('max-total');
            var firstCells = document.querySelectorAll('#table-cart td:nth-child(4)');
            var cellValues = [];
            firstCells.forEach(function (singleCell) {
                cellValues.push(singleCell.innerText);
            });
            let i, total = 0;
            for (i = 0; i < cellValues.length; i++) {
                total = parseFloat(total) + parseFloat(cellValues[i]);
            }
            totalMax.innerText = total;
        }

        getAllTotal();

    </script>
@endsection
