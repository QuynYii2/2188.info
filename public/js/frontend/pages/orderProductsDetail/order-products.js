var productItemInfo = [];
$(document).ready(function () {
    $('.input_quantity').on('input', function () {


        let number = $(this).data('id');
        let tdParent = $(this).parent().siblings(".priceTransport");
        // get price
        let idPrice = 'productPrice' + number;
        let textPrice = 'textPrice' + number;

        let itemValue = $(this).val();

        let product = $(this).data('product');

        let priceOld = product['price'];

        let currencies = document.getElementsByClassName('currency');
        let currency = currencies[0].innerText;

        // get product sale

        // order
        let variable = $(this).data('variable');
        let quantity = $(this).val();
        let item = quantity + '&' + variable;

        let index = productItemInfo.findIndex(element => {
            return element.endsWith(variable);
        });

        if (quantity > 0) {
            if (index !== -1) {
                productItemInfo[index] = item;
            } else {
                productItemInfo.push(item);
            }
        } else {
            if (index !== -1) {
                productItemInfo.splice(index, 1);
            }
        }

        let value = null;
        if (productItemInfo.length > 0) {
            for (let i = 0; i < productItemInfo.length; i++) {
                if (!value) {
                    value = productItemInfo[i];
                } else {
                    value = value + '#' + productItemInfo[i];
                }
            }
        }
        getSales();

        $('#productInfo').val(value);

    })

    async function getSales() {
        try {
            let productSale = await getProductSale(itemValue);
            if (productSale) {
                let priceSale = productSale['sales'];
                let result = await convertCurrency(priceSale);
                $('#' + textPrice).text(result);
                $('#' + idPrice).val(priceSale);
                let priceShip = await convertCurrency(productSale['ship']);
                let priceShipText = priceShip + ' ' + currency;
                tdParent.text(priceShipText)
                changeDataTotal(productSale['ship']);
            } else {
                let result = await convertCurrency(priceOld);
                $('#' + textPrice).text(result);
                $('#' + idPrice).val(priceOld);
                tdParent.text(0);
                changeDataTotal(0);
            }
        } catch (error) {
            console.error(error);
        }
    }

    function changeDataTotal(ship) {
        let price = $('#' + idPrice).val();
        //total
        let total = parseFloat(price) * itemValue + ship;

        console.log(total)
        // using function convertCurrency(total);
        async function main() {
            try {
                let result = await convertCurrency(total);
                let totalConvert = result + ' ' + currency;
                $('#total-price' + number).text(totalConvert);
            } catch (error) {
                console.error(error);
            }
        }

        // render total
        main();
    }

    // call api convert currency
    async function convertCurrency(total) {
        let url = urla;
        url = url.replace(':total', total);

        try {
            let response = await $.ajax({
                url: url, method: 'GET',
            });
            return response;
        } catch (error) {
            throw error;
        }
    }

    async function getProductSale(quantity) {
        const requestData = {
            _token: token, productID: products, quantity: quantity,
        };

        try {
            let productSale = await $.ajax({
                url: urlb, method: 'GET', data: requestData, body: JSON.stringify(requestData),
            })
            return productSale;
        } catch (error) {
            throw error;
        }
    }

    $('#supBtnOrder').on('click', function () {
        $('#formOrderMember').trigger("submit");
    })
})
