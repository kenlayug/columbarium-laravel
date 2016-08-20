'use strict;'
angular.module('app')
	.controller('ctrl.report.sales', function($scope, $rootScope, $filter, SalesReport){

		var vm		=	$scope;
		var rs 		=	$rootScope;
		var statisticalChart 	=	{};

		vm.reports			=	{
			dateFrom			: 	moment().format('MM/DD/YYYY'),
			dateTo				: 	moment().format('MM/DD/YYYY'),
			intTransactionId	: 	null
		}

		vm.changeReportRange	=	function(){

			if (vm.reports.dateTo < vm.reports.dateFrom){

				swal('Error!', 'Date from cannot be larger than date to.', 'error');

			}else{

				var intTransactionId		=	0;
				if (vm.reports.intTransactionId != null && vm.reports.intTransactionId != ''){

					intTransactionId	=	vm.reports.intTransactionId;

				}

				var data		=	{
					id 			: 	intTransactionId,
					dateFrom 	: 	moment(vm.reports.dateFrom).format('MMMM DD, YYYY'),
					dateTo		: 	moment(vm.reports.dateTo).format('MMMM DD, YYYY')
				};

				rs.loading 			=	true;
				var salesReport 		=	new SalesReport(data);
				salesReport.$save(function(data){

					rs.loading					=	false;
					angular.forEach(data.transactionPurchaseList, function(purchase){
						if (purchase.strMiddleName == null){
							purchase.strMiddleName		=	'';
						}//end if
					});
					vm.transactionList 			=	$filter('orderBy')(data.transactionPurchaseList, 'created_at', false);
					vm.grandTotalSales			=	0;
					angular.forEach(vm.transactionList, function(detail){

						if (detail.intTPurchaseDetailType == 1){

							vm.grandTotalSales		+=	(detail.additionalPrice * detail.intQuantity);

						}else if (detail.intTPurchaseDetailType == 2){

							vm.grandTotalSales		+=	(detail.servicePrice * detail.intQuantity);

						}else{

							vm.grandTotalSales		+=	(detail.packagePrice * detail.intQuantity);

						}

					});

				});

			}

		}

		// vm.changeReportRange();

		vm.changeFrequency		=	function(){

			if (vm.frequency == 1){

				vm.reports.dateFrom	 			=	moment().format('MM/DD/YYYY');
				vm.reports.dateTo	 			=	moment().format('MM/DD/YYYY');

			}else if (vm.frequency == 2){

				vm.reports.dateFrom				=	moment().subtract(1, 'weeks').format('MM/DD/YYYY');
				vm.reports.dateTo				=	moment().format('MM/DD/YYYY');

			}else if (vm.frequency == 3){

				vm.reports.dateFrom	 			=	moment().subtract(1, 'months').format('MM/DD/YYYY');
				vm.reports.dateTo				=	moment().format('MM/DD/YYYY');

			}else if (vm.frequency == 4){

				vm.reports.dateFrom 			=	moment().subtract(1, 'years').format('MM/DD/YYYY');
				vm.reports.dateTo 				=	moment().format('MM/DD/YYYY');

			}
			vm.changeReportRange();

		}

		vm.changeStatisticalChart			=	function(intType){

			if (intType == 1){
				SalesReport.get({ param1 : moment().format('MMMM DD, YYYY'), param2 : 'monthly'}).$promise.then(function(data){

					statisticalChart.title 			=	'Sales Report';
					statisticalChart.subtitle 		=	'Monthly Statistical Chart';
					vm.xList			=	[];
					for (var intCtr = 0; intCtr < data.intNoOfMonth; intCtr++){

						vm.xList.push(moment().format('MMMM ')+parseInt(intCtr+1));

					}//end for
					changeValueForStatistics(data.monthStatisticList);				

				});
			}//end if
			else if (intType == 0){

				SalesReport.get({ param1 : moment().format('MMMM DD, YYYY'), param2 : 'weekly'}).$promise.then(function(data){
					
					statisticalChart.title 			=	'Sales Report';
					statisticalChart.subtitle 		=	'Weekly Statistical Chart';
					vm.xList 		=	[
						'Monday',
						'Tuesday',
						'Wednesday',
						'Thursday',
						'Friday',
						'Saturday',
						'Sunday'
					];
					changeValueForStatistics(data.weeklyStatisticList);

				});
			}//end else if
			else if (intType == 2){
				SalesReport.get({param1 : moment().format('MMMM DD, YYYY'), param2 : 'quarterly'}).$promise.then(function(data){

					statisticalChart.title 			=	'Sales Report';
					statisticalChart.subtitle 		=	'Quarterly Statistical Chart';
					vm.xList 			=	[];
					angular.forEach(data.quarterMonthList, function(quarterMonth){
						vm.xList.push(moment(quarterMonth).format('MMMM'));
					});
					changeValueForStatistics(data.quarterStatisticList);

				});
			}//end else if
			else if (intType == 3){
				SalesReport.get({param1 : moment().format('MMMM DD, YYYY'), param2 : 'yearly'}).$promise.then(function(data){

					statisticalChart.title 			=	'Sales Report';
					statisticalChart.subtitle 		=	'Yearly Statistical Chart';
					vm.xList 			=	[];
					for(var intCtr = 0; intCtr < 4; intCtr++){
						vm.xList.push('Quarter '+parseInt(intCtr+1));
					}//end for
					changeValueForStatistics(data.yearStatisticList);

				});
			}//end else if

		}//end function

		var changeValueForStatistics 			=	function(statisticList){
					
			var additionalData 			=	{
				name 	: 	'Additionals',
				data 	: 	[]
			};
			var serviceData 			=	{
				name 	: 	'Services',
				data 	: 	[]
			};
			var packageData 			= 	{
				name 	: 	'Packages',
				data 	: 	[]
			};
			angular.forEach(statisticList, function(statistic){
				if (statistic.deciAdditionalTotalSales == null){
					statistic.deciAdditionalTotalSales	=	0;
				}
				if (statistic.deciServiceTotalSales == null){
					statistic.deciServiceTotalSales	=	0;
				}
				if (statistic.deciPackageTotalSales == null){
					statistic.deciPackageTotalSales	=	0;
				}
				additionalData.data.push(parseFloat(statistic.deciAdditionalTotalSales));
				serviceData.data.push(parseFloat(statistic.deciServiceTotalSales));
				packageData.data.push(parseFloat(statistic.deciPackageTotalSales));
			});
			vm.yList 		=	[
				additionalData,
				serviceData,
				packageData
			];
			vm.updateStatisticalChart();

		}//end function


		vm.updateStatisticalChart 				=	function(){

			$('#monthlyStatisticalChart').highcharts({
		        chart: {
		            type: 'line'
		        },
		        title: {
		            text: statisticalChart.title
		        },
		        subtitle: {
		            text: statisticalChart.subtitle
		        },
		        xAxis: {
		            categories: vm.xList
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
		        series: vm.yList
		    });

		}//end function

	});