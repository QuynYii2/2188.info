    $(document).ready(function ($) {
    $(".deleteButton--wish-list").click(function () {
        var idWishList = $(this).data('value');

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: {
                id: idWishList,
                _token: token
            },
            success: function (response) {
                alert(response.message);
                window.location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Lỗi khi xóa dữ liệu: " + error);
            }
        });
    });
});
