@php
    $config = \App\Models\ConfigProject::where('status', \App\Enums\ConfigProjectStatus::ACTIVE)->orderBy('created_at', 'desc')->limit(1)->get();
@endphp

@php

@endphp
<footer class="footer">
    <div class="footer-content text-center">
        <div class="footer-content--big">
            {{ __('home.SUBSCRIBE TO OUR NEWSLETTER') }}
        </div>
        <div class="footer-content--small">
            {{ __('home.Get the latest updates on new products and upcoming sales') }}
        </div>
    </div>
    <div class="footer-list">
        <div class="row">
            <div class="footer-item col-xl-2 col-md-4">
                <div class="item-content">
                    {{ __('home.CATEGORIES') }}
                </div>
                @php
                    $listCate = DB::table('categories')->where('parent_id', null)->get();
                @endphp
                @if(count($listCate)<6)
                    @foreach($listCate as $cate)
                        <div class="item-small">
                            <a href="{{ route('category.show', $cate->id) }}">{{ ($cate->name) }}</a>
                        </div>
                    @endforeach
                @else
                    @for($i=0; $i<6; $i++)
                        <div class="item-small">
                            <a href="{{ route('category.show', $listCate[$i]->id) }}">{{ ($listCate[$i]->name) }}</a>
                        </div>
                    @endfor
                @endif
            </div>
            <div class="footer-item col-xl-2 col-md-4">
                <div class="item-content">
                    {{ __('home.BRANDS') }}
                </div>
                <div class="item-small">
                    <a href="#">Benjamin Button</a>
                </div>
                <div class="item-small">
                    <a href="#">Arm & Hammer</a>
                </div>
                <div class="item-small">
                    <a href="#">BisTech</a>
                </div>
                <div class="item-small">
                    <a href="#">Sagaform</a>
                </div>
                <div class="item-small">
                    <a href="#">OFS</a>
                </div>
            </div>
            <div class="footer-item col-xl-2 col-md-4">
                <div class="item-content">
                    {{ __('home.FURTHER INFO') }}.
                </div>
                <div class="item-small">
                    <a href="#">About us</a>
                </div>
                <div class="item-small">
                    <a href="#">Theme Styles</a>
                </div>
                <div class="item-small">
                    <a href="#">Contact us</a>
                </div>
                <div class="item-small">
                    <a href="#">Gift Certificates</a>
                </div>
                <div class="item-small">
                    <a href="#">Blog</a>
                </div>
            </div>
            <div class="footer-item col-xl-2 col-md-4">
                <div class="item-content">
                    {{ __('home.CUSTOMER SERVICE') }}
                </div>
                <div class="item-small">
                    <a href="#">Help & FAQs</a>
                </div>
                <div class="item-small">
                    <a href="#">Terms of Conditions</a>
                </div>
                <div class="item-small">
                    <a href="#">Privacy Policy</a>
                </div>
                <div class="item-small">
                    <a href="#">Online Returns Policy</a>
                </div>
                <div class="item-small">
                    <a href="#">Rewards Program</a>
                </div>
            </div>
            @if(!$config->isEmpty())
            <div class="footer-item col-xl-3 col-md-4">
                <div class="item-content">
                    STORE INFO
                </div>
                <div class="item-small">
                    <a href="#"><i class="fa-solid fa-location-dot"></i> {{$config[0]->address}}</a>
                </div>
                <div class="item-small">
                    <a href="#"><i class="fa-solid fa-phone"></i> {{$config[0]->phone}}</a>
                </div>
                <div class="item-small">
                    <a href="#"><i class="fa-regular fa-envelope"></i> {{$config[0]->email}}</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</footer>
