
@extends('backend.layouts.master')
@section('title', 'Edit Setup Marketing')
@section('content')
    <h3 class="text-center">Edit SetUp Marketing</h3>
    <form action="{{route('setup-marketing.update', $edit_setup->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
            <img style="width: 100px; height: 100px; margin-top: 5px" src="{{asset('storage/'.$edit_setup->thumbnail)}}" alt="">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="number" min="1" name="location" class="form-control" value="{{$edit_setup->stt}}" placeholder="nhập số thứ tự" id="location">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$edit_setup->name}}" placeholder="Nhập tên setup marketing">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection