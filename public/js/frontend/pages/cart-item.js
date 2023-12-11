async function deleteCart(id) {
    let url = urlDelete;
    url = url.replace(':cart', id);
    let data = {
        _token: token,
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
