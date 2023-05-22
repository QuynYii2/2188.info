@extends('backend.layouts.master')

@section('content')
    <form method="POST" action="{{ route('attributes.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Tên biến thể</label>
            <input type="text" class="form-control" name="name" id="name" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo mới</button>
    </form>
@endsection
