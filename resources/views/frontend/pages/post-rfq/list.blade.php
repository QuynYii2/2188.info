@extends('backend.layouts.master')
@section('title', 'List Post')
@section('content')
    <h3 class="text-center">List Post</h3>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ProductName</th>
                <th scope="col">Purchase Quantity</th>
                <th scope="col">Target Price</th>
                <th scope="col">Max Budget</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$post->product_name}}</td>
                    <td>{{$post->purchase_quantity}}</td>
                    <td>{{$post->target_price}}</td>
                    <td>{{$post->max_budget}}</td>
                    <td>{{$post->status}}</td>
                    <td>
                        <a href="{{route('user.post.rfq.detail', $post->id)}}"
                           class="btn btn-secondary">Detail</a>
                        <form method="post" action="{{route('user.post.rfq.delete', $post->id)}}">
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
