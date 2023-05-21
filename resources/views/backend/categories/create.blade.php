@extends('backend.layouts.master')


@section('content')
    <form action="{{ route('seller.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="parent_id">Danh mục cha</label>
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">-- Chọn danh mục cha --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>

@endsection
