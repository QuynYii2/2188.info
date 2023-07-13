@extends('backend.layouts.master')
@section('title', 'List Top Seller')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách top seller</h5>
            @if(!$configs)
                <a href="{{ route('seller.config.processCreate') }}" class="btn btn-primary">Thêm mới</a>
            @endif
        </div>
        @if(!$configs)
            Không có configs nào được tạo
        @else
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th>Thumbnail banner</th>
                        <th>Url redirect</th>
                        <th>Thêm</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="">1</td>
                        <td>
                            <img src="{{ asset('storage/'.$configs->thumbnail) }}" class="img img-100"
                                 alt="Thumbnail">
                        </td>
                        <td class="">
                            @php
                                if ($configs->url != 0){
                                    $category = \App\Models\Category::find($configs->url);
                                }
                            @endphp
                            @if($configs->url == 0)
                               Your Shop
                            @else
                                Your category: {{$category->name}}
                            @endif
                        </td>
                        <td>
                            <form method="post" action="{{route('seller.config.delete', $configs->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    Xoá
                                </button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
