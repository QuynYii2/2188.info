<style>
    .file-upload__label {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 30px;
        color: #000;
        font-size: 16px;
        left: 50%;
        padding: 5px 10px;
        cursor: pointer;
        outline: none;
        padding: 15px;
        pointer-events: none;
        position: absolute;
        text-align: center;
        top: 50%;
        -moz-transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        -webkit-user-select: none;
        white-space: nowrap;
        width: 200px;
    }
    .file-upload__input {
        bottom: 0;
        color: transparent;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: relative;
        right: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }
    .selected-image {
        border: 2px solid blue;
    }
    @media all {
        .media-frame-router {
            position: absolute;
            top: 50px;
            left: 200px;
            right: 0;
            height: 36px;
            z-index: 200;
        }

        .media-frame {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            font-size: 12px;
            -webkit-overflow-scrolling: touch;
            overflow: hidden;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .media-modal-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: auto;
            min-height: 300px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .7);
            background: #fff;
            -webkit-font-smoothing: subpixel-antialiased;
        }

        .media-modal {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            font-size: 12px;
            -webkit-overflow-scrolling: touch;
            position: fixed;
            top: 30px;
            left: 30px;
            right: 30px;
            bottom: 30px;
            z-index: 160000;
        }

        .media-router .media-menu-item {
            position: relative;
            float: left;
            border: 0;
            margin: 0;
            padding: 8px 10px 9px;
            height: 18px;
            line-height: 1.28571428;
            font-size: 14px;
            text-decoration: none;
            background: 0 0;
            cursor: pointer;
            transition: none;
        }

        .media-menu-item:active, .media-menu-item:hover {
            color: #2271b1;
        }

        .attachments-wrapper {
            position: absolute;
            top: 72px;
            left: 0;
            right: 300px;
            bottom: 0;
            overflow: auto;
            outline: 0;
        }

        .media-frame .attachments-browser {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .media-frame-content {
            position: absolute;
            top: 84px;
            left: 200px;
            right: 0;
            bottom: 61px;
            height: auto;
            width: auto;
            margin: 0;
            overflow: auto;
            background: #fff;
            border-top: 1px solid #dcdcde;
        }

        .attachments {
            margin: 0;
            -webkit-overflow-scrolling: touch;
            padding: 2px 8px 8px;
        }

        .load-more-wrapper {
            clear: both;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 1em 0;
        }

        .load-more-wrapper:after {
            content: "";
            min-width: 100%;
            order: 1;
        }

        .attachment {
            position: relative;
            float: left;
            padding: 8px;
            margin: 0;
            color: #3c434a;
            list-style: none;
            text-align: center;
            -webkit-user-select: none;
            user-select: none;
            width: 25%;
            box-sizing: border-box;
        }

        .media-frame-content[data-columns="9"] .attachment {
            width: 11.11%;
        }

        .spinner {
            background: url(http://localhost/wordpress/wp-admin/images/spinner.gif) no-repeat;
            background-size: 20px 20px;
            display: inline-block;
            visibility: hidden;
            float: right;
            vertical-align: middle;
            opacity: .7;
            width: 20px;
            height: 20px;
            margin: 4px 10px 0;
            background-image: url("http://localhost/wordpress/wp-admin/images/spinner.gif");
            background-position-x: initial;
            background-position-y: initial;
            background-repeat-x: no-repeat;
            background-repeat-y: no-repeat;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
        }

        .spinner {
            background: url(http://localhost/wordpress/wp-includes/images/spinner.gif) no-repeat;
            background-size: 20px 20px;
            float: right;
            display: inline-block;
            visibility: hidden;
            opacity: .7;
            width: 20px;
            height: 20px;
            margin: 0;
            vertical-align: middle;
            background-image: url("http://localhost/wordpress/wp-includes/images/spinner.gif");
            background-position-x: initial;
            background-position-y: initial;
            background-repeat-x: no-repeat;
            background-repeat-y: no-repeat;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
        }

        .load-more-wrapper .load-more-count {
            min-width: 100%;
            margin: 0 0 1em;
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .hidden {
            display: none;
        }

        .load-more-wrapper .load-more {
            margin: 0;
        }

        .button.hidden {
            display: none;
        }

        .button:hover {
            background: #f0f0f1;
            border-color: #0a4b78;
            color: #0a4b78;
        }

        .load-more-wrapper .load-more-jump {
            margin: 0 0 0 12px;
        }

        .button:disabled, .button[disabled] {
            color: #a7aaad !important;
            border-color: #dcdcde !important;
            background: #f6f7f7 !important;
            box-shadow: none !important;
            cursor: default;
            transform: none !important;
        }

        .attachment-preview {
            position: relative;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, .1), inset 0 0 0 1px rgba(0, 0, 0, .05);
            background: #f0f0f1;
            cursor: pointer;
        }

        .attachment-preview:before {
            content: "";
            display: block;
            padding-top: 100%;
        }

        .attachment .thumbnail {
            overflow: hidden;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 1;
            transition: opacity .1s;
        }

        .attachment .thumbnail:after {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .1);
            overflow: hidden;
        }

        .attachment .thumbnail .centered {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: translate(50%, 50%);
        }


        .attachment .portrait img {
            max-width: 100%;
        }

        .attachment .thumbnail img {
            top: 0;
            left: 0;
            position: absolute;
        }

        .attachment .thumbnail .centered img {
            transform: translate(-50%, -50%);
        }

        .attachment .landscape img {
            max-height: 100%;
        }
    }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<button type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#exampleModal">
    Launch demo modal
</button>
<div class="modal fade" id="exampleModal" style="z-index: 99999; display: none" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog h-100" style="max-width: 60%; max-height: 80%">
        <div class="modal-content h-100">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#upload-media"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Upload File
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#list-media"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Media
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent" style="height: 95%">
                    <div class="tab-pane fade show active h-100" id="upload-media" role="tabpanel"
                         aria-labelledby="home-tab">
                        <div class="file-upload h-100">
                            <label class="file-upload__label">Select or drop files here</label><input
                                    class="file-upload__input" multiple type="file" accept="image/*">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list-media" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="attachments-wrapper w-100" id="gallery-container">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const selectedImagesArray = []; // Mảng lưu trữ src của ảnh đã chọn

    function toggleImageSelection(divElement) {
        divElement.classList.toggle("selected-image");

        // Lấy danh sách ảnh đã chọn
        const selectedImages = document.querySelectorAll(".thumbnail.image-item.selected-image img");

        // Cập nhật lại mảng src của ảnh đã chọn
        selectedImagesArray.length = 0; // Xóa toàn bộ phần tử trong mảng trước khi cập nhật

        selectedImages.forEach((selectedImage) => {
            selectedImagesArray.push(selectedImage.src);
        });

        document.getElementById('imgGallery').value = JSON.stringify(selectedImagesArray);
    }

    (function () {
        $(function () {
            return $('.file-upload__input').on('change', function () {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData();

                for (let i = 0; i < this.files.length; i++) {
                    formData.append('gallery[]', this.files[i]);
                }
                formData.append('_token', csrfToken);

                $.ajax({
                    url: '{{ route('file.img.save') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        alert('Upload success')
                        getListImg();
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
                        '<div class="thumbnail image-item" onclick="toggleImageSelection(this)">' +
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
</script>