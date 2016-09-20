'use strict;'

angular.module('app')
	.controller('ctrl.report.collection', function($scope, $rootScope, $filter, $window, CollectionReport, CollectionStatistic){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		rs.reportActive 		=	'active';
		rs.collectionReportActive 		=	'active';

		var xList 		=	null;
		var yList 		=	null;

		var xGrowthRate 	=	null;
		var yGrowthRate 	=	null;

		var statisticalChart 	=	{};

		vm.filter 		=	{
			dateFrom 	: 	moment().format('MM/DD/YYYY'),
			dateTo 		: 	moment().format('MM/DD/YYYY'),
			dateAsOf 	: 	moment().format('MM/DD/YYYY')
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
					dateFilter	: 	moment(vm.filter.dateAsOf).format('MMMM D, YYYY'),
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
					dateFilter 	: 	moment(vm.filter.dateAsOf).format('MMMM D, YYYY'),
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
					dateFilter 	: 	moment(vm.filter.dateAsOf).format('MMMM D, YYYY'),
					method 		: 	'quarterly'
				}).$promise.then(function(data){

					statisticalChart.subtitle 		=	"Quarterly Statistical Graph";
					xList 			=	data.quarterMonthList;
					updateStatisticValue(data.quarterStatisticList);

				});

			}//end else if
			else if (intStatisticType == 4){

				CollectionStatistic.get({
					dateFilter 	: 	moment(vm.filter.dateAsOf).format('MMMM D, YYYY'),
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

		vm.changeGrowthRate 			=	function(intType){

			if (intType == 1){

				CollectionStatistic.get({
					dateFilter 		: 	moment().format('MMMM D, YYYY'),
					method 			: 	'monthly',
					type 			: 	'growth-rate'
				}).$promise.then(function(data){

					vm.currentReportList 			=	data.currentReportList;
					vm.prevReportList 				=	data.prevReportList;
					vm.growthRate 					=	data.growthRate;

					xGrowthRate 			=	[
						moment().subtract(1, 'months').format('MMMM'),
						moment().format('MMMM')
					];

					updateGrowthRateValue(data.prevReportList, data.currentReportList);

				});

			}//end if
			else if (intType == 2){

				CollectionStatistic.get({
					dateFilter 		: 	moment().format('MMMM D, YYYY'),
					method 			: 	'quarterly',
					type 			: 	'growth-rate'
				}).$promise.then(function(data){

					vm.currentReportList 			=	data.currentReportList;
					vm.prevReportList 				=	data.prevReportList;
					vm.growthRate 					=	data.growthRate;

					xGrowthRate 			=	[
						'Quarter '+moment().subtract(3, 'months').quarter(),
						'Quarter '+moment().quarter()
					];

					updateGrowthRateValue(data.prevReportList, data.currentReportList);

				});

			}//end else if
			else if (intType == 3){

				CollectionStatistic.get({
					dateFilter 		: 	moment().format('MMMM D, YYYY'),
					method 			: 	'yearly',
					type 			: 	'growth-rate'
				}).$promise.then(function(data){

					vm.currentReportList 			=	data.currentReportList;
					vm.prevReportList 				=	data.prevReportList;
					vm.growthRate 					=	data.growthRate;

					xGrowthRate 			=	[
						'Year '+moment().subtract(1, 'years').format('YYYY'),
						'Year '+moment().format('YYYY')
					];

					updateGrowthRateValue(data.prevReportList, data.currentReportList);

				});

			}//end else if

		}//end function

		var updateGrowthRateValue 			=	function(prevReportList, currentReportList){

			yGrowthRate 			=	[
				{
					name : 'Collections',
					data : []
				},
				{
					name : 'Downpayments',
					data : []
				}
			];

			yGrowthRate[0].data.push(prevReportList.collections);
			yGrowthRate[1].data.push(prevReportList.downpayments);	
			yGrowthRate[0].data.push(currentReportList.collections);
			yGrowthRate[1].data.push(currentReportList.downpayments);

			updateGrowthRateChart();	

		}//end function

		var updateGrowthRateChart 			=	function(){

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
		            categories: xGrowthRate
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
		        series: yGrowthRate
		    });

		}//end function

	});