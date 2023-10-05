<!DOCTYPE html>
<html>
<head>
    <title>Thông báo đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.5;
            color: #555;
        }
        .order-details {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Thông báo đơn hàng</h1>
    <p>Xin chào,{{ Auth::user()->name }}</p>
    <p>Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi. Dưới đây là chi tiết về đơn hàng của bạn:</p>
    <div class="order-details">
        <p><strong>Mã đơn hàng:</strong> <?php echo $_GET['vnp_TxnRef'] ?></p>
        <p><strong>Sản phẩm:</strong> Áo thun xanh - Size M</p>
        <p><strong>Tổng tiền:</strong> <?php
                                       $vnp_Amount = $_GET['vnp_Amount'];

                                       if (isset($vnp_Amount) && is_numeric($vnp_Amount)) {
                                           $formattedAmount = number_format($vnp_Amount / 100, 2, '.', ',');
                                           $formattedAmount = rtrim($formattedAmount, '0');
                                           $formattedAmount = rtrim($formattedAmount, '.');
                                           echo $formattedAmount . " VND";
                                       } else {
                                           echo "Không có thông tin số tiền hợp lệ.";
                                       }
                                       ?>
        </p>
        <p><strong>Thời gian thanh toán:</strong> <?php
                                                  $vnp_PayDate = $_GET['vnp_PayDate'];
                                                  if (isset($vnp_PayDate) && strtotime($vnp_PayDate) !== false) {
                                                      $formattedDate = date("Y-m-d H:i:s", strtotime($vnp_PayDate));
                                                      echo  $formattedDate;
                                                  } else {
                                                      echo "Không có thông tin ngày giờ hợp lệ.";
                                                  }
                                                  ?>
        </p>
    </div>
    <p>Cảm ơn bạn đã ủng hộ cửa hàng của chúng tôi. Chúng tôi sẽ xử lý đơn hàng của bạn sớm nhất có thể.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ IL</p>
</div>
</body>
</html>
