@extends('backend.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h5 class="card-title">Danh sách Categories</h5>
            <a href="{{ route('seller.categories.create') }}" class="btn btn-primary">Thêm mới</a>
            @if (session('success_update_cat'))
                <div class="alert alert-success">
                    {{ session('success_update_cat') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Danh mục cha</th>
                    <th>Số bài viết</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                        <td>10</td>
                        <td>
                            <a href="{{ route('seller.categories.edit', $category->id) }}" class="btn btn-primary">Sửa</a>
                            <form action="{{ route('seller.categories.destroy', $category->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
