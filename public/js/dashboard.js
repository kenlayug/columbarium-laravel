
//Overview Report

$(function () {
    $(function () {
        $('#salesReport').highcharts({
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            chart: {
                polar: true,
            },
            chart: {
                backgroundColor: '#0097a7',
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                labels: {
                    style: {
                        color: 'white',
                        font: 'roboto3'
                    }
                },
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                labels: {
                    style: {
                        color: 'white',
                        font: 'roboto3'
                    }
                },
                min: 0,
                title: {
                    text: 'Total Sales',
                    style: {
                        color: 'white',
                        font: 'roboto3'
                    }
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -10,
                verticalAlign: 'top',
                y: -10,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0'
                        }
                    }
                }
            },
            series: [{
                name: 'Sales Report',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#b2ebf2'
            },
            {
                name: 'Unit Purchases',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#64b5f6'
            },
            {
                name: 'Collection',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#2196f3'
            },
            {
                name: 'Manage Unit',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#0277bd'
            },
            {
                name: 'Transfer Ownership',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#01579b'
            },
            {
                name: 'Receivables',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#b2ebf2'
            }]
        });
    });
});


//Growth Rate Line Chart Sales Report
$(function () {
    $('#yearlyGrowthRateGraph').highcharts({
        chart: {
            marginBottom: 50,
            backgroundColor: '#26a69a',
        },
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            labels: {
                style: {
                    color: 'white',
                    font: 'roboto3'
                }
            },
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            labels: {
                style: {
                    color: 'white',
                    font: 'roboto3'
                }
            },
            title: {
                text: 'Total Sales',
                style: {
                    color: 'white',
                    font: 'roboto3'
                }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valuePrefix: 'P'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0,
            float: true,
            marginRight: 50
        },
        series: [{
            name: 'Pay Once',
            data: [50, 15, 36, 12, 32, 40, 21, 46, 80, 50, 60, 12], color: '#80cbc4',
        },
        {
            name: 'Reservation',
            data: [25, 55, 65, 72, 62, 85, 51, 106, 58, 60, 65, 52], color: '#00897b',
        },
        {
            name: 'At Need',
            data: [5, 115, 73, 112, 132, 95, 121, 146, 180, 150, 165, 112], color: '#004d40',
        }]
    });
});


//Overview Report

$(function () {
    $(function () {
        $('#overviewReport').highcharts({
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            chart: {
                polar: true,
            },
            chart: {
                backgroundColor: '#7e57c2',
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                labels: {
                    style: {
                        color: 'white',
                        font: 'roboto3'
                    }
                },
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                labels: {
                    style: {
                        color: 'white',
                        font: 'roboto3'
                    }
                },
                min: 0,
                title: {
                    text: 'Total Sales',
                    style: {
                        color: 'white',
                        font: 'roboto3'
                    }
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -10,
                verticalAlign: 'top',
                y: -10,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0'
                        }
                    }
                }
            },
            series: [{
                name: 'Add Deceased',
                data: [25, 15, 35, 70, 12, 22, 45, 20, 10, 15, 40, 45], color: '#e1bee7'
            },
            {
                name: 'Transfer Deceased',
                data: [25, 15, 35, 50, 12, 22, 45, 20, 10, 15, 40, 45], color: '#ba68c8'
            },
            {
                name: 'Pull Deceased',
                data: [25, 15, 35, 40, 12, 20, 45, 20, 10, 10, 40, 45], color: '#9c27b0'
            },
            {
                name: 'Return Deceased',
                data: [25, 15, 35, 10, 12, 22, 45, 20, 10, 15, 40, 45], color: '#6a1b9a'
            },]
        });
    });
});