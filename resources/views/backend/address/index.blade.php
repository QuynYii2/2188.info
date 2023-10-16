@extends('backend.layouts.master')

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
            <h1 class="title-main cursor-pointer" id="title-main" onclick="getListAddress()">{{ __('home.Address management ') }}</h1>
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
                                onclick="createOrEditRegion('','', `${MODE_CREATE}`)"
                                data-toggle="modal" data-target="#createRegion"
                                style="margin-top:0; width:230px;">+ {{ __('home.Add region ') }}
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('home.Add region ') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.address.modify') }}" method="post" id="form-modify-address">
                    @csrf
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
                                    <th scope="row">{{ __('home.Add continent ') }}</th>
                                    <td colspan="3"><input type="text" disabled id="up_name" name="up_name" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('home.Name English ') }}</th>
                                    <td colspan="3"><input type="text" id="name_en" name="name_en" style="width:98%">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('home.Name (Own language) ') }}</th>
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
                                               checked="checked"><label class="int_space" for="use_yn1">{{ __('home.yes') }}</label>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('home.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('home.Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <tr>
        <script>
            getListAddress();
            let checkLevel = 1;
            let index_main = 1;
            let nation_code, nation_name;

            const MODE_CREATE = 'create'
            const MODE_EDIT = 'edit'

            async function getListAddress() {
                let url = '{{ route('admin.address.index') }}';
                let result = await fetch(url);
                if (result.ok) {
                    checkLevel = 1;
                    index_main = 1;
                    const data = await result.json();
                    document.getElementById('p-table').innerHTML = '';
                    document.getElementById('c-table').innerHTML = '';
                    document.getElementById('title-div').style.display = 'none';
                    makeHTMLFromJson(data);
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

            function createOrEditRegion(code, name, mode) {
                resetFormModal()
                document.getElementById('up_name').value = name;
                document.getElementById('up_code').value = code;
                document.getElementById('mode').value = mode;
                if (mode == MODE_EDIT) {
                    getById(code);
                }
                if (mode == MODE_CREATE && !code && !name) {
                    document.getElementById('up_name').value = nation_name;
                    document.getElementById('up_code').value = nation_code;
                }
            }

            async function getListAddressChild(code, name, element) {
                let url = '{{ route('admin.address.show', ['code' => ':code']) }}';
                url = url.replace(':code', code);
                let result = await fetch(url);
                let data_num = element.getAttribute('data-num');
                duyetTheTr(data_num);

                if (result.ok) {
                    const data = await result.json();
                    if (checkLevel == 1) {
                        nation_code = code;
                        nation_name = name;
                        document.getElementById('title-div').style.display = 'block';
                        document.getElementById('title-main').innerHTML = name;
                    }
                    makeHTMLFromJson(data);
                    checkLevel++;
                    index_main++;
                }
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
                    const data = await result.json();
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

            function makeHTMLFromJson(data) {
                const isTable = checkLevel == 1;
                let str = '';

                data.forEach((pItem, index) => {
                    const classTh = index % 2 == 0 ? 'bg-color-th2' : 'bg-color-th1';
                    const classTd = index % 2 == 0 ? 'bg-color-td2' : 'bg-color-td1';

                    str += `<tr data-num="${index_main}"><th class="cont ${classTh} "><div class="text-center"><span class="cursor-pointer">${pItem.name_en ?? pItem.name ?? ''}</span></div>
                                    <div class="mt5 text-center"><span class="minBtn  ml20"> <span class="cursor-pointer"
                                                                                                             onclick="createOrEditRegion('${pItem.code}','${pItem.name_en ?? pItem.name}', '${MODE_CREATE}')"
                                                                                                             data-toggle="modal" data-target="#createRegion" >국가등록</span></span>
                                    </div>
                                </th>`
                    if (pItem.total_child) {
                        str += `<td class="${classTd}">`;
                        pItem.child.forEach((cItem) => {
                            str += ` <span class="nation"><span class="tit cursor-pointer ${cItem.isShow == 1 ? 'orange' : 'grey'} " onclick="setIsShow('${cItem.id}')" id="myStar-${cItem.id}">★ </span>
                    <span
                            class="tit cursor-pointer" data-num="${index_main}"
                            onclick="getListAddressChild('${cItem.code}', '${cItem.name_en ?? cItem.name ?? ''}', this)">${cItem.name_en ?? ''} ${cItem.name ?? ''}</span>
                    <span class="skyblue ml10"> <span class="cursor-pointer" data-toggle="modal" data-target="#createRegion" onclick="createOrEditRegion('${cItem.id}','${cItem.name_en ?? cItem.name}', '${MODE_EDIT}')">▤</span>
                    </span></span>`
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
                    t_p_Body.innerHTML += str;
                }

            }
        </script>
@endsection