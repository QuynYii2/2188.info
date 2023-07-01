@extends('backend.layouts.master')

@section('content')
    <style>
        .table th {
            white-space: nowrap;
        }
    </style>
    <div class="card-header" style="margin-top: 60px">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Danh sách Categories</h5>
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#flipFlop">
                Tạo mới
            </button>
        </div>
        <!-- The modal -->
        <div class="modal" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <form action="{{ route('seller.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLabel">Tạo mới Categories</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="control-label">Tên</label>
                                <div class="">
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Nhập tên sản phẩm">
                                    <small>The name is how it appears on your site.</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="slug" class="control-label">Đường dẫn</label>
                                <div class="">
                                    <input type="text" class="form-control" name="slug" id="slug"
                                           placeholder="Nhập tên sản phẩm">
                                    <small>"slug" là đường dẫn thân thiện của tên. Nó thường chỉ bao gồm kí tự viết
                                        thường, số
                                        và dấu gạch ngangm không dùng tiếng Việt</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="parent_id" class="control-label">Chuyên mục cha</label>
                                <div class="">
                                    <select class="form-control" name="parent_id" id="parent_id">
                                        <option value="">Trống</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <small>Chuyên mục khác với thẻ, bạn có thể sử dụng nhiều cấp chuyên mục.</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label">Mô tả</label>
                                <div class="">
                            <textarea type="text" class="form-control" name="description" id="description"
                                      placeholder="Nhập tên sản phẩm"></textarea>
                                    <small>The description is not prominent by default; however, some themes may show
                                        it.</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Tạo mới</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success_update_cat'))
            <div class="alert alert-success">
                {{ session('success_update_cat') }}
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Danh mục cha</th>
                    <th>Mô tả</th>
                    <th>Số bài viết</th>
                    <th class="text-center">Thao tác</th>
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
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('seller.categories.edit', $category->id) }}"><i
                                        style="color: black; margin-right: 15px" class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('seller.categories.destroy', $category->id) }}" method="POST"
                                  style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <a href="#" onclick="clickBtn({{$category->id}})"><i style="color: #d52727" class="fa-solid fa-trash-can"></i></a>
                                <button id="btn-delete-category-{{$category->id}}" hidden type="submit"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    Xoa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script>
        function clickBtn(id) {
            document.getElementById('btn-delete-category-' + id).click();
        }
    </script>
    <script>
        // Lấy tham chiếu đến ô checkbox "select-all"
        const selectAllCheckbox = document.getElementById('select-all');

        // Lấy tất cả các ô checkbox trong tbody
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');

        // Thêm sự kiện "click" vào ô checkbox "select-all"
        selectAllCheckbox.addEventListener('click', function () {
            // Lặp qua tất cả các ô checkbox và thiết lập trạng thái tích chọn tương ứng
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('click', function () {
                // Kiểm tra nếu có ít nhất một ô checkbox không được tích chọn
                const isAnyCheckboxUnchecked = Array.from(checkboxes).some(function (checkbox) {
                    return !checkbox.checked;
                });

                // Cập nhật trạng thái của ô checkbox "select-all" dựa trên kết quả kiểm tra
                selectAllCheckbox.checked = !isAnyCheckboxUnchecked;
            });
        });
    </script>
@endsection
