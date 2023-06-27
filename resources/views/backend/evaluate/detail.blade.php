@extends('backend.layouts.master')

@section('content')
    <div class="container p-0 m-0 evaluate-detail" style="height: 100vh">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Chỉnh sửa trạng thái Đánh giá</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('seller.evaluates.update', $evaluate->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="{{ $evaluate->username }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="name">ID product</label>
                        <input type="text" class="form-control" id="product_id" name="product_id"
                               value="{{ $evaluate->product_id }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="name">Content</label>
                        <input type="text" class="form-control" id="content" name="content"
                               value="{{ $evaluate->content }}"
                               disabled>
                    </div>

                    <div class="form-group">
                        <label for="parent">Status</label>
                        <select class="form-select" id="status" name="status">
                            @if($evaluate->status == \App\Enums\EvaluateProductStatus::APPROVED)
                                <option value="{{\App\Enums\EvaluateProductStatus::APPROVED}}">{{\App\Enums\EvaluateProductStatus::APPROVED}}</option>
                                <option value="{{\App\Enums\EvaluateProductStatus::PENDING}}">{{\App\Enums\EvaluateProductStatus::PENDING}}</option>
                                <option value="{{\App\Enums\EvaluateProductStatus::REFUSE}}">{{\App\Enums\EvaluateProductStatus::REFUSE}}</option>
                            @elseif($evaluate->status == \App\Enums\EvaluateProductStatus::PENDING)
                                <option value="{{\App\Enums\EvaluateProductStatus::PENDING}}">{{\App\Enums\EvaluateProductStatus::PENDING}}</option>
                                <option value="{{\App\Enums\EvaluateProductStatus::APPROVED}}">{{\App\Enums\EvaluateProductStatus::APPROVED}}</option>
                                <option value="{{\App\Enums\EvaluateProductStatus::REFUSE}}">{{\App\Enums\EvaluateProductStatus::REFUSE}}</option>
                            @else
                                <option value="{{\App\Enums\EvaluateProductStatus::REFUSE}}">{{\App\Enums\EvaluateProductStatus::REFUSE}}</option>
                                <option value="{{\App\Enums\EvaluateProductStatus::APPROVED}}">{{\App\Enums\EvaluateProductStatus::APPROVED}}</option>
                                <option value="{{\App\Enums\EvaluateProductStatus::PENDING}}">{{\App\Enums\EvaluateProductStatus::PENDING}}</option>
                            @endif
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="{{ route('seller.evaluates.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
@endsection
