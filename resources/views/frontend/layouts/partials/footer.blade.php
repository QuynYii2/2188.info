@php
    $config = \App\Models\ConfigProject::where('status', \App\Enums\ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
@endphp

@php

        @endphp
<footer class="footer">
    <div class="footer-container">
        <div class="footer-top">
            <div class="footer-list">
                <div class="footer-list-container">
                    <div class="list-container-content">
                        {{ __('home.CUSTOMER CARE') }}
                    </div>
                    <ul class="list-item-content">
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Help Center') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">2188 Blog</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">2188 Mall</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Shopping guide') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Sales Guide') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Payment') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Coin') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Ship') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Returns & Refund') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Customer care') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Warranty Policy') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-list-container">
                    <div class="list-container-content">
                        {{ __('home.ABOUT 2188') }}
                    </div>
                    <ul class="list-item-content">
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.About 2188 Vietnam') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Recruitment') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Terms 2188') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Company Name') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Genuine') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Seller channel') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Flash Sales') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Ambassador Programme') }}</span>
                            </a>
                        </li>
                        <li class="item-content-footer">
                            <a href="#" class="item-content-link" title="" target="_blank" rel="noopener noreferrer">
                                <span class="item-content-text">{{ __('home.Media Contact') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="footer-list-container">
                    <div class="list-container-content">
                        {{ __('home.PAYMENT') }}
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
                        {{ __('home.LOGISTICS') }}
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
                        {{ __('home.FOLLOW US') }}
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
                        {{ __('home.APP DOWNLOAD') }}
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
                    {{ __('home.© 2023. All Rights Reserved.') }}
                </div>
                <div class="_9RQPzN">
                    <div class="rtJ1VG footer-region-add">
                        {{ __('home.Country & Region') }}:
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
                            Taiwan
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
                            Vietnam
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
                            <span>{{ __('home.Privacy Policy') }}</span>
                        </a>
                    </div>
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>{{ __('home.TERM OF SERVICE') }}</span>
                        </a>
                    </div>
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>{{ __('home.SHIPPING POLICY') }}</span>
                        </a>
                    </div>
                    <div class="footer-bottom-item">
                        <a class="bottom-item" href="#">
                            <span>{{ __('home.VIOLATION') }}</span>
                        </a>
                    </div>
                </div>
                <div class="footer-addres">
{{--                    Địa chỉ: Tầng 4-5-6, Tòa nhà Capital Place, số 29 đường Liễu Giai, Phường Ngọc Khánh, Quận Ba Đình, Thành phố Hà Nội, Việt Nam. Tổng đài hỗ trợ: 19001221 - Email: cskh@hotro.shopee.vn--}}
                </div>
{{--                <div class="footer-addres">--}}
{{--                    Chịu Trách Nhiệm Quản Lý Nội Dung: Nguyễn Đức Trí -  Điện thoại liên hệ: 024 73081221 (ext 4678)--}}
{{--                </div>--}}
{{--                <div class="footer-addres">--}}
{{--                    Mã số doanh nghiệp: 0106773786 do Sở Kế hoạch &amp; Đầu tư TP Hà Nội cấp lần đầu ngày 10/02/2015--}}
{{--                </div>--}}
{{--                <div class="footer-addres">--}}
{{--                    © 2015 - Bản quyền thuộc về Công ty TNHH Shopee--}}
                </div>
            </div>
        </div>
    </div>
</footer>
