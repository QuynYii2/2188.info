<div class="row mb-3">
    <div class="form-group col-md-6">
        <label for="selectAttribute" class="s12w5">{{ __('home.Thông số sản phẩm') }}</label>
        <select class="form-control s12w5" name="attribute_id" id="selectAttribute">
            <option value="#"> --- {{ __('home.Chọn thuộc tính cha') }} ---</option>
            @foreach($attributes as $attribute)
                <option value="{{ $attribute->id }}" data-attribute="{{$attribute}}">
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
   <div class="col-md-6 d-flex align-items-center mt-2">
       <a class="btn btnCreateAttribute" id="btnCreateAttribute"> <i class="fa-solid fa-plus"></i> {{ __('home.Create new attribute') }} </a>
   </div>
</div>
<script>
    $(document).ready(function () {
        let myArray = [];
        $('#selectAttribute').on('change', function () {
            let attribute = $(this).data('id');
            let attributeID = $(this).val();
            let value = null;
            if (myArray.length == 0) {
                myArray.push(attributeID);
                value = attributeID;
            } else {
                let check = myArray.includes(attributeID);
                if (!check) {
                    myArray.push(attributeID);
                    value = attributeID;
                }
            }

            if (value) {
                renderProperty(value);
            }

        })

        $('#btnCreateAttribute').on('click', function () {
            $('#formAddAttribute').removeClass('d-none');
        })

        async function renderProperty(attributeID) {
            let url = '{{ route('get.property.by.attribute', ['id' => ':id']) }}';
            url = url.replace(':id', attributeID);

            await $.ajax({
                url: url,
                method: 'GET',
            })
                .done(function (response) {
                    $('#formRenderProperty').append(response);
                })
                .fail(function (_, textStatus) {
                    console.log(textStatus)
                });
        }
    })
</script>