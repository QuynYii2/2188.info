@extends('frontend.layouts.master')

@section('title', 'Category')

@section('content')
    @php
        $langDisplay = new \App\Http\Controllers\Frontend\HomeController();
    @endphp
    <style>
        body{
            background: #f5f5f5;
        }
    </style>
    <div id="body-content">
        <div class="category-banner">
            <img src="https://cdn11.bigcommerce.com/s-3uw22zu194/product_images/uploaded_images/category-banner-top-layout-2.jpg"
                 alt="">

            <div class="category-name">
                ELECTRONICS
            </div>
        </div>
        <input id="url" type="text" hidden value="{{asset('/add-to-cart')}}">
        <hr>
        <div class="category-body container-fluid">
            <div class="tab-content">
                <div id="home" class="tab-pane active "><br>
                    <div class="row" id="renderProduct">
                        @if($products)
                            @foreach($products as $product)
                                <div class="col-xl-2 col-md-3 col-6 section">
                                    @include('frontend.pages.list-product')
                                </div>
                            @endforeach
                        @else
                            <p>
                                Chưa có sản phẩm nào
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.pages.modal-products')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection
