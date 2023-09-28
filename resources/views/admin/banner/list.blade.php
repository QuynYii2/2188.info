@extends('backend.layouts.master')
@section('title', 'List Banner Setup')
@section('content')
    <h3 class="text-center">List Banner Setup</h3>
    <a href="{{ route('admin.banners.processCreate') }}" class="btn btn-success">{{ __('home.thêm mới') }}</a>
    <div class="card">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('home.thumbnail') }}</th>
                <th scope="col">Sub thumbnails</th>
                <th scope="col">{{ __('home.Status') }}</th>
                <th scope="col">{{ __('home.Action') }}</th>
            </tr>
            </thead>
            <tbody>
            @if(!$banners->isEmpty())
                @foreach($banners as $banner)
                    <tr>
                        <th scope="row">{{$loop->index +1}}</th>
                        <td>
                            @php
                                $thumbnails = $banner->thumbnails;
                                $thumbnails = explode(',', $thumbnails);
                            @endphp
                            @for($i = 0; $i<count($thumbnails); $i++)
                                <div style="width: 200px; height: 200px; margin-top: 10px">
                                    <img class="img" style="width: 100%; height: 100%; object-fit: cover" src="{{ asset('storage/'.$thumbnails[$i]) }}" alt="Thumbnail">
                                </div>
                            @endfor
                        </td>
                        <td>
                            @php
                                $sub_thumbnails = $banner->sub_thumbnails;
                                $sub_thumbnails = explode(',', $sub_thumbnails);
                            @endphp
                            @for($i = 0; $i<count($sub_thumbnails); $i++)
                                <div style="width: 200px; height: 200px; margin-top: 10px">
                                    <img style="width: 100%; height: 100%; object-fit: cover" class="img" src="{{ asset('storage/'.$sub_thumbnails[$i]) }}"
                                         alt="Thumbnail">
                                </div>
                            @endfor
                        </td>
                        <td id="status{{$banner->id}}">{{$banner->status}}</td>
                        <td>
                            <form method="post" action="{{route('admin.banners.delete', $banner->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
