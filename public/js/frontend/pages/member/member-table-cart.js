var priceCart = '#priceCart';
var totalCart = '#totalCart';
var currency = $('.currency').first().text();
$(document).ready(function () {
    $('.input-number-cart').on('change', function () {
        let cartID = $(this).data('id');
        let url = urlCartUpdate;
        url = url.replace(':id', cartID);
        let quantity = $(this).val();

        const requestData = {
            _token: token,
            quantity: quantity,
        };
        $.ajax({
            url: url,
            method: 'PUT',
            data: requestData,
            body: JSON.stringify(requestData),
        })
            .done(function (response) {
                let cartItem = response['cart'];
                let total = parseFloat(cartItem['price']) * parseFloat(cartItem['quantity'])
                convertPriceCart(cartItem['price'], cartID);
                convertTotalCart(total, cartID);
            })
            .fail(function (_, textStatus) {

            });

        // using function convertCurrency(total);
        async function convertTotalCart(total, cartID) {
            try {
                let result = await convertCurrency(total);
                let totalConvert = result + ' ' + currency;
                $(totalCart + cartID).text(totalConvert);
            } catch (error) {
                console.error(error);
            }
        }

        async function convertPriceCart(price, cartID) {
            try {
                let result = await convertCurrency(price);
                $(priceCart + cartID).text(result);
            } catch (error) {
                console.error(error);
            }
        }
    })

    // call api convert currency
    async function convertCurrency(total) {
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
})
