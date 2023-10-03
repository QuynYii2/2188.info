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
        <h3 class="text-center">Cửa hàng nhà cung cấp bán buôn *** Chọn một nhà cung cấp sản phẩm</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Gian hàng trưng bày sản phẩm</th>
                <th scope="col">Danh sách đối tác</th>
                <th scope="col">Người giao dịch mới</th>
                <th scope="col">Văn bản nhận</th>
                <th scope="col">Văn bản gửi</th>
                <th scope="col">Mua hàng hộ</th>
                <th scope="col">Mua sỉ nước ngoài</th>
            </tr>
            </thead>
            <tbody>
            @if(!$memberCompanys->isEmpty())
                @foreach($memberCompanys as $memberCompany)
                    @php
                        $memberAccounts = \App\Models\MemberRegisterPersonSource::where('member_id', $memberCompany->id)->get();
                       if (!$memberAccounts->isEmpty()){
                         $products = \App\Models\Product::where(function ($query) use ($memberCompany, $memberAccounts){
                               if (count($memberAccounts) == 2){
                                   $user1 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                                   $user2 = \App\Models\User::where('email', $memberAccounts[1]->email)->first();
                               } else{
                                   $user1 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                                   $user2 = \App\Models\User::where('email', $memberAccounts[0]->email)->first();
                               }

                               $query->where([['user_id', $memberCompany->user_id], ['status', \App\Enums\ProductStatus::ACTIVE]])
                                     ->orWhere([['user_id', $user1->id], ['status', \App\Enums\ProductStatus::ACTIVE]])
                                     ->orWhere([['user_id', $user2->id], ['status', \App\Enums\ProductStatus::ACTIVE]]);
                               })->get();
                       } else{
                           $products = \App\Models\Product::where([['user_id', $memberCompany->user_id], ['status', \App\Enums\ProductStatus::ACTIVE]])->get();
                       }
                    @endphp
                    @if(!$products->isEmpty())
                        <tr>
                            <td colspan="7 row border">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 border">
                                            <div class="row">
                                                <div class="col-md-12 border" style="border-right: 1px solid white">
                                                    <div class="mt-2">
                                                        <h5 class="mb-3">{{ ($memberCompany->name) }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 border">
                                                    <div class="mt-2">
                                                        <h5 class="mb-3">{{ ($memberCompany->code_business) }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 border">
                                                    <div class="mt-2">
                                                        <h5 class="mb-3">{{ __('home.Elite enterprise') }}
                                                            : {{ ($memberCompany->member) }}</h5>
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
                                                            viên: {{ ($memberCompany->member) }}</h5>
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
                                                <div class="col-md-12 border"
                                                     style="border-left: 1px solid white!important">
                                                    <div class="mt-2">
                                                        <h5 class="mb-3">Sản phẩm chỉ định</h5>
                                                    </div>
                                                </div>
                                                @php
                                                    $listCategory = $memberCompany->category_id;
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
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="row">
                                    <div class="col-md-4 border">
                                        <div class="row mt-3" data-id="{{$loop->index+1}}">
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
                                    <div id="renderProductMember{{$loop->index+1}}" class="row col-md-8">
                                        @if(!$products->isEmpty())
                                            <div class="col-md-6 border">
                                                @php
                                                    $firstProduct = $products[0];
                                                    $attributes = DB::table('product_attribute')->where([['product_id', $firstProduct->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
                                                    $price_sales = \App\Models\ProductSale::where('product_id', '=', $firstProduct->id)->get();
                                                @endphp
                                                <div class="d-flex justify-content-between mt-3">
                                                    <div class="">
                                                        <h5>Product Code</h5>
                                                        <p class="productCode{{$loop->index+1}}">
                                                            {{ ($firstProduct->product_code) }}
                                                        </p>
                                                    </div>
                                                    <div class="">
                                                        <h5>Product Name</h5>
                                                        <p class="productName{{$loop->index+1}}">
                                                            {{ ($firstProduct->name) }}
                                                        </p>
                                                    </div>

                                                    <div class="">
                                                        <h5>Product Attributes</h5>
                                                        @foreach($attributes as $attribute)
                                                            @php
                                                                $att = \App\Models\Attribute::where('id', $attribute->attribute_id)
                                                                    ->where('status', \App\Enums\AttributeStatus::ACTIVE)->first();
                                                                $properties_id = $attribute->value;
                                                                $arrayAtt = array();
                                                                $arrayAtt = explode(',', $properties_id);
                                                            @endphp
                                                            <div class="col-sm-6 col-6">
                                                                @if($att)
                                                                    <label>{{ ($att->name) }}</label>
                                                                    <div class="radio-toolbar mt-3">
                                                                        @foreach($arrayAtt as $data)
                                                                            @php
                                                                                $property = \App\Models\Properties::where('id', $data)
                                                                                    ->where('status', \App\Enums\PropertiStatus::ACTIVE)->first();
                                                                            @endphp
                                                                            @if($property)
                                                                                <input class="inputRadioButton"
                                                                                       id="input-{{$attribute->attribute_id}}-{{$loop->index+1}}"
                                                                                       name="inputProperty-{{$attribute->attribute_id}}"
                                                                                       type="radio"
                                                                                       value="{{$attribute->attribute_id}}-{{$property->id}}">
                                                                                <label for="input-{{$attribute->attribute_id}}-{{$loop->index+1}}">
                                                                                    {{ ($property->name) }}
                                                                                </label>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="aframe-container">
                                                    <a-scene embedded>
                                                        <a-sky data-id="{{$firstProduct->id}}"
                                                               id="imgProductMain{{$firstProduct->id}}"
                                                               src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                                               class="thumbnailProduct thumbnailProductMain"
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
                                                    <div class="row thumbnailSupGallery{{$loop->index+1}}">
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
                                                             class="thumbnailProductGallery imgProductMain{{$loop->index+1}}"
                                                             data-id="{{$firstProduct->id}}"
                                                             width="60px" height="60px">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="h5">Mặt sau</div>
                                                        <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                                             alt=""
                                                             class="thumbnailProductGallery imgProductMain{{$loop->index+1}}"
                                                             data-id="{{$firstProduct->id}}"
                                                             width="60px" height="60px">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="h5">Xung quanh</div>
                                                        <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                                             alt=""
                                                             class="thumbnailProductGallery imgProductMain{{$loop->index+1}}"
                                                             data-id="{{$firstProduct->id}}"
                                                             width="60px" height="60px">
                                                    </div>
                                                </div>
                                                <div class=" mt-2 text-center">
                                                    <h5 class="text-center">{{ __('home.Watch product videos') }} </h5>
                                                </div>
                                            </div>
                                            <div class="col-md-6 border">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h5>
                                                        {{ __('home.Order conditions') }}
                                                    </h5>
                                                    <h5>{{ __('home.Product Name') }}: <span
                                                                class="text-warning productName{{$loop->index+1}}">{{ ($firstProduct->name) }}</span>
                                                    </h5>
                                                </div>
                                                <button class="btn btn-primary partnerBtn partnerBtn{{$loop->index+1}}"
                                                        data-value="{{$firstProduct->id}}"
                                                        data-count="100">{{ __('home.Partner') }}
                                                </button>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('home.quantity') }}</th>
                                                        <th scope="col">{{ __('home.Unit price') }}</th>
                                                        <th scope="col">{{ __('home.Ngày dự kiến xuất kho') }}</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @if(!$price_sales->isEmpty())
                                                        @foreach($price_sales as $price_sale)
                                                            <tr>
                                                                <td>{{$price_sale->quantity}}</td>
                                                                <td>-{{$price_sale->sales}} %</td>
                                                                <td>{{$price_sale->days}} {{ __('home.ngày kể từ ngày đặt hàng') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    </tbody>
                                                </table>

                                                <p>{{ __('home.đơn giá phía trên là điều kiện FOB/TT') }}</p>
                                                <h5 class="text-center">{{ __('home.Đặt hàng') }}</h5>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('home.Số sản phẩm') }}</th>
                                                        <th scope="col">{{ __('home.color') }}</th>
                                                        <th scope="col">{{ __('home.quantity') }}</th>
                                                        <th scope="col">{{ __('home.Unit price') }}</th>
                                                        <th scope="col">{{ __('home.Thành tiền') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $cartsMember = \App\Models\Cart::where([
                                                            ['user_id', Auth::user()->id],
                                                            ['member', 1],
                                                            ['product_id', $firstProduct->id]
                                                        ])->get();
                                                    @endphp
                                                    @if(!$cartsMember->isEmpty())
                                                        @foreach($cartsMember as $itemCart)
                                                            <tr>
                                                                <td>{{$itemCart->product->name}}</td>
                                                                <td>Red</td>
                                                                <td>{{$itemCart->quantity}}</td>
                                                                <td>{{$itemCart->price}}</td>
                                                                <td>{{$itemCart->price*$itemCart->quantity}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                                <a href="{{route('parent.register.member.index', $memberCompany->id)}}"
                                                   class="btn btn-success text-white float-right">{{ __('home.Tiếp nhận đặt hàng') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ __('home.Mua sỉ nước ngoài') }}</td>
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="text-center mb-3">
            <h3 class="text-center">{{ __('home.Shipping And Payment') }}</h3>
            <img src="http://2188.info/images/img/payment-method.png">
        </div>
    </div>

    <script>
        var imgUrl = `{{asset('storage/')}}`;
        var token = `{{ csrf_token() }}`;
        var urlCartApi = `{{ route('cart.api', ['id' => ':product']) }}`;
    </script>
    <script src="{{ asset('js/frontend/pages/member/index.js') }}"></script>
@endsection