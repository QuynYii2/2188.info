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
    let currency = $('#valueCurrency').text();
    $(document).ready(function () {
        function getvoucher() {
            $('#voucher option').each(function () {
                if ($(this).is(':selected')) {
                    let myArray = this.value.split("-");
                    let arrayProducts = myArray[0].split(",");
                    let arrayPrice = [];
                    for (let i = 0; i < arrayProducts.length; i++) {
                        var url = document.getElementById('url').value;

                        function myfunction(id) {
                            fetch(url + '/' + id, {
                                method: 'GET'
                            })
                                .then(response => {
                                    if (response.status == 200) {

                                        return response.json();
                                    }
                                })
                                .then((response) => {

                                    let price = response['price'];
                                    let pricePercent = price * myArray[1] / 100;
                                    arrayPrice.push(pricePercent)
                                    let totalPriceDiscount = 0;
                                    for (let i = 0; i < arrayPrice.length; i++) {
                                        totalPriceDiscount = parseFloat(totalPriceDiscount) + parseFloat(arrayPrice[i]);
                                    }
                                    let salePrice = document.getElementById('voucher_discount_price');
                                    salePrice.value = totalPriceDiscount;

                                    let voucherID = document.getElementById('voucher_id');
                                    voucherID.value = myArray[2];

                                    getAllTotal();

                                })
                                .catch(error => );
                        }

                        myfunction(arrayProducts[i]);
                    }
                }
            })
        }

        function getAllTotal() {
            let totalMax = document.getElementById('max-total');
            let totalPrice = document.getElementById('total-price');
            let shippingPrice = document.getElementById('shipping-price');
            let salePrice = document.getElementById('sale-price');
            let salePriceByRank = document.getElementById('discount_price_by_rank');
            let salePriceByVoucher = document.getElementById('voucher_discount_price');
            let checkOutPrice = document.getElementById('checkout-price');
            let valuePrice = document.getElementsByClassName('price-quantity');


        }

        getAllTotal();

        getvoucher();

        let textSalePrice = $('#sale-price');
        let textCheckoutPrice = $('#checkout-price');
        let inputTotalPrice = $('#total_price');
        let textShipPrice = $('#shipping-price');
        let inputShipPrice = $('#shipping_price');
        let inputDiscountPrice = $('#discount_price');
        let inputPriceId = $('#price_id');

        async function calculationTotalCart() {
            let results = await getAllCart();
            let total = 0;
            let ship = 0;
            let sales = 0;
            for (let i = 0; i < results.length; i++) {
                total = total + results[i]['price'] * results[i]['quantity'];
                let productSale = await getProductSale(results[i]['product_id'], results[i]['quantity']);
                if (productSale) {
                    ship = ship + productSale['ship'];
                }
            }
            inputShipPrice.val(ship);
            inputDiscountPrice.val(sales);
            inputTotalPrice.val(total);
            let checkout = total + ship - sales;
            inputPriceId.val(checkout);
            let result = await convertCurrency(parseFloat(total));
            let totalText = result + ' ' + currency;
            let shipPrice = await convertCurrency(parseFloat(ship));
            let shipPriceText = shipPrice + ' ' + currency;
            let salePrice = await convertCurrency(parseFloat(sales));
            let salePriceText = salePrice + ' ' + currency;
            let checkoutPrice = await convertCurrency(parseFloat(checkout));
            let checkoutPriceText = checkoutPrice + ' ' + currency;
            textShipPrice.text(shipPriceText)
            textSalePrice.text(salePriceText)
            textCheckoutPrice.text(checkoutPriceText);
            $('#max-total').text(totalText);
        }

        calculationTotalCart();

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

        async function getProductSale(product, quantity) {
            const requestData = {
                _token: '{{ csrf_token() }}',
                productID: product,
                quantity: quantity,
            };

            try {
                let productSale = await $.ajax({
                    url: `{{route('member.product.sales')}}`,
                    method: 'GET',
                    data: requestData,
                    body: JSON.stringify(requestData),
                })
                return productSale;
            } catch (error) {
                throw error;
            }
        }
    })

    $(document).ready(function () {
        if ($("#order-by-immediate").prop("checked")) {
            $("#payment-info").addClass("d-none");
            $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
        } else if ($("#order-by-card").is(":checked")) {
            $("#payment-info").removeClass("d-none");
            $('#checkout-form').attr('action', '{{route('checkout.create.imm')}}');
        } else if ($("#order-by-e-wallet").is(":checked")) {
            $("#payment-info").addClass("d-none");
            $('#checkout-form').attr('action', '{{route('checkout.create.vnpay')}}');
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
            $('#checkout-form').attr('action', '{{route('checkout.create.vnpay')}}');
        } else if ($("#order-by-coin").is(":checked")) {
            $("#payment-info").addClass("d-none");
            $('#checkout-form').attr('action', '{{route('checkout.create.coin')}}');
        }
    });

</script>