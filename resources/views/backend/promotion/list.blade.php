@php

        @endphp
@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách khuyến mãi</h5>
            <a href="{{ route('seller.promotion.create.process') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        @if($promotions->isEmpty())
            Không có khuyến mãi nào được tạo
        @else
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th>Tên khuyến mãi</th>
                        <th>Mã</th>
                        <th>Phần trăm giảm giá</th>
                        <th>Áp dụng</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày hết hạn</th>
                        <th>Trạng thái</th>
                        <th>Thêm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($promotions as $promotion)
                        <tr>
                            <td class="">{{ $loop->index + 1 }}</td>
                            <td>{{ $promotion->name }}</td>
                            <td class="">{{ $promotion->code }}</td>
                            <td class="">{{ $promotion->percent }}%</td>
                            <td>{{ $promotion->apply }}</td>
                            <td>{{ $promotion->startDate }}</td>
                            <td>{{ $promotion->endDate }}</td>
                            <td>{{ $promotion->status }}</td>
                            <td>
                                <a href="{{route('seller.promotion.detail', $promotion->id)}}" class="btn btn-success">
                                    Detail
                                </a>
                                <form method="post" action="{{route('seller.promotion.delete', $promotion->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Xoá khuyến mãi
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>

    </script>
@endsection
