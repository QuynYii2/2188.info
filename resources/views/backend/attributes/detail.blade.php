@extends('backend.layouts.master')

@section('content')
    <form method="post" action="{{ route('attributes.update', $attribute->id) }}">
        @csrf
        <div class="form-group">
            <label for="name">Tên biến thể</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$attribute->name}}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
