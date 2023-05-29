@php use Illuminate\Support\Facades\Auth; @endphp
        <!-- Header Section Begin -->
<header class="header-section">
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
                    <select class="language_drop" name="countries" id="countries" style="width:300px;" onchange="location = this.value;">
                        @if(session('locale') == 'vi' || session('locale') == null)
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}' data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}' data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr">
                                <a class="text-body mr-3">Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}' data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}' data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'kr')
                            <option class="img" value='{{ route('language', ['locale' => 'kr']) }}' data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                    data-title="Korea">
                                <a class="text-body mr-3" >Korea</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'vi']) }}' data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                    data-title="VietNam">
                                <a class="text-body mr-3">Việt Nam</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'jp']) }}' data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                    data-title="Japan">
                                <a class="text-body mr-3">Japan</a>
                            </option>
                            <option class="img" value='{{ route('language', ['locale' => 'cn']) }}' data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                    data-title="China">
                                <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'jp')
                                <option class="img" value='{{ route('language', ['locale' => 'jp']) }}' data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                        data-title="Japan">
                                    <a class="text-body mr-3">Japan</a>
                                </option>
                                <option class="img" value='{{ route('language', ['locale' => 'kr']) }}' data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                        data-title="Korea">
                                    <a class="text-body mr-3" >Korea</a>
                                </option>
                                <option class="img" value='{{ route('language', ['locale' => 'vi']) }}' data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                        data-title="VietNam">
                                    <a class="text-body mr-3">Việt Nam</a>
                                </option>
                                <option class="img" value='{{ route('language', ['locale' => 'cn']) }}' data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                        data-title="China">
                                    <a class="text-body mr-3">China</a>
                            </option>
                        @endif
                        @if(session('locale') == 'cn')
                                <option class="img" value='{{ route('language', ['locale' => 'cn']) }}' data-image="{{ asset('images/china.webp') }}" data-imagecss="flag cn"
                                        data-title="China">
                                    <a class="text-body mr-3">China</a>
                                <option class="img" value='{{ route('language', ['locale' => 'kr']) }}' data-image="{{ asset('images/korea.png') }}" data-imagecss="flag kr"
                                        data-title="Korea">
                                    <a class="text-body mr-3" >Korea</a>
                                </option>
                                <option class="img" value='{{ route('language', ['locale' => 'vi']) }}' data-image="{{ asset('images/vietnam.webp') }}" data-imagecss="flag vi"
                                        data-title="VietNam">
                                    <a class="text-body mr-3">Việt Nam</a>
                                </option>
                                <option class="img" value='{{ route('language', ['locale' => 'jp']) }}' data-image="{{ asset('images/japan.webp') }}" data-imagecss="flag jp"
                                        data-title="Japan">
                                    <a class="text-body mr-3">Japan</a>
                                </option>
                        @endif
                    </select>
                </div>
                <div class="top-social">
                    <a href="#"><i class="fa fa-facebook" ></i></a>
                    <a href="#"><i class="fa fa fa-instagram" ></i></a>
                    <a href="#"><i class="fa fa-twitter" ></i></a>
                    <a href="#"><i class="fa fa-share" ></i></a>
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
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <input type="text" placeholder="{{ __('home.placeholder search') }}">
                            <button type="button"><i class="fa fa-search" ></i></button>
                        </div>
                    </div>
                </div>
                @if (session('error'))
                    {{ session('error') }}
                @endif
                @if(session('login'))
                    <div class="col-lg-3 text-right col-md-3">
                        <div class="col-md-8">
                            <div class="dropdown d-flex align-items-center">
                                <ul class="nav-right">
                                    <li class="cart-icon">
                                        <a href="#">
                                            <i class="fa fa-shopping-cart" ></i>
                                            <span>2</span>
                                        </a>
                                        <div class="cart-hover">
                                            <div class="select-items">
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td class="si-pic"><img src="img/select-product-1.jpg" alt=""></td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p>$60.00 x 1</p>
                                                                <h6>Kabino Bedside Table</h6>
                                                            </div>
                                                        </td>
                                                        <td class="si-close">
                                                            <i class="ti-close"></i>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="si-pic"><img src="img/select-product-2.jpg" alt=""></td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p>$60.00 x 1</p>
                                                                <h6>Kabino Bedside Table</h6>
                                                            </div>
                                                        </td>
                                                        <td class="si-close">
                                                            <i class="ti-close"></i>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="select-total">
                                                <span>total:</span>
                                                <h5>$120.00</h5>
                                            </div>
                                            <div class="select-button">
                                                <a href="#" class="primary-btn view-card">VIEW CARD</a>
                                                <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <h4 data-toggle="dropdown" aria-expanded="false">
                                    @if(Auth::user())
                                        {{ Auth::user()->name }}
                                    @endif
                                </h4>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit">Đăng xuất</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-3">
                        <div class="btn-group mb-2 full-width">
                            <a href="/login" class="full-width">
                                <button type="button" class="btn btn-warning mr-2 full-width"
                                        aria-expanded="false">{{ __('home.sign in') }}</button>
                            </a>
                        <div class="btn-group mb-2 full-width">
                            <a href="/register" class="full-width">
                                <button type="button" class="btn btn-success mr-2 full-width"
                                        aria-expanded="false">{{ __('home.sign up') }}</button>
                            </a>
                        </div>

                        <div class="btn-group full-width">
                            <a href="" class="full-width">
                                <button type="button" class="btn btn-danger mr-2 full-width"
                                        aria-expanded="false">
                                    button 1
                                </button>
                            </a>
                        </div>

                        <div class="btn-group full-width">
                            <a href="" class="full-width">
                                <button type="button" class="btn btn-info mr-2 full-width"
                                        aria-expanded="false">
                                    button 2
                                </button>
                            </a>
                        </div>
                    </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="fa fa-bars" ></i>
                    <span>All departments</span>
                    <ul class="depart-hover">
                        <li class="active"><a href="#">Women’s Clothing</a></li>
                        <li><a href="#">Men’s Clothing</a></li>
                        <li><a href="#">Underwear</a></li>
                        <li><a href="#">Kid's Clothing</a></li>
                        <li><a href="#">Brand Fashion</a></li>
                        <li><a href="#">Accessories/Shoes</a></li>
                        <li><a href="#">Luxury Brands</a></li>
                        <li><a href="#">Brand Outdoor Apparel</a></li>
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('product.index')}}">Shop</a></li>
                    <li><a href="#">Collection</a>
                        <ul class="dropdown">
                            <li><a href="#">Men's</a></li>
                            <li><a href="#">Women's</a></li>
                            <li><a href="#">Kid's</a></li>
                        </ul>
                    </li>
                    <li><a href="./blog.html">Blog</a></li>
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
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
<!-- Header End -->
