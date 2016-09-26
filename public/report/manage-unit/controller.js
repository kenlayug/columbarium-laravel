'use strict;'

angular.module('app')
	.controller('ctrl.report.manage-unit', function($scope, $rootScope, $filter, $window, TransactionDeceasedReport){

		var vm 			=	$scope;
		var rs 			=	$rootScope;
		var xList 		=	null;
		var yList 		=	null;
		var xGrowthRate 	=	null;
		var yGrowthRate 	= 	null;
		var statisticalChart 	=	{};

		rs.reportActive 			=	'active';
		rs.manageUnitReportActive 	=	'active';

		vm.transactionList 			=	[
			'',
			'Add',
			'Transfer',
			'Borrow/Pull',
			'Return',
			'Retrieve From Safebox'
		];
		vm.filter 		=	{
			dateFrom 		: 	moment().format('MM/DD/YYYY'),
			dateTo 			: 	moment().format('MM/DD/YYYY'),
			dateAsOf 		: 	moment().format('MM/DD/YYYY')
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

				TransactionDeceasedReport.get({date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'), method : 'weekly'}).$promise.then(function(data){

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

				TransactionDeceasedReport.get({date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'), method : 'monthly'}).$promise.then(function(data){

					xList 			=	[];
					for(var intCtr = 1; intCtr <= data.intNoOfDays; intCtr++){

						xList.push(moment(vm.filter.dateAsOf).format('MMMM')+' '+intCtr);

					}//end for
					statisticalChart.subtitle 			=	'Monthly Statistics';
					updateStatisticValue(data.monthStatisticList);

				});

			}else if (intType == 3){

				TransactionDeceasedReport.get({date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'), method : 'quarterly'}).$promise.then(function(data){

					xList 			=	data.quarterMonthList;
					statisticalChart.subtitle 			=	'Quarterly Statistics';
					updateStatisticValue(data.quarterStatisticList);

				});

			}else if (intType == 4){

				TransactionDeceasedReport.get({date : moment(vm.filter.dateAsOf).format('MMMM DD, YYYY'), method : 'yearly'}).$promise.then(function(data){

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

		vm.generatePdf 			=	function(){

			$window.open('http://localhost:8000/pdf/manage-unit-report/'+
				moment(vm.filter.dateFrom).format('MMMM D, YYYY')+'/'+
				moment(vm.filter.dateTo).format('MMMM D, YYYY'));

		}//end function

		vm.changeGrowthRateChart 		=	function(intType){

			if (intType == 1){

				TransactionDeceasedReport.get({
					date 		: 	moment().format('MMMM D, YYYY'),
					method 			: 	'monthly',
					type 			: 	'growth-rate'
				}).$promise.then(function(data){

					xGrowthRate 			=	[
						moment().subtract(1, 'months').format('MMMM'),
						moment().format('MMMM')
					];

					vm.prevReportList 		=	data.prevReportList;
					vm.currentReportList	=	data.currentReportList;
					vm.growthRate 			=	data.growthRate;

					changeGrowthRateData(data.prevReportList, data.currentReportList);

				});

			}//end if
			else if (intType == 2){

				TransactionDeceasedReport.get({
					date 		: 	moment().format('MMMM D, YYYY'),
					method 			: 	'quarterly',
					type 			: 	'growth-rate'
				}).$promise.then(function(data){

					xGrowthRate 			=	[
						'Quarter '+moment().subtract(3, 'months').quarter(),
						'Quarter '+moment().quarter()
					];

					vm.prevReportList 		=	data.prevReportList;
					vm.currentReportList	=	data.currentReportList;
					vm.growthRate 			=	data.growthRate;

					changeGrowthRateData(data.prevReportList, data.currentReportList);

				});

			}//end if
			else if (intType == 3){

				TransactionDeceasedReport.get({
					date 		: 	moment().format('MMMM D, YYYY'),
					method 			: 	'yearly',
					type 			: 	'growth-rate'
				}).$promise.then(function(data){

					xGrowthRate 			=	[
						'Year '+moment().subtract(1, 'years').format('YYYY'),
						'Year '+moment().format('YYYY')
					];

					vm.prevReportList 		=	data.prevReportList;
					vm.currentReportList	=	data.currentReportList;
					vm.growthRate 			=	data.growthRate;

					changeGrowthRateData(data.prevReportList, data.currentReportList);

				});

			}//end if

		}//end function

		var changeGrowthRateData 		=	function(prevReportList, currentReportList){

			yGrowthRate 			=	[
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

			yGrowthRate[0].data.push(prevReportList.add);
			yGrowthRate[0].data.push(currentReportList.add);
			yGrowthRate[1].data.push(prevReportList.transfer);
			yGrowthRate[1].data.push(currentReportList.transfer);
			yGrowthRate[2].data.push(prevReportList.pull);
			yGrowthRate[2].data.push(currentReportList.pull);
			yGrowthRate[3].data.push(prevReportList.return);
			yGrowthRate[3].data.push(currentReportList.return);

			updateGrowthRateChart();

		}//end function

		var updateGrowthRateChart 		=	function(){

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