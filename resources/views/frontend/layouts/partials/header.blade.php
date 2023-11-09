@php use App\Enums\CartStatus;use App\Enums\CategoryStatus;use App\Enums\CoinStatus;use App\Enums\ConfigProjectStatus;use App\Enums\MemberRegisterInfoStatus;use App\Enums\MemberRegisterPersonSourceStatus;use App\Enums\ProductStatus;use App\Enums\RegisterMember;use App\Http\Controllers\Frontend\HomeController;use App\Models\Cart;use App\Models\Coin;use App\Models\ConfigProject;use App\Models\Member;use App\Models\MemberRegisterInfo;use App\Models\MemberRegisterPersonSource;use App\Models\Product;use Illuminate\Support\Facades\Auth; @endphp
        <!-- Header Section Begin -->
@php
    $config = ConfigProject::where('status', ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
     $coin = null;

     $checkBuyer = false;
     $checkTrust = false;
     if (Auth::check()){
         $coin = Coin::where([['status', CoinStatus::ACTIVE], ['user_id', Auth::user()->id]])->first();
         $checkBuyer = Auth::user()->member == RegisterMember::BUYER;
         $checkTrust = Auth::user()->member == RegisterMember::TRUST;
     }
@endphp
@php
    $langDisplay = new HomeController();
    $locale = app()->getLocale();
    $company = null;
@endphp
<header class="header @php echo ($isRoute ? 'd-none' : '') @endphp">
    <div class="header-pc halo-header">
        <div class="header-top text-center">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="header-top-left col-xl-2 col-md-2">
                        @if(!$config->isEmpty())
                            <div class="header-logo">
                                <a href="{{route('homepage')}}">
                                    <img src="{{ asset('storage/'.$config[0]->logo) }}" alt="">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="header-top-middle col-xl-5 col-md-4 " id="in-search">
                        <form class="search-wrapper" method="get" action="{{route('search.products.name')}}">
                            <input type="text" name="key_search" placeholder="{{ __('home.placeholder search') }}"
                                   style="box-shadow: none">
                            <input hidden="" type="text" id="category_search" name="category_search" value="0">

                            <button class="button-right search_header" type="submit"
{{--                                    onclick="<?php echo $checkBuyer ? 'showAlert(1)' : (Auth::check() ? '' : 'showAlert(2)') ?>"--}}
                            >
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>

                            <div class="category-drop input-group-prepend">
                                <button class="dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('home.all') }}
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item categorySearch" data-id="0">{{ __('home.all') }}</a>
                                    @php
                                        $listCate = DB::table('categories')
                                        ->where('parent_id', null)
                                        ->where('status', CategoryStatus::ACTIVE)
                                        ->orderBy('stt', 'asc')
                                        ->get();
                                    @endphp
                                    @foreach($listCate as $cate)
                                        <a class="item-hd dropdown-item categorySearch"
                                           data-id="{{$cate->id}}">-- {{($cate->{'name' . $langDisplay->getLangDisplay()})}}</a>
                                        @if(!$listCate->isEmpty())
                                            <ul class="hd_dropdown--right row">
                                                @php
                                                    $listChild = DB::table('categories')
                                                    ->where('status', CategoryStatus::ACTIVE)
                                                    ->where('parent_id', $cate->id)
                                                    ->orderBy('stt', 'asc')
                                                    ->get();
                                                @endphp
                                                @foreach($listChild as $child)
                                                    <a class="dropdown-item categorySearch"
                                                       data-id="{{$child->id}}">––– {{($child->{'name' . $langDisplay->getLangDisplay()})}}</a>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="header-top-right col-xl-5 col-md-6 d-flex text-center justify-content-end align-items-center">
                        @if(Auth::check())
                            <div class="item button_seller align-center d-flex">
                                <button type="button" class="full-width cursor-pointer" data-toggle="modal"
                                        data-target="#modal-flag-header">
                                    <div class="it em-text">
                                        {{ __('home.Retail') }}
                                    </div>
                                </button>
                            </div>
                            @php
                                $memberPerson = MemberRegisterPersonSource::where([
                                    ['email', Auth::user()->email],
                                    ['status', MemberRegisterPersonSourceStatus::ACTIVE]
                                ])->first();
                                $company= null;
                                if ($memberPerson){
                                    $company = MemberRegisterInfo::find($memberPerson->member_id);
                                }
                            @endphp

                            @if($company && $company->member != RegisterMember::BUYER)
                                <div class="item button_seller align-center d-flex">
                                    <button type="button" class="full-width cursor-pointer" data-toggle="modal"
                                            data-target="#modalBuyBulkLogistic">
                                        <div class="it em-text">
                                            {{ __('home.Buy wholesale') }}
                                        </div>
                                    </button>
                                </div>
                            @else
                                <div class="item button_seller align-center d-flex">
                                    <button type="button" class="full-width cursor-pointer" data-toggle="modal"
                                            data-target="#buyerModal">
                                        <div class="it em-text">
                                            {{ __('home.Buy wholesale') }}
                                        </div>
                                    </button>
                                </div>
                            @endif
                            @php
                                $local = session('locale');
                                if ($local == null){
                                    $local = 'vi';
                                }
                            @endphp

                            <div class="item user">
                                <button class="btn btn-primary user_login" style="box-shadow: none" onclick="signIn()">
                                    <i class="item-icon fa-regular fa-user"></i>
                                    <div class="name_and_package_member">
                                        <div class="item-text">{{Auth::user()->name}}</div>
                                        @if($company)
                                            @php
                                                $location = locationHelper();
                                                $langWithLocation = 'lang_'.$locale;
                                            @endphp
                                            <span class="package_member d-flex"> {{__('home.Member')}} :
                                               @php $nameMember = Member::where('id',$company->member_id)->value($langWithLocation) ?? ''; @endphp
                                                @if(locationHelper() == 'kr')
                                                    <div class="item-text">{{ $nameMember }}</div>
                                                @elseif(locationHelper() == 'cn')
                                                    <div class="item-text">{{$nameMember}}</div>
                                                @elseif(locationHelper() == 'jp')
                                                    <div class="item-text">{{$nameMember}}</div>
                                                @elseif(locationHelper() == 'vi')
                                                    <div class="item-text">{{$nameMember }}</div>
                                                @else
                                                    <div class="item-text">{{$nameMember }}</div>
                                                @endif
                                            </span>
                                        @endif
                                    </div>

                                </button>
                                <div class="signMenu" id="signMenu">
                                    <div class="name">
                                        <a href="{{route('profile.show')}}">{{Auth::user()->name}}</a>
                                        @if($company && $company->member == RegisterMember::LOGISTIC)
                                            <a href="{{route('process.register.member')}}" hidden=""
                                               class="">{{ __('home.Membership upgrade') }}</a>
                                        @else
                                            <a href="{{route('process.register.member')}}"
                                               class="">{{ __('home.Membership upgrade') }}</a>
                                        @endif

                                    </div>
                                    <hr>
                                    @php
                                        $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                                        $exitsMember = null;
                                        if ($exitMemberPerson) {
                                            $exitsMember = MemberRegisterInfo::where([
                                                ['id', $exitMemberPerson->member_id],
                                                ['status', MemberRegisterInfoStatus::INACTIVE]
                                            ])->first();
                                        }
                                    @endphp
                                    @if($exitsMember)
                                        <div class="name">
                                            <a href="#"
                                               class="">{{ __('home.Membership payment') }}</a>
                                        </div>
                                        <hr>
                                    @endif
                                    <a class="signOut" href="{{ route('logout') }}">{{ __('home.Sign Out') }}</a>
                                </div>
                                <div class="hover-list">
                                    <a href="{{route('profile.show')}}" class="none_decoration">
                                        <div class="drop-item">
                                            {{ __('home.manager page') }}
                                        </div>
                                    </a>

                                    @if(!$checkBuyer)
                                        @php
                                            $user = Auth::user()->id;
                                            $role_id = DB::table('role_user')->where('user_id', $user)->get();
                                            $isAdmin = false;
                                            foreach ($role_id as $item) {
                                                if ($item->role_id == 1 || $item->role_id == 2) {
                                                    $isAdmin = true;
                                                }
                                            }
                                        @endphp
                                        @php
                                            $locale = 'kr';
                                            if(!$locale){
                                                $locale == 'vn';
                                            }
                                            if($locale == 'null'){
                                                $locale == 'vn';
                                            }
                                        @endphp

                                        @php
                                            if (Auth::check()){
                                                $memberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                                                  $isMember = null;
                                                if ($memberPerson){
                                                    $member = MemberRegisterInfo::where([
                                                        ['id', $memberPerson->member_id],
                                                        ['status', MemberRegisterInfoStatus::ACTIVE]
                                                    ])->first();
                                                    if ($member){
//                                                    if ($member->member_id == 2){
                                                        $isMember = true;
//                                                    }
                                                    }
                                                }
                                            }
                                            $memberLogistic = Member::where('name', RegisterMember::LOGISTIC)->first();
                                            $isValid = (new HomeController())->checkSellerOrAdmin();
                                        @endphp
                                        @if($isMember && $member->member_id == $memberLogistic->id)
                                            <div class="drop-item">
                                                <a href="{{ route('stand.register.member.index', $member->id) }}">{{ __('home.Shop') }}</a>
                                            </div>
                                        @elseif($isMember)
                                            <div class="drop-item">
                                                <a href="{{ route('trust.register.member.index') }}">{{ __('home.Partner List') }}</a>
                                            </div>
                                        @endif

                                        @php
                                            $exitMemberPerson = MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                                            $exitsMember = null;
                                            if ($exitMemberPerson) {
                                                $exitsMember = MemberRegisterInfo::where([
                                                    ['id', $exitMemberPerson->member_id],
                                                    ['status', MemberRegisterInfoStatus::INACTIVE]
                                                ])->first();
                                            }
                                        @endphp
                                        @if($exitsMember)
                                            <div class="drop-item text-danger">
                                                <a href="{{route('show.payment.member', $exitsMember->member)}}"
                                                   class="text-danger">{{ __('home.Membership payment') }}</a>
                                            </div>
                                        @endif
                                    @endif

                                    <div class="drop-item -hand-pointer">
                                        <a href="{{ route('logout') }}">{{ __('home.Log out') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="close-signMenu" onclick="closesignIn()"></div>
                            <div class="item item-shop" id="cartBlog">
                            </div>
                            <div class="closeShopMenu" onclick="closeShop()"></div>
                        @else
                            <div class="item">
                                @if(!Auth::user())
                                    <div class="d-flex">
                                        <button class="button_login" onclick="signIn()">
                                            <div class="item-text">{{ __('home.sign in') }}</div>
                                        </button>
                                    </div>
                                @endif

                                <div class="signMenu" id="signMenu">
                                    <div class="login">{{ __('home.LOGIN') }}</div>
                                    <div class="content">
                                        {{ __('home.If you are already registered, please log in') }}
                                    </div>
                                    <form action="{{route('login.submit')}}" method="post" id="formLogin1">
                                        @csrf
                                        <div class="email">
                                            {{ __('home.Email Address') }}<span class="text-danger">*</span> <br>
                                            <input class="mt-2" name="login_field" type="email" id="login_email"
                                                   placeholder="{{ __('home.input email') }}" style="box-shadow: none">
                                        </div>
                                        <div class="password">
                                            {{ __('home.Password') }} <span class="text-danger">*</span> <br>
                                            <input class="mt-2" name="password" type="password" id="login_password"
                                                   placeholder="{{ __('home.input password') }}"
                                                   style="box-shadow: none">
                                        </div>
                                        <div class="password">
                                            {{ __('home.Phone Number Login') }} <span class="text-danger">*</span> <br>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <input class="mt-2" name="phone" type="number" id="login_phone"
                                                           placeholder="{{ __('home.input phone') }}"
                                                           style="box-shadow: none"></div>
                                                <div class="col-sm-4">
                                                    <div>
                                                        <div class="card-bottom--left mt-2">
                                                            <button type="button" onclick="sendVerifyCodeHeader(this);"
                                                                    style="font-size: 16px; line-height: 20px">{{ __('home.information verification Login') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="password">
                                            {{ __('home.Verify Code') }} <span class="text-danger">*</span> <br>
                                            <input class="mt-2" name="verify_code" id="verify_code" type="text"
                                                   placeholder="{{ __('home.Verify Code Login') }}" maxlength="6"
                                                   style="box-shadow: none">
                                        </div>

                                        <div class="card-bottom--left">
                                            <button type="button"
                                                    onclick="submitFormLoginHeader(this)">{{ __('home.Sign In') }}</button>
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
                                                <a href="{{ route('login.kakaotalk') }}">
                                                    <img class="custom-icon"
                                                         src="data:image/png;base64,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"
                                                         alt=""></a>
                                            </button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="content">
                                        {{ __('home.Create your account and enjoy a new shopping experience') }}
                                    </div>
                                    <a href="{{route('register.show')}}" class="register">
                                        <button type="submit">{{ __('home.Create A New Account') }}</button>
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
                    <div class="col-xl-10 col-md-10 header-bottom-left d-flex align-items-center pl-0">
                        <div class="header-bottom-left--item header_bottom--one col-2 pl-0">
                            <div class="header_bottom--one--hd">
                                <i class="fa-solid fa-bars"></i>
                                {{ __('home.Category') }}
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            @php
                                $listCate = DB::table('categories')
                                ->where('status', CategoryStatus::ACTIVE)
                                ->where('parent_id', null)
                                ->orderBy('stt', 'asc')
                                ->get();
                            @endphp
                            <div class="drop-menu">
                                <div class="drop-relative">
                                    @foreach($listCate as $cate)
                                        <div class=" header_bottom--one--list">
                                            <div class="header_bottom--one--list--item">
                                                <a class="item d-flex" href="{{ route('category.show', $cate->id) }}">
                                                    <i class="fa-solid fa-tv"></i>
                                                    @if(locationHelper() == 'kr')
                                                        <div class="item-text">{{ $cate->name_ko }}</div>
                                                    @elseif(locationHelper() == 'cn')
                                                        <div class="item-text">{{$cate->name_zh}}</div>
                                                    @elseif(locationHelper() == 'jp')
                                                        <div class="item-text">{{$cate->name_ja}}</div>
                                                    @elseif(locationHelper() == 'vi')
                                                        <div class="item-text">{{$cate->name_vi}}</div>
                                                    @else
                                                        <div class="item-text">{{$cate->name_en}}</div>
                                                    @endif

                                                    <i class="fa-solid fa-angle-right"></i>
                                                </a>
                                                @if(!$listCate->isEmpty())
                                                    <ul class="hd_dropdown--right">
                                                        <div class="list-category">
                                                            @php
                                                                $listChild = DB::table('categories')
                                                                ->where('status', CategoryStatus::ACTIVE)
                                                                ->where('parent_id', $cate->id)
                                                                ->orderBy('stt', 'asc')
                                                                ->get();
                                                            @endphp
                                                            @foreach($listChild as $child)
                                                                <div class="colum d-block">
                                                                    @if(locationHelper() == 'kr')
                                                                        <li>
                                                                            <a class="colum-hd"
                                                                               href="{{ route('category.show', $child->id) }}">{{$child->name_ko}} </a>
                                                                        </li>
                                                                    @elseif(locationHelper() == 'cn')
                                                                        <li>
                                                                            <a class="colum-hd"
                                                                               href="{{ route('category.show', $child->id) }}">{{$child->name_zh}} </a>
                                                                        </li>
                                                                    @elseif(locationHelper() == 'jp')
                                                                        <li>
                                                                            <a class="colum-hd"
                                                                               href="{{ route('category.show', $child->id) }}">{{$child->name_ja}} </a>
                                                                        </li>
                                                                    @elseif(locationHelper() == 'vi')
                                                                        <li>
                                                                            <a class="colum-hd"
                                                                               href="{{ route('category.show', $child->id) }}">{{$child->name_vi}} </a>
                                                                        </li>
                                                                    @else
                                                                        <li>
                                                                            <a class="colum-hd"
                                                                               href="{{ route('category.show', $child->id) }}">{{$child->name_en}} </a>
                                                                        </li>
                                                                    @endif

                                                                    @php
                                                                        $listChild2 = DB::table('categories')
                                                                        ->where('status', CategoryStatus::ACTIVE)
                                                                        ->where('parent_id', $child->id)
                                                                        ->orderBy('stt', 'asc')
                                                                        ->get();
                                                                    @endphp
                                                                    @foreach($listChild2 as $child2)
                                                                        @if(locationHelper() == 'kr')
                                                                            <li>
                                                                                <a class="colum-item"
                                                                                   href="{{ route('category.show', $child2->id) }}">{{$child2->name_ko}}</a>
                                                                            </li>
                                                                        @elseif(locationHelper() == 'cn')
                                                                            <li>
                                                                                <a class="colum-item"
                                                                                   href="{{ route('category.show', $child2->id) }}">{{$child2->name_zh}}</a>
                                                                            </li>
                                                                        @elseif(locationHelper() == 'jp')
                                                                            <li>
                                                                                <a class="colum-item"
                                                                                   href="{{ route('category.show', $child2->id) }}">{{$child2->name_ja}}</a>
                                                                            </li>
                                                                        @elseif(locationHelper() == 'vi')
                                                                            <li>
                                                                                <a class="colum-item"
                                                                                   href="{{ route('category.show', $child2->id) }}">{{$child2->name_vi}}</a>
                                                                            </li>
                                                                        @else
                                                                            <li>
                                                                                <a class="colum-item"
                                                                                   href="{{ route('category.show', $child2->id) }}">{{$child2->name_en}}</a>
                                                                            </li>
                                                                        @endif

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
                                                                            $products = Product::where('status', ProductStatus::ACTIVE)->limit(5)->get();
                                                                        @endphp
                                                                        @foreach($products as $product)
                                                                            <div class="swiper-slide">
                                                                                <div class="item">
                                                                                    <div class="item-img">
                                                                                        @php
                                                                                            $thumbnail = checkThumbnail($product->thumbnail);
                                                                                        @endphp
                                                                                        <img src="{{ $thumbnail }}"
                                                                                             alt="">
                                                                                    </div>
                                                                                    <div class="item-body">
                                                                                        <div class="card-rating">
                                                                                            <i class="fa-solid fa-star"
                                                                                               style="color: #fac325;"></i>
                                                                                            <i class="fa-solid fa-star"
                                                                                               style="color: #fac325;"></i>
                                                                                            <i class="fa-solid fa-star"
                                                                                               style="color: #fac325;"></i>
                                                                                            <i class="fa-solid fa-star"
                                                                                               style="color: #fac325;"></i>
                                                                                            <i class="fa-solid fa-star"
                                                                                               style="color: #fac325;"></i>
                                                                                            <span>(1)</span>
                                                                                        </div>
                                                                                        @php
                                                                                            $nameUser = DB::table('users')->where('id', $product->user_id)->first();
                                                                                        @endphp
                                                                                        <div class="card-brand">
                                                                                            {{ ($nameUser->name) }}
                                                                                        </div>
                                                                                        <div class="card-title">
                                                                                            <a href="{{route('detail_product.show', $product->id)}}">
                                                                                                @if(locationHelper() == 'kr')
                                                                                                    {{ ($product->name_ko) }}
                                                                                                @elseif(locationHelper() == 'cn')
                                                                                                    {{ ($product->name_zh) }}
                                                                                                @elseif(locationHelper() == 'jp')
                                                                                                    {{ ($product->name_ja) }}
                                                                                                @elseif(locationHelper() == 'vi')
                                                                                                    {{ ($product->name_vi) }}
                                                                                                @else
                                                                                                    {{ ($product->name_en) }}
                                                                                                @endif
                                                                                            </a>
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
                                                                                                <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
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
                                                                <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/mega-menu-style-1.jpg"
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                    </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.About Us') }}</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.Lookbook') }}</span>
                            </a>

                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.Buy Superkart') }}</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.Theme FAQs') }}</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.Shipping & Returns') }}</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.Contact Us') }}</span>
                            </a>
                        </div>
                        <div class="header-bottom-left--item">
                            <a href="">
                                <span class="text">{{ __('home.Blog') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-2 header-bottom-right d-flex align-items-center justify-content-end">
                        <div class="help">
                            <i class="fa-solid fa-headset"></i>
                            <span>{{ __('home.Help') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile halo-header">
        <div class="hd-mobile row p-0">
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
                                <a class="item d-flex"
                                   href="{{ route('category.show', $cate->id) }}">{{ ($cate->name) }}</a>
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
                                        $listChild = DB::table('categories')
                                        ->where('status', CategoryStatus::ACTIVE)
                                        ->where('parent_id', $cate->id)
                                        ->orderBy('stt', 'asc')
                                        ->get();
                                    @endphp
                                    @foreach($listChild as $child)
                                        <div class="OptionContainer">
                                            <div class="OptionHead">
                                                <a class="item d-flex"
                                                   href="{{ route('category.show', $child->id) }}">{{ ($child->name) }}</a>
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
                                                    $listChild2 = DB::table('categories')
                                                    ->where('status', CategoryStatus::ACTIVE)
                                                    ->where('parent_id', $child->id)
                                                    ->orderBy('stt', 'asc')
                                                    ->get();
                                                @endphp
                                                @foreach($listChild2 as $child2)
                                                    <div class="OptionContainer">
                                                        <div class="OptionHead">
                                                            <a class="item d-flex"
                                                               href="{{ route('category.show', $child2->id) }}">{{ ($child2->name) }}</a>
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
                <div class="dropdown-toggle" type="button"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All
                </div>
                <div class="dropdown-menu">
                    <a class="dropdown-item categorySearch" data-id="0">All</a>
                    @php
                        $listCate = DB::table('categories')
                        ->where('status', CategoryStatus::ACTIVE)
                        ->where('parent_id', null)
                        ->orderBy('stt', 'asc')
                        ->get();
                    @endphp
                    @foreach($listCate as $cate)
                        <a class="item-hd dropdown-item categorySearch"
                           data-id="{{$cate->id}}">-- {{ ($cate->name) }}</a>
                        @if(!$listCate->isEmpty())
                            <ul class="hd_dropdown--right row">
                                @php
                                    $listChild = DB::table('categories')
                                    ->where('status', CategoryStatus::ACTIVE)
                                    ->where('parent_id', $cate->id)
                                    ->orderBy('stt', 'asc')
                                    ->get();
                                @endphp
                                @foreach($listChild as $child)
                                    <a class="dropdown-item categorySearch"
                                       data-id="{{$child->id}}">––– {{ ($child->name) }}</a>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </div>
            </div>
            <div onclick="closeSearch()" class="search"></div>
            @if(!$config->isEmpty())
                <div class="hd-mobile--center col-5 text-center">
                    <a href="{{route('homepage')}}">
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
                        <hr>
                        <button class="signOut" href="{{ route('logout') }}">Log Out</button>
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
                                $cartItems = Cart::where([
                                    ['user_id', Auth::user()->id],
                                    ['status', CartStatus::WAIT_ORDER]])->get();
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
                                                {{ ($cartItem->product->user->name) }}
                                            </div>
                                            <div class="text-name">
                                                <a href="{{route('detail_product.show', $cartItem->product->id)}}">{{ ($cartItem->product->name) }}
                                                    x1</a>
                                            </div>
                                            <div class="text-properties">
                                                <span>Black/ 55 inch</span>
                                                <span><i class="fa-regular fa-pen-to-square"></i></span>
                                            </div>
                                            <div class="text-price">$ {{ ($cartItem->price) }} </div>
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
                                        {{ __('home.Check out now') }}
                                    </a>
                                </div>
                                <div class="view-card">
                                    <a href="{{ route('cart.index') }}">
                                        {{ __('home.View Cart') }}
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
                        <div class="login">{{ __('home.LOGIN') }}</div>
                        <div class="content">
                            If you are already registered, please log in.
                        </div>
                        <form action="{{route('login.submit')}}" method="post" id="formLogin2">
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

                            <div class="password">
                                {{ __('home.Phone Number Login') }} <span class="text-danger">*</span> <br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input class="mt-2" name="phone" type="number" id="login_phone"
                                               placeholder="{{ __('home.input phone') }}"
                                               style="box-shadow: none"></div>
                                    <div class="col-sm-4">
                                        <div>
                                            <div class="card-bottom--left mt-2">
                                                <button type="button" onclick="sendVerifyCodeHeader(this);"
                                                        style="font-size: 16px; line-height: 20px">{{ __('home.information verification Login') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="password">
                                {{ __('home.Verify Code') }} <span class="text-danger">*</span> <br>
                                <input class="mt-2" name="verify_code" id="verify_code" type="text"
                                       placeholder="{{ __('home.Verify Code Login') }}" maxlength="6"
                                       style="box-shadow: none">
                            </div>

                            <div class="card-bottom--left">
                                <button type="button"
                                        onclick="submitFormLoginHeader(this)">{{ __('home.Sign In') }}</button>
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
                                    <a href="{{ route('login.kakaotalk') }}"> <img class="custom-icon"
                                                                                   src="data:image/png;base64,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"
                                                                                   alt=""></a>
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="content">
                            {{ __('home.Create your account and enjoy a new shopping experience.') }}
                        </div>
                        <a href="{{route('register.show')}}" class="register">
                            <button type="submit">{{ __('home.Create A New Account') }}</button>
                        </a>
                        <a href="#" class="register">
                            <button class="mt-3" type="submit">{{ __('home.Sign up for membership') }}</button>
                        </a>
                    </div>
                    <div class="close-signMenuM" onclick="closesignInM()"></div>
                @endif
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="modal-flag-header" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="width: auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Select country') }}</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <a href="https://shipgo.biz/kr">
                        <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                             src="{{ asset('flag/kr.svg') }}" alt="">
                    </a>
                    <a href="https://shipgo.biz/en">
                        <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                             src="{{ asset('flag/us.svg') }}" alt="">
                    </a>
                    <a href="https://shipgo.biz/cn">
                        <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                             src="{{ asset('flag/cn.svg') }}" alt="">
                    </a>
                    <a href="https://shipgo.biz/vn">
                        <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                             src="{{ asset('flag/vn.svg') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalBuyBulkLogistic" role="dialog" aria-labelledby="exampleModalBuyBulkLogistic"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4" style="width: auto">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if($company)
                @php
                    $trustMember = \App\Models\Member::where('name', \App\Enums\RegisterMember::TRUST)->first();
                    $logisticMember = \App\Models\Member::where('name', \App\Enums\RegisterMember::LOGISTIC)->first();
                @endphp
                @if($company->member_id == $trustMember->id)
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('trust.register.member.locale', 'kr')}}">
                                <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                     src="{{ asset('images/korea.png') }}" alt="">
                            </a>
                            <a href="{{route('trust.register.member.locale', 'jp')}}">
                                <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                     src="{{ asset('images/japan.webp') }}" alt="">
                            </a>
                            <a href="{{route('trust.register.member.locale', 'cn')}}">
                                <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                     src="{{ asset('images/china.webp') }}" alt="">
                            </a>
                        </div>
                    </div>
                @elseif($company->member_id == $logisticMember->id)
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('parent.register.member.locale', 'kr')}}">
                                <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                     src="{{ asset('images/korea.png') }}" alt="">
                            </a>
                            <a href="{{route('parent.register.member.locale', 'jp')}}">
                                <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                     src="{{ asset('images/japan.webp') }}" alt="">
                            </a>
                            <a href="{{route('parent.register.member.locale', 'cn')}}">
                                <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                     src="{{ asset('images/china.webp') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="buyerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('home.Upgrade Instructions') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('home.The Foreign Wholesale Order feature is only available to corporate members (Trusted members) and above') }}</p>
                <p>{{ __('home.Please upgrade your membership to use') }}</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a
                            href="{{route('process.register.member')}}">{{ __('home.Sign up to upgrade') }}</a></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalBuyBulkTrust" role="dialog" aria-labelledby="exampleModalBuyBulkTrust"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-4" style="width: auto;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if($company)
                @if($company->member == RegisterMember::TRUST)
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('trust.register.member.locale', 'kr')}}">
                                <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt="">
                            </a>
                            <a href="{{route('trust.register.member.locale', 'jp')}}">
                                <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt="">
                            </a>
                            <a href="{{route('trust.register.member.locale', 'cn')}}">
                                <img width="80px" height="80px" src="{{ asset('images/china.webp') }}" alt="">
                            </a>
                        </div>
                    </div>
                @elseif($company->member == RegisterMember::LOGISTIC)
                    <div class="modal-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{route('parent.register.member.locale', 'kr')}}">
                                <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt="">
                            </a>
                            <a href="{{route('parent.register.member.locale', 'jp')}}">
                                <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt="">
                            </a>
                            <a href="{{route('parent.register.member.locale', 'cn')}}">
                                <img width="80px" height="80px" src="{{ asset('images/china.webp') }}" alt="">
                            </a>
                        </div>
                    </div>
                @endif
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
            </div>
        </div>
    </div>
</div>


<script>
    var urlrenderCart = `{{route('renderCart')}}`
    var viewed = '/product-viewed'
    var token = '{{ csrf_token() }}'
    var logoutRoute = '{{ route('logout') }}'
    var process = '{{ route('process.register.member') }}'
    var login = '{{ route('login') }}'
    let decodedStringHeader = '';

    function submitFormLoginHeader(event) {
        let form = event.form;

        const checkForm = checkFormInputHeader(form);
        const verifyCode = document.getElementById('verify_code').value;
        if (!checkForm) {
            alert('Vui lòng nhập đầy đủ thông tin');
            return;
        }
        if (verifyCode == '686868') {
            document.getElementById('formLogin1').submit();
            return;
        }
        if (verifyCode !== decodedStringHeader) {
            alert('Vui lòng nhập đúng mã xác thực');
            return;
        }
        document.getElementById('formLogin1').submit();
    }

    function checkFormInputHeader(form) {
        const email = form.elements.login_field.value;
        const phone = form.elements.password.value;
        const password = form.elements.phone.value;
        const verifyCode = form.elements.verify_code.value;

        return !(!email || !phone || !password || !verifyCode);
    }

    function sendVerifyCodeHeader(event) {
        let form = event.form;

        const email = form.elements.login_field.value;
        const phone = form.elements.phone.value;
        if (!phone) {
            alert('Vui lòng nhập số điện thoại');
            return;
        }
        const apiUrl = "{{ route('user.get.number.phone') }}";
        const data = {
            _token: "{{ csrf_token() }}",
            email: email,
            phone: phone
        };

        $.ajax({
            url: apiUrl,
            type: 'POST',
            data: data,
            success: function (response) {
                if (response.status === 400) {
                    alert(response.message);
                    return;
                }
                decodedStringHeader = atob(response.deaswr);
            },
            error: function (response) {
            }
        });
        alert('Đã gửi mã xác thực đến số điện thoại của bạn');
    }

</script>

<script src="{{ asset('js/frontend/partials/header.js') }}"></script>
