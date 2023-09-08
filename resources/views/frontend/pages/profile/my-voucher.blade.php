@extends('frontend.layouts.profile')

@section('title', 'My Voucher')

<style>
     body {
         font-family: 'Montserrat', sans-serif;
         background-color: #f5f5f5;
     }

</style>

@section('sub-content')
    @php

    @endphp
    <div class="p-4 list-voucher">
        <p class="category">{{ __('home.Kho Voucher') }}</p>
        <div class="search">
            <div class="form-search d-flex align-items-center">
                <div class="mr-3 voucher">{{ __('home.Voucher') }}</div>
                <div class="input-group">
                    <input type="text" class="form-control mr-3" placeholder={{ __('home.Nhập mã voucher tại đây') }} aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">{{ __('home.Lưu') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-pills mb-3 mt-4" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('home.Tất cả') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('home.Shoping mall') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('home.Shop') }}</a>
            </li>
        </ul>
        <div class="tab-content item-voucher" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                    @foreach ($all as $key => $voucher)
                    <div class="col-xl-6 col-12 mt-3">
                        <div class="item d-flex">
                            <img src="{{asset('images/img.png')}}" alt="">
                            <div class="content align-self-center">
                                <div class="voucher-details">
                                        <span class="voucher-percent">{{ __('home.Voucher giảm') }} {{ $voucher->percent }}%</span>
                                        <div class="voucher-apply-products">{{ __('home.Áp dụng cho') }} {{ ($voucher->description) }}</div>
                                        <div class="voucher-end-date">{{ __('home.Ngày kết thúc') }} {{ $voucher->endDate }}</div>
                                        <div class="d-flex justify-content-between">
                                            <span class="voucher-code" id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                            <button onclick="copyCode({{ $voucher->id }})">{{ __('home.Copy') }}</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    @foreach ($shoppe as $key => $voucher)
                        <div class="col-xl-6 col-12 mt-3">
                            <div class="item d-flex">
                                <img src="{{asset('images/img.png')}}" alt="">
                                <div class="content align-self-center">
                                    <div class="voucher-details">
                                        <span class="voucher-percent">{{ __('home.Voucher giảm ') }}{{ $voucher->percent }}%</span>
                                        <div class="voucher-apply-products">{{ __('home.Áp dụng cho ') }}Áp dụng cho {{ $voucher->description }}</div>
                                        <div class="voucher-end-date">{{ __('home.Ngày kết thúc ') }}{{ $voucher->endDate }}</div>
                                        <div class="d-flex justify-content-between">
                                            <span class="voucher-code" id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                            <button onclick="copyCode({{ $voucher->id }})">{{ __('home.Copy') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row">
                    @foreach ($shop as $key => $voucher)
                        <div class="col-xl-6 col-12 mt-3">
                            <div class="item d-flex">
                                <img src="{{asset('images/img.png')}}" alt="">
                                <div class="content align-self-center">
                                    <div class="voucher-details">
                                        <span class="voucher-percent">{{ __('home.Voucher giảm ') }}{{ $voucher->percent }}%</span>
                                        <div class="voucher-apply-products">{{ __('home.Áp dụng cho') }} {{ ($voucher->description) }}</div>
                                        <div class="voucher-end-date">{{ __('home.Ngày kết thúc') }} {{ $voucher->endDate }}</div>
                                        <div class="d-flex justify-content-between">
                                            <span class="voucher-code" id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                            <button onclick="copyCode({{ $voucher->id }})">{{ __('home.Copy') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<script>
    // Hàm sao chép mã voucher vào clipboard khi nhấp nút Copy Code
    function copyCode(voucherId) {
        // Lấy mã voucher theo ID
        var voucherCode = document.getElementById('voucher-code-' + voucherId).innerText;

        // Tạo một textarea ẩn để copy vào clipboard
        var tempInput = document.createElement('textarea');
        tempInput.value = voucherCode;
        document.body.appendChild(tempInput);

        // Chọn và sao chép nội dung vào clipboard
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Hiển thị thông báo hoặc xử lý sau khi sao chép thành công (tuỳ ý)
        alert({{ __('home.Mã voucher đã được sao chép: ') }} + voucherCode);
    }
</script>
</body>
</html>
@endsection
