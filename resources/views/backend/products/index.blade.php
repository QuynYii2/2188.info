@extends('backend.layouts.master')

@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        use Illuminate\Support\Facades\DB;
        use App\Enums\PermissionUserStatus;

        if (auth()->check() != null){
            $permissionUsers = DB::table('permissions')
            ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
            ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
            ->select('permissions.*')
            ->get();
        } else {
            $permissionUsers[]= null;
        }

    @endphp

    <style>
        .table th {
            width: 100%;
            white-space: nowrap;
        }
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách sản phẩm</h5>
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('success_update_product') }}
                </div>
            @endif
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Sản phẩm hot</th>
                        <th>Sản phẩm nổi bật</th>
                        <th>Chuyên mục</th>
                        <th>Giá</th>
                        <th>Ảnh đại diện</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name}}</td>
                            <td>
                                @for($i = 0; $i< count($permissionUsers); $i++)
                                    @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                                        @if($product->hot == 1)
                                            <label class="switch">
                                                <input value="{{$product->id}}" class="inputHotCheckbox"
                                                       name="inputHot-{{$product->id}}" id="inputHot-{{$product->id}}"
                                                       type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        @else
                                            <label class="switch">
                                                <input value="{{$product->id}}" class="inputHotCheckbox"
                                                       name="inputHot-{{$product->id}}" id="inputHot-{{$product->id}}"
                                                       type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        @endif
                                        @break
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i = 0; $i< count($permissionUsers); $i++)
                                    @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm nổi bật')
                                        @if($product->feature == 1)
                                            <label class="switch">
                                                <input value="{{$product->id}}" class="inputFeatureCheckbox"
                                                       name="inputFeature-{{$product->id}}"
                                                       id="inputFeature-{{$product->id}}"
                                                       type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        @else
                                            <label class="switch">
                                                <input value="{{$product->id}}" class="inputFeatureCheckbox"
                                                       name="inputFeature-{{$product->id}}"
                                                       id="inputFeature-{{$product->id}}"
                                                       type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        @endif
                                        @break
                                    @endif
                                @endfor
                            </td>
                            <td>{{ $product->category->name}}</td>
                            <td>{{ $product->price }}</td>
                            <td style="width: 100px; height: 100px">
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" style="width: 100%; height: auto"
                                     alt="Thumbnail">
                            </td>
                            <td></td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('seller.products.edit', $product->id) }}"><i
                                            style="color: black; margin-right: 15px"
                                            class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST"
                                      style="">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="clickBtn({{ $product->id}})"><i style="color: #d52727"
                                                                                         class="fa-solid fa-trash-can"></i></a>
                                    <button id="btn-delete-product-{{ $product->id}}" hidden type="submit"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        Xoa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".inputHotCheckbox").click(function () {
                var productID = jQuery(this).val();
                console.log(productID);

                function setProductHots(productID) {
                    $.ajax({
                        url: '/toggle-products-hot/' + productID,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            console.log(response)
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                }

                setProductHots(productID);
            });

            $(".inputFeatureCheckbox").click(function () {
                var productID = jQuery(this).val();

                function setProductFeatures(productID) {
                    $.ajax({
                        url: '/toggle-products-feature/' + productID,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            console.log(response)
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                }

                setProductFeatures(productID);
            });
        });
    </script>
    <script>
        function clickBtn(id) {
            document.getElementById('btn-delete-product-' + id).click();
        }
    </script>
@endsection
