@php

        @endphp
@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách mã giảm giá</h5>
            <a href="{{ route('seller.vouchers.create.process') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        @if($vouchers->isEmpty())
            Không có voucher nào được tạo
        @else
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th>Tên mã giảm giá</th>
                        <th>Mã</th>
                        <th>Số lượng</th>
                        <th>Phần trăm giảm giá</th>
                        <th>Áp dụng</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày hết hạn</th>
                        <th>Trạng thái</th>
                        <th>Thêm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vouchers as $voucher)
                        <tr>
                            <td class="">{{ $loop->index + 1 }}</td>
                            <td>{{ $voucher->name }}</td>
                            <td class="">{{ $voucher->code }}</td>
                            <td class="">{{ $voucher->quantity }}</td>
                            <td class="">{{ $voucher->percent }}%</td>
                            <td>{{ $voucher->apply }}</td>
                            <td>{{ $voucher->startDate }}</td>
                            <td>{{ $voucher->endDate }}</td>
                            <td>{{ $voucher->status }}</td>
                            <td>
                                <a href="{{route('seller.vouchers.detail', $voucher->id)}}" class="btn btn-success">
                                    Detail
                                </a>
                                <form method="post" action="{{route('seller.vouchers.delete', $voucher->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Xoá mã giảm giá
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
