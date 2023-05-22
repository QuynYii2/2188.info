@extends('backend.layouts.master')

@section('content')
    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (session('success_update_product'))
            <div class="alert alert-success">
                {{ session('error_create_product') }}
            </div>
        @endif
        <div>
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" required>
        </div>

        <div>
            <label for="category">Chuyên mục:</label>
            <select id="category" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @foreach($attributes as $attribute)

            <div class="form-group">
                <label for="variations">{{ $attribute->name }}:</label>
                <select class="form-control" name="variations[]" id="variations" multiple>
                    @foreach($attribute->variations as $variation)
                        <option value="{{ $variation->id }}">{{ $variation->name }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <div>
            <label for="thumbnail">Ảnh đại diện:</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
        </div>

        <div>
            <label for="gallery">Thư viện ảnh:</label>
            <input type="file" id="gallery" name="gallery[]" accept="image/*" multiple>
        </div>

        <div>
            <button type="submit">Đăng bài</button>
        </div>
    </form>

@endsection
