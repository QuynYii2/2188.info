$(document).ready(function () {
    async function showCart() {
        let url = urlrenderCart;

        await $.ajax({
            url: url,
            method: 'GET',
        })
            .done(function (response) {
                $('#cartBlog').append(response);
            })
            .fail(function (_, textStatus) {
                console.log(textStatus)
            });
    }

    showCart();

    $('.categorySearch').on('click', function () {
        let id = $(this).data('id');
        console.log(id);
        $('#category_search').val(id);
    })
})

// Hàm logout
function logout() {
    let productIDs = localStorage.getItem('productIDs');

    $.ajax({
        url: viewed,
        method: 'POST',
        data: {
            productIds: productIDs,
            _token: token,
        },
        success: function (response) {
            localStorage.clear();
            console.log(response);
        },
        error: function (response) {
            console.log(response)
        }
    });

    // Tạo một form
    var form = document.createElement('form');

    // Đặt thuộc tính action và method cho form
    form.action = logoutRoute;
    form.method = "POST";

    // Tạo một input hidden để chứa CSRF token
    var csrfTokenInput = document.createElement('input');
    csrfTokenInput.type = "hidden";
    csrfTokenInput.name = "_token";
    csrfTokenInput.value = token;

    // Thêm input hidden vào form
    form.appendChild(csrfTokenInput);

    // Thêm form vào body
    document.body.appendChild(form);

    // Gửi form để thực hiện logout
    form.submit();
}

function showAlert(role = 2) {
    event.preventDefault();
    switch (role) {
        case 1:
            if (confirm('Bạn phải nâng cấp quyền để thực hiện thao tác này.')) {
                return window.location.href = process
            }
            break;
        case 2:
            if (confirm('Bạn phải đăng nhập để thực hiện thao tác này.')) {
                return window.location.href = login
            }
            break;
    }
}
