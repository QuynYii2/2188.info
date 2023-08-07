@extends('backend.layouts.master')

@section('content')
    <style>
        .table th {
            width: 100%;
            white-space: nowrap;
        }
    </style>
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center">
        <h5 class="card-title">Danh sách Đánh giá</h5>
    </div>
    <div class="container-fluid evaluate-list" style="height: 100vh">
        <div class="card">
            <div class="card-body row">
                <div class="col-12 col-sm-12 table-responsive-sm">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Tên user</th>
                            <th>ID sản phẩm</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$evaluates)
                            @foreach ($evaluates as $evaluate)
                                <tr>
                                    <td><input type="checkbox" value="{{ $evaluate->id }}"></td>
                                    <td>{{ $evaluate->id }}</td>
                                    <td>{{ $evaluate->username }}</td>
                                    <td>{{ $evaluate->product_id }}</td>
                                    <td>{{ $evaluate->content }}</td>
                                    <td>{{ $evaluate->status }}</td>
                                    <td>
                                        <a href="{{ route('seller.evaluates.detail', $evaluate->id) }}"
                                           class="btn btn-primary">Chi tiết</a>
                                        <form action="{{ route('seller.evaluates.delete', $evaluate->id) }}"
                                              method="POST"
                                              style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
