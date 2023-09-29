    var totalPrice = document.getElementById('max-total');
    function getAllTotal() {
    var firstCells = document.querySelectorAll('#table-checkout td:nth-child(5)');
    var cellValues = [];
    firstCells.forEach(function (singleCell) {
    cellValues.push(singleCell.innerText);
});
    let i, total = 0;
    for (i = 0; i < cellValues.length; i++) {
    total = parseFloat(total) + parseFloat(cellValues[i]);
}
    totalPrice.innerText = total;
}
    getAllTotal();

