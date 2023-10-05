function responsiveTable(y) {
    let tabs = document.getElementsByClassName('product-map');
    var i;
    for (i = 0; i < tabs.length; i++) {
        if (y.matches) {
            tabs[i].classList.remove("col-md-4");
            tabs[i].classList.add("col-sm-6");
        }
    }
}

var y = window.matchMedia("(max-width: 991px)")
responsiveTable(y);
y.addListener(responsiveTable)

function myFunciton(x) {
    //filter-content
    let tabs = document.getElementsByClassName('toggle-link');
    let items = document.getElementsByClassName('filter-content');
    var i;
    for (i = 0; i < tabs.length; i++) {
        if (x.matches) {
            tabs[i].classList.add("collapsed");
            tabs[i].setAttribute('aria-expanded', 'false');
            items[i].classList.remove("show");
            items[i].classList.add("in");
            console.log('a')
        }
    }
}

var x = window.matchMedia("(max-width: 767px)")
myFunciton(x);
x.addListener(myFunciton)


$(".items > li > a").click(function (e) {
    e.preventDefault();
    var $this = $(this);
    if ($this.hasClass("expanded")) {
        $this.removeClass("expanded");
    } else {
        $(".items a.expanded").removeClass("expanded");
        $this.addClass("expanded");
        $(".sub-items").filter(":visible").slideUp("normal");
    }
    $this.parent().children("ul").stop(true, true).slideToggle("normal");
});

$(".sub-items a").click(function () {
    $(".sub-items a").removeClass("current");
    $(this).addClass("current");
});

const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");
let priceGap = 1;

priceInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);

        if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
            if (e.target.className === "input-min") {
                rangeInput[0].value = minPrice;
                range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
            } else {
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if (e.target.className === "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
    input.addEventListener("change", () => {
        switch (input.className.split('-')[1]) {
            case 'max':
                maxPrice = input.value
                break;
            case 'min':
                minPrice = input.value
                break;
        }
        callApiFilter();
    });
});


let sortBy = '';
let countPerPage = '';
let search_origin = '';
let selectedPayments = [];
let selectedTransports = [];
let minPrice = '';
let maxPrice = '';
let isSale = false;

selectedPayments.push('0');
selectedTransports.push('0');
const jq = $.noConflict();
loadData();

async function loadData() {
    await handleCountPerPage();
    await handleSortBy();
    await callApiFilter();
}

$(document).on('change', '#count-per-page', function () {
    handleCountPerPage();
    callApiFilter();
});


$(document).on('change', '#sort-by', function () {
    handleSortBy();
    callApiFilter();
});


function getIdCategory() {
    let arrUrl = window.location.href.split('/');
    return arrUrl[arrUrl.length - 1];
}

function searchOrigin(input) {
    search_origin = input.value
    callApiFilter();
}

function checkSale(input) {
    isSale = input.checked;
    callApiFilter();
}

function callApiFilter() {
    const url = urla + getIdCategory();
    let data = {
        sortBy: sortBy,
        countPerPage: countPerPage,
        selectedPayments: selectedPayments,
        selectedTransports: selectedTransports,
        minPrice: minPrice,
        maxPrice: maxPrice,
        search_origin: search_origin,
        isSale: isSale,
    }
    jq.ajax({
        url: url,
        method: 'POST',
        data: {
            _token: token,
            data: data,
        },
        success: function (response) {
            document.getElementById('renderProduct').innerHTML = response;
        },
        error: function (exception) {
            console.log(exception)
        }
    });
}

function handleSortBy() {
    sortBy = document.getElementById('sort-by').value
}

function handleCountPerPage() {
    countPerPage = document.getElementById('count-per-page').value
}

const paymentCheckboxes = document.querySelectorAll('.payment-checkbox');
paymentCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', (event) => {
        const paymentId = event.target.value;

        if (event.target.checked) {
            selectedPayments.push(paymentId);
        } else {
            const index = selectedPayments.indexOf(paymentId);
            if (index !== -1) {
                selectedPayments.splice(index, 1);
            }
        }
        callApiFilter();
    });
});


const transportCheckboxes = document.querySelectorAll('.transport-checkbox');
transportCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', (event) => {
        const transportId = event.target.value;

        if (event.target.checked) {
            selectedTransports.push(transportId);
        } else {
            const index = selectedTransports.indexOf(transportId);
            if (index !== -1) {
                selectedTransports.splice(index, 1);
            }
        }
        callApiFilter();
    });
});
