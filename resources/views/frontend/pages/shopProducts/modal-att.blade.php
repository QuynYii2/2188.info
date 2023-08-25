
@php
    $testArray = session()->get('testArray');
    if ($testArray){
     $testArray = $testArray[0];
    } else {
        $testArray = null;
    }
@endphp

@if($testArray)
<button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#modal-show-att">
    Xem thuộc tính
</button>
@endif

<div class="modal fade" id="modal-show-att" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
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
                                        <td>{{$property->name}}</td>
                                    </tr>
                                @else
                                    <tr>
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
                            <br>
                            <br>
                        @endif
                    @endif
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
