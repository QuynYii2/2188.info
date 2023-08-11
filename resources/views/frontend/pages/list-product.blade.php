<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@php
    $productDetail = \App\Models\Variation::where('product_id', $product->id)->first();
@endphp
<div class="swiper-slide">
    <div class="item">
        @if($product->thumbnail)
            <div class="item-img">
                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                <div class="button-view">
                    <button type="button" class="btn view_modal" data-toggle="modal"
                            data-value="{{$product}}" data-id="{{$productDetail}}"
                            data-target="#exampleModal">{{ __('home.Quick view') }}</button>
                </div>
                <div class="text">
                    <div class="text-new">
                        New
                    </div>
                </div>
            </div>
        @endif
        <div class="item-body">
            <div class="card-rating">
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
            <div class="card-brand">
                {{($nameSeller->name)}}
            </div>
            <div class="card-title">
                @if(Auth::check())
                    <a href="{{route('detail_product.show', $product->id)}}">{{ ($product->name) }}</a>
                @else
                    <a class="check_url">{{($product->name)}}</a>
                @endif
            </div>
            @if($product->price)
                <div class="card-price d-flex justify-content-between">
                    @if($product->price != null)
                        <div class="price-sale">
                            <strong>${{$product->price}}</strong>
                        </div>
                        <div class="price-cost">
                            <strike>${{$product->old_price}}</strike>
                        </div>
                    @else
                        <div class="price-sale">
                            <strong>${{$product->old_price}}</strong>
                        </div>
                    @endif
                </div>
            @endif


            <div class="card-bottom d-flex justify-content-between">
                <div class="card-bottom--left">
                    @if(Auth::check())
                        <a href="{{route('detail_product.show', $product->id)}}">{{ __('home.Choose Options') }}</a>
                    @else
                        <a class="check_url">{{ __('home.Choose Options') }}</a>
                    @endif
                </div>
                <div class="card-bottom--right " id-product="{{$product->id}}">
                    <i class="item-icon fa-regular fa-heart"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var url = document.getElementById('inputUrl');
    $('.view_modal').on('click', function () {
        var product = $(this).data('value');
        var productDetail = $(this).data('id');
        let urggg = document.getElementById('url').value;
        $('#form_cart').attr('action', urggg + '/' + product['id']);
        var modal_img = document.getElementById('img-modal')
        modal_img.src = url.value + '/' + product['thumbnail'];
        var modal_name = document.getElementById('productName-modal')
        modal_name.innerText = product['name'];
        var price_sale = document.getElementById('price-sale')
        price_sale.innerText = product['price'];
        var price_old = document.getElementById('price-old')
        price_old.innerText = product['old_price'];
        var description_text = document.getElementById('description-text')
        description_text.innerHTML = productDetail['description'];
        var qty = document.getElementById('qty')
        qty.innerText = product['qty'];
        var variable = document.getElementById('variable_id')
        variable.value = productDetail['variation'];
    })


</script>