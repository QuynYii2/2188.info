<div class="d-flex pb-4">
    <span class="cart mr-4">{{ __('home.REVIEW YOUR CART') }}</span>
    <span>{{count($cartViews)}} {{ __('home.item') }}</span>
</div>
<div class="shop-list">
    @php
        $cartItems = \App\Models\Cart::where([
            ['user_id', Auth::user()->id],
            ['status', \App\Enums\CartStatus::WAIT_ORDER]])->get();
    @endphp
    @if ($cartItems->isEmpty())
        <p>{{ __('home.There are no products in the cart') }}</p>
    @else
        @foreach ($cartItems as $cartItem)
            @php
                $productDetail = \App\Models\Variation::where('product_id', $cartItem->product->id)->first();
            @endphp
            <div class="shop-item row">
                <div class="col-3 shop-item--img">
                    <img src="{{ asset('storage/'.$cartItem->product->thumbnail) }}"
                         alt="">
                </div>
                <div class="col-8 shop-item--text">
                    <div class="text-seller">
                        {{ ($cartItem->product->user->name) }}
                    </div>
                    <div class="text-name">
                        <a href="{{route('detail_product.show', $cartItem->product->id)}}">
                            @if(locationHelper() == 'kr')
                                <div class="item-text">{{ $cartItem->product->name_ko }}</div>
                            @elseif(locationHelper() == 'cn')
                                <div class="item-text">{{$cartItem->product->name_zh}}</div>
                            @elseif(locationHelper() == 'jp')
                                <div class="item-text">{{$cartItem->product->name_ja}}</div>
                            @elseif(locationHelper() == 'vi')
                                <div class="item-text">{{$cartItem->product->name_vi}}</div>
                            @else
                                <div class="item-text">{{$cartItem->product->name_en}}</div>
                            @endif
                            x {{ $cartItem->quantity }} </a>
                    </div>
                    <div class="text-properties">
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
                                            $att = \App\Models\Attribute::where('id', $arrayAttPro[0])
                                                ->where('status', \App\Enums\AttributeStatus::ACTIVE)->first();
                                            $pro = \App\Models\Properties::where('id', $arrayAttPro[1])
                                                ->where('status', \App\Enums\PropertiStatus::ACTIVE)->first();
                                        }
                                    @endphp
                                    @if(count($arrayAttPro)>1)
                                        @if($att)
                                            <p>
                                                                                    <span>{{($att->name)}}
                                                                                        @if($pro)
                                                                                            / {{($pro->name)}}
                                                                                        @endif
                                                                                    </span>
                                                <span><i class="fa-regular fa-pen-to-square"></i></span>
                                            </p>
                                        @endif
                                    @endif
                                @endif

                            @endforeach
                            <a class="text-edit" href="#" data-toggle="modal"
                               data-target="#exampleModalEditCart">
                                <i class='fas fa-edit'></i>
                                {{ __('home.Change') }}
                            </a>
                            <div class="modal fade" id="exampleModalEditCart"
                                 tabindex="-1"
                                 aria-labelledby="exampleModalEditCartLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="exampleModalEditCartLabel">
                                                Edit {{($cartItem->product->name)}}</h5>
                                            <button type="button" class="close"
                                                    data-dismiss="modal"
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
                                                    {{ __('home.Size') }}:
                                                    <small>
                                                        *
                                                    </small>
                                                    <span data-option-value=""></span>
                                                </label>

                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="form-option-wrapper">
                                                        <input class="form-radio"
                                                               type="radio"
                                                               id="attribute_rectangle__189_374"
                                                               name="attribute[189]"
                                                               value="374"
                                                               required=""
                                                               data-state="false">
                                                        <label class="form-option unavailable"
                                                               for="attribute_rectangle__189_374"
                                                               data-product-attribute-value="374">
                                                            <span class="form-option-variant">32 inch</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-option-wrapper">
                                                        <input class="form-radio"
                                                               type="radio"
                                                               id="attribute_rectangle__189_375"
                                                               name="attribute[189]"
                                                               value="375"
                                                               required=""
                                                               data-state="false">
                                                        <label class="form-option unavailable"
                                                               for="attribute_rectangle__189_375"
                                                               data-product-attribute-value="375">
                                                            <span class="form-option-variant">42 inch</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-option-wrapper">
                                                        <input class="form-radio"
                                                               type="radio"
                                                               id="attribute_rectangle__189_376"
                                                               name="attribute[189]"
                                                               value="376"
                                                               checked=""
                                                               data-default=""
                                                               required=""
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
                    @php
                        $currencyController = new \App\Http\Controllers\CurrencyController();
                        $currencyValue = $currencyController->getCurrency(request(), $cartItem->price*$cartItem->quantity);
                    @endphp
                    <div class="text-price">{{ $currencyValue }}</div>
                </div>
                <div class="col-1">
                    <button class="btnDeleteCart" type="button" data-id="{{$cartItem->id}}"> X</button>
                </div>
            </div>
        @endforeach
        <hr class="mt-5 mb-5">
        <div class="pay">
            <div class="total mb-4">
                <div class="subtotal"></div>
                <div class="grandtotal d-flex justify-content-between ">
                    <span>{{ __('home.Grand Total') }}:</span>
                    <span id="max-grandTotal"> </span>
                </div>
            </div>
            <div class="cart">
                <a class="a-cart" href="{{ route('checkout.show') }}">
                    <div class="check_now">
                        {{ __('home.Check out now') }}
                    </div>
                </a>
                <a class="a-card" href="{{ route('cart.index') }}">
                    <div class="view-card">
                        {{ __('home.View Cart') }}
                    </div>
                </a>
            </div>
        </div>
    @endif
</div>

<script>
    var urlshowCart = `{{route('showCart')}}`;
    var urlDelete = `{{route('deleteCart',  ['id' => ':cart'])}}`
    var urlrenderCart = `{{route('renderCart')}}`
</script>
<script src="{{asset('js/frontend/pages/cart-item.js')}}"></script>