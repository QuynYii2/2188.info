@extends('frontend.layouts.profile')
@section('sub-content')
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
                        Tên sản phẩm: {{ ($product->name) }}<br>
                        Giá gốc: {{ ($product->price) }}<br>
                        @if($product->old_price)
                            Giá khuyễn mãi: {{ ($product->old_price) }}
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

    <script>
        var url = "{{route('wish.list.delete', ['id'=>':id'])}}";
        var token = '{{ csrf_token() }}';
    </script>

@endsection

