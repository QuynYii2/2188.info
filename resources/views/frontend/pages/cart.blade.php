@extends('frontend.layouts.master')
@section('title', 'View Cart')
@section('content')
    <div class="container-fluid cart-page">
        <div class="header-page">
            <div class="grid second-nav">
                <div class="column-xs-12 category-header" style="padding: 1rem">
                    <div class="breadcrumbs_filter">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('homepage') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('cart.index') }}">Cart</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-page row">
            <div class="col-xl-8 col-md-6 col-sm-12">
                <div class="cart-header bg-white">
                    <p class="s24w6">
                        My shopping cart
                    </p>
                    <div class="c92s20w4">
                        The shopping cart now allows you to place one or more orders from a single supplier
                    </div>
                </div>
                <div class="list-product">
                    @foreach($carts as $cart)
                        <div class="product-item d-flex justify-content-between align-items-end bg-white">
                            <div class="product-info d-flex align-items-center">
                                @php
                                    $thumbnail = checkThumbnail($cart->product->thumbnail);
                                @endphp
                                <img src="{{ $thumbnail }}" alt="" class="image-product">
                                <div class="product-value">
                                    <div class="product-name s20w6">
                                        @if(locationHelper() == 'kr')
                                            {{($cart->product->name_ko)}}
                                        @elseif(locationHelper() == 'cn')
                                            {{($cart->product->name_zh)}}
                                        @elseif(locationHelper() == 'jp')
                                            {{($cart->product->name_ja)}}
                                        @elseif(locationHelper() == 'vi')
                                            {{($cart->product->name)}}
                                        @else
                                            {{($cart->product->name_en)}}
                                        @endif
                                        <p class="small text-secondary">
                                            @php
                                                $value = $cart->values;
                                                $arrayValue = explode(',', $value);
                                            @endphp
                                            @foreach($arrayValue as $item)
                                                @php
                                                    $attribute_property = explode('-', $item);
                                                    $attribute = \App\Models\Attribute::find($attribute_property[0]);
                                                    $property = \App\Models\Properties::find($attribute_property[1]);
                                                @endphp
                                                <span>
                                                    @if(locationHelper() == 'kr')
                                                        {{($attribute->name_ko)}}
                                                    @elseif(locationHelper() == 'cn')
                                                        {{($attribute->name_zh)}}
                                                    @elseif(locationHelper() == 'jp')
                                                        {{($attribute->name_ja)}}
                                                    @elseif(locationHelper() == 'vi')
                                                        {{($attribute->name)}}
                                                    @else
                                                        {{($attribute->name_en)}}
                                                    @endif
                                                    :
                                                        @if(locationHelper() == 'kr')
                                                        {{($property->name_ko)}}
                                                    @elseif(locationHelper() == 'cn')
                                                        {{($property->name_zh)}}
                                                    @elseif(locationHelper() == 'jp')
                                                        {{($property->name_ja)}}
                                                    @elseif(locationHelper() == 'vi')
                                                        {{($property->name)}}
                                                    @else
                                                        {{($property->name_en)}}
                                                    @endif
                                                </span>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="product-price">
                                    <span class="real-price ">
                                        {{ number_format(convertCurrency('USD', $currency,$cart->price), 0, ',', '.') }} {{$currency}}
                                    </span>
                                        <del>
                                            {{ number_format(convertCurrency('USD', $currency,$cart->product->old_price), 0, ',', '.') }} {{$currency}}
                                        </del>
                                    </div>
                                </div>
                            </div>
                            <div class="action-quantity d-flex align-items-center justify-content-between">
                                <div class="quantity d-flex align-items-center">
                                <span class="decrease cart-decrease" data-id="{{ $cart->id }}"
                                      data-min="{{ $cart->product->min }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 16 16" fill="none">
                                      <path d="M4 8H12" stroke="#292D32" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                    <input class="input_number" id="cart_input_number_{{ $cart->id }}" type="number"
                                           value="{{ $cart->quantity }}" min="{{ $cart->product->min }}"
                                           data-id="{{ $cart->id }}"
                                           data-min="{{ $cart->product->min }}">
                                    <span class="increase cart-increase" data-id="{{ $cart->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 16 16" fill="none">
                                      <path d="M4 8H12" stroke="#292D32" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                      <path d="M8 12V4" stroke="#292D32" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                </div>
                                <div class="action">
                                    <i class="fa-regular fa-trash-can iconDelete" data-id="{{ $cart->id }}"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-none">
                            <form action="{{ route('cart.delete', $cart->id) }}" id="formDeleteCart_{{ $cart->id }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 cart-confirm">
                <div class="price-product d-flex justify-content-between align-items-center">
                    <div class="title">
                        Total product cost
                    </div>
                    <div class="value" id="valueProductCart">
                        0
                    </div>
                </div>
                <div class="price-ship d-flex justify-content-between align-items-center">
                    <div class="title">
                        Shipping fee
                    </div>
                    <div class="value" id="valueShipCart">
                        0
                    </div>
                </div>
                <div class="price-discount d-flex justify-content-between align-items-center">
                    <div class="title">
                        Discount fee
                    </div>
                    <div class="value" id="valueDiscountCart">
                        0
                    </div>
                </div>
                <div class="price-total d-flex justify-content-between align-items-center">
                    <div class="title">
                        Order total
                    </div>
                    <div class="value" id="valueTotalCart">
                        0
                    </div>
                </div>
                <a href="{{ route('checkout.show') }}" class="btn btnConfirm">
                    {{ __('home.Confirm') }}
                </a>
            </div>
        </div>
    </div>
    <script>
        let currency = `{{ $currency }}`;
        let urlConvertCurrency = '{{ route('convert.currency', ['total' => ':total']) }}'
        let urlAllCart = '{{ route('member.all.cart') }}';
        let urlProductSale = '{{route('member.product.sales')}}';
        /* List text show*/
        let textCartPrice = $('#valueProductCart');
        let textSalePriceCart = $('#valueDiscountCart');
        let textShipPriceCart = $('#valueShipCart');
        let textTotalPriceCart = $('#valueTotalCart');

        $(document).ready(function () {
            $('.cart-decrease').on('click', function () {
                let cart = $(this).data('id');
                let quantity = $('#cart_input_number_' + cart);
                let value = quantity.val();
                let min = $(this).data('min');
                if (value > min) {
                    --value;
                    quantity.val(value);
                    updateCart(value, cart);
                }
            })

            $('.cart-increase').on('click', function () {
                let cart = $(this).data('id');
                let quantity = $('#cart_input_number_' + cart);
                let value = quantity.val();
                ++value;
                quantity.val(value);
                updateCart(value, cart);
            })

            $('.input_number').on('change', function () {
                let cart = $(this).data('id');
                let min = $(this).data('min');
                let value = $(this).val();
                if (value > min) {
                    updateCart(value, cart);
                }
            })

            totalCart();

            $('.iconDelete').on('click', function () {
                let cart = $(this).data('id');
                $('#formDeleteCart_' + cart).trigger('submit');
            })
        })

        async function updateCart(quantity, cartID) {
            let url = `{{ route('cart.api.update', ['id'=>':id']) }}`;
            url = url.replace(':id', cartID);
            const data = {
                quantity: quantity,
            };

            await fetch(url, {
                method: 'PUT',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify(data),
            }).then(response => {
                if (response.status == 200) {
                    return response.json();
                }
            }).then((response) => {
                console.log(response)
                totalCart()
            }).catch(error => {
                console.log(error)
            });
        }

        async function totalCart() {
            let results = await getAllCart();
            let total = 0;
            let ship = 0;
            let sales = 0;
            for (let i = 0; i < results.length; i++) {
                total = parseFloat(total) + parseFloat(results[i]['price']) * parseFloat(results[i]['quantity']);
                let productSale = await getProductSale(results[i]['product_id'], results[i]['quantity']);
                if (productSale) {
                    ship = parseFloat(ship) + parseFloat(productSale['ship']);
                }
            }

            let final_total = total + ship - sales;
            /* Convert total product */
            let result = await convertCartCurrency(parseFloat(total));
            let totalText = result + ' ' + currency;
            /* Convert ship price */
            let shipPrice = await convertCartCurrency(parseFloat(ship));
            let shipPriceText = shipPrice + ' ' + currency;
            /* Convert sale price */
            let salePrice = await convertCartCurrency(parseFloat(sales));
            let salePriceText = salePrice + ' ' + currency;
            /* Convert total price */
            let totalPrice = await convertCartCurrency(parseFloat(final_total));
            let totalPriceText = totalPrice + ' ' + currency;
            /* Append data */
            textCartPrice.text(totalText);
            textShipPriceCart.text(shipPriceText)
            textSalePriceCart.text(salePriceText)
            textTotalPriceCart.text(totalPriceText);

            async function convertCartCurrency(total) {
                let url = urlConvertCurrency;
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
                try {
                    let response = await $.ajax({
                        url: urlAllCart,
                        method: 'GET',
                    });
                    return response;
                } catch (error) {
                    throw error;
                }
            }

            async function getProductSale(product, quantity) {
                const requestData = {
                    productID: product,
                    quantity: quantity,
                };

                try {
                    let productSale = await $.ajax({
                        url: urlProductSale,
                        method: 'GET',
                        data: requestData,
                        body: JSON.stringify(requestData),
                    })
                    return productSale;
                } catch (error) {
                    throw error;
                }
            }
        }
    </script>
@endsection