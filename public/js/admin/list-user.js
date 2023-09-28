$(document).ready(function () {
    $("#name").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $('#tableUser tr').each(function () {
            var found = false;
            $(this).find("td.table-name").each(function () {
                if ($(this).text().toLowerCase().includes(value)) {
                    found = true;
                }
            });
            $(this).toggle(found);
        });
    });

    $("#email").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $('#tableUser tr').each(function () {
            var found = false;
            $(this).find("td.table-email").each(function () {
                if ($(this).text().toLowerCase().includes(value)) {
                    found = true;
                }
            });
            $(this).toggle(found);
        });
    });

    $("#member").on("change", function () {
        var value = $(this).val().toLowerCase();
        $('#tableUser tr').each(function () {
            var found = false;
            $(this).find("td.table-member").each(function () {
                if ($(this).text().toLowerCase().includes(value)) {
                    found = true;
                }
            });
            $(this).toggle(found);
        });
    });

    $("#role").on("change", function () {
        var value = $(this).val().toLowerCase();
        $('#tableUser tr').each(function () {
            var found = false;
            $(this).find("td.table-role").each(function () {
                if ($(this).text().toLowerCase().includes(value)) {
                    found = true;
                }
            });
            $(this).toggle(found);
        });
    });
});


$(document).ready(function () {
    $("#inputSearchUser").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tableUser tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
