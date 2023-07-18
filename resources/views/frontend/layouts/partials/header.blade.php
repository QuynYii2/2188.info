@php use Illuminate\Support\Facades\Auth; @endphp
        <!-- Header Section Begin -->
@php
    $config = \App\Models\ConfigProject::where('status', \App\Enums\ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
@endphp
<header class="header">
    <div class="header-pc halo-header">
        <div class="header-top text-center">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="header-top-left col-xl-4 col-md-4 row">
                        @if(!$config->isEmpty())
                            <div class="header-logo col-xl-7 ">
                                <a href="{{route('home')}}">
                                    <img src="{{ asset('storage/'.$config[0]->logo) }}" alt="">
                                </a>
                            </div>
                        @endif

                        @if(!$config->isEmpty())
                            <div class="header-address text-center col-xl-5">
                                <a class="header-address--text" href="">Available 24/7 at</a>
                                <a class="header-address--phone" href="">{{$config[0]->phone}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="header-top-middle col-xl-5 col-md-4 " id="in-search">
                        <form class="search-wrapper">
                            <input type="text" placeholder="{{ __('home.placeholder search') }}"
                                   style="box-shadow: none">
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <div class="category-drop input-group-prepend">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">All</a>
                                    @php
                                        $listCate = DB::table('categories')->where('parent_id', null)->get();
                                    @endphp
                                    @foreach($listCate as $cate)
                                        <a class="item-hd dropdown-item " href="">-- {{ $cate->name }}</a>
                                        @if(!$listCate->isEmpty())
                                            <ul class="hd_dropdown--right row">
                                                @php
                                                    $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                                                @endphp
                                                @foreach($listChild as $child)
                                                    <a class="dropdown-item" href="">––– {{ $child->name }}</a>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="header-top-right col-xl-3 col-md-4 d-flex text-center justify-content-end">
                        @if(Auth::check())
                            <div class="item">
                                <button class="button" onclick="">
                                    <i class="item-icon fa-regular fa-heart"></i>
                                    <div class="item-text">Wish Lists</div>
                                </button>
                            </div>
                            <div class="item">
                                <button class="button" onclick="">
                                    <i class="item-icon fa-solid fa-gift"></i>
                                    <div class="item-text">Gift Cards</div>
                                </button>
                            </div>
                            <div class="item">
                                <button class="button" onclick="signIn()"><i class="item-icon fa-regular fa-user"></i>
                                    <div class="item-text">{{Auth::user()->name}}</div>
                                </button>
                                <div class="signMenu" id="signMenu">
                                    <div class="name"><a href="{{route('profile.show')}}">{{Auth::user()->name}}</a>
                                    </div>
                                    <hr>
                                    <button class="signOut" href="#" onclick="logout()">Sign Out</button>
                                </div>
                            </div>
                            <div class="close-signMenu" onclick="closesignIn()"></div>
                            <div class="item item-shop">
                                <button class="button" onclick="Shop()">
                                    <i class="item-shop--icon fa-solid fa-cart-shopping"></i>
                                </button>
                                <div class="shop-menu" id="closeShop">
                                    <div class="d-flex pb-4">
                                        <span class="cart mr-4">REVIEW YOUR CART</span>
                                        <span>0 item</span>
                                    </div>
                                    <div class="shop-list">
                                        @php
                                            $cartItems = \App\Models\Cart::where([
                                                ['user_id', Auth::user()->id],
                                                ['status', \App\Enums\CartStatus::WAIT_ORDER]])->get();
                                        @endphp
                                        @if ($cartItems->isEmpty())
                                            <p>Chưa có sản phẩm trong giỏ hàng.</p>
                                        @else
                                            @foreach ($cartItems as $cartItem)
                                                <div class="shop-item row">
                                                    <div class="col-3 shop-item--img">
                                                        <img src="{{ asset('storage/'.$cartItem->product->thumbnail) }}" alt="">
                                                    </div>
                                                    <div class="col-8 shop-item--text">
                                                        <div class="text-seller">
                                                            {{$cartItem->product->user->name}}
                                                        </div>
                                                        <div class="text-name">
                                                            <a href="{{route('detail_product.show', $cartItem->product->id)}}">{{ $cartItem->product->name }} x1</a>
                                                        </div>
                                                        <div class="text-properties">
                                                            <span>Black/ 55 inch</span>
                                                            <span><i class="fa-regular fa-pen-to-square"></i></span>
                                                        </div>
                                                        <div class="text-price">$ {{ $cartItem->price }} </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <form action="{{ route('cart.delete', $cartItem->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"> X</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <hr class="mt-5 mb-5">
                                    <div class="pay">
                                        <div class="total mb-4">
                                            <div class="subtotal"></div>
                                            <div class="grandtotal d-flex justify-content-between ">
                                                <span>Grand Total:</span>
                                                <span>$ {{ $cartItem->price*$cartItem->quantity }}</span>
                                            </div>
                                        </div>
                                        <div class="cart">
                                            <div class="check_now">
                                                <a href="#">
                                                    Check out now
                                                </a>
                                            </div>
                                            <div class="view-card">
                                                <a href="{{ route('cart.index') }}">
                                                    View Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="closeShopMenu" onclick="closeShop()"></div>
                        @else
                            <div class="item">
                                <button class="button" onclick="signIn()"><i class="item-icon fa-regular fa-user"></i>
                                    <div class="item-text">Sign in</div>
                                </button>
                                <div class="signMenu" id="signMenu">
                                    <div class="login">LOGIN</div>
                                    <div class="content">
                                        If you are already registered, please log in.
                                    </div>
                                    <form action="{{route('login.submit')}}" method="post">
                                        @csrf
                                        <div class="email">
                                            Email Address:<span class="text-danger">*</span> <br>
                                            <input class="mt-2" name="login_field" type="email"
                                                   placeholder="{{ __('home.input email') }}" style="box-shadow: none">
                                        </div>
                                        <div class="password">
                                            Password: <span class="text-danger">*</span> <br>
                                            <input class="mt-2" name="password" type="password"
                                                   placeholder="{{ __('home.input password') }}"
                                                   style="box-shadow: none">
                                        </div>
                                        <div class="card-bottom--left">
                                            <button type="submit">Sign In</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="content">
                                        Create your account and enjoy a new shopping experience.
                                    </div>
                                    <a href="{{route('register.show')}}" class="register">
                                        <button type="submit">Create A New Account</button>
                                    </a>
                                </div>
                            </div>
                            <div class="close-signMenu" onclick="closesignIn()"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-9 col-md-10 header-bottom-left d-flex align-items-center">
                        <div class="header-bottom-left--item header_bottom--one col-2">
                            <div class="header_bottom--one--hd">
                                <i class="fa-solid fa-bars"></i>
                                Category
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            @php
                                $listCate = DB::table('categories')->where('parent_id', null)->get();
                            @endphp
                            <div class="drop-menu">
                                @foreach($listCate as $cate)
                                    <div class=" header_bottom--one--list">
                                        <div class="header_bottom--one--list--item">
                                            <a class="item d-flex" href="{{ route('category.show', $cate->id) }}">
                                                <i class="fa-solid fa-tv"></i>
                                                <div class="item-text">{{ $cate->name }}</div>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                            @if(!$listCate->isEmpty())
                                                <ul class="hd_dropdown--right row">
                                                    @php
                                                        $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                                                    @endphp
                                                    @foreach($listChild as $child)
                                                        <div class="colum col-4 col-lg-4">
                                                            <li>
                                                                <a class="colum-hd"
                                                                   href="{{ route('category.show', $child->id) }}">{{ $child->name }}</a>
                                                            </li>
                                                            @php
                                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                                            @endphp
                                                            @foreach($listChild2 as $child2)
                                                                <li>
                                                                    <a class="colum-item"
                                                                       href="{{ route('category.show', $child2->id) }}">{{ $child2->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">About Us</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">Lookbook</span>
                            </a>

                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">Buy Superkart</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">Theme FAQs</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">Shipping & Returns</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">Contact Us</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">Blog</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-2 header-bottom-right d-flex align-items-center justify-content-end">
                        <div class="help">
                            <i class="fa-solid fa-headset"></i>
                            <span>Help</span>
                        </div>

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
                        {{--                        <div class="nation dropdown">--}}
                        {{--                            <button class="btn dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                        {{--                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/lib/flags/us.gif" alt=""> VN--}}
                        {{--                            </button>--}}
                        {{--                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                        {{--                                <a class="dropdown-item" href="#"> <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/lib/flags/us.gif" alt=""> HQ--}}
                        {{--                                </a>--}}
                        {{--                                <a class="dropdown-item" href="#"><img src="https://cdn11.bigcommerce.com/s-3uw22zu194/lib/flags/us.gif" alt=""> TQ</a>--}}
                        {{--                                <a class="dropdown-item" href="#"><img src="https://cdn11.bigcommerce.com/s-3uw22zu194/lib/flags/us.gif" alt=""> NB</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile halo-header">
        <div class="hd-mobile flex-row p-0">
            <div class="col-3 d-flex">
                <div class="hd-mobile--left">
                    <button onclick="menuMobile()"><i class="fa-solid fa-bars"></i></button>
                </div>
                <div class="hd-mobile--right--one">
                    <button onclick="Search_mobile()"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <div class="form-search" id="search_mobile">
                        <form class="form-inline">
                            {{--                            <input class="form-control" placeholder="Tìm khóa học..." aria-label="Search">--}}
                            {{--                            <button class="btn my-sm-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>--}}
                        </form>
                    </div>
                </div>
            </div>
            <div onclick="closeSearch_mobile()" class="close_search_mobile"></div>
            @if(!$config->isEmpty())
                <div class="hd-mobile--center col-5 text-center">
                    <a href="{{route('home')}}">
                        <img class="header-logo--image" src="{{ asset('storage/'.$config[0]->logo) }}" alt="">
                    </a>
                </div>
            @endif
            <div class="hd-mobile--right col-3">
                @if(Auth::check())
                    <div class="hd-mobile--one">
                        <button class="button" onclick="signInM()"><i class="item-icon fa-regular fa-user"></i>
                            <div class="item-text"></div>
                        </button>
                        <div class="signMenuM" id="signMenuM">
                            <div class="name"><a href="{{route('profile.show')}}">{{Auth::user()->name}}</a></div>
                            <hr>
                            <button class="signOut" href="#" onclick="logout()">Log Out</button>
                        </div>
                    </div>
                    <div class="close-signMenuM" onclick="closesignInM()"></div>
                    <div class="hd-mobile--right--two">
                        <button class="button" onclick="ShopM()">
                            <i class="item-shop--icon fa-solid fa-cart-shopping"></i>
                        </button>
                        <div class="shop-menuM" id="closeShopM">
                            <div class="d-flex pb-4">
                                <span class="cart mr-4">REVIEW YOUR CART</span>
                                <span>0 item</span>
                            </div>
                            <div class="shop-list">
                                @php
                                    $cartItems = \App\Models\Cart::where([
                                        ['user_id', Auth::user()->id],
                                        ['status', \App\Enums\CartStatus::WAIT_ORDER]])->get();
                                @endphp
                                @if ($cartItems->isEmpty())
                                    <p>Chưa có sản phẩm trong giỏ hàng.</p>
                                @else
                                    @foreach ($cartItems as $cartItem)
                                        <div class="shop-item row">
                                            <div class="col-3 shop-item--img">
                                                <img src="{{ asset('storage/'.$cartItem->product->thumbnail) }}" alt="">
                                            </div>
                                            <div class="col-8 shop-item--text">
                                                <div class="text-seller">
                                                    {{$cartItem->product->user->name}}
                                                </div>
                                                <div class="text-name">
                                                    <a href="{{route('detail_product.show', $cartItem->product->id)}}">{{ $cartItem->product->name }} x1</a>
                                                </div>
                                                <div class="text-properties">
                                                    <span>Black/ 55 inch</span>
                                                    <span><i class="fa-regular fa-pen-to-square"></i></span>
                                                </div>
                                                <div class="text-price">$ {{ $cartItem->price }} </div>
                                            </div>
                                            <div class="col-1">
                                                <form action="{{ route('cart.delete', $cartItem->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"> X</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <hr class="mt-5 mb-5">
                            <div class="pay">
                                <div class="total mb-4">
                                    <div class="subtotal"></div>
                                    <div class="grandtotal d-flex justify-content-between ">
                                        <span>Grand Total:</span>
                                        <span>$ {{ $cartItem->price*$cartItem->quantity }}</span>
                                    </div>
                                </div>
                                <div class="cart">
                                    <div class="check_now">
                                        <a href="#">
                                            Check out now
                                        </a>
                                    </div>
                                    <div class="view-card">
                                        <a href="{{ route('cart.index') }}">
                                            View Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="closeShopMenuM" onclick="closeShopM()"></div>
                @else
                    <div class="hd-mobile--one ">
                        <button class="button" onclick="signInM()"><i class="item-icon fa-regular fa-user"></i>
                            <div class="item-text"></div>
                        </button>
                        <div class="signMenuM" id="signMenuM">
                            <div class="login">LOGIN</div>
                            <div class="content">
                                If you are already registered, please log in.
                            </div>
                            <form action="{{route('login.submit')}}" method="post">
                                @csrf
                                <div class="email">
                                    Email Address:<span class="text-danger">*</span> <br>
                                    <input class="mt-2" name="login_field" type="email"
                                           placeholder="{{ __('home.input email') }}" style="box-shadow: none">
                                </div>
                                <div class="password">
                                    Password: <span class="text-danger">*</span> <br>
                                    <input class="mt-2" name="password" type="password"
                                           placeholder="{{ __('home.input password') }}" style="box-shadow: none">
                                </div>
                                <div class="card-bottom--left">
                                    <button type="submit">Sign In</button>
                                </div>
                            </form>
                            <hr>
                            <div class="content">
                                Create your account and enjoy a new shopping experience.
                            </div>
                            <a href="{{route('register.show')}}" class="register">
                                <button type="submit">Create A New Account</button>
                            </a>
                        </div>
                    </div>
                    <div class="close-signMenuM" onclick="closesignInM()"></div>
                @endif
            </div>
        </div>
        <div class="hd-mobile_menu" id="demo">
            <div class="close-menu d-lg-none d-block "></div>
            <div class="MenuContainer">
                @foreach($listCate as $cate)
                    <div class="OptionContainer">
                        <div class="OptionHead">
                            <a class="item d-flex" href="{{ route('category.show', $cate->id) }}">{{ $cate->name }}</a>
                            <div>
                                <svg onclick="ToggleOption(this)" style="cursor: pointer;"
                                     xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20"
                                     viewBox="0 0 30 30">
                                    <path d="M 24.990234 8.9863281 A 1.0001 1.0001 0 0 0 24.292969 9.2929688 L 15 18.585938 L 5.7070312 9.2929688 A 1.0001 1.0001 0 0 0 4.9902344 8.9902344 A 1.0001 1.0001 0 0 0 4.2929688 10.707031 L 14.292969 20.707031 A 1.0001 1.0001 0 0 0 15.707031 20.707031 L 25.707031 10.707031 A 1.0001 1.0001 0 0 0 24.990234 8.9863281 z"></path>
                                </svg>
                            </div>
                        </div>
                        @if(!$listCate->isEmpty())
                            <div class="OptionBody">
                                @php
                                    $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                                @endphp
                                @foreach($listChild as $child)
                                    <div class="OptionContainer">
                                        <div class="OptionHead">
                                            <a class="item d-flex"
                                               href="{{ route('category.show', $child->id) }}">{{ $child->name }}</a>
                                            <div>
                                                <svg onclick="ToggleOption(this)" style="cursor: pointer;"
                                                     xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                                     height="20" viewBox="0 0 30 30">
                                                    <path d="M 24.990234 8.9863281 A 1.0001 1.0001 0 0 0 24.292969 9.2929688 L 15 18.585938 L 5.7070312 9.2929688 A 1.0001 1.0001 0 0 0 4.9902344 8.9902344 A 1.0001 1.0001 0 0 0 4.2929688 10.707031 L 14.292969 20.707031 A 1.0001 1.0001 0 0 0 15.707031 20.707031 L 25.707031 10.707031 A 1.0001 1.0001 0 0 0 24.990234 8.9863281 z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="OptionBody">
                                            @php
                                                $listChild2 = DB::table('categories')->where('parent_id', $child->id)->get();
                                            @endphp
                                            @foreach($listChild2 as $child2)
                                                <div class="OptionContainer">
                                                    <div class="OptionHead">
                                                        <a class="item d-flex"
                                                           href="{{ route('category.show', $child2->id) }}">{{ $child2->name }}</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div onclick="closemenuMobile()" class="opacity_menu"></div>
    </div>
    {{--    <div class="position-relative" id="popup-alert">--}}
    {{--        <div class="col-md-2 position-fixed" style="z-index: 100; top: 0">--}}
    {{--            <div class="alert">--}}
    {{--                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>--}}
    {{--                <strong>Hello world!</strong> <a class="text-decoration-none text-white"--}}
    {{--                                                 href="{{route('promotions.index')}}">Review now</a>.--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</header>


{{--<header>--}}
{{--    <div class="header-top align-items-center justify-content-between row"--}}
{{--         style="padding-left: 2vw; padding-right: 2vw">--}}
{{--        <div class="container">--}}
{{--            <div style="float: left">--}}
{{--                <div class="ht-left">--}}
{{--                    @if(!$config->isEmpty())--}}
{{--                        <div class="desktop-button">--}}
{{--                            <div class="mail-service">--}}
{{--                                <i class=" fa fa-envelope"></i>--}}
{{--                                {{$config[0]->email}}--}}
{{--                            </div>--}}
{{--                            <div class="phone-service">--}}
{{--                                <i class=" fa fa-phone"></i>--}}
{{--                                {{$config[0]->phone}}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="mobile-button m-2">--}}
{{--                <div class="btn-group">--}}
{{--                    <button type="button" class="btn btn-warning mr-2 full-width text-nowrap" data-toggle="modal"--}}
{{--                            data-target="#chooseLanguageOrder"--}}
{{--                            aria-expanded="false">--}}
{{--                        <a class="text-white" target="_blank" rel="noopener noreferrer"--}}
{{--                           href="http://order.2188.info/">{{ __('home.orders') }}</a>--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-success mr-2 full-width text-nowrap" data-toggle="modal"--}}
{{--                            data-target="#chooseLanguagePurchase"--}}
{{--                            aria-expanded="false"><a class="text-white"--}}
{{--                                                     href="{{route('login')}}">{{ __('home.purchase') }}</a>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="inner-header container">--}}
{{--        <div class="row not-mobile-button my-2">--}}

{{--            @if (session('error'))--}}
{{--                {{ session('error') }}--}}
{{--            @endif--}}
{{--            @if(session('login') || Auth::user()!= null)--}}
{{--                <div class="col-lg-3 col-md-3 text-right col-md-4 col-12 col-sm-4">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <ul class="nav-right mb-0">--}}
{{--                                @php--}}
{{--                                    $cartViews = \App\Models\Cart::where([--}}
{{--                                            ['user_id', '=', Auth::user()->id],--}}
{{--                                            ['status', '=', \App\Enums\CartStatus::WAIT_ORDER]--}}
{{--                                    ])->get();--}}
{{--                                    $totalHeader = 0;--}}
{{--                                    foreach ($cartViews as $cart1){--}}
{{--                                        $totalHeader = $totalHeader + ($cart1->price*$cart1->quantity);--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                <li class="cart-icon">--}}
{{--                                    <a href="#">--}}
{{--                                        <i style="font-size: 30px" class="fa fa-shopping-cart"></i>--}}
{{--                                        <span>{{count($cartViews)}}</span>--}}
{{--                                    </a>--}}
{{--                                    <div class="cart-hover" style="margin-left: 29px">--}}

{{--                                        <div class="select-items table-responsive-sm">--}}
{{--                                            @if(count($cartViews) > 0)--}}
{{--                                                <table>--}}
{{--                                                    <thead>--}}
{{--                                                    <h6>{{ __('home.was new product') }}</h6>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody>--}}
{{--                                                    @foreach($cartViews as $cartView)--}}
{{--                                                        <tr>--}}
{{--                                                            <td class="si-pic"><img--}}
{{--                                                                        src="{{$cartView->product->thumbnail}}"--}}
{{--                                                                        alt="">--}}
{{--                                                            </td>--}}
{{--                                                            <td class="si-text">--}}
{{--                                                                <div class="product-selected">--}}
{{--                                                                    <p>{{$cartView->product->name}}</p>--}}
{{--                                                                </div>--}}
{{--                                                            </td>--}}
{{--                                                            <td class="si-text">--}}
{{--                                                                <p>${{$cartView->price}}--}}
{{--                                                                    x {{$cartView->quantity}} </p>--}}
{{--                                                                <p>${{$cartView->price*$cartView->quantity}}</p>--}}
{{--                                                            </td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endforeach--}}

{{--                                                    </tbody>--}}
{{--                                                </table>--}}

{{--                                        </div>--}}
{{--                                        <div class="select-total">--}}
{{--                                            <span>{{ __('home.Total Payment') }}:</span>--}}
{{--                                            <h5>${{$totalHeader}}</h5>--}}
{{--                                        </div>--}}
{{--                                        <div class="select-button">--}}
{{--                                            <a href="{{route('cart.index')}}"--}}
{{--                                               class="primary-btn view-card">{{ __('home.view card') }}</a>--}}
{{--                                            <a href="{{route('checkout.show')}}"--}}
{{--                                               class="primary-btn checkout-btn">{{ __('home.Pay Now') }}</a>--}}
{{--                                        </div>--}}
{{--                                        @else--}}
{{--                                            <div class="">--}}
{{--                                                <h6>No product</h6>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                            <div class="dropdown ml-3 text-nowrap">--}}
{{--                                <h5 class="dropbtn text-center" style="margin-bottom: 0;" aria-expanded="false">--}}
{{--                                    @if(Auth::user())--}}
{{--                                        {{ Auth::user()->name }}--}}
{{--                                    @endif--}}
{{--                                </h5>--}}
{{--                                @php--}}
{{--                                    $coinUser = \App\Models\Coin::where([['user_id', Auth::user()->id], ['status', \App\Enums\CoinStatus::ACTIVE]])->first();--}}
{{--                                    if ($coinUser == null){--}}
{{--                                        $coin = 0;--}}
{{--                                    } else {--}}
{{--                                       $coin = $coinUser->quantity;--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                                <div class="dropdown-content text-left pt-0">--}}
{{--                                    <ul class="mb-0">--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item"--}}
{{--                                               href="{{route('profile.show')}}">{{ __('home.profile') }}</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item"--}}
{{--                                               href="#">Coins: {{$coin}}</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a href="{{route('buy.coin.show')}}"--}}
{{--                                               class="dropdown-item">{{ __('home.buy coin') }}</a>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <a class="dropdown-item" onclick="logout()"--}}
{{--                                               href="#">{{ __('home.log out') }}</a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @else--}}
{{--                        <div class="col-lg-3 col-md-4 col-sm-4 desktop-button d-flex align-items-center">--}}
{{--                            <div class="btn-group full-width">--}}
{{--                                <button type="button" class="btn btn-warning mr-2 full-width text-nowrap"--}}
{{--                                        data-toggle="modal"--}}
{{--                                        data-target="#chooseLanguageOrder"--}}
{{--                                        aria-expanded="false">--}}
{{--                                    <a class="text-white" target="_blank" rel="noopener noreferrer"--}}
{{--                                       href="http://order.2188.info/">{{ __('home.orders') }}</a>--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-success mr-2 full-width text-nowrap"--}}
{{--                                        data-toggle="modal"--}}
{{--                                        data-target="#chooseLanguagePurchase"--}}
{{--                                        aria-expanded="false"><a class="text-white"--}}
{{--                                                                 href="{{route('login')}}">{{ __('home.purchase') }}</a>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="m-0 row only-mobile-button justify-content-center">--}}
{{--                    <div class="col-lg-2 col-md-2 col-sm-2 col-5 mt-2">--}}
{{--                        <div class="logo">--}}
{{--                            <a href="{{route('home')}}">--}}
{{--                                <img src="{{asset('images/img/logo.png')}}" alt="">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if(session('login') || Auth::user()!= null)--}}
{{--                        <div class="col-lg-3 col-md-3 text-right col-md-4 col-7 mt-2">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <ul class="nav-right mb-0">--}}
{{--                                    @php--}}
{{--                                        $cartViews = \App\Models\Cart::where([--}}
{{--                                                ['user_id', '=', Auth::user()->id],--}}
{{--                                                ['status', '=', \App\Enums\CartStatus::WAIT_ORDER]--}}
{{--                                        ])->get();--}}
{{--                                        $totalHeader = 0;--}}
{{--                                        foreach ($cartViews as $cart1){--}}
{{--                                            $totalHeader = $totalHeader + ($cart1->price*$cart1->quantity);--}}
{{--                                        }--}}
{{--                                    @endphp--}}
{{--                                    <li class="cart-icon">--}}
{{--                                        <a href="#">--}}
{{--                                            <i class="fa fa-shopping-cart"></i>--}}
{{--                                            <span>{{count($cartViews)}}</span>--}}
{{--                                        </a>--}}
{{--                                        <div class="cart-hover">--}}

{{--                                            <div class="select-items table-responsive-sm">--}}
{{--                                                @if(count($cartViews) > 0)--}}
{{--                                                    <table>--}}
{{--                                                        <thead>--}}
{{--                                                        <h6>{{ __('home.was new product') }}</h6>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody>--}}
{{--                                                        @foreach($cartViews as $cartView)--}}
{{--                                                            <tr>--}}
{{--                                                                <td class="si-pic"><img--}}
{{--                                                                            src="{{$cartView->product->thumbnail}}"--}}
{{--                                                                            alt="">--}}
{{--                                                                </td>--}}
{{--                                                                <td class="si-text">--}}
{{--                                                                    <div class="product-selected">--}}
{{--                                                                        <p>{{$cartView->product->name}}</p>--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <td class="si-text">--}}
{{--                                                                    <p>${{$cartView->price}}--}}
{{--                                                                        x {{$cartView->quantity}} </p>--}}
{{--                                                                    <p>${{$cartView->price*$cartView->quantity}}</p>--}}
{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                        @endforeach--}}

{{--                                                        </tbody>--}}
{{--                                                    </table>--}}

{{--                                            </div>--}}
{{--                                            <div class="select-total">--}}
{{--                                                <span>{{ __('home.Total Payment') }}:</span>--}}
{{--                                                <h5>${{$totalHeader}}</h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="select-button">--}}
{{--                                                <a href="{{route('cart.index')}}"--}}
{{--                                                   class="primary-btn view-card">{{ __('home.view card') }}</a>--}}
{{--                                                <a href="{{route('checkout.show')}}"--}}
{{--                                                   class="primary-btn checkout-btn">{{ __('home.Pay Now') }}</a>--}}
{{--                                            </div>--}}
{{--                                            @else--}}
{{--                                                <div class="">--}}
{{--                                                    <h6>No product</h6>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="dropdown ml-3 ">--}}
{{--                                    <h4 class="dropbtn text-center" style="margin-bottom: 0;" aria-expanded="false">--}}
{{--                                        @if(Auth::user())--}}
{{--                                            {{ Auth::user()->name }}--}}
{{--                                        @endif--}}
{{--                                    </h4>--}}
{{--                                    @php--}}
{{--                                        $coinUser = \App\Models\Coin::where([['user_id', Auth::user()->id], ['status', \App\Enums\CoinStatus::ACTIVE]])->first();--}}
{{--                                        if ($coinUser == null){--}}
{{--                                            $coin = 0;--}}
{{--                                        } else {--}}
{{--                                           $coin = $coinUser->quantity;--}}
{{--                                        }--}}
{{--                                    @endphp--}}
{{--                                    <div class="dropdown-content text-left pt-0 mt-2" style="margin-left: -35px">--}}
{{--                                        <ul class="mb-0">--}}
{{--                                            <li>--}}
{{--                                                <a class="dropdown-item"--}}
{{--                                                   href="{{route('profile.show')}}">{{ __('home.profile') }}</a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a class="dropdown-item"--}}
{{--                                                   href="#">Coins: {{$coin}}</a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="{{route('buy.coin.show')}}"--}}
{{--                                                   class="dropdown-item">{{ __('home.buy coin') }}</a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a class="dropdown-item" onclick="logout()"--}}
{{--                                                   href="#">{{ __('home.log out') }}</a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <div class="col-md-6 col-10 mt-2" id="in-search">--}}
{{--                        <div class="advanced-search">--}}
{{--                            <form class="search-wrapper">--}}
{{--                                <input type="text" placeholder="{{ __('home.placeholder search') }}"--}}
{{--                                       style="box-shadow: none">--}}
{{--                                <button type="submit"><i class="fa fa-search"></i></button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if (session('error'))--}}
{{--                        {{ session('error') }}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--        </div>--}}
{{--        <div class="nav-item mobile-button mt-2">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div>--}}
{{--                        <nav class="nav-menu mobile-menu">--}}
{{--                            <ul>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"--}}
{{--                                                                                aria-hidden="true"></i>&ensp; Electronic</a>--}}
{{--                                    <ul>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link text-nowrap" href="#">Điều hòa</a>--}}
{{--                                            <ul>--}}
{{--                                                <li class="nav-item">123</li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">hi</li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}

{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-laptop"--}}
{{--                                                                                          aria-hidden="true"></i>&ensp;--}}
{{--                                        Electronic Device123s</a>--}}
{{--                                    <div class="megamenu">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">All-In-One</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="/category/1">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="/category/1">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="/category/1">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">All-In-One</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="/category/1">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="/category/1">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="/category/1">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-television"--}}
{{--                                                                                          aria-hidden="true"></i>&ensp;--}}
{{--                                        TV & Home Appliances</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="/category/1"><i class="fa fa-laptop"--}}
{{--                                                                                          aria-hidden="true"></i>&ensp;--}}
{{--                                        Electronic Devices</a>--}}
{{--                                    <div class="megamenu">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">All-In-One</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="/category/1">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="/category/1">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="/category/1">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">All-In-One</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="/category/1">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="/category/1">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="/category/1">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="/category/1">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="/category/1">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"--}}
{{--                                                                                aria-hidden="true"></i>&ensp; TV &--}}
{{--                                        Home--}}
{{--                                        Appliances</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"--}}
{{--                                                                                aria-hidden="true"></i>&ensp;--}}
{{--                                        Electronic--}}
{{--                                        Devices</a>--}}
{{--                                    <div class="megamenu">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">All-In-One</a></li>--}}
{{--                                                    <li><a href="#">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="#">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="#">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="#">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="#">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="#">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">All-In-One</a></li>--}}
{{--                                                    <li><a href="#">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="#">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="#">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="#">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="#">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="#">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"--}}
{{--                                                                                aria-hidden="true"></i>&ensp; TV &--}}
{{--                                        Home--}}
{{--                                        Appliances</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-laptop"--}}
{{--                                                                                aria-hidden="true"></i>&ensp;--}}
{{--                                        Electronic--}}
{{--                                        Devices</a>--}}
{{--                                    <div class="megamenu">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">All-In-One</a></li>--}}
{{--                                                    <li><a href="#">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="#">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="#">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="#">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="#">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="#">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <hr>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Desktops Computers</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">All-In-One</a></li>--}}
{{--                                                    <li><a href="#">Gaming Desktops</a></li>--}}
{{--                                                    <li><a href="#">DIY</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Laptops</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Traditional Laptops</a></li>--}}
{{--                                                    <li><a href="#">Gaming Laptops</a></li>--}}
{{--                                                    <li><a href="#">2-in-1s</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-4">--}}
{{--                                                <h5>Audio</h5>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#">Headphones & Headsets</a></li>--}}
{{--                                                    <li><a href="#">Portable Speakers</a></li>--}}
{{--                                                    <li><a href="#">Home Audio</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link text-nowrap" href="#"><i class="fa fa-television"--}}
{{--                                                                                aria-hidden="true"></i>&ensp; TV &--}}
{{--                                        Home--}}
{{--                                        Appliances</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div id="mobile-menu-wrap" class="mg-menu" style=" width: calc(100vw - 2rem);"></div>--}}
{{--    </div>--}}
{{--    @unless(request()->is('/') || request()->is('login') || request()->is('register'))--}}
{{--        <div class="nav-item" id="nav-black" style="background: black">--}}
{{--            <div class="container">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <div class="row" style="background: black">--}}
{{--                        <div class="col-sm-4">--}}
{{--                            <div class="nav-depart">--}}
{{--                                <div class="depart-btn">--}}
{{--                                    <i class="fa fa-bars"></i>--}}
{{--                                    <span>{{ __('home.all_categories') }}</span>--}}
{{--                                    <ul class="depart-hover ">--}}
{{--                                        <li class="active"><a href="#">Women’s Clothing</a></li>--}}
{{--                                        <li><a href="#">Men’s Clothing</a>--}}
{{--                                            <div class="megamenu">--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-sm-4">--}}
{{--                                                        <h4>Desktops Computers</h4>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="#">All-In-One</a></li>--}}
{{--                                                            <li><a href="#">Gaming Desktops</a></li>--}}
{{--                                                            <li><a href="#">DIY</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-sm-4">--}}
{{--                                                        <h4>Laptops</h4>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="#">Traditional Laptops</a></li>--}}
{{--                                                            <li><a href="#">Gaming Laptops</a></li>--}}
{{--                                                            <li><a href="#">2-in-1s</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-sm-4">--}}
{{--                                                        <h4>Audio</h4>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="#">Headphones & Headsets</a></li>--}}
{{--                                                            <li><a href="#">Portable Speakers</a></li>--}}
{{--                                                            <li><a href="#">Home Audio</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <hr>--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-sm-4">--}}
{{--                                                        <h4>Desktops Computers</h4>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="#">All-In-One</a></li>--}}
{{--                                                            <li><a href="#">Gaming Desktops</a></li>--}}
{{--                                                            <li><a href="#">DIY</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-sm-4">--}}
{{--                                                        <h4>Laptops</h4>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="#">Traditional Laptops</a></li>--}}
{{--                                                            <li><a href="#">Gaming Laptops</a></li>--}}
{{--                                                            <li><a href="#">2-in-1s</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-sm-4">--}}
{{--                                                        <h4>Audio</h4>--}}
{{--                                                        <ul>--}}
{{--                                                            <li><a href="#">Headphones & Headsets</a></li>--}}
{{--                                                            <li><a href="#">Portable Speakers</a></li>--}}
{{--                                                            <li><a href="#">Home Audio</a></li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        @php--}}
{{--                                            $listCate = DB::table('categories')->get();--}}
{{--                                        @endphp--}}
{{--                                        @foreach($listCate as $cate)--}}
{{--                                            <li><a href="{{ route('category.show', $cate->id) }}">{{ $cate->name }}</a>--}}
{{--                                            </li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-8">--}}
{{--                            <nav class="nav-menu row">--}}
{{--                                <ul class="mb-0">--}}
{{--                                    <li class="active"><a href="{{route('home')}}">Home</a></li>--}}
{{--                                    <li><a href="{{route('product.index')}}">Shop</a></li>--}}
{{--                                    <li><a href="#">Collection</a>--}}
{{--                                        <ul class="dropdown">--}}
{{--                                            <li><a href="#">Collection</a></li>--}}
{{--                                            <li><a href="#">Women's</a></li>--}}
{{--                                            <li><a href="#">Kid's</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li><a href="./contact.html">Contact</a></li>--}}
{{--                                    <li><a href="#">Pages</a>--}}
{{--                                        <ul class="dropdown">--}}
{{--                                            <li><a href="./blog-details.html">Blog Details</a></li>--}}
{{--                                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>--}}
{{--                                            <li><a href="./check-out.html">Checkout</a></li>--}}
{{--                                            <li><a href="./faq.html">Faq</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endunless--}}
{{--</header>--}}
<!-- Header End -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
{{--<script>--}}
{{--    // variable to store our intervalID--}}
{{--    let nIntervId;--}}

{{--    function changeColor() {--}}
{{--        // check if an interval has already been set up--}}
{{--        if (!nIntervId) {--}}
{{--            nIntervId = setInterval(flashText, 1500);--}}
{{--        }--}}
{{--    }--}}

{{--    function flashText() {--}}
{{--        const oElem = document.getElementById("popup-alert");--}}
{{--        if (oElem.className == 'd-none') {--}}
{{--            oElem.className = 'd-block'--}}
{{--        } else {--}}
{{--            oElem.className = 'd-none'--}}
{{--        }--}}
{{--    }--}}

{{--    function stopTextColor() {--}}
{{--        clearInterval(nIntervId);--}}
{{--        // release our intervalID from the variable--}}
{{--        nIntervId = null;--}}
{{--    }--}}

{{--    changeColor();--}}
{{--</script>--}}
<script>
    // Hàm logout
    function logout() {
        {{--let productIDs = localStorage.getItem('productIDs');--}}

        {{--$.ajax({--}}
        {{--    url: '/product-viewed',--}}
        {{--    method: 'POST',--}}
        {{--    data: {--}}
        {{--        productIds: productIDs,--}}
        {{--        _token: '{{ csrf_token() }}'--}}
        {{--    },--}}
        {{--    success: function (response) {--}}
        {{--        localStorage.clear();--}}
        {{--        console.log(response);--}}
        {{--    },--}}
        {{--    error: function (response) {--}}
        {{--        console.log(response)--}}
        {{--    }--}}
        {{--});--}}

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

