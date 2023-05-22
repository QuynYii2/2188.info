@extends('backend.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h5 class="card-title">Danh sách thuộc tính</h5>
            <a href="{{ route('attributes.create') }}" class="btn btn-primary">Thêm mới</a>
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('success_update_product') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Tên thuộc tính</th>
                    <th>Số lượng biến thể</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attributes as $attribute)
                    <tr>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ $attribute->variations_count }}</td>
                        <td><a href="{{ route('attributes.create') }}" class="btn btn-primary">Thêm mới biến thể</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
