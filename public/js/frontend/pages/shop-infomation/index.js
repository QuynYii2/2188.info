    function toggleContent(contentId, btnId) {
    var content = document.getElementById(contentId);
    var toggleBtn = document.getElementById(btnId);

    if (content.style.maxHeight) {
    content.style.maxHeight = null;
    toggleBtn.innerHTML = more;
} else {
    content.style.maxHeight = content.scrollHeight + "px";
    toggleBtn.innerHTML = less;
}
}
