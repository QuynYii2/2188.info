@extends('backend.layouts.master')
@section('title', 'List Require')
@section('content')
    <h3 class="text-center">List Require Mail</h3>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Content</th>
                <th scope="col">ProductName</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Product Fn</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mailogs as $mailog)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$mailog->email}}</td>
                    <td>{{$mailog->content}}</td>
                    <td>
                        {{ $mailog->name }}
                    </td>
                    <td>{{$mailog->product_quantity}}</td>
                    <td>{{$mailog->product_fn}}</td>
                    <td>{{$mailog->status}}</td>
                    <td>
                        <form method="post" action="{{route('user.send.mail.delete', $mailog->id)}}">
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
