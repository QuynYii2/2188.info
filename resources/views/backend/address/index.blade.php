@extends('backend.layouts.master')
@section('title')
    Address Management
@endsection
@section('content')
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
                <tbody id="p-table"></tbody>
                <tr>
                    <th>
                        <button id="btnMod2" name="btnMod2" class="sky"
                                onclick="createOrEditRegion('','', `${MODE_CREATE}`, `${elementTh}`, -1, 0)"
                                data-toggle="modal" data-target="#createRegion"
                                style="margin-top:0; width:230px;">+ {{ __('home.Add continent') }}
                        </button>
                    </th>
                    <td></td>
                </tr>
                <tbody id="c-table"></tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="createRegion" tabindex="-1" aria-labelledby="exampleCreateRegion" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Add region') }}</h5>
                    <div id="showBtnDeleteOrClose">

                    </div>
                </div>
                <input type="text" class="d-none" id="data_num" name="data_num" value="">
                <form id="form-modify-address">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="layer_contents">
                            <table cellspacing="0" cellpadding="0" class="layer_tbl">
                                <colgroup>
                                    <col width="25%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="40%">
                                </colgroup>
                                <tbody>
                                <tr>
                                    <th scope="row">{{ __('home.Add continent') }}</th>
                                    <td colspan="3"><input type="text" disabled id="up_name" name="up_name" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('home.Name English1') }}</th>
                                    <td colspan="3"><input type="text" id="name_en" name="name_en" style="width:98%">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('home.Name (Own language)') }}</th>
                                    <td colspan="3"><input type="text" id="name" name="name" style="width:98%"></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="a8">{{ __('home.stt') }}</label></th>
                                    <td>
                                        <input type="number" id="sort_index" name="sort_index"
                                               style="width:98%;">
                                    </td>
                                    <th scope="row">{{ __('home.Use this or not?') }}</th>
                                    <td>
                                        <input type="radio" id="use_yn1" name="status" value="1"
                                               checked="checked"><label class="int_space"
                                                                        for="use_yn1">{{ __('home.yes') }}</label>
                                        <input type="radio" id="use_yn2" name="status" value="0"><label
                                                class="int_space" for="use_yn2">{{ __('home.no') }}</label>
                                    </td>
                                </tr>

                                <input type="text" class="d-none" id="up_code" name="up_code" value="">
                                <input type="text" class="d-none" id="mode" name="mode" value="">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('home.Close') }}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                                onclick="handleSubmitFormAddress()">{{ __('home.Lưu') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        getListAddress();
        let checkLevel = 1;
        let index_main = 1;
        let nation_code = nation_name = '';
        let elementTh = 'th';
        let elementTd = 'td';
        let modeForAppend = elementForAppend = indexForAppend = ''
        let arrAddress2 = [];
        const ID_MASTER = 1;
        const ID_CHILD = 2;
        let isFirst = true;
        let isCallback = true;

        const MODE_CREATE = 'create'
        const MODE_EDIT = 'edit'
        // getListAddressChild('6X!TM', 'G63', 1)
        // getListAddressChild('6X!TM!R3!NS', 'Maybach S450', 1)
        async function getListAddress() {
            let url = '{{ route('admin.address.index') }}';
            let result = await fetch(url);
            if (result.ok) {
                isFirst = true;
                checkLevel = 1;
                index_main = 1;
                const data = await result.json();
                document.getElementById('p-table').innerHTML = '';
                document.getElementById('c-table').innerHTML = '';
                document.getElementById('title-div').style.display = 'none';
                makeHTMLFromJson(data);

                setTextButton(ID_MASTER);

                if (isCallback) {
                    const addIn4 = {
                        level: checkLevel,
                        code: '',
                        name: name,
                        data_num: '',
                    };
                    checkKeyArrMap(addIn4);
                }

            }
        }

        async function setIsShow(id) {
            let url = '{{ route('admin.address.change.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            let result = await fetch(url);
            let star = document.getElementById('myStar-' + id)
            if (result.ok) {
                if (star.classList.contains('orange')) {
                    star.classList.remove("orange");
                    star.classList.add("grey");
                } else {
                    star.classList.add("orange");
                    star.classList.remove("grey");
                }
            }
        }

        function createOrEditRegion(code, name, mode, element, index, id) {

            modeForAppend = mode;
            elementForAppend = element;
            indexForAppend = index;

            resetFormModal();

            $('#up_name').val(name)
            $('#up_code').val(code)
            $('#mode').val(mode)

            if (mode == MODE_EDIT) {
                getById(code);
                renderListBtn(code)
            }
            if (mode == MODE_CREATE && !code && !name) {
                if (isFirst) {
                    nation_name = '';
                    nation_code = '';
                }

                document.getElementById('up_name').value = nation_name;
                document.getElementById('up_code').value = nation_code;

                document.getElementById('showBtnDeleteOrClose').innerHTML = '';
            } else {
                renderListBtn(id);
            }
        }

        async function getListAddressChild(code, name, data_num) {
            let arrayCode = code.split('!');
            console.log('data_num 222', data_num)
            document.getElementById('data_num').value = data_num;
            console.log('data_num 2223333', document.getElementById('data_num').value)

            console.log(arrayCode, code);
            let url = '';
            console.log(checkLevel);
            if (checkLevel == 1) {
                console.log('region');
                url = '{{ route('admin.address.show.region', ['code' => ':code']) }}';
                url = url.replace(':code', code);
            } else {
                console.log('default')
                url = '{{ route('admin.address.show', ['code' => ':code']) }}';
                url = url.replace(':code', code);
            }
            let result = await fetch(url);
            duyetTheTr(data_num);

            if (result.ok) {
                isFirst = false;

                const data = await result.json();
                if (checkLevel == 1) {
                    nation_code = code;
                    nation_name = name;
                    document.getElementById('title-div').style.display = 'block';
                    document.getElementById('title-main').innerHTML = name;
                }
                makeHTMLFromJson(data, data_num);
                checkLevel++;
                index_main++;
                setTextButton(ID_CHILD);

                if (isCallback) {
                    const addIn4 = {
                        level: checkLevel,
                        code: code,
                        name: name,
                        data_num: data_num,
                    };
                    checkKeyArrMap(addIn4);
                }

            }
        }

        async function supGetListChildRegion(code, name, data_num) {
            let url = '{{ route('admin.address.show', ['code' => ':code']) }}';
            url = url.replace(':code', code);
            let result = await fetch(url);


            if (result.ok){
                let data = await result.json();

                console.log("data", data)
                supRenderAddressChild(data);
                index_main++;
            }


        }

        function supRenderAddressChild(data) {
            let str = ``;
            console.log('sdfsd', data)
            for (let i = 0; i < data.length; i++) {
                let item = data[i];

                const classTh = i % 2 == 0 ? 'bg-color-th2' : 'bg-color-th1';
                const classTd = i % 2 == 0 ? 'bg-color-td2' : 'bg-color-td1';

                str += `<tr id="data-num-${index_main}" data-num="${index_main}"><th class="cont ${classTh} "><div class="text-center"><span class="cursor-pointer">${item.name_en ?? item.name ?? ''}</span></div>
                                    <div class="mt5 text-center"><span class="minBtn ml20"> <span class="cursor-pointer button-create-region"
                                                                                                            data-id="'${item.id}'"
                                                                                                             onclick="createOrEditRegion('${item.code}','${item.name_en ?? item.name}', '${MODE_CREATE}', '${elementTd}', '${i}' , '${item.id}')"
                                                                                                             data-toggle="modal" data-target="#createRegion">{{ __('home.Add nation') }}</span></span>
                                    </div>
                                </th>`
                if (item.total_child) {
                    str += `<td class="${classTd} w-100" id="td-region-${i}">`;
                    let listChild = item.child;
                    for (let j = 0; j < listChild.length; j++) {
                        let child = listChild[j];
                        str += ` <span class="nation" id="span-id-${child.code}">`;
                        str += `<span
                            class="tit cursor-pointer" data-num="${index_main}"
                            onclick="getListAddressChild('${child.code}', '${child.name_en ?? child.name ?? ''}', ${index_main})">${child.name_en ?? ''} ${child.name ?? ''}</span>
                     <span class="cursor-pointer" data-toggle="modal" data-target="#createRegion"
                    onclick="createOrEditRegion('${child.id}','${child.name_en ?? child.name}', '${MODE_EDIT}', '${elementTd}', '${j}', '${child.id}')">▤</span>
                    </span>`
                    }

                    str += `</td>`;
                }
                str += `</tr>`
            }
            const t_p_Body = document.getElementById('c-table');
            console.log("cccccccccc")
            t_p_Body.querySelectorAll('tr').forEach(e=>{
                console.log("ddddddddd")
                console.log(Number(e.getAttribute('id').replace("data-num-", "")))
                console.log(index_main)
                if (Number(e.getAttribute('id').replace("data-num-", "")) >= index_main - 1){
                    t_p_Body.removeChild(e)
                }
            })
            t_p_Body.innerHTML += str;

        }

        function duyetTheTr(index) {
            let i = ++index;
            let checkindex = 0;
            do {
                const element = document.querySelector(`tr[data-num="${i}"]`);
                if (element) {
                    element.remove()
                    i++;
                    if (checkindex == 0) {
                        index_main = index;
                    }
                    checkindex++;
                } else {
                    break;
                }
            } while (true)

        }

        async function getById(id) {
            let url = '{{ route('admin.address.get.by.id', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            let result = await fetch(url);
            if (result.ok) {
                let data = await result.json();
                data = data[0];
                loadDataToModal(data);
            }
        }

        function loadDataToModal(data) {
            document.getElementById('up_name').value = data.name;
            document.getElementById('name_en').value = data.name_en;
            document.getElementById('name').value = data.name;
            document.getElementById('sort_index').value = data.sort_index;
            document.getElementsByName('status').value = data.status;
        }

        function resetFormModal() {
            document.getElementById('form-modify-address').reset();
        }

        function makeHTMLFromJson(data, data_num) {
            const isTable = checkLevel == 1;
            let str = '';
            console.log(data)

            data.forEach((pItem, index) => {
                const classTh = index % 2 == 0 ? 'bg-color-th2' : 'bg-color-th1';
                const classTd = index % 2 == 0 ? 'bg-color-td2' : 'bg-color-td1';

                str += `<tr id="data-num-${index_main}" data-num="${index_main}"><th class="cont ${classTh} "><div class="text-center"><span class="cursor-pointer">${pItem.name_en ?? pItem.name ?? ''}</span></div>
                                    <div class="mt5 text-center"><span class="minBtn ml20"> <span class="cursor-pointer button-create-region"
                                                                                                            data-id="'${pItem.id}'"
                                                                                                             onclick="createOrEditRegion('${pItem.code}','${pItem.name_en ?? pItem.name}', '${MODE_CREATE}', '${elementTd}', '${index}' , '${pItem.id}')"
                                                                                                             data-toggle="modal" data-target="#createRegion">{{ __('home.Add nation') }}</span></span>
                                    </div>
                                </th>`
                if (pItem.total_child) {
                    str += `<td class="${classTd} w-100" id="td-region-${index}">`;
                    pItem.child.forEach((cItem) => {
                        str += ` <span class="nation" id="span-id-${cItem.code}">`;
                        if (isTable) {
                            str += `<span class="tit cursor-pointer ${cItem.isShow == 1 ? 'orange' : 'grey'} " onclick="setIsShow('${cItem.id}')" id="myStar-${cItem.id}">★ </span>`;
                        }
                        str += `<span
                            class="tit cursor-pointer" data-num="${index_main}"
                            onclick="getListAddressChild('${cItem.code}', '${cItem.name_en ?? cItem.name ?? ''}', ${index_main})">${cItem.name_en ?? ''} ${cItem.name ?? ''}</span>
                     <span class="cursor-pointer" data-toggle="modal" data-target="#createRegion"
                    onclick="createOrEditRegion('${cItem.id}','${cItem.name_en ?? cItem.name}', '${MODE_EDIT}', '${elementTd}', '${index}', '${cItem.id}')">▤</span>
                    </span>`
                    })
                    str += `</td>`;
                }
                str += `</tr>`
            })

            if (isTable) {
                const t_p_Body = document.getElementById('p-table');
                t_p_Body.innerHTML = str;
            } else {
                const t_p_Body = document.getElementById('c-table');
                t_p_Body.querySelectorAll('tr').forEach(e=>{
                    console.log("ddddddddd")
                    console.log(Number(e.getAttribute('id').replace("data-num-", "")))
                    console.log('main: ', data_num)
                    if (Number(e.getAttribute('id').replace("data-num-", "")) > data_num){
                        t_p_Body.removeChild(e)
                    }
                })
                t_p_Body.innerHTML += str;
            }

        }

        async function handleSubmitFormAddress() {
            const formData = new FormData();
            formData.append('up_name', document.getElementById('up_name').value);
            formData.append('name_en', document.getElementById('name_en').value);
            formData.append('name', document.getElementById('name').value);
            formData.append('sort_index', document.getElementById('sort_index').value);
            formData.append('status', document.querySelector('input[name="status"]:checked').value);
            formData.append('up_code', document.getElementById('up_code').value);
            formData.append('mode', document.getElementById('mode').value);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            const result = await fetch('{{ route("admin.address.modify") }}', {
                method: 'POST',
                body: formData
            });
            if (result.ok) {
                isCallback = false;
                handleAfterCreateOrEdit(document.getElementById('up_code').value, document.getElementById('up_name').value, document.getElementById('data_num').value);
                isCallback = true;
            }
        }

        function setTextButton(id) {
            let textBtnMod2 = '';
            let textButton_create_region = '';
            switch (id) {
                case ID_MASTER:
                    textBtnMod2 = '{{ __('home.Add continent') }}'
                    textButton_create_region = '{{ __('home.Add nation') }}';
                    break;
                case ID_CHILD:
                    textBtnMod2 = '{{ __('home.thêm vùng') }}'
                    textButton_create_region = '{{ __('home.thêm tỉnh thành') }}';
                    break;
            }
            document.getElementById('btnMod2').textContent = textBtnMod2
            document.querySelectorAll('.button-create-region').forEach((element) => {
                element.textContent = textButton_create_region;
            });
        }

        function handleAfterCreateOrEdit(code, name, data_num) {
            console.log('data_num', data_num)
            let arrayCode = code.split('!');
            let count = arrayCode.length
            console.log("count", count)
            if (count > 3) {
                supGetListChildRegion(code, name, data_num);
            } else {
                document.getElementById('p-table').innerHTML = '';
                document.getElementById('c-table').innerHTML = '';

                // console.log(arrAddress2)
                var filtered = arrAddress2.filter(function (el) {
                    return el != null;
                });

                if (filtered.length > 1) {
                    arrAddress2.forEach(value => {
                        checkLevel = value.level - 1;
                        if (value.code) {
                            console.log("exit code: ", value)
                            getListAddressChild(value.code, value.name, value.data_num);
                        }
                    })
                } else {
                    getListAddress();
                }
            }
        }

        function checkKeyArrMap(input) {
            let keyInput = input.code;
            let lengthKeyInput = keyInput.length;

            arrAddress2.forEach((value, key) => {
                if (key >= lengthKeyInput) {
                    arrAddress2.splice(key, 1);
                }
            });
            arrAddress2[keyInput.length] = input;
        }

        function renderListBtn(id) {
            let html = `<button type="button" class="btn btn-danger"
                                onclick="deleteAddress(${id})">{{ __('home.Delete') }}</button>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>`;
            document.getElementById('showBtnDeleteOrClose').innerHTML = html;
        }

        async function deleteAddress(id) {
            const data = {
                _token: `{{ csrf_token() }}`,
            };

            let url = `{{ route('admin.address.delete', ['id'=> ':id']) }}`;
            url = url.replace(':id', id)

            await fetch(url, {
                method: 'DELETE',
                headers: {
                    'content-type': 'application/json',
                },
                body: JSON.stringify(data),
            })
                .then((response) => {
                    console.log(response);
                    if (response.status == 200) {
                        alert("Delete Success!")
                        // getListAddress();
                        window.location.reload();
                    } else {
                        alert("Delete Error!")
                    }
                })
                .catch(error => console.log(error));
        }
    </script>
@endsection