//Statistical report
//Weekly //Stacked Graph

$(function () {
    $(function () {
        $('#stackedWeeklyStatisticalGraph').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Weekly Statistical Graph'
            },
            xAxis: {
                categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Sales'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
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
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                name: 'Additionals',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500]
            }, {
                name: 'Services',
                data: [800, 3000, 4500, 1200, 1500, 2450, 3300]
            }, {
                name: 'Packages',
                data: [5000, 4000, 5500, 3200, 6500, 1050, 8300]
            }]
        });
    });

//Monthly //Stacked Graph
    $(function () {
        $('#stackedMonthlyStatisticalGraph').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Statistical Graph'
            },
            xAxis: {
                categories: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30', 'Jan 31']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Sales'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
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
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                name: 'Total Sales',
                data: [4500, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 7000, 6000, 7000, 8000, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 6000, 7000, 7500, 7500, 8000, 8500, 9000, 7500]
            }]
        });
    });


//Weekly //Line Graph

    $('#lineWeeklyStatisticalReport').highcharts({
        title: {
            text: 'Weekly Statistical Report',
            x: -20 //center
        },
        subtitle: {
            text: 'Line Graph Representation',
            x: -20
        },
        xAxis: {
            categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'P'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Additionals',
            data: [2500, 1500, 3500, 900, 1200, 2200, 4500]
        }, {
            name: 'Services',
            data: [800, 3000, 4500, 1200, 1500, 2450, 3300]
        }, {
            name: 'Packages',
            data: [5000, 4000, 5500, 3200, 6500, 1050, 8300]
        }]
    });
});

//Weekly //Bar Graph
$(function () {
    $('#barWeeklyStatisticalReport').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Weekly Statistical Report'
        },
        subtitle: {
            text: 'Bar Graph Representation'
        },
        xAxis: {
            categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'P'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Additionals',
            data: [2500, 1500, 3500, 900, 1200, 2200, 4500]
        }, {
            name: 'Services',
            data: [800, 3000, 4500, 1200, 1500, 2450, 3300]
        }, {
            name: 'Packages',
            data: [5000, 4000, 5500, 3200, 6500, 1050, 8300]
        }]
    });
});


//Monthly //Line
$(function () {
    $('#monthlyStatisticalReport').highcharts({
        title: {
            text: 'Monthly Statistical Report',
            x: -20 //center
        },
        subtitle: {
            text: 'Line Graph Representation',
            x: -20
        },
        xAxis: {
            categories: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30', 'Jan 31']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'P'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Total Sales',
            data: [4500, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 7000, 6000, 7000, 8000, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 6000, 7000, 7500, 7500, 8000, 8500, 9000, 7500]
        }]
    });
});

//Monthly //Bar
$(function () {
    $('#barMonthlyStatisticalReport').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Statistical Report'
        },
        subtitle: {
            text: 'Bar Graph Representation'
        },
        xAxis: {
            categories: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30', 'Jan 31'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'P'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Total Sales',
            data: [4500, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 7000, 6000, 7000, 8000, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 6000, 7000, 7500, 7500, 8000, 8500, 9000, 7500]
        }]
    });
});

//Growth Rate
//Monthly
$(function () {
    $('#monthlyGrowthRate').highcharts({
        title: {
            text: 'Monthly Growth Rate',
            x: -20 //center
        },
        subtitle: {
            text: 'Line Graph Representation',
            x: -20
        },
        xAxis: {
            categories: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30', 'Jan 31']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'P'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Total Sales',
            data: [4500, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 7000, 6000, 7000, 8000, 3400, 2600, 5500, 6000, 7000, 4000, 4500, 4600, 5000, 6000, 7000, 7500, 7500, 8000, 8500, 9000, 7500]
        }]
    });
});

//Quarterly
$(function () {
    $('#quarterlyGrowthRate').highcharts({
        title: {
            text: 'Quarterly Growth Rate',
            x: -20 //center
        },
        subtitle: {
            text: 'Line Graph Representation',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'April']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'P'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Total Sales',
            data: [4500, 3400, 2600, 5500]
        }]
    });
});

//Yearly
$(function () {
    $('#yearlyGrowthRate').highcharts({
        title: {
            text: 'Yearly Growth Rate',
            x: -20 //center
        },
        subtitle: {
            text: 'Line Graph Representation',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'P'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Total Sales',
            data: [50000, 150000, 235600, 125000, 320000, 450000, 210000, 460000, 80000, 50000, 650000, 125000]
        }]
    });
});