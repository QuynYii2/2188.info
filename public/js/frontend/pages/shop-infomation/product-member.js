var renderInputAttribute = $('#renderProductMember'), productMin, product, productName;
$('.thumbnailProduct').on('click', function () {
    product = $(this).data('value');
    productName = product['name'];
    productMin = product['min'];
    let imgMain = product['thumbnail'];
    let imageUrl;
    if (imgMain.includes("http")){
        imageUrl = imgMain;
    } else {
        imageUrl = imageUrlMain + '/' + imgMain;
    }

    let idImg = '#imgProductMain';
    let linkImg = '#linkProductImg';

    let productNames = document.getElementsByClassName('productName');
    for (let i = 0; i < productNames.length; i++) {
        productNames[i].innerHTML = productName
    }

    let productID = product['id'];
    getProductSale(productID);

    async function getProductSale(id) {
        let url = urlGetProductSale + '/' + id;
        const response = await fetch(url);
        let value = await response.text();
        $('#tablebodyProductSale').empty().append(value);
    }

    renderProduct(productID);
    changeImage(idImg, imageUrl);
    changeUrl(linkImg, imageUrl);

    let gallery = product['gallery']
    let arrayGallery = gallery.split(',');
    let arrayUrlImg = []
    for (let i = 0; i < arrayGallery.length; i++) {
        if (!arrayGallery[i].includes("http")){
            arrayUrlImg.push(imageUrlMain + '/' + arrayGallery[i])
        } else {
            arrayUrlImg.push(arrayGallery[i])
        }
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

    // let partnerBtn = document.getElementById('partnerBtn');
    // partnerBtn.setAttribute('data-value', product['id']);

    $('#btnViewAttribute').data('id', product['id']);
    renderCart();
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

// {{--$(document).ready(function () {--}}
// {{--    const $document = $(document);--}}
//
// {{--    $document.on('click', '#partnerBtn', function () {--}}
// {{--        const product = $(this).data('value');--}}
//
// {{--        renderProduct(product);--}}
// {{--    });--}}
//
// {{--    function renderProduct(product) {--}}
// {{--        let listInputQuantity = document.querySelectorAll('.input-quantity');--}}
// {{--        let listQuantity = '';--}}
// {{--        listInputQuantity.forEach(input => {--}}
// {{--            listQuantity += input.value + ',';--}}
// {{--        });--}}
// {{--        listQuantity = JSON.stringify(listQuantity.slice(0, -1));--}}
// {{--        const requestData = {--}}
// {{--            _token: '{{ csrf_token() }}',--}}
// {{--            quantity: listQuantity,--}}
// {{--            value: JSON.stringify(localStorage.getItem('listID')),--}}
// {{--        };--}}
//
// {{--        $.ajax({--}}
// {{--            url: `/add-to-cart-register-member/${product}`,--}}
// {{--            method: 'POST',--}}
// {{--            data: requestData,--}}
// {{--        })--}}
// {{--            .done(function (response) {--}}
// {{--                alert('Success!');--}}
// {{--                localStorage.removeItem('listID')--}}
// {{--                window.location.reload();--}}
// {{--            })--}}
// {{--            .fail(function (_, textStatus) {--}}
// {{--            });--}}
// {{--    }--}}
// {{--});--}}

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

// $(document).ready(function () {
//     let id = {{$firstProduct->id}};
//     renderProduct(id);
// })

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


let listChecked = [];

function selectAttProduct() {
    listChecked = [];
    let listCheckbox = document.querySelectorAll('#body-modal-att tbody tr');
    listCheckbox.forEach(row => {
        let inputElement = row.querySelector('input.checkBoxAttribute');
        if (inputElement && inputElement.checked) {
            listChecked.push(row)
        }
    });
    renderSelectAttToTable();
}

function renderSelectAttToTable() {
    let table = document.querySelector('#table-selected-att tbody');
    table.innerHTML = '';

    listChecked.forEach(item => {
        let row = document.createElement('tr');
        let cellThuocTinh = document.createElement('td');
        let cellSoLuong = document.createElement('td');
        let cellDonGia = document.createElement('td');
        let cellThanhTien = document.createElement('td');

        let classAtt = '[class^="get-att-"]';
        let classPrice = '.get-price';

        let listAtt = item.querySelectorAll(classAtt);
        let donGia = parseFloat(item.querySelector(classPrice).textContent);
        let inputElement = document.createElement('input');
        inputElement.type = 'number';
        inputElement.classList.add('input-quantity');

        inputElement.min = '0';
        inputElement.value = '1';

        let attTextContent = '';

        let lengthListAtt = listAtt.length;
        for (let i = 0; i < lengthListAtt; i++) {
            attTextContent += listAtt[i].textContent;
            if (listAtt[i + 1]) {
                attTextContent += ' - ';
            }
        }

        cellThuocTinh.textContent = attTextContent;
        cellDonGia.textContent = donGia;

        function updateTotal() {
            let inputSoluong = parseFloat(inputElement.value);
            let thanhTien = calcThanhTien(inputSoluong, donGia);
            cellThanhTien.textContent = thanhTien.toFixed(2); // Display the total with 2 decimal places
        }

        // Calculate the total initially
        updateTotal();

        inputElement.addEventListener('change', updateTotal);

        cellSoLuong.appendChild(inputElement);
        row.appendChild(cellThuocTinh);
        row.appendChild(cellSoLuong);
        row.appendChild(cellDonGia);
        row.appendChild(cellThanhTien);
        table.appendChild(row);
    });
}

function calcThanhTien(inputSoluong, inputDonGia) {
    return inputSoluong * inputDonGia;
}