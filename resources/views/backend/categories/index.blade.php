@extends('backend.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h5 class="card-title">Danh sách Categories</h5>
            @if (session('success_update_cat'))
                <div class="alert alert-success">
                    {{ session('success_update_cat') }}
                </div>
            @endif
        </div>
        <div class="card-body row">
            <div class="col-md-3">
                <form action="{{ route('seller.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Tên</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm">
                            <small>The name is how it appears on your site.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Đường dẫn</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Nhập tên sản phẩm">
                            <small>"slug" là đường dẫn thân thiện của tên. Nó thường chỉ bao gồm kí tự viết thường, số
                                và dấu gạch ngangm không dùng tiếng Việt</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Chuyên mục cha</label>
                        <div class="col-sm-12">
                            <select class="form-control">
                                <option value="">Trống</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small>Chuyên mục khác với thẻ, bạn có thể sử dụng nhiều cấp chuyên mục.</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Mô tả</label>
                        <div class="col-sm-12">
                        <textarea type="text" class="form-control" name="name" id="name"
                                  placeholder="Nhập tên sản phẩm"></textarea>
                            <small>The description is not prominent by default; however, some themes may show
                                it.</small>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Danh mục cha</th>
                        <th>Mô tả</th>
                        <th>Số bài viết</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td><input type="checkbox" name="category[]" value="{{ $category->id }}"></td>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                            <td>Mô tả</td>
                            <td>10</td>
                            <td>
                                <a href="{{ route('seller.categories.edit', $category->id) }}" class="btn btn-primary">Sửa</a>
                                <form action="{{ route('seller.categories.destroy', $category->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
