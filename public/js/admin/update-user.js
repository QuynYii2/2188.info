    $(document).ready(function () {
    $('#inputCheckboxPassword').on('change', function () {
        if ($('#inputCheckboxPassword').is(':checked')) {
            $('#password').prop('disabled', false);
        } else {
            $('#password').prop('disabled', true);
        }
    })
})
