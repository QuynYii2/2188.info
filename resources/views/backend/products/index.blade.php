@extends('backend.layouts.master')

@section('title')
    List Products
@endsection
@php
    use App\Enums\PermissionUserStatus;use App\Http\Controllers\Frontend\HomeController;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;

    if (auth()->check() != null){
        $permissionUsers = DB::table('permissions')
        ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
        ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
        ->select('permissions.*')
        ->get();
    } else {
        $permissionUsers[]= null;
    }

    $isAdmin = (new  HomeController())->checkAdmin();
@endphp
<style>
    .pagination {
        height: 100px;
        font-size: 24px;
    }

    .pagination li a{
        margin: 4px;
        padding: 4px;
        color: #cccccc;
        text-decoration: none;
    }

    .pagination li.active{
        color: rgba(255, 165, 0, 0.93);
    }

    .pagination li a:hover{
        color: rgba(238, 207, 51, 0.82);
    }

    ul.pagination > li:first-child {
        margin-right: 8px;
    }

    ul.pagination > li:last-child {
        margin-left: 8px;
    }
</style>
@section('content')
    <div class="container-fluid list-product-page">
        <h5 class="title-page s24w6">List Product</h5>
        <div class="search-product bg-white text-center">
            <form action="{{ route('seller.products.search') }}" id="searchInput"
                  class="d-flex align-items-center justify-content-between">
                @csrf
                <div class="list-input d-flex align-items-center">
                    <input type="date" class="form-control" id="datetime">
                    <input type="text" class="form-control" id="keyword" placeholder="Subject/Name/Email">
                </div>
                <div class="list-button d-flex align-items-center">
                    <button type="submit" class="btn btnSearchProduct cFFFs16w6">Submit</button>
                    <button href="#" type="reset" class="btn brnClear cF00s14w6">Clear All</button>
                </div>
            </form>
        </div>
        <div class="table-products bg-white">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">
                        <input class="" type="checkbox" id="inputSelectAll" value="all">
                    </th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Hot</th>
                    <th scope="col">Feature</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">
                            <input class="" type="checkbox" id="inputSelectProduct_{{$product->id}}"
                                   value="{{$product->id}}">
                        </th>
                        @php
                            $thumbnail = checkThumbnail($product->thumbnail);
                        @endphp
                        <td class="d-flex align-items-center">
                            <img src="{{ $thumbnail }}" alt="" class="image_product">
                        </td>
                        <td>
                            <div class="product-name">
                                <a href="{{route('seller.products.edit', $product->id)}}" class="s12w5">
                                    @if(locationHelper() == 'kr')
                                        {{($product->name_ko)}}
                                    @elseif(locationHelper() == 'cn')
                                        {{($product->name_zh)}}
                                    @elseif(locationHelper() == 'jp')
                                        {{($product->name_ja)}}
                                    @elseif(locationHelper() == 'vi')
                                        {{($product->name)}}
                                    @else
                                        {{($product->name_en)}}
                                    @endif
                                </a>
                            </div>
                            <div class="item-action d-flex align-items-center justify-content-between">
                                <div class="product-code s12w5">
                                    <span>Product code: </span>
                                    {{ $product->product_code }}
                                </div>
                                <div class="action">
                                    <a class="action-edit" href="{{route('seller.products.edit', $product->id)}}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a class="action-delete" data-toggle="modal"
                                       data-target="#modalDeleteProduct{{$product->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                    <div class="modal fade text-black"
                                         id="modalDeleteProduct{{$product->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{route('seller.products.destroy', $product)}}"
                                                  method="post">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                        <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="text-center">
                                                            {{ __('home.Bạn có chắc chắn muốn xoá') }}
                                                        </h5>
                                                        <p class="text-danger">
                                                            {{ __('home.Nếu xoá bạn sẽ không thể không thể tìm thấy nó!Chúng tôi sẽ không chịu trách nhiệm cho việc này!') }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('home.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">Yes
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="s12w5">{{ $product->status }}</td>
                        <td class="s12w5">
                            {{ number_format(convertCurrency('USD', $currency,$product->price), 0, ',', '.') }} {{$currency}}
                        </td>
                        <td class="s12w5">
                            @php
                                $listCate = $product->list_category;
                                $cate1 = explode(',', $listCate);
                            @endphp
                            @foreach($cate1 as $cates)
                                @php
                                    $category = \App\Models\Category::find($cates);
                                @endphp
                                @if($category)
                                    @if(locationHelper() == 'kr')
                                        <div class="text">{{ $category->name_ko }}</div>
                                    @elseif(locationHelper() == 'cn')
                                        <div class="text">{{$category->name_zh}}</div>
                                    @elseif(locationHelper() == 'jp')
                                        <div class="text">{{$category->name_ja}}</div>
                                    @elseif(locationHelper() == 'vi')
                                        <div class="text">{{$category->name_vi}}</div>
                                    @else
                                        <div class="text">{{$category->name_en}}</div>
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <input class="input_hot inputHotCheckbox" {{ $product->hot == 1 ? 'checked' : '' }} type="checkbox"
                                   id="inputHot-{{$product->id}}" value="{{$product->id}}">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ __('home.Bạn có muốn nâng cấp sản phẩm không') }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('home.Close') }}</button>
                                            <button type="button" class="btn btn-primary"><a
                                                        href="{{route('permission.list.show')}}">{{ __('home.Sign up to upgrade') }}</a>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input class="input_feature inputFeatureCheckbox" {{ $product->feature == 1 ? 'checked' : '' }} type="checkbox"
                                   id="inputFeature-{{$product->id}}" value="{{$product->id}}">
                        </td>
                        <td class="s12w5">
                            {{ __('home.Đã xuất bản') }} <br>
                            {{$product->created_at}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </div>
    <script>
        var url = `{{ route('seller.products.hot', ['id' => ':productID']) }}`;
        var urla = `{{ route('seller.products.feature', ['id' => ':productID']) }}`;
        var token = `{{ csrf_token() }}`;
    </script>
    <script src="{{ asset('js/backend/list.js') }}"></script>
    <script src="{{ asset('js/backend/products-index.js') }}"></script>
@endsection