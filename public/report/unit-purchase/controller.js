'use strict;'
angular.module('app')
	.controller('ctrl.report.unit-purchase', function($scope, $rootScope, $filter, UnitPurchaseReport){

		var vm 				=	$scope;
		var rs 				=	$rootScope;

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

			rs.loading 						=	true;
			var unitPurchaseReport 			=	new UnitPurchaseReport(vm.filter);
			vm.deciTotalSales				=	0;
			unitPurchaseReport.$save(function(data){

				angular.forEach(data.transactionUnitDetailList, function(transactionUnitDetail){
					if (transactionUnitDetail.strMiddleName == null){
						transactionUnitDetail.strMiddleName			=	'';
					}//end if
					transactionUnitDetail.strTransactionType 		=	transactionTypeList[transactionUnitDetail.intTransactionType];
					vm.deciTotalSales 								+=	parseFloat(transactionUnitDetail.deciAmount);
					console.log(vm.deciTotalSales);
				});
				vm.unitPurchaseReportList 			=	$filter('orderBy')(data.transactionUnitDetailList, 'created_at', false);
				rs.loading 							=	false;

			});


		}//end function

		vm.changeFilter();

	});