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
