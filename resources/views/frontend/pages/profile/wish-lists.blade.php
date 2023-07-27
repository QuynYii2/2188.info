@extends('frontend.layouts.profile')

@section('content')
    <div class="container">
        <h2>Wishlist</h2>
        <div class="row">
            @if(count($productLists) > 0)
                @foreach($productLists as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                Tên sản phẩm: {{ $product->name }} <br>
                                Giá gốc: {{ $product->price }} <br>
                                @if($product->old_price)
                                    Giá khuyễn mãi: {{ $product->old_price }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <p>There are no products in your wishlist.</p>
                </div>
            @endif
        </div>
    </div>
@endsection