@php
    use App\Enums\PropertiStatus;use Illuminate\Support\Facades\DB;
@endphp

@extends('backend.layouts.master')

@section('content')
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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Edit Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('seller.products.update', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">{{ __('home.Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="price">{{ __('home.Giá bán') }}</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                </div>
                <div class="form-group">
                    <label for="qty">{{ __('home.Giá khuyến mãi') }}</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="{{ $product->qty }}">
                </div>

                <div class="form-group">
                    <label for="category">{{ __('home.category') }}</label>
                    <select class="form-control" id="category" name="category_id">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label">{{ __('home.Thông số sản phẩm') }}</label>
                    @foreach($attributes as $attribute)
                        @php
                            $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                        @endphp
                        @if(!$properties->isEmpty())
                            <div id="{{$attribute->name}}-{{$attribute->id}}" class="">
                                <label class="control-label" for="color">{{$attribute->name}}</label>
                                <div class="col-md-12 overflow-scroll custom-scrollbar">
                                    <ul class="list-unstyled">
                                        @foreach($properties as $property)
                                            @php
                                                $isChecked = false
                                            @endphp
                                            <li>
                                                <label>
                                                    @foreach($att_of_product as $att)
                                                        @if($att->attribute_id == $attribute->id )
                                                            @php
                                                                $value = explode(',', $att->value);
                                                            foreach($value as $item){
                                                                if($item == $property->id ){
                                                                    $isChecked = true;
                                                                    }
                                                                }
                                                            @endphp
                                                        @endif

                                                    @endforeach
                                                    <input onchange="checkInput();" class="property-attribute"
                                                           id="property-{{$property->id}}"
                                                           type="checkbox" name="property-{{$attribute->name}}"
                                                           value="{{$attribute->id}}-{{$property->id}}" {{ $isChecked ? 'checked' : '' }}>
                                                    {{$property->name}}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                <input id="inputHotProduct" type="text" class="d-none" value="{{ $product->hot }}">
                <input id="inputFeatureProduct" type="text" class="d-none" value="{{ $product->feature }}">

                <div class="form-group row">
                    @for($i = 0; $i< count($permissionUsers); $i++)
                        @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm hot')
                            <div class="col-4 d-flex">
                                <label for="hot_product" class="col-8 col-sm-8">{{ __('home.Sản phẩm hot') }}</label>
                                <div class="col-4 col-sm-4">
                                    <input class="form-control" type="checkbox" id="hot_product" name="hot_product">
                                </div>
                            </div>
                            @break
                        @endif
                    @endfor
                    @for($i = 0; $i< count($permissionUsers); $i++)
                        @if($permissionUsers[$i]->name == 'Nâng cấp sản phẩm nổi bật')
                            <div class="col-4 d-flex">
                                <label for="feature_product" class="col-8 col-sm-8">{{ __('home.Sản phẩm nổi bật') }}</label>
                                <div class="col-4 col-sm-4">
                                    <input class="form-control" type="checkbox" id="feature_product"
                                           name="feature_product">
                                </div>
                            </div>
                            @break
                        @endif
                    @endfor
                </div>

                <div class="form-group">
                    <label for="thumbnail">{{ __('home.thumbnail') }}</label>
                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*">
                    @if ($product->thumbnail)
                        @php
                            $thumbnail = checkThumbnail($product->thumbnail);
                        @endphp
                        <a href="{{ $thumbnail }}" data-fancybox="group"
                           data-caption="This image has a caption 1">
                            <img class="mt-2" style="height: 100px" src="{{ $thumbnail }}"
                                 alt="Thumbnail">
                        </a>
                    @endif
                </div>

                <div class="form-group">
                    <label for="gallery">Gallery</label>
                    <input type="file" class="form-control-file" id="gallery" name="gallery[]" accept="image/*"
                           multiple>
                    @php
                        $input = $product->gallery;
                        $array = json_decode($input, true);
                        $modifiedArray = explode(",", $input);
                    @endphp
                    @if ($product->gallery )
                        @foreach ($modifiedArray as $image)
                            @php
                                $thumbnail = checkThumbnail($image);
                            @endphp
                            <a href="{{ $thumbnail }}" data-fancybox="group"
                               data-caption="This image has a caption 1">
                                <img class="mt-2" style="height: 100px; width: 100px "
                                     src="{{ $thumbnail }}" alt="Gallery Image" width="100">
                            </a>
                        @endforeach
                    @endif
                </div>
                <input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
