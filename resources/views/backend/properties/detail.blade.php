@extends('backend.layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="">
            <h5>Sửa thuộc tính con</h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route('properties.update', $propertie->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên thuộc tính</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$propertie->name}}" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cars">Chọn thuộc tính cha:</label>
                        <select class="form-control" id="cars" name="attribute_id">
                            <option value="{{$propertie->attribute->id}}">{{$propertie->attribute->id}} - {{$propertie->attribute->name}}</option>
                            @foreach($attributes as $attribute)
                                @if($attribute->id != $propertie->attribute->id)
                                    <option value="{{$attribute->id}}">{{$attribute->id}} - {{$attribute->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
