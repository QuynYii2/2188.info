@extends('frontend.layouts.profile')

@section('title', 'My Review')

@section('sub-content')
    <div class="row mt-2 bg-white rounded">
        <div class="row rounded pt-1 ml-5">
            <h5>Sản phẩm được xem nhiều nhất</h5>
        </div>
        <div class="border-bottom"></div>
        <div class="col-md-12">
            <div class="tab-content py-3 px-3 px-sm-0">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 mb-1">
                            <h5 class="text-center">
                                <a class="link-hover"
                                   href="{{route('detail_product.show', $product->id)}}"> {{ ($product->name) }}</a>
                            </h5>
                            <img class="img" src="{{ asset('storage/' . $product->thumbnail) }}" alt="Product image">
                            <div class="text-center text-danger">${{ ($product->price) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
