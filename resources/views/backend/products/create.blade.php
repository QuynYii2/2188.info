@extends('layouts.admin')

@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
