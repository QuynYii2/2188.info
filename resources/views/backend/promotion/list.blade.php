@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Danh sách khuyến mãi') }}</h5>
            <a href="{{ route('seller.promotion.create.process') }}" class="btn btn-primary">{{ __('home.thêm mới') }}</a>
        </div>
        @if($promotions->isEmpty())
            {{ __('home.không có khuyến mãi nào được tạo') }}
        @else
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th>{{ __('home.Tên khuyến mãi') }}</th>
                        <th>{{ __('home.Mã') }}</th>
                        <th>{{ __('home.Phần trăm giảm giá') }}</th>
                        <th>{{ __('home.Áp dụng') }}</th>
                        <th>{{ __('home.ngày bắt đầu') }}</th>
                        <th>{{ __('home.ngày hết hạn') }}</th>
                        <th>{{ __('home.Trạng thái') }}</th>
                        <th>{{ __('home.Thêm') }}</th>
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
                                        {{ __('home.Xoá khuyến mãi') }}
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
@endsection
