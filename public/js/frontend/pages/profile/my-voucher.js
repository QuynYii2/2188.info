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
    alert(text + voucherCode);
}
