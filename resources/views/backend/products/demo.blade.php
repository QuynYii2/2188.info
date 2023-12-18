<div class="container mb-5">
    <div id="formRenderAttribute">

    </div>
    <div id="formRenderProperty">

    </div>

    <div class="row d-none mt-5" id="formAddAttribute">
        <div class="col-md-6">
            <div class="card-header form-group mb-3">
                <label for="attribute_name">{{ __('home.Tên thuộc tính') }}</label>
                <input type="text" class="form-control" name="attribute_name" id="attribute_name">
            </div>
            <a class="btn btnSave" id="btnSubmitAttribute">{{ __('home.Create now') }}</a>
            <a class="btn btn-secondary" id="btnCloseAttribute">{{ __('home.Close') }}</a>
        </div>
    </div>

    <div class="row d-none mt-5" id="formAddProperty">

    </div>

    <div class="">
        <a id="btnSaveAttribute" class="btn btnSave mt-5">{{ __('home.Save attribute') }}</a>
    </div>
</div>

<input id="input-form-create-attribute" name="attribute_property" type="text" hidden>
<script>
    var token = `{{ csrf_token() }}`;
    var urlAllAttribute = `{{ route('get.all.attribute') }}`;
    var urlCreateAttribute = `{{ route('create.attribute') }}`;
    var urlProductCreateAttribute = `{{ route('product.create.attribute') }}`;
    var urlCreateProperty = `{{ route('create.property') }}`;
    var urlGetPropertyByAttribute = `{{ route('get.property.by.attribute', ['id' => ':id']) }}`;
</script>
<script src="{{ asset('js/backend/product/attribute-property.js') }}"></script>