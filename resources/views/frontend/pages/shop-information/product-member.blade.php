<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<style>
    :root {
        --color-white: #ffffff;
        --color-black: #000000;
        --color-light: #f5f7f8;
        --color-dark: #333333;
        --box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24);
    }

    .main-card {
        padding: 2rem 1rem;
        margin: 0 auto;
        max-width: 68rem;
        width: 100%;
    }

    .main .main-card {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 1rem;
        justify-content: center;
        align-items: center;
    }

    .main .item-card {
        background: var(--color-white);
        box-shadow: var(--box-shadow);
        color: var(--color-dark);
        border-radius: 2px;
    }

    .main .card-image {
        background: var(--color-white);
        display: block;
        padding-top: 70%;
        position: relative;
        width: 100%;
    }

    .main .card-image img {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
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
<div class="container-fluid">
    @if($company)
        @php
            $memberAccounts = \App\Models\MemberRegisterPersonSource::where('member_id', $company->id)->get();
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
            $firstProduct = $products[0];
        @endphp
        <h3 class="text-center">Gian hàng hội viên {{$company->member}}</h3>
        <h3 class="text-left">Hội viên {{$company->member}}</h3>
        <div class="border d-flex justify-content-between align-items-center p-5">
            <a href="{{route('stand.register.member.index', $company->id)}}" class="btn btn-primary">Gian hàng</a>
            <a href="{{route('partner.register.member.index')}}" class="btn btn-warning">Danh sách đối tác</a>
            <a href="#" class="btn btn-primary">Tin nhắn đã nhận</a>
            <a href="#" class="btn btn-warning">Tin nhắn đã gửi</a>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Mua hàng</a>
            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalBuyBulk">Đặt sỉ nước ngoài</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 border">
                        <div class="row">
                            <div class="col-md-12 border">
                                <div class="mt-2">
                                    <h5 class="mb-3">{{ ($company->name) }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 border">
                                <div class="mt-2">
                                    <h5 class="mb-3">{{ ($company->code_business) }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 border">
                                <div class="mt-2">
                                    <h5 class="mb-3">Doanh nghiệp ưu
                                        tú: {{ ($company->member) }}</h5>
                                    <div class="">
                                        <i class="fa-solid fa-trophy"></i>
                                        <i class="fa-solid fa-trophy"></i>
                                        <i class="fa-solid fa-trophy"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 border">
                                <div class="mt-2">
                                    <h5 class="mb-3">Phân loại hội
                                        viên: {{ ($company->member) }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 border">
                                <div class="mt-2">
                                    <h5 class="mb-3">Điểm đánh giá của khách hàng: </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border">
                        <div class="row">
                            <div class="col-md-12 border">
                                <div class="mt-2">
                                    <h5 class="mb-3">Sản phẩm chỉ định</h5>
                                </div>
                            </div>
                            @php
                                $listCategory = $company->category_id;
                                $arrayCategory = explode(',', $listCategory);
                            @endphp
                            @foreach($arrayCategory as $itemArrayCategory)
                                @php
                                    $category = \App\Models\Category::find($itemArrayCategory);
                                @endphp
                                <div class="col-md-6 border">
                                    <div class="mt-2">
                                        <h5 class="mb-3">{{ ($category->name) }}</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    @php
                        $newCompany = \App\Models\MemberRegisterInfo::where('user_id', Auth::user()->id)->first();
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
                            <form method="post" action="{{route('stands.register.member')}}">
                                @csrf
                                <input type="text" name="company_id_source" class="d-none" value="{{$company->id}}">
                                <input type="text" name="price" class="d-none" value="{{$firstProduct->price}}">
                                <button class="btn btn-primary" id="btnFollow" type="submit">
                                    Follow
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 border">
                <div class="row mt-3">
                    @foreach($products as $product)
                        <div class="col-md-3 mb-2 text-center">
                            <img data-id="{{$product->id}}"
                                 src="{{ asset('storage/' . $product->thumbnail) }}" alt=""
                                 class="thumbnailProduct" data-value="{{$product}}"
                                 width="60px" height="60px">
                            <p class="mt-2">
                                <a href="{{route('detail_product.show', $product->id)}}"
                                   class="text-decoration-none">
                                    {{ ($product->name) }}
                                </a>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="renderProductMember" class="row col-md-8">
                @if(!$products->isEmpty())
                    <div class="col-md-6 border">
                        @php
                            $attributes = DB::table('product_attribute')->where([['product_id', $firstProduct->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
                            $price_sales = \App\Models\ProductSale::where('product_id', '=', $firstProduct->id)->get();
                        @endphp
                        <div class="d-flex justify-content-between mt-3">
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
                        <div class="mb-3">
                            <div class="main">
                                <div class="main-card">
                                    <div class="item-card">
                                        <div class="card-image">
                                            <a id="linkProductImg" href="{{ asset('storage/' . $firstProduct->thumbnail) }}"
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
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-warning mt-2 float-right">Select</button>
                        </div>

                        <h6 class="text-center mt-2">Xem chi tiết các hình ảnh khác</h6>
                        @if($productGallery)
                            @php
                                $arrayProductImg = explode(',', $productGallery);
                            @endphp
                            <div class="row thumbnailSupGallery">
                                @foreach($arrayProductImg as $productImg)
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $productImg) }}" alt=""
                                             class="thumbnailProductGallery thumbnailGallery{{$loop->index+1}}"
                                             data-id="{{$firstProduct->id}}"
                                             width="60px" height="60px">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class=" mt-2 text-center">
                            <h5 class="text-center">Xem video sản phẩm </h5>
                        </div>
                    </div>
                    <div class="col-md-6 border">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>
                                Điều kiện đặt hàng
                            </h5>
                            <h5>Sản phẩm: <span
                                        class="text-warning productName">{{ ($firstProduct->name) }}</span>
                            </h5>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Ngày dự kiến xuất kho</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(!$price_sales->isEmpty())
                                @foreach($price_sales as $price_sale)
                                    <tr>
                                        <td>{{$price_sale->quantity}}</td>
                                        <td>-{{$price_sale->sales}} %</td>
                                        <td>3 ngày kể từ ngày đặt hàng</td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>

                        <p>đơn giá phía trên là điều kiện FOB/TT</p>
                        <h5 class="text-center">Đặt hàng</h5>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Số sản phẩm</th>
                                <th scope="col">Màu sắc</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $carts = DB::table('carts')
                                 ->join('products', 'products.id', '=', 'carts.product_id')
                                 ->where([['products.user_id', $company->user_id], ['carts.member', 1],['carts.status', \App\Enums\CartStatus::WAIT_ORDER]])
                                 ->select('carts.*')
                                 ->get();
                            @endphp
                            @if(!$carts->isEmpty())
                                @foreach($carts as $itemCart)
                                    <tr>
                                        <td>
                                            @php
                                                $cartProduct = \App\Models\Product::find($itemCart->product_id);
                                            @endphp
                                            {{$cartProduct->name}}
                                        </td>
                                        <td>Red</td>
                                        <td>{{$itemCart->quantity}}</td>
                                        <td>{{$itemCart->price}}</td>
                                        <td>{{$itemCart->price*$itemCart->quantity}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                        @if(!$newCompany || $newCompany->member != \App\Enums\RegisterMember::BUYER)
                            <button class="btn btn-success partnerBtn float-right" id="partnerBtn"
                                    data-value="{{$firstProduct->id}}" data-count="100">Tiếp nhận đặt hàng
                            </button>
                        @endif

                        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModal"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chọn quốc gia mua hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="https://shipgo.biz/kr">
                                                <img width="80px" height="80px" src="{{ asset('images/korea.png') }}"
                                                     alt="">
                                            </a>
                                            <a href="https://shipgo.biz/jp">
                                                <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}"
                                                     alt="">
                                            </a>
                                            <a href="https://shipgo.biz/cn">
                                                <img width="80px" height="80px" src="{{ asset('images/china.webp') }}"
                                                     alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModalBuyBulk" role="dialog" aria-labelledby="exampleModalBuyBulk"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chọn quốc gia mua hàng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{route('parent.register.member.locale', 'kr')}}">
                                                <img width="80px" height="80px" src="{{ asset('images/korea.png') }}"
                                                     alt="">
                                            </a>
                                            <a href="{{route('parent.register.member.locale', 'jp')}}">
                                                <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}"
                                                     alt="">
                                            </a>
                                            <a href="{{route('parent.register.member.locale', 'cn')}}">
                                                <img width="80px" height="80px" src="{{ asset('images/china.webp') }}"
                                                     alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var renderInputAttribute = $('#renderProductMember');

    $('.thumbnailProduct').on('click', function () {
        let product = $(this).data('value');
        let imageUrl = '{{ asset('storage/') }}';
        let imgMain = product['thumbnail'];
        imageUrl = imageUrl + '/' + imgMain;
        let idImg = '#imgProductMain';
        let linkImg = '#linkProductImg';
        changeImage(idImg, imageUrl);
        changeUrl(linkImg, imageUrl);

        let productNames = document.getElementsByClassName('productName');
        for (let i = 0; i < productNames.length; i++) {
            productNames[i].innerHTML = product['name']
        }

        let gallery = product['gallery']
        let arrayGallery = gallery.split(',');

        // $('#partnerBtn').data('value', product['id']);
        let partnerBtn = document.getElementById('partnerBtn');
        partnerBtn.setAttribute('data-value', product['id']);
    });

    $('.thumbnailProductGallery').on('click', function () {
        let imageUrl = $(this).attr('src');
        let idImg = '#imgProductMain'
        let linkImg = '#linkProductImg';
        changeImage(idImg, imageUrl);
        changeUrl(linkImg, imageUrl);
    });

    function changeImage(id, imageSrc) {
        const sky = document.querySelector(id);
        sky.setAttribute('src', imageSrc);
    }

    function changeUrl(id, url) {
        const link = document.querySelector(id);
        link.href = url;
    }

    $(document).ready(function () {
        const $document = $(document);

        $document.on('click', '#partnerBtn', function () {
            const product = $(this).data('value');
            renderProduct(product);
        });

        function renderProduct(product) {
            const requestData = {
                _token: '{{ csrf_token() }}',
                quantity: 100,
            };

            $.ajax({
                url: `/add-to-cart-register-member/${product}`,
                method: 'POST',
                data: requestData,
            })
                .done(function (response) {
                    console.log(response);
                    alert('Success!');
                    window.location.reload();
                })
                .fail(function (_, textStatus) {
                    console.error('Request failed:', textStatus);
                });
        }
    });
</script>
