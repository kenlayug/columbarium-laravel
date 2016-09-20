'use strict;'

angular.module('app')
	.controller('ctrl.report.transfer-ownership', function($scope, $rootScope, $window, $filter, TransactionOwnershipReport){

		var vm				=	$scope;
		var rs 				=	$rootScope;
		var xList 			=	null;
		var yList 			=	null;
		var statisticalGraph 	=	{};

		rs.reportActive 						=	'active';
		rs.transferOwnerReportActive 			=	'active';

		vm.filter 			=	{
			dateFrom 		: 	moment().format('MM/DD/YYYY'),
			dateTo 			: 	moment().format('MM/DD/YYYY'),
			dateAsOf 		: 	moment().format('MM/DD/YYYY')
		};

		vm.changeFilter 		=	function(){

			if (vm.filter.dateFrom > vm.filter.dateTo){
				swal('Error!', 'Date from cannot be greater than date to.', 'error');
			}//end if
			else{

				var transactionOwnershipReport 		=	new TransactionOwnershipReport(vm.filter);
				transactionOwnershipReport.$save(function(data){

					vm.deciTotalSales 			=	0;
					angular.forEach(data.transactionOwnershipList, function(transactionOwnership){

						vm.deciTotalSales		+=	parseFloat(transactionOwnership.deciAmount);

					});
					vm.transactionOwnershipList 		=	$filter('orderBy')(data.transactionOwnershipList, 'created_at', false);

				});

			}//end else

		}//end function

		vm.changeFilter();

		vm.updateStatisticalGraph 			=	function(intType){

			statisticalGraph.title 			=	'Transfer Ownership';
			if (intType == 1){

				TransactionOwnershipReport.get({
					date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'),
					method : 'weekly'
				}).$promise.then(function(data){

					statisticalGraph.subtitle 		=	'Weekly Statistics';
					xList 			=	[
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday',
						'Sunday'
					];
					yList 			=	[{ name: 'Total Sales', data :data.weekStatisticList}];
					updateStatisticalGraph();

				});

			}else if (intType == 2){

				TransactionOwnershipReport.get({
					date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'), 
					method : 'monthly'
				}).$promise.then(function(data){

					statisticalGraph.subtitle 		=	'Monthly Statistics';
					xList 							=	[];
					for(var intCtr = 1; intCtr <= data.intNoOfDays; intCtr++){

						xList.push(moment(vm.filter.dateAsOf).format('MMMM')+' '+intCtr);

					}//end for
					yList 			=	[{ name: 'Total Sales', data :data.monthStatisticList}];
					updateStatisticalGraph();

				});

			}else if (intType == 3){

				TransactionOwnershipReport.get({
					date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'), 
					method : 'quarterly'
				}).$promise.then(function(data){

					statisticalGraph.subtitle 		=	'Quarterly Statistics';
					xList 							=	data.quarterMonthList;
					yList 			=	[{ name: 'Total Sales', data :data.quarterStatisticList}];
					updateStatisticalGraph();

				});

			}else if (intType == 4){

				TransactionOwnershipReport.get({
					date : moment().format('MMMM DD, YYYY'), 
					method : 'yearly'
				}).$promise.then(function(data){

					statisticalGraph.subtitle 		=	'Yearly Statistics';
					xList 							=	[];
					for(var intCtr = 1; intCtr <= 4; intCtr++){

						xList.push('Quarter '+intCtr);

					}//end for
					yList 			=	[{ name: 'Total Sales', data :data.yearStatisticList}];
					updateStatisticalGraph();

				});

			}//end else if

		}//end function

		var updateStatisticalGraph			=	function(){

			$(function () {
		        $('#stackedWeeklyStatisticalGraph').highcharts({
		            chart: {
		                type: 'column'
		            },
		            title: {
		                text: statisticalGraph.title
		            },
		            subtitle: {
		            	text: statisticalGraph.subtitle
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

		vm.generatePdf 				=	function(){

			$window.open('http://localhost:8000/pdf/transfer-ownership-report/'+
				moment(vm.filter.dateFrom).format('MMMM D, YYYY')+'/'+
				moment(vm.filter.dateTo).format('MMMM D, YYYY'));

		}//end function

	});