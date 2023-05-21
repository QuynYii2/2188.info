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
            <form action="{{ route('seller.products.update', $category->id) }}" method="POST">
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

                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('seller.categories.index') }}" class="btn btn-primary">Hủy</a>
            </form>
        </div>
    </div>
@endsection
