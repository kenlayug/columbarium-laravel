
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
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#4dd0e1'
            },
            {
                name: 'Unit Purchases',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#b3e5fc'
            },
            {
                name: 'Collection',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#fff59d'
            },
            {
                name: 'Manage Unit',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#aed581'
            },
            {
                name: 'Transfer Ownership',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#4caf50'
            },
            {
                name: 'Receivables',
                data: [2500, 1500, 3500, 900, 1200, 2200, 4500, 2000, 1000, 1500, 4000, 4500], color: '#2e7d32'
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
                backgroundColor: '#607d8b',
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
                data: [25, 15, 35, 70, 12, 22, 45, 20, 10, 15, 40, 45], color: '#90caf9'
            },
            {
                name: 'Transfer Deceased',
                data: [25, 15, 35, 50, 12, 22, 45, 20, 10, 15, 40, 45], color: '#1e88e5'
            },
            {
                name: 'Pull Deceased',
                data: [25, 15, 35, 40, 12, 20, 45, 20, 10, 10, 40, 45], color: '#0d47a1'
            },
            {
                name: 'Return Deceased',
                data: [25, 15, 35, 10, 12, 22, 45, 20, 10, 15, 40, 45], color: '#1a237e'
            },]
        });
    });
});

// Clock
$(function () {

    /**
     * Get the current time
     */
    function getNow() {
        var now = new Date();

        return {
            hours: now.getHours() + now.getMinutes() / 60,
            minutes: now.getMinutes() * 12 / 60 + now.getSeconds() * 12 / 3600,
            seconds: now.getSeconds() * 12 / 60
        };
    }

    /**
     * Pad numbers
     */
    function pad(number, length) {
        // Create an array of the remaining length + 1 and join it with 0's
        return new Array((length || 2) + 1 - String(number).length).join(0) + number;
    }

    var now = getNow();

    // Create the chart
    $('#clock').highcharts({
            credits: {
                enabled: false
            },
            exporting: { enabled: false },

            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: 200
            },

            title: {
                text: ''
            },

            pane: {
                background: [{
                    // default background
                }, {
                    // reflex for supported browsers
                    backgroundColor: Highcharts.svg ? {
                        radialGradient: {
                            cx: 0.5,
                            cy: -0.4,
                            r: 1.9
                        },
                        stops: [
                            [0.5, 'rgba(255, 255, 255, 0.2)'],
                            [0.5, 'rgba(200, 200, 200, 0.2)']
                        ]
                    } : null
                }]
            },

            yAxis: {
                labels: {
                    distance: -20
                },
                min: 0,
                max: 12,
                lineWidth: 0,
                showFirstLabel: false,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 5,
                minorTickPosition: 'inside',
                minorGridLineWidth: 0,
                minorTickColor: '#666',

                tickInterval: 1,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                title: {
                    text: 'Powered by<br/>Highcharts',
                    style: {
                        color: '#BBB',
                        fontWeight: 'normal',
                        fontSize: '8px',
                        lineHeight: '10px'
                    },
                    y: 10
                }
            },

            tooltip: {
                formatter: function () {
                    return this.series.chart.tooltipText;
                }
            },

            series: [{
                data: [{
                    id: 'hour',
                    y: now.hours,
                    dial: {
                        radius: '60%',
                        baseWidth: 4,
                        baseLength: '95%',
                        rearLength: 0
                    }
                }, {
                    id: 'minute',
                    y: now.minutes,
                    dial: {
                        baseLength: '95%',
                        rearLength: 0
                    }
                }, {
                    id: 'second',
                    y: now.seconds,
                    dial: {
                        radius: '100%',
                        baseWidth: 1,
                        rearLength: '20%'
                    }
                }],
                animation: false,
                dataLabels: {
                    enabled: false
                }
            }]
        },

        // Move
        function (chart) {
            setInterval(function () {

                now = getNow();

                var hour = chart.get('hour'),
                    minute = chart.get('minute'),
                    second = chart.get('second'),
                    // run animation unless we're wrapping around from 59 to 0
                    animation = now.seconds === 0 ?
                        false :
                    {
                        easing: 'easeOutBounce'
                    };

                // Cache the tooltip text
                chart.tooltipText =
                    pad(Math.floor(now.hours), 2) + ':' +
                    pad(Math.floor(now.minutes * 5), 2) + ':' +
                    pad(now.seconds * 5, 2);

                hour.update(now.hours, true, animation);
                minute.update(now.minutes, true, animation);
                second.update(now.seconds, true, animation);

            }, 1000);

        });
});

/**
 * Easing function from https://github.com/danro/easing-js/blob/master/easing.js
 */
Math.easeOutBounce = function (pos) {
    if ((pos) < (1 / 2.75)) {
        return (7.5625 * pos * pos);
    }
    if (pos < (2 / 2.75)) {
        return (7.5625 * (pos -= (1.5 / 2.75)) * pos + 0.75);
    }
    if (pos < (2.5 / 2.75)) {
        return (7.5625 * (pos -= (2.25 / 2.75)) * pos + 0.9375);
    }
    return (7.5625 * (pos -= (2.625 / 2.75)) * pos + 0.984375);
};