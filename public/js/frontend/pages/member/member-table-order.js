var productItemInfo = [];
$(document).ready(function () {
    function checkInput() {
        let listInput = document.getElementsByClassName('input_quantity');
        let check = false;
        for (let i = 0; i < listInput.length; i++) {
            if (listInput[i].value > 0) {
                check = true;
                break;
            }
        }

        if (check == true) {
            document.getElementById("supBtnOrder").disabled = false;
        } else {
            document.getElementById("supBtnOrder").disabled = true;
        }
    }

    checkInput();

    // Check data previous of input, set data-val of input
    $('.input_quantity').on('focusin', function () {
        $(this).data('val', parseInt($(this).val()));
    });

    $('.input_quantity').on('change', function () {
        let number = $(this).data('id');
        let tdParent = $(this).parent().siblings(".priceTransport");
        // get price
        let idPrice = 'productPrice' + number;
        let textPrice = 'textPrice' + number;

        checkInput();

        // get data-val of input change
        let prevValue = parseInt($(this).data('val'));
        // get current value of input change
        let itemValue = parseInt($(this).val());

        let product = $(this).data('product');

        let priceOld = product['price'];

        let productMin = product['min'];

        //Compare prev value with current value
        if (itemValue > prevValue) {
            // Set min of input
            if (itemValue < productMin) {
                itemValue = productMin;
                $(this).val(productMin);
            }
        } else if (itemValue < prevValue) {
            // Set value of input = 0
            if (itemValue < productMin) {
                itemValue = 0;
                $(this).val(0);
            }
        }

        // Re-set data-val of input
        $(this).data('val', itemValue);

        let currencies = document.getElementsByClassName('currency');
        let currency = currencies[0].innerText;

        // get product sale
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

        getSales();

        async function changeDataTotal(ship) {
            let price = $('#' + idPrice).val();
            //total
            let total = parseFloat(price) * itemValue + ship;

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
            await main();
        }

        changeDataTotal(0);

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

        $('#productInfo').val(value);

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

    async function getProductSale(quantity) {
        const requestData = {
            _token: token,
            productID: productID,
            quantity: quantity,
        };

        try {
            let productSale = await $.ajax({
                url: urlProductSale,
                method: 'GET',
                data: requestData,
                body: JSON.stringify(requestData),
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
