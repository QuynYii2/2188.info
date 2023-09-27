@extends('frontend.layouts.master')
@section('title', 'View Cart')
@section('content')
    <div class="container-fluid cart">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">{{ __('home.Home') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('home.Your Cart') }}</li>
                </ol>
            </nav>
        </div>
        @if ($cartItems->isEmpty())
            <p>{{ __('home.Chưa có sản phẩm trong giỏ hàng') }}</p>
        @else
            <div class="pagelist">
                <table id="table-cart" class="table table-bordered">
                    <thead>
                    <tr class="header">
                        <th scope="col">{{ __('home.item') }}</th>
                        <th scope="col">{{ __('home.PRICE') }}</th>
                        <th scope="col">{{ __('home.quantity') }}</th>
                        <th scope="col">{{ __('home.TOTAL') }}</th>
                        <th scope="col">{{ __('home.Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $cartItem)
                        @php
                            $productDetail = \App\Models\Variation::where([
                                ['product_id', $cartItem->product->id],
                                ['variation', $cartItem->values]
                                ])->first();
                        @endphp
                        <tr style="border-bottom: 1px solid #dbdbdb">
                            <div class="row">
                                <td class="col-md-6">
                                    <div class="row mt-3">
                                        <div class="col-md-2 img-product">
                                            <img class="img" src="{{ asset('storage/'.$cartItem->product->thumbnail) }}"
                                                 alt="" width="60px" height="60px">
                                        </div>
                                        <div class="col-md-10 float-left">
                                            <div class="text-secondary">
                                                @if(locationHelper() == 'kr')
                                                    {{($cartItem->product->category->name_ko)}}
                                                @elseif(locationHelper() == 'cn')
                                                    {{($cartItem->product->category->name_zh)}}
                                                @elseif(locationHelper() == 'jp')
                                                    {{($cartItem->product->category->name_ja)}}
                                                @elseif(locationHelper() == 'vi')
                                                    {{($cartItem->product->category->name)}}
                                                @else
                                                    {{($cartItem->product->category->name)}}
                                                @endif
                                            </div>
                                            <a href="{{route('detail_product.show', $cartItem->product->id)}}">
                                                @if(locationHelper() == 'kr')
                                                    {{($cartItem->product->name_ko)}}
                                                @elseif(locationHelper() == 'cn')
                                                    {{($cartItem->product->name_zh)}}
                                                @elseif(locationHelper() == 'jp')
                                                    {{($cartItem->product->name_ja)}}
                                                @elseif(locationHelper() == 'vi')
                                                    {{($cartItem->product->name)}}
                                                @else
                                                    {{($cartItem->product->name_en)}}
                                                @endif
                                            </a>
                                            @if($cartItem->values != 0)
                                                @php
                                                    $list = $cartItem->values;
                                                    $array = explode(',', $list);
                                                @endphp
                                                @foreach($array as $variable)
                                                    @if($variable)
                                                        @php
                                                            $arrayAttPro = explode('-', $variable);
                                                            if (count($arrayAttPro)>1){
                                                                $att = \App\Models\Attribute::find($arrayAttPro[0]);
                                                                $pro = \App\Models\Properties::find($arrayAttPro[1]);
                                                            }
                                                        @endphp
                                                        @if(count($arrayAttPro)>1)
                                                            <div class="font-italic">
                                                            <span class="text-secondary">
                                                            {{($att->name)}}
                                                        </span>: <span>{{($pro->name)}}</span>
                                                            </div>
                                                        @endif
                                                    @endif

                                                @endforeach
                                                <a class="text-edit" href="#" data-toggle="modal"
                                                   data-target="#exampleModal">
                                                    <i class='fas fa-edit'></i>
                                                    Change
                                                </a>
                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Edit {{($cartItem->product->name)}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-field"
                                                                     data-product-attribute="set-rectangle"
                                                                     role="radiogroup"
                                                                     aria-labelledby="rectangle-group-label">
                                                                    <label class="form-label form-label--alternate form-label--inlineSmall"
                                                                           id="rectangle-group-label">
                                                                        Size:
                                                                        <small>
                                                                            *
                                                                        </small>
                                                                        <span data-option-value=""></span>
                                                                    </label>

                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <div class="form-option-wrapper">
                                                                            <input class="form-radio" type="radio"
                                                                                   id="attribute_rectangle__189_374"
                                                                                   name="attribute[189]" value="374"
                                                                                   required=""
                                                                                   data-state="false">
                                                                            <label class="form-option unavailable"
                                                                                   for="attribute_rectangle__189_374"
                                                                                   data-product-attribute-value="374">
                                                                                <span class="form-option-variant">32 inch</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-option-wrapper">
                                                                            <input class="form-radio" type="radio"
                                                                                   id="attribute_rectangle__189_375"
                                                                                   name="attribute[189]" value="375"
                                                                                   required=""
                                                                                   data-state="false">
                                                                            <label class="form-option unavailable"
                                                                                   for="attribute_rectangle__189_375"
                                                                                   data-product-attribute-value="375">
                                                                                <span class="form-option-variant">42 inch</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-option-wrapper">
                                                                            <input class="form-radio" type="radio"
                                                                                   id="attribute_rectangle__189_376"
                                                                                   name="attribute[189]" value="376"
                                                                                   checked=""
                                                                                   data-default="" required=""
                                                                                   data-state="true">
                                                                            <label class="form-option"
                                                                                   for="attribute_rectangle__189_376"
                                                                                   data-product-attribute-value="376">
                                                                                <span class="form-option-variant">55 inch</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-center align-items-center">
                                                                <button type="button"
                                                                        class=" text-center btn btn-primary">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="price col-md-2" style="vertical-align: middle;"
                                    id="price-{{ $cartItem->id }}">{{ number_format(convertCurrency('USD', $currency,$cartItem->price), 0, ',', '.') }} {{$currency}}</td>
                                <td class="quantity col-md-1" style="vertical-align: middle;">
                                    <form>
                                        <input type="text" id="id-cart" value="{{ $cartItem->id }}" hidden/>
                                        <input type="text" id="id-link" value="{{ asset('/') }}" hidden/>
                                        <input class="input-number" type="number" id="quantity-{{ $cartItem->id }}"
                                               name="quantity" style="border-radius: 30px; border-color: #ccc"
                                               value="{{ $cartItem->quantity }}"
                                               data-id="{{ $cartItem->id }}" data-value="{{ $cartItem }}"
                                               min="{{$cartItem->product->min}}"/>
                                    </form>
                                </td>
                                <td class="col-md-2" id="total-quantity-{{ $cartItem->id }}"
                                    style="vertical-align: middle;">
                                    {{ number_format(convertCurrency('USD', $currency,$cartItem->price*$cartItem->quantity), 0, ',', '.') }} {{$currency}}
                                </td>
                                <td class="col-md-1" style="vertical-align: middle;">
                                    <form action="{{ route('cart.delete', $cartItem->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="submit" type="submit" value="&times;"/>
                                    </form>
                                </td>

                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row cart-content">
                <div class="col-md-4">
                    <div class="text-uppercase">{{ __('home.COUPON CODE') }}</div>
                    <div class="">
                        <label for="inputPassword2">{{ __('home.Enter your coupon code if you have one.') }}</label>
                        <form class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputPassword2"
                                       placeholder="Enter your coupon code">
                            </div>
                            <button type="submit" class="btn mb-2 submit">{{ __('home.Apply') }}</button>
                        </form>
                    </div>
                    <div class="text-uppercase">{{ __('home.GIFT CERTIFICATE') }}</div>
                    <div class="">
                        <label for="inputPassword2">{{ __('home.Enter your coupon code if you have one.') }}</label>
                        <form class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputPassword2"
                                       placeholder="Enter your coupon code">
                            </div>
                            <button type="submit" class="btn mb-2 submit">{{ __('home.Apply') }}</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-uppercase">{{ __('home.SHIPPING') }}</div>
                    <div class="">
                        <label for="inputPassword2">{{ __('home.Enter your coupon code if you have one.') }}</label>
                        <form>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">{{ __('home.Country') }}</span>
                                <div class="form-group">
                                    <select name="" id="">
                                        <option value="">{{ __('home.VietNam') }}</option>
                                        <option value="">{{ __('home.TrungQuoc') }}</option>
                                        <option value="">{{ __('home.Han Quoc') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">{{ __('home.State/Province') }}</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputPassword2"
                                           placeholder={{ __('home.State/Province') }}>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">{{ __('home.Suburb/City') }}</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputPassword2"
                                           placeholder={{ __('home.Suburb/City') }}>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">{{ __('home.Zip/Postcode') }}</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputPassword2"
                                           placeholder="{{ __('home.Zip/Postcode') }}">
                                </div>
                            </div>
                            <button type="submit"
                                    class="btn mb-2 submit float-right submit-60">{{ __('home.Estimate Shipping') }}
                            </button>
                        </form>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="text-uppercase">{{ __('home.COUPON CODE') }}</div>
                    <div class="subtotal d-flex justify-content-between">
                        <span class="">{{ __('home.Subtotal') }}: </span>
                        <span class="subtotal-price">0</span>
                    </div>
                    <div class="grandtotal d-flex justify-content-between">
                        <span>Grand total: </span>
                        <span> <span id="max-total"> {{ $cartItem->price*$cartItem->quantity }}</span></span>
                    </div>
                    <a href="{{route('checkout.show')}}">
                        <button type="submit"
                                class="btn mb-2 submit float-right submit-100">{{ __('home.Check out') }}</button>
                    </a>
                </div>
            </div>

        @endif
    </div>
    <div class="d-none">
        @if ($cartItems->isNotEmpty())
            @php
                $totalCart = null;
                foreach ($cartItems as $item){
                    $totalCart = (int)$totalCart + (int)$item->price * (int)$item->quantity ;
                }
            @endphp
            <p id="totalItemCart">{{$totalCart}}</p>
        @else
            <p id="totalItemCart">0</p>
        @endif
        <p id="currencyCart">{{$currency}}</p>
    </div>
    <script>
        let currency = $('#currencyCart').text();
        $(document).ready(function () {
            $('.input-number').on('change', function () {
                let id = $(this).data('id');
                let quantity = $(this).val();
                let totalQuantity = document.getElementById('total-quantity-' + id);
                let link = document.getElementById('id-link').value;

                let cartItem = $(this).data('value');

                async function getItem() {
                    const data = {
                        quantity: quantity,
                    };

                    await fetch(link + 'api/cart/update/' + id, {
                        method: 'PUT',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify(data),
                    }).then(response => {
                        if (response.status == 200) {
                            changeTotal(totalQuantity, cartItem, quantity);
                            calculationTotalCart();
                        }

                    }).catch(error => );
                }

                getItem();
            })
        })

        async function calculationTotalCart() {
            let results = await getAllCart();
            let total = 0;
            for (let i = 0; i < results.length; i++) {
                total = total + results[i]['price'] * results[i]['quantity'];
            }
            let result = await convertCurrency(parseFloat(total));
            let totalText = result + ' ' + currency;
            $('#max-total').text(totalText);
        }

        calculationTotalCart();

        async function changeTotal(totalQuantity, cartItem, quantity) {
            let total = cartItem['price'] * parseFloat(quantity);
            let result = await convertCurrency(parseFloat(total));
            totalQuantity.innerText = result + ' ' + currency;
        }

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
    </script>
@endsection