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
