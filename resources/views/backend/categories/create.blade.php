@extends('backend.layouts.master')


@section('content')
    <form action="{{ route('seller.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('home.Tên danh mục') }}</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="parent_id">{{ __('home.Danh mục cha') }}</label>v
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="">{{ __('home.-- Chọn danh mục cha --') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="thumbnail">{{ __('home.thumbnail') }}</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('home.thêm mới') }}</button>
    </form>

@endsection
