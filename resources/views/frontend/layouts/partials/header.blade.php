@php use Illuminate\Support\Facades\Auth; @endphp
        <!-- Header Section Begin -->
<style>
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
        width: 150px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
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

    @media only screen and (min-width: 768px) and (max-width: 991px) {

    }

    @media only screen and (max-width: 767px) {

    }

    @media only screen and (max-width: 479px) {

    }


</style>
<header class="header-section" style="background: #ffffff;">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    hello.colorlib@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
                <div class="lan-selector">
                    <select class="language_drop" name="countries" id="countries" style="width:300px;"
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
                <div class="top-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-share"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img src="{{asset('images/img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">{{ __('home.all_categories') }}</button>
                        <div class="input-group">
                            <input type="text" placeholder="{{ __('home.placeholder search') }}">
                            <button type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                @if (session('error'))
                    {{ session('error') }}
                @endif
                @if(session('login'))
                    <div class="col-lg-3 text-right col-md-3">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center">
                                <ul class="nav-right">
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
                                            @if(count($cartViews) > 0)
                                                @foreach($cartViews as $cartView)
                                                    <div class="select-items">
                                                        <table>
                                                            <thead>
                                                            <h6>Sản phẩm mới thêm</h6>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td class="si-pic"><img
                                                                            src="{{$cartView->product->thumbnail}}"
                                                                            alt="">
                                                                </td>
                                                                <td class="si-text">
                                                                    <div class="product-selected">
                                                                        <h6>{{$cartView->product->name}}</h6>
                                                                    </div>
                                                                </td>
                                                                <td class="">
                                                                    <p>${{$cartView->price}}</p>
                                                                </td>
                                                                <td class="">
                                                                    <p>X</p>
                                                                </td>
                                                                <td class="">
                                                                    <p>{{$cartView->quantity}}</p>
                                                                </td>
                                                                <td class="si-close">
                                                                    <p>${{$cartView->price*$cartView->quantity}}</p>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endforeach
                                                <div class="select-total">
                                                    <span>total:</span>
                                                    <h5>${{$totalHeader}}</h5>
                                                </div>
                                                <div class="select-button">
                                                    <a href="{{route('cart.index')}}" class="primary-btn view-card">VIEW
                                                        CARD</a>
                                                    <a href="{{route('checkout.show')}}"
                                                       class="primary-btn checkout-btn">CHECK OUT</a>
                                                </div>
                                            @else
                                                <div class="">
                                                    <h6>No product</h6>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                <div class="dropdown ml-3">
                                    <h4 class="dropbtn text-center">
                                        @if(Auth::user())
                                            {{ Auth::user()->name }}
                                        @endif
                                    </h4>
                                    <div class="dropdown-content" style="z-index: 100">
                                        <a class="dropdown-item" href="{{route('profile.show')}}">Profile</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit">Đăng xuất</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-3">
                        <div class="btn-group mb-2 full-width">
                            <button type="button" class="btn btn-warning mr-2 full-width" data-toggle="modal"
                                    data-target="#chooseLanguageOrder"
                                    aria-expanded="false">
                                <a class="text-white" target="_blank" rel="noopener noreferrer"  href="http://order.2188.info/admin">{{ __('home.orders') }}</a>
                            </button>

{{--                            <div class="modal fade" id="chooseLanguageOrder" tabIndex="-1" role="dialog"--}}
{{--                                 aria-labelledby="editModalLabel" aria-hidden="true">--}}
{{--                                <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title" id="exampleModalLabel">Choose Language Orders</h5>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                <span aria-hidden="true">&times;</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            <form id="">--}}
{{--                                                <div class="d-flex justify-content-between" style="margin: 8px 16px">--}}
{{--                                                    <a href="{{route('login.local' , ['locale' => 'vi'])}}"--}}
{{--                                                       class="full-width">--}}
{{--                                                        <img class="img" width="102px" height="68px"--}}
{{--                                                             src="{{ asset('images/vietnam.webp') }}" alt="">--}}
{{--                                                    </a>--}}

{{--                                                    <a href="{{route('login.local' , ['locale' => 'kr'])}}"--}}
{{--                                                       class="full-width">--}}
{{--                                                        <img class="border img" width="102px" height="68px"--}}
{{--                                                             src="{{ asset('images/korea.png') }}" alt="">--}}
{{--                                                    </a>--}}

{{--                                                    <a href="{{route('login.local' , ['locale' => 'cn'])}}"--}}
{{--                                                       class="full-width">--}}
{{--                                                        <img class="img" width="102px" height="68px"--}}
{{--                                                             src="{{ asset('images/china.webp') }}" alt="">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <button type="button" class="btn btn-success mr-2 full-width" data-toggle="modal"
                                    data-target="#chooseLanguagePurchase"
                                    aria-expanded="false"><a class="text-white" href="{{route('login')}}">{{ __('home.purchase') }}</a></button>
                            @endif
                        </div>
                    </div>
            </div>
            @unless(request()->is('/'))
                <div class="nav-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="nav-depart">
                                    <div class="depart-btn">
                                        <i class="fa fa-bars"></i>
                                        <span>{{ __('home.all_categories') }}</span>
                                        <ul class="depart-hover">
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
                                            <li><a href="#">Underwear</a></li>
                                            <li><a href="#">Kid's Clothing</a></li>
                                            <li><a href="#">Brand Fashion</a></li>
                                            <li><a href="#">Accessories/Shoes</a></li>
                                            <li><a href="#">Luxury Brands</a></li>
                                            <li><a href="#">Brand Outdoor Apparel</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-8">
                                <nav class="nav-menu mobile-menu">
                                    <ul>
                                        <li><a href="{{route('product.index')}}">Shop</a></li>
                                        <li><a href="#">Collection</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Men's</a></li>
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


                        <div id="mobile-menu-wrap"></div>
                    </div>
                </div>
    @endunless
</header>
<!-- Header End -->

