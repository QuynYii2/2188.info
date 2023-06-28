@php use Illuminate\Support\Facades\Auth; @endphp
        <!-- Header Section Begin -->
<style>

    /*Clearing Floats*/
    .cf:before, .cf:after {
        content: "";
        display: table;
    }

    .cf:after {
        clear: both;
    }

    .cf {
        zoom: 1;
    }

    /* Form wrapper styling */

    .search-wrapper {
        width: 100%;
        height: 100%;
        border-radius: 40px;
        background: transparent;
        box-shadow: 0 4px 20px -2px #e9e9e9;
    }

    /* Form text input */

    .search-wrapper input {
        padding-left: 20px;
        padding-right: 30%;
        width: 100%;
        height: 100%;
        float: left;
        border: 0;
        background: #fff;
        border-radius: 40px;
        border-top-style: none;
    }

    .search-wrapper input:focus {
        outline: 0;
        background: #fff;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.8) inset;
    }

    .search-wrapper input::-webkit-input-placeholder {
        color: #999;
        font-weight: normal;
        font-style: italic;
        padding-left: 20px;
    }

    .search-wrapper input:-moz-placeholder {

        color: #999;
        font-weight: normal;
        font-style: italic;
    }

    .search-wrapper input:-ms-input-placeholder {
        color: #999;
        font-weight: normal;
        font-style: italic;
        border-style: none;
    }

    /* Form submit button */
    .search-wrapper button {
        right: 0;
        overflow: visible;
        position: absolute;
        float: right;
        border: 0;
        cursor: pointer;
        height: 100%;
        min-width: 25%;
        padding: 0 20px;
        width: auto;
        font: 13px/40px 'lucida sans', 'trebuchet MS', 'Tahoma';
        color: #fff;
        text-transform: uppercase;
        background: #e7ab3c;
        border-radius: 40px;
        text-shadow: 0 -1px 0 rgba(0, 0, 0, .3);
    }

    .search-wrapper button:hover {
        /*     background: #e54040; */
    }

    .search-wrapper button:active,
    .search-wrapper button:focus {
        background: #198cff;
        outline: 0;
    }

    .search-wrapper button:focus:before,
    .search-wrapper button:active:before {
        border-right-color: #c42f2f;
    }

    .search-wrapper button::-moz-focus-inner { /* remove extra button spacing for Mozilla Firefox */
        border: 0;
        padding: 0;
    }


    .vertical-menu {
        width: 100%;
    }

    .vertical-menu .navbar-nav {
        display: block;
    }

    .vertical-menu .nav-item {
        background: #ffffff;
    }

    li {
        list-style: none;
    }

    .vertical-menu .nav-link {
        color: #757575;
        padding: 10px;
    }

    /* CSS cho megamenu */
    .megamenu {
        display: none;
    }

    .vertical-menu .nav-item:hover .megamenu {
        display: block;
        position: absolute;
        top: 8px;
        left: 94%;
        z-index: 999;
        width: 700px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 4px 0 rgba(0, 0, 0, .25);
    }

    .megamenu a:hover, a:focus {
        color: #e7ab3c;
        font-weight: 500;
    }

    .depart-hover li:hover .megamenu {
        display: block;
        position: absolute;
        top: 8px;
        left: 94%;
        z-index: 999;
        width: 700px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 4px 0 rgba(0, 0, 0, .25);
    }

    .depart-hover .megamenu li a {
        padding-left: 0 !important;
    }

    /**/
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        padding-top: 16px;
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 99;
    }

    .dropdown-content a {
        color: black;
        padding: 16px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /*    */
    .img-selector {
        max-height: 15px !important;
    }

    /*    */
    .img-logo-flag {
        width: 36px !important;
        height: 42px !important;
    }


    /*Resize the wrap to see the search bar change!*/


    .not-mobile-button {
        display: none !important;
    }

    .only-mobile-button {
        display: flex !important;
    }

    @media only screen and (min-width: 575px) {
        .not-mobile-button {
            display: flex !important;
        }


        .only-mobile-button {
            display: none !important;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1023px) {
        .dropdown {
            width: 100%;
        }

        h4.dropbtn {
            font-size: 15px;
        }
    }

    .desktop-button {
        display: none; /* Ẩn nút trên desktop mặc định */
    }

    @media only screen and (max-width: 767px) {
        h4.dropbtn {
            font-size: 15px;
        }

        .desktop-button {
            display: none !important
        }

        .mobile-button {
            display: block !important;
        }
    }

    @media (min-width: 768px) {
        .mobile-button {
            display: none !important;
        }

        .desktop-button {
            display: flex !important;
        }

    }


    @media only screen and (max-width: 479px) {


        h4.dropbtn {
            font-size: 18px;
        }
    }

    @media only screen and (max-width: 480px) {
    }

    .d-grid {
        display: grid !important;
    }

    .mg-menu {
        margin-left: 4px;

    }

    @media screen and (width: 712px) {
        .mg-menu {
            margin-left: -95px;
        }
    }

    .only-desktop {
        display: none;
    }

    @media screen and (max-width: 991px) {
        .only-desktop {
            display: none;
        }
    }

    @media screen and (min-width: 992px) {
        .only-desktop {
            display: block;
        }
    }

    @media only screen and (max-width: 479px) {
        #in-search {
            padding-left: 0;
            padding-right: 0;
        }
    }

    #nav-black.nav-item .nav-menu li a {
        color: white;
    }

    #nav-black.nav-item .nav-menu li .dropdown {
    }



</style>
<header>
    <div class="container">
        <div class="header-top align-items-center justify-content-between row" style="padding-left: 2vw; padding-right: 2vw">
            <div style="float: left">
                <div class="ht-left">
                    <div class="desktop-button">
                        <div class="mail-service">
                            <i class=" fa fa-envelope"></i>
                            hello.colorlib@gmail.com
                        </div>
                        <div class="phone-service">
                            <i class=" fa fa-phone"></i>
                            +65 11.188.888
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-button m-2">
                <div class="btn-group">
                    <button type="button" class="btn btn-warning mr-2 full-width text-nowrap" data-toggle="modal"
                            data-target="#chooseLanguageOrder"
                            aria-expanded="false">
                        <a class="text-white" target="_blank" rel="noopener noreferrer"
                           href="http://order.2188.info/">{{ __('home.orders') }}</a>
                    </button>
                    <button type="button" class="btn btn-success mr-2 full-width text-nowrap" data-toggle="modal"
                            data-target="#chooseLanguagePurchase"
                            aria-expanded="false"><a class="text-white"
                                                     href="{{route('login')}}">{{ __('home.purchase') }}</a>
                    </button>
                </div>
            </div>
            <div class="ht-right" style="margin: auto; margin-right: 0">
                <div class="lan-selector">
                    <select class="language_drop" name="countries" id="countries"
                            style="width: 100%; padding-right: 15px"
                            onchange="location = this.value;">
                        @if(session('locale') == 'vi' || session('locale') == null)
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'kr')
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'jp')
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'cn')
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}'
                                    data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}'
                                    data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}'
                                    data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}'
                                    data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                        @endif
                    </select>
                </div>
                <div class="top-social" style="display: none">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-share"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="inner-header container">
        <div class="row not-mobile-button my-2">
            <div class="col-lg-2 col-md-2 col-12 col-sm-2">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/img/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md-7 col-12" id="in-search">
                <form class="search-wrapper cf">
                    <input type="text" placeholder="{{ __('home.placeholder search') }}"
                           style="box-shadow: none">
                    <button type="submit">{{ __('home.search') }}</button>
                </form>
            </div>
            @if (session('error'))
                {{ session('error') }}
            @endif
            @if(session('login') || Auth::user()!= null)
                <div class="col-lg-3 col-md-3 text-right col-md-4 col-12 col-sm-4">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <ul class="nav-right mb-0">
                                @php
                                    $cartViews = \App\Models\Cart::where([
                                            ['user_id', '=', Auth::user()->id],
                                            ['status', '=', \App\Enums\CartStatus::WAIT_ORDER]
                                    ])->get();
                                    $totalHeader = 0;
                                    foreach ($cartViews as $cart1){
                                        $totalHeader = $totalHeader + ($cart1->price*$cart1->quantity);
                                    }
                                @endphp
                                <li class="cart-icon">
                                    <a href="#">
                                        <i style="font-size: 30px" class="fa fa-shopping-cart"></i>
                                        <span>{{count($cartViews)}}</span>
                                    </a>
                                    <div class="cart-hover" style="margin-left: 29px">

                                        <div class="select-items table-responsive-sm">
                                            @if(count($cartViews) > 0)
                                                <table>
                                                    <thead>
                                                    <h6>{{ __('home.was new product') }}</h6>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($cartViews as $cartView)
                                                        <tr>
                                                            <td class="si-pic"><img
                                                                        src="{{$cartView->product->thumbnail}}"
                                                                        alt="">
                                                            </td>
                                                            <td class="si-text">
                                                                <div class="product-selected">
                                                                    <p>{{$cartView->product->name}}</p>
                                                                </div>
                                                            </td>
                                                            <td class="si-text">
                                                                <p>${{$cartView->price}}
                                                                    x {{$cartView->quantity}} </p>
                                                                <p>${{$cartView->price*$cartView->quantity}}</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                        </div>
                                        <div class="select-total">
                                            <span>{{ __('home.Total Payment') }}:</span>
                                            <h5>${{$totalHeader}}</h5>
                                        </div>
                                        <div class="select-button">
                                            <a href="{{route('cart.index')}}"
                                               class="primary-btn view-card">{{ __('home.view card') }}</a>
                                            <a href="{{route('checkout.show')}}"
                                               class="primary-btn checkout-btn">{{ __('home.Pay Now') }}</a>
                                        </div>
                                        @else
                                            <div class="">
                                                <h6>No product</h6>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                            <div class="dropdown ml-3 text-nowrap">
                                <h5 class="dropbtn text-center" style="margin-bottom: 0;" aria-expanded="false">
                                    @if(Auth::user())
                                        {{ Auth::user()->name }}
                                    @endif
                                </h5>
                                @php
                                    $coinUser = \App\Models\Coin::where([['user_id', Auth::user()->id], ['status', \App\Enums\CoinStatus::ACTIVE]])->first();
                                    if ($coinUser == null){
                                        $coin = 0;
                                    } else {
                                       $coin = $coinUser->quantity;
                                    }
                                @endphp
                                <div class="dropdown-content text-left pt-0">
                                    <ul class="mb-0">
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{route('profile.show')}}">{{ __('home.profile') }}</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                               href="#">Coins: {{$coin}}</a>
                                        </li>
                                        <li>
                                            <a href="{{route('buy.coin.show')}}"
                                               class="dropdown-item">{{ __('home.buy coin') }}</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" onclick="logout()"
                                               href="#">{{ __('home.log out') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                </div>
            @else
                <div class="col-lg-3 col-md-4 col-sm-4 desktop-button d-flex align-items-center">
                    <div class="btn-group full-width">
                        <button type="button" class="btn btn-warning mr-2 full-width text-nowrap"
                                data-toggle="modal"
                                data-target="#chooseLanguageOrder"
                                aria-expanded="false">
                            <a class="text-white" target="_blank" rel="noopener noreferrer"
                               href="http://order.2188.info/">{{ __('home.orders') }}</a>
                        </button>
                        <button type="button" class="btn btn-success mr-2 full-width text-nowrap"
                                data-toggle="modal"
                                data-target="#chooseLanguagePurchase"
                                aria-expanded="false"><a class="text-white"
                                                         href="{{route('login')}}">{{ __('home.purchase') }}</a>
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <div class="row only-mobile-button justify-content-center">
            <div class="col-lg-2 col-md-2 col-sm-2 col-5 mt-2">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('images/img/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            @if(session('login') || Auth::user()!= null)
                <div class="col-lg-3 col-md-3 text-right col-md-4 col-7 mt-2">
                    <div class="d-flex align-items-center">
                        <ul class="nav-right mb-0">
                            @php
                                $cartViews = \App\Models\Cart::where([
                                        ['user_id', '=', Auth::user()->id],
                                        ['status', '=', \App\Enums\CartStatus::WAIT_ORDER]
                                ])->get();
                                $totalHeader = 0;
                                foreach ($cartViews as $cart1){
                                    $totalHeader = $totalHeader + ($cart1->price*$cart1->quantity);
                                }
                            @endphp
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>{{count($cartViews)}}</span>
                                </a>
                                <div class="cart-hover">

                                    <div class="select-items table-responsive-sm">
                                        @if(count($cartViews) > 0)
                                            <table>
                                                <thead>
                                                <h6>{{ __('home.was new product') }}</h6>
                                                </thead>
                                                <tbody>
                                                @foreach($cartViews as $cartView)
                                                    <tr>
                                                        <td class="si-pic"><img
                                                                    src="{{$cartView->product->thumbnail}}"
                                                                    alt="">
                                                        </td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p>{{$cartView->product->name}}</p>
                                                            </div>
                                                        </td>
                                                        <td class="si-text">
                                                            <p>${{$cartView->price}}
                                                                x {{$cartView->quantity}} </p>
                                                            <p>${{$cartView->price*$cartView->quantity}}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>

                                    </div>
                                    <div class="select-total">
                                        <span>{{ __('home.Total Payment') }}:</span>
                                        <h5>${{$totalHeader}}</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="{{route('cart.index')}}"
                                           class="primary-btn view-card">{{ __('home.view card') }}</a>
                                        <a href="{{route('checkout.show')}}"
                                           class="primary-btn checkout-btn">{{ __('home.Pay Now') }}</a>
                                    </div>
                                    @else
                                        <div class="">
                                            <h6>No product</h6>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <div class="dropdown ml-3 ">
                            <h4 class="dropbtn text-center" style="margin-bottom: 0;" aria-expanded="false">
                                @if(Auth::user())
                                    {{ Auth::user()->name }}
                                @endif
                            </h4>
                            @php
                                $coinUser = \App\Models\Coin::where([['user_id', Auth::user()->id], ['status', \App\Enums\CoinStatus::ACTIVE]])->first();
                                if ($coinUser == null){
                                    $coin = 0;
                                } else {
                                   $coin = $coinUser->quantity;
                                }
                            @endphp
                            <div class="dropdown-content text-left pt-0 mt-2" style="margin-left: -35px">
                                <ul class="mb-0">
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{route('profile.show')}}">{{ __('home.profile') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                           href="#">Coins: {{$coin}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('buy.coin.show')}}"
                                           class="dropdown-item">{{ __('home.buy coin') }}</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" onclick="logout()"
                                           href="#">{{ __('home.log out') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-6 col-10 mt-2" id="in-search">
                <div class="advanced-search">
                    <form class="search-wrapper cf">
                        <input type="text" placeholder="{{ __('home.placeholder search') }}"
                               style="box-shadow: none">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            @if (session('error'))
                {{ session('error') }}
            @endif
        </div>

    </div>
    <div class="nav-item mobile-button mt-2">
        <div class="container">
            <div class="row">
                <div>
                    <nav class="nav-menu mobile-menu">
                        <ul>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"
                                                                            aria-hidden="true"></i>&ensp; Electronic</a>
                                <ul>
                                    <li class="nav-item">
                                        <a class="nav-link text-nowrap" href="#">Điều hòa</a>
                                        <ul>
                                            <li class="nav-item">123</li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">hi</li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-laptop"
                                                                                      aria-hidden="true"></i>&ensp;
                                    Electronic Device123s</a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="/category/1">All-In-One</a></li>
                                                <li><a href="/category/1">Gaming Desktops</a></li>
                                                <li><a href="/category/1">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="/category/1">Traditional Laptops</a></li>
                                                <li><a href="/category/1">Gaming Laptops</a></li>
                                                <li><a href="/category/1">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="/category/1">Headphones & Headsets</a></li>
                                                <li><a href="/category/1">Portable Speakers</a></li>
                                                <li><a href="/category/1">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="/category/1">All-In-One</a></li>
                                                <li><a href="/category/1">Gaming Desktops</a></li>
                                                <li><a href="/category/1">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="/category/1">Traditional Laptops</a></li>
                                                <li><a href="/category/1">Gaming Laptops</a></li>
                                                <li><a href="/category/1">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="/category/1">Headphones & Headsets</a></li>
                                                <li><a href="/category/1">Portable Speakers</a></li>
                                                <li><a href="/category/1">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-television"
                                                                                      aria-hidden="true"></i>&ensp;
                                    TV & Home Appliances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-laptop"
                                                                                      aria-hidden="true"></i>&ensp;
                                    Electronic Devices</a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="/category/1">All-In-One</a></li>
                                                <li><a href="/category/1">Gaming Desktops</a></li>
                                                <li><a href="/category/1">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="/category/1">Traditional Laptops</a></li>
                                                <li><a href="/category/1">Gaming Laptops</a></li>
                                                <li><a href="/category/1">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="/category/1">Headphones & Headsets</a></li>
                                                <li><a href="/category/1">Portable Speakers</a></li>
                                                <li><a href="/category/1">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="/category/1">All-In-One</a></li>
                                                <li><a href="/category/1">Gaming Desktops</a></li>
                                                <li><a href="/category/1">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="/category/1">Traditional Laptops</a></li>
                                                <li><a href="/category/1">Gaming Laptops</a></li>
                                                <li><a href="/category/1">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="/category/1">Headphones & Headsets</a></li>
                                                <li><a href="/category/1">Portable Speakers</a></li>
                                                <li><a href="/category/1">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"
                                                                            aria-hidden="true"></i>&ensp; TV &
                                    Home
                                    Appliances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"
                                                                            aria-hidden="true"></i>&ensp;
                                    Electronic
                                    Devices</a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="#">All-In-One</a></li>
                                                <li><a href="#">Gaming Desktops</a></li>
                                                <li><a href="#">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="#">Traditional Laptops</a></li>
                                                <li><a href="#">Gaming Laptops</a></li>
                                                <li><a href="#">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="#">Headphones & Headsets</a></li>
                                                <li><a href="#">Portable Speakers</a></li>
                                                <li><a href="#">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="#">All-In-One</a></li>
                                                <li><a href="#">Gaming Desktops</a></li>
                                                <li><a href="#">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="#">Traditional Laptops</a></li>
                                                <li><a href="#">Gaming Laptops</a></li>
                                                <li><a href="#">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="#">Headphones & Headsets</a></li>
                                                <li><a href="#">Portable Speakers</a></li>
                                                <li><a href="#">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"
                                                                            aria-hidden="true"></i>&ensp; TV &
                                    Home
                                    Appliances</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"
                                                                            aria-hidden="true"></i>&ensp;
                                    Electronic
                                    Devices</a>
                                <div class="megamenu">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="#">All-In-One</a></li>
                                                <li><a href="#">Gaming Desktops</a></li>
                                                <li><a href="#">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="#">Traditional Laptops</a></li>
                                                <li><a href="#">Gaming Laptops</a></li>
                                                <li><a href="#">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="#">Headphones & Headsets</a></li>
                                                <li><a href="#">Portable Speakers</a></li>
                                                <li><a href="#">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h5>Desktops Computers</h5>
                                            <ul>
                                                <li><a href="#">All-In-One</a></li>
                                                <li><a href="#">Gaming Desktops</a></li>
                                                <li><a href="#">DIY</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Laptops</h5>
                                            <ul>
                                                <li><a href="#">Traditional Laptops</a></li>
                                                <li><a href="#">Gaming Laptops</a></li>
                                                <li><a href="#">2-in-1s</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-4">
                                            <h5>Audio</h5>
                                            <ul>
                                                <li><a href="#">Headphones & Headsets</a></li>
                                                <li><a href="#">Portable Speakers</a></li>
                                                <li><a href="#">Home Audio</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"
                                                                            aria-hidden="true"></i>&ensp; TV &
                                    Home
                                    Appliances</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

            <div id="mobile-menu-wrap" class="mg-menu" style=" width: calc(100vw - 2rem);"></div>
        </div>
    </div>
    @unless(request()->is('/'))
        <div class="nav-item" id="nav-black">
            <div class="container">
                <div class="col-sm-12">
                    <div class="row" style="background: black">
                        <div class="col-sm-4">
                            <div class="nav-depart">
                                <div class="depart-btn">
                                    <i class="fa fa-bars"></i>
                                    <span>{{ __('home.all_categories') }}</span>
                                    <ul class="depart-hover ">
                                        <li class="active"><a href="#">Women’s Clothing</a></li>
                                        <li><a href="#">Men’s Clothing</a>
                                            <div class="megamenu">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <h4>Desktops Computers</h4>
                                                        <ul>
                                                            <li><a href="#">All-In-One</a></li>
                                                            <li><a href="#">Gaming Desktops</a></li>
                                                            <li><a href="#">DIY</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <h4>Laptops</h4>
                                                        <ul>
                                                            <li><a href="#">Traditional Laptops</a></li>
                                                            <li><a href="#">Gaming Laptops</a></li>
                                                            <li><a href="#">2-in-1s</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <h4>Audio</h4>
                                                        <ul>
                                                            <li><a href="#">Headphones & Headsets</a></li>
                                                            <li><a href="#">Portable Speakers</a></li>
                                                            <li><a href="#">Home Audio</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <h4>Desktops Computers</h4>
                                                        <ul>
                                                            <li><a href="#">All-In-One</a></li>
                                                            <li><a href="#">Gaming Desktops</a></li>
                                                            <li><a href="#">DIY</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <h4>Laptops</h4>
                                                        <ul>
                                                            <li><a href="#">Traditional Laptops</a></li>
                                                            <li><a href="#">Gaming Laptops</a></li>
                                                            <li><a href="#">2-in-1s</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <h4>Audio</h4>
                                                        <ul>
                                                            <li><a href="#">Headphones & Headsets</a></li>
                                                            <li><a href="#">Portable Speakers</a></li>
                                                            <li><a href="#">Home Audio</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                            $listCate = DB::table('categories')->get();
                                        @endphp
                                        @foreach($listCate as $cate)
                                            <li><a href="{{ route('category.show', $cate->id) }}">{{ $cate->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <nav class="nav-menu row">
                                <ul>
                                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{route('product.index')}}">Shop</a></li>
                                    <li><a href="#">Collection</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Collection</a></li>
                                            <li><a href="#">Women's</a></li>
                                            <li><a href="#">Kid's</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./contact.html">Contact</a></li>
                                    <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="./blog-details.html">Blog Details</a></li>
                                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                            <li><a href="./check-out.html">Checkout</a></li>
                                            <li><a href="./faq.html">Faq</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endunless
</header>
<!-- Header End -->
<script>
    // Hàm logout
    function logout() {
        let productIDs = localStorage.getItem('productIDs');

        $.ajax({
            url: '/product-viewed',
            method: 'POST',
            data: {
                productIds: productIDs,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                localStorage.clear();
                console.log(response);
            },
            error: function (response) {
                console.log(response)
            }
        });

        // Tạo một form
        var form = document.createElement('form');

        // Đặt thuộc tính action và method cho form
        form.action = "{{ route('logout') }}";
        form.method = "POST";

        // Tạo một input hidden để chứa CSRF token
        var csrfTokenInput = document.createElement('input');
        csrfTokenInput.type = "hidden";
        csrfTokenInput.name = "_token";
        csrfTokenInput.value = "{{ csrf_token() }}";

        // Thêm input hidden vào form
        form.appendChild(csrfTokenInput);

        // Thêm form vào body
        document.body.appendChild(form);

        // Gửi form để thực hiện logout
        form.submit();
    }
</script>

