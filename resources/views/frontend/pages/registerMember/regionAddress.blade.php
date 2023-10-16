<style>
    .nation {
        display: inline-block;
        width: 250px;
        padding: 7px;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .bg-color-th1 {
        background-color: #e1dddd !important;
    }

    .bg-color-th2 {
        background-color: #c8e2f3 !important;
    }

    .bg-color-td1 {
        background-color: #fbf8f8 !important;
    }

    .bg-color-td2 {
        background-color: #f4f9fd !important;
    }

    .layer_tbl th {
        text-align: left;
        background: #f5f5f5;
        letter-spacing: -1px;
    }

    .layer_tbl th, .layer_tbl td {
        padding: 4px 5px;
        overflow: hidden;
        border-bottom: 1px dotted #e5e5e5;
    }

    .orange {
        color: orange;
    }

    .grey {
        color: grey;
    }
</style>

<div class="jumbotron jumbotron-fluid" id="title-div" style="display: none">
    <div class="container">
        <h1 class="title-main cursor-pointer" id="title-main"
            onclick="getListAddress()">{{ __('home.Address management ') }}</h1>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table cellspacing="0" cellpadding="0" class="regionWrap layer_tbl mt10 border" style="display: table;">
            <colgroup>
                <col width="230">
                <col width="/">
            </colgroup>
            <tbody id="p-r-table"></tbody>
        </table>
    </div>
</div>

<tr>
    <script>
        getListAddress();
        let nation_code = nation_name = '';
        let arrAddress = [];

        const MODE_CREATE = 'create'
        const MODE_EDIT = 'edit'

        async function getListAddress() {
            let url = '{{ route('address.index') }}';
            let result = await fetch(url);
            if (result.ok) {
                arrAddress = [];
                const data = await result.json();
                document.getElementById('p-r-table').innerHTML = '';
                document.getElementById('title-div').style.display = 'none';
                makeHTMLFromJson(data);
            }
        }

        async function getListAddressChild(code, name, name_en) {
            let url = '{{ route('address.detail', ['code' => ':code']) }}';
            url = url.replace(':code', code);
            let result = await fetch(url);
            arrAddress.push({
                name: name,
                name_en: name_en
            });
            if (result.ok) {
                const data = await result.json();
                nation_code = code;
                nation_name = name ?? name_en;
                document.getElementById('title-div').style.display = 'block';
                document.getElementById('title-main').innerHTML = name ?? name_en;
                makeHTMLFromJson(data);
            }
        }

        function makeHTMLFromJson(data) {
            let str = '';

            data.forEach((pItem, index) => {
                const classTh = index % 2 == 0 ? 'bg-color-th2' : 'bg-color-th1';
                const classTd = index % 2 == 0 ? 'bg-color-td2' : 'bg-color-td1';

                str += `<tr><th class="cont ${classTh} "><div class="text-center"><span class="cursor-pointer">${pItem.name_en ?? pItem.name ?? ''}</span></div>
                                </th>`
                if (pItem.total_child) {
                    str += `<td class="${classTd}">`;

                    if (typeof pItem.child === 'object') {
                        pItem.child = Object.values(pItem.child);
                    }

                    pItem.child.forEach((cItem) => {
                        str += ` <span class="nation">
                    <span
                            class="tit cursor-pointer"
                            onclick="getListAddressChild('${cItem.code}', '${cItem.name}', '${cItem.name_en}')">${cItem.name_en ?? ''} ${cItem.name ?? ''}</span>
                    <span class="skyblue ml10">
                    </span></span>`
                    });
                    str += `</td>`;
                }
                str += `</tr>`
            })
            const t_p_Body = document.getElementById('p-r-table');
            t_p_Body.innerHTML = str;

        }

        function handleSelectRegion() {
            let add_3 = '';
            let add_3_en = '';
            arrAddress.forEach((value, index) => {
                if (index == 0) {
                    $('#countries-select').val(value.name)
                    $('#countries-select-1').val(value.name_en)
                } else if (index == 1) {
                    $('#cities-select').val(value.name)
                    $('#cities-select-1').val(value.name_en)
                } else {
                    add_3 += value.name + ', '
                    add_3_en += value.name_en + ', '
                }
            });
            if (add_3) {
                add_3 = add_3.slice(0, -2);
                add_3_en = add_3_en.slice(0, -2);
                $('#provinces-select').val(add_3);
                $('#provinces-select-1').val(add_3_en);
            }
            $('#address_code').val(nation_code);
        }
    </script>