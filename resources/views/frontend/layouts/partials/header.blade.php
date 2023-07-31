@php use Illuminate\Support\Facades\Auth; @endphp
        <!-- Header Section Begin -->
@php
    $config = \App\Models\ConfigProject::where('status', \App\Enums\ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
     $coin = null;
     if (Auth::check()){
         $coin = \App\Models\Coin::where([['status', \App\Enums\CoinStatus::ACTIVE], ['user_id', Auth::user()->id]])->first();
     }
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
                                    @php
                                        $local = session('locale');
                                        if ($local == null){
                                            $local = 'vi';
                                        }
                                    @endphp
                                    <div class="item-text">
                                        <a href="{{route('wish.list.index')}}" style="color: #fff; text-decoration: none">Wish Lists</a>
                                    </div>
                                </button>
                            </div>
                            <div class="item">
                                <button class="button" onclick="">
                                    <i class="item-icon fa-solid fa-gift"></i>
                                    <div class="item-text">Gift Cards</div>
                                </button>
                            </div>
                            <div class="item user">
                                <button class="button" onclick="signIn()"><i class="item-icon fa-regular fa-user"></i>
                                    <div class="item-text">{{Auth::user()->name}}</div>
                                </button>
                                <div class="signMenu" id="signMenu">
                                    <div class="name">
                                        <a href="{{route('profile.show')}}">{{Auth::user()->name}}</a>
                                        <br> <br>
                                        <a href="{{route('process.register.member')}}" class="">Đăng kí thành viên</a>
                                    </div>
                                    <hr>
                                    <button class="signOut" href="#" onclick="logout()">Sign Out</button>
                                </div>
                                <div class="hover-list">
                                    <div class="drop-item">
                                        <a href="{{route('profile.show')}}">{{ __('home.profile') }}</a>
                                    </div>
                                    <div class="drop-item">
                                        @if($coin)
                                            <a href="">Coins: {{$coin->quantity}}</a>
                                        @endif
                                    </div>
                                    <div class="drop-item">
                                        <a href="{{route('buy.coin.show')}}">{{ __('home.buy coin') }}</a>
                                    </div>
                                    @php
                                        $user = Auth::user()->id;
                                        $role_id = DB::table('role_user')->where('user_id', $user)->get();
                                        $isAdmin = false;
                                        foreach ($role_id as $item) {
                                            if ($item->role_id == 1) {
                                                $isAdmin = true;
                                            }
                                        }
                                    @endphp
                                    @if($isAdmin == true)
                                        <div class="drop-item">
                                            <a href="{{ route('seller.products.home') }}">Kênh người bán</a>
                                        </div>
                                    @endif
                                    <div class="drop-item">
                                        <a href="{{route('product.index')}}">Shop</a>
                                    </div>
                                    <div class="drop-item">
                                        <button onclick="logout()" href="">Đăng xuất</button>
                                    </div>
                                </div>
                            </div>
                            <div class="close-signMenu" onclick="closesignIn()"></div>
                            <div class="item item-shop">
                                <button class="button" onclick="Shop()">
                                    <i class="item-shop--icon fa-solid fa-cart-shopping"></i>
                                </button>
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
                                <div class="total_shop">{{count($cartViews)}}</div>
                                <div class="shop-menu" id="closeShop">
                                    <div class="d-flex pb-4">
                                        <span class="cart mr-4">REVIEW YOUR CART</span>
                                        <span>{{count($cartViews)}} item</span>
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
                                                @php
                                                    $productDetail = \App\Models\Variation::where('product_id', $cartItem->product->id)->first();
                                                @endphp
                                                <div class="shop-item row">
                                                    <div class="col-3 shop-item--img">
                                                        <img src="{{ asset('storage/'.$productDetail->thumbnail) }}" alt="">
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
                                            <hr class="mt-5 mb-5">
                                            <div class="pay">
                                                <div class="total mb-4">
                                                    <div class="subtotal"></div>
                                                    <div class="grandtotal d-flex justify-content-between ">
                                                        <span>Grand Total:</span>
                                                        <span>$</span>
                                                    </div>
                                                </div>
                                                <div class="cart">
                                                    <div class="check_now">
                                                        <a href="{{ route('checkout.show') }}">
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
                                        @endif
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
                                        <div class="d-flex justify-content-center social-buttons form-group mt-2">
                                            <button type="button" class="button btn mg-icon"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Google">
                                                <a href="{{ route('login.google') }}"><img class="custom-icon"
                                                                                           src="data:image/png;base64,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"
                                                                                           alt=""></a>
                                            </button>
                                            <button type="button" class="button btn mg-icon"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Facebook">
                                                <a href="{{ route('login.facebook') }}"><img class="custom-icon"
                                                                                             src="data:image/png;base64,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"
                                                                                             alt=""></a>
                                            </button>
                                            <button type="button" class="button btn mg-icon"
                                                    data-toggle="tooltip"
                                                    data-placement="top" title="Kakao Talk">
                                                <a href="{{ route('login.kakaotalk') }}">  <img class="custom-icon"
                                                                                                src="data:image/png;base64,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"
                                                                                                alt=""></a>
                                            </button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="content">
                                        Create your account and enjoy a new shopping experience.
                                    </div>
                                    <a href="{{route('register.show')}}" class="register">
                                        <button type="submit">Create A New Account</button>
                                    </a>
                                    <a href="#" class="register">
                                        <button class="mt-3" type="submit">Đăng kí hội viên</button>
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
                    <div class="col-xl-9 col-md-10 header-bottom-left d-flex align-items-center pl-0">
                        <div class="header-bottom-left--item header_bottom--one col-2 pl-0">
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
                                                <ul class="hd_dropdown--right">
                                                    <div class="list-category">
                                                        @php
                                                            $listChild = DB::table('categories')->where('parent_id', $cate->id)->get();
                                                        @endphp
                                                        @foreach($listChild as $child)
                                                            <div class="colum d-block">
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
                                                    </div>
                                                    <div class="list-product row m-2">
                                                        <div class="col-md-2">
                                                            <b>Featured Products</b>
                                                            <span>Quis ipsum suspendisse ultrices gravida. Risus an commodo viverra delta maecenas cumsan lacus de facilisis.</span>
                                                        </div>
                                                        <div class="col-md-6 list-product--swiper">
                                                            <div class="swiper Category_listProduct">
                                                                <div class="swiper-wrapper">
                                                                    @php
                                                                        $products = DB::table('products')->get();
                                                                    @endphp
                                                                    @foreach($products as $product)
                                                                        <div class="swiper-slide">
                                                                            <div class="item">
                                                                                <div class="item-img">
                                                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                                         alt="">
                                                                                    <div class="button-view">
                                                                                        <button href="">Quick view</button>
                                                                                    </div>
                                                                                    <div class="text">
                                                                                        <!-- <div class="text-sale">
                                                                                                        Sale
                                                                                                    </div>
                                                                                                    <div class="text-new">
                                                                                                        New
                                                                                                    </div> -->
                                                                                        <!-- <div class="text-bundle">
                                                                                                        Bundle
                                                                                                    </div> -->
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
                                                                                        $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                                                                    @endphp
                                                                                    <div class="card-brand">
                                                                                        {{$nameUser->name}}
                                                                                    </div>
                                                                                    <div class="card-title">
                                                                                        <a href="{{route('detail_product.show', $product->id)}}">{{$product->name}}</a>
                                                                                    </div>
                                                                                    <div class="card-price d-flex justify-content-between">
                                                                                        <!-- <div class="price">
                                                                                                        <strong>$189.000</strong>
                                                                                                    </div> -->
                                                                                        <div class="price-sale">
                                                                                            <strong>${{$product->qty}}</strong>
                                                                                        </div>
                                                                                        <div class="price-cost">
                                                                                            <strike>${{$product->price}}</strike>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="card-bottom d-flex justify-content-between">
                                                                                        <div class="card-bottom--left">
                                                                                            <a href="{{route('detail_product.show', $product->id)}}">Choose Options</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="swiper-button-next"></div>
                                                                <div class="swiper-button-prev"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 img">
                                                            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/mega-menu-style-1.jpg" alt="">
                                                        </div>
                                                    </div>
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
                <div class="hd-mobile--leftOne">
                    <button onclick="menuMobile()"><i class="fa-solid fa-bars"></i></button>
                </div>
                <div class="hd-mobile--leftTwo">
                    <button onclick="Search_mobile()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div class="hd-mobile_menu" id="demo">
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
            <div onclick="closeMobile()" class="opacity_menu"></div>
            <div class="hd-mobile_menu" id="search">
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
            <div onclick="closeSearch()" class="search"></div>
            @if(!$config->isEmpty())
                <div class="hd-mobile--center col-5 text-center">
                    <a href="{{route('home')}}">
                        <img class="header-logo--image" src="{{ asset('storage/'.$config[0]->logo) }}" alt="">
                    </a>
                </div>
            @endif
            <div class="d-flex justify-content-end col-3">
                @if(Auth::check())
                    <div class="hd-mobile--rightOne">
                        <button class="button" onclick="signInM()"><i class="item-icon fa-regular fa-user"></i>
                            <div class="item-text"></div>
                        </button>
                    </div>
                    <div class="signMenuM" id="signMenuM">
                        <div class="name"><a href="{{route('profile.show')}}">{{Auth::user()->name}}</a></div>
                        <hr>
                        <button class="signOut" href="#" onclick="logout()">Log Out</button>
                    </div>
                    <div class="close-signMenuM" onclick="closesignInM()"></div>
                    <div class="hd-mobile--rightTwo">
                        <button class="button" onclick="ShopM()">
                            <i class="item-shop--icon fa-solid fa-cart-shopping"></i>
                        </button>
                    </div>
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
                                    <span>$</span>
                                </div>
                            </div>
                            <div class="cart">
                                <div class="check_now">
                                    <a href="{{ route('checkout.show') }}">
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
                    <div class="closeShopMenuM" onclick="closeShopM()"></div>
                @else
                    <div class="hd-mobile--rightOne">
                        <button class="button" onclick="signInM()"><i class="item-icon fa-regular fa-user"></i>
                            <div class="item-text"></div>
                        </button>
                    </div>
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

                            <div class="d-flex justify-content-center social-buttons form-group mt-2">
                                <button type="button" class="button btn mg-icon"
                                        data-toggle="tooltip"
                                        data-placement="top" title="Google">
                                    <a href="{{ route('login.google') }}"><img class="custom-icon"
                                                                               src="data:image/png;base64,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"
                                                                               alt=""></a>
                                </button>
                                <button type="button" class="button btn mg-icon"
                                        data-toggle="tooltip"
                                        data-placement="top" title="Facebook">
                                    <a href="{{ route('login.facebook') }}"><img class="custom-icon"
                                                                                 src="data:image/png;base64,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"
                                                                                 alt=""></a>
                                </button>
                                <button type="button" class="button btn mg-icon"
                                        data-toggle="tooltip"
                                        data-placement="top" title="Kakao Talk">
                                    <a href="{{ route('login.kakaotalk') }}">  <img class="custom-icon"
                                                                                    src="data:image/png;base64,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"
                                                                                    alt=""></a>
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="content">
                            Create your account and enjoy a new shopping experience.
                        </div>
                        <a href="{{route('register.show')}}" class="register">
                            <button type="submit">Create A New Account</button>
                        </a>
                        <a href="#" class="register">
                            <button class="mt-3" type="submit">Đăng kí hội viên</button>
                        </a>
                    </div>
                    <div class="close-signMenuM" onclick="closesignInM()"></div>
                @endif
            </div>
        </div>
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

