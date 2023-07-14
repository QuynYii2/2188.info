@extends('backend.layouts.master')
@section('title', 'Create Banner')
@section('content')
    <h3 class="text-center">Create Banner</h3>
    <div class="card">
        <form method="post" action="{{route('admin.banners.create')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="thumbnails">Thumbnails</label>
                <input type="file" class="form-control" id="thumbnails" name="thumbnails[]" multiple required>
            </div>
            <div class="form-group">
                <label for="sub_thumbnails">Support Thumbnails</label>
                <input type="file" class="form-control" id="sub_thumbnails" name="sub_thumbnails[]" multiple required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
