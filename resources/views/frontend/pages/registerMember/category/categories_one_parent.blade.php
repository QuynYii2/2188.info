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
               name="code_2[]"
               value="{{ ($category->id) }}"
               onchange="callCategory();"
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

    function callCategory() {
        let arrayItem1 = [];
        let items = document.getElementsByClassName('inputCheckboxCategory1');
        for (let i = 0; i < items.length; i++) {
            if (items[i].checked) {
                if (arrayItem1.length == 0) {
                    arrayItem1.push(items[i].value);
                } else {
                    let check = arrayItem1.includes(items[i].value);
                    if (!check) {
                        arrayItem1.push(items[i].value);
                    }
                }
            } else {
                removeArray(arrayItem1, items[i].value);
            }
        }
        renderCategory3(arrayItem1);
    }

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
