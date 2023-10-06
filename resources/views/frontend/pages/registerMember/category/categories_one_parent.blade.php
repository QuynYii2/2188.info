@foreach($categories_one_parent as $category)
    @php
        $isChecked = null;
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
    <label class="ml-2 d-flex align-items-center" for="code_2-{{$category->id}}">
        <input type="checkbox" id="code_2-{{$category->id}}"
               {{--               name="code_2[]"--}}
               value="{{ ($category->id) }}"
               onclick="getCategory1();"
               {{ $isChecked ? 'checked' : '' }}
               class="inputCheckboxCategory1 mr-2 p-3"/>
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
    function getCategory1() {
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

        let arrayNameCategory1 = [];
        let arrayItem1 = [];

        async function callCategory() {
            let items = document.getElementsByClassName('inputCheckboxCategory1');

            arrayItem1 = checkArray(arrayItem1, items);
            arrayNameCategory1 = getListName(arrayNameCategory1, items);

            let listName = arrayNameCategory1.toString();

            if (listName) {
                $('#inputCheckboxCategory1').text(listName);
                await renderCategory3(arrayItem1);
            } else {
                $('#inputCheckboxCategory1').text(`{{ __('home.Select the applicable category') }}`);
            }

            arrayItem1.sort();
            let value = arrayItem1.toString();
            $('#input_code2').val(value);
        }

        callCategory();
    }

    getCategory1();

    async function renderCategory3(value) {
        let url = '{{ route('get.category.two.parent') }}';

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                listCategoryID: value,
                arrayCategory: $('#inputArrayCategory').val(),
                _token: '{{ csrf_token() }}',
            }
        })
            .done(function (response) {
                $('#code_3').empty().append(response);
            })
            .fail(function (_, textStatus) {

            });
    }
</script>
