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

     $routeName = \Illuminate\Support\Facades\Route::currentRouteName();

     $isAdmin = (new \App\Http\Controllers\Frontend\HomeController())->checkAdmin();
@endphp
<div class='wrapper text-nowrap'>
    <ul class='items'>
        <li>
            <a class="sidebar item" href='#'><i class="fa-solid fa-truck"></i> {{ __('home.vận chuyển') }}</a>
            <ul class='sub-items pl-3'>
                <li><a class="sidebarUrl" href="#">{{ __('home.quản lý vận chuyển') }}</a>
                </li>
                <li><a class="sidebarUrl" href="#">{{ __('home.giao hàng loạt') }}</a>
                </li>
                <li><a class="sidebarUrl" href="#">{{ __('home.cài đặt vận chuyển') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="sidebar item" href='#'><i class="fa-solid fa-list-check"></i> {{ __('home.quản lý đơn hàng') }}</a>
            <ul class='sub-items pl-3'>
                <li><a class="sidebarUrl" href="{{route('seller.order.list')}}">{{ __('home.Tất cả') }}</a>
                </li>
                <li><a class="sidebarUrl" href="#">{{ __('home.Đơn huỷ') }}</a>
                </li>
                <li><a class="sidebarUrl" href="#">{{ __('home.trả hàng /hoàn tiền') }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="sidebar item" href='#'><i class="fa-solid fa-bars-progress"></i> {{ __('home.quản lý sản phẩm') }}</a>
            <ul class='sub-items pl-3'>
                <li><a class="sidebarUrl" href="/products">{{ __('home.Tất Cả Sản Phẩm') }}</a>
                </li>
                @if(!$check_ctv_shop)
                    <li><a class="sidebarUrl" href="/products/create">{{ __('home.Thêm mới sản phẩm') }}</a>
                    </li>
                @endif
                <li><a class="sidebarUrl" href="{{route('seller.products.views')}}">{{ __('home.Sắp xếp theo lượt xem') }}</a>
                </li>
                @if($isAdmin == true)
                    <li><a class="sidebarUrl" href="/categories">{{ __('home.chuyên mục') }}</a>
                    </li>
                @endif
            </ul>
        </li>
        <li>
            <a class="sidebar item" class="sidebarUrl" href="#"><i class="fa-regular fa-clipboard"></i> {{ __('home.Quản lí thuộc tính') }}
                </a>
            <ul class='sub-items pl-3'>

                <li><a class="sidebarUrl" href="{{route('attributes.index')}}">{{ __('home.Danh sách thuộc tính') }}</a>
                </li>
                <li><a class="sidebarUrl" href="#">{{ __('home.Quản lí thuộc tính con') }}</a>
                </li>
            </ul>
        </li>
                        <li>
                            <a class="sidebar item" href='#'><i class="fa-solid fa-tag"></i>{{ __('home.Kênh Marketing') }} </a>
                            <ul class='sub-items pl-3'>
                                <li><a class="sidebarUrl" href="{{route('seller.config.show')}}">{{ __('home.Quản Lí Marketing') }}</a>
                                </li>
                                <li><a class="sidebarUrl" href="{{route('setup-marketing.show')}}">{{ __('home.Setup Marketing') }}</a>
                                </li>
                                <li>
                                    <a class="sidebarUrl" href="{{route('seller.vouchers.list')}}">{{ __('home.Mã Giảm Giá') }}</a>
                                </li>
                                <li>
                                    <a class="sidebarUrl" href="{{route('seller.vouchers.create.process')}}">{{ __('home.Tạo Mã Giảm Giá') }}</a>
                                </li>
                                <li>
                                    <a class="sidebarUrl" href="{{route('seller.promotion.list')}}">{{ __('home.Danh sách khuyến mãi') }}</a>
                                </li>
                                @if(sizeof($roleUsers) != 0)
                                    <li>
                                        <a class="sidebarUrl" href="{{route('admin.banners.show')}}">{{ __('home.Danh sách banner') }}</a>
                                    </li>
                                @endif
                                {{--                                <li><a class="sidebarUrl" href="#">Quảng Cáo Shopee</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li><a class="sidebarUrl" href="#">Tăng Đơn Cùng KOL</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li><a class="sidebarUrl" href="#">Hiệu Quả Shopee Live</a>--}}
                                {{--                                </li>--}}
                            </ul>
                        </li>
            <li>
                <a class="sidebar item" href='#'><i class="fa-solid fa-book"></i>{{ __('home.Tài Chính') }} </a>
                <ul class='sub-items pl-3'>
                    <li><a class="sidebarUrl" href="{{route('revenues.index')}}">{{ __('home.Doanh thu') }}</a>
                    </li>
                    {{--                    <li><a class="sidebarUrl" href="#">Số dư TK Shopee</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li><a class="sidebarUrl" href="#">Tài Khoản Ngân Hàng</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li><a class="sidebarUrl" href="#">Cài Đặt Thanh Toán</a>--}}
                    {{--                    </li>--}}
                </ul>
            </li>

            @if(!$check_ctv_shop)
                <li>
                    <a class="sidebar item" href='#'><i class="fa-solid fa-chart-line"></i> {{ __('home.Dữ Liệu') }}</a>
                    <ul class='sub-items pl-3'>
                        <li><a class="sidebarUrl" href="#">{{ __('home.Phân Tích Bán Hàng') }}</a>
                        </li>
                        <li><a class="sidebarUrl" href="#!">{{ __('home.Thống kê') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
            {{--            <li>--}}
            {{--                <a class="sidebar item" href='#'><i class="fa-solid fa-layer-group"></i> Phát Triển</a>--}}
            {{--                <ul class='sub-items pl-3'>--}}
            {{--                    <li><a class="sidebarUrl" href="#">Nhiệm Vụ Người Bán</a>--}}
            {{--                    </li>--}}
            {{--                    <li><a class="sidebarUrl" href="#">Shop Yêu Thích</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
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
                    <a class="sidebar item" class="sidebarUrl" href="#!"><span><i class="fa-solid fa-users"></i> {{ __('home.Phân hạng thành viên') }}</span></a>
                    <ul class='sub-items'>
                        <li>
                            <a class="sidebarUrl" href="{{route('seller.rank.setup.show')}}">{{ __('home.Giảm giá theo hạng') }}</a>
                        </li>
                        <li>
                            <a class="sidebarUrl" href="{{route('seller.rank.setup.processCreate')}}">{{ __('home.Tạo mới giảm giá theo hạng') }}</a>
                        </li>
                        <li>
                            <a class="sidebarUrl" href="{{route('seller.setup.show')}}">{{ __('home.Quản lí phân hạng') }}</a>
                        </li>
                        @if($check === true)
                            <li>
                                <a class="sidebarUrl" href="{{route('seller.setup.processCreate')}}">{{ __('home.Tạo mới phân hạng') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            {{--            <li>--}}
            {{--                <a class="sidebar item" href='#'><i class="fa-solid fa-headset"></i> Chăm sóc khách hàng</a>--}}
            {{--                <ul class='sub-items pl-3'>--}}
            {{--                    <li><a class="sidebarUrl" href="#">Trợ Lý Chat</a>--}}
            {{--                    </li>--}}
            {{--                    <li><a class="sidebarUrl" href="#">Hỏi - Đáp</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            <li>
                <a class="sidebar item" href='#'><i class="fa-solid fa-shop"></i>{{ __('home.Quản Lý Shop') }} </a>
                <ul class='sub-items pl-3'>
                    @if(sizeof($roleUsers) != 0)
                        <li>
                            <a class="sidebarUrl" href="{{route('account.manage.show')}}">{{ __('home.Danh sách tài khoản') }}</a>
                        </li>
                    @endif
                    <li>
                        <a href='{{ route('staff.manage.show') }}'>{{ __('home.Danh sách tài khoản cấp dưới') }}</a>
                    </li>
                    @if(!$check_ctv_shop)
                        <li>
                            <a href='{{ route('staff.manage.create') }}'>{{ __('home.Thêm mới cấp dưới') }}</a>
                        </li>
                    @endif
                    <li>
                    <li><a class="sidebarUrl" href="{{route('seller.evaluates.index')}}">{{ __('home.Quản lí bình luận') }}</a></li>
                    <li><a class="sidebarUrl" href="{{ route('profile.shop.index') }}">{{ __('home.Hồ Sơ Shop') }}</a>
                    </li>
                    <li><a class="sidebarUrl" href="#">{{ __('home.Trang Trí Shop') }}</a>
                    </li>
                    <li><a class="sidebarUrl" href="#">{{ __('home.Danh Mục Của Shop') }}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="sidebar item" class="sidebarUrl" href="#!"><i class="fa-solid fa-warehouse"></i> {{ __('home.Quản lý kho') }}</a>
                <ul class='sub-items pl-3'>
                    <li>
                        <a href='{{ route('storage.manage.show.user') }}'>{{ __('home.Thông tin kho hàng') }}</a>
                    </li>
                    @if(!$check_ctv_shop)
                        <li>
                            <a href='{{ route('storage.manage.create') }}'>{{ __('home.Thêm mới nhập kho') }}</a>
                        </li>
                        @if(sizeof($roleUsers) != 0)
                            <li>
                                <a href='{{ route('storage.manage.show.all') }}'>{{ __('home.Tất cả kho hàng') }}</a>
                            </li>
                        @endif
                    @endif
                </ul>
            </li>

            <li>
                <a class="sidebar item" href='#'><i class="fa-solid fa-gear"></i> {{ __('home.Thiết Lập Shop') }}</a>
                <ul class='sub-items pl-3'>
                    <li><a class="sidebarUrl" class="sidebarFUrl" href="{{ route('setting.shop.index') }}">{{ __('home.Cấu hình chung') }}</a>
                    </li>
                    {{--                    <li><a class="sidebarUrl" href="#">Địa Chỉ</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li><a class="sidebarUrl" href="#">Thiết Lập Shop</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li><a class="sidebarUrl" href="#">Tài Khoản</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li><a class="sidebarUrl" href="#">Nền Tảng Đối Tác (Kết nối API)</a>--}}
                    {{--                    </li>--}}
                </ul>
            </li>
            {{--            <li>--}}
            {{--                <a class="sidebar item" href='#'><i class="fa-solid fa-circle-question"></i> Trợ giúp</a>--}}
            {{--                <ul class='sub-items pl-3'>--}}
            {{--                    <li><a class="sidebarUrl" href="#">Cổng Thông Tin Hỗ Trợ Người Bán </a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
    </ul>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function checkUrl() {
        var listUrl = document.getElementsByClassName('sidebarUrl');
        var currentUrl = window.location.href;
        for (let i = 0; i < listUrl.length; i++) {
            let url = listUrl[i].href;
            if (currentUrl == url) {
                console.log(listUrl[i].parentElement.parentElement.previousElementSibling)
                let sideBarItem = listUrl[i].parentElement.parentElement.previousElementSibling;
                let parentItem = listUrl[i].parentElement.parentElement;
                sideBarItem.classList.add('expanded');
                parentItem.style.display = 'block';
                listUrl[i].classList.add('text-danger')
                // listUrl[i].previousElementSibling
            }
        }
    }

    checkUrl();
</script>
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