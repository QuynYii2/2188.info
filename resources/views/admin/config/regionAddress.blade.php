{{--<table border="1" cellpadding="2" cellspacing="2">--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <td rowspan="2">Phần thân cột 1 hàng 2</td>--}}
{{--        <td>Phần thân cột 2 hàng 2</td>--}}
{{--        <td>Phần thân cột 2 hàng 2</td>--}}
{{--        <td>Phần thân cột 2 hàng 2</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td>Phần thân cột 2 hàng 3</td>--}}
{{--        <td>Phần thân cột 2 hàng 3</td>--}}
{{--        <td>Phần thân cột 2 hàng 3</td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--</table>--}}

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
    <table id="TableRegion" border="0">
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
