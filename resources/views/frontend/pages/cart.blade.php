@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')
    <?php
    $trans = \App\Http\Controllers\TranslateController::getInstance();
    ?>
    <div class="container-fluid cart">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Your Cart</li>
                </ol>
            </nav>
            <h1>Your Cart</h1>
        </div>
        @if ($cartItems->isEmpty())
            <p>Chưa có sản phẩm trong giỏ hàng.</p>
        @else
            <div class="pagelist">
                <table id="table-cart" class="table table-bordered">
                    <thead>
                    <tr class="header">
                        {{--                        <th scope="col">#</th>--}}
                        <th scope="col">ITEM</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">TOTAL</th>
                        <th scope="col">ACTION</th>
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
                        <tr>
                            <td>
                                <div class="row mt-3">
                                    <div class="col-md-2 img-product">
                                        <img class="img" src="{{ asset('storage/'.$cartItem->thumbnail) }}"
                                             alt="" width="60px" height="60px">
                                    </div>
                                    <div class="col-md-10 float-left">
                                        <div class="text-secondary">{{$trans->translateText($cartItem->product->category->name)}}</div>
                                        <a href="{{route('detail_product.show', $cartItem->product->id)}}">{{$trans->translateText($cartItem->product->name)}}</a>
                                        @if($cartItem->values != 0)
                                            @php
                                                $list = $cartItem->values;
                                                $array = explode(',', $list);
                                            @endphp
                                            @foreach($array as $variable)
                                                @php
                                                    $arrayAttPro = explode('-', $variable);
                                                    $att = \App\Models\Attribute::find($arrayAttPro[0]);
                                                    $pro = \App\Models\Properties::find($arrayAttPro[1]);
                                                @endphp
                                                <div class="font-italic"><span class="text-secondary">
                                                {{$trans->translateText($att->name)}}
                                            </span>: <span>{{$trans->translateText($pro->name)}}</span></div>
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
                                                                Edit {{$trans->translateText($cartItem->product->name)}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-field" data-product-attribute="set-rectangle"
                                                                 role="radiogroup" aria-labelledby="rectangle-group-label">
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
                                                                               name="attribute[189]" value="374" required=""
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
                                                                               name="attribute[189]" value="375" required=""
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
                                                                               name="attribute[189]" value="376" checked=""
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
                            <td class="price" id="price-{{ $cartItem->id }}">{{ $cartItem->price }}</td>
                            <td class="quantity text-center">
                                <form>
                                    <input type="text" id="id-cart" value="{{ $cartItem->id }}" hidden/>
                                    <input type="text" id="id-link" value="{{ asset('/') }}" hidden/>
                                    <input class="input-number" type="number" id="quantity-{{ $cartItem->id }}"
                                           name="quantity" style="border-radius: 15px; border-color: #ccc"
                                           value="{{ $cartItem->quantity }}"
                                           onchange="myfunction({{ $cartItem->id }}); "
                                           min="{{$cartItem->product->min}}"/>
                                </form>
                            </td>
{{--                            @dd($percent)--}}
                            @if($percent)
                                <td id="total-quantity-{{ $cartItem->id }}">{{ ($cartItem->price*$cartItem->quantity) - ($cartItem->price*$cartItem->quantity)*$percent/100 }}</td>
                            @else
                                <td id="total-quantity-{{ $cartItem->id }}">{{ $cartItem->price*$cartItem->quantity }}</td>
                            @endif

                            <td>
                                <form class="text-center" action="{{ route('cart.delete', $cartItem->id) }}"
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
                                <input type="text" class="form-control" id="inputPassword2" placeholder="Enter your coupon code">
                            </div>
                            <button type="submit" class="btn mb-2 submit">Apply</button>
                        </form>
                    </div>
                    <div class="text-uppercase">GIFT CERTIFICATE</div>
                    <div class="">
                        <label for="inputPassword2">Enter your coupon code if you have one.</label>
                        <form class="d-flex align-items-center justify-content-between">
                            <div class="form-group">
                                <input type="text" class="form-control" id="inputPassword2" placeholder="Enter your coupon code">
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
                        <span>$ <span id="max-total"> {{ $cartItem->price*$cartItem->quantity }}</span></span>
                    </div>
                    <a href="{{route('checkout.show')}}">
                        <button type="submit" class="btn mb-2 submit float-right submit-100"> Check out</button>
                    </a>
                </div>
            </div>
        @endif
    </div>

    {{--    <style>--}}
    {{--        #table-cart th,--}}
    {{--        #table-cart tr,--}}
    {{--        #table-cart td {--}}
    {{--            white-space: nowrap;--}}
    {{--            width: 100%;--}}
    {{--        }--}}
    {{--    </style>--}}
    {{--    <div class="category pb-3" style="background-color: #f7f7f7">{{ __('home.Cart') }}</div>--}}
    {{--    <div style="background-color: #f7f7f7; padding-bottom: 50px">--}}
    {{--        <div class="container pt-3">--}}
    {{--            <div class="card" style="border: none">--}}

    {{--                @if ($cartItems->isEmpty())--}}
    {{--                    <p>Chưa có sản phẩm trong giỏ hàng.</p>--}}
    {{--                @else--}}
    {{--                    <div class="table-responsive-sm">--}}
    {{--                        <table id="table-cart" class="table">--}}
    {{--                            <thead>--}}
    {{--                            <th>{{ __('home.Product Name') }}</th>--}}
    {{--                            <th>{{ __('home.Price') }}</th>--}}
    {{--                            <th>{{ __('home.quantity') }}</th>--}}
    {{--                            <th>{{ __('home.Total Amount') }}</th>--}}
    {{--                            <th>{{ __('home.Action') }}</th>--}}
    {{--                            </thead>--}}
    {{--                            <tbody>--}}
    {{--                            @foreach ($cartItems as $cartItem)--}}
    {{--                                <tr>--}}
    {{--                                    <td>{{ $cartItem->product->name }}</td>--}}
    {{--                                    <td style="text-align: center" id="price-{{ $cartItem->id }}">--}}
    {{--                                        {{ $cartItem->price }}--}}
    {{--                                        @php--}}
    {{--                                            $vouchers = \App\Models\Voucher::where('status', \App\Enums\VoucherStatus::ACTIVE)->get();--}}
    {{--                                            $checked = false;--}}
    {{--                                            foreach ($vouchers as $voucher){--}}
    {{--                                                $listIDs = $voucher->apply;--}}
    {{--                                                $arrayIDs = explode(',', $listIDs);--}}
    {{--                                                for ($i = 0; $i<count($arrayIDs); $i++){--}}
    {{--                                                    if ($cartItem->product_id == $arrayIDs[$i]){--}}
    {{--                                                        $checked = true;--}}
    {{--                                                    }--}}
    {{--                                                }--}}
    {{--                                            }--}}

    {{--                                            $promotions = \App\Models\Promotion::where('status', \App\Enums\PromotionStatus::ACTIVE)->get();--}}
    {{--                                            $isValid = false;--}}
    {{--                                            foreach ($promotions as $promotion){--}}
    {{--                                                $listIDPs = $promotion->apply;--}}
    {{--                                                $arrayIDPs = explode(',', $listIDPs);--}}
    {{--                                                for ($i = 0; $i<count($arrayIDPs); $i++){--}}
    {{--                                                    if ($cartItem->product_id == $arrayIDPs[$i]){--}}
    {{--                                                        $isValid = true;--}}
    {{--                                                    }--}}
    {{--                                                }--}}
    {{--                                            }--}}

    {{--                                        @endphp--}}
    {{--                                        @if($checked == true)--}}
    {{--                                            <p class="text-danger">San pham dang duoc ap dung giam gia</p>--}}
    {{--                                        @elseif($isValid == true)--}}
    {{--                                                <p class="text-danger">San pham dang duoc khuyen mai</p>--}}
    {{--                                        @endif--}}
    {{--                                    </td>--}}
    {{--                                    <td style="text-align: center">--}}
    {{--                                        <form>--}}
    {{--                                            <input type="text" id="id-cart" value="{{ $cartItem->id }}" hidden/>--}}
    {{--                                            <input type="text" id="id-link" value="{{ asset('/') }}" hidden/>--}}
    {{--                                            <input class="col-7 p-0" type="number" id="quantity-{{ $cartItem->id }}"--}}
    {{--                                                   name="quantity"--}}
    {{--                                                   value="{{ $cartItem->quantity }}"--}}
    {{--                                                   onchange="myfunction({{ $cartItem->id }}); "--}}
    {{--                                                   min="1"/>--}}
    {{--                                        </form>--}}
    {{--                                    </td>--}}
    {{--                                    <td style="text-align: center"--}}
    {{--                                        id="total-quantity-{{ $cartItem->id }}">{{ $cartItem->price*$cartItem->quantity }}</td>--}}
    {{--                                    <td style="text-align: center">--}}
    {{--                                        <form action="{{ route('cart.delete', $cartItem->id) }}" method="POST">--}}
    {{--                                            @csrf--}}
    {{--                                            @method('DELETE')--}}
    {{--                                            <button type="submit"--}}
    {{--                                                    class="btn btn-danger">{{ __('home.Delete') }}</button>--}}
    {{--                                        </form>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}
    {{--                            @endforeach--}}
    {{--                            </tbody>--}}
    {{--                        </table>--}}
    {{--                    </div>--}}
    {{--                    <div class="d-flex justify-content-between">--}}
    {{--                        <p class="ml-2">Tổng: $ <span id="max-total">{{ $cartItem->price*$cartItem->quantity }}</span>--}}
    {{--                        </p>--}}
    {{--                        <div class="mr-2">--}}
    {{--                            <form action="{{route('cart.clear')}}" method="post">--}}
    {{--                                @csrf--}}
    {{--                                @method('DELETE')--}}
    {{--                                <button class="btn btn-danger" type="submit">{{ __('home.Clear Cart') }}</button>--}}
    {{--                            </form>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="mt-3 mb-3 d-flex justify-content-center">--}}
    {{--                        <a href="{{route('checkout.show')}}" class="btn btn-success mt-2">{{ __('home.Pay') }}</a>--}}
    {{--                    </div>--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
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
