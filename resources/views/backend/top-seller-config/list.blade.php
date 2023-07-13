@extends('backend.layouts.master')
@section('title', 'List Top Seller')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách marketing</h5>
            <a href="{{ route('seller.config.processCreate') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        @if($configs->isEmpty())
            Không có configs nào được tạo
        @else
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Thumbnail banner</th>
                        <th>Location</th>
                        <th>Url redirect</th>
                        <th>Thêm</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($configs as $config)
                        <tr>
                            <td class="">{{$loop->index + 1}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$config->thumbnail) }}" class="img img-100"
                                     alt="Thumbnail">
                            </td>
                            <td>
                               Location: {{$config->local}}
                            </td>
                            <td class="">
                                @php
                                    if ($config->url != 0){
                                        $category = \App\Models\Category::find($config->url);
                                    }
                                @endphp
                                @if($config->url == 0)
                                    Your Shop
                                @else
                                    Your category: {{$category->name}}
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{route('seller.config.delete', $config->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Xoá
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
