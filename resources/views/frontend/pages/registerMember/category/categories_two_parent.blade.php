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
    function getCategory2() {
        function removeArray(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        function getListName(array, items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].checked) {
                    if (array.length == 0) {
                        array.push(items[i].nextElementSibling.innerText);
                    } else {
                        let name = array.includes(items[i].nextElementSibling.innerText);
                        if (!name) {
                            array.push(items[i].nextElementSibling.innerText);
                        }
                    }
                } else {
                    removeArray(array, items[i].nextElementSibling.innerText)
                }
            }
            return array;
        }

        function checkArray(array, listItems) {
            for (let i = 0; i < listItems.length; i++) {
                if (listItems[i].checked) {
                    if (array.length == 0) {
                        array.push(listItems[i].value);
                    } else {
                        let check = array.includes(listItems[i].value);
                        if (!check) {
                            array.push(listItems[i].value);
                        }
                    }
                } else {
                    removeArray(array, listItems[i].value);
                }
            }
            return array;
        }

        let arrayNameCategory2 = [];
        let arrayItem2 = [];
        $('.inputCheckboxCategory2').on('click', function () {
            let items = document.getElementsByClassName('inputCheckboxCategory2');

            arrayItem2 = checkArray(arrayItem2, items);
            arrayNameCategory2 = getListName(arrayNameCategory2, items);

            let listName = arrayNameCategory2.toString();

            let count = document.querySelectorAll('.inputCheckboxCategory2:checked').length
            if (count > 3) {
                $('.inputCheckboxCategory2:checkbox:not(:checked)').prop('disabled', true);
            } else {
                $('.inputCheckboxCategory2:checkbox:not(:checked)').prop('disabled', false);
            }

            if (listName) {
                $('#inputCheckboxCategory2').text(listName);
            } else {
                let text = $('#text-category').text();
                $('#inputCheckboxCategory2').text(text);
            }

            arrayItem2.sort();
            let value = arrayItem2.toString();
            $('#input_code3').val(value);
        })
    }

    getCategory2();
</script>
