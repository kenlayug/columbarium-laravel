'use strict;'
angular.module('app')
	.controller('ctrl.report.receivables', function($scope, $rootScope, $window, Receivable){

		var vm 				=	$scope;
		var rs 				=	$rootScope;

		vm.categoryList 	=	[
			'',
			'Regular Collections',
			'Downpayments'
		];

		Receivable.get().$promise.then(function(data){

			vm.receivableList 			=	data.receivableList;
			vm.deciTotalReceivables 	=	0;
			angular.forEach(data.receivableList, function(receivable){

				vm.deciTotalReceivables		+=	parseFloat(receivable.deciAmountToReceive);

			});

		});

		vm.generatePdf 			=	function(){
			console.log('PRNTTTT');
			$window.open('http://localhost:8000/pdf/receivables-report');

		}//end function

	});