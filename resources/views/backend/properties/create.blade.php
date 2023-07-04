@extends('backend.layouts.master')

@section('content')
    <div class="mt-3 p-2">
        <div class="">
            <h5>Tạo mới thuộc tính con</h5>
        </div>
        <form method="POST" action="{{ route('properties.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Tên thuộc tính</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cars">Chọn thuộc tính cha:</label>
                        <select class="form-control" id="cars" name="attribute_id">
                            @foreach($attributes as $attribute)
                                <option value="{{$attribute->id}}">{{$attribute->id}} - {{$attribute->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Tạo mới</button>
                </form>
    </div>

@endsection
