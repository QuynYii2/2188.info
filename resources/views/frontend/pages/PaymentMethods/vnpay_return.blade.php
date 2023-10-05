@extends('frontend.layouts.master')

@section('title', 'View Cart')

@section('content')
<?php
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
$vnp_HashSecret = "NTMFIAYIYAEFEAMZVWNCESERJMBVROKS";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
?>
        <!--Begin display -->

<div class="container justify-content-center">
    <div class="header clearfix">
        <h3 class="text-muted">VNPAY RESPONSE</h3>
    </div>
    <div class="table-responsive">
        <div class="form-group">
            <label >Mã đơn hàng:</label>

                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">

                <label >Số tiền:</label>
                <label><?php
                       $vnp_Amount = $_GET['vnp_Amount'];

                       if (isset($vnp_Amount) && is_numeric($vnp_Amount)) {
                           $formattedAmount = number_format($vnp_Amount / 100, 2, '.', ',');
                           $formattedAmount = rtrim($formattedAmount, '0');
                           $formattedAmount = rtrim($formattedAmount, '.');
                           echo $formattedAmount . " VND";
                       } else {
                           echo "Không có thông tin số tiền hợp lệ.";
                       }
                       ?></label>
            </div>
            <div class="form-group">
                <label >Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label >Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label >Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label >Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label >Thời gian thanh toán:</label>
                <label><?php
                       $vnp_PayDate = $_GET['vnp_PayDate'];
                       if (isset($vnp_PayDate) && strtotime($vnp_PayDate) !== false) {
                           $formattedDate = date("Y-m-d H:i:s", strtotime($vnp_PayDate));
                           echo  $formattedDate;
                       } else {
                           echo "Không có thông tin ngày giờ hợp lệ.";
                       }
                       ?></label>
            </div>
            <div class="form-group">
                <label >Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            echo "<span style='color:blue'>GD Thanh cong</span>";
                        } else {
                            echo "<span style='color:red'>GD Khong thanh cong</span>";
                        }
                    } else {
                        echo "<span style='color:red'>Chu ky khong hop le</span>";
                    }
                    ?>

            </label>
        </div>
    </div>
    <form action="{{ route('home') }}" method="GET">
        @csrf
        <button class="btn-primary btn button" type="submit">{{ __('home.Home') }}</button>
    </form>
</div>
@endsection