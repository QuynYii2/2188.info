var listIDs = document.getElementById('category_apply').value
$(document).ready(function () {
    myArray = listIDs.split(",");
    for (let i = 0; i < myArray.length; i++) {
        check(myArray[i])
    }

    function check(id) {
        document.getElementById("category-" + id).checked = true;
    }
})


var expanded = false;

function showCheckboxes() {
    var checkboxes = document.getElementById("checkboxes");
    if (!expanded) {
        window.addEventListener('click', function (e) {
            var checkboxes = document.getElementById("checkboxes");
            var div = document.getElementById('div-click');
            if (checkboxes.contains(e.target) || div.contains(e.target)) {
                div.on('click', function () {
                    if (!expanded) {
                        checkboxes.style.display = "block";
                        expanded = true;
                    } else {
                        checkboxes.style.display = "none";
                        expanded = false;
                    }
                });
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        })
        checkboxes.style.display = "block";
        expanded = true;
    } else {
        checkboxes.style.display = "none";
        expanded = false;
    }
}