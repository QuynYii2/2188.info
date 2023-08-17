@extends('frontend.layouts.master')
@section('title', 'Parter Register Members')
@section('content')
    <div class="container-fluid">
        <h3 class="text-center">Danh sách đối tác</h3>
        <div class="border d-flex justify-content-between align-items-center bg-warning p-5">
            <h5>{{$company->name}}</h5>
            <div class="">
                <span>ID</span>: {{$company->id}}
            </div>
            <div class="">
                <span>Phân loại hội viên</span>: {{$company->member}}
            </div>
            <div class="">
                <span>Cấp bậc hội viên</span>: {{$company->member}}
            </div>
            <div class="">
                <span>Đánh giá của khách hàng</span>
            </div>
        </div>
        @php
            $listCategory = $company->category_id;
            $arrayCategory  = explode(',', $listCategory);
        @endphp
        <div class="row">
            <div class="col-md-4 border ml-3">
                <div class="row text-center">
                    @foreach($arrayCategory as $itemCategory)
                        @php
                            $category = \App\Models\Category::find($itemCategory);
                        @endphp
                        <div class="col-md-6">
                            {{$category->name}}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8 border mr-3">

            </div>
        </div>
        <div class="border d-flex justify-content-between align-items-center p-5">
            <a href="{{route('products.register.member.index')}}" class="btn btn-primary">Gian hàng</a>
            <a href="#" class="btn btn-warning">Danh sách đối tác</a>
            <a href="#" class="btn btn-primary">Văn bản đã nhận</a>
            <a href="#" class="btn btn-warning">Văn bản đã kí</a>
            <a href="#" class="btn btn-primary">Mua hàng</a>
            <a href="#" class="btn btn-warning">Đặt sỉ nước ngoài</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Mã khách hàng</th>
                <th scope="col">Quốc gia</th>
                <th scope="col">Tên công ty</th>
                <th scope="col">Khu vực</th>
                <th scope="col">Ngày giao dịch</th>
                <th scope="col">Giá trị giao dịch</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Phân loại hội viên</th>
                <th scope="col">Cấp bậc khách hàng</th>
            </tr>
            </thead>
            <tbody>
            @if(!$carts->isEmpty())
                @foreach($carts as $cartsMemberItem)
                    <tr>
                        <td scope="row">{{$cartsMemberItem->id}}</td>
                        <td>
                            @php
                                $address = $cartsMemberItem->address;
                            @endphp
                            {{$address}}
                        </td>
                        <td>{{$cartsMemberItem->name}}</td>
                        <td>{{$address}}</td>
                        <td>{{ \Carbon\Carbon::parse($cartsMemberItem->created_at)->format('d/m/Y') }}</td>
                        <td>{{$cartsMemberItem->price * $cartsMemberItem->quantity}}</td>
                        <td>{{$cartsMemberItem->quantity}}</td>
                        <td>{{$cartsMemberItem->member}}</td>
                        <td>
                            <i class="fa-solid fa-trophy"></i>
                            <i class="fa-solid fa-trophy"></i>
                            <i class="fa-solid fa-trophy"></i>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection