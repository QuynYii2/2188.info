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
        <div class="col-md-6">
            <div class="form-group">
                <label for="property_name">{{ __('home.Tên thuộc tính') }}</label>
                <input type="text" class="form-control" name="property_name" id="property_name">
            </div>
            <div class="form-group">
                <label for="attribute_id">{{ __('home.Chọn thuộc tính cha') }}:</label>
                <select class="form-control" id="attribute_id" name="attribute_id">
                    @foreach($attributes as $attribute)
                        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                    @endforeach
                </select>
            </div>

            <a class="btn btn-success" id="btnSubmitProperty">{{ __('home.Tạo mới') }}</a>
        </div>
    </div>

    <div class="row mb-5" id="renderInputAttribute">

    </div>

    <div class="col mt-5">
        <a id="btnSaveAttribute" class="btn btn-success mt-5">{{ __('home.Save attribute') }}</a>
    </div>
</div>

<input id="input-form-create-attribute" name="attribute_property" type="text" hidden>

<script>
    $(document).ready(function () {
        async function renderAttribute() {
            let url = '{{ route('get.all.attribute') }}';

            await $.ajax({
                url: url,
                method: 'GET',
            })
                .done(function (response) {
                    $('#formRenderAttribute').append(response);
                })
                .fail(function (_, textStatus) {
                    console.log(textStatus)
                });
        }

        renderAttribute();

        async function createAttributeItem() {
            let url = '{{ route('create.attribute') }}';
            let value = $('#attribute_name').val();

            await $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    attribute_name: value
                },
            })
                .done(function (response) {
                    alert('Success');
                    $('#formRenderAttribute').empty();
                    renderAttribute();
                })
                .fail(function (_, textStatus) {
                    alert('Error');
                    console.log(textStatus)
                });
        }

        $('#btnSubmitAttribute').on('click', function () {
            createAttributeItem();
        })

        $('#btnCloseAttribute').on('click', function () {
            $('#formAddAttribute').addClass('d-none');
        })

        async function createProperty() {
            let url = '{{ route('create.property') }}';
            let property_name = $('#property_name').val();
            let attribute_id = $('#attribute_id').val();

            await $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    property_name: property_name,
                    attribute_id: attribute_id
                },
            })
                .done(function (response) {
                    alert('Success');
                    let item = $('#property_' + attribute_id);
                    item.empty().append(response);
                    $('#formAddProperty').addClass('d-none');
                })
                .fail(function (_, textStatus) {
                    alert('Error');
                    console.log(textStatus)
                });
        }

        $('#btnSubmitProperty').on('click', function () {
            createProperty();
        })

        $('#btnSaveAttribute').on('click', function () {
            let attribute = document.getElementById('input-form-create-attribute').value;
            var renderInputAttribute = $('#renderInputAttribute');
            $.ajax({
                url: '{{ route('product.create.attribute') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    'attribute_property': attribute
                },
                success: function (response) {
                    console.log(response);
                    renderInputAttribute.empty().append(response);
                },
                error: function (xhr, status, error) {
                    renderInputAttribute.append('<h3>Error</h3>');
                }
            })
        })

    })
</script>