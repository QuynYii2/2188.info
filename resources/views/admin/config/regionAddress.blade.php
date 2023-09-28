
<style>
    table.table-region {
        border: 1px solid gray;
        border-collapse: collapse;
        padding: 10px;
    }

    .table-region tr  {
        border: 1px solid gray;
        padding: 10px;
    }

    .table-region th  {
        border: 1px solid gray;
        padding: 10px;
    }

    .table-region .name-region  {
        min-width: 150px;
        padding-left: 5px;
        text-align: center;
    }

    .table-region td  {
        border: 1px solid gray;
        padding: 10px;
    }

    .table-region .name-region-lv-1  {
        padding-left: 5px;
        text-align: center;
    }
</style>
<script>
    var dataNation;
    var numberOfCol = 3;

    async function getCountryFromNation() {
        const apiUrl = '{{ route('location.nation.get') }}';
        const response = await fetch(apiUrl);
        if (response.ok) {
            dataNation = await response.json();
        }
    }

    async function renderDataToHtml() {
        const tbody = document.getElementById('body_table_region')
        await getCountryFromNation();
        var str = '';
        var index = 0;
        var check = 0;
        var continentNow = '';
        var continentCheck = dataNation[0].continents ?? '';
        var rowSpan = calcRowSpanLv0(dataNation, continentCheck);
        for (let i = 0; i < dataNation.length; i++) {
            var region = dataNation[i];
            if (continentNow != continentCheck) {
                countryCheck = countryNow;
                check = 0;
                index = 0;
                str += `</tr>`
                rowSpan = calcRowSpanLv0(dataNation, countryCheck);
            }
            if (index == 0) {
                str += `<tr>`
            }
            if (!check) {
                str += `<th class="name-region" rowspan="${rowSpan}">${countryCheck}<br/>
                    <button type="button" onclick="showDialog('Add', '${region.continents}')" id="button-add">Add</button></th>`
                check++;
            }

        }
        tbody.innerHTML = str;
    }
    function calcRowSpanLv0(dataNation, countryCheck) {
        return Math.ceil(countObjectsWithContinentCode(dataNation, countryCheck) / numberOfCol)
    }
    function countObjectsWithContinentCode(array, continents) {
        return array.reduce((count, obj) => {
            if (obj.continents == continents) {
                return count + 1;
            }
            return count;
        }, 0);
    }

    renderDataToHtml();
</script>
<script>
    var continent_code = '';
    var regionName;
    var regionLv2 = '';
    var regionNameLv2 = '';
    var numberOfCol = 3;
    var widthCol = 100 / numberOfCol + '%';
    var dataNation;

    window.onload = function () {
        getDataRegionLv0();
    }
    var checkLv = 0;

    async function getDataRegion() {
        checkLv++;
        document.getElementById('action-button').style.display = 'inline-block';
        const apiUrl = '{{ route('location.nation.get') }}';
        const response = await fetch(apiUrl);
        if (response.ok) {
            dataNation = await response.json();
        }
    }

    getDataRegion();

    function renderDataToTable() {
        if (dataNation.length == 0) {
            return;
        }
        const tbody = document.getElementById('body_table_region');
        var str = '';
        var index = 0;
        var countryCheck = dataNation[0].continents;
        var countryNow = '';
        var rowSpan = calcRowSpan(dataNation, countryCheck);
        var checkNewRow = false;
        var nameTh = '';
        var nameETh = '';
        var BranchCodeTh = '';
        var GUBUNTh = '';
        var RegionCodeTh = '';
        var ContinentCodeTh = '';

        for (var i = 0; i < dataNation.length; i++) {
            var region = dataNation[i];
            countryNow = region.continents
            var isStar = region.Star == '1' ? 'orange' : 'gray'
            if (region.AreaCode == region.DetailCode || i == 0) {
                checkNewRow = true;

                nameTh = region.Name;
                nameETh = region.NameE;
                BranchCodeTh = region.BranchCode;
                GUBUNTh = region.GUBUN;
                RegionCodeTh = region.RegionCode;
                ContinentCodeTh = region.continents;

                index = 0;
                str += `</tr>`;
                var nextCode = region.AreaCode;
                if (dataNation[i + 1]) {
                    nextCode = dataNation[i + 1].AreaCode == dataNation[i + 1].DetailCode ? dataNation[i + 1].AreaCode : region.AreaCode;
                }
                rowSpan = calcRowSpan(dataNation, nextCode);
            } else {
                checkNewRow = false
            }

            if (index == 0) {
                str += `<tr>`
            };

            if (checkNewRow) {
                if (checkLv > 1) {
                    if (i == 0) {
                        str += `<th class="name-region" rowspan="${rowSpan}" >
                                                                                                ${NameE}
                                                                                                </br>
                                                                                                <button type="button"
                                                                                                    onclick="addOrEditChild('${RegionCode}', '${Name}', '${NameE}', '${BranchCode}','${GUBUN}', 'AddChild', '${continent_code}')" id="button-add">Add</button>
                                                                                                </th>
                            <td class="name-region-lv-1" style="width: ${widthCol}">
                                <span class="tit ${isStar} cursor-pointer" onclick="setStarOfRegion('1', '${region.RegionCode}', '${region.NameE}', '${region.NameE}', '${region.BranchCode}','${region.GUBUN}', '${region.continents}')">★ </span>
                                                    <span class="cursor-pointer"
                                onclick="getDataRegion('${region.RegionCode}', '${region.Name}', '${region.NameE}', '${region.BranchCode}','${region.GUBUN}', '${region.continents}')">
                                ${region.Name} - ${region.NameE}
                                </span>
                           </td>`
                    } else {
                        str += `<th class="name-region" rowspan="${rowSpan}" >
                                                        ${nameETh}
                                                        </br>
                                                        <button type="button"
                                                            onclick="addOrEditChild('${RegionCodeTh}', '${nameTh}', '${nameETh}', '${BranchCodeTh}','${GUBUNTh}', 'AddChild', '${ContinentCodeTh}')" id="button-add">Add</button>
                                                        </th>`;
                    }
                } else {

                    str += `<th class="name-region" rowspan="${rowSpan}" >
                            ${nameETh}
                            </br>
                            <button type="button"
                                onclick="addOrEditChild('${RegionCodeTh}', '${nameTh}', '${nameETh}', '${BranchCodeTh}','${GUBUNTh}', 'AddChild', '${ContinentCodeTh}')" id="button-add">Add</button>
                            </th>`;
                }
            }
            else {
                str += `<td class="name-region-lv-1" style="width: ${widthCol}">
                                <span class="tit ${isStar} cursor-pointer" onclick="setStarOfRegion('1', '${region.RegionCode}', '${region.NameE}', '${region.NameE}', '${region.BranchCode}','${region.GUBUN}', '${region.continents}')">★ </span>
                                                    <span class="cursor-pointer"
                                onclick="getDataRegion('${region.RegionCode}', '${region.Name}', '${region.NameE}', '${region.BranchCode}','${region.GUBUN}', '${region.continents}')">
                                ${region.Name} - ${region.NameE}
                                </span>
                           </td>`;
            }

            index++;

            if (index == numberOfCol) {
                str += `</tr>`
                index = 0;
            }

            checkNewRow = false;
        }

        tbody.innerHTML = str;
    }

    function calcRowSpan(dataNation, prefix) {
        var count = 0;
        for (var i = 0; i < dataNation.length; i++) {
            if (dataNation[i].RegionCode.startsWith(prefix)) {
                count++;
            }
        }
        return Math.ceil(count / numberOfCol)
    }

    function queryData(regionCode) {
        const queryGetRegion = `SELECT *
                            FROM (
                            SELECT R.REGIONCODEPK,
                                     R.REGIONCODE,
                                     SUBSTRING(R.REGIONCODE,1,LEN(R.REGIONCODE) - 3) COUNTRYCODE,
                                     SUBSTRING(R.REGIONCODE,1,6) AREACODE,
                                     SUBSTRING(R.REGIONCODE,1,9) DETAILCODE,
                                     R.NAME,
                                     R.NAMEE,
                                     R.OURBRANCHCODE,
                                     C.COMPANYNAME,
                                     R.GUBUN,
                                     R.CONTINENT_CODE,
                                     R.STAR
                            FROM     REGIONCODE R
                            LEFT JOIN COMPANY C
                                ON R.OurBRANCHCODE = C.COMPANYPK
                                WHERE R.GUBUN != 10
                            ) as list
                            WHERE list.RegionCode like '${regionCode}!__' or list.RegionCode like '${regionCode}!__!__' ORDER BY RegionCode, NAMEE;`;

        Admin.GetDataRegion(queryGetRegion, function (result) {
            renderDataToTable(result)
        }, function (result) { alert("ERROR : " + result); });
    }

    function getDataRegionLv0() {
        checkLv = 0;
        regionName = document.getElementById('Region_Name');

        const queryGetRegion =


        Admin.GetDataRegion(queryGetRegion, function (result) {
            renderDataToTableLv0(result)
        }, function (result) { alert("ERROR : " + result); });

    }

    function renderDataToTableLv0(dataNation) {
        const tbody = document.getElementById('body_table_region')
        var str = '';
        var index = 0;
        var check = 0;
        var countryCheck = dataNation[0].continents ?? '';
        var countryNow = '';
        var rowSpan = calcRowSpanLv0(dataNation, countryCheck);

        for (var i = 0; i < dataNation.length; i++) {
            var region = dataNation[i];
            var isStar = region.Star == '1' ? 'orange' : 'gray'
            countryNow = region.continents

            if (countryNow != countryCheck) {
                countryCheck = countryNow;
                check = 0;
                index = 0;
                str += `</tr>`
                rowSpan = calcRowSpanLv0(dataNation, countryCheck);
            }

            if (index == 0) {
                str += `<tr>`
            };

            if (!check) {
                str += `<th class="name-region" rowspan="${rowSpan}">${countryCheck}<br/>
                    <button type="button" onclick="showDialog('Add', '${region.continents}')" id="button-add">Add</button></th>`
                check++;
            }

            str += `<td class="name-region-lv-1" style="width: ${widthCol}">
                    <span class="tit ${isStar} cursor-pointer" onclick="setStarOfRegion('0', '${region.RegionCode}')">★ </span>
                                        <span class="cursor-pointer"
                    onclick="getDataRegion('${region.RegionCode}', '${region.Name}', '${region.NameE}', '${region.BranchCode}','${region.GUBUN}', '${region.continents}')">
                    ${region.Name} - ${region.NameE}</span>
                    <button type="button" onclick="addOrEditChild('${region.RegionCode}', '${region.Name}', '${region.NameE}', '${region.BranchCode}','${region.GUBUN}', 'Modify', '${region.continents}')">Edit</button>
                    `

            index++;
            if (index == numberOfCol) {
                str += `</tr>`
                index = 0;
            }
        }
        tbody.innerHTML = str;
    }

    function calcRowSpanLv0(dataNation, countryCheck) {
        return Math.ceil(countObjectsWithContinentCode(dataNation, countryCheck) / numberOfCol)
    }

    function countObjectsWithContinentCode(array, continents) {
        return array.reduce((count, obj) => {
            if (obj.continents == continents) {
                return count + 1;
            }
            return count;
        }, 0);
    }

    function setStarOfRegion(isWhere, regionCode) {
        Admin.setStarRegion(regionCode, function (result) {
            switch (isWhere) {
                case '0':
                    getDataRegionLv0();
                    break;
                default:
                    queryData(RegionCode);
                    break;
            }
        }, function (result) { alert("ERROR : " + result); });
    }

    function setValueOfParam(regionCode, name, nameE, branchCode, gubun) {
        RegionCode = regionCode;
        Name = name;
        NameE = nameE;
        BranchCode = branchCode;
        GUBUN = gubun;
        setNameButton(nameE);
    }

    function setNameButton(name) {
        document.getElementById('button-edit').innerText = `Edit: ${name}`;
        document.getElementById('button-delete').innerText = `Delete: ${name}`;
        document.getElementById('button-add-child').style.display = '';
        document.getElementById('button-add-child').innerText = `Add child for: ${name}`;
    }

    function showDialog(type, continents) {
        if (continents) {
            continent_code = continents;
        }

        var width = 500;
        var height = 300;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;
        var options = "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top;
        var newWindow = window.open(`./CreateNewRegion2.aspx?regionCode=${RegionCode}&name=${Name}&branchCode=${BranchCode}&nameE=${NameE}&gubun=${GUBUN}&type=${type}&continents=${continent_code}`
            , "_blank", options);

        if (newWindow) {
            newWindow.addEventListener("beforeunload", function () {
                window.location.reload();
            });
        }
    }

    function addOrEditChild(regionCode, name, nameE, branchCode, gubun, type, continents) {
        continent_code = continents;
        setValueOfParam(regionCode, name, nameE, branchCode, gubun);
        showDialog(type);
    }


</script>
<td valign="top" style="width: 600px">
    <div style="display: inline-block" id="Region_Name" onclick="getDataRegionLv0()">
    </div>
    <div id="action-button" class="d-none">
        <button type="button" onclick="showDialog('AddChild')" id="button-add-child">
        </button>
        <button type="button" onclick="showDialog('Modify')" id="button-edit">
        </button>
        <button onclick="DeleteRegion()" id="button-delete">
        </button>
    </div>
    <table id="body_table_region">
    </table>
    <table class="table-region style-iNWg5" id="style-iNWg5">
        <tbody id="body_table_region">
        <tr>
            <th class="name-region" rowspan="4">
                Africa
                <br>
                <button type="button" onclick="showDialog('Add', 'Africa')" id="button-add">
                    Add
                </button>
            </th>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'J')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('J', 'Ejypt', 'Ejypt', '0','1', 'Africa')">
            Ejypt - Ejypt
          </span>
                <button type="button" onclick="addOrEditChild('J', 'Ejypt', 'Ejypt', '0','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Mw')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Mw', 'Malawi', 'Malawi', '','1', 'Africa')">
            Malawi - Malawi
          </span>
                <button type="button" onclick="addOrEditChild('Mw', 'Malawi', 'Malawi', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Ml')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Ml', 'Mali', 'Mali', '','1', 'Africa')">
            Mali - Mali
          </span>
                <button type="button" onclick="addOrEditChild('Ml', 'Mali', 'Mali', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
        </tr>
        <tr>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Mr')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Mr', 'Mauritania', 'Mauritania', '','1', 'Africa')">
            Mauritania - Mauritania
          </span>
                <button type="button" onclick="addOrEditChild('Mr', 'Mauritania', 'Mauritania', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'My')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('My', 'Mayotte', 'Mayotte', '','1', 'Africa')">
            Mayotte - Mayotte
          </span>
                <button type="button" onclick="addOrEditChild('My', 'Mayotte', 'Mayotte', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Mo')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Mo', 'Morocco', 'Morocco', '','1', 'Africa')">
            Morocco - Morocco
          </span>
                <button type="button" onclick="addOrEditChild('Mo', 'Morocco', 'Morocco', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
        </tr>
        <tr>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Ng')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Ng', 'Niger', 'Niger', '','1', 'Africa')">
            Niger - Niger
          </span>
                <button type="button" onclick="addOrEditChild('Ng', 'Niger', 'Niger', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Ré')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Ré', 'Réunion', 'Réunion', '','1', 'Africa')">
            Réunion - Réunion
          </span>
                <button type="button" onclick="addOrEditChild('Ré', 'Réunion', 'Réunion', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Rw')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Rw', 'Rwanda', 'Rwanda', '','1', 'Africa')">
            Rwanda - Rwanda
          </span>
                <button type="button" onclick="addOrEditChild('Rw', 'Rwanda', 'Rwanda', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
        </tr>
        <tr>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Se')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Se', 'Senegal', 'Senegal', '','1', 'Africa')">
            Senegal - Senegal
          </span>
                <button type="button" onclick="addOrEditChild('Se', 'Senegal', 'Senegal', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
            <td class="name-region-lv-1" style="width: 33.333333333333336%">
          <span class="tit gray cursor-pointer" onclick="setStarOfRegion('0', 'Su')">
            ★
          </span>
                <span class="cursor-pointer" onclick="getDataRegion('Su', 'Sudan', 'Sudan', '','1', 'Africa')">
            Sudan - Sudan
          </span>
                <button type="button" onclick="addOrEditChild('Su', 'Sudan', 'Sudan', '','1', 'Modify', 'Africa')">
                    Edit
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</td>
