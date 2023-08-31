@extends('frontend.layouts.profile')

@section('title', 'Shop My')

<style>
    .link-tabs {
        background-color: #f7f7f7 !important;
    }

    .link-tabs:hover {
        color: #c69500 !important;
    }
</style>

@section('sub-content')
    <div class="container">
        <h5 class="text-center">My Shop</h5>
        <div class="row">
            @if(!$products->isEmpty())
                @foreach($products as $product)
                    <div class="col-xl-3 col-md-3 col-6 section mb-4">
                        @include('frontend.pages.list-product')
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @include('frontend.pages.modal-products')
@endsection
