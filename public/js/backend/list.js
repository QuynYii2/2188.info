    function checkBox() {
    var inputAll = document.getElementById('order-all');
    var items = document.getElementsByClassName("checkbox-items");
    if (inputAll.checked) {
    for (let i = 0; i < items.length; i++) {
    items[i].checked = true
}
} else {
    for (let i = 0; i < items.length; i++) {
    items[i].checked = false
}
}
}
    $(document).ready(function () {
    localStorage.removeItem('listArray');
});
    $('.checkbox-items').on('click', function () {
    var items = document.getElementsByClassName("checkbox-items");
    let array = [];
    for (let i = 0; i < items.length; i++) {
    if (items[i].checked) {
    array.push(items[i].value);
}
}
    localStorage.setItem('listArray', array);
    let listIDs = document.getElementById('excel-id');
    listIDs.value = localStorage.getItem('listArray');

    if (localStorage.getItem('listArray') != null && localStorage.getItem('listArray') !== 0) {
    $('#formExportDetail').removeClass("d-none");
    $('#formExportAll').addClass("d-none");
} else {
    $('#formExportDetail').addClass("d-none");
    $('#formExportAll').removeClass("d-none");
}
})

    $('#order-all').on('click', function () {
    var inputAll = document.getElementById('order-all');
    let array = [];
    if (inputAll.checked) {
    var items = document.getElementsByClassName("checkbox-items");
    for (let i = 0; i < items.length; i++) {
    array.push(items[i].value)
}
}
    localStorage.setItem('listArray', array);
    let listIDs = document.getElementById('excel-id');
    listIDs.value = localStorage.getItem('listArray');

    if (localStorage.getItem('listArray') != null && localStorage.getItem('listArray') !== 0) {
    $('#formExportDetail').removeClass("d-none");
    $('#formExportAll').addClass("d-none");
} else {
    $('#formExportDetail').addClass("d-none");
    $('#formExportAll').removeClass("d-none");
}
})
