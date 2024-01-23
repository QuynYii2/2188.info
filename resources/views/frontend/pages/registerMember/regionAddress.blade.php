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
        $(document).ready(function () {
            $('#modal-address').on('shown.bs.modal', function () {
                getListAddress();
            });
        });
    </script>
    <script>
        getListAddress();
        let nation_code = nation_name = '';
        let arrAddress = [];
        let checkLevel = 1;

        const MODE_CREATE = 'create'
        const MODE_EDIT = 'edit'

        async function getListAddress() {
            let url = '{{ route('address.index') }}';
            let result = await fetch(url);
            if (result.ok) {
                checkLevel = 1;
                arrAddress = [];
                let data = await result.json();
                document.getElementById('p-r-table').innerHTML = '';
                document.getElementById('title-div').style.display = 'none';
                if (typeof data === 'object') {
                    data = Object.values(data);
                }
                makeHTMLFromJson(data);
            }
        }

        async function getListAddressChild(code, name, name_en) {
            let url = '';
            if (checkLevel == 1) {
                url = '{{ route('address.show.region', ['code' => ':code']) }}';
                url = url.replace(':code', code);
            } else {
                url = '{{ route('api.address.detail', ['code' => ':code']) }}';
                url = url.replace(':code', code);
            }
            let result = await fetch(url);
            arrAddress.push({
                name: name,
                name_en: name_en
            });

            let name_item = name === 'null' ? name_en : name;
            if (result.ok) {
                let data = await result.json();
                nation_code = code;
                nation_name = name_item;
                document.getElementById('title-div').style.display = 'block';
                document.getElementById('title-main').innerHTML = name_item;
                if (typeof data === 'object') {
                    data = Object.values(data);
                }
                makeHTMLFromJson(data);
                checkLevel++;
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
            resetAddress();
            console.log(arrAddress);
            arrAddress.forEach((value, index) => {
                const name = value.name === 'null' ? value.name_en : value.name;
                const name_en = value.name_en === 'null' ? value.name : value.name_en;

                switch (index) {
                    case 0:
                        $('#countries-select').val(name_en);
                        $('#countries-select-1').val(name);
                        break;
                    case 1:
                        $('#cities-select').val(name_en);
                        $('#cities-select-1').val(name);
                        break;
                    default:
                        add_3 += name + ', ';
                        add_3_en += name_en + ', ';
                        break;
                }
            });

            add_3 = add_3.slice(0, -2);
            add_3_en = add_3_en.slice(0, -2);

            if (add_3) {
                add_3 = add_3.slice(0, -2);
                add_3_en = add_3_en.slice(0, -2);
                $('#provinces-select').val(add_3_en);
                $('#provinces-select-1').val(add_3);
            }
            $('#address_code').val(nation_code);
        }

        function resetAddress() {
            $('#countries-select').val('')
            $('#countries-select-1').val('')
            $('#cities-select').val('')
            $('#cities-select-1').val('')
            $('#provinces-select').val('');
            $('#provinces-select-1').val('');
            $('#address_code').val('');
        }
    </script>