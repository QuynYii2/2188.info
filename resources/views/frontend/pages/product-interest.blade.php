@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\User;
@endphp

@extends('frontend.layouts.master')

@section('title', 'Product Interest')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-3">
            <div class="row p-2">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <div class="">
                        @if($locale == 'vi' || $locale == null)
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/vietnam.webp') }}"
                                 alt="">
                            <span>Việt Nam</span>
                        @endif
                        @if($locale == 'kr')
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/korea.png') }}" alt="">
                            <span>Korea</span>
                        @endif
                        @if($locale == 'jp')
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/japan.webp') }}" alt="">
                            <span>Japan</span>
                        @endif
                        @if($locale == 'cn')
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/china.webp') }}" alt="">
                            <span>China</span>
                        @endif
                    </div>
                    <div class="">
                        @if(session('locale') == 'vi' || session('locale') == null)
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/vietnam.webp') }}"
                                 alt="">
                            <span>Việt Nam</span>
                        @endif
                        @if(session('locale') == 'kr')
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/korea.png') }}" alt="">
                            <span>Korea</span>
                        @endif
                        @if(session('locale') == 'jp')
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/japan.webp') }}" alt="">
                            <span>Japan</span>
                        @endif
                        @if(session('locale') == 'cn')
                            <img width="80px" height="60px" class="img" src="{{ asset('/images/china.webp') }}" alt="">
                            <span>China</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row p-2 ">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Sản phẩm quan tâm</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $listProduct = null;
                    @endphp
                    @for($i = 0; $i<count(explode(',', $userProduct->categories_id)); $i++)
                        @php
                            $myArray = explode(',', $userProduct->categories_id);
                            $category = Category::find($myArray[$i]);
                            $products = Product::where('category_id', $myArray[$i])->get();
                            if (count($products)>0){
                                foreach ($products as $product){
                                    $listProduct[] = $product;
                                }
                            }
                        @endphp
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>
                                <form action="{{route('product.interest.delete', $category->id)}}" method="post">
                                    @csrf
                                    <button>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endfor

                    </tbody>
                </table>
            </div>
            <div class="mt-3 mb-2">
                <p>Total: {{count($listProduct)}}</p>
            </div>
            <div class="row p-2 ">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Tên công ty</th>
                        <th scope="col">Mã công ty</th>
                        <th scope="col">Sản phẩm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listProduct as $item)
                        <tr>
                            <td>
                                @php
                                    $user = User::where('id', $item->user_id)->first();
                                @endphp
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->product_code}}
                            </td>
                            <td>
                                <div class="">
                                    <div class="row">
                                        <form action="{{ route('cart.add', $item) }}" method="POST">
                                            @csrf
                                            <div class="col-lg-3 col-sm-4">
                                                <div class="product-item">
                                                    <div class="pi-pic">
                                                        <img class="img" src="{{$item->thumbnail}}" alt="" data-toggle="modal"
                                                             data-target="#seeImageProduct{{$item->id}}">
                                                        <div class="icon">
                                                            <i class="fa fa-heart-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="pi-text">
                                                        <div class="catagory-name">{{$item->category->name}}</div>
                                                        <a href="{{route('detail_product.show', $item->id)}}">
                                                            <h5>{{$item->name}}</h5>
                                                        </a>
                                                        <div class="product-price">
                                                            ${{$item->price}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" name="product_id" value="{{$item->id}}" hidden>
                                            <input type="text" name="price" value="{{$item->price}}" hidden>
                                            <input type="text" name="quantity" value="1" hidden>
                                            <button id="btn-add-cart-{{$item->id}}" type="submit" hidden></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="seeImageProduct{{$item->id}}" tabIndex="-1" role="dialog"
                             aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row d-flex justify-content-between">
                                            <div class="col-md-10 img-main">
                                                <img class="img" id="img-modal" src="{{$item->thumbnail}}"
                                                     alt="">
                                            </div>
                                            <div class="ml-3 mt-3">
                                                <button class="btn btn-secondary btn-16 btn-cancel mr-5"
                                                        data-dismiss="modal"
                                                        aria-label="Close">Cancel
                                                </button>
                                                <button onclick="orderClick({{$item->id}})" class="btn btn-danger" id="btn-buy-modal">
                                                    Buy now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function orderClick(id) {
            document.getElementById('btn-add-cart-' + id).click();
        }
    </script>
@endsection
