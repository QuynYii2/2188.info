@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <div id="body-content">
        <div class="category-banner">
            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-banner-top-layout-2.jpg"
                 alt="">
            <div class="category-name">
                ELECTRONICS
            </div>
        </div>
{{--        <section class="section container-fluid">--}}
{{--            <div class="content">{{ __('home.Jump to') }}:</div>--}}
{{--            <div class="swiper CategoriesOne category-item">--}}
{{--                <div class="swiper-wrapper">--}}
{{--                    @php--}}
{{--                        $listCate = DB::table('categories')->where('parent_id', null)->get();--}}
{{--                    @endphp--}}
{{--                    @foreach($listCate as $cate)--}}
{{--                        <div class="swiper-slide">--}}
{{--                            <a href="{{ route('category.show', $cate->id) }}">--}}
{{--                                <div class="img">--}}
{{--                                    <img src="{{ asset('storage/' . $cate->thumbnail) }}"--}}
{{--                                         alt="">--}}
{{--                                </div>--}}
{{--                                <div class="text">--}}
{{--                                    {{($cate->{'name' . $langDisplay->getLangDisplay()})}}--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="swiper-button-next"></div>--}}
{{--                <div class="swiper-button-prev"></div>--}}
{{--                <div class="swiper-pagination"></div>--}}
{{--            </div>--}}
{{--        </section>--}}
        <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
        <div class="category-header align-items-center mt-4 mb-3 container-fluid d-flex justify-content-between">
            <div class="category-header--left">
{{--                <a href="{{route('home')}}">{{ __('home.Home') }}</a> / <a href="#">{{ __('home.Electronics') }}</a>--}}
            </div>
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
{{--            <div class="row">--}}
{{--                <div class="col-xl-2 category-body-left">--}}
{{--                    <div class="content">{{ __('home.PAYMENT METHODS') }}</div>--}}
{{--                    @foreach($listPayment as $payment)--}}
{{--                        <div class="OptionContainer">--}}
{{--                            <div class="OptionHead">--}}
{{--                                <input type="checkbox" class="payment-checkbox" value="{{ $payment->id }}">{{(($payment->name))}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    <hr>--}}
{{--                    <div class="content">{{ __('home.SHIPPING METHODS') }}</div>--}}
{{--                    @foreach($listTransport as $transport)--}}
{{--                        <div class="OptionContainer">--}}
{{--                            <div class="OptionHead">--}}
{{--                                <input type="checkbox" class="transport-checkbox"--}}
{{--                                       value="{{ $transport->id }}">{{ ($transport->name) }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    <div class="MenuContainer"></div>--}}
{{--                    <hr>--}}
{{--                    <input type="checkbox" class="mr-2" value="" id="check_sale" onchange="checkSale(this)">{{ __('home.Products on sale') }}--}}
{{--                    <hr>--}}
{{--                    <div class="content">{{ __('home.PRICE') }}</div>--}}
{{--                    <div class="category-price">--}}
{{--                        <div class="wrapper">--}}
{{--                            <div class="price-input d-flex">--}}
{{--                                <div class="field">--}}
{{--                                    <div>{{ __('home.Min') }}</div>--}}
{{--                                    <input type="number" class="input-min" id="price-min" value="0">--}}
{{--                                </div>--}}
{{--                                <div class="separator">-</div>--}}
{{--                                <div class="field">--}}
{{--                                    <div>{{ __('home.Max') }}</div>--}}
{{--                                    <input type="number" class="input-max" id="price-max" value="{{ $priceProductOfCategory->maxPrice }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="slider">--}}
{{--                                <div class="progress"></div>--}}
{{--                            </div>--}}
{{--                            <div class="range-input">--}}
{{--                                <input type="range" class="range-min" min="0" max="{{ $priceProductOfCategory->maxPrice }}" value="0" step="1">--}}
{{--                                <input type="range" class="range-max" min="0" max="{{ $priceProductOfCategory->maxPrice }}" value="{{ $priceProductOfCategory->maxPrice }}" step="1">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <hr>--}}
{{--                    <div class="content">{{ __('home.ORIGIN') }}</div>--}}
{{--                    <input type="text" value="" class="w-100" id="search-origin" onchange="searchOrigin(this)" >{{ __('home.Products by origin') }}--}}

{{--                </div>--}}
                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="tab-pane active "><br>
                        <div class="row" id="renderProduct">
                            @foreach($listProduct as $product)
                                <div class="col-xl-2 col-md-3 col-6 section">
                                    @include('frontend.pages.list-product')
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
                                            <button type="button" class="btn view_modal" data-toggle="modal"
                                                    data-value="{{$product}}"
                                                    data-target="#exampleModal">{{ __('home.Quick view') }}</button>
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
                                            {{($namenewProduct->name)}}
                                        </div>
                                        <div class="card-title-list">
                                            <a href="{{route('detail_product.show', $product->id)}}">{{  ($product->name)}}</a>
                                        </div>
                                        <div class="card-price d-flex">
                                            @if($product->price)
                                                <div class="card-price d-flex justify-content-between">
                                                    @if($product->price != null)
                                                        <div id="productPrice" class="price">{{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</div>
                                                        <strike id="productOldPrice">{{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strike>
                                                    @else
                                                        <strike id="productOldPrice">{{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strike>
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
{{--            </div>--}}
        </div>
    </div>
    @include('frontend.pages.modal-products')
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
    </script>
@endsection
