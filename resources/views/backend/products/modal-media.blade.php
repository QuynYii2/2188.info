
<meta name="csrf-token" content="{{ csrf_token() }}">

<button type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#galleryModal" id="button-open-modal">
    {{ __('home.Chọn ảnh') }}
</button>

<div class="modal fade" id="galleryModal" style="z-index: 99999; display: none" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog h-100" style="max-width: 60%; max-height: 80%">
        <div class="modal-content h-100">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Modal title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="upload-tab" data-toggle="tab" data-target="#upload-media"
                                type="button" role="tab" aria-controls="home" aria-selected="true">{{ __('home.Upload File') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="media-tab" data-toggle="tab" data-target="#list-media"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">{{ __('home.Media') }}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="height: 95%">
                    <div class="tab-pane fade show active h-100" id="upload-media" role="tabpanel"
                         aria-labelledby="upload-tab">
                        <div class="file-upload h-100">
                            <label class="file-upload__label">Select or drop files here</label><input
                                    class="file-upload__input" multiple type="file" accept="image/*">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-media" role="tabpanel" aria-labelledby="media-tab">
                        <div class="attachments-wrapper w-100" id="gallery-container">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="choseImageToUse(1)">{{ __('home.Chọn làm ảnh Thumbnail') }}
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="choseImageToUse(2)">{{ __('home.Chọn làm ảnh Gallery') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
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
                    url: '{{ route('file.img.save') }}',
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

    getListImg();

    function getListImg() {
        $.ajax({
            url: '{{ route('file.img.get') }}',
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
                        '<img src="{{ asset('storage/') }}/' + img + '" draggable="false" alt="">' +
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
            //
            // if (fileUploaded.includes(imgSrc)) {
            //
            //     imgElement.parentElement.classList.add("selected-image");
            // }
            //

            const isImageSelected = fileUploaded.some((fileName) => fileName === imgSrc);

            if (isImageSelected) {
                imgElement.parentElement.classList.add("selected-image");
            }
        });
    }

</script>