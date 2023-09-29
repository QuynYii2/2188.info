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
                            .catch(error => console.log(error));
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
    let url = urla;
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
    let url = urlb;

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
    _token: token,
    productID: product,
    quantity: quantity,
};

    try {
    let productSale = await $.ajax({
    url: urlc,
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
    $('#checkout-form').attr('action', imm);
} else if ($("#order-by-card").is(":checked")) {
    $("#payment-info").removeClass("d-none");
    $('#checkout-form').attr('action', imm);
} else if ($("#order-by-e-wallet").is(":checked")) {
    $("#payment-info").addClass("d-none");
    $('#checkout-form').attr('action', vnpay);
} else if ($("#order-by-coin").is(":checked")) {
    $("#payment-info").addClass("d-none");
    $('#checkout-form').attr('action', coin);
}
})

    $("#choose-method-payment input").change(function () {
    if ($("#order-by-immediate").prop("checked")) {
    $("#payment-info").addClass("d-none");
    $('#checkout-form').attr('action', imm);
} else if ($("#order-by-card").is(":checked")) {
    $("#payment-info").removeClass("d-none");
    $('#checkout-form').attr('action', imm);
} else if ($("#order-by-e-wallet").is(":checked")) {
    $("#payment-info").addClass("d-none");
    $('#checkout-form').attr('action', vnpay);
} else if ($("#order-by-coin").is(":checked")) {
    $("#payment-info").addClass("d-none");
    $('#checkout-form').attr('action', coin);
}
});

    function check() {
    let btnRadio = document.getElementById('address-order2')
    let inputSelect = document.getElementById('address2')

    if (btnRadio.checked === true) {
    inputSelect.disabled = false;
    addressObj = JSON.parse(inputSelect.value);
    change(addressObj)
}
}

    function change(addressObj) {
    let fname = document.getElementById('fname')
    let phone = document.getElementById('phone')
    let address = document.getElementById('address')

    fname.value = addressObj.username;
    phone.value = addressObj.phone
    address.value = addressObj.address_detail + ', ' + addressObj.location + '-' + addressObj.province + '-' + addressObj.city;
}
