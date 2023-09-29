

    $(function () {
    $('input.img-cfg').change(function () {
        const label = $(this).parent().find('span');
        let name = '';
        if (typeof (this.files) != 'undefined') {
            let lengthListImg = this.files.length;
            if (lengthListImg === 0) {
                label.removeClass('withFile').text(label.data('default'));
            } else {
                name = lengthListImg === 1 ? lengthListImg + ' file' : lengthListImg + ' files';
                let size = 0;
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    let sizeImg = (file.size / 1048576).toFixed(3);
                    size = size + Number(sizeImg);
                }
                label.addClass('withFile').text(name + ' (' + size + 'mb)');
            }
        } else {
            name = this.value.split("\\");
            label.addClass('withFile').text(name[name.length - 1]);
        }
        return false;
    });
});

    jQuery(document).ready(function () {
    ImgUpload();
});

    function ImgUpload() {
    var imgWrap = "";
    var imgArray = [];
  /*  @php
    $input = $storage->gallery;
    $array = json_decode($input, true);
    $modifiedArray = explode(",", $input);
    @endphp
    @foreach($modifiedArray as $img)
    imgArray.push('{{ $img }}')
    @endforeach*/

    for (let i = 0; i < imgArray; i++) {

}
    $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
    var maxLength = $(this).attr('data-max_length');
    var html = "";
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    var iterator = 0;
    filesArr.forEach(function (f, index) {

    if (!f.type.match('image.*')) {
    return;
}

    if (imgArray.length > maxLength) {
    return false
} else {
    var len = 0;
    for (var i = 0; i < imgArray.length; i++) {
    if (imgArray[i] !== undefined) {
    len++;
}
}
    if (len > maxLength) {
    return false;
} else {
    imgArray.push(f);
    var reader = new FileReader();
    reader.onload = function (e) {
    html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";

    imgWrap.append(html);
    iterator++;
}
    reader.readAsDataURL(f);
}
}
});
});
});

    $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
    if (imgArray[i].name === file) {
    imgArray.splice(i, 1);
    break;
}
}
    $(this).parent().parent().remove();
});
}

