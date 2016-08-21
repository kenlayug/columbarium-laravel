'use strict;'
angular.module('app')
	.controller('ctrl.report.unit-purchase', function($scope, $rootScope, $filter, UnitPurchaseReport){

		var vm 						=	$scope;
		var rs 						=	$rootScope;
		var statisticalChart 		=	{};

		var transactionTypeList 		=	[
			'',
			'',
			'Reservation',
			'Pay Once',
			'At Need'
		];

		vm.filter 			=	{
			dateFrom 		: 	moment().format('MM/DD/YYYY'),
			dateTo 			: 	moment().format('MM/DD/YYYY')
		};

		vm.changeFilter		=	function(){

			var unitPurchaseReport 			=	new UnitPurchaseReport(vm.filter);
			vm.deciTotalSales				=	0;
			unitPurchaseReport.$save(function(data){

				angular.forEach(data.transactionUnitDetailList, function(transactionUnitDetail){
					if (transactionUnitDetail.strMiddleName == null){
						transactionUnitDetail.strMiddleName			=	'';
					}//end if
					transactionUnitDetail.strTransactionType 		=	transactionTypeList[transactionUnitDetail.intTransactionType];
					vm.deciTotalSales 								+=	parseFloat(transactionUnitDetail.deciAmount);
				});
				vm.unitPurchaseReportList 			=	$filter('orderBy')(data.transactionUnitDetailList, 'created_at', false);
				rs.loading 							=	false;

			});


		}//end function

		vm.changeFilter();

		vm.changeStatisticalChart 					=	function(intType){

			if (intType == 1){

				UnitPurchaseReport.get({ param1 : moment().format('MMMM DD, YYYY'), param2 : 'weekly'}).$promise.then(function(data){

					statisticalChart.title 		=	'Weekly Statistical Chart';
					vm.xList 		=	[
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday',
						'Sunday'
					];
					changeStatisticValue(data.weekStatisticList);
					updateStatisticalChart();

				});

			}//end if
			else if (intType == 2){

				UnitPurchaseReport.get({ param1 : moment().format('MMMM DD, YYYY'), param2 : 'monthly'}).$promise.then(function(data){

					statisticalChart.title 		=	'Monthly Statistical Chart';
					vm.xList 					=	[];
					for (var intCtr = 0; intCtr < data.noOfDays; intCtr++){
						vm.xList.push(moment().format('MMMM')+' '+parseInt(intCtr+1));
					}//end for
					changeStatisticValue(data.monthStatisticList);
					updateStatisticalChart();

				});

			}//end else if
			else if (intType == 3){

				UnitPurchaseReport.get({ param1 : moment().format('MMMM DD, YYYY'), param2 : 'quarterly'}).$promise.then(function(data){

					statisticalChart.title 		=	'Quarterly Statistical Chart';
					vm.xList 					=	[];
					angular.forEach(data.quarterMonthList, function(quarterMonth){
						vm.xList.push(moment(quarterMonth).format('MMMM'));
					});
					changeStatisticValue(data.quarterStatisticList);
					updateStatisticalChart();

				});

			}//end else if
			else if (intType == 4){

				UnitPurchaseReport.get({param1: moment().format('MMMM DD, YYYY'), param2: 'yearly'}).$promise.then(function(data){

					statisticalChart.title 		=	'Yearly Statistical Chart';
					vm.xList 					=	[];
					for(var intCtr = 1; intCtr <= 4; intCtr++){
						vm.xList.push('Quarter '+intCtr);
					}//end for
					changeStatisticValue(data.yearStatisticList);
					updateStatisticalChart();

				});

			}//end else if

		}//end function

		var changeStatisticValue 					=	function(statisticList){

			vm.yList				=	[
				{
					name : 'Pay Once',
					data : []
				},{
					name : 'Reservation',
					data : []
				},{
					name : 'At Need',
					data : []
				}
			];

			angular.forEach(statisticList, function(statistic){

				vm.yList[0].data.push(statistic.payOnce);
				vm.yList[1].data.push(statistic.reservation);
				vm.yList[2].data.push(statistic.atNeed);

			});

		}//end function

		var updateStatisticalChart 					=	function(){

			$(function () {
		        $('#stackedWeeklyStatisticalGraph').highcharts({
		            chart: {
		                type: 'column'
		            },
		            title: {
		                text: statisticalChart.title
		            },
		            xAxis: {
		                categories: vm.xList
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
		            series: vm.yList
		        });
		    });

		}//end function

	});