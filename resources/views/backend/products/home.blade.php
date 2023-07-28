@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <div class="todo_list">
            <div class="title">Danh sách cần làm</div>
            <div class="title-small">Những việc cần phải làm</div>
            <div class="row mt-4 todo_list--bottom">
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p>Chờ xác nhận</p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p> Chờ Lấy Hàng </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p> Đã Xử Lý </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p> Đơn Hủy </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p> Trả Hàng / Hoàn Tiền Chờ Xử Lý </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p> Sản Phẩm Bị Tạm Khóa </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p> Sản Phẩm Hết Hàng </p>
                </div>
                <div class="col-md-3 col-6 list_item">
                    <span class="number">0</span>
                    <p>Chương Trình Khuyến Mãi Chờ Xử Lý</p>
                </div>
            </div>
        </div>
        <div class="todo_list">
            <div class="title">Kênh Marketing</div>
            <div class="title-small">Công cụ Marketing & Đăng ký chương trình Khuyến Mãi</div>
            <div class="row mt-4 todo_list--bottom">
                <a href="#" class="col-md-4 marketing list_item">
                    <div class="list_item--top">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-seller-live-sg/rootpages/static/modules/marketing/module-icons/voucher.png" alt="">
                        <p>Mã Giảm Giá Của Shop</p>
                    </div>
                    <div class="list_item--bottom">
                        <p>Công cụ tăng đơn hàng bằng cách tạo mã giảm giá tặng cho người mua</p>
                    </div>
                </a>
                <a href="#" class="col-md-4 marketing list_item">
                    <div class="list_item--top">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-seller-live-sg/rootpages/static/modules/marketing/module-icons/discount.png" alt="">
                        <p> Chương Trình Của Shop </p>
                    </div>
                    <div class="list_item--bottom">
                        <p>Công cụ tăng đơn hàng bằng cách tạo chương trình giảm giá</p>
                    </div>
                </a>
                <a href="#" class="col-md-4 marketing list_item">
                    <div class="list_item--top">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-seller-live-sg/rootpages/static/modules/marketing/module-icons/bundle.png" alt="">
                        <p> Combo Khuyến Mãi </p>
                    </div>
                    <div class="list_item--bottom">
                        <p>Tạo Combo Khuyến Mãi để tăng giá trị đơn hàng trên mỗi Người mua</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="todo_list mb-5">
            <div class="title">Hiệu Quả Hoạt Động</div>
            <div class="title-small">Bảng Hiệu Quả Hoạt Động giúp Người Bán hiểu rõ hơn về hoạt động buôn bán của Shop mình dựa trên những chỉ tiêu sau:</div>
            <ul class="nav" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Vi phạm về đăng bán
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Quản Lý Đơn Hàng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                        Chăm sóc khách hàng
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col-4">Tiêu Chí</th>
                            <th scope="col-4">Shop của tôi</th>
                            <th scope="col-4">Chỉ tiêu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Sản phẩm bị khóa/xóa</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Tỉ lệ hàng đặt trước</td>
                            <td>0.00%</td>
                            <td>≤10.00%</td>
                        </tr>
                        <tr>
                            <td>Các vi phạm khác</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col-4">Tiêu Chí</th>
                            <th scope="col-4">Shop của tôi</th>
                            <th scope="col-4">Chỉ tiêu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Tỉ lệ đơn không thành công</td>
                            <td>-</td>
                            <td><10.00%</td>
                        </tr>
                        <tr>
                            <td>Tỉ lệ hàng đặt trước</td>
                            <td>-</td>
                            <td><10.00%</td>
                        </tr>
                        <tr>
                            <td>Thời gian chuẩn bị hàng</td>
                            <td>-</td>
                            <td><1.50 days</td>
                        </tr>
                        </tbody>
                    </table></div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col-4">Tiêu Chí</th>
                            <th scope="col-4">Shop của tôi</th>
                            <th scope="col-4">Chỉ tiêu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Tỉ lệ phản hồi</td>
                            <td>57.00%</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Thời gian phản hồi</td>
                            <td>≥80.00%</td>
                            <td><0.50 days</td>
                        </tr>
                        </tbody>
                    </table></div>
            </div>
        </div>
    </div>
@endsection