@extends('backend.layouts.master')
@section('title', 'Product Viewed')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <div class="row mt-2 bg-white rounded">
        <div class="row rounded pt-1 ml-5">
            <h5>{{ __('home.product viewed') }}</h5>
        </div>
        <div class="border-bottom"></div>
        <div class="col-md-12">
            <div class="tab-content py-3 px-3 px-sm-0">
                @if($arrayProducts == null)
                    <div class="text-center">
                        <img class="img" src="{{asset('images/empty.jpg')}}" alt="">
                        <p>{{ __('home.you have no product viewed') }}
                        </p>
                    </div>
                @else
                    <div class="row">
                        @foreach($arrayProducts as $product)
                           @if($product!= null)
                                @php
                                    $thumbnail = checkThumbnail($product->thumbnail);
                                @endphp
                                <div class="col-md-3 border mb-3">
                                    <h5 class="text-center">
                                        <a class="link-hover" href="{{route('detail_product.show', $product->id)}}"> {{ ($product->name) }}</a>
                                    </h5>
                                    <img class="img" src="{{$thumbnail}}" alt="Product image">
                                    <div class="text-center text-danger">${{ ($product->price) }}</div>
                                </div>
                           @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
