@extends('frontend.layouts.master')

@section('title', 'Category')

<style>
    /*
 * Developer: Alireza Eskandarpour Shoferi
 * Designer: Nevide (codecanyon.net/user/Nevide)
 *
 * Distributed under the terms of the MIT license
 * https://opensource.org/licenses/MIT
 */
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

</style>

@section('content')
    <div class="container pt-5">
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

        <div class="bg-white mt-3 only-desktop">
            <h3 class="ml-3">{{ __('home.brands') }}</h3>
            <table class="table table-bordered ">

                <tr>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-8.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-2.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-3.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-4.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/cat-1.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-2.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>

                </tr>
                <tr>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-3.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-4.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-1.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-5.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle img">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-6.jpg')}}"
                                    class="w-100"
                            />
                        </a>
                    </td>
                    <td class="col-2 align-middle">
                        <a href="#!">
                            <img
                                    src="{{asset('images/vendor-7.jpg')}}"
                                    class="w-100 img"
                            />
                        </a>
                    </td>
                </tr>
            </table>
        </div>


        <div class="container body-main px-0">
            <div class="row">
                <aside class="col-md-4">

                    <div class="card mb-5">
                        <div class='wrapper'>
                            <ul class='items'>
                                <li>
                                    <a href='#'>{{ __('home.product type') }}</a>

                                    <ul class='sub-items'>
                                        <form class="p-3">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="{{ __('home.search') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-light" type="button"><i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <li>
                                            <input id="box21" type="checkbox" />
                                            <label for="box21">{{ __('home.people') }}</label>
                                        </li>
                                        <li>
                                            <input id="box22" type="checkbox" />
                                            <label for="box22">{{ __('home.watches') }}</label>
                                        </li>
                                        <li>
                                            <input id="box23" type="checkbox" />
                                            <label for="box23">{{ __('home.cinema') }}</label>
                                        </li>
                                        <li>
                                            <input id="box24" type="checkbox" />
                                            <label for="box24">{{ __('home.clothes') }}</label>
                                        </li>
                                        <li>
                                            <input id="box25" type="checkbox" />
                                            <label for="box25">{{ __('home.home items') }}</label>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'>{{ __('home.brands') }}</a>
                                    <ul class='sub-items'>
                                        <li>
                                            <input id="box1" type="checkbox" />
                                            <label for="box1">Mercedes</label>
                                        </li>
                                        <li>
                                            <input id="box2" type="checkbox" />
                                            <label for="box2">Toyota</label>
                                        </li>
                                        <li>
                                            <input id="box3" type="checkbox" />
                                            <label for="box3">Mitsubishi</label>
                                        </li>
                                        <li>
                                            <input id="box4" type="checkbox" />
                                            <label for="box4">Honda</label>
                                        </li>
                                        <li>
                                            <input id="box5" type="checkbox" />
                                            <label for="box5">Nissan</label>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'>{{ __('home.price range') }}</a>
                                    <ul class='sub-items'>
                                        <li class="px-3">
                                            <input type="range" class="custom-range" min="0" max="100" name="">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>{{ __('home.min') }}</label>
                                                    <input class="form-control" placeholder="$0" type="number">
                                                </div>
                                                <div class="form-group text-right col-md-6">
                                                    <label>{{ __('home.max') }}</label>
                                                    <input class="form-control" placeholder="$1,0000" type="number">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='#'>{{ __('home.size') }}</a>
                                    <ul class='sub-items'>
                                        <li>
                                            <input id="box10" type="checkbox" />
                                            <label for="box10">XS</label>
                                        </li>
                                        <li>
                                            <input id="box11" type="checkbox" />
                                            <label for="box11">SM</label>
                                        </li>
                                        <li>
                                            <input id="box12" type="checkbox" />
                                            <label for="box12">LG</label>
                                        </li>
                                        <li>
                                            <input id="box13" type="checkbox" />
                                            <label for="box13">XXL</label>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    
                    
                </aside>
                <main class="col-md-8">

                    <header class=" border-bottom mb-4 pb-3 ">
                        <div class="form-inline">
                            <span class="mr-md-auto">{{count($productByLocal9)}} {{ __('home.items found') }}</span>
                            <select class="form-control">
                                <option>{{ __('home.latest items') }}</option>
                                <option>{{ __('home.trending') }}</option>
                                <option>{{ __('home.most popular') }}</option>
                                <option>{{ __('home.cheapest') }}</option>
                            </select>
                        </div>
                    </header>

                    <div class="row py-2">
                        @foreach($productByLocal9 as $product)
                            <div class="col-md-4 col-sm-6 col-12 rounded product-map">
                                <div class="product-item bg-light rounded ">
                                    <div class="product-img position-relative overflow-hidden rounded">
                                        <img class=" height-img w-100 img" src="{{ $product->thumbnail }}" alt="">
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
                            <li class="page-item disabled"><a class="page-link" href="#!">{{ __('home.previous') }}</a></li>
                            <li class="page-item active"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item"><a class="page-link" href="#!">{{ __('home.next') }}</a></li>
                        </ul>
                    </nav>

                </main>
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
    </script>
@endsection
