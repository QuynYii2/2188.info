@extends('backend.layouts.master')
@section('title', 'Create Top Seller')
@section('content')
    <div class="container">
        <h5 class="text-center">Create Top Seller</h5>
        <div class="card p-3">
            <form action="{{route('seller.config.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="thumbnail">Choosing banner...</label>
                    <input type="file" class="form-control-file" accept="image/*" id="thumbnail" name="thumbnail">
                </div>
                <div class="form-group">
                    <label for="select_url">Select products</label>
                    <select class="form-control" name="url_tag" id="select_url">
                        <option value="0">Shop</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="local">Choosing location...</label>
                    <input type="number" min="1" class="form-control" id="local" name="local">
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </div>
@endsection
