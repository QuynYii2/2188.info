$(".toggleProduct").click(function () {
    var productID = $(this).val();

    async function setProduct(productID) {
        let url = urlToggleProduct;
        url = url.replace(':productID', productID);

        try {
            await $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: token
                },
                success: function (response) {
                    let status = document.getElementById('productStatus' + productID)
                    status.innerText = response['status'];
                },
                error: function (exception) {
                    console.log(exception)
                }
            });
        } catch (error) {
            throw error;
        }
    }

    setProduct(productID);
});

async function callListFunction() {
    await getAllStatisticAccess();

    await getAllStatisticRevenue();

    await getAllStatisticUser();

    var item = localStorage.getItem('item');
    let arrayItem = item.split(',');

    await getCustomerChart(parseInt(arrayItem[0]), parseInt(arrayItem[1]));

    await getAllStatisticShops();
}

callListFunction();

async function getAllStatisticAccess() {
    await $.ajax({
        url: urla,
        method: 'GET',
        data: {
            _token: token
        },
        success: function (response) {
            var data = response[0];
            getChar(data[0], data[1])
        },
        error: function (exception) {
            console.log(exception)
        }
    });
}

async function getAllStatisticRevenue() {
    await $.ajax({
        url: urlb,
        method: 'GET',
        data: {
            _token: token
        },
        success: function (response) {
            var data = response[0];
            getRevenueChar(data[0], data[1])
        },
        error: function (exception) {
            console.log(exception)
        }
    });
}

async function getAllStatisticUser() {
    await $.ajax({
        url: urlc,
        method: 'GET',
        data: {
            _token: token
        },
        success: function (response) {
            let customerChart = [];
            customerChart.push(response[0], response[1])
            localStorage.setItem('item', customerChart);
        },
        error: function (exception) {
            console.log(exception)
        }
    });
}

async function getChar(data, datatime) {
    document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#reportsChart"), {
            series: [{
                name: 'Access',
                data: data,
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                },
            },
            markers: {
                size: 4
            },
            colors: ['#4154f1'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.3,
                    opacityTo: 0.4,
                    stops: [0, 90, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                type: 'datetime',
                categories: datatime
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            }
        }).render();
    });
}

async function getRevenueChar(data, datatime) {
    document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#revenueChart"), {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Revenue',
                data: data
            }, {
                name: 'Free Cash Flow',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: datatime,
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        }).render();
    });
}

async function getCustomerChart(customerChart, testChart) {
    document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#customerChart"), {
            series: [customerChart, testChart],
            chart: {
                height: 350,
                type: 'pie',
                toolbar: {
                    show: true
                }
            },
            labels: ['Buyer', 'Seller']
        }).render();
    });
}

async function getAllStatisticShops() {
    var access = document.getElementById('countAccess')
    var accessPercent = document.getElementById('countAccessPercent')
    var views = document.getElementById('countViews')
    var viewPercent = document.getElementById('countViewPercent')
    var orders = document.getElementById('countOrders')
    var orderPercent = document.getElementById('countOrderPercent')

    var listTodoRender = $('#listTodoRender');
    await $.ajax({
        url: urld,
        method: 'GET',
        data: {
            _token: token
        },
        success: function (response) {
            // listTodoRender.append(response);

            var nowShop = response[0][0];
            var perShop = response[1][1];

            access.innerText = nowShop[0];
            views.innerText = nowShop[1];
            orders.innerText = nowShop[2];

            accessPercent.innerText = (parseFloat(nowShop[0]) / parseFloat(perShop[0]) * 100).toFixed(2)
            viewPercent.innerText = (parseFloat(nowShop[1]) / parseFloat(perShop[1]) * 100).toFixed(2)
            orderPercent.innerText = (parseFloat(nowShop[2]) / parseFloat(perShop[2]) * 100).toFixed(2)

        },
        error: function (exception) {
            console.log(exception)
        }
    });
}
