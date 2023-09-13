@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.danh sách sale') }}</h5>
            <a href="{{ route('seller.rank.setup.processCreate') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        @if($rankSellers->isEmpty())
            {{ __('home.Không có rank nào được tạo') }}
        @else
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>{{ __('home.Mã') }}</th>
                        <th>{{ __('home.Phần trăm giảm giá') }}</th>
                        <th>{{ __('home.Áp dụng') }}</th>
                        <th>{{ __('home.Thêm') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rankSellers as $rankSeller)
                        <tr>
                            <td class="">{{ $loop->index + 1 }}</td>
                            <td class="">{{ $rankSeller->code }}</td>
                            <td class="">{{ $rankSeller->percent }}%</td>
                            <td>{{ $rankSeller->apply }}</td>
                            <td>
                                <a href="{{route('seller.rank.setup.detail', $rankSeller->id)}}" class="btn btn-success">
                                    Detail
                                </a>
                                <form method="post" action="{{route('seller.rank.setup.delete', $rankSeller->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        {{ __('home.Xoá rank') }}
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
