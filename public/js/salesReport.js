//Growth Rate Bar Chart

$(function () {
    $('#growthRateChart').highcharts({

        chart: {
            type: 'column'
        },

        title: {
            text: 'Yearly Sales Report Growth'
        },

        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Total sales'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: [{
            name: 'Total Sales',
            data: [800, 3000, 700, 200, 100, 250, 500, 800, 1000, 650, 750, 200],
            stack: 'male'
        }]
    });
});

//Growth Rate Line Chart
$(function () {
    $('#yearlyGrowthRateGraph').highcharts({
        title: {
            text: 'Yearly Sales Report Growth',
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
            valuePrefix: 'P'
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


$(function () {
    $('#monthlyGrowthRateGraph').highcharts({
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
            valuePrefix: 'P'
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

$(function () {
    $('#quarterlyGrowthRateGraph').highcharts({
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
            valuePrefix: 'P'
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

//Monthly Statistical Report
$(function () {
    $('#monthlyStatisticalChart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Statistical Graph'
        },
        subtitle: {
            text: 'Line Graph Representation'
        },
        xAxis: {
            categories: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10', 'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20', 'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30', 'Jan 31']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Additionals',
            data: [1500, 2500, 1200, 1500, 1700, 2000, 2300, 2350, 3000, 3500, 1500, 1400, 1250, 1400, 1500, 1600, 1700, 1800, 1900 ,2000, 2100, 2200, 2300, 2400, 2500, 2600, 2700, 2800, 2900, 3000, 3100]
        }, {
            name: 'Services',
            data: [2000, 2100, 2200, 2300, 2400, 2500, 2600, 2700, 2800, 2900, 3000, 3100, 3200, 3300, 3400, 3500, 3600, 3700, 3800, 3900, 4000, 4100, 4200, 4300, 4400, 4500, 4600, 4700, 4800, 4900, 5000]
        }, {
            name: 'Packages',
            data: [4000, 4100, 4200, 4300, 4400, 4500, 4600, 4700, 4800, 4900, 5000, 5100, 5200, 5300, 5400, 5500, 5600, 5700, 5800, 5900, 6000, 6100, 6200, 6300, 6400, 6500, 6600, 6700, 6800, 6900, 7000]
        }]
    });
});

//Weekly Statistical Report
$(function () {
    $('#weeklyStatisticalChart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Weekly Statistical Graph'
        },
        subtitle: {
            text: 'Line Graph Representation'
        },
        xAxis: {
            categories: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
        },
        yAxis: {
            title: {
                text: 'Total Sales'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
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