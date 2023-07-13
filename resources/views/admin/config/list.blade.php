@extends('backend.layouts.master')
@section('title', 'List Config')
@section('content')
    <h3 class="text-center">List Config</h3>
    <div class="card">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Logo</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($configs as $config)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$config->email}}</td>
                    <td>{{$config->phone}}</td>
                    <td>{{$config->address}}</td>
                    <td>
                        <img class="img img-100" src="{{ asset('storage/'.$config->logo) }}" alt="Thumbnail">
                    </td>
                    <td>{{$config->status}}</td>
                    <td>
                        <a href="{{route('admin.configs.detail', $config->id)}}" class="btn btn-secondary">Detail</a>
                        <form method="post" action="{{route('admin.configs.delete', $config->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
