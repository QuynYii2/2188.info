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
    </style>
    <table cellspacing="0" cellpadding="0" class="regionWrap layer_tbl mt10" style="display: table;">
        <colgroup>
            <col width="230">
            <col width="/">
        </colgroup>
        <tbody id="nationRegion">
        <tr>
            <th class="cont bg-color-th1 " code="10001" sort_seq="1"><span class="mb10"
                                                                           onclick="fnRegionDetailPop('10001',2)">Asia</span>
                <div class="mt5"><span class="minBtn btn-down" onclick="fnMoveDownSeq(this,'10001','1',2)"><span
                                class="">▼</span></span><span class="minBtn  ml20"><span class=""
                                                                                         onclick="createNewRegion('10001',2)"
                                                                                         data-toggle="modal" data-target="#createRegion" >국가등록</span></span>
                </div>
            </th>
            <td class="bg-color-td1"><span class="nation"><span class="tit orange " onclick="fnFavority('10059','Y',2)">★ </span><span
                            class="tit"
                            onclick="fnRegionCityLoad('10059','South Korea','한국')">South Korea 한국</span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10059',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10061','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10061','China','中国')">China 中国</span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10061',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10060','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10060','Japan','日本')">Japan 日本</span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10060',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10062','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10062','Taiwan','臺灣')">Taiwan 臺灣</span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10062',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10067','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10067','Vietnam','')">Vietnam </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10067',2)">▤</span></span></span><span
                        class="nation"><span class="tit gray " onclick="fnFavority('10064','N',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10064','Macao','')">Macao </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10064',2)">▤</span></span></span><span
                        class="nation"><span class="tit gray " onclick="fnFavority('10065','N',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10065','Laos','')">Laos </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10065',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10066','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10066','Cambodia','')">Cambodia </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10066',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10068','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10068','Thailand','')">Thailand </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10068',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10069','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10069','Myanmar','')">Myanmar </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10069',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10070','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10070','Malaysia','')">Malaysia </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10070',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10071','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10071','Singapore','')">Singapore </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10071',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10072','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10072','Philippines','')">Philippines </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10072',2)">▤</span></span></span><span
                        class="nation"><span class="tit gray " onclick="fnFavority('10073','N',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10073','Lebanon','')">Lebanon </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10073',2)">▤</span></span></span><span
                        class="nation"><span class="tit orange " onclick="fnFavority('10074','Y',2)">★ </span><span
                            class="tit" onclick="fnRegionCityLoad('10074','Indonesia','')">Indonesia </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10074',2)">▤</span></span></span><span
                        class="nation"><span class="tit gray " onclick="fnFavority('10076','N',2)">★ </span><span
                            class="tit"
                            onclick="fnRegionCityLoad('10076','Arab Emirates','')">Arab Emirates </span><span
                            class="skyblue ml10"><span class=""
                                                       onclick="fnRegionDetailPop('10076',2)">▤</span></span></span>
            </td>
        </tr>
        <tr>
            <th>
                <button id="btnMod2" name="btnMod2" class="sky"
                        onclick="createNewRegion('10001',2)"
                        data-toggle="modal" data-target="#createRegion"
                        style="margin-top:0; width:230px;">+ 대륙추가
                </button>
            </th>
            <td></td>
        </tr>
        </tbody>
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
                                <td colspan="3"><input type="text" id="upregion_nm" name="upregion_nm" readonly="readonly" value="한국" style="border:none"></td>
                            </tr>
                            <tr>
                                <th scope="row">지역명(영어)</th>
                                <td colspan="3"><input type="text" id="name_en" name="name_en" style="width:98%"></td>
                            </tr>
                            <tr>
                                <th scope="row">지역명(자국어)</th>
                                <td colspan="3"><input type="text" id="name" name="name" style="width:98%"></td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="a8">정렬순서</label></th>
                                <td>
                                    <input type="text" id="sort_seq" name="sort_seq" value="3" style="width:98%;">
                                </td>
                                <th scope="row">사용여부</th>
                                <td>
                                    <input type="radio" id="use_yn1" name="use_yn" value="Y" checked="checked"><label class="int_space" for="use_yn1">사용</label>
                                    <input type="radio" id="use_yn2" name="use_yn" value="N"><label class="int_space" for="use_yn2">미사용</label>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        getListAddress();
        async function getListAddress() {
            let url = '{{ route('address.show', ['code' => ':code']) }}';
            url = url.replace(':code', '123');
            let result = await fetch(url);
            console.log(result);
        }

        function setIsShow(id) {

        }

        function createNewRegion(id) {
            console.log(id)
        }
    </script>
@endsection
