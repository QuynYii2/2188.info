@php
    use Illuminate\Support\Facades\DB;
    use App\Enums\PropertiStatus;
@endphp

@extends('backend-v2.layouts.master')
@section('title')
    Create Product
@endsection
@php
    use Illuminate\Support\Facades\Auth;
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
@section('content')
    <div id="wpcontent">
        <div id="wpbody" role="main">
            <div class="card-header d-flex justify-content-between align-items-center" style="padding: 15px;">
                <h5 class="card-title">Thêm mới sản phẩm</h5>
                @if (session('success_update_product'))
                    <div class="alert alert-success">
                        {{ session('success_update_product') }}
                    </div>
                @endif
            </div>

            <div class="container-fluid">
                <form action="{{ route('product.v2.create') }}" method="post" enctype="multipart/form-data"
                      class="form-horizontal row" role="form">
                    @csrf
                    @if (session('success_update_product'))
                        <div class="alert alert-success">
                            {{ session('error_create_product') }}
                        </div>
                    @endif

                    <input type="text" hidden="" name="storage_id" value="{{$product->storage_id}}">
                    <input type="text" hidden="" name="qty" value="{{$product->qty}}">
                    <input type="text" hidden="" name="user_id" value="{{$product->user_id}}">
                    <input type="text" hidden="" name="location" value="{{$product->location}}">
                    <input type="text" hidden="" name="slug" value="{{$product->slug}}">

                    <div class="col-12 col-md-7 border-right mt-2 rm-pd-on-mobile">
                        <div class="form-group">
                            <div class="name">Tên sản phẩm</div>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm" value="{{$product->name}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <div class="name">Mã sản phẩm</div>
                            <input type="text" class="form-control" name="product_code" id="product_code"
                                   placeholder="Nhập mã sản phẩm" required value="{{$product->product_code}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả ngắn</label>
                            <textarea id="description" class="form-control description" name="description"
                                      rows="5">{{$product->short_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description-detail">Mô tả chi tiết</label>
                            <textarea id="description-detail" class="form-control description" name="description-detail"
                                      rows="5">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="category_id">Danh mục sản phẩm</label>
                            <input type="text" class="form-control"
                                   required value="{{$product->category->name}}" disabled>
                            <input type="text" class="form-control" name="category_id" id="category_id"
                                   value="{{$product->category_id}}" hidden="">
                        </div>
                        <div class="form-group row">
                            @for($i = 0; $i< count($permissionUsers); $i++)
                                @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                                    <div class="col-4 d-flex">
                                        <label for="hot_product" class="col-8 col-sm-8">Sản phẩm hot</label>
                                        <div class="col-4 col-sm-4">
                                            <input class="form-control" type="checkbox" id="hot_product"
                                                   name="hot_product">
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endfor
                            @for($i = 0; $i< count($permissionUsers); $i++)
                                @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm nổi bật')
                                    <div class="col-4 d-flex">
                                        <label for="feature_product" class="col-8 col-sm-8">Sản phẩm nổi bật</label>
                                        <div class="col-4 col-sm-4">
                                            <input class="form-control" type="checkbox" id="feature_product"
                                                   name="feature_product">
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="col-12 col-md-5 mt-2 rm-pd-on-mobile">
                        @foreach($testArray as $item)
                            @php
                                $attributeProperty = explode(',', $item);
                            @endphp
                            <div class="form-group">
                                @foreach($attributeProperty as $attpro)
                                    @php
                                        $attproArray =  explode('-', $attpro);
                                        $attribue = \App\Models\Attribute::find($attproArray[0]);
                                        $property = \App\Models\Properties::find($attproArray[1]);
                                    @endphp
                                    <label for="attribute{{$item}}">{{$attribue->name}}</label>
                                    <input disabled class="form-control" name="attribute{{$item}}"
                                           id="attribute{{$item}}" value=" {{$property->name}}">
                                @endforeach
                            </div>
                            <a id="btnEdit{{$loop->index+1}}" onclick="showFormEdit({{$loop->index+1}});"
                               class="btn btn-primary">Editor</a>
                            <div id="formCreate{{$loop->index+1}}" class="d-none">
                                <div class="form-row">
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name" for="price">Giá bán</label>
                                        <input onchange="validInput({{$loop->index+1}});" type="number"
                                               class="value-check form-control" required
                                               name="old_price{{$loop->index+1}}"
                                               id="price{{$loop->index+1}}"
                                               placeholder="Nhập giá bán">
                                    </div>
                                    <div class="col-4 d-inline-block">
                                        <label class="control-label small name" for="qty">Giá khuyến mãi</label>
                                        <input onchange="validInput({{$loop->index+1}});" type="number"
                                               class="value-check form-control"
                                               name="price{{$loop->index+1}}" id="qty{{$loop->index+1}}"
                                               placeholder="Nhập giá khuyến mãi">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group col-12 col-sm-12 pt-3">
                                        <label for="thumbnail">Ảnh đại diện:</label>
                                        <label class='__lk-fileInput'>
                                            <span data-default='Choose file'>Choose file</span>
                                            <input type="file" id="thumbnail" class="img-cfg"
                                                   name="thumbnail{{$loop->index+1}}"
                                                   accept="image/*"
                                                   required>
                                        </label>
                                    </div>
                                    <div class="form-group col-12 col-sm-12 ">
                                        <label for="gallery">Thư viện ảnh:</label>
                                        <label class='__lk-fileInput'>
                                            <span data-default='Choose file'>Choose file</span>
                                            <input type="file" id="gallery" class="img-cfg"
                                                   name="gallery{{$loop->index+1}}[]"
                                                   accept="image/*"
                                                   multiple>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="text" hidden="" name="attribute_property{{$loop->index+1}}" value="{{$item}}">
                            <br>
                            <br>
                        @endforeach
                    </div>
                    <input type="text" hidden="" name="count" value="{{count($testArray)}}">
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div><!-- wpbody -->
        <div class="clear"></div>
    </div><!-- wpcontent -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showFormEdit(id) {
            var formEdit = document.getElementById('formCreate' + id);
            formEdit.classList.remove('d-none');
        }

        $('#btnSubmit').on('click', function () {
            checkValue();
        })

        function checkValue() {
            var inputValue = document.getElementsByClassName('value-check');
            for (let i = 0; i < inputValue.length; i++) {
                if (inputValue[i].value == '') {
                    alert('Vui lòng nhập đầy đủ thông tin sản phẩm')
                    break;
                }
            }
        }

        function validInput(id) {
            var priceInput = document.getElementById('price' + id);
            var qtyInput = document.getElementById('qty' + id);

            function checkPrice() {
                var price = parseFloat(priceInput.value);
                var qty = parseFloat(qtyInput.value);

                if (qty > price) {
                    alert('Giá khuyến mãi không được lớn hơn giá bán.');
                    qtyInput.value = '';
                }
            }
        }
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description-detail'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
