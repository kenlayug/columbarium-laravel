'use strict;'

angular.module('app')
	.controller('ctrl.report.manage-unit', function($scope, $rootScope, $filter, TransactionDeceasedReport){

		var vm 			=	$scope;
		var rs 			=	$rootScope;
		var xList 		=	null;
		var yList 		=	null;
		var statisticalChart 	=	{};

		vm.transactionList 			=	[
			'',
			'Add',
			'Transfer',
			'Borrow/Pull',
			'Return'
		];
		vm.filter 		=	{
			dateFrom 		: 	moment().format('MM/DD/YYYY'),
			dateTo 			: 	moment().format('MM/DD/YYYY')
		};

		vm.changeFilter 		=	function(){

			if (vm.filter.dateFrom > vm.filter.dateTo){
				swal('Error!', 'Date from cannot be greater than date to.', 'error');
			}else{

				var transactionDeceasedReport 		=	new TransactionDeceasedReport(vm.filter);
				transactionDeceasedReport.$save(function(data){

					vm.deciTotalSales 				=	0;
					angular.forEach(data.transactionDeceasedList, function(transactionDeceased){
						if (transactionDeceased.strCustomerMiddle == null){
							transactionDeceased.strCustomerMiddle		=	'';
						}//end if
						if (transactionDeceased.strDeceasedMiddle == null){
							transactionDeceased.strDeceasedMiddle		=	'';
						}//end if
						vm.deciTotalSales 			+= 		parseFloat(transactionDeceased.deciPrice);
					});
					vm.transactionDeceasedList 			=	$filter('orderBy')(data.transactionDeceasedList, 'created_at', false);

				});

			}//end else

		}//end function

		vm.changeFilter();

		vm.changeStatisticalChart 			=	function(intType){

			statisticalChart.title 			=	'Deceased Transactions';
			if (intType == 1){

				TransactionDeceasedReport.get({date : moment().format('MMMM DD, YYYY'), method : 'weekly'}).$promise.then(function(data){

					xList 		=	[
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday',
						'Sunday'
					];
					statisticalChart.subtitle 		=	'Weekly Statistics';
					updateStatisticValue(data.weekStatisticList);

				});

			}else if (intType == 2){

				TransactionDeceasedReport.get({date : moment().format('MMMM DD, YYYY'), method : 'monthly'}).$promise.then(function(data){

					xList 			=	[];
					for(var intCtr = 1; intCtr <= data.intNoOfDays; intCtr++){

						xList.push(moment().format('MMMM')+' '+intCtr);

					}//end for
					statisticalChart.subtitle 			=	'Monthly Statistics';
					updateStatisticValue(data.monthStatisticList);

				});

			}else if (intType == 3){

				TransactionDeceasedReport.get({date : moment().format('MMMM DD, YYYY'), method : 'quarterly'}).$promise.then(function(data){

					xList 			=	data.quarterMonthList;
					statisticalChart.subtitle 			=	'Quarterly Statistics';
					updateStatisticValue(data.quarterStatisticList);

				});

			}else if (intType == 4){

				TransactionDeceasedReport.get({date : moment().format('MMMM DD, YYYY'), method : 'yearly'}).$promise.then(function(data){

					xList 		=	[];
					for(var intCtr = 1; intCtr <= 4; intCtr++){

						xList.push('Quarter '+intCtr);

					}//end for
					statisticalChart.subtitle 		=	'Yearly Statistics';
					updateStatisticValue(data.yearStatisticList);

				});

			}//end else if

		}//end function

		var updateStatisticValue 			=	function(statisticList){

			yList 			=	[
				{
					name : 'Add Deceased',
					data : []
				},
				{
					name : 'Transfer Deceased',
					data : []
				},
				{
					name : 'Pull Deceased',
					data : []
				},
				{
					name : 'Return Deceased',
					data : []
				}
			];

			angular.forEach(statisticList, function(statistic){

				yList[0].data.push(statistic.add);
				yList[1].data.push(statistic.transfer);
				yList[2].data.push(statistic.pull);
				yList[3].data.push(statistic.return);

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
		            series: yList
		        });
		    });

		}//end function

	});