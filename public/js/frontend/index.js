    $(document).ready(function ($) {
    $(".card-bottom--right").click(function () {
        var idProduct = $(this).attr('id-product');
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
