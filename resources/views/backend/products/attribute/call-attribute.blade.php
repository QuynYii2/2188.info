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

<script>
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
</script>