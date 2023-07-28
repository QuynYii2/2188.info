@php
    use Illuminate\Support\Facades\DB;

    if (auth()->check() != null){
        $roleUsers = DB::table('role_user')
        ->where([['user_id', Auth::user()->id], ['role_id', 1]])
        ->get();
    } else {
        $roleUsers[] = null;
    }

    use Illuminate\Support\Facades\Auth;
    use App\Enums\PermissionUserStatus;

    if (auth()->check() != null){
        $permissionUsers = DB::table('permissions')
        ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
        ->where([['permission_user.user_id', Auth::user()->id], ['permission_user.status', PermissionUserStatus::ACTIVE]])
        ->select('permissions.*')
        ->get();
    } else {
        $permissionUsers= null;
    }
    $check_ctv_shop = DB::table('staff_users')->where('user_id', Auth::user()->id)->first();

@endphp
<div class='wrapper text-nowrap'>
    <ul class='items'>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-truck"></i> Vận chuyển</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Quản Lý Vận Chuyển</a>
                </li>
                <li><a href="#">Giao Hàng Loạt</a>
                </li>
                <li><a href="#">Cài Đặt Vận Chuyển</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-list-check"></i> Quản Lý Đơn Hàng</a>
            <ul class='sub-items pl-3'>
                <li><a href="{{route('seller.order.list')}}">Tất cả</a>
                </li>
                <li><a href="#">Đơn Huỷ</a>
                </li>
                <li><a href="#">Trả Hàng/Hoàn Tiền</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-bars-progress"></i> Quản Lý Sản Phẩm</a>
            <ul class='sub-items pl-3'>
                <li><a href="/products">Tất Cả Sản Phẩm</a>
                </li>
                @if(!$check_ctv_shop)
                    <li><a href="/products/create">Thêm mới sản phẩm</a>
                    </li>
                @endif
                <li><a href="{{route('seller.products.views')}}">Sắp xếp theo lượt xem</a>
                </li>
                <li><a href="/categories">Chuyên mục</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href="#"><i class="fa-regular fa-clipboard"></i> Quản lí thuộc tính</a>
            <ul class='sub-items pl-3'>

                <li><a href="{{route('attributes.index')}}">Danh sách thuộc tính</a>
                </li>
                <li><a href="{{route('properties.index')}}">Quản lí thuộc tính con</a>
                </li>
            </ul>
        </li>
        @if(!$check_ctv_shop)
            @if($permissionUsers)
                @for($i = 0; $i< count($permissionUsers); $i++)
                    @if($permissionUsers[$i]->name == 'Nâng cấp thành top-seller' || sizeof($roleUsers) != 0)
                        <li>
                            <a class="item" href='#'><i class="fa-solid fa-tag"></i> Kênh Marketing</a>
                            <ul class='sub-items pl-3'>
                                <li><a href="{{route('seller.config.show')}}">Quản Lí Marketing</a>
                                </li>
                                <li><a href="#">Quảng Cáo Shopee</a>
                                </li>
                                <li><a href="#">Mã Giảm Giá Của Tôi</a>
                                </li>
                                <li><a href="#">Tăng Đơn Cùng KOL</a>
                                </li>
                                <li><a href="#">Hiệu Quả Shopee Live</a>
                                </li>
                            </ul>
                        </li>
                        @break
                    @endif
                @endfor
            @endif
        <li>
            <a class="item" href='#'><i class="fa-solid fa-book"></i> Tài Chính</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Doanh Thu</a>
                </li>
                <li><a href="#">Số dư TK Shopee</a>
                </li>
                <li><a href="#">Tài Khoản Ngân Hàng</a>
                </li>
                <li><a href="#">Cài Đặt Thanh Toán</a>
                </li>
            </ul>
        </li>

        @if(!$check_ctv_shop)
            <li>
                <a class="item" href='#'><i class="fa-solid fa-chart-line"></i> Dữ Liệu</a>
                <ul class='sub-items pl-3'>
                    <li><a href="#">Phân Tích Bán Hàng</a>
                    </li>
                    <li><a href="{{route('revenues.index')}}">Quản lý doanh thu</a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <a class="item" href='#'><i class="fa-solid fa-layer-group"></i> Phát Triển</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Nhiệm Vụ Người Bán</a>
                </li>
                <li><a href="#">Shop Yêu Thích</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-headset"></i> Chăm sóc khách hàng</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Trợ Lý Chat</a>
                </li>
                <li><a href="#">Hỏi - Đáp</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-shop"></i> Quản Lý Shop</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Đánh Giá Shop</a>
                </li>
                <li><a href="#">Hồ Sơ Shop</a>
                </li>
                <li><a href="#">Trang Trí Shop</a>
                </li>
                <li><a href="#">Danh Mục Của Shop</a>
                </li>
                <li><a href="#">Kho Hình Ảnh/Video</a>
                </li>
                <li><a href="#">Báo Cáo Của Tôi</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-gear"></i> Thiết Lập Shop</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Địa Chỉ</a>
                </li>
                <li><a href="#">Thiết Lập Shop</a>
                </li>
                <li><a href="#">Tài Khoản</a>
                </li>
                <li><a href="#">Nền Tảng Đối Tác (Kết nối API)</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href='#'><i class="fa-solid fa-circle-question"></i> Trợ giúp</a>
            <ul class='sub-items pl-3'>
                <li><a href="#">Cổng Thông Tin Hỗ Trợ Người Bán </a>
                </li>
            </ul>
        </li>







        <li>
            <a class="item" href="#!">Quản lý kho</a>
            <ul class='sub-items pl-3'>
                <li>
                    <a href='{{ route('storage.manage.show.user') }}'>Thông tin kho hàng</a>
                </li>
                @if(!$check_ctv_shop)
                    <li>
                        <a href='{{ route('storage.manage.create') }}'>Thêm mới nhập kho</a>
                    </li>
                    @if(sizeof($roleUsers) != 0)
                        <li>
                            <a href='{{ route('storage.manage.show.all') }}'>Tất cả kho hàng</a>
                        </li>
                    @endif
                @endif
            </ul>
        </li>
        <li>
            <a class="item" href='#'>Quản lý tài khoản cấp dưới</a>
            <ul class='sub-items pl-3'>
                <li>
                    <a href='{{ route('staff.manage.show') }}'>Danh sách tài khoản cấp dưới</a>
                </li>
                @if(!$check_ctv_shop)
                    <li>
                        <a href='{{ route('staff.manage.create') }}'>Thêm mới cấp dưới</a>
                    </li>
                @endif

            </ul>
        </li>
        <li>
            <a class="item" href="#!"><span>Thống kê</span></a>
            <ul class='sub-items pl-3'>
                <li><a href="#!">Chartjs</a>
                </li>
                <li><a href="#!">Morris</a>
                </li>
                <li><a href="#!">C3 Charts</a></li>
            </ul>
        </li>
        <li>
            <a class="item" href="{{route('seller.products.views')}}">Sản phẩm xem nhiều nhất</a>
        </li>
        <li>
            <a class="item" href="#!"><span>Quản lý bình luận</span></a>
            <ul class='sub-items pl-3'>
                <li><a href="{{route('seller.evaluates.index')}}">List Evaluate</a></li>
            </ul>
        </li>
        <li>
            <a class="item" href="#!"><span>Quản lý mã giảm giá</span></a>
            <ul class='sub-items'>
                <li>
                    <a href="{{route('seller.vouchers.list')}}">List Vouchers</a>
                </li>
                <li>
                    <a href="{{route('seller.vouchers.create.process')}}">Create Voucher</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="item" href="#!"><span>Quản lý khuyến mãi</span></a>
            <ul class='sub-items'>
                <li>
                    <a href="{{route('seller.promotion.list')}}">List Promotion</a>
                </li>
                <li>
                    <a href="{{route('seller.promotion.create.process')}}">Create Promotion</a>
                </li>
            </ul>
        </li>

        @if(sizeof($roleUsers) != 0)
            <li>
                <a class="item" href="#!"><span>Quản lý tài khoản</span></a>
                <ul class='sub-items'>
                    <li>
                        <a href="{{route('account.manage.show')}}">Danh sách tài khoản</a>
                    </li>
                    <li>
                        <a href="{{route('seller.promotion.create.process')}}">Create Promotion</a>
                    </li>
                </ul>
            </li>
        @endif
        @php
            $check = true;
            if (Auth::check()){
                $rank = \App\Models\RankSetUpSeller::where('user_id', Auth::user()->id)->first();
            if ($rank){
                $check = false;
            }
            }
        @endphp
        @if(!$check_ctv_shop)
            <li>
                <a class="item" href="#!"><span>Quản lý phân hạng thành viên</span></a>
                <ul class='sub-items'>
                    <li>
                        <a href="{{route('seller.rank.setup.show')}}">Danh sách giảm giá theo hạng</a>
                    </li>
                    <li>
                        <a href="{{route('seller.rank.setup.processCreate')}}">Tạo mới mức giảm giá theo
                            hạng</a>
                    </li>
                    <li>
                        <a href="{{route('seller.setup.show')}}">Quản lí phân hạng</a>
                    </li>
                    @if($check === true)
                        <li>
                            <a href="{{route('seller.setup.processCreate')}}">Tạo mới phân hạng</a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif

            @if(sizeof($roleUsers) != 0)
                <li>
                    <a href="#!" class="item"><span>Cấu hình dự án</span></a>
                    <ul class='sub-items'>
                        <li>
                            <a href="{{route('admin.configs.show')}}">Danh sách cấu hình</a>
                        </li>
                        <li>
                            <a href="{{route('admin.configs.processCreate')}}">Thiết lập cấu hình</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!" class="item"><span>Cài đặt banner</span></a>
                    <ul class='sub-items'>
                        <li>
                            <a href="{{route('admin.banners.show')}}">Danh sách banner</a>
                        </li>
                        <li>
                            <a href="{{route('admin.banners.processCreate')}}">Thiết lập banner mới</a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif
    </ul>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(".items > li > a").click(function (e) {
        e.preventDefault();
        var $this = $(this);
        if ($this.hasClass("expanded")) {
            $this.removeClass("expanded");
        } else {
            $(".items a.expanded").removeClass("expanded");
            $this.addClass("expanded");
            $(".sub-items").filter(":visible").slideUp("normal");
        }
        $this.parent().children("ul").stop(true, true).slideToggle("normal");
    });

    $(".sub-items a").click(function () {
        $(".sub-items a").removeClass("current");
        $(this).addClass("current");
    });
</script>