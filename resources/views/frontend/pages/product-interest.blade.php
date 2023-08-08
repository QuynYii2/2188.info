@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Category;
    use App\Models\Product;
    use App\Models\User;
@endphp

@extends('frontend.layouts.master')

@section('title', 'Product Interest')

@section('content')

    <div class="container">
        <div class="title mt-3 mb-3 text-center">Sản phẩm quan tâm</div>
        <div class=" p-3">
            <div class="row p-2">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <div class="">
                        @if($locale == 'vi' || $locale == null)
                            <img width="50px" class="img" src="{{ asset('/images/vietnam.webp') }}"
                                 alt="">
                            <span>Việt Nam</span>
                        @endif
                        @if($locale == 'kr')
                            <img width="50px" class="img" src="{{ asset('/images/korea.png') }}" alt="">
                            <span>Korea</span>
                        @endif
                        @if($locale == 'jp')
                            <img width="50px" class="img" src="{{ asset('/images/japan.webp') }}" alt="">
                            <span>Japan</span>
                        @endif
                        @if($locale == 'cn')
                            <img width="50px" class="img" src="{{ asset('/images/china.webp') }}" alt="">
                            <span>China</span>
                        @endif
                    </div>
                    <div class="">
                        @if(session('locale') == 'vi' || session('locale') == null)
                            <img width="50px" class="img" src="{{ asset('/images/vietnam.webp') }}"
                                 alt="">
                            <span>Việt Nam</span>
                        @endif
                        @if(session('locale') == 'kr')
                            <img width="50px" class="img" src="{{ asset('/images/korea.png') }}" alt="">
                            <span>Korea</span>
                        @endif
                        @if(session('locale') == 'jp')
                            <img width="50px" class="img" src="{{ asset('/images/japan.webp') }}" alt="">
                            <span>Japan</span>
                        @endif
                        @if(session('locale') == 'cn')
                            <img width="50px" class="img" src="{{ asset('/images/china.webp') }}" alt="">
                            <span>China</span>
                        @endif
                    </div>
                </div>
            </div>
            @php
                if ($userProduct){
                    $listProduct = null;
                    $myArray = explode(',', $userProduct->categories_id);
                    for($i = 0; $i<count(explode(',', $userProduct->categories_id)); $i++){
                        $category = Category::find($myArray[$i]);
                        $products = Product::where('category_id', $myArray[$i])->get();
                        if (count($products)>0){
                            foreach ($products as $product){
                                $listProduct[] = $product;
                            }
                        }
                    }
                }
            @endphp
            @if($userProduct)
                <div class="information mt-3">
                    <nav class="menu">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @for($i = 0; $i<count(explode(',', $userProduct->categories_id)); $i++)
                                @php
                                    $category = Category::find($myArray[$i]);
                                @endphp
                                @if($category)
                                    <a class="nav-item nav-link " style="color: black" id="nav-{{$category->name}}-tab"
                                       data-toggle="tab" href="#nav-{{$category->name}}" role="tab"
                                       aria-controls="nav-{{$category->name}}"
                                       aria-selected="true">{{($category->name)}}</a>
                                @endif
                            @endfor
                        </div>
                    </nav>
                    <div class="tab-content content" id="nav-tabContent">
                        @for($i = 0; $i<count(explode(',', $userProduct->categories_id)); $i++)
                            @php
                                $category = Category::find($myArray[$i]);
                                $products = Product::where('category_id', $myArray[$i])->get();
                            @endphp
                            @if($category)
                                <div class="tab-pane fade show " id="nav-{{$category->name}}" role="tabpanel"
                                     aria-labelledby="nav-{{$category->name}}-tab">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Tên công ty</th>
                                                <th scope="col">Mã công ty</th>
                                                <th scope="col">Sản phẩm</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($products != null)
                                                @foreach($products as $item)
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
                                                            <div class="product-item">
                                                                <div class="pi-text">
                                                                    <a href="{{route('detail_product.show', $item->id)}}">
                                                                        <h5>{{($item->name)}}</h5>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="seeImageProduct{{$item->id}}" tabIndex="-1"
                                                         role="dialog"
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
                                                                            <img class="img" id="img-modal"
                                                                                 src="{{$item->thumbnail}}"
                                                                                 alt="">
                                                                        </div>
                                                                        <div class="ml-3 mt-3">
                                                                            <button class="btn btn-secondary btn-16 btn-cancel mr-5"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">Cancel
                                                                            </button>
                                                                            <button onclick="orderClick({{$item->id}})"
                                                                                    class="btn btn-danger"
                                                                                    id="btn-buy-modal">
                                                                                Buy now
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function orderClick(id) {
            document.getElementById('btn-add-cart-' + id).click();
        }
    </script>
@endsection
