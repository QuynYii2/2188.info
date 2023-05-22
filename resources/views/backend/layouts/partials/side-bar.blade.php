<style>
    @import url('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');

    @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        font-stretch: normal;
        src: url(https://fonts.gstatic.com/s/opensans/v35/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsiH0B4gaVc.ttf) format('truetype');
    }

    @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 400;
        font-stretch: normal;
        src: url(https://fonts.gstatic.com/s/opensans/v35/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsjZ0B4gaVc.ttf) format('truetype');
    }

    @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 700;
        font-stretch: normal;
        src: url(https://fonts.gstatic.com/s/opensans/v35/memSYaGs126MiZpBA-UvWbX2vVnXBbObj2OVZyOOSr4dVJWUgsg-1x4gaVc.ttf) format('truetype');
    }

    .sidebar-toggle {
        margin-left: -240px;
    }

    .sidebar {
        overflow-y: scroll;
        width: 100%;
        height: 100%;
        background: #293949;
        position: absolute;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        -ms-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        z-index: 100;
    }

    .sidebar #leftside-navigation ul,
    .sidebar #leftside-navigation ul ul {
        margin: -2px 0 0;
        padding: 0;
    }

    .sidebar #leftside-navigation ul li {
        list-style-type: none;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sidebar #leftside-navigation ul li.active > a {
        color: #1abc9c;
    }

    .sidebar #leftside-navigation ul li.active ul {
        display: block;
    }

    .sidebar #leftside-navigation ul li a {
        color: #aeb2b7;
        text-decoration: none;
        display: block;
        padding: 18px 0 18px 25px;
        font-size: 12px;
        outline: 0;
        -webkit-transition: all 200ms ease-in;
        -moz-transition: all 200ms ease-in;
        -o-transition: all 200ms ease-in;
        -ms-transition: all 200ms ease-in;
        transition: all 200ms ease-in;
    }

    .sidebar #leftside-navigation ul li a:hover {
        color: #1abc9c;
    }

    .sidebar #leftside-navigation ul li a span {
        display: inline-block;
    }

    .sidebar #leftside-navigation ul li a i {
        width: 20px;
    }

    .sidebar #leftside-navigation ul li a i .fa-angle-left,
    .sidebar #leftside-navigation ul li a i .fa-angle-right {
        padding-top: 3px;
    }

    .sidebar #leftside-navigation ul ul {
        display: none;
    }

    .sidebar #leftside-navigation ul ul li {
        background: #23313f;
        margin-bottom: 0;
        margin-left: 0;
        margin-right: 0;
        border-bottom: none;
    }

    .sidebar #leftside-navigation ul ul li a {
        padding-top: 13px;
        padding-bottom: 13px;
        color: #aeb2b7;
    }


</style>
<aside class="sidebar" id="side-bar-seller">
    <div id="leftside-navigation" class="nano">
        <ul class="nano-content">
            <li class="sub-menu">
                <a href="#!"><i class="fa fa-cogs"></i><span>Sản phẩm</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>

                    <li><a href="#!">Danh sách sản phẩm</a>
                    </li>
                    <li><a href="/products/create">Thêm mới sản phẩm</a>
                    </li>
                    <li><a href="/categories">Chuyên mục</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#!"><i class="fa fa-table"></i><span>Đơn hàng</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="#!">Basic Tables</a>
                    </li>

                    <li><a href="#!">Data Tables</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#!"><i class="fa fa fa-tasks"></i><span>Quản lý kho</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="#!">Components</a>
                    </li>
                    <li><a href="#!">Validation</a>
                    </li>
                    <li><a href="#!">Mask</a>
                    </li>
                    <li><a href="#!">Wizard</a>
                    </li>
                    <li><a href="#!">Multiple File Upload</a>
                    </li>
                    <li><a href="#!">WYSIWYG Editor</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu ">
                <a href="#!"><i class="fa fa-envelope"></i><span>Quản lý user</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li ><a href="#!">Inbox</a>
                    </li>
                    <li><a href="#!">Compose Mail</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#!"><i class="fa fa-bar-chart-o"></i><span>Thống kê</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="#!">Chartjs</a>
                    </li>
                    <li><a href="#!">Morris</a>
                    </li>
                    <li><a href="#!">C3 Charts</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#!"><i class="fa fa-map-marker"></i><span>Quản lý mã giảm giá</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="#!">Google Map</a>
                    </li>
                    <li><a href="#!">Vector Map</a>
                    </li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="#!"><i class="fa fa-text-height"></i><span>Quản lý doanh thu</span></a>
            </li>
            <li class="sub-menu">
                <a href="#!"><i class="fa fa-file"></i><span>Sản phẩm xem nhiều nhất</span><i
                            class="arrow fa fa-angle-right pull-right"></i></a>
                <ul>
                    <li><a href="#!">Blank Page</a>
                    </li>
                    <li><a href="#!">Login</a>
                    </li>
                    <li><a href="#!">Sign Up</a>
                    </li>
                    <li><a href="#!">Calendar</a>
                    </li>
                    <li><a href="#!">Timeline</a>
                    </li>
                    <li><a href="#!">404</a>
                    </li>
                    <li><a href="#!">500</a>
                    </li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="#!"><i class="fa fa-text-height"></i><span>Quản lý bình luận</span></a>
            </li>
        </ul>
    </div>
</aside>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $("#leftside-navigation .sub-menu > a").click(function (e) {
        $("#leftside-navigation ul ul").slideUp(), $(this).next().is(":visible") || $(this).next().slideDown(),
            e.stopPropagation();
    })
</script>