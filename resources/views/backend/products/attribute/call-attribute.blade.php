<div class="col-md-6">
    <div class="form-group">
        <label for="property_name">{{ __('home.Tên thuộc tính') }}</label>
        <input type="text" class="form-control" name="property_name" id="property_name">
    </div>
    <div class="form-group">
        <label for="attribute_id">{{ __('home.Chọn thuộc tính cha') }}:</label>
        <select class="form-control" id="attribute_id" name="attribute_id">
            @foreach($attributes as $attribute)
                <option value="{{$attribute->id}}">
                    @if(locationHelper() == 'kr')
                        {{ ($attribute->name_ko) }}
                    @elseif(locationHelper() == 'cn')
                        {{ ($attribute->name_zh) }}
                    @elseif(locationHelper() == 'jp')
                        {{ ($attribute->name_ja) }}
                    @elseif(locationHelper() == 'vi')
                        {{ ($attribute->name_vi) }}
                    @else
                        {{ ($attribute->name_en) }}
                    @endif
                </option>
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

        if (property_name && property_name != '') {
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
                    $('#property_name').prop('required', false);
                })
                .fail(function (_, textStatus) {
                    alert('Error');
                    console.log(textStatus)
                });
        } else {
            alert('Please enter name property!');
        }
    }

    $('#btnSubmitProperty').on('click', function () {
        createProperty();
    })
</script>