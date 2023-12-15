function checkUrl() {
    var listUrl = document.getElementsByClassName('sidebarUrl');
    var currentUrl = window.location.href;
    for (let i = 0; i < listUrl.length; i++) {
        let url = listUrl[i].href;
        if (currentUrl == url) {
            console.log(listUrl[i].parentElement.parentElement.previousElementSibling)
            let sideBarItem = listUrl[i].parentElement.parentElement.previousElementSibling;
            let parentItem = listUrl[i].parentElement.parentElement;
            sideBarItem.classList.add('expanded');
            parentItem.style.display = 'block';
            listUrl[i].classList.add('text-danger')

            // Thêm thuộc tính cho class sidebarUrlLi
            let sidebarUrlLi = listUrl[i].parentElement; // Lấy thẻ li chứa class sidebarUrl
            if (sidebarUrlLi) {
                sidebarUrlLi.classList.add('border-left-sidebar');
            }
        }
    }
}

checkUrl();
$(".items > li > a").click(function (e) {
    e.preventDefault();
    var $this = $(this);
    if ($this.hasClass("expanded")) {
        $this.removeClass("expanded");
    } else {
        $(".items a.expanded").removeClass("expanded");
        $this.addClass("expanded");
        $(".sub-items").filter(":visible").slideUp("normal");
    }
    $this.parent().children("ul").stop(true, true).slideToggle("normal");
});

// $(".items > li ").click(function (e) {
//     e.preventDefault();
//     var $this = $(this);
//     if ($this.hasClass("boxShadow")) {
//         $this.removeClass("boxShadow");
//     } else {
//         $(".items a.boxShadow").removeClass("boxShadow");
//         $this.addClass("boxShadow");
//     }
//     $this.parent().children("ul").stop(true, true).slideToggle("normal");
// });

$(".sub-items a").click(function () {
    $(".sub-items a").removeClass("current");
    $(this).addClass("current");
});
