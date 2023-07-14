@extends('backend.layouts.master')
@section('title', 'Detail Config')
@section('content')
    <h3 class="text-center">Detail Config</h3>
    <div class="card">
        <form action="{{route('admin.configs.update', $config->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                           value="{{$config->email}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phoneNumber">PhoneNumber</label>
                    <input type="text" class="form-control" name="phone" id="phoneNumber" placeholder="PhoneNumber"
                           value="{{$config->phone}}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St"
                       value="{{$config->address}}" required>
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                <img class="img img-100" src="{{ asset('storage/'.$config->logo) }}" alt="Thumbnail">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
