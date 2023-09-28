@foreach($properties as $property)
    <div class="col-md-3">
        <div class="form-check mb-2">
            <input value="{{$attribute}}-{{$property->id}}" type="checkbox" class="inputAttributeProperty"
                   id="property_{{$property->id}}">
            <label for="property_{{$property->id}}">
                {{$property->name}}
            </label>
        </div>
    </div>
@endforeach