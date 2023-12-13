@extends('backend.layouts.master')
@section('title', 'Wish List')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@section('content')
    <h2 class="mt-5 d-flex justify-content-center align-items-center">{{ __('home.Wishlist') }}</h2>
    <div class="row">
        @foreach($wishListItems as $wishLis)
            @php
                $product = \App\Models\Product::find($wishLis->product_id)
            @endphp

            <div class="col-md-3">
                <div class="product-item__wishList">
                    @include('frontend.pages.profile.tab-product-wish-list.tab-wish-list-detail')
                </div>
            </div>
        @endforeach
    </div>

    <script>

        var token = '{{ csrf_token() }}';

        $(document).ready(function ($) {
            $(".icon-heart").click(function () {
                var idProduct = $(this).data('id');
                var url = "{{route('wish.list.delete', ['id'=>':id'])}}";
                url = url.replace(':id', idProduct);
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        idProduct: idProduct,
                        _token: token,
                    },
                    success: function (response) {
                        alert(response.message);
                    },
                    error: function (exception) {
                        alert('Something wrong!');
                    }
                });
            });
        });
    </script>

@endsection

