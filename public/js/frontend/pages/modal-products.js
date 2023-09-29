    var url = document.getElementById('inputUrl');
    $('.view_modal').on('click', function () {
    var product = $(this).data('value');
    var productDetail = $(this).data('id');
    let urggg = document.getElementById('url').value;
    $('#form_cart').attr('action', urggg + '/' + product['id']);
    var modal_img = document.getElementById('img-modal')
    modal_img.src = url.value + '/' + product['thumbnail'];
    var modal_name = document.getElementById('productName-modal')
    modal_name.innerText = product['name'];
    var price_sale = document.getElementById('price-sale')
    price_sale.innerText = product['price'];
    var qty = document.getElementById('qty')
    qty.innerText = product['qty'];
    var input_price = document.getElementById('input_price')
    input_price.value = product['price'];
    var price_old = document.getElementById('price-old')
    price_old.innerText = product['old_price'];
    var description_text = document.getElementById('description-text')
    description_text.innerHTML = productDetail['description'];
    var variable = document.getElementById('variable_id')
    variable.value = productDetail['variation'];
})
