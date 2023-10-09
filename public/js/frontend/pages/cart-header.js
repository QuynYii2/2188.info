
let textSalePrice = $('#sale-price');
let textCheckoutPrice = $('#checkout-price');
let inputTotalPrice = $('#total_price');
let textShipPrice = $('#shipping-price');
let inputShipPrice = $('#shipping_price');
let inputDiscountPrice = $('#discount_price');
let inputPriceId = $('#price_id');

// async function calculationTotalCart() {
//     let results = await getAllCart();
//     let total = 0;
//     let ship = 0;
//     let sales = 0;
//     for (let i = 0; i < results.length; i++) {
//         total = total + results[i]['price'] * results[i]['quantity'];
//         let productSale = await getProductSale(results[i]['product_id'], results[i]['quantity']);
//         if (productSale) {
//             ship = ship + productSale['ship'];
//         }
//     }
//     inputShipPrice.val(ship);
//     inputDiscountPrice.val(sales);
//     inputTotalPrice.val(total);
//     let checkout = total + ship - sales;
//     inputPriceId.val(checkout);
//     let result = await convertCurrency(parseFloat(total));
//     let totalText = result + ' ' + currency;
//     let shipPrice = await convertCurrency(parseFloat(ship));
//     let shipPriceText = shipPrice + ' ' + currency;
//     let salePrice = await convertCurrency(parseFloat(sales));
//     let salePriceText = salePrice + ' ' + currency;
//     let checkoutPrice = await convertCurrency(parseFloat(checkout));
//     let checkoutPriceText = checkoutPrice + ' ' + currency;
//     textShipPrice.text(shipPriceText)
//     textSalePrice.text(salePriceText)
//     textCheckoutPrice.text(checkoutPriceText);
//     $('#max-total1').text(totalText);
// }
//
// calculationTotalCart();

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

async function renderCart() {
    let url = urlshowCart;

    await $.ajax({
        url: url,
        method: 'GET',
    })
        .done(function (response) {
            console.log(response)
            $('#closeShop').empty().append(response);
        })
        .fail(function (_, textStatus) {
            console.log(textStatus)
        });
}

async function deleteCart(id) {
    let url = urldeleteCart;
    url = url.replace(':cart', id);
    let data = {
        _token: tokenCart,
    };

    await $.ajax({
        url: url,
        data: data,
        method: 'POST'
    })
        .done(function (response) {
            renderCart();
        })
        .fail(function (_, textStatus) {
            console.log(textStatus)
        });
}

async function callCart() {
    await $('.btnDeleteCart').on('click', function () {
        let id = $(this).data('id');
        deleteCart(id);
    })
}

callCart();
