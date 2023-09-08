@extends('frontend.layouts.master')
@section('title', 'Search')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center"> {{ __('home.Search Results') }} </h3>
        <div class="category-body container-fluid">
            <div class="row" id="renderProduct">
                @foreach($products as $product)
                    <div class="col-xl-2 col-md-3 col-6 section mb-4">
                        @include('frontend.pages.list-product')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection