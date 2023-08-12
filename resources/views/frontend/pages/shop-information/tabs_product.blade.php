<style>
    .checkbox-sale {
        font-size: 15px;
    }

    .category-header--left {
        /* font-size: 18px; */
        font-size: 15px;
    }

    .content-product {
        font-size: 20px;
        font-weight: bold;
        margin-top: 37px;
    }

    .container-right {
        display: flex;
        justify-content: flex-end;
    }

    .tab-content.col-md-9 {
        padding-top: 0px;
        max-width: 100%;
    }
</style>
<div id="body-content">
    <div class="container-right">
        <div class="category-header--right">
            <div class="show-item mr-4 align-items-center">
                <span class="mr-3">{{ __('home.Show') }}</span>
                <select class="drop btn dropdown-toggle" id="count-per-page" aria-label="Default select example">
                    <option selected value="10">{{ __('home.10 products per page') }}</option>
                    <option value="20">{{ __('home.20 products per page') }}</option>
                    <option value="30">{{ __('home.30 products per page') }}</option>
                    <option value="40">{{ __('home.40 products per page') }}</option>
                    <option value="50">{{ __('home.50 products per page') }}</option>
                </select>
            </div>
            <div class="SortBy align-items-center mr-4">
                <span class="mr-3">{{ __('home.Sort By') }}</span>
                <select class="drop btn dropdown-toggle" id="sort-by" aria-label="Default select example">
                    <option value="created_at desc" selected>{{ __('home.Newest Items') }}</option>
                    <option value="name asc">{{ __('home.Name: A to Z') }}</option>
                    <option value="name desc">{{ __('home.Name: Z to A') }}</option>
                    <option value="price asc">{{ __('home.Price: Ascending') }}</option>
                    <option value="price desc">{{ __('home.Price: Descending') }}</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <div class="category-header mt-4 mb-3 d-flex justify-content-between">
        <div class="category-header--left col-xl-2">
            <div class=" justify-content-between align-items-center">
                <div class="checkbox-sale">
                    <input type="checkbox" value="" id="check_sale"
                           onchange="checkSale(this)">{{ __('home.Products on sale') }}
                </div>
                <hr>
                <div class="">
                    <div class="content-product">{{ __('home.PRICE') }}</div>
                    <div class="category-price">
                        <div class="wrapper">
                            <div class="price-input d-flex">
                                <div class="field">
                                    <span>{{ __('home.Min') }}</span>
                                    <input type="number" class="input-min" id="price-min" value="0">
                                </div>
                                <div class="separator">-</div>
                                <div class="field">
                                    <span>{{ __('home.Max') }}</span>
                                    <input type="number" class="input-max" id="price-max"
                                           value="{{ $priceProductOfCategory->maxPrice }}">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>

                            <div class="range-input">
                                <input type="range" class="range-min" min="0"
                                       max="{{ $priceProductOfCategory->maxPrice }}" value="0" step="1">
                                <input type="range" class="range-max" min="0"
                                       max="{{ $priceProductOfCategory->maxPrice }}"
                                       value="{{ $priceProductOfCategory->maxPrice }}" step="1">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="content-product">{{ __('home.ORIGIN') }}</div>
                    <input type="text" value="" id="search-origin" onchange="searchOrigin(this)">
                    <br>
                    {{ __('home.Products by origin') }}
                </div>
            </div>
        </div>
        <div class="category-body container-fluid">
            <div class="card">

                <!-- Tab panes -->
                <div class="tab-content col-md-9">
                    <div id="home" class="tab-pane active "><br>
                        <div class="row" id="renderProduct">
                            @foreach($listProduct as $product)
                                <div class="col-xl-3 col-md-4 col-6 section">
                                    <div class="item">
                                        <div class="item-img">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                 alt="">
                                            <div class="button-view">
                                                <button class="quickView" data-value="{{$product}}">Quick view2</button>
                                            </div>
                                            <div class="text">
                                                <div class="text-sale">
                                                    Sale
                                                </div>
                                                <div class="text-new">
                                                    New
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-body">
                                            <div class="card-rating">
                                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                                <span>(1)</span>
                                            </div>
                                            @php
                                                $namenewProduct = DB::table('users')->where('id', $product->user_id)->first();
                                            @endphp
                                            <div class="card-brand">
                                                {{ ($namenewProduct->name) }}
                                            </div>
                                            <div class="card-title">
                                                <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                                            </div>
                                            <div class="card-price d-flex justify-content-between">
                                                @if($product->price)
                                                    <div class="card-price d-flex justify-content-between">
                                                        @if($product->price != null)
                                                            <div class="price-sale">
                                                                <strong>${{ ($product->price) }}</strong>
                                                            </div>
                                                            <div class="price-cost">
                                                                <strike>${{ ($product->old_price) }}</strike>
                                                            </div>
                                                        @else
                                                            <div class="price-sale">
                                                                <strong>${{ ($product->old_price) }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-bottom d-flex justify-content-between">
                                                <div class="card-bottom--left">
                                                    <a href="{{route('detail_product.show', $product->id)}}">Choose
                                                        Options</a>
                                                </div>
                                                <div class="card-bottom--right">
                                                    <i class="item-icon fa-regular fa-heart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade"><br>
                        @foreach($listProduct as $product)
                            <div class="mt-3 category-list section">
                                <div class="item row">
                                    <div class="item-img col-md-3 col-5">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                             alt="">
                                        <div class="button-view">
                                            <button class="quickView" data-value="{{$product}}">Quick view1</button>
                                        </div>
                                        <div class="text">
                                            <div class="text-sale">
                                                Sale
                                            </div>
                                            <div class="text-new">
                                                New
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-body col-md-9 col-7">
                                        <div class="card-rating">
                                            <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                            <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                            <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                            <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                            <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                            <span>(1)</span>
                                        </div>
                                        @php
                                            $namenewProduct = DB::table('users')->where('id', $product->user_id)->first();
                                        @endphp
                                        <div class="card-brand">
                                            {{ ($namenewProduct->name) }}
                                        </div>
                                        <div class="card-title-list">
                                            <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                                        </div>
                                        <div class="card-price d-flex">
                                            @if($product->price)
                                                <div class="card-price d-flex justify-content-between">
                                                    @if($product->price != null)
                                                        <div class="price-sale">
                                                            <strong>${{ ($product->price) }}</strong>
                                                        </div>
                                                        <div class="price-cost">
                                                            <strike>${{ ($product->old_price) }}</strike>
                                                        </div>
                                                    @else
                                                        <div class="price-sale">
                                                            <strong>${{ ($product->old_price) }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-desc">
                                            {{ $product->description }}
                                        </div>
                                        <div class="card-bottom d-flex mt-3">
                                            <div class="card-bottom--left mr-4">
                                                <a href="{{route('detail_product.show', $product->id)}}">Choose
                                                    Options</a>
                                            </div>
                                            <div class="card-bottom--right">
                                                <i class="item-icon fa-regular fa-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="renderProductImage" class="col-md-3 d-none">
                    <div class="product-gallery">
                        <div class="mb-2">
                            <img id="productThumbnail" class="active"
                                 src="#">
                            <input type="text" id="urlImage" value="{{asset('storage/')}}" hidden="">
                        </div>
                        <ul class="image-list" id="renderListImage">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <button value="1111" class="test">Test click event</button>
</div>
<script>
    $(document).ready(function ($) {
        $('.test').click(function (){
            console.log(1111666);
        });
    })
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
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

</script>
<script>

    $(document).ready(function ($) {
        $(".quickView123").click(function () {
            debugger;

            $('#renderProductImage').removeClass('d-none');
            $('#renderListImage').empty()
            let productID = $(this).data('value');
            let url = $('#urlImage').val();
            console.log('111')
            let thumbnail = $('#productThumbnail' + productID).val()
            $('#productThumbnail').attr('src', url + '/' + thumbnail);
            let gallery = $('#productGallery' + productID).val()
            let arrayImage = gallery.split(',');
            let galleryImage = '';
            console.log('222')
            let script = '<script>$(document).ready(function () {' +
                '$(".imgGalleryItem").on("click", function () { ' +
                '$("#productThumbnail").attr("src", $(this).attr("src"));' +
                '})' +
                '})';
            for (let i = 0; i < arrayImage.length; i++) {
                let urlImage = url + '/';
                let listImage = `<li class="image-item"><img class="imgGalleryItem" alt="" src="${urlImage + arrayImage[i]}"></li>`
                galleryImage = galleryImage + listImage;
            }
            console.log('end')
            $('#renderListImage').append(galleryImage + script);
        })
    })
</script>
<script>
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
        const url = '/shop/product/filter/' + getIdCategory();
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
</script>