<p>{{ __('home.Product attribute') }}: <span style="font-size: 16px; font-weight: 600">{{$attribute->name}}</span></p>
<div class="">
    @if($properties->isNotEmpty())
        <div class="row" id="property_{{$attribute->id}}">
            @foreach($properties as $property)
                <div class="col-md-3">
                    <div class="form-check mb-2">
                        @php
                            $isChecked = false;
                            $att_of_product = session()->get('att_of_product');
                            if (!$att_of_product) {
                                return back();
                            }
                            $att_of_product = $att_of_product[0];
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

                        <input value="{{$attribute->id}}-{{$property->id}}" type="checkbox"
                               class="inputAttributeProperty property-attribute checkbox{{$attribute->id}}"
                               {{ $isChecked ? 'checked' : '' }}
                               id="property_{{$property->id}}">
                        <label for="property_{{$property->id}}">
                            {{$property->name}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row" id="property_{{$attribute->id}}">
            <div class="col-md-3">
                <p class="text-center text-danger mb-2"> {{ __('home.None') }} </p>
            </div>
        </div>
    @endif
    <div class="col-md-3">
        <a class="btm btn-warning btnCreateProperty"
           data-id="{{$attribute->id}}">{{ __('home.Create now') }}
        </a>
    </div>
</div>
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

    async function generateFormProperty() {
        await $.ajax({
            url: '{{ route('call.attribute') }}',
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                console.log(response)
                $('#formAddProperty').empty().append(response);
            },
            error: function (xhr, status, error) {
                renderInputAttribute.append('<h3>Error</h3>');
            }
        })
    }
</script>