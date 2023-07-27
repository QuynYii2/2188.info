@extends('frontend.layouts.profile')

@section('content')
    <div class="container">
        <h2>Wishlist</h2>
        <div class="row">
            @if(count($listWishlists) > 0)
                @foreach($listWishlists as $wishlist)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Product ID: {{ $wishlist->product_id }}</h5>

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