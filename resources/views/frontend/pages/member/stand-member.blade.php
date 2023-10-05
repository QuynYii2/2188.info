@php
    $route = Route::currentRouteName();
    $isDetail = null;
    if ($route == 'detail_product.member.attribute'){
        $isDetail = true;
    }
    session()->forget('isDetail');
    session()->push('isDetail', $isDetail);
@endphp
@extends('frontend.layouts.master')
@section('title', 'Product Register Members')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <div class="container stand-member">
        @if($company)
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
                                    @if($category)
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
                                    @endif
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
        <div id="data-wrapper">
            @include('products-member')
        </div>
    </div>
    <!-- Data Loader -->
    <div class="auto-load text-center">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path fill="#000"
                  d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                  from="0 50 50" to="360 50 50" repeatCount="indefinite"/>
            </path>
        </svg>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-member" role="document">
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
        var ENDPOINT = "{{ route('stand.register.member.index', ['id' => ':id']) }}";
        ENDPOINT = ENDPOINT.replace(':id', `{{$company->id}}`);
        var page = 1;
        let isLoading = false;

        /*------------------------------------------
        --------------------------------------------
        Call on Scroll
        --------------------------------------------
        --------------------------------------------*/
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                setTimeout(() => {
                    page++;
                    infinteLoadMore(page);
                }, 1500);
            }
        });

        /*------------------------------------------
        --------------------------------------------
        call infinteLoadMore()
        --------------------------------------------
        --------------------------------------------*/
        async function infinteLoadMore(page) {
            await $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').removeClass('d-none');
                }
            })
                .done(function (response) {
                    if (response.html == '') {
                        $('.auto-load').html("We don't have more data to display :(");
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
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