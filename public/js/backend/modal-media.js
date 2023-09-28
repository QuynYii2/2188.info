let selectedImagesArray = [];

function toggleImageSelect(divElement) {
    divElement.classList.toggle("selected-image");

    const selectedImages = document.querySelectorAll(".thumbnail.image-item.selected-image img");

    selectedImagesArray.length = 0;

    selectedImages.forEach((selectedImage) => {
        selectedImagesArray.push(selectedImage.src);
    });
}

function choseImageToUse(check) {
    switch (check) {
        case 1:
            document.getElementById('imgThumbnail').value = selectedImagesArray[0];
            if (selectedImagesArray.length > 1) {
                alert('Avatar sẽ là ảnh đầu tiên')
            }
            const selectedImages = document.querySelectorAll(".thumbnail.image-item.selected-image");

            selectedImages.forEach(function (element) {
                element.classList.remove("selected-image");
            });
            renderImg('thumbnail');
            break;
        case 2:
            document.getElementById('imgGallery').value = JSON.stringify(selectedImagesArray);
            selectedImagesArray = [];
            renderImg('gallery');
            break;
    }
}

(function () {
    $(function () {
        return $('.file-upload__input').on('change', function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData();

            const listFile = this.files;
            for (let i = 0; i < listFile.length; i++) {
                formData.append('gallery[]', listFile[i]);
            }
            formData.append('_token', csrfToken);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: async function (response) {
                    alert('Upload success')
                    await getListImg();
                    await handleAfterUpload(response.split(','));
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
            return $('.file-upload__label').html([this.files.length, 'Files to upload'].join(' '));
        });
    });

}).call(this);

getListImg(imgUrl);

function getListImg(imgUrl) {
    $.ajax({
        url: urla,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            var galleryContainer = $('#gallery-container');
            galleryContainer.empty();

            $.each(response, function (index, img) {
                var imageItem = '<div class="attachment">' +
                    '<div class="attachment-preview portrait">' +
                    '<div class="thumbnail image-item" onclick="toggleImageSelect(this)">' +
                    '<div class="centered">' +
                    '<img src="' + imgUrl + '/' + img + '" draggable="false" alt="">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                galleryContainer.append(imageItem);
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}

function renderImg(whereRender) {
    switch (whereRender) {
        case 'thumbnail': {
            const imageContainer = document.getElementById('list-img-thumbnail');
            imageContainer.innerHTML = "";
            const label = document.createElement('label');
            label.textContent = 'Thumbnail';
            imageContainer.appendChild(label);

            const thumbnailImg = document.getElementById('imgThumbnail').value;
            const imgElement = document.createElement('img');
            imgElement.src = thumbnailImg;
            imgElement.style.height = '100px';
            imgElement.style.width = '100px';
            imgElement.classList.toggle('m-2')
            imgElement.classList.toggle('ml-0')
            imageContainer.appendChild(imgElement);
            break;
        }
        case 'gallery': {
            const imageContainer = document.getElementById('list-img-gallery');
            imageContainer.innerHTML = "";
            const arrGallery = document.getElementById('imgGallery').value;
            const label = document.createElement('label');
            label.textContent = 'Gallery';
            imageContainer.appendChild(label);

            JSON.parse(arrGallery).forEach(function (url) {
                const imgElement = document.createElement('img');
                imgElement.src = url;
                imgElement.style.height = '100px';
                imgElement.style.width = '100px';
                imgElement.classList.toggle('m-2')
                imgElement.classList.toggle('ml-0')
                imageContainer.appendChild(imgElement);
            });
            break;
        }
    }
    document.getElementById('button-open-modal').textContent = 'Sửa ảnh'
}

function handleAfterUpload(fileUploaded) {
    const mediaTabButton = document.getElementById('media-tab');
    mediaTabButton.click();
    const thumbnailImageItems = document.querySelectorAll(".thumbnail.image-item img");

    thumbnailImageItems.forEach((imgElement) => {
        const imgSrc = imgElement.src.match(/\/storage\/([^,]+),?/)[1];
        const isImageSelected = fileUploaded.some((fileName) => fileName === imgSrc);
        console.log(isImageSelected);
        if (isImageSelected) {
            imgElement.parentElement.classList.add("selected-image");
        }
    });
}

