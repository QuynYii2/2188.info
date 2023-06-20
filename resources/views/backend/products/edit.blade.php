@php
    use App\Enums\PropertiStatus;use Illuminate\Support\Facades\DB;
@endphp

@extends('backend.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('seller.products.update', $product->id) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
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
                    <label class="col-md-12 control-label">Thông số sản phẩm</label>
                    @foreach($attributes as $attribute)
                        @php
                            $properties = DB::table('properties')->where([['status', PropertiStatus::ACTIVE], ['attribute_id', $attribute->id]])->get();
                        @endphp
                        @if(!$properties->isEmpty())
                            <div id="{{$attribute->name}}-{{$attribute->id}}" class="">
                                <label class="control-label offset-2" for="color">{{$attribute->name}}</label>
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

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                    @if ($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label for="gallery">Gallery</label>
                    <input type="file" class="form-control-file" id="gallery" name="gallery[]" accept="image/*"
                           multiple>
                    @php
                        $input = $product->gallery;
                        $array = json_decode($input, true);

                        $modifiedArray = [];
                        if($array != null){
                            foreach ($array as $value) {
                                $modifiedArray[] = str_replace(['gallery\/', '\\'], '', $value);
                            }
                        }
                    @endphp
                    @if ($product->gallery )
                        @foreach ($modifiedArray as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" width="100">
                        @endforeach
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
