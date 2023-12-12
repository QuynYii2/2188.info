$(document).ready(function ($) {
    $(".icon-heart").click(function () {
        var idProduct = $(this).data('id');
        $.ajax({
            url: urla,
            method: 'POST',
            dataType: 'json',
            data: {
                idProduct: idProduct,
                _token: token,
            },
            success: function (response) {
                alert(response.message);
            },
            error: function (exception) {
                //
            }
        });
    });
});
