@extends('backend.layouts.master')
@section('title', 'List Config')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">List Setup Marketing</h5>
            <a href="{{ route('create-setup-marketing') }}" class="btn btn-primary">{{ __('home.Thêm mới') }}</a>
        </div>
        @if($setups->isEmpty())
            {{ __('home.Không có configs nào được tạo') }}
        @else
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('home.thumbnail') }}</th>
                        <th scope="col">{{ __('home.location') }}</th>
                        <th scope="col">{{ __('home.Name') }}</th>
                        <th scope="col">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$setups->isEmpty())
                        @foreach($setups as $setup)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <th>
                                    <img width="100" height="100"
                                         src="{{ asset('storage/'.$setup->thumbnail) }}"
                                         class="woocommerce-placeholder wp-post-image" alt="Placeholder"
                                         decoding="async"
                                         loading="lazy">
                                </th>
                                <td>{{$setup->stt}}</td>
                                <td>{{$setup->name}}</td>
                                <td class="d-flex align-items-baseline" data-colname="Image">
                                    <a href="{{route('setup-marketing.edit', $setup->id)}}" style="color: black">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <form method="post" action="{{route('setup-marketing.delete', $setup->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn">
                                            <i class="fa-solid fa-trash-can" style="color: red"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
