
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
    var urlPostImg = `{{ route('file.img.save') }}`;
    var urlGetImg = `{{ route('file.img.get') }}`;
    var imgUrl =  `{{ asset('storage/') }}`;
    var token = `{{ csrf_token() }}`;
</script>
<script src="{{asset('js/backend/modal-media.js')}}"></script>