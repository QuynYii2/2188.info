@foreach($categories_two_parent as $category)
    @php
        $isChecked = false;
    @endphp
    @if(is_array($arrayCategory))
        @foreach($arrayCategory as $item)
            @php
                if ($category->id == $item){
                    $isChecked = true;
                    break;
                }
            @endphp
        @endforeach
    @endif
    <label class="ml-2 d-flex align-items-center" for="code_3-{{$category->id}}">
        <input type="checkbox" id="code_3-{{$category->id}}"
               {{--               name="code_3[]"--}}
               value="{{ ($category->id) }}"
               {{ $isChecked ? 'checked' : '' }}
               class="inputCheckboxCategory2 mr-2 p-3"/>
        <span class="labelCheckboxCategory">
            @if(locationHelper() == 'kr')
                <div class="item-text">{{ $category->name_ko }}</div>
            @elseif(locationHelper() == 'cn')
                <div class="item-text">{{$category->name_zh}}</div>
            @elseif(locationHelper() == 'jp')
                <div class="item-text">{{$category->name_ja}}</div>
            @elseif(locationHelper() == 'vi')
                <div class="item-text">{{$category->name_vi}}</div>
            @else
                <div class="item-text">{{$category->name_en}}</div>
            @endif</span>
    </label>
@endforeach
<script>
    $('.inputCheckboxCategory2').on('click', function () {
        let arrayItem2 = [];
        let items = document.getElementsByClassName('inputCheckboxCategory2');
        for (let i = 0; i < items.length; i++) {
            if (items[i].checked) {
                if (arrayItem2.length == 0) {
                    arrayItem2.push(items[i].value);
                } else {
                    let check = arrayItem2.includes(items[i].value);
                    if (!check) {
                        arrayItem2.push(items[i].value);
                    }
                }
            } else {
                removeArray(arrayItem2, items[i].value);
            }
        }
        arrayItem2.sort();
        let value = arrayItem2.toString();
        $('#input_code3').val(value);
    })
</script>
