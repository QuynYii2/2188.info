@extends('backend.layouts.master')

@section('content')
    <style>
        .table th {
            width: 100%;
            white-space: nowrap;
        }
    </style>
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h5 class="card-title">Danh sách sản phẩm</h5>
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('success_update_product') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Tác giả</th>
                        <th>Chuyên mục</th>
                        <th>Giá</th>
                        <th>Ảnh đại diện</th>
                        <th>Thời gian</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td></td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <img src="{{ asset($product->thumbnail) }}" height="180" alt="Thumbnail">
                            </td>
                            <td></td>
                            <td class="d-flex">
                                <a href="{{ route('seller.products.edit', $product->id) }}"
                                   class="btn btn-primary mr-2">Sửa</a>
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST"
                                      style="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
