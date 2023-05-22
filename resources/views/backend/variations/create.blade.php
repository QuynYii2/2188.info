@extends('backend.layouts.master')

@section('content')
    <form method="POST" action="{{ route('variations.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Tên biến thể:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="attribute_id">Thuộc tính:</label>
            <select class="form-control" name="attribute_id" id="attribute_id" required>
                <option value="">Lựa chọn thuộc tính</option>
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                @endforeach
            </select>
            @error('attribute_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo thuộc tính</button>
    </form>
@endsection
