<div class="modal-body">
    @php
        if (!$testArray){
            $testArray = null;
        }
    @endphp
    <table class="table">
        <th></th>
        @foreach($listAtt as $att)
            <th scope="col">{{ $att->name }}</th>
        @endforeach
        <tbody>
        @if($testArray)
            @if(count($testArray) == 1)
                @php
                    $item = $testArray[0];
                @endphp
                @if(is_array($item))
                    @if(count($item) == 1)
                        @php
                            $attproArray =  explode('-', $item[0]);
                            $attribue = \App\Models\Attribute::find($attproArray[0]);
                            $property = \App\Models\Properties::find($attproArray[1]);
                        @endphp
                        <tr>
                            <td><input type="checkbox" name="select-att"></td>
                            <td>{{$property->name}}</td>
                        </tr>
                    @else
                        <tr>
                            <td><input type="checkbox" name="select-att"></td>
                            @foreach($item as $attpro)
                                @php
                                    $attproArray =  explode('-', $attpro);
                                    $attribute = \App\Models\Attribute::find($attproArray[0]);
                                    $property = \App\Models\Properties::find($attproArray[1]);
                                @endphp
                                <td>{{$property->name}}</td>
                            @endforeach
                        </tr>
                    @endif
                @else
                    @php
                        $myArray =  explode(',', $item);
                    @endphp
                    <tr>
                        <td><input type="checkbox" name="select-att"></td>
                        @foreach($myArray as $value)
                            @php
                                $attpro =  explode('-', $value);
                                $attribue = \App\Models\Attribute::find($attpro[0]);
                                $property = \App\Models\Properties::find($attpro[1]);
                            @endphp
                            <td>{{$property->name}}</td>
                        @endforeach
                    </tr>
                @endif

            @else
                @foreach($testArray as $item)
                    @php
                        $attributeProperty = explode(',', $item);
                    @endphp
                    <tr>
                        <td><input type="checkbox" name="select-att"></td>
                        @foreach($attributeProperty as $attpro)
                            @php
                                $attproArray =  explode('-', $attpro);
                                $attribue = \App\Models\Attribute::find($attproArray[0]);
                                $property = \App\Models\Properties::find($attproArray[1]);
                            @endphp
                            <td>{{$property->name}}</td>
                        @endforeach
                    </tr>
                @endforeach
            @endif
        @endif
        </tbody>
    </table>

</div>
