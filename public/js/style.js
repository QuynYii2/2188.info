function menuMobile() {
    document.getElementById("demo").classList.add('active');
    document.getElementsByClassName("opacity_menu")[0].classList.add('active');
}

function closemenuMobile() {
    document.getElementById("demo").classList.remove('active');
    document.getElementsByClassName("opacity_menu")[0].classList.remove('active');
}

function menuMobile() {
    document.getElementById("demo").classList.add('active');
    document.getElementsByClassName("opacity_menu")[0].classList.add('active');
}

function closemenuMobile() {
    document.getElementById("demo").classList.remove('active');
    document.getElementsByClassName("opacity_menu")[0].classList.remove('active');
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
// function signIn() {
//     document.getElementById("signMenu").classList.add('active');
//     document.getElementsByClassName("close-signMenu")[0].classList.add('active');
// }
//
// function closesignIn() {
//     document.getElementById("signMenu").classList.remove('active');
//     document.getElementsByClassName("close-signMenu")[0].classList.remove('active');
// }


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
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 40,
        },
        1024: {
            slidesPerView: 6,
            spaceBetween: 50,
        },
    },
    mousewheel: true,
    keyboard: true,
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
        1024: {
            slidesPerView: 3,
            spaceBetween: 40,
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
        1024: {
            slidesPerView: 3,
            spaceBetween: 40,
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
        1024: {
            slidesPerView: 5,
            spaceBetween: 40,
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
        1024: {
            slidesPerView: 5,
            spaceBetween: 40,
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
        1024: {
            slidesPerView: 5,
            spaceBetween: 40,
        },
    },
    mousewheel: true,
    keyboard: true,
});

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