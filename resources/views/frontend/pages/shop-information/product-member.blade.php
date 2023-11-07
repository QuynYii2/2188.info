@php
    use App\Enums\MemberPartnerStatus;use App\Enums\ProductStatus;use App\Enums\RegisterMember;use App\Models\EvaluateProduct;use App\Models\MemberPartner;use App\Models\MemberRegisterInfo;use App\Models\MemberRegisterPersonSource;use App\Models\Product;use App\Models\User;use Illuminate\Support\Facades\Auth;$route = Route::currentRouteName();
    $isDetail = null;
    if ($route == 'detail_product.show'){
        $isDetail = true;
    }

    session()->forget('isDetail');
    session()->push('isDetail', $isDetail);
@endphp
<script>
    $('[data-fancybox="gallery"]').fancybox({
        buttons: [
            "slideShow",
            "thumbs",
            "zoom",
            "fullScreen",
            "share",
            "close"
        ],
        loop: false,
        protect: true
    });
</script>

<style>

    .hidden-title-product {
        overflow: hidden;
        text-overflow: ellipsis;;
    }
</style>

<div class="product-member">
    @if($company)
        @php
            $memberAccounts = MemberRegisterPersonSource::where('member_id', $company->id)->get();
            $companyPerson = MemberRegisterPersonSource::where('member_id', $company->id)->first();
            $oldUser = User::where('email', $companyPerson->email)->first();

            // Initialize user1 and user2 with null values
            $user1 = null;
            $user2 = null;

            if (!$memberAccounts->isEmpty()) {
                if (count($memberAccounts) == 2) {
                    $user1 = User::where('email', $memberAccounts[0]->email)->first();
                    $user2 = User::where('email', $memberAccounts[1]->email)->first();
                } else {
                    $user1 = User::where('email', $memberAccounts[0]->email)->first();
                    $user2 = $user1; // Assign user2 to user1 if only one account
                }
            }

            $products = Product::where(function ($query) use ($company, $user1, $user2) {
                $query->where([['user_id', $company->user_id], ['status', ProductStatus::ACTIVE]]);

                if ($user1) {
                    $query->orWhere([['user_id', $user1->id], ['status', ProductStatus::ACTIVE]]);
                }

                if ($user2) {
                    $query->orWhere([['user_id', $user2->id], ['status', ProductStatus::ACTIVE]]);
                }
            })->get();

            $firstProduct = $products->first();
        @endphp

        {{--        <h3 class="text-center">{{ __('home.Member booth') }}{{$company->member}}</h3>--}}
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
                                            <div class="mb-3 size">
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
                                            </div>
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
                    $user = Auth::user();
                    $memberPerson = MemberRegisterPersonSource::where('email', $user->email)->first();
                    $newCompany = MemberRegisterInfo::where('id', $memberPerson->member_id)->first();
                     $exitsPartner  = MemberPartner::where([
                            ['company_id_source', $company->id],
                            ['company_id_follow', $newCompany->id],
                            ['status', MemberPartnerStatus::ACTIVE],
                        ])->first();
                @endphp
                @if($id != $user->id)
                    @if($newCompany && $newCompany->member != RegisterMember::BUYER && empty($exitsPartner))
                        <form method="post" action="{{route('stands.register.member')}}">
                            @csrf
                            <input type="text" name="company_id_source" value="{{$company->id}} " hidden>
                            <input type="text" name="price" value="{{$firstProduct->price ?? ''}}" hidden>
                        </form>
                    @else
                        <form method="post" action="{{ route('stands.unregister.member', $company->id) }}" }>
                            @csrf
                            <input type="text" name="company_id_source"
                                   value="{{ $company->id }}" hidden>
                            <button class="btn btn-danger" id="btnUnfollow" type="submit" hidden="">
                                Unfollow
                            </button>
                        </form>
                    @endif
                @endif

            </div>

        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-xl-2 col-md-3 col-6 mt-4">
                    <button type="button" style="background-color: white" class="btn thumbnailProduct col-12 p-0"
                            data-toggle="modal"
                            data-target="#exampleModal" data-value="{{$product}}" data-id="{{$product->id}}">
                        <div class="standsMember-item section">
                            @php
                                $thumbnail = checkThumbnail($product->thumbnail);
                            @endphp
                            <img data-id="{{$product->id}}"
                                 src="{{ $thumbnail }}" alt=""
                                 class="thumbnailProduct" data-value="{{$product}}"
                                 width="150px" height="150px">
                            <div class="item-body">
                                <div class="card-rating text-left">
                                    @php
                                        $ratings = EvaluateProduct::where('product_id', $product->id)->get();
                                        $totalRatings = $ratings->count();
                                        $totalStars = 0;
                                        foreach ($ratings as $rating) {
                                            $totalStars += $rating->star_number;
                                        }
                                        $averageRating = $totalRatings > 0 ? $totalStars / $totalRatings : 0;
                                        $averageRatingsFormatted = number_format($averageRating, 2);
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa-solid fa-star"
                                           style="color: {{ $i <= $averageRating ? '#fac325' : '#ccc' }}"></i>
                                    @endfor

                                    <span>{{ $averageRatingsFormatted }} ({{ $totalRatings }})</span>
                                </div>


                                @php
                                    $nameSeller = DB::table('users')->where('id', $product->user_id)->first();
                                @endphp
                                <div class="card-brand text-left">
                                    <a href="{{route('shop.information.show', $nameSeller->id)}}">
                                        {{($nameSeller->name)}}
                                    </a>
                                </div>
                                <div class="card-title text-left hidden-title-product">
                                    @if(Auth::check())
                                        <div>
                                            @if(locationHelper() == 'kr')
                                                {{ $product->name_ko }}
                                            @elseif(locationHelper() == 'cn')
                                                {{$product->name_zh}}
                                            @elseif(locationHelper() == 'jp')
                                                {{$product->name_ja}}
                                            @elseif(locationHelper() == 'vi')
                                                {{$product->name_vi}}
                                            @else
                                                {{$product->name_en}}</div>
                                    @endif
                                    @else
                                        <a class="check_url">
                                            @if(locationHelper() == 'kr')
                                                {{ $product->name_ko }}
                                            @elseif(locationHelper() == 'cn')
                                                {{$product->name_zh}}
                                            @elseif(locationHelper() == 'jp')
                                                {{$product->name_ja}}
                                            @elseif(locationHelper() == 'vi')
                                                {{$product->name_vi}}
                                            @else
                                                {{$product->name_en}}
                                            @endif
                                        </a>
                                    @endif
                                </div>
                                @if($product->price)
                                    <div class="card-price text-left">
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
                                <div class="card-bottom--left">
                                    @if(Auth::check())
                                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                                    @else
                                        <a class="check_url">{{ __('home.Choose Options') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </button>
                </div>
            @endforeach
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
                    <div class="modal-body">
                        <div id="renderProductMember" class="row">
                            @if(!$products->isEmpty())
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <h5>Product Code</h5>
                                            <p class="productCode" id="productCode">
                                                {{ ($firstProduct->product_code) }}
                                            </p>
                                        </div>
                                        <div class="">
                                            <h5>Product Name</h5>
                                            <p class="productName" id="productName">
                                                {{ ($firstProduct->name) }}
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
                                                    @php
                                                        $thumbnail = checkThumbnail($firstProduct->thumbnail);
                                                    @endphp
                                                    <a id="linkProductImg"
                                                       href="{{ $thumbnail }}"
                                                       data-fancybox="gallery"
                                                       data-caption="{{$firstProduct->name}}">
                                                        <img data-id="{{$firstProduct->id}}"
                                                             id="imgProductMain"
                                                             src="{{ $thumbnail }}"
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
                                                            @php
                                                                $productImg = checkThumbnail($productImg);
                                                            @endphp
                                                            <div class="card-image">
                                                                <a href="{{ $productImg }}"
                                                                   data-fancybox="gallery"
                                                                   data-caption="{{$firstProduct->name}}">
                                                                    <img src="{{ $productImg }}"
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
                                                @php
                                                    $productImg = checkThumbnail($productImg);
                                                @endphp
                                                <div class="col-md-2 thumbnailSupGallery-img">
                                                    <img src="{{ $productImg }}" alt=""
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
                                    <div id="tablebodyProductSale">
                                    </div>
                                    <p>{{ __('home.đơn giá phía trên là điều kiện FOB/TT') }}</p>
                                    <div id="tableMemberOrderCart">
                                    </div>
                                    <h5 class="text-center">{{ __('home.Đặt hàng') }}</h5>
                                    <div id="tableMemberOrder">
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endif

<div class="modal fade" id="modal-show-att" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-select-att">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body-modal-att"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectAttProduct()">
                    {{ __('home.Save') }}
                </button>
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
<script src="{{ asset('js/frontend/pages/shop-infomation/product-member.js') }}"></script>
