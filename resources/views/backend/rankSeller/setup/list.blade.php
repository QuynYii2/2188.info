@extends('backend.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">{{ __('home.Danh sách setup') }} </h5>
            @php
                $check = true;
                $rank = \App\Models\RankSetUpSeller::where('user_id', Auth::user()->id)->first();
                if ($rank){
                    $check = false;
                }
            @endphp
            @if($check == true)
            <a href="{{ route('seller.setup.processCreate') }}" class="btn btn-primary">{{ __('home.thêm mới') }}</a>
            @endif
        </div>
        @if($rankSetups->isEmpty())
            {{ __('home.Không có rank nào được tạo') }}
        @else
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>{{ __('home.Áp dụng') }}</th>
                        <th>{{ __('home.Thêm') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rankSetups as $rankSetup)
                        <tr>
                            <td class="">{{ $loop->index + 1 }}</td>
                            <td class="">{{ $rankSetup->setup }}</td>
                            <td>
                                <a href="{{route('seller.setup.detail', $rankSetup->id)}}" class="btn btn-success">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endif
    </div>
@endsection
