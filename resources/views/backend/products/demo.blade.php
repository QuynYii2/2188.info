<div class="container mb-5">
    <div class="row mb-5">
        <div class="col-md-4" id="formRenderAttribute">

        </div>
        <div class="col-md-8" id="formRenderProperty">

        </div>
    </div>

    <div class="row d-none mt-5" id="formAddAttribute">
        <div class="col-md-6">
            <div class="card-header form-group mb-3">
                <label for="attribute_name">{{ __('home.Tên thuộc tính') }}</label>
                <input type="text" class="form-control" name="attribute_name" id="attribute_name">
            </div>
            <a class="btn btn-success" id="btnSubmitAttribute">{{ __('home.Tạo mới') }}</a>
            <a class="btn btn-secondary" id="btnCloseAttribute">{{ __('home.Close') }}</a>
        </div>
    </div>

    <div class="row d-none mt-5" id="formAddProperty">

    </div>

    <div class="row mb-5" id="renderInputAttribute">

    </div>

    <div class="col mt-5">
        <a id="btnSaveAttribute" class="btn btn-success mt-5">{{ __('home.Save attribute') }}</a>
    </div>
</div>

<input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
<script>
    var token = `{{ csrf_token() }}`;
    var urlAllAttribute = `{{ route('get.all.attribute') }}`;
    var urlCreateAttribute = `{{ route('create.attribute') }}`;
    var urlProductCreateAttribute = `{{ route('product.create.attribute') }}`;
</script>
<script src="{{ asset('js/backend/product/attribute-property.js') }}"></script>