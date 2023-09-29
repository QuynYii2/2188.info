    function myFun(x) {
    var name = document.getElementById('permission-name');
    var id = document.getElementById('permission-id');
    var price = document.getElementById('price');
    var duration = document.getElementById('duration');

    name.value = document.getElementById('permission-name-' + x).value;
    id.value = document.getElementById('permission-id-' + x).value;
    price.value = document.getElementById('permission-price-' + x).value;
    duration.value = document.getElementById('permission-duration-' + x).value;
}
