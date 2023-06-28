@extends('backend.layouts.master')

@section('content')
    <form method="POST" action="{{ route('attributes.store') }}">
        @csrf

        <div class="card-header form-group mb-3">
            <label for="name">Tên biến thể</label>
            <input type="text" class="form-control" name="name" id="name" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Tạo mới</button>
    </form>
@endsection
