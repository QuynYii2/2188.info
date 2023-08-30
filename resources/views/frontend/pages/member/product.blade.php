@php
    $firstProduct = session()->get('firstProduct');
    if ($firstProduct){
     $firstProduct = $firstProduct[0];
    } else {
        $firstProduct = null;
    }
@endphp
@php

@endphp
@if($firstProduct)
    @php
        $price_sales = \App\Models\ProductSale::where('product_id', '=', $firstProduct->id)->get();
    @endphp
    <div class="col-md-6 border">
        @php
            $attributes = DB::table('product_attribute')->where([['product_id', $firstProduct->id], ['status', \App\Enums\AttributeProductStatus::ACTIVE]])->get();
        @endphp
        <div class="d-flex justify-content-between mt-3">
            <div class="">
                <h5>Product Code</h5>
                <p>
                    {{ ($firstProduct->product_code) }}
                </p>
            </div>
            <div class="">
                <h5>Product Name</h5>
                <p>
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
                        <label>{{$att->name}}</label>
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
                                <label for="input-{{$attribute->attribute_id}}-{{$loop->index+1}}">{{ $tran->translateText($property->name) }}</label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <img id="imgProductMain" src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt="" class=""
             width="80%" height="60%">
        <h6 class="text-center mt-2">Xem chi tiết các hình ảnh khác</h6>
        @php
            $productGallery = $firstProduct->gallery;
        @endphp
        @if($productGallery)
            @php
                $arrayProductImg = explode(',', $productGallery);
            @endphp
            <div class="row">
                @foreach($arrayProductImg as $productImg)
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $productImg) }}" alt="" class="thumbnailProductGallery"
                             width="60px" height="60px">
                    </div>
                @endforeach
            </div>
        @endif
        <div class="row mt-2 text-center">
            <div class="col-md-3">
                <div class="h5 ">Mặt trước</div>
                <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt="" class="thumbnailProductGallery"
                     width="60px" height="60px">
            </div>
            <div class="col-md-3">
                <div class="h5">Mặt sau</div>
                <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt="" class="thumbnailProductGallery"
                     width="60px" height="60px">
            </div>
            <div class="col-md-6">
                <div class="h5">Xung quanh</div>
                <img src="{{ asset('storage/' . $firstProduct->thumbnail) }}" alt="" class="thumbnailProductGallery"
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
            <h5>Sản phẩm: <span class="text-warning">{{ $tran->translateText($firstProduct->name) }}</span></h5>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Số lượng</th>
                <th scope="col">Giảm giá</th>
                <th scope="col">Ngày dự kiến xuất kho</th>
            </tr>
            </thead>
            <tbody>
            @if(!$price_sales->isEmpty())
                @foreach($price_sales as $price_sale)
                    <tr>
                        <td>{{$price_sale->quantity}}</td>
                        <td>{{($prises - ($prises * $discount / 100)) * $quantity}}</td>
                        <td>{{$price_sale->days}} {{ __('home.ngày kể từ ngày đặt hàng') }}</td>
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
    </div>
@endif