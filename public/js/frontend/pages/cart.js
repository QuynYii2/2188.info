$(document).ready(function () {
    $('.input-number').on('change', function () {
        let id = $(this).data('id');
        let quantity = $(this).val();
        let totalQuantity = document.getElementById('total-quantity-' + id);
        let link = document.getElementById('id-link').value;

        let cartItem = $(this).data('value');

        async function getItem() {
            const data = {
                quantity: quantity,
            };

            await fetch(link + linkapi + id, {
                method: 'PUT',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify(data),
            }).then(response => {
                if (response.status == 200) {
                    changeTotal(totalQuantity, cartItem, quantity);
                    calculationTotalCart();
                }

            }).catch(error => {
            });
        }

        getItem();
    })
})

async function calculationTotalCart() {
    let results = await getAllCart();
    let total = 0;
    for (let i = 0; i < results.length; i++) {
        total = total + results[i]['price'] * results[i]['quantity'];
    }
    let result = await convertCurrency(parseFloat(total));
    let totalText = result + ' ' + currency;
    $('#max-total').text(totalText);
}

calculationTotalCart();

async function changeTotal(totalQuantity, cartItem, quantity) {
    let total = cartItem['price'] * parseFloat(quantity);
    let result = await convertCurrency(parseFloat(total));
    totalQuantity.innerText = result + ' ' + currency;
}

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
    let url = urlb

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
