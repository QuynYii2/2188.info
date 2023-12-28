$(document).ready(function () {
    $('.inputCheckboxCategory').on('click', function () {
        let count = document.querySelectorAll('.inputCheckboxCategory:checked').length
        if (count > 3) {
            $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', true);
        } else {
            $('.inputCheckboxCategory:checkbox:not(:checked)').prop('disabled', false);
        }
    })

    $('.inputCheckboxCategory1').on('click', function () {
        let count = document.querySelectorAll('.inputCheckboxCategory1:checked').length
        if (count > 3) {
            $('.inputCheckboxCategory1:checkbox:not(:checked)').prop('disabled', true);
        } else {
            $('.inputCheckboxCategory1:checkbox:not(:checked)').prop('disabled', false);
        }
    })

    $('.inputCheckboxCategory2').on('click', function () {
        let count = document.querySelectorAll('.inputCheckboxCategory2:checked').length
        if (count > 3) {
            $('.inputCheckboxCategory2:checkbox:not(:checked)').prop('disabled', true);
        } else {
            $('.inputCheckboxCategory2:checkbox:not(:checked)').prop('disabled', false);
        }
    })
})

function getDate() {
    let nowTime = new Date().toLocaleDateString('en-GB');
    $('#datetime_register').val(nowTime);
}

getDate();


var expanded = false, expanded1 = false, expanded2 = false;

function showCheckboxes() {
    var code_1 = document.getElementById("code_1");
    if (!expanded) {
        window.addEventListener('click', function (e) {
            var code_1_item = document.getElementById('code_1_item');
            if (code_1.contains(e.target) || code_1_item.contains(e.target)) {
                $('#code_1_item').on('click', function () {
                    if (!expanded) {
                        code_1.style.display = "block";
                        expanded = true;
                    } else {
                        code_1.style.display = "none";
                        expanded = false;
                    }
                });
            } else {
                code_1.style.display = "none";
                expanded = false;
            }
        })
        code_1.style.display = "block";
        expanded = true;
    } else {
        code_1.style.display = "none";
        expanded = false;
    }
}

function showCheckboxes1() {
    var code_3 = document.getElementById("code_3");
    if (!expanded1) {
        window.addEventListener('click', function (e) {
            let code_3_item = document.getElementById('code_3_item');
            if (code_3.contains(e.target) || code_3_item.contains(e.target)) {
                $('#code_3_item').on('click', function () {
                    if (!expanded1) {
                        code_3.style.display = "block";
                        expanded1 = true;
                    } else {
                        code_3.style.display = "none";
                        expanded1 = false;
                    }
                });
            } else {
                code_3.style.display = "none";
                expanded1 = false;
            }
        })
        code_3.style.display = "block";
        expanded1 = true;
    } else {
        code_3.style.display = "none";
        expanded1 = false;
    }
}

function showCheckboxes2() {
    var code_2 = document.getElementById("code_2");
    if (!expanded2) {
        window.addEventListener('click', function (e) {
            let code_2_item = document.getElementById('code_2_item');
            if (code_2.contains(e.target) || code_2_item.contains(e.target)) {
                $('#code_2_item').on('click', function () {
                    if (!expanded2) {
                        code_2.style.display = "block";
                        expanded2 = true;
                    } else {
                        code_2.style.display = "none";
                        expanded2 = false;
                    }
                });
            } else {
                code_2.style.display = "none";
                expanded2 = false;
            }
        })
        code_2.style.display = "block";
        expanded2 = true;
    } else {
        code_2.style.display = "none";
        expanded2 = false;
    }
}