    async function getCommentById(id) {
    let url = urla;
    url = url.replace(':id', id);

    const response = await fetch(url);

    if (response.ok) {
    const data = await response.json();
    document.getElementById('id-cmt-edit').value = data[0].id;
    document.getElementById('name-edit').value = data[0].username;
    document.getElementById('content-edit').value = data[0].content;
    starCheckEdit(data[0].star_number)
}

}

    function starCheckEdit(value) {
    let input = document.getElementById('input-star-edit');
    let star = document.getElementById('star-edit-' + value);
    let icon = document.getElementById('icon-star-edit-' + value);

    let isChecked = star.checked;

    // Toggle the clicked star
    star.checked = !isChecked;

    for (let i = 1; i <= 5; i++) {
    let currentStar = document.getElementById('star-edit-' + i);
    let currentIcon = document.getElementById('icon-star-edit-' + i);

    if (i <= value) {
    currentStar.checked = true;
    currentIcon.classList.add("checked");
} else {
    currentStar.checked = false;
    currentIcon.classList.remove("checked");
}
}

    input.value = star.checked ? value : value - 1;
}

    async function handleDeleteEvaluate(id) {

    let isDelete = confirm('Banj cos muon xoa k');
    if (isDelete) {
    let url = urlb;
    url = url.replace(':id', id);
    const respone = await fetch(url);

    if (respone.ok) {
    location.reload();
}
}
}
