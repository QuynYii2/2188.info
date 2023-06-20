<style>

    ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    a {
        color: #FFFFFF;
        text-decoration: none;
    }

    .wrapper {
        width: 100%;
        height: 100%;
        background-color: #000000;
        font-size: 0.875em;
    }

    .items {
        padding: 18px 0;
    }

    .items > li > a {
        display: block;
        text-indent: 18px;
        line-height: 39px;
    }

    .items > li > a::after {
        position: absolute;
        right: 30px;
        font-family: "FontAwesome";
    }

    .items > li > a::after {
        right: 30px;
        content: "\2192";
    }

    .itemHover {
        color: #fff;
        font-weight: 600;
        transition: background-color 0.4s ease-in-out;
    }

    .items > li > a:hover {
        background-color: black;
        color: #fff;
        font-weight: 600;
        transition: background-color 0.4s ease-in-out;
        text-decoration: none !important;
    }

    .items > li > a.expanded {
        background-color: #64D7E2;
        color: #fff;
        font-weight: 600;
        transition: background-color 0.4s ease-in-out;
    }

    .items > li > a.expanded::after {
        content: "\2193";
    }

    .items > li:not(:has(ul)) > a::after,
    .items > li:not(:has(ul)) > a.expanded::after {
        content: none;
    }

    .sub-items > li:first-child > a {
        margin-top: 17px;
        height: 34px;
    }

    .sub-items > li:last-child > a {
        margin-bottom: 17px;
        height: 34px;
    }

    .sub-items a {
        position: relative;
        display: block;
        margin: 0 1rem;
        width: 212px;
        text-indent: 24px;
        line-height: 39px;
    }

    .sub-items a {
        border-left: 2px solid #64D7E2;
    }

    .sub-items .current {
        position: relative;
        color: #64D7E2;
        border-color: white;
    }

    .sub-items > li:hover > a {
        color: #64D7E2;
        transition: color 0.4s ease-in-out;
        text-decoration: none;

    }

    .sub-items {
        display: none;
    }


</style>

<div class='wrapper'>
    <ul class='items'>
        <li>
            <a href="#">Menu</a>
            <ul class='items'>
                <li>
                    <a href='#'><i class="fa fa-cogs"></i>Sản phẩm<i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul class='sub-items'>
                        <li><a href="/products">Danh sách sản phẩm</a>
                        </li>
                        <li><a href="/products/create">Thêm mới sản phẩm</a>
                        </li>
                        <li><a href="/categories">Chuyên mục</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!"><i class="fa fa-cogs"></i>Thuộc tính sản phẩm<i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul class='sub-items'>

                        <li><a href="{{route('attributes.index')}}">Danh sách thuộc tính</a>
                        </li>
                        <li><a href="{{route('attributes.create')}}">Thêm mới thuộc tính</a>
                        </li>
                        <li><a href="{{route('properties.index')}}">Quản lí thuộc tính con</a>
                        </li>
                        <li><a href="{{route('properties.create')}}">Thêm mới thuộc tính con</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'><i class="fa fa-table"></i>Đơn hàng<i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul class='sub-items'>
                        <li><a href="#!">Basic Tables</a>
                        </li>

                        <li><a href="#!">Data Tables</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!"><i class="fa fa fa-tasks"></i>Quản lý kho<i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul class='sub-items'>
                        <li>
                            <a href='#'>Lorem ipsum dolor sit amet.</a>
                        </li>
                        <li>
                            <a href='#'>Lorem ipsum dolor sit amet.</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href='#'>Quản lý user</a>
                    <ul class='sub-items'>
                        <li>
                            <a href='#'>Lorem ipsum dolor sit amet.</a>
                        </li>
                        <li>
                            <a href='#'>Lorem ipsum dolor sit amet.</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#!"><i class="fa fa-bar-chart-o"></i><span>Thống kê</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul class='sub-items'>
                        <li><a href="#!">Chartjs</a>
                        </li>
                        <li><a href="#!">Morris</a>
                        </li>
                        <li><a href="#!">C3 Charts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#!"><i class="fa fa-map-marker"></i><span>Quản lý mã giảm giá</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                </li>
                <li>
                    <a href="#!"><i class="fa fa-text-height"></i><span>Quản lý doanh thu</span></a>
                </li>
                <li>
                    <a href="#!"><i class="fa fa-file"></i><span>Sản phẩm xem nhiều nhất</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>

                </li>
                <li>
                    <a href="#!"><i class="fa fa-text-height"></i><span>Quản lý bình luận</span><i
                                class="arrow fa fa-angle-right pull-right"></i></a>
                    <ul class='sub-items'>
                        <li><a href="{{route('seller.evaluates.index')}}">List Evaluate</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
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