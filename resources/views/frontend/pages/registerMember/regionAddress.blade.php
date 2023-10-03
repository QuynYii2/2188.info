<style>
    table.table-region {
        border: 1px solid gray;
        border-collapse: collapse;
        padding: 10px;
    }

    .table-region tr {
        border: 1px solid gray;
        padding: 10px;
    }

    .table-region th {
        border: 1px solid gray;
        padding: 10px;
    }

    .table-region .name-region {
        min-width: 150px;
        padding-left: 5px;
        text-align: center;
    }

    .table-region td {
        border: 1px solid gray;
        padding: 10px;
    }

    .table-region .name-region-lv-1 {
        padding-left: 5px;
        text-align: center;
    }
</style>
<script>
    let dataNation, dataState, dataCity, dataWard;
    let numberOfCol = 3;
    let level = 0;
    let nameTh, idTh, codeTh;
    let nationValue_Selected = provinceValue_Selected = districtValue_Selected =
        nationName_Selected = provinceName_Selected = districtName_Selected = '';
    let nationValue_Selected1 = provinceValue_Selected1 = districtValue_Selected1 =
        nationName_Selected1 = provinceName_Selected1 = districtName_Selected1 = '';
    let nationValue_check = nationName_check = '';
    r_getListNation();

    async function r_getListNation() {
        const apiUrl = '{{ route('location.nation.get') }}';
        const response = await fetch(apiUrl);
        if (response.ok) {
            dataNation = await response.json();
            r_renderDataToHtmlLv0();
        }
    }

    async function r_getListState(id) {
        let url = '{{ route('location.state.get.by.nation', ['id' => ':id']) }}';
        url = url.replace(':id', id);
        const response = await fetch(url);
        if (response.ok) {
            dataState = await response.json();
            r_renderDataToTable(dataState);
        }
    }

    function r_handleSelectNation(id, name) {
        const checkWhereSelect = whereSelectRegion == 0;
        if (nationName_check != name && name) {
            nationName_check = name;
            nationValue_check = id;
            if (checkWhereSelect) {
                nationValue_Selected = nationValue_check;
                nationName_Selected = nationName_check;
            } else {
                nationValue_Selected1 = nationValue_check;
                nationName_Selected1 = nationName_check;
            }
        } else if (nationName_check != name) {
            if (checkWhereSelect) {
                nationValue_Selected = nationValue_check;
                nationName_Selected = nationName_check;
            } else {
                nationValue_Selected1 = nationValue_check;
                nationName_Selected1 = nationName_check;
            }
        } else {
            if (checkWhereSelect) {
                nationValue_Selected = id;
                nationName_Selected = name;
            } else {
                nationValue_Selected1 = id;
                nationName_Selected1 = name;
            }
        }

        r_getListState(id);
    }


    function selectRegion(provinceName, provinceValue, districtName, districtValue) {

        // Kiểm tra xem dòng address bên trên hay bên dưới nhấn modal, để render
        // biến whereSelectRegion lấy từ file show-register-member-info

        r_handleSelectNation();

        const checkWhereSelect = whereSelectRegion == 0;

        resetFieldAddress(checkWhereSelect);

        if (checkWhereSelect) {
            document.getElementById(ID_COUNTRY).value = nationName_Selected;
            if (provinceName) {
                provinceName_Selected = provinceName;
                document.getElementById(ID_STATE).value = provinceName_Selected;
            }
            if (provinceValue) {
                provinceValue_Selected = provinceValue;
            }

            if (districtName) {
                districtName_Selected = districtName;
                document.getElementById(ID_CITY).value = districtName_Selected;
            }
            if (districtValue) {
                districtValue_Selected = districtValue;
            }
        } else {
            document.getElementById(ID_COUNTRY_1).value = nationName_Selected1;
            if (provinceName) {
                provinceName_Selected1 = provinceName;
                document.getElementById(ID_STATE_1).value = provinceName_Selected1;
            }
            if (provinceValue) {
                provinceValue_Selected1 = provinceValue;
            }

            if (districtName) {
                districtName_Selected1 = districtName;
                document.getElementById(ID_CITY_1).value = districtName_Selected1;
            }
            if (districtValue) {
                districtValue_Selected1 = districtValue;
            }
        }

    }

    function handleAfterSelectRegion() {
        document.getElementById(ID_COUNTRY).value = nationValue_Selected;
        document.getElementById(ID_STATE).value = provinceValue_Selected;
        document.getElementById(ID_CITY).value = districtValue_Selected;

        document.getElementById(ID_COUNTRY_1).value = nationValue_Selected1;
        document.getElementById(ID_STATE_1).value = provinceValue_Selected1;
        document.getElementById(ID_CITY_1).value = districtValue_Selected1;
    }

    function resetFieldAddress(checkWhereSelect) {
        if (checkWhereSelect) {
            document.getElementById(ID_STATE).value = '';
            document.getElementById(ID_CITY).value = '';
            document.getElementById(ID_COUNTRY).value = '';
        } else {
            document.getElementById(ID_STATE_1).value = '';
            document.getElementById(ID_CITY_1).value = '';
            document.getElementById(ID_COUNTRY_1).value = '';
        }
    }


    async function r_renderDataToHtmlLv0() {
        let str = '';
        let index = 0;
        let check = 0;
        let continentNow = '';
        let continentCheck = dataNation[0].continents ?? '';
        let rowSpan = r_calcRowSpanLv0(dataNation, continentCheck);
        for (let i = 0; i < dataNation.length; i++) {
            let region = dataNation[i];
            continentNow = region.continents;
            if (continentNow != continentCheck) {
                continentCheck = continentNow;
                check = 0;
                index = 0;
                str += `<tr>`
                rowSpan = r_calcRowSpanLv0(dataNation, continentCheck);
            }
            if (index == 0) {
                str += `<tr>`
            }

            if (!check) {
                str += `<th class="name-region" rowspan="${rowSpan}">${continentCheck}</th>`
                check++;
            }

            str += `<td class="name-region-lv-1" onclick="r_handleSelectNation('${region.iso2}', '${region.name}')">
                                        <span class="cursor-pointer">
                    ${region.name}</span>`
            index++;
            if (index == numberOfCol) {
                str += `</tr>`
                index = 0;
            }

        }
        document.getElementById('body_table_region').innerHTML = str;
    }

    function r_renderDataToTable(data) {
        let str = '';
        let index = 0;
        let check = true;
        let continentNow = '';
        let continentCheck = data[0].continents ?? '';
        for (let i = 0; i < data.length; i++) {

            let region = data[i];
            let rowSpan = r_calcRowSpan(region);

            if (index == 0) {
                str += `<tr>`
            }
            let arrChild = JSON.parse(region.child);

            if (arrChild) {
                arrChild.forEach((child) => {
                    if (index == 0 || check) {
                        str += `<tr>`
                    }
                    index++;

                    if (check) {
                        str += `<th class="name-region" rowspan="${rowSpan}">${region.name}</th>`
                        check = false;
                        index--;
                    }

                    str += `<td class="name-region-lv-1" data-dismiss="modal" onclick="selectRegion('${region.name}','${region.state_code}','${child.name}','${child.city_code}',)">
                                        <span class="cursor-pointer">
                    ${child.name}</span>`
                    if (index == numberOfCol) {

                        str += `</tr>`;
                        index = 0;
                    }
                });
                check = true;

            } else {
                str += `<tr><th class="name-region cursor-pointer" style="width: 100px" rowspan="${rowSpan}" data-dismiss="modal" onclick="selectRegion('${region.name}','${region.state_code}')">${region.name}</th></tr>`
            }
        }

        document.getElementById('body_table_region').innerHTML = str;
    }

    function r_calcRowSpanLv0(dataNation, continentCheck) {
        return Math.ceil(r_countObjectsWithContinentCode(dataNation, continentCheck) / numberOfCol)
    }

    function r_calcRowSpan(data) {
        if (data.total_child % numberOfCol == 0) {
            return data.total_child / numberOfCol + 1;
        }
        return Math.ceil(data.total_child / numberOfCol);
    }

    function r_countObjectsWithContinentCode(array, continents) {
        return array.reduce((count, obj) => {
            if (obj.continents == continents) {
                return count + 1;
            }
            return count;
        }, 0);
    }

</script>
<td valign="top" style="width: 600px">
    <div style="display: inline-block" id="Region_Name" onclick="getDataRegionLv0()">
    </div>
    <table class="table-region w-100">
        <tbody id="body_table_region"></tbody>
    </table>
</td>
