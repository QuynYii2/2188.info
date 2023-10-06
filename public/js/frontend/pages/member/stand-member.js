$('.thumbnailProduct').on('click', function () {
    let product = $(this).data('value');
    let productName = $(this).data('name');
    let imgMain = product['thumbnail'];
    let imageUrl = imageUrlMain + '/' + imgMain;
    let idImg = '#imgProductMain';
    let linkImg = '#linkProductImg';
    changeImage(idImg, imageUrl);
    changeUrl(linkImg, imageUrl);

    let productNames = document.getElementsByClassName('productName');
    for (let i = 0; i < productNames.length; i++) {
        productNames[i].innerHTML = productName
    }

    let productID = product['id'];

    getProductSale(productID);

    renderProduct(productID);

    async function getProductSale(id) {
        let url = urlGetProductSale + '/' + id;
        const response = await fetch(url);
        let value = await response.text();
        $('#tablebodyProductSale').empty().append(value);
    }

    let gallery = product['gallery']
    let arrayGallery = gallery.split(',');
    let arrayUrlImg = []
    for (let i = 0; i < arrayGallery.length; i++) {
        arrayUrlImg.push(imageUrlMain + '/' + arrayGallery[i])
    }

    let string = '';
    let viewImg = '';
    for (let i = 0; i < arrayUrlImg.length; i++) {
        string = string + `<div class="col-md-2 thumbnailSupGallery-img">
                <img src="${arrayUrlImg[i]}" alt="" class="thumbnailProductGallery " data-id="${productID}"></div>`;
        viewImg = viewImg + `<div class="item-card d-none"> <div class="card-image"> <a href="${arrayUrlImg[i]}"
                data-fancybox="gallery" data-caption="${productName}"> <img src="${arrayUrlImg[i]}" class="thumbnailProductMain" alt="">
                </a> </div> </div>`;
    }

    $('#productThumbnail').empty().append(string);
    $('#productImgThumbnail').empty().append(viewImg);
    clickImg();

    // $('#partnerBtn').data('value', product['id']);
    // let partnerBtn = document.getElementById('partnerBtn');
    // partnerBtn.setAttribute('data-value', product['id']);

    $('#btnViewAttribute').data('id', product['id']);
});

function clickImg() {
    $('.thumbnailProductGallery').on('click', function () {
        let imageUrl = $(this).attr('src');
        let idImg = '#imgProductMain'
        let linkImg = '#linkProductImg';
        changeImage(idImg, imageUrl);
        changeUrl(linkImg, imageUrl);
    });
}

clickImg();

function changeImage(id, imageSrc) {
    const sky = document.querySelector(id);
    sky.setAttribute('src', imageSrc);
}

function changeUrl(id, url) {
    const link = document.querySelector(id);
    link.href = url;
}

$(document).ready(function () {
    const $document = $(document);

    $document.on('click', '#partnerBtn', function () {
        const product = $(this).data('value');

        renderProduct(product);
    });

    function renderProduct(product) {
        let listInputQuantity = document.querySelectorAll('.input-quantity');
        let listQuantity = '';
        listInputQuantity.forEach(input => {
            listQuantity += input.value + ',';
        });
        listQuantity = JSON.stringify(listQuantity.slice(0, -1));
        const requestData = {
            _token: token,
            quantity: listQuantity,
            value: JSON.stringify(localStorage.getItem('listID')),
        };

        $.ajax({
            url: `/add-to-cart-register-member/${product}`,
            method: 'POST',
            data: requestData,
        })
            .done(function (response) {
                alert('Success!');
                localStorage.removeItem('listID')
                window.location.reload();
            })
            .fail(function (_, textStatus) {
            });
    }
});

$(document).ready(function () {
    $('#btnViewAttribute').on('click', function () {
        let id = $(this).data('id');
        callAtt(id);
    })
});

function callAtt(id) {
    let url = detailProductModal;
    url = url.replace(':id', id);
    $.ajax({
        url: url,
        method: 'GET',
    })
        .done(function (response) {
            document.getElementById('body-modal-att').innerHTML = response;
        })
        .fail(function (_, textStatus) {
            $('#body-modal-att').empty();
        });
}

var listItem = null;

function getCheckboxs() {
    let checkboxs = document.getElementsByClassName('checkBoxAttribute');
    var listIDs = [];
    for (let i = 0; i < checkboxs.length; i++) {
        if (checkboxs[i].checked == true) {
            let item = checkboxs[i].value;
            listIDs.push(parseInt(item));
        }
    }
    listItem = listIDs;
    localStorage.setItem('listID', listItem);
}

function renderProduct(product) {
    let url = detailProductAttribute;
    url = url.replace(':id', product);

    $.ajax({
        url: url,
        method: 'GET',
    })
        .done(function (response) {
            $('#tableMemberOrder').empty().append(response);
        })
        .fail(function (_, textStatus) {

        });
}

function renderCart() {
    //member.view.carts
    const requestData = {
        _token: token,
    };
    $.ajax({
        url: memberViewCart,
        method: 'GET',
        data: requestData,
    })
        .done(function (response) {
            $('#tableMemberOrderCart').empty().append(response);
        })
        .fail(function (_, textStatus) {
        });
}

renderCart();

$('[data-fancybox="gallery"]').fancybox({
    buttons: [
        "slideShow",
        "thumbs",
        "zoom",
        "fullScreen",
        "share",
        "close"
    ],
    loop: false,
    protect: true
});
