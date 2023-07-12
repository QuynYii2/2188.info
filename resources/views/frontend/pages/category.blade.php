@extends('frontend.layouts.master')

@section('title', 'Category')

<style>
    ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }
    a {
        color: #646464;
        text-decoration: none;
    }
    body {
        background-color: #64D7E2;
        font-family: "Source Sans Pro", sans-serif;
    }
    .wrapper {
        width: 100%;
        background-color: #fff;
        font-size: 0.875em;
    }
    .items {
        padding: 18px 0;
    }
    .items > li > a {
        display: block;
        margin: 0 auto;
        text-indent: 18px;
        line-height: 39px;
    }
    .items > li > a::after {
        position: absolute;
        right: 30px;
        margin-top: 2px;
        font-family: "FontAwesome";
    }
    .items > li > a::after {
        right: 30px;
        content: "\f061";
    }
    .items > li:not(:has(ul)) > a::after,
    .items > li:not(:has(ul)) > a.expanded::after
    {
        content: none;
    }
    .itemHover {
        color: #fff;
        font-weight: 600;
        transition: background-color 0.4s ease-in-out;
    }
    .items > li > a:hover {
        background-color: #8EE8F1;
        color: #fff;
        font-weight: 600;
        transition: background-color 0.4s ease-in-out;
    }
    .items > li > a.expanded {
        background-color: #64D7E2;
        color: #fff;
        font-weight: 600;
        transition: background-color 0.4s ease-in-out;
    }
    .items > li > a.expanded::after {
        content: "\f063";
    }
    .sub-items > li:first-child > a {
        margin-top: 17px;
        height: 34px;
    }
    .sub-items > li:last-child > a {
        margin-bottom: 17px;
        height: 34px;
    }
    .sub-items a {
        position: relative;
        display: block;
        margin: 0 auto;
        width: 212px;
        text-indent: 24px;
        line-height: 39px;
    }
    .sub-items label {
        position: relative;
        display: block;
        margin: 0 1rem;
        width: 85%;
        text-indent: 24px;
        line-height: 39px;
    }
    .sub-items a {
        border-left: 2px solid #64D7E2;
    }
    .sub-items .current {
        position: relative;
        color: #64D7E2;
        border-color: white;
    }
    .sub-items > li:hover > a {
        color: #64D7E2;
        transition: color 0.4s ease-in-out;
    }
    .sub-items {
        display: none;
    }



    .tabs-product-detail{
        background-color: #fff;!important;
    }

    .link-tabs:hover{
        color: #c69500;!important;
    }

    .text-more-tabs:hover{
        color: #c69500;!important;
    }

    .title-search{
        color: #000;
    }

    .title-search:hover{
        color: #c69500;
    }
    .list-menu li a:hover{
        color: #000;
    }

    @media only screen and (min-width: 1200px){

    }

    @media only screen and (min-width: 992px) and (max-width: 1199px){

    }

    @media only screen and (min-width: 768px) and (max-width: 991px) {

    }

    @media only screen and (max-width: 767px) {
        .body-main{
            padding-left: 0!important;
            padding-right: 0!important;
        }
    }

    @media only screen and (max-width: 365px) {

    }



    .sub-items input[type=checkbox] { display:none; } /* to hide the checkbox itself */
    .sub-items input[type=checkbox] + label:before {
        font-family: FontAwesome;
        display: inline-block;
    }

    .sub-items input[type=checkbox] + label:before { content: "\f096"; } /* unchecked icon */
    .sub-items input[type=checkbox] + label:before { letter-spacing: 10px; } /* space between checkbox and label */

    .sub-items input[type=checkbox]:checked + label:before { content: "\f046"; } /* checked icon */
    .sub-items input[type=checkbox]:checked + label:before { letter-spacing: 5px; } /* allow space for check mark */




    .price-range-slider {
        width: 100%;
        float: left;
        padding: 10px 20px;
    }
    .price-range-slider .range-value {
        margin: 0;
    }
    .price-range-slider .range-value input {
        width: 100%;
        background: none;
        color: #000;
        font-size: 16px;
        font-weight: initial;
        box-shadow: none;
        border: none;
        margin: 20px 0 20px 0;
    }
    .price-range-slider .range-bar {
        border: none;
        background: #000;
        height: 3px;
        width: 96%;
        margin-left: 8px;
    }
    .price-range-slider .range-bar .ui-slider-range {
        background: #06b9c0;
    }
    .price-range-slider .range-bar .ui-slider-handle {
        border: none;
        border-radius: 25px;
        background: #fff;
        border: 2px solid #06b9c0;
        height: 17px;
        width: 17px;
        top: -0.52em;
        cursor: pointer;
    }
    .price-range-slider .range-bar .ui-slider-handle + span {
        background: #06b9c0;
    }


    ::selection {
        color: #fff;
        background: #17a2b8;
    }
    .sub-items .wrapper {
        width: 400px;
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    }
    header h2 {
        font-size: 24px;
        font-weight: 600;
    }
    header p {
        margin-top: 5px;
        font-size: 16px;
    }
    .price-input {
        width: 100%;
        display: flex;
        margin-bottom: 20px;
    }
    .price-input .field {
        display: flex;
        width: 100%;
        height: 35px;
        align-items: center;
    }
    .field input {
        width: 100%;
        height: 100%;
        outline: none;
        font-size: 19px;
        margin-left: 12px;
        border-radius: 5px;
        text-align: center;
        border: 1px solid #999;
        -moz-appearance: textfield;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    .price-input .separator {
        width: 130px;
        display: flex;
        font-size: 19px;
        align-items: center;
        justify-content: center;
    }
    .slider {
        height: 5px;
        position: relative;
        background: #ddd;
        border-radius: 5px;
    }
    .slider .progress {
        height: 100%;
        left: 25%;
        right: 25%;
        position: absolute;
        border-radius: 5px;
        background: #17a2b8;
    }
    .range-input {
        position: relative;
    }
    .range-input input {
        position: absolute;
        width: 100%;
        height: 5px;
        top: -5px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    input[type="range"]::-webkit-slider-thumb {
        height: 17px;
        width: 17px;
        border-radius: 50%;
        background: #17a2b8;
        pointer-events: auto;
        -webkit-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }
    input[type="range"]::-moz-range-thumb {
        height: 17px;
        width: 17px;
        border: none;
        border-radius: 50%;
        background: #17a2b8;
        pointer-events: auto;
        -moz-appearance: none;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
    }

    /* Support */
    .support-box {
        top: 2rem;
        position: relative;
        bottom: 0;
        text-align: center;
        display: block;
    }
    .b-btn {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    .b-btn.paypal i {
        color: blue;
    }
    .b-btn:hover {
        text-decoration: none;
        font-weight: bold;
    }
    .b-btn i {
        font-size: 20px;
        color: yellow;
        margin-top: 2rem;
    }

</style>

@section('content')
    <div class="container">
        <div id="header-carousel" class="carousel slide carousel-fade desktop-button" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="height: 450px;">
                    <img class="position-absolute w-100 h-100 img" src="{{ asset('images//carousel-1.jpg') }}"
                         style="object-fit: cover;">
                </div>
                <div class="carousel-item position-relative" style="height: 450px;">
                    <img class=" img position-absolute w-100 h-100" src="{{ asset('images//carousel-2.jpg') }}"
                         style="object-fit: cover;">
                </div>
                <div class="carousel-item position-relative" style="height: 450px;">
                    <img class= "img position-absolute w-100 h-100" src="{{ asset('images//carousel-3.jpg') }}"
                         style="object-fit: cover;">
                </div>
            </div>
        </div>

{{--        <div class="bg-white mt-3 only-desktop">--}}
{{--            <h3 class="ml-3">{{ __('home.brands') }}</h3>--}}
{{--            <table class="table table-bordered ">--}}

{{--                <tr>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-8.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/cat-2.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/cat-3.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/cat-4.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/cat-1.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-2.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-3.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-4.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-1.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-5.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle img">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-6.jpg')}}"--}}
{{--                                    class="w-100"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                    <td class="col-2 align-middle">--}}
{{--                        <a href="#!">--}}
{{--                            <img--}}
{{--                                    src="{{asset('images/vendor-7.jpg')}}"--}}
{{--                                    class="w-100 img"--}}
{{--                            />--}}
{{--                        </a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            </table>--}}
{{--        </div>--}}
    </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3 col-4">
                    <div class="card mb-5">
                        <div class='wrapper'>
                            <ul class='items p-2'>
                                <li>
                                    <h4>Màu sắc</h4>
                                        @php
                                            $listProperties = DB::table('properties')->get();
                                        @endphp
                                        @foreach($listProperties as $propertie)
                                            <li>
                                                <input id="check{{ $propertie->id }}" type="checkbox" />
                                                <label style="text-indent: 0px" for="check{{ $propertie->id }}">{{ $propertie->name }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                            <ul class='items p-2'>
                            <h4>{{ __('home.brands') }}</h4>
                                <li>
                                    <input id="box1" type="checkbox" />
                                    <label style="text-indent: 0px" for="box1">Mercedes</label>
                                </li>
                                <li>
                                    <input id="box2" type="checkbox" />
                                    <label style="text-indent: 0px" for="box2">Toyota</label>
                                </li>
                                <li>
                                    <input id="box3" type="checkbox" />
                                    <label style="text-indent: 0px" for="box3">Mitsubishi</label>
                                </li>
                                <li>
                                    <input id="box4" type="checkbox" />
                                    <label style="text-indent: 0px" for="box4">Honda</label>
                                </li>
                                <li>
                                    <input id="box5" type="checkbox" />
                                    <label style="text-indent: 0px" for="box5">Nissan</label>
                                </li>
                            </ul>
                            <ul class='items p-2'>
                                <li>
                                    <h4>Khoảng giá</h4>
                                    <div class="d-flex">
                                            <div class="wrapper">
                                                <div class="price-input">
                                                    <div class="field">
                                                        <span style="font-size: 16px">Min</span>
                                                        <input type="number" class="input-min" value="2500">
                                                    </div>
                                                    <div class="separator">-</div>
                                                    <div class="field">
                                                        <span style="font-size: 16px">Max</span>
                                                        <input type="number" class="input-max" value="7500">
                                                    </div>
                                                </div>
                                                <div class="slider">
                                                    <div class="progress"></div>
                                                </div>
                                                <div class="range-input">
                                                    <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                                                    <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                                                </div>
                                            </div>
                                        </div>
                                </li>
                            </ul>
                            <ul class='items p-2'>
                                <li>
                                    <h4>Kích thước</h4>
                                    <li>
                                        <input id="box10" type="checkbox" />
                                        <label style="text-indent: 0px" for="box10">XS</label>
                                    </li>
                                    <li>
                                        <input id="box11" type="checkbox" />
                                        <label style="text-indent: 0px" for="box11">SM</label>
                                    </li>
                                    <li>
                                        <input id="box12" type="checkbox" />
                                        <label style="text-indent: 0px" for="box12">LG</label>
                                    </li>
                                    <li>
                                        <input id="box13" type="checkbox" />
                                        <label style="text-indent: 0px" for="box13">XXL</label>
                                    </li>
                                </li>
                            </ul>
                        </div>

                    </div>


                </div>

                <div class="col-md-9 col-8">
                    <header class="border-bottom mb-4 pb-3 ">
                        <div class="form-inline">
                            <span class="mr-md-auto">{{$listProduct->total()}} {{ __('home.items found') }}</span>
                            <select class="form-control">
                                <option>{{ __('home.latest items') }}</option>
                                <option>{{ __('home.trending') }}</option>
                                <option>{{ __('home.most popular') }}</option>
                                <option>{{ __('home.cheapest') }}</option>
                            </select>
                        </div>
                    </header>

                    <div class="row py-2">
                        @foreach($listProduct as $product)
                            <div class="col-md-4 col-sm-6 col-12 rounded product-map">
                                <div class="product-item bg-light rounded ">
                                    <div class="product-img position-relative overflow-hidden rounded">
                                        <img class=" height-img w-100 img" src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                                    </div>
                                    <div class="text-center py-4 text-limit">
                                        <a class="h6 text-decoration-none text-truncate tabs-product-detail" href="{{route('detail_product.show', $product->id)}}">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5 class="text-danger">${{ $product->price }}</h5><h6 class="text-muted ml-2"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <nav class="mt-4 mb-5 d-flex justify-content-center" aria-label="Page navigation sample">
                        <ul class="pagination">
                            @foreach($listProduct->links()->elements[0] as $index => $page)
                                <li class="page-item"><a class="page-link" href="{{ $page }}">{{ $index }}</a></li>
                            @endforeach
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function responsiveTable(y) {
            let tabs = document.getElementsByClassName('product-map');
            var i;
            for (i=0; i<tabs.length; i++){
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
            for (i=0; i<tabs.length; i++){
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



        $(".items > li > a").click(function(e) {
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

        $(".sub-items a").click(function() {
            $(".sub-items a").removeClass("current");
            $(this).addClass("current");
        });



        $(function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 1000,
                values: [ 130, 250 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

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
@endsection
