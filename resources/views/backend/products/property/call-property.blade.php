@php
    $isChecked = false;
    $att_of_product = session()->get('att_of_product');
    if ($att_of_product){
        $att_of_product = $att_of_product[0];
    }
@endphp

@foreach($properties as $property)
    @php
        $isChecked = false;
    @endphp
    @if(isset($att_of_product))
        @foreach($att_of_product as $att)
            @if($att->attribute_id == $attribute->id )
                @php
                    $value = explode(',', $att->value);
                    foreach($value as $item){
                        if($item == $property->id ){
                            $isChecked = true;
                        }
                    }
                @endphp
            @endif
        @endforeach
    @endif
    <div class="col-md-3">
        <div class="form-check mb-2">
            <input value="{{$attribute->id}}-{{$property->id}}"
                   type="checkbox" class="inputAttributeProperty"
                   {{ $isChecked ? 'checked' : '' }}
                   id="property_{{$property->id}}">
            <label for="property_{{$property->id}}">
                @if(locationHelper() == 'kr')
                    {{ ($property->name_ko) }}
                @elseif(locationHelper() == 'cn')
                    {{ ($property->name_zh) }}
                @elseif(locationHelper() == 'jp')
                    {{ ($property->name_ja) }}
                @elseif(locationHelper() == 'vi')
                    {{ ($property->name_vi) }}
                @else
                    {{ ($property->name_en) }}
                @endif
            </label>
        </div>
    </div>
@endforeach
<script>
    $('.btnCreateProperty').on('click', function () {
        var attributeID = $(this).data('id');
        if (attributeID !== undefined) {
            $('#formAddProperty').removeClass('d-none');
            generateFormProperty();
            var select = document.getElementById('attribute_id');
            var options = select.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].value == attributeID) {
                    options[i].selected = true;
                    break;
                }
            }
        }
    });

    $('.inputAttributeProperty').on('change', function () {
        checkInput();
    })

    var properties = document.getElementsByClassName('inputAttributeProperty');
    var number = properties.length;

    function checkInput() {
        var propertyArray = [];
        var attributeArray = [];
        var myArray = [];
        for (i = 0; i < number; i++) {
            if (properties[i].checked) {
                const ArrPro = properties[i].value.split('-');
                myArray.push(properties[i].value);
                let attribute = ArrPro[0];
                let property = ArrPro[1];
                attributeArray.push(attribute);
                propertyArray.push(property);
            }
        }
        $('#input-form-create-attribute').val(myArray);
    }

    checkInput();
</script>