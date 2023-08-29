@extends('backend.layouts.master')
@section('title', 'List Config')
@section('content')
    <h3 class="text-center">Create SetUp Marketing</h3>
    <form action="{{route('store-setup-marketing')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="location">Location</label>
            <input type="number" min="1" name="location" class="form-control" placeholder="nhập số thứ tự" id="location">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên setup marketing">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection