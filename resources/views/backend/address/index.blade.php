@extends('backend.layouts.master')

@section('content')
    <style>
        .nation {
            display: inline-block;
            width: 250px;
            padding: 7px;
        }

        .bg-color-th1 {
            background-color: #e1dddd;
        }

        .bg-color-th2 {
            background-color: #c8e2f3;
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
    <table cellspacing="0" cellpadding="0" class="regionWrap layer_tbl mt10" style="display: table;">
        <colgroup>
            <col width="230">
            <col width="/">
        </colgroup>
        <tbody id="p-table"></tbody>
        <tr>
            <th>
                <button id="btnMod2" name="btnMod2" class="sky"
                        onclick="createNewRegion('','')"
                        data-toggle="modal" data-target="#createRegion"
                        style="margin-top:0; width:230px;">+ 대륙추가
                </button>
            </th>
            <td></td>
        </tr>
    </table>
    <div class="modal fade" id="createRegion" tabindex="-1" aria-labelledby="exampleCreateRegion" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.address.create') }}" method="post">
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
                                    <th scope="row">상위 지역명</th>
                                    <td colspan="3"><input type="text" disabled id="up_name" name="up_name" value="" ></td>
                                    <td class="d-none"><input type="text" id="up_code" name="up_code" value="" ></td>
                                </tr>
                                <tr>
                                    <th scope="row">지역명(영어)</th>
                                    <td colspan="3"><input type="text" id="name_en" name="name_en" style="width:98%">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">지역명(자국어)</th>
                                    <td colspan="3"><input type="text" id="name" name="name" style="width:98%"></td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="a8">정렬순서</label></th>
                                    <td>
                                        <input type="text" id="sort_index" name="sort_index" value="3" style="width:98%;">
                                    </td>
                                    <th scope="row">사용여부</th>
                                    <td>
                                        <input type="radio" id="use_yn1" name="status" value="1"
                                               checked="checked"><label class="int_space" for="use_yn1">사용</label>
                                        <input type="radio" id="use_yn2" name="status" value="0"><label
                                                class="int_space" for="use_yn2">미사용</label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        getListAddress();

        async function getListAddress() {
            let url = '{{ route('admin.address.index') }}';
            let result = await fetch(url);
            if (result.ok) {
                const data = await result.json();
                makeHTMLFromJson(data);
            }
        }

        async function setIsShow(id) {
            let url = '{{ route('admin.address.change.show', ['id' => ':id']) }}';
            url = url.replace(':id', id);
            let result = await fetch(url);
            if (result.ok) {
                getListAddress();
            }
        }

        function createNewRegion(code, name) {
            document.getElementById('up_name').value = name
            document.getElementById('up_code').value = code
        }


        function setSortIndex(id) {
            console.log(id)
        }

        function makeHTMLFromJson(data) {
            const t_p_Body = document.getElementById('p-table');
            let str = '';
            data.forEach((pItem) => {
                str += `<tr><th class="cont bg-color-th1 "><span onclick="fnRegionDetailPop('10001',2)">${pItem.name_en ?? pItem.name ?? ''}</span>
                                    <div class="mt5"><span class="minBtn btn-down" onclick="setSortIndex('${pItem.code}')"><span
                                                    class="">▼</span></span><span class="minBtn  ml20"><span class=""
                                                                                                             onclick="createNewRegion('${pItem.code}','${pItem.name_en ?? pItem.name}' )"
                                                                                                             data-toggle="modal" data-target="#createRegion" >국가등록</span></span>
                                    </div>
                                </th>`
                if (pItem.total_child) {
                    str += `<td>`;
                    pItem.child.forEach((cItem) => {
                        str += ` <span class="nation"><span class="tit ${cItem.isShow == 1 ? 'orange' : 'grey'} " onclick="setIsShow('${cItem.id}')">★ </span>
                    <span
                            class="tit"
                            onclick="fnRegionCityLoad('10059','South Korea','한국')">${cItem.name_en ?? ''} ${cItem.name ?? ''}</span></span>`
                    })
                    str += `</td>`;
                }
                str += `</tr>`
            })

            t_p_Body.innerHTML = str;
        }
    </script>
@endsection
