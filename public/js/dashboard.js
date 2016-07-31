$(function () {
    $('#container').highcharts({

        chart: {
            backgroundColor: 'transparent',
            type: 'area'
        },
        title: {
            text: 'Building Updates'
        },
        xAxis: {
            categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Billions'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000;
                }
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' millions'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: 'Building One',
            data: [502, 635, 809, 947, 1402, 3634, 5268]
        }, {
            name: 'Building Two',
            data: [106, 107, 111, 133, 221, 767, 1766]
        }, {
            name: 'Building Three',
            data: [163, 203, 276, 408, 547, 729, 628]
        }, {
            name: 'Building Four',
            data: [18, 31, 54, 156, 339, 818, 1201]
        }]
    });
});


$(function () {
    $('#container2').highcharts({
        credits: {
            enabled: false
        },
        exporting: { enabled: false },

        chart: {
            backgroundColor: '#bbdefb ',
            polar: true,
            type: 'column'
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of fruits'
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
            name: 'John',
            data: [5, 3, 4, 7, 2],
            stack: 'male'
        }, {
            name: 'Joe',
            data: [3, 4, 4, 2, 5],
            stack: 'male'
        }, {
            name: 'Jane',
            data: [2, 5, 6, 2, 1],
            stack: 'female'
        }, {
            name: 'Janet',
            data: [3, 0, 4, 4, 3],
            stack: 'female'
        }]
    });
});

$(function () {
    $('#lineChart').highcharts({
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        chart: {
            backgroundColor: '#81c784',
            polar: true,
        },
        title: {
            text: '',
            x: -20 //center
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Quantity'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' units'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Full Body',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Columbary',
            data: [-0.9, 3, 5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }]
    });
});


$(function () {
    $('#donut3D').highcharts({

        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        chart: {
            backgroundColor: '#4db6ac ',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: ''
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Units',
            data: [
                ['Available', 25],
                ['Reserve', 33],
                ['At Need', 12],
                ['Partially Owned', 20],
                ['Owned', 50]
            ]
        }]
    });
});


$(function () {
    $('#halfPie').highcharts({
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Services<br>2015',
            align: 'center',
            verticalAlign: 'middle',
            y: 30
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white',
                        textShadow: '0px 1px 2px black'
                    }
                },
                startAngle: -90,
                endAngle: 90,
                center: ['50%', '75%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            innerSize: '50%',
            data: [
                ['Cremation',   10.38],
                ['Installation',       56.33],
                ['Internment', 24.03],
                ['Exhumation',    4.77],
                ['Opera',     0.91],
                {
                    name: 'Proprietary or Undetectable',
                    y: 0.2,
                    dataLabels: {
                        enabled: false
                    }
                }
            ]
        }]
    });
});

$(function () {
    $('#3dPie').highcharts({
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        chart: {
            backgroundColor: 'none ',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Cremation', 45.0],
                ['Internment', 26.8],
                {
                    name: 'Installment',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Exhumation', 8.5]
            ]
        }]
    });
});

$(function () {
    $('#3dColumn').highcharts({
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        chart: {
            backgroundColor: '#ffe57f ',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            }
        },

        title: {
            text: ''
        },

        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Revenue'
            }
        },

        tooltip: {
            headerFormat: '<b>{point.key}</b><br>',
            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
        },

        plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },

        series: [{
            name: 'Columbarium',
            data: [250000, 150000, 400000, 650000, 200000, 300000, 350000, 750000, 450000, 200000, 700000, 600000],
            stack: 'male'
        }, {
            name: 'Full Body',
            data: [350000, 400000, 450000, 200000, 500000, 550000, 800000, 950000, 600000, 200000, 500000, 440000],
            stack: 'male'
        }]
    });
});


$(function () {
    $('#lineHorizontal').highcharts({
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        chart: {
            backgroundColor: 'none ',
            type: 'bar'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Oranges', 'Pears', 'Grapes', 'Bananas']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: [{
            name: 'John',
            data: [5, 3, 4, 7, 2]
        }, {
            name: 'Jane',
            data: [2, 2, 3, 2, 1]
        }]
    });
});

$(function () {

    var ranges = [
            [1246406400000, 14.3, 27.7],
            [1246492800000, 14.5, 27.8],
            [1246579200000, 15.5, 29.6],
            [1246665600000, 16.7, 30.7],
            [1246752000000, 16.5, 25.0],
            [1246838400000, 17.8, 25.7],
            [1246924800000, 13.5, 24.8],
            [1247011200000, 10.5, 21.4],
            [1247097600000, 9.2, 23.8],
            [1247184000000, 11.6, 21.8],
            [1247270400000, 10.7, 23.7],
            [1247356800000, 11.0, 23.3],
            [1247443200000, 11.6, 23.7],
            [1247529600000, 11.8, 20.7],
            [1247616000000, 12.6, 22.4],
            [1247702400000, 13.6, 19.6],
            [1247788800000, 11.4, 22.6],
            [1247875200000, 13.2, 25.0],
            [1247961600000, 14.2, 21.6],
            [1248048000000, 13.1, 17.1],
            [1248134400000, 12.2, 15.5],
            [1248220800000, 12.0, 20.8],
            [1248307200000, 12.0, 17.1]
        ],
        averages = [
            [1246406400000, 21.5],
            [1246492800000, 22.1],
            [1246579200000, 23],
            [1246665600000, 23.8],
            [1246752000000, 21.4],
            [1246838400000, 21.3],
            [1246924800000, 18.3],
            [1247011200000, 15.4],
            [1247097600000, 16.4],
            [1247184000000, 17.7],
            [1247270400000, 17.5],
            [1247356800000, 17.6],
            [1247443200000, 17.7],
            [1247529600000, 16.8],
            [1247616000000, 17.7],
            [1247702400000, 16.3],
            [1247788800000, 17.8],
            [1247875200000, 18.1],
            [1247961600000, 17.2],
            [1248048000000, 14.4],
            [1248134400000, 13.7],
            [1248220800000, 15.7],
            [1248307200000, 14.6]
        ];


    $('#lineDots').highcharts({
        chart: {
            backgroundColor: 'none ',
        },
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        title: {
            text: ''
        },

        xAxis: {
            type: 'datetime'
        },

        yAxis: {
            title: {
                text: null
            }
        },

        tooltip: {
            crosshairs: true,
            shared: true,
            valueSuffix: '°C'
        },

        legend: {
        },

        series: [{
            name: 'Temperature',
            data: averages,
            zIndex: 1,
            marker: {
                fillColor: 'white',
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[0]
            }
        }, {
            name: 'Range',
            data: ranges,
            type: 'arearange',
            lineWidth: 0,
            linkedTo: ':previous',
            color: Highcharts.getOptions().colors[0],
            fillOpacity: 0.3,
            zIndex: 0
        }]
    });
});


$(function() {
    $.fn.sparkline.defaults.line.lineColor = 'red';
    $.fn.sparkline.defaults.line.height = '35';
    /** This code runs when everything has been loaded on the page */
    /* Inline sparklines take their values from the contents of the tag */
    $('.inlinesparkline').sparkline();
    $('.inlinesparkline2').sparkline();
    $('.inlinesparkline3').sparkline({spotColour: 'orange', minSpotColour: 'orange', maxSpotColour: 'orange'});
    /* Sparklines can also take their values from the first argument
     passed to the sparkline() function */
    var myvalues = [10,8,5,7,4,4,1];
    $('.dynamicsparkline').sparkline(myvalues);

    /* The second argument gives options such as chart type */
    $('.dynamicbar').sparkline(myvalues, {type: 'bar', barColor: 'green'} );

    /* Use 'html' instead of an array of values to pass options
     to a sparkline with data in the tag */
    $('.inlinebar').sparkline('html', {type: 'bar', barColor: 'black', height: '30', barWidth: '13'});
    $('.inlinebar2').sparkline('html', {type: 'bar', barSpacing: '4',barColor: 'white', height: '30', barWidth: '7'});
    $('.inlinebar3').sparkline('html', {type: 'bar', barSpacing: '5',barColor: 'black', height: '30', barWidth: '10'});

    // jsfiddle configured to load jQuery Sparkline 2.1
// http://omnipotent.net/jquery.sparkline/
// Values to render
    var values = [1, 2, 3];

// Draw a sparkline for the #sparkline element
    $('#pieChart').sparkline(values, {
        height: '80',
        type: "pie",
        // Map the offset in the list of values to a name to use in the tooltip
        tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
        tooltipValueLookups: {
            'offset': {
                0: 'First',
                1: 'Second',
                2: 'Third'
            }
        },
    });

    // Draw a sparkline for the #sparkline element
    $('#pieChart2').sparkline(values, {
        offset: '90',
        height: '80',
        type: "pie",
        // Map the offset in the list of values to a name to use in the tooltip
        tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
        tooltipValueLookups: {
            'offset': {
                0: 'First',
                1: 'Second',
                2: 'Third'
            }
        },
    });
});

var dData = function() {
    return Math.round(Math.random() * 90) + 10
};

var barChartData = {
    labels: ["dD 1", "dD 2", "dD 3", "dD 4", "dD 5", "dD 6", "dD 7", "dD 8", "dD 9", "dD 10"],
    datasets: [{
        fillColor: "rgba(0,60,100,1)",
        strokeColor: "black",
        data: [dData(), dData(), dData(), dData(), dData(), dData(), dData(), dData(), dData(), dData()]
    }]
}

var index = 11;
var ctx = document.getElementById("canvas").getContext("2d");
var barChartDemo = new Chart(ctx).Bar(barChartData, {
    responsive: true,
    barValueSpacing: 2
});
setInterval(function() {
    barChartDemo.removeData();
    barChartDemo.addData([dData()], "dD " + index);
    index++;
}, 3000);




