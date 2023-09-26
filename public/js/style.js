//RESPONSIVE HEADER

function menuMobile() {
    document.getElementById("demo").classList.add('active');
    document.getElementsByClassName("opacity_menu")[0].classList.add('active');
}
function closeMobile() {
    document.getElementById("demo").classList.remove('active');
    document.getElementsByClassName("opacity_menu")[0].classList.remove('active');
}

function Search_mobile() {
    document.getElementById("search").classList.add('active');
    document.getElementsByClassName("search")[0].classList.add('active');
}
function closeSearch() {
    document.getElementById("search").classList.remove('active');
    document.getElementsByClassName("search")[0].classList.remove('active');
}

function signIn() {
    document.getElementById("signMenu").classList.add('active');
    document.getElementsByClassName("close-signMenu")[0].classList.add('active');
}
function closesignIn() {
    document.getElementById("signMenu").classList.remove('active');
    document.getElementsByClassName("close-signMenu")[0].classList.remove('active');
}

function Shop() {
    document.getElementById("closeShop").classList.add('active');
    document.getElementsByClassName("closeShopMenu")[0].classList.add('active');
}
function closeShop() {
    document.getElementById("closeShop").classList.remove('active');
    document.getElementsByClassName("closeShopMenu")[0].classList.remove('active');
}

function ShopM() {
    document.getElementById("closeShopM").classList.add('active');
    document.getElementsByClassName("closeShopMenuM")[0].classList.add('active');
}
function closeShopM() {
    document.getElementById("closeShopM").classList.remove('active');
    document.getElementsByClassName("closeShopMenuM")[0].classList.remove('active');
}

function signInM() {
    document.getElementById("signMenuM").classList.add('active');
    document.getElementsByClassName("close-signMenuM")[0].classList.add('active');
}
function closesignInM() {
    document.getElementById("signMenuM").classList.remove('active');
    document.getElementsByClassName("close-signMenuM")[0].classList.remove('active');
}

//RESPONSIVE HEADER END


//SWIPER START
new Swiper(".mySwiper", {
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".Categories", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        300: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
        },
        1500: {
            slidesPerView: 6,
            spaceBetween: 25,
        },
    },
});

new Swiper(".CategoriesOne", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
        },
        1500: {
            slidesPerView: 6,
            spaceBetween: 25,
        },
    },
});

new Swiper(".NewProducts", {

    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        800: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".FeaturedProducts", {
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".HotDeals", {
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".advertisementBanner",{
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
});

new Swiper(".swipertopSearch", {
    slidesPerView: 5,
    spaceBetween: 30,
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        900: {
            slidesPerView: 5,
            spaceBetween: 10,
        },
    },
    pagination: {
    el: ".swiper-pagination",
    clickable: true,
},
});

new Swiper(".secondrightSwiper",{
    slidesPerView: 4,
    grid: {
        rows: 2,
    },
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

new Swiper(".HotDeal", {
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 5,
            spaceBetween: 10,
        },
        900: {
            slidesPerView: 6,
            spaceBetween: 10,
        },
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".listProduct", {
    slidesPerView: 5,
    spaceBetween: 40,
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        600: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".Category_listProduct", {
    slidesPerView: 2,
    spaceBetween: 40,
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
    },
    mousewheel: true,
    keyboard: true,
});

new Swiper(".TopBrands", {
    slidesPerView: 6,
    spaceBetween: 40,
    cssMode: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        300: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        800: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
        1500: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
    },
    mousewheel: true,
    keyboard: true,
});

//SWIPER END



function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Show More";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Show Less";
        moreText.style.display = "inline";
    }
}
function ToggleOption(element){
    if(element.parentElement.parentElement.parentElement.classList.contains("open")){
        element.parentElement.parentElement.parentElement.classList.remove("open");

    }
    else{
        element.parentElement.parentElement.parentElement.classList.add("open");
    }
}

function setBackgroundColors(element){
    let AllOptionContainer = document.getElementsByClassName("OptionContainer");
    for (let index = 0; index < AllOptionContainer.length; index++) {
        let OptionContainer = AllOptionContainer[index];
        var elsParentClasses = [];
        while (OptionContainer) {
            if(OptionContainer.classList){
                for (let index2 = 0; index2 < OptionContainer.classList.length; index2++) {
                    const className = OptionContainer.classList[index2];
                    elsParentClasses.unshift(className);
                }
                OptionContainer = OptionContainer.parentNode;
            }
            else{
                break;
            }
        }

        let r = 0;
        let g = 21;
        let b = 40;
        let factor = elsParentClasses.filter(x => x == "OptionContainer").length;
        r = r * factor;
        g = g * factor;
        b = b * factor;
        AllOptionContainer[index].style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
    }
}

setBackgroundColors();






//WISH LIST










//categorySearch
    $(document).ready(function () {
    $('.categorySearch').on('click', function () {
        let id = $(this).data('id');
        console.log(id);
        $('#category_search').val(id);
    })
})

    // Hàm logout
function logout(url, token) {
    var form = document.createElement('form');

    form.action = url;
    form.method = 'POST';

    var csrfTokenInput = document.createElement('input');
    csrfTokenInput.type = 'hidden';
    csrfTokenInput.name = '_token';
    csrfTokenInput.value = token;

    form.appendChild(csrfTokenInput);

    document.body.appendChild(form);

    form.submit();
}



    //CATEGORY
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
    const url = '/category/filter/' + getIdCategory();
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
    _token: '{{ csrf_token() }}',
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

//CATEOGTY END


