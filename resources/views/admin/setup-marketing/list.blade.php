@extends('backend.layouts.master')
@section('title', 'List Config')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">List Setup Marketing</h5>
            <a href="{{ route('create-setup-marketing') }}" class="btn btn-primary">Thêm mới</a>
        </div>
        @if($setups->isEmpty())
            Không có configs nào được tạo
        @else
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Location</th>
                        <th scope="col">Name</th>
                        <th scope="col">Operation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$setups->isEmpty())
                        @foreach($setups as $setup)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$setup->stt}}</td>
                                <td>{{$setup->name}}</td>
                                <td>
                                    <form method="post" action="{{route('setup-marketing.delete', $setup->id)}}">
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
        @endif
    </div>
@endsection
