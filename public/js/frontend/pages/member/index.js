var renderInputAttribute = $('#renderProductMember');

$('.thumbnailProduct').on('click', function () {
    let product = $(this).data('value');
    let number = $(this).parent().parent().data('id');
    let productNames = document.getElementsByClassName('productName' + number);
    let productCodes = document.getElementsByClassName('productCode' + number);
    let imgProductMains = document.getElementsByClassName('imgProductMain' + number);
    let productIdBtns = document.getElementsByClassName('partnerBtn' + number);

    let mainImg = document.getElementsByClassName('thumbnailProductMain');
    let i;

    for (i = 0; i < productIdBtns.length; i++) {
        productIdBtns[i].setAttribute('data-value', product['id']);
    }
    for (i = 0; i < productNames.length; i++) {
        productNames[i].innerText = product['name'];
    }
    for (i = 0; i < productCodes.length; i++) {
        productCodes[i].innerText = product['product_code'];
    }
    for (i = 0; i < imgProductMains.length; i++) {
        imgProductMains[i].src = imgUrl + '/' + product['thumbnail'];
    }

// {{--let productID = mainImg[0].getAttribute('data-id');--}}
// {{----}}
// {{--let idImg = '#imgProductMain' + productID;--}}
// {{--changeImage(idImg, '{{asset('storage/')}}' + '/' + product['thumbnail']);--}}

    let gallery = product['gallery']
    let arrayGallery = gallery.split(',');

    let divthumbnailSupGallerys = document.getElementsByClassName('thumbnailSupGallery' + number)[0].childElementCount;
    for (let i = 1; i <= divthumbnailSupGallerys; i++) {
        let thumbnailGallerys = document.getElementsByClassName('thumbnailGallery' + i)[0];
        if (i < arrayGallery.length) {
            thumbnailGallerys.src = imgUrl + '/' + arrayGallery[i];
        } else {
            thumbnailGallerys.src = imgUrl + '/' + arrayGallery[0];
        }
    }
});

$('.thumbnailProductGallery').on('click', function () {
    let imageUrl = $(this).attr('src');
    let productID = $(this).data('id');
    let idImg = '#imgProductMain' + productID
    changeImage(idImg, imageUrl);
});

function changeImage(id, imageSrc) {
    const sky = document.querySelector(id);
    sky.setAttribute('src', imageSrc);
}

$(document).ready(function () {
    const $document = $(document);

    $document.on('click', '.partnerBtn', function () {
        const product = $(this).data('value');
        renderProduct(product);
    });

    async function renderProduct(product) {
        const requestData = {
            _token: token,
            quantity: 100,
        };

        let url = urlCartApi;
        url = url.replace(':product', product);

        await $.ajax({
            url: url,
            method: 'POST',
            data: requestData,
        })
            .done(function (response) {

                alert('Success!');
                window.location.reload();
            })
            .fail(function (_, textStatus) {
                console.error('Request failed:', textStatus);
            });
    }
});
