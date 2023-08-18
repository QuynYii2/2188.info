@extends('frontend.layouts.master')
@section('title', 'Product Register Members')
@section('content')
    <style>
        .aframe-container {
            width: 450px;
            height: 300px;
        }
    </style>
    <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
    <div class="container-fluid">
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
                        $oldItem = \App\Models\MemberPartner::where([
                           ['company_id_source', $company->id],
                           ['company_id_follow', $company->id],
                           ['status', \App\Enums\MemberPartnerStatus::ACTIVE],
                       ])->first();
                    @endphp
                    @if(!$oldItem)
                        <form method="post" action="{{route('stands.register.member')}}">
                            @csrf
                            <input type="text" name="company_id_source" class="d-none" value="{{$company->id}}">
                            <input type="text" name="price" class="d-none" value="{{$firstProduct->price}}">
                            <button class="btn btn-primary" id="btnFollow" type="submit">
                                Follow
                            </button>
                        </form>
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

                            <div class="">
                                <h5>Product Attributes</h5>
                                @foreach($attributes as $attribute)
                                    @php
                                        $att = \App\Models\Attribute::find($attribute->attribute_id);
                                        $properties_id = $attribute->value;
                                        $arrayAtt = array();
                                        $arrayAtt = explode(',', $properties_id);
                                    @endphp
                                    <div class="col-sm-6 col-6">
                                        <label>{{ ($att->name) }}</label>
                                        <div class="radio-toolbar mt-3">
                                            @foreach($arrayAtt as $data)
                                                @php
                                                    $property = \App\Models\Properties::find($data);
                                                @endphp
                                                <input class="inputRadioButton"
                                                       id="input-{{$attribute->attribute_id}}-{{$loop->index+1}}"
                                                       name="inputProperty-{{$attribute->attribute_id}}"
                                                       type="radio"
                                                       value="{{$attribute->attribute_id}}-{{$property->id}}">
                                                <label for="input-{{$attribute->attribute_id}}-{{$loop->index+1}}">{{ ($property->name) }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="aframe-container">
                            <a-scene embedded>
                                <a-sky data-id="{{$firstProduct->id}}"
                                       id="imgProductMain"
                                       src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                       class="thumbnailProductMain"
                                       data-value="{{$firstProduct}}"
                                       width="60px" height="60px"></a-sky>
                                <a-entity id="cameraRig{{$firstProduct->id}}"
                                          position="0 1.6 0">
                                    <a-camera wasd-controls="enabled: false"></a-camera>
                                </a-entity>
                                <a-entity id="controls{{$firstProduct->id}}" look-controls>
                                    <a-entity id="cursor{{$firstProduct->id}}"
                                              cursor="fuse: true; fuseTimeout: 500"
                                              position="0 0 -1"
                                              geometry="primitive: ring; radiusInner: 0.02; radiusOuter: 0.03"
                                              material="color: #333; shader: flat">
                                    </a-entity>
                                </a-entity>
                            </a-scene>
                        </div>

                        <h6 class="text-center mt-2">Xem chi tiết các hình ảnh khác</h6>
                        @php
                            $productGallery = $firstProduct->gallery;
                        @endphp
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

                        <div class="row mt-2 text-center">
                            <div class="col-md-3">
                                <div class="h5 text-nowrap">Mặt trước</div>
                                <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                     alt=""
                                     class="thumbnailProductGallery imgProductMain"
                                     data-id="{{$firstProduct->id}}"
                                     width="60px" height="60px">
                            </div>
                            <div class="col-md-3">
                                <div class="h5">Mặt sau</div>
                                <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                     alt=""
                                     class="thumbnailProductGallery imgProductMain"
                                     data-id="{{$firstProduct->id}}"
                                     width="60px" height="60px">
                            </div>
                            <div class="col-md-6">
                                <div class="h5">Xung quanh</div>
                                <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                     alt=""
                                     class="thumbnailProductGallery imgProductMain"
                                     data-id="{{$firstProduct->id}}"
                                     width="60px" height="60px">
                            </div>
                        </div>
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
                        <button class="btn btn-success partnerBtn float-right" id="partnerBtn"
                                data-value="{{$firstProduct->id}}" data-count="100">Tiếp nhận đặt hàng
                        </button>

                        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
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
                                                <img width="80px" height="80px" src="{{ asset('images/korea.png') }}" alt="">
                                            </a>
                                            <a href="https://shipgo.biz/jp">
                                                <img width="80px" height="80px" src="{{ asset('images/japan.webp') }}" alt="">
                                            </a>
                                            <a href="https://shipgo.biz/cn">
                                                <img width="80px" height="80px" src="{{ asset('images/china.webp') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="exampleModalBuyBulk" role="dialog" aria-labelledby="exampleModalBuyBulk" aria-hidden="true">
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
            changeImage(idImg, imageUrl);

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
            changeImage(idImg, imageUrl);
        });

        function changeImage(id, imageSrc) {
            const sky = document.querySelector(id);
            sky.setAttribute('src', imageSrc);
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
@endsection