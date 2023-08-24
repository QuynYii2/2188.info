@php
    $config = \App\Models\ConfigProject::where('status', \App\Enums\ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
@endphp

@php

        @endphp
<footer class="footer">
    {{--    <div class="footer-content text-center">--}}
    {{--        <div class="footer-content--big">--}}
    {{--            {{ __('home.SUBSCRIBE TO OUR NEWSLETTER') }}--}}
    {{--        </div>--}}
    {{--        <div class="footer-content--small">--}}
    {{--            {{ __('home.Get the latest updates on new products and upcoming sales') }}--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="footer-list">--}}
    {{--        <div class="row">--}}
    {{--            <div class="footer-item col-xl-2 col-md-4">--}}
    {{--                <div class="item-content">--}}
    {{--                    {{ __('home.CATEGORIES') }}--}}
    {{--                </div>--}}
    {{--                @php--}}
    {{--                    $listCate = DB::table('categories')->where('parent_id', null)->get();--}}
    {{--                @endphp--}}
    {{--                @if(count($listCate)<6)--}}
    {{--                    @foreach($listCate as $cate)--}}
    {{--                        <div class="item-small">--}}
    {{--                            <a href="{{ route('category.show', $cate->id) }}">{{ ($cate->name) }}</a>--}}
    {{--                        </div>--}}
    {{--                    @endforeach--}}
    {{--                @else--}}
    {{--                    @for($i=0; $i<6; $i++)--}}
    {{--                        <div class="item-small">--}}
    {{--                            <a href="{{ route('category.show', $listCate[$i]->id) }}">{{ ($listCate[$i]->name) }}</a>--}}
    {{--                        </div>--}}
    {{--                    @endfor--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--            <div class="footer-item col-xl-2 col-md-4">--}}
    {{--                <div class="item-content">--}}
    {{--                    {{ __('home.BRANDS') }}--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Benjamin Button</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Arm & Hammer</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">BisTech</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Sagaform</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">OFS</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="footer-item col-xl-2 col-md-4">--}}
    {{--                <div class="item-content">--}}
    {{--                    {{ __('home.FURTHER INFO') }}.--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">About us</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Theme Styles</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Contact us</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Gift Certificates</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Blog</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="footer-item col-xl-2 col-md-4">--}}
    {{--                <div class="item-content">--}}
    {{--                    {{ __('home.CUSTOMER SERVICE') }}--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Help & FAQs</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Terms of Conditions</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Privacy Policy</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Online Returns Policy</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#">Rewards Program</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            @if(!$config->isEmpty())--}}
    {{--            <div class="footer-item col-xl-3 col-md-4">--}}
    {{--                <div class="item-content">--}}
    {{--                    STORE INFO--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#"><i class="fa-solid fa-location-dot"></i> {{$config[0]->address}}</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#"><i class="fa-solid fa-phone"></i> {{$config[0]->phone}}</a>--}}
    {{--                </div>--}}
    {{--                <div class="item-small">--}}
    {{--                    <a href="#"><i class="fa-regular fa-envelope"></i> {{$config[0]->email}}</a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            @endif--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-list">
                <div class="footer-list-container">
                    <div class="list-container-content">
                        CHĂM SÓC KHÁCH HÀNG
                    </div>
                    <ul class="list-item-content">
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Trung Tâm Trợ Giúp</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Shopee Blog</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Shopee Mall</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Hướng Dẫn Mua Hàng</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Hướng Dẫn Bán Hàng</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Thanh Toán</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Shopee Xu</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Vận Chuyển</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Trả Hàng &amp; Hoàn Tiền</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Chăm Sóc Khách Hàng</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Chính Sách Bảo Hành</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-list-container">
                    <div class="list-container-content">
                        CHĂM SÓC KHÁCH HÀNG
                    </div>
                    <ul class="list-item-content">
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Trung Tâm Trợ Giúp</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Shopee Blog</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Shopee Mall</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Hướng Dẫn Mua Hàng</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Hướng Dẫn Bán Hàng</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Thanh Toán</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Shopee Xu</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Vận Chuyển</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Trả Hàng &amp; Hoàn Tiền</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Chăm Sóc Khách Hàng</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">Chính Sách Bảo Hành</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-list-container">
                    <div class="list-container-content">
                        THANH TOÁN
                    </div>
                    <ul class="footer-content-bill">
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/d4bbea4570b93bfd5fc652ca82a262a8" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/a0a9062ebe19b45c1ae0506f16af5c16" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/38fd98e55806c3b2e4535c4e4a6c4c08" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/bc2a874caeee705449c164be385b796c" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/2c46b83d84111ddc32cfd3b5995d9281" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/5e3f0bee86058637ff23cfdf2e14ca09" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/9263fa8c83628f5deff55e2a90758b06" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/0217f1d345587aa0a300e69e2195c492" alt="logo">
                            </a>
                        </li>
                    </ul>
                    <div class="list-container-content wTATIi">
                        ĐƠN VỊ VẬN CHUYỂN
                    </div>
                    <ul class="footer-content-bill">
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/vn-50009109-159200e3e365de418aae52b840f24185" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/d10b0ec09f0322f9201a4f3daf378ed2" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/77bf96a871418fbc21cc63dd39fb5f15" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/59270fb2f3fbb7cbc92fca3877edde3f" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/957f4eec32b963115f952835c779cd2c" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/0d349e22ca8d4337d11c9b134cf9fe63" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/3900aefbf52b1c180ba66e5ec91190e5" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/6e3be504f08f88a15a28a9a447d94d3d" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/b8348201b4611fc3315b82765d35fc63" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/0b3014da32de48c03340a4e4154328f6" alt="logo">
                            </a>
                        </li>
                        <li class="item-content-bill">
                            <a target="_blank" rel="noopener noreferrer" class="_2pbE-b">
                                <img src="https://down-vn.img.susercontent.com/file/vn-50009109-ec3ae587db6309b791b78eb8af6793fd" alt="logo">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-list-container">
                    <div class="list-container-content">
                        THEO DÕI CHÚNG TÔI TRÊN
                    </div>
                    <ul class="list-item-content">
                        <li class="item-content-footer">
                            <a href="https://www.facebook.com" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <img class="item-content-link-info" src="https://down-vn.img.susercontent.com/file/2277b37437aa470fd1c71127c6ff8eb5">
                                <span class="item-content-text">Facebook</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="https://instagram.com" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <img class="item-content-link-info" src="https://down-vn.img.susercontent.com/file/5973ebbc642ceee80a504a81203bfb91">
                                <span class="item-content-text">Instagram</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="https://www.linkedin.com" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <img class="item-content-link-info" src="https://down-vn.img.susercontent.com/file/f4f86f1119712b553992a75493065d9a">
                                <span class="item-content-text">LinkedIn</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-list-container">
                    <div class="list-container-content">
                        TẢI ỨNG DỤNG SHOPEE NGAY THÔI
                    </div>
                    <div class="pkg67p">
                        <a href="#" target="_blank" rel="noopener noreferrer">
                            <img src="https://down-vn.img.susercontent.com/file/a5e589e8e118e937dc660f224b9a1472" alt="download_qr_code" class="ebQ6br">
                        </a>
                        <div class="zLPzwH">
                            <a href="#" target="_blank" rel="noopener noreferrer" class="W4jGm6">
                                <img src="https://down-vn.img.susercontent.com/file/ad01628e90ddf248076685f73497c163" alt="app">
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" class="W4jGm6">
                                <img src="https://down-vn.img.susercontent.com/file/ae7dced05f7243d0f3171f786e123def" alt="app">
                            </a>
                            <a href="#" target="_blank" rel="noopener noreferrer" class="W4jGm6">
                                <img src="https://down-vn.img.susercontent.com/file/35352374f39bdd03b25e7b83542b2cb0" alt="app">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-region">
                <div class="PGHx77 footer-region-add">
                    © 2023 Shopee. Tất cả các quyền được bảo lưu.
                </div>
                <div class="_9RQPzN">
                    <div class="rtJ1VG footer-region-add">
                        Quốc gia &amp; Khu vực:
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Singapore
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Indonesia
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Đài Loan
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Thái Lan
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Malaysia
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Việt Nam
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Philippines
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Brazil
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            México
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Colombia
                        </a>
                    </div>
                    <div class="HKksoM">
                        <a href="#" class="footer-region-add WrjDUh">
                            Chile
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <div class="footer-bottom-list">
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>Chính sách bảo mật</span>
                        </a>
                    </div>
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>Quy chế hoạt động</span>
                        </a>
                    </div>
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>Chính sách vận chuyển</span>
                        </a>
                    </div>
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>CHÍNH SÁCH TRẢ HÀNG VÀ HOÀN TIỀN</span>
                        </a>
                    </div>
                </div>
                <div class="Notarization">
                    <a target="_blank" rel="noopener noreferrer" href="http://online.gov.vn/HomePage/WebsiteDisplay.aspx?DocId=18375" class="_44TnCg">
                        <div class="footer-vn-background footer-vn-vn_registered_red-png jeaJPZ">
                        </div>
                    </a>
                    <a target="_blank" rel="noopener noreferrer" href="http://online.gov.vn/HomePage/AppDisplay.aspx?DocId=29" class="_44TnCg">
                        <div class="footer-vn-background footer-vn-vn_registered_red-png jeaJPZ">
                        </div>
                    </a>
                    <a target="_blank" rel="noopener noreferrer" href="#" class="_44TnCg">
                        <div class="footer-vn-background footer-vn-vn_no_fake_item-png b1v1Th">
                        </div>
                    </a>
                </div>
                <div class="footer-addres ggg4D-">
                    Công ty TNHH Shopee
                </div>
                <div class="footer-addres">
                    Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu Giai, Phường Ngọc Khánh, Quận Ba Đình, Thành phố Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 - Email: cskh@hotro.shopee.vn
                </div>
                <div class="footer-addres">
                    Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Đức Trí -  Điện thoại liên hệ: 024 73081221 (ext 4678)
                </div>
                <div class="footer-addres">
                    Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch &amp; Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015
                </div>
                <div class="footer-addres">
                    © 2015 - Bản quyền thuộc về Công ty TNHH Shopee
                </div>
            </div>
        </div>
    </div>
</footer>
