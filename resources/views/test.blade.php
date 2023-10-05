<div class="product-list">
    <div class="row infinite-scroll">
        @foreach($productByLocal as $product)
            <div class="col-lg-4 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img class="img" src="{{ asset('storage/'.$product->thumbnail) }}" alt="">
                        <div class="sale pp-sale">Sale</div>
                        <div class="icon">
                            <i class="fa fa-heart-o"></i>
                        </div>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">{{($product->category->name)}}</div>
                        <a href="{{route('detail_product.show', $product->id)}}">
                            <h5>{{($product->name)}}</h5>
                        </a>
                        <div class="product-price">
                            ${{$product->price}}
                            {{--                                            <span>$35.00123</span>--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>