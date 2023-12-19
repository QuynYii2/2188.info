<div class="card d-flex flex-row border-0 mb-30">
    <div class="col-md-5">
        @foreach($orderItems as $orderItem)
            @php
                $product = \App\Models\Product::find($orderItem->product_id);
            @endphp
            @if($product)
                <div class="name-product-order">
                    <div class="product-gallery">
                        <div class="product-image-order">
                            @php
                                $thumbnail = checkThumbnail($product->thumbnail);
                            @endphp
                            <img alt="" id="productThumbnail" class="main-image-product active h-100" src="{{ $thumbnail }}">
                            <input type="text" id="urlImage" value="{{ $thumbnail }}" hidden="">
                        </div>

                        <ul class="image-list">
                            @php
                                $gallery = $product->gallery;
                                $arrayGallery = explode(',', $gallery);
                            @endphp
                            @php
                                $thumbnail = checkThumbnail($product->thumbnail);
                            @endphp
                            <li class="image-item"><img alt="" src="{{ $thumbnail }}" data-url="{{ $thumbnail }}"></li>
                            @if(count($arrayGallery) > 1)
                                @foreach($arrayGallery as $gallery)
                                    @php
                                        $gallery = checkThumbnail($gallery);
                                    @endphp
                                    <li class="image-item"><img alt="" src="{{ $gallery }}" data-url="{{ $gallery }}"></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-md-7 order-detail__info">
        @foreach($orderItems as $orderItem)
            @php
                $product = \App\Models\Product::find($orderItem->product_id);
            @endphp
            @if($product)
                <div class="name-product-order">{{$product->name}}</div>
            @endif
            <div class="d-flex justify-content-between">
                <div class="price-order-managers d-flex">
                    <span>$</span>{{$orderItem->price}} &nbsp;<p> ${{$product->old_price}}</p>
                </div>
                <div class="quantity-order-managers">
                    <span>{{__('home.Quantity')}}:</span>
                    <p> x{{$orderItem->quantity}}</p>
                </div>
            </div>
        @endforeach
        <div class="form-group order-detail-product">
            <span>{{__('home.Order details')}}</span>
        </div>
        <div class="form-group">
            <span>{{__('home.full name')}}: </span>{{$order->fullname}}
        </div>
        <div class="form-group">
            <span>{{__('home.Address')}}: </span>{{$order->address}}
        </div>
        <div class="form-group">
            <span>{{__('home.Order Method')}}: </span>{{$order->orders_method}}
        </div>
        <div class="form-group">
            <span>{{__('home.Status')}}: </span>{{$order->status}}
        </div>
        <div class="form-group">
            <span>{{__('home.Phone')}}: </span>{{$order->phone}}
        </div>
        <div class="form-group">
            <span>{{__('home.email')}}: </span>{{$order->email}}
        </div>
        <div class="form-group" id="total_price">
            <span>{{__('home.Total Product')}}: </span>{{$order->total_price}}
        </div>
        <div class="form-group" id="shipping_price">
            <span>{{__('home.Shipping Price')}}: </span>{{$order->shipping_price}}
        </div>
        <div class="form-group" id="total">
            <span>{{__('home.Total Price')}}: </span>{{$order->total}}
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Handle thumbnail change when clicking on a gallery item
        $('.image-item').on('click', function () {
            var imageUrl = $(this).find('img').data('url');
            $('#productThumbnail').attr('src', imageUrl);
            $('#urlImage').val(imageUrl);
        });
    });
</script>
