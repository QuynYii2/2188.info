@extends('backend.layouts.master')

@section('content')
    <style>
        .table th {
            width: 100%;
            white-space: nowrap;
        }

    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Danh sách sản phẩm') }}</h5>
            @if (session('success_update_product'))
                <div class="alert alert-success">
                    {{ session('success_update_product') }}
                </div>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table  class="table">
                    <thead>
                    <tr>
                        <th>{{ __('home.Tên sản phẩm') }}</th>
                        <th>{{ __('home.Tác giả') }}</th>
                        <th>{{ __('home.chuyên mục') }}</th>
                        <th>{{ __('home.Giá bán') }}</th>
                        <th>{{ __('home.Avatar') }}</th>
                        <th>{{ __('home.Thời gian') }}</th>
                        <th>{{ __('home.Thao tác') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name}}</td>
                            <td></td>
                            <td>{{ $product->category->name}}</td>
                            <td>{{ $product->price }}</td>
                            <td style="width: 100px; height: 100px">
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" style="width: 100%; height: auto" alt="{{ __('home.thumbnail') }}">
                            </td>
                            <td></td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('seller.products.edit', $product->id) }}"><i style="color: black; margin-right: 15px" class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST"
                                      style="">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="clickBtn({{ $product->id}})"><i style="color: #d52727"
                                                                                         class="fa-solid fa-trash-can"></i></a>
                                    <button id="btn-delete-product-{{ $product->id}}" hidden type="submit"
                                            onclick="return confirm({{ __('home.Bạn có chắc chắn muốn xóa?') }})">
                                        {{ __('home.Xoá') }}
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
    <script>
        function clickBtn(id) {
            document.getElementById('btn-delete-product-' + id).click();
        }
    </script>
@endsection
