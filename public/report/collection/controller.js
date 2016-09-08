'use strict;'

angular.module('app')
	.controller('ctrl.report.collection', function($scope, $rootScope, $filter, $window, CollectionReport, CollectionStatistic){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		var xList 		=	null;
		var yList 		=	null;

		var statisticalChart 	=	{};

		vm.filter 		=	{
			dateFrom 	: 	moment().format('MM/DD/YYYY'),
			dateTo 		: 	moment().format('MM/DD/YYYY')
		};

		vm.reportCategory	=	[
			'',
			'Regular Collection',
			'Downpayment'
		];

		vm.changeReport 		=	function(){

			CollectionReport.get({
				dateFrom 			: 	moment(vm.filter.dateFrom).format('MMMM D, YYYY'),
				dateTo 				: 	moment(vm.filter.dateTo).format('MMMM D, YYYY')
			}).$promise.then(function(data){

				vm.reportList 			=	$filter('orderBy')(data.reportList, 'dateTransaction', false);
				vm.deciTotalSales		=	0;
				angular.forEach(vm.reportList, function(report){

					vm.deciTotalSales 		+=	parseFloat(report.deciAmountPaid);

				});

			});

		}//end function

		vm.changeStatistics 		=	function(intStatisticType){

			statisticalChart.title 			=	"Collection Report";
			if (intStatisticType == 1){

				CollectionStatistic.get({
					dateFilter	: 	moment().format('MMMM D, YYYY'),
					method 		: 	'weekly'
				}).$promise.then(function(data){

					statisticalChart.subtitle 		=	"Weekly Statistical Graph";
					xList 			=	[
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday',
						'Sunday'
					];
					updateStatisticValue(data.weekStatisticList);

				});

			}//end if
			else if (intStatisticType == 2){

				CollectionStatistic.get({
					dateFilter 	: 	moment().format('MMMM D, YYYY'),
					method 		: 	'monthly'
				}).$promise.then(function(data){

					statisticalChart.subtitle 		=	"Monthly Statistical Graph";
					xList 			=	[];
					for(var intCtr = 1; intCtr <= data.intNoOfDay; intCtr++){
						xList.push(moment().format('MMMM')+' '+intCtr);
					}//end for
					updateStatisticValue(data.monthStatisticList);

				});

			}//end else if
			else if (intStatisticType == 3){

				CollectionStatistic.get({
					dateFilter 	: 	moment().format('MMMM D, YYYY'),
					method 		: 	'quarterly'
				}).$promise.then(function(data){

					statisticalChart.subtitle 		=	"Quarterly Statistical Graph";
					xList 			=	data.quarterMonthList;
					updateStatisticValue(data.quarterStatisticList);

				});

			}//end else if
			else if (intStatisticType == 4){

				CollectionStatistic.get({
					dateFilter 	: 	moment().format('MMMM D, YYYY'),
					method 		: 	'yearly'
				}).$promise.then(function(data){

					statisticalChart.subtitle 		=	"Yearly Statistical Graph";
					xList 			=	[
						'Quarter 1',
						'Quarter 2',
						'Quarter 3',
						'Quarter 4'
					];
					updateStatisticValue(data.yearStatisticList);

				});

			}//end else if

		}//end function

		var updateStatisticValue 			=	function(statisticList){

			yList 			=	[
				{
					name : 'Collections',
					data : []
				},
				{
					name : 'Downpayments',
					data : []
				}
			];

			angular.forEach(statisticList, function(statistic){

				yList[0].data.push(statistic.collections);
				yList[1].data.push(statistic.downpayments);

			});
			changeStatisticalChart();

		}//end function

		var changeStatisticalChart			=	function(){

			$(function () {
		        $('#stackedWeeklyStatisticalGraph').highcharts({
		            chart: {
		                type: 'column'
		            },
		            title: {
		                text: statisticalChart.title
		            },
		            subtitle: {
		            	text: statisticalChart.subtitle
		            },
		            xAxis: {
		                categories: xList
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
		                pointFormat: '{series.name}: {point.y}<br/>Total: P {point.stackTotal}'
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
		            series: yList
		        });
		    });

		}//end function

		vm.changeReport();

		vm.generatePdf					=	function(){

			$window.open('http://localhost:8000/pdf/collection-report/'+
				moment(vm.filter.dateFrom).format('MMMM D, YYYY')+'/'+
				moment(vm.filter.dateTo).format('MMMM D, YYYY'));

		}//end function

	});