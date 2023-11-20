@extends('backend.layouts.master')

@section('content')
    <div class="container" id="showAddress">
        <h3 class="text-center">Address Management</h3>
        <div class="">
            <table class="" id="table-list-address-main">

            </table>
            <button class="">Create</button>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            getAllAddress();

            async function getAllAddress() {
                let url = '{{ route('admin.address.index') }}';
                await $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        renderAddress(response);
                        callAddressRegion();
                    },
                    error: function (exception) {
                        console.log(exception)
                    }
                });
            }

            async function renderAddress(res) {
                let listAddress = ``;
                for (let i = 0; i < res.length; i++) {
                    let data = res[i];
                    let listChild = data.child;
                    let child = ``;
                    for (let j = 0; j < listChild.length; j++) {
                        let item = listChild[j];
                        child = child + `<div class="address-item">
                                                <span class="address-item-name" data-code="${item.code}" data-id="${item.id}">
                                                    ${item.name}
                                                </span>
                                                <span class="text-warning">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </span>
                                            </div>`;
                    }
                    let itemHtml = `<div class="d-flex justify-content-between align-items-center">${child}</div>`;
                    listAddress = listAddress + `<tr><th scope="row">
                            ${data.name}
                            <br/>
                            <span class="addAddress"><i class="fa-solid fa-plus"></i>Add</span>
                            </th><td>${itemHtml}</td></tr>`;
                }
                let html = `<tbody>${listAddress}</tbody>`;
                $("#table-list-address-main").empty().append(html);
            }

            async function callAddressRegion() {
                await $('.address-item-name').on('click', function () {
                    let itemID = $(this).data('id');
                    let itemCode = $(this).data('code');
                    let name = $(this).text();

                    let url = '{{ route('admin.address.show.region', ['code' => ':code']) }}';
                    url = url.replace(':code', itemCode);

                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function (response) {
                            renderAddressRegion(response, name);
                            callAddressChild();
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                })
            }

            function renderAddressRegion(res, name) {
                let listAddress = ``;
                for (let i = 0; i < res.length; i++) {
                    let data = res[i];
                    let listChild = data.child;
                    let childs = ``;
                    for (let j = 0; j < listChild.length; j++) {
                        let item = listChild[j];
                        childs = childs + `<div class="address-item">
                                                <span class="address-item-child-name" data-code="${item.code}" data-id="${item.id}">
                                                    ${item.name}
                                                </span>
                                                <span class="text-warning">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </span>
                                            </div>`;
                    }
                    let itemHtml = `<div class="d-flex justify-content-between align-items-center">${childs}</div>`;
                    listAddress = listAddress + `<tr><th scope="row">
                            ${data.name}
                            <br/>
                            <span class="addAddress"><i class="fa-solid fa-plus"></i>Add</span>
                            </th><td>${itemHtml}</td></tr>`;
                }
                let html = `<h3 class="text-center">${name}</h3>
                                <div class="">
                                    <table class="" id="table-list-address-main">
                                        <tbody>
                                            ${listAddress}
                                        </tbody>
                                    </table>
                                    <button class="">Create</button>
                                    <table class="" id="table-list-address-support">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>`;
                $("#showAddress").empty().append(html);
            }

            async function callAddressChild() {
                await $('.address-item-child-name').on('click', function () {
                    let itemCode = $(this).data('code');
                    let name = $(this).text();

                    let url = '{{ route('admin.address.show', ['code' => ':code']) }}';
                    url = url.replace(':code', itemCode);

                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function (response) {
                            renderAddressChild(response);
                            callAddressSupport();
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                })
            }

            async function renderAddressChild(res) {
                let listAddress = ``;
                for (let i = 0; i < res.length; i++) {
                    let data = res[i];
                    let listChild = data.child;
                    let child = ``;
                    for (let j = 0; j < listChild.length; j++) {
                        let item = listChild[j];
                        child = child + `<div class="address-item">
                                                <span class="address-item-support-name" data-code="${item.code}" data-id="${item.id}">
                                                    ${item.name}
                                                </span>
                                                <span class="text-warning">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </span>
                                            </div>`;
                    }
                    let itemHtml = `<div class="d-flex justify-content-between align-items-center">${child}</div>`;
                    listAddress = listAddress + `<tr><th scope="row">
                            ${data.name}
                            <br/>
                            <span class="addAddress"><i class="fa-solid fa-plus"></i>Add</span>
                            </th><td>${itemHtml}</td></tr>`;
                }
                let html = `<tbody>${listAddress}</tbody>`;
                $("#table-list-address-support").empty().append(html);
            }

            async function callAddressSupport() {
                await $('.address-item-support-name').on('click', function () {
                    let itemCode = $(this).data('code');
                    let id = $(this).data('id');
                    let name = $(this).text();

                    let url = '{{ route('admin.address.show', ['code' => ':code']) }}';
                    url = url.replace(':code', itemCode);

                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function (response) {
                            renderAddressSupport(id, response, itemCode, name);
                        },
                        error: function (exception) {
                            console.log(exception)
                        }
                    });
                })
            }

            async function renderAddressSupport(id, res, itemCode, name) {
                let codeArray = itemCode.split('!');
                let listAddress = ``;
                for (let i = 0; i < res.length; i++) {
                    let data = res[i];
                    let listChild = data.child;
                    let child = ``;
                    for (let j = 0; j < listChild.length; j++) {
                        let item = listChild[j];
                        child = child + `<div class="address-item">
                                                <span class="address-item-support-name" data-code="${item.code}" data-id="${item.id}">
                                                    ${item.name}
                                                </span>
                                                <span class="text-warning">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </span>
                                            </div>`;
                    }
                    let itemHtml = `<div class="d-flex justify-content-between align-items-center">${child}</div>`;
                    listAddress = listAddress + `<tr id="tr${codeArray.length}"><th scope="row">
                            ${name}
                            <br/>
                            <span class="addAddress"><i class="fa-solid fa-plus"></i>Add</span>
                            </th><td>${itemHtml}</td></tr>`;
                }
                let html = `<tbody>${listAddress}</tbody>`;
                let myItemTr = $('#tr' + codeArray.length);
                let check = myItemTr.length;
                if (check) {
                    await callAddressFromCode(id, itemCode, name);
                } else {
                    $("#table-list-address-support").append(html);
                }
            }

            async function callAddressFromCode(id, itemCode, name) {
                let url = '{{ route('admin.address.get.by.id', ['id' => ':id']) }}';
                url = url.replace(':id', id);
                let codeArray = itemCode.split('!');
                let value = codeArray.length

                console.log(id)

                await $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (response) {
                        renderAddressFromCode(response, value, name);
                    },
                    error: function (exception) {
                        console.log(exception)
                    }
                });
            }

            async function renderAddressFromCode(res, value, name) {
                console.log(res[0])
                let listChild = res[0].child;
                let child = ``;
                for (let j = 0; j < listChild.length; j++) {
                    let item = listChild[j];
                    child = child + `<div class="address-item">
                                                <span class="address-item-support-name" data-code="${item.code}" data-id="${item.id}">
                                                    ${item.name}
                                                </span>
                                                <span class="text-warning">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </span>
                                            </div>`;
                }
                let itemHtml = `<div class="d-flex justify-content-between align-items-center">${child}</div>`;
                let html = `<th scope="row">
                            ${name}
                            <br/>
                            <span class="addAddress"><i class="fa-solid fa-plus"></i>Add</span>
                            </th><td>${itemHtml}</td></tr>`;
                $('#tr' + value).empty().append(html);
            }
        })
    </script>
@endsection