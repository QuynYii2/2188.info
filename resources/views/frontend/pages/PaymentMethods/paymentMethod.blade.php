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
<button type="submit"
        class=" mt-3 mb-3 btn btn-danger">{{ __('home.Pay Now') }}</button>


<script>
    var urla = '{{ route('convert.currency', ['total' => ':total']) }}';
    var urlb = '{{ route('member.all.cart') }}';
    var token = '{{ csrf_token() }}';
    var urlsale = '{{route('member.product.sales')}}';
    var imm = '{{route('checkout.create.imm')}}';
    var vnpay = '{{route('checkout.create.vnpay')}}';
    var coin = '{{route('checkout.create.coin')}}';
</script>
<script src="{{asset('js/frontend/pages/PaymentMethods/paymentMethod.js')}}"></script>