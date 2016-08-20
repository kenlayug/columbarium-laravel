'use strict;'
angular.module('app')
	.controller('ctrl.report.sales', function($scope, $rootScope, $filter, SalesReport){

		var vm		=	$scope;
		var rs 		=	$rootScope;

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

		vm.changeReportRange();

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

	});