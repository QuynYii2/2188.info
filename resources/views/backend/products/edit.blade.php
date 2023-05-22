@extends('backend.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                    @if ($product->thumbnail)
                        <img src="{{ asset('storage/thumbnails/' . $product->thumbnail) }}" alt="Thumbnail" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label for="gallery">Gallery</label>
                    <input type="file" class="form-control-file" id="gallery" name="gallery[]" multiple>
{{--                    @dd(gettype($product->gallery))--}}
                    @if ($product->gallery && is_array($product->gallery))
                        @foreach ($product->gallery as $image)
                            <img src="{{ asset('storage/gallery/' . $image) }}" alt="Gallery Image" width="100">
                        @endforeach
                    @else
                        <img src="{{ asset('storage/gallery/' . $product->gallery) }}" alt="Gallery Image" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
