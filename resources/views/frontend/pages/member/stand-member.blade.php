@extends('frontend.layouts.master')
@section('title', 'Product Register Members')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <div class="container stand-member">
        @if($company)
            @php
                if (Auth::check()){
                                                $memberPerson = \App\Models\MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                                                  $isMember = null;
                                                if ($memberPerson){
                                                    $member = \App\Models\MemberRegisterInfo::where([
                                                        ['id', $memberPerson->member_id],
                                                        ['status', \App\Enums\MemberRegisterInfoStatus::ACTIVE]
                                                    ])->first();
                                                    if ($member){
                                                        $isMember = true;
                                                    }
                                                }
                                            }
                    $memberAccounts = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->get();
                    $companyPerson = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->first();
                    $oldUser = \App\Models\User::where('email', $companyPerson->email)->first();
                    if (!$memberAccounts->isEmpty()){
                      $products = \App\Models\Product::where(function ($query) use ($company, $memberAccounts){
                            if (count($memberAccounts) == 2){
                                $user1 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                                $user2 = \App\Models\User::where('email', $memberAccounts[1]->email)->first();
                            } else{
                                $user1 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                                $user2 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                            }

                            $query->where([['user_id', $company->user_id], ['status', \App\Enums\ProductStatus::ACTIVE]])
                                  ->orWhere([['user_id', $user1->id], ['status', \App\Enums\ProductStatus::ACTIVE]])
                                  ->orWhere([['user_id', $user2->id], ['status', \App\Enums\ProductStatus::ACTIVE]]);
                            })->get();
                    } else{
                        $products = \App\Models\Product::where([['user_id', $company->user_id], ['status', \App\Enums\ProductStatus::ACTIVE]])->get();
                    }
                    $firstProduct = null;
                    if (!$products->isEmpty()){
                     $firstProduct = $products[0];
                    }
            @endphp
            <h3 class="text-center">{{ __('home.Member booth') }}{{$company->member}}</h3>
            {{--            <h3 class="text-left">{{ __('home.Member') }}{{$company->member}}</h3>--}}
            @include('frontend.pages.member.header_member')
            <div class="row m-0">
                <div class="col-md-6 border">
                    <div class="row">
                        <div class="col-md-12 border" style="border-right: 1px solid white!important">
                            <div class="mt-2">
                                <h5 class="mb-3">
                                    {{ ($company->name) }}
                                </h5>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Company code') }}
                                            : </b> {{ ($company->code_business) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Elite enterprise') }}
                                            : </b> {{ ($company->member) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Membership classification') }}
                                            : </b> {{ ($company->member) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <div class="mb-3 size"><b>{{ __('home.Customer rating score') }}: </b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 border">
                    <div class="row">
                        <div class="col-md-12 border" style="border-left: 1px solid white!important">
                            <div class="mt-2">
                                <h5 class="mb-3">{{ __('home.Specified products') }}</h5>
                            </div>
                        </div>
                        @php
                            $listCategory = $company->category_id;
                            $arrayCategory = explode(',', $listCategory);
                        @endphp
                        <div class="col-12">
                            <div class="row">
                                @foreach($arrayCategory as $itemArrayCategory)
                                    @php
                                        $category = \App\Models\Category::find($itemArrayCategory);
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="mt-2 d-flex">
                                            <a href="{{route('category.show', $category->id)}}" class="mb-3 size">
                                                @if(locationHelper() == 'kr')
                                                    {{ ($category->name_ko) }}
                                                @elseif(locationHelper() == 'cn')
                                                    {{ ($category->name_zh) }}
                                                @elseif(locationHelper() == 'jp')
                                                    {{ ($category->name_ja) }}
                                                @elseif(locationHelper() == 'vi')
                                                    {{ ($category->name_vi) }}
                                                @else
                                                    {{ ($category->name_en) }}
                                                @endif
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    @php
                        $memberPerson = \App\Models\MemberRegisterPersonSource::where('email', Auth::user()->email)->first();
                        $newCompany = \App\Models\MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
                        $oldItem = null;
                        if($newCompany){
                             $oldItem = \App\Models\MemberPartner::where([
                               ['company_id_source', $company->id],
                               ['company_id_follow', $newCompany->id],
                               ['status', \App\Enums\MemberPartnerStatus::ACTIVE],
                             ])->first();
                        }
                    @endphp
                    @if(!$oldItem)
                        @if(!$newCompany || $newCompany->member != \App\Enums\RegisterMember::BUYER)
                            <form method="post" action="{{route('stands.register.member')}}" hidden>
                                @csrf
                                <input type="text" name="company_id_source" class="d-none" value="{{$company->id}}">
                                <input type="text" name="price" class="d-none" value="{{$firstProduct->price ?? ''}}">
                                <button class="btn btn-primary" id="btnFollow" type="submit">
                                    Follow
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
    </div>
    <div class="mt-3 container">
        <div class="row">
            @foreach($products as $product)
                <button type="button" class="btn thumbnailProduct col-xl-4 col-md-3" data-toggle="modal"
                        data-target="#exampleModal" data-value="{{$product}}" data-id="{{$product->id}}" data-name="
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
                         ">
                    <div class="standsMember-item section" style="background-color: white">
                        <img data-id="{{$product->id}}"
                             src="{{ asset('storage/' . $product->thumbnail) }}" alt=""
                             class="thumbnailProduct" data-value="{{$product}}"

                             width="150px" height="150px">
                        <div class="item-body">
                            <div class="card-rating text-left">
                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                <i class="fa-solid fa-star" style="color: #fac325;"></i>
                                <span>(1)</span>
                            </div>
                            @php
                                $nameSeller = DB::table('users')->where('id', $product->user_id)->first();
                            @endphp
                            <div class="card-brand text-left">
                                <a href="{{route('shop.information.show', $nameSeller->id)}}">
                                    {{($nameSeller->name)}}
                                </a>
                            </div>
                            <div class="card-title text-left">
                                @if(Auth::check())
                                    <a>
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
                                @else
                                    <a>
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
                                @endif
                            </div>
                            @if($product->price)
                                <div class="card-price text-left">
                                    @php
                                        $prises = $product->old_price;
                                    @endphp
                                    @if($product->price != null)
                                        <div class="price-sale">
                                            <strong> {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}</strong>
                                        </div>
                                        <div class="price-cost">
                                            <strike>{{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strike>
                                        </div>
                                    @else
                                        <div class="price-sale">
                                            <strong>{{ number_format(convertCurrency('USD', $currency,$product->old_price), 0, ',', '.') }} {{$currency}}</strong>
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="card-bottom--left" hidden="">
                                @if(Auth::check())
                                    <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                @else
                                    <a class="check_url">{{ __('home.Choose Options') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </button>
            @endforeach
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-css">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-member">
                    <div id="renderProductMember" class="row">
                        @if(!$products->isEmpty())
                            <div class="col-md-6">
                                @php
                                    $attributes = DB::table('product_attribute')->where([['product_id', $firstProduct->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
                                    $price_sales = \App\Models\ProductSale::where('product_id', '=', $firstProduct->id)->get();
                                @endphp
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <h5>{{ __('home.Product Code') }}</h5>
                                        <p class="productCode" id="productCode">
                                            {{ ($firstProduct->product_code) }}
                                        </p>
                                    </div>
                                    <div class="">
                                        <h5>{{ __('home.Product Name') }}</h5>
                                        <p class="productName" id="productName">
                                            @if(locationHelper() == 'kr')
                                                {{ ($firstProduct->name_ko) }}
                                            @elseif(locationHelper() == 'cn')
                                                {{ ($firstProduct->name_zh) }}
                                            @elseif(locationHelper() == 'jp')
                                                {{ ($firstProduct->name_ja) }}
                                            @elseif(locationHelper() == 'vi')
                                                {{ ($firstProduct->name_vi) }}
                                            @else
                                                {{ ($firstProduct->name_en) }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @php
                                    $productGallery = $firstProduct->gallery;
                                @endphp
                                <div class="mb-3" style="text-align: end">
                                    <div class="main">
                                        <div class="item-card">
                                            <div class="card-image">
                                                <a id="linkProductImg"
                                                   href="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                                   data-fancybox="gallery"
                                                   data-caption="{{$firstProduct->name}}">
                                                    <img data-id="{{$firstProduct->id}}"
                                                         id="imgProductMain"
                                                         src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                                         class="thumbnailProductMain"
                                                         data-value="{{$firstProduct}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        @if($productGallery)
                                            @php
                                                $arrayProductImgThumbnail = explode(',', $productGallery);
                                            @endphp
                                            <div class="" id="productImgThumbnail">
                                                @foreach($arrayProductImgThumbnail as $productImg)
                                                    <div class="item-card d-none">
                                                        <div class="card-image">
                                                            <a href="{{ asset('storage/' . $productImg) }}"
                                                               data-fancybox="gallery"
                                                               data-caption="{{$firstProduct->name}}">
                                                                <img src="{{ asset('storage/' . $productImg) }}"
                                                                     class="thumbnailProductMain" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <h6 class="text-center mt-2">{{ __('home.Xem chi tiết các hình ảnh khác') }}</h6>
                                @if($productGallery)
                                    @php
                                        $arrayProductImg = explode(',', $productGallery);
                                    @endphp
                                    <div class="row thumbnailSupGallery" id="productThumbnail">
                                        @foreach($arrayProductImg as $productImg)
                                            <div class="col-md-3 thumbnailSupGallery-img">
                                                <img src="{{ asset('storage/' . $productImg) }}" alt=""
                                                     class="thumbnailProductGallery thumbnailGallery{{$loop->index+1}}"
                                                     data-id="{{$firstProduct->id}}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class=" mt-2 text-center">
                                    <h5 class="text-center">{{ __('home.Watch product videos') }} </h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>
                                        {{ __('home.Order conditions') }}
                                    </h5>
                                </div>
                                <div id="tablebodyProductSale"></div>
                                <div id="tableMemberOrderCart"></div>
                                <p>{{ __('home.đơn giá phía trên là điều kiện FOB/TT') }}</p>
                                <h5 class="text-center">{{ __('home.Đặt hàng') }}</h5>
                                <div id="tableMemberOrder"></div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endif

    <div class="modal fade" id="exampleModalDemo" role="dialog"
         aria-labelledby="exampleModalDemoLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-4" style="width: auto">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalDemoLabel">{{ __('home.Chọn quốc gia mua hàng') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="https://shipgo.biz/kr">
                            <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                 src="{{ asset('images/korea.png') }}"
                                 alt="">
                        </a>
                        <a href="https://shipgo.biz/jp">
                            <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                 src="{{ asset('images/japan.webp') }}"
                                 alt="">
                        </a>
                        <a href="https://shipgo.biz/cn">
                            <img width="80px" height="80px" style="border: 1px solid; margin: 20px"
                                 src="{{ asset('images/china.webp') }}"
                                 alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = `{{ csrf_token() }}`;
        var urlGetProductSale = `{{asset('get-products-sale')}}`;
        var imageUrlMain = `{{ asset('storage') }}`;
        var detailProductModal = `{{ route('detail_product.data.modal', ['id' => ':id']) }}`;
        var detailProductAttribute = `{{ route('detail_product.member.attribute', ['id' => ':id']) }}`;
        var memberViewCart = `{{route('member.view.carts')}}`;
    </script>
    <script src="{{ asset('js/frontend/pages/member/stand-member.js') }}"></script>
@endsection