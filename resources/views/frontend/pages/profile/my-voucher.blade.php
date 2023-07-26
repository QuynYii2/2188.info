@extends('frontend.layouts.profile')

@section('title', 'My Voucher')

<style>
    .link-tabs {
        background-color: #f7f7f7 !important;
    }

    .link-tabs:hover {
        color: #c69500;
    !important;
    }
    .width-voucher {
        max-width: 100% !important;
    }
    .border-btn {
        border: 1px solid #000000;
    }
     body {
         font-family: 'Montserrat', sans-serif;
         background-color: #f5f5f5;
     }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .voucher-card {
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .voucher-name {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .voucher-details {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
    }

    .voucher-percent {
        font-size: 18px;
        font-weight: 700;
        color: #ee4d2d;
    }

    .voucher-code {
        font-size: 16px;
        color: #555;
    }

    .voucher-apply-products {
        font-size: 14px;
        color: #666;
    }

    .voucher-end-date {
        font-size: 14px;
        color: #777;
    }
</style>

@section('sub-content')
    <div class="container">
        </div>

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <div class="row">
            <div class="col-md-10 ml-auto col-xl-6 mr-auto width-voucher">
                <p class="category">Voucher</p>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                    <i class="now-ui-icons objects_umbrella-13"></i> Tất cả
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                    <i class="now-ui-icons shopping_cart-simple"></i> Shoppe
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                                    <i class="now-ui-icons shopping_shop"></i> Shop
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content text-center">

{{-- Tất cả--}}
                            <div class="tab-pane active" id="home" role="tabpanel">
                                    <tbody>
                                    @foreach ($all as $key => $voucher)
                                        <tr>
                                            <div class="voucher-name">{{ $voucher->name }}</div>
                                            <div class="voucher-details">
                                                <span class="voucher-percent">Voucher giảm {{ $voucher->percent }}%</span> Mã code là:
                                                <span class="voucher-code" id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                                <!-- Nút copy code -->
                                                <button onclick="copyCode({{ $voucher->id }})">Copy Code</button>
                                            </div>
                                            <div class="voucher-apply-products">Áp dụng cho {{ $voucher->description }}</div>
                                            <div class="voucher-end-date">Ngày kết thúc {{ $voucher->endDate }}</div>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </div>
{{-- Shoppe--}}
                            <div class="tab-pane" id="profile" role="tabpanel">
                                    <tbody>
                                    @foreach ($shoppe as $key => $voucher)
                                        <tr>
                                            <div class="voucher-name">{{ $voucher->name }}</div>
                                            <div class="voucher-details">
                                                <span class="voucher-percent">Voucher giảm {{ $voucher->percent }}%</span> Mã code là:
                                                <span class="voucher-code" id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                                <!-- Nút copy code -->
                                                <button onclick="copyCode({{ $voucher->id }})">Copy Code</button>
                                            </div>
                                            <div class="voucher-apply-products">Áp dụng cho {{ $voucher->description }}</div>
                                            <div class="voucher-end-date">Ngày kết thúc {{ $voucher->endDate }}</div>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </div>
{{-- Shop--}}
                            <div class="tab-pane" id="messages" role="tabpanel">
                                    <tbody>
                                    @foreach ($shop as $key => $voucher)
                                        <tr>
                                            <div class="voucher-name">{{ $voucher->name }}</div>
                                            <div class="voucher-details">
                                                <span class="voucher-percent">Voucher giảm {{ $voucher->percent }}%</span> Mã code là:
                                                <span class="voucher-code" id="voucher-code-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                                <!-- Nút copy code -->
                                                <button onclick="copyCode({{ $voucher->id }})">Copy Code</button>
                                            </div>
                                            <div class="voucher-apply-products">Áp dụng cho{{ $voucher->description }}</div>
                                            <div class="voucher-end-date">Ngày kết thúc {{ $voucher->endDate }}</div>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </div>
                        </div>
                    </div>
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
        alert('Mã voucher đã được sao chép: ' + voucherCode);
    }
</script>
</body>
</html>
@endsection
