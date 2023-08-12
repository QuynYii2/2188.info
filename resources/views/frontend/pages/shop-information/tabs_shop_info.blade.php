
    <div class="title-information">
        <div class="title-information-container">Hồ sơ</div>
        <div class="title-information-download">
            <a href="">Tải xuống báo cáo</a></div>
    </div>
    <dl>
        <dt>
            <span>Tổng quan</span>
        </dt>
        <dd>
            <div>
                <div>
                    <span>Ngày đăng ký công ty</span>
                    <strong>{{ \Carbon\Carbon::parse($shopInformation->created_at)->format('d/m/Y') }}</strong>
                </div>
                <div>
                    <span>Diện tích sàn(㎡)</span>
                    <strong>{{$shopInformation->acreage}}</strong>
                </div>
                <div>
                    <span>Doanh thu xuất khẩu hàng năm (USD)</span>
                    <strong>1644968</strong>
                </div>
                <div>
                    <span>Ngôn ngữ được chấp nhận</span>
                    <strong>{{$shopInformation->country}}</strong>
                </div>
                <div>
                    <span>Năm xuất khẩu</span>
                    <strong>{{$shopInformation->industry_year}}</strong>
                </div>
                <div>
                    <span>Năm trong ngành</span>
                    <strong>{{$shopInformation->industry_year}}</strong>
                </div>
            </div>
        </dd>
        <dt>
            <span>Chứng nhận</span>
        </dt>
        <dd>
            {{$shopInformation->business_license}}
        </dd>
        <dt>Khả năng sản xuất</dt>
        <dd>
            <div>
                <div>
                    <span>Dây chuyền sản xuất</span>
                    <strong>{{$shopInformation->machine_number}}</strong>
                </div>
                <div>
                    <span>Tổng sản lượng hằng năm(đơn vị)</span>
                    <strong>{{$shopInformation->annual_output}}</strong>
                </div>
                <div>
                    <span>Máy móc sản xuất</span>
                    <strong>{{$shopInformation->machine_number}}</strong>
                </div>
            </div>
        </dd>
        <dt>kiểm soát chất lượng</dt>
        <dd>
            <div>
                <div>
                    <span>Sản phẩm Hỗ trợ truy xuất nguồn gốc nguyên liệu</span>
                    <strong>Đúng</strong>
                </div>
                <div>
                    <span>Phương pháp kiểm tra sản phẩm</span>
                    <strong>{{$shopInformation->test_method}}</strong>
                </div>
                <div>
                    <span>Kiểm soát chất lượng được thực hiện trên tất cả các dây chuyền sản xuất</span>
                    <strong>Đúng</strong>
                </div>
                <div>
                    <span>Nhân viên kiểm tra QA/QC</span>
                    <strong>{{$shopInformation->inspection_staff}}</strong>
                </div>
            </div>
        </dd>
        <dt>nền thương mại</dt>
        <dd>
            <div>
                <div>
                    <span>Thị trường chính</span>
                    <strong>{{$shopInformation->marketing}}</strong>
                </div>
                <div>
                    <span>Đối tác chuỗi cung ứng</span>
                    <strong>10</strong>
                </div>
                <div>
                    <span>Các loại khách hàng chính</span>
                    <strong>{{$shopInformation->customers}}t</strong>
                </div>
            </div>
        </dd>
        <dt>năng lực R&D</dt>
        <dd>
            <div>
                <div>
                    <span>tùy chọn tùy chỉnh</span>
                    <strong>tùy chỉnh ánh sáng, xử lý mẫu, xử lý đồ họa, tùy chỉnh theo yêu cầu, tùy chỉnh ánh sáng, xử
                        lý
                        mẫu, xử lý đồ họa, tùy chỉnh theo yêu cầu
                    </strong>
                </div>
                <div>
                    <span>Sản phẩm mới ra mắt trong năm ngoái</span>
                    <strong>40</strong>
                </div>
                <div>
                    <span>kỹ sư R&D</span>
                    <strong>2</strong>
                </div>
                <div>
                    <span>Trình độ học vấn kỹ sư R&D</span>
                    <strong>1 tốt nghiệp, 1 cao đẳng</strong>
                </div>
            </div>
        </dd>
    </dl>

