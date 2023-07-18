@extends('backend.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Chỉnh sửa Category</h5>
            @if (session('error_update_cat'))
                <div class="alert alert-success">
                    {{ session('error_update_cat') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('seller.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                </div>

                <div class="form-group">
                    <label for="parent">Danh mục cha</label>
                    <select class="form-control" id="parent" name="parent_id">
                        <option value="">-- Chọn danh mục cha --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-success mr-3">Lưu</button>
                <a href="{{ route('seller.categories.index') }}" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
