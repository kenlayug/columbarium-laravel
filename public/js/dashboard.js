
//Sales Report

$(function () {
    $(function () {
        $('#stackedWeeklyStatisticalGraph').highcharts({
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            chart: {
                backgroundColor: '#81c784',
                polar: true,
            },
            chart: {
                type: 'column'
            },
            title: {
                text: 'Weekly Statistical Graph'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
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
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 5000, 4500]
            }]
        });
    });
});

