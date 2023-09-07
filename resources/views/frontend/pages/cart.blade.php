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
            <h1>{{ __('home.Your Cart') }}</h1>
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

                            $sales = \App\Models\ProductSale::where([
                                ['product_id', $cartItem->product->id],
                                ['quantity','<=', $cartItem->quantity]
                                ])->orderBy('sales', 'desc')->first();

                            $percent = null;
                            if ($sales){
                                $percent = $sales->sales;
                            }
                        @endphp
                        <tr style="border-bottom: 1px solid #dbdbdb">
                            <td>
                                <div class="row mt-3">
                                    <div class="col-md-3 img-product">
                                        <img class="img" src="{{ asset('storage/'.$cartItem->product->thumbnail) }}"
                                             alt="" width="60px" height="60px">
                                    </div>
                                    <div class="col-md-9 float-left">
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
                                                            <button type="button" class=" text-center btn btn-primary">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <p class="mt-2">Gift Wrapping: <span>Add</span></p>
                                    </div>
                                </div>
                            </td>
                            <td class="price" style="vertical-align: middle;"
                                id="price-{{ $cartItem->id }}">{{ number_format(convertCurrency('USD', $currency,$cartItem->price), 0, ',', '.') }} {{$currency}}</td>
                            <td class="quantity"  style="vertical-align: middle;">
                                <form>
                                    <input type="text" id="id-cart" value="{{ $cartItem->id }}" hidden/>
                                    <input type="text" id="id-link" value="{{ asset('/') }}" hidden/>
                                    <input class="input-number" type="number" id="quantity-{{ $cartItem->id }}"
                                           name="quantity" style="border-radius: 30px; border-color: #ccc"
                                           value="{{ $cartItem->quantity }}"
                                           onchange="myfunction({{ $cartItem->id }}); "
                                           min="{{$cartItem->product->min}}"/>
                                </form>
                            </td>
                            <input hidden="" type="text" id="price-percent-{{ $cartItem->id }}"
                                   value="{{ $percent }}">
                            @if($percent)
                                <td id="total-quantity-{{ $cartItem->id }}" style="vertical-align: middle;">
                                    {{ number_format(convertCurrency('USD', $currency,($cartItem->price*$cartItem->quantity) - ($cartItem->price*$cartItem->quantity)*$percent/100), 0, ',', '.') }} {{$currency}}
                                </td>
                            @else
                                <td id="total-quantity-{{ $cartItem->id }}" style="vertical-align: middle;">
                                    {{ number_format(convertCurrency('USD', $currency,$cartItem->price*$cartItem->quantity), 0, ',', '.') }} {{$currency}}
                                </td>
                            @endif

                            <td  style="vertical-align: middle;">
                                <form action="{{ route('cart.delete', $cartItem->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input class="submit" type="submit" value="&times;"/>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row cart-content">
                <div class="col-md-4">
                    <div class="text-uppercase">COUPON CODE</div>
                    <div class="">
                        <label for="inputPassword2">Enter your coupon code if you have one.</label>
                        <form class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputPassword2"
                                       placeholder="Enter your coupon code">
                            </div>
                            <button type="submit" class="btn mb-2 submit">Apply</button>
                        </form>
                    </div>
                    <div class="text-uppercase">GIFT CERTIFICATE</div>
                    <div class="">
                        <label for="inputPassword2">Enter your coupon code if you have one.</label>
                        <form class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputPassword2"
                                       placeholder="Enter your coupon code">
                            </div>
                            <button type="submit" class="btn mb-2 submit">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-uppercase">SHIPPING</div>
                    <div class="">
                        <label for="inputPassword2">Enter your coupon code if you have one.</label>
                        <form>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">Country</span>
                                <div class="form-group">
                                    <select name="" id="">
                                        <option value="">VietNam</option>
                                        <option value="">TrungQuoc</option>
                                        <option value="">Han Quoc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">State/Province</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputPassword2"
                                           placeholder="State/province">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">Suburb/City</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputPassword2"
                                           placeholder="Suburb/City">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-baseline">
                                <span class="mr-3">Zip/Postcode</span>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputPassword2"
                                           placeholder="Zip/Postcode">
                                </div>
                            </div>
                            <button type="submit" class="btn mb-2 submit float-right submit-60">Estimate Shipping
                            </button>
                        </form>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="text-uppercase">COUPON CODE</div>
                    <div class="subtotal d-flex justify-content-between">
                        <span class="">Subtotal: </span>
                        <span class="subtotal-price">0</span>
                    </div>
                    <div class="grandtotal d-flex justify-content-between">
                        <span>Grand total: </span>
                        <span> <span id="max-total"> {{ $cartItem->price*$cartItem->quantity }}</span></span>
                    </div>
                    <a href="{{route('checkout.show')}}">
                        <button type="submit" class="btn mb-2 submit float-right submit-100">Check out</button>
                    </a>
                </div>
            </div>
        @endif
    </div>
    <script>
        function myfunction(id) {

            let quantity = document.getElementById('quantity-' + id).value;
            let totalQuantity = document.getElementById('total-quantity-' + id);
            let price = document.getElementById('price-' + id).innerText;
            let percent = document.getElementById('price-percent-' + id).value;
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
                    totalQuantity.innerText = parseFloat(price) * parseFloat(quantity) - (parseFloat(price) * parseFloat(quantity)) * parseFloat(percent) / 100

                    getAllTotal();
                }
                // window.location.reload()
            }).catch(error => console.log(error));
        }

        function parseCurrencyString(currencyString) {
            return parseFloat(currencyString.replace(/[^\d.-]/g, '').replace('.', ''));
        }

        function formatCurrency(number) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
        }

        function getAllTotal() {
            let totalMax = document.getElementById('max-total');
            let firstCells = document.querySelectorAll('#table-cart td:nth-child(4)');
            let cellValues = [];

            firstCells.forEach(function(singleCell) {
                cellValues.push(singleCell.innerText);
            });

            let total = 0;

            for (let i = 0; i < cellValues.length; i++) {
                let price = parseCurrencyString(cellValues[i]);
                total += price;
            }

            total = formatCurrency(total);
            console.log(total)
            let newArray = total.split(' ₫');
            total = newArray[0] + '.000' + ' VND'
            totalMax.innerText = total;
        }

        getAllTotal();


    </script>
@endsection
