@extends('frontend.layouts.profile')

@section('content')
    <?php
    $trans = \App\Http\Controllers\TranslateController::getInstance();
    ?>
    <div class="container">
        <h2>{{ __('home.Wishlist') }}</h2>
        <div class="row">
            @foreach($wishListItems as $wishLis)
                {{--                @foreach($productLists as $product)--}}
                @php
                    $product = \App\Models\Product::find($wishLis->product_id)
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="item-img">
                                <img src="{{ asset('/storage/' . $product->thumbnail) }}"
                                     alt="">
                            </div>
                            Tên sản phẩm: {{ $trans->translateText($product->name) }}<br>
                            Giá gốc: {{ $trans->translateText($product->price) }}<br>
                            @if($product->old_price)
                                Giá khuyễn mãi: {{ $trans->translateText($product->old_price) }}
                            @endif

                            <div>
                                @if(Auth::check())
                                    <a href="{{route('detail_product.show', $product->id)}}">
                                        <button>{{ __('home.Choose Options') }}</button>
                                    </a>
                                @else
                                    <a class="check_url">{{ __('home.Choose Options') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="deleteButton--wish-list" data-value="{{$wishLis->id}}">
                            <button>
                                {{ __('home.delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function ($) {
            $(".deleteButton--wish-list").click(function () {
                var idWishList = $(this).data('value');
                console.log(idWishList)
                $.ajax({
                    url: "/wish-list-delete/" + idWishList,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        id: idWishList,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert('Sản phẩm đã được xóa khỏi danh sách yêu thích');
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error("Lỗi khi xóa dữ liệu: " + error);
                    }
                });
            });
        });
    </script>

@endsection

