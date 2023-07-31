@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    <div id="body-content">
        <div class="category-banner">
            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-banner-top-layout-2.jpg"
                 alt="">
            <div class="category-name">
                ELECTRONICS
            </div>
        </div>
        <section class="section container-fluid">
            <div class="content">Jump to:</div>
            <div class="swiper CategoriesOne category-item">
                <div class="swiper-wrapper">
                    @php
                        $listCate = DB::table('categories')->where('parent_id', null)->get();
                    @endphp
                    @foreach($listCate as $cate)
                        <div class="swiper-slide">
                            <a href="{{ route('category.show', $cate->id) }}">
                                <div class="img">
                                    <img src="{{ asset('storage/' . $cate->thumbnail) }}"
                                         alt="">
                                </div>
                                <div class="text">
                                    {{$cate->name}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <div class="category-header align-items-center mt-4 mb-3 container-fluid d-flex justify-content-between">
            <div class="category-header--left">
                <a href="{{route('home')}}">Home</a> / <a href="#">Electronics</a>
            </div>
            <div class="category-header--right">
                <div class="show-item mr-4 align-items-center">
                    <span class="mr-3">Show</span>
                    <select class="drop btn dropdown-toggle" id="count-per-page" aria-label="Default select example">
                        <option selected value="10">10 products per page</option>
                        <option value="20">20 products per page</option>
                        <option value="30">30 products per page</option>
                        <option value="40">40 products per page</option>
                        <option value="50">50 products per page</option>
                    </select>
                </div>
                <div class="SortBy align-items-center mr-4">
                    <span class="mr-3">Sort By</span>
                    <select class="drop btn dropdown-toggle" id="sort-by" aria-label="Default select example">
                        <option value="created_at desc" selected>Newest Items</option>
                        <option value="name asc">Name: A to Z</option>
                        <option value="name desc">Name: Z to A</option>
                        <option value="price asc">Price: Ascending</option>
                        <option value="price desc">Price: Descending</option>
                    </select>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item layout-horizontal">
                        <a class="nav-link active" data-toggle="tab" href="#home"><i class="fa-solid fa-grip"></i></a>
                    </li>
                    <li class="nav-item layout-vertical">
                        <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fa-solid fa-list"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="category-body container-fluid">
            <div class="row">
                <div class="col-xl-2 category-body-left">
                    <div class="content">PHƯƠNG THỨC THANH TOÁN</div>
                    @foreach($listPayment as $payment)
                        <div class="OptionContainer">
                            <div class="OptionHead">
                                <input type="checkbox" class="payment-checkbox"
                                       value="{{ $payment->id }}">{{ $payment->name }}
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="content">PHƯƠNG THỨC VẬN CHUYỂN</div>
                    @foreach($listTransport as $transport)
                        <div class="OptionContainer">
                            <div class="OptionHead">
                                <input type="checkbox" class="transport-checkbox"
                                       value="{{ $transport->id }}">{{ $transport->name }}
                            </div>
                        </div>
                    @endforeach
                    <div class="MenuContainer"></div>
                    <hr>
                    <input type="checkbox" value="123" id="check_sale">Sản phẩm đang Sale
                    <hr>
                    <div class="content">PRICE</div>
                    <div class="category-price">
                        <div class="wrapper">
                            <div class="price-input d-flex">
                                <div class="field">
                                    <span>Min</span>
                                    <input type="number" class="input-min" id="price-min" value="0">
                                </div>
                                <div class="separator">-</div>
                                <div class="field">
                                    <span>Max</span>
                                    <input type="number" class="input-max" id="price-max" value="10000">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="10000" value="0" step="10">
                                <input type="range" class="range-max" min="0" max="10000" value="10000" step="10">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="content">ORIGIN</div>
                    <input type="text" value="" id="search-origin" onchange="searchOrigin(this)">Sản phẩm theo xuất xứ

                </div>
                <!-- Tab panes -->
                <div class="tab-content col-xl-10">
                    <div id="home" class="tab-pane active "><br>
                        <div class="row" id="renderProduct">
                            @foreach($listProduct as $product)
                                <div class="col-xl-3 col-md-4 col-6 section">
                                    <div class="item">
                                        <div class="item-img">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                 alt="">
                                            <div class="button-view">
                                                <button>Quick view</button>
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
                                                {{$namenewProduct->name}}
                                            </div>
                                            <div class="card-title">
                                                <a href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>
                                            </div>
                                            <div class="card-price d-flex justify-content-between">
                                                <div class="price-sale">
                                                    <strong>${{ $product->price }}</strong>
                                                </div>
                                                <div class="price-cost">
                                                    @if($product->old_price !=  null)
                                                        <strike>${{ $product->old_price }}</strike>
                                                    @endif
                                                </div>
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
                                            <button>Quick view</button>
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
                                            {{$namenewProduct->name}}
                                        </div>
                                        <div class="card-title-list">
                                            <a href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>
                                        </div>
                                        <div class="card-price d-flex">
                                            <div class="price-sale mr-4">
                                                <strong>${{ $product->price }}</strong>
                                            </div>
                                            <div class="price-cost">
                                                @if($product->old_price != null)
                                                    <strike>${{ $product->old_price }}</strike>
                                                @endif
                                            </div>
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
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [130, 250],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        });

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 10;

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
        });

    </script>

    <script>
        let search_origin = '';
        let sortBy = '';
        let countPerPage = '';
        let selectedPayments = [];
        let selectedTransports = [];

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

        function callApiFilter() {
            const url = '/category/filter/' + getIdCategory();
            let data = {
                sortBy: sortBy,
                countPerPage: countPerPage,
                selectedPayments: selectedPayments,
                selectedTransports: selectedTransports,
                search_origin: search_origin,
            }
            jq.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data,
                },
                success: function (response) {
                    renderProduct(response.data);
                },
                error: function (exception) {
                    console.log(exception)
                }
            });
        }

        function renderProduct(response) {
            let str = "";
            response.forEach(function (product) {
                console.log(product);
                str += `<div class="col-xl-3 col-md-4 col-6 section">
                                    <div class="item">
                                        <div class="item-img">
                                            <img src="\{\{ asset('storage/${product.thumbnail}')  }}"
                                                 alt="">
                                            <div class="button-view">
                                                <button>Quick view</button>
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
                <div class="card-brand">
                </div>
                <div class="card-title">
                    <a href="\{\{route('detail_product.show', ${product.id})}}">${product.product_name}</a>
                                            </div>
                                            <div class="card-price d-flex justify-content-between">
                                                <div class="price-sale">
                                                    <strong>${product.price}</strong>
                                                </div>
                                                <div class="price-cost">`;
                if (product.old_price != null) {
                    str += `<strike>${product.old_price}</strike>`
                }
               str += `</div>
            </div>
            <div class="card-bottom d-flex justify-content-between">
                <div class="card-bottom--left">
                    <a href="\{\{route('detail_product.show', ${product.id})}}">Choose
                                                        Options</a>
                                                </div>
                                                <div class="card-bottom--right">
                                                    <i class="item-icon fa-regular fa-heart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
            })
            document.getElementById('renderProduct').innerHTML = str;
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
@endsection
