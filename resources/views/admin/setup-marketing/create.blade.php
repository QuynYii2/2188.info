@extends('backend.layouts.master')
@section('title', 'List Setup Marketing')
@section('content')
    <h3 class="text-center">Create SetUp Marketing</h3>
    <form action="{{route('store-setup-marketing')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="number" min="1" name="location" class="form-control" placeholder={{ __('home.nhập số thứ tự') }} id="location">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder={{ __('home.Nhập tên setup marketing') }}>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection