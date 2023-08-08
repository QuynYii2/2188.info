@extends('frontend.layouts.master')
@section('title', 'Product Register Members')
@section('content')

@php

@endphp
    <div class="container-fluid">
        <h3 class="text-center">Cửa hàng nhà cung cấp bán buôn *** Chọn một nhà cung cấp sản phẩm</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Triển lãm trưng bày sản phẩm</th>
                <th scope="col">Người giao dịch chỉ định</th>
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
                    <tr>
                        <td colspan="7" class="text-center">
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-between align-items-center">
                                    <div class="mt-2">
                                        <h5 class="mb-3">{{ ($memberCompany->code_business) }}</h5>
                                        <div class=""> Doanh nghiệp ưu tú
                                            <i class="fa-solid fa-trophy"></i>
                                            <i class="fa-solid fa-trophy"></i>
                                            <i class="fa-solid fa-trophy"></i>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <h5 class="mb-3">{{ ($memberCompany->name) }}</h5>
                                        <div class="text-nowrap">Điểm trung bình đánh giá khách hàng
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-regular fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div class="row">
                                <div class="col-md-4 border">
                                    <div class="row mt-3" data-id="{{$loop->index+1}}">
                                        @if(!$products->isEmpty())
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
                                        @endif
                                    </div>
                                </div>
                                <div id="renderProductMember{{$loop->index+1}}" class="row col-md-8">
                                    @if(!$products->isEmpty())
                                        <div class="col-md-6 border">
                                            @php
                                                $firstProduct = $products[0];
                                                $attributes = DB::table('product_attribute')->where([['product_id', $firstProduct->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
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
                                            <img id="imgProductMain{{$firstProduct->id}}"
                                                 src="{{ asset('storage/' . $firstProduct->thumbnail) }}"
                                                 alt="" class="imgProductMain{{$loop->index+1}}"
                                                 width="80%" height="60%">
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
                                                    <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt=""
                                                         class="thumbnailProductGallery imgProductMain{{$loop->index+1}}"
                                                         data-id="{{$firstProduct->id}}"
                                                         width="60px" height="60px">
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="h5">Mặt sau</div>
                                                    <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt=""
                                                         class="thumbnailProductGallery imgProductMain{{$loop->index+1}}"
                                                         data-id="{{$firstProduct->id}}"
                                                         width="60px" height="60px">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="h5">Xung quanh</div>
                                                    <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt=""
                                                         class="thumbnailProductGallery imgProductMain{{$loop->index+1}}"
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
                                                            class="text-warning productName{{$loop->index+1}}">{{ ($firstProduct->name) }}</span>
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
                                                <tr>
                                                    <td>100</td>
                                                    <td>300</td>
                                                    <td>3 ngày kể từ ngày đặt hàng</td>
                                                </tr>
                                                <tr>
                                                    <td>300</td>
                                                    <td>600</td>
                                                    <td>6 ngày kể từ ngày đặt hàng</td>
                                                </tr>
                                                <tr>
                                                    <td>600</td>
                                                    <td>3000</td>
                                                    <td>9 ngày kể từ ngày đặt hàng</td>
                                                </tr>
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
                                                <tr>
                                                    <td>Product 1</td>
                                                    <td>Red</td>
                                                    <td>100</td>
                                                    <td>20</td>
                                                    <td>89234</td>
                                                </tr>
                                                <tr>
                                                    <td>Product 2</td>
                                                    <td>Blue</td>
                                                    <td>100</td>
                                                    <td>20</td>
                                                    <td>89234</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <button class="btn btn-success text-white float-right">Tiếp nhận đặt hàng
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>Mua sỉ nước ngoài</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <div class="text-center mb-3">
            <h3 class="text-center">Shipping And Payment</h3>
            <img src="http://2188.info/images/img/payment-method.png">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $('.thumbnailProduct').on('click', function () {--}}
    {{--                let id = $(this).data('id');--}}
    {{--                renderProduct(id);--}}
    {{--                function renderProduct(id) {--}}
    {{--                    var request = $.ajax({--}}
    {{--                        url: '{{ route('products.register.member.create') }}',--}}
    {{--                        method: "POST",--}}
    {{--                        data: {--}}
    {{--                            _token: '{{ csrf_token() }}',--}}
    {{--                            'idProduct': id,--}}
    {{--                        },--}}
    {{--                        dataType: "html"--}}
    {{--                    });--}}

    {{--                    request.done(function (response) {--}}
    {{--                        console.log(response);--}}
    {{--                        $('#renderProductMember').empty().append(response);--}}
    {{--                    });--}}

    {{--                    request.fail(function (jqXHR, textStatus) {--}}
    {{--                        console.error("Request failed:", textStatus);--}}
    {{--                        $('#renderProductMember').empty().append('<h3>Error</h3>');--}}
    {{--                    });--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
    <script>
        var renderInputAttribute = $('#renderProductMember');

        {{--function renderProduct(id) {--}}
        {{--    const data = {--}}
        {{--        _token: '{{ csrf_token() }}',--}}
        {{--        idProduct: id,--}}
        {{--    };--}}
        {{--    fetch('{{ route('products.register.member.create') }}', {--}}
        {{--        method: 'POST',--}}
        {{--        headers: {--}}
        {{--            'content-type': 'application/json'--}}
        {{--        },--}}
        {{--        body: JSON.stringify(data),--}}
        {{--    }).then(response => {--}}
        {{--        if (response.status == 200) {--}}
        {{--            console.log(response)--}}
        {{--            $('#renderProductMember').remove();--}}
        {{--            renderInputAttribute.append(response);--}}
        {{--        }--}}
        {{--    }).catch(error => console.log(error));--}}
        {{--}--}}

        {{--$('.thumbnailProduct').on('click', function () {--}}
        {{--    let id = $(this).data('id');--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('products.register.member.create') }}',--}}
        {{--        type: 'POST',--}}
        {{--        data: {--}}
        {{--            _token: '{{ csrf_token() }}',--}}
        {{--            'idProduct': id,--}}
        {{--        },--}}
        {{--        success: function (response) {--}}
        {{--            console.log(response)--}}
        {{--            $('#renderProductMember').remove();--}}
        {{--            renderInputAttribute.append(response);--}}
        {{--        },--}}
        {{--        error: function (xhr, status, error) {--}}
        {{--            renderInputAttribute.append('<h3>Error</h3>');--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

        $('.thumbnailProduct').on('click', function () {
            let product = $(this).data('value');
            let number = $(this).parent().parent().data('id');
            let productNames = document.getElementsByClassName('productName' + number);
            let productCodes = document.getElementsByClassName('productCode' + number);
            let imgProductMains = document.getElementsByClassName('imgProductMain' + number);
            for (let i = 0; i < productNames.length; i++) {
                productNames[i].innerText = product['name'];
            }
            for (let i = 0; i < productCodes.length; i++) {
                productCodes[i].innerText = product['product_code'];
            }
            for (let i = 0; i < imgProductMains.length; i++) {
                imgProductMains[i].src = '{{asset('storage/')}}' + '/' + product['thumbnail'];
            }

            let gallery = product['gallery']
            let arrayGallery = gallery.split(',');

            let divthumbnailSupGallerys = document.getElementsByClassName('thumbnailSupGallery' + number)[0].childElementCount;
            for (let i = 1; i <= divthumbnailSupGallerys; i++) {
                let thumbnailGallerys = document.getElementsByClassName('thumbnailGallery' + i)[0];
                if (i < arrayGallery.length) {
                    thumbnailGallerys.src = '{{asset('storage/')}}' + '/' + arrayGallery[i];
                } else {
                    thumbnailGallerys.src = '{{asset('storage/')}}' + '/' + arrayGallery[0];
                }
            }

        });

        $('.thumbnailProductGallery').on('click', function () {
            let imageUrl = $(this).attr('src');
            let productID = $(this).data('id');
            let idImg = '#imgProductMain' + productID
            $(`${idImg}`).attr("src", imageUrl);
        });

    </script>
@endsection