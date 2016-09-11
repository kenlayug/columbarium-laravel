'use strict;'
angular.module('app')
	.controller('ctrl.assign-discount', function($scope, $rootScope, $filter,
		Discount, Service, AssignDiscount, DTOptionsBuilder, DTColumnDefBuilder){

		var vm 				=	$scope;
		var rs 				=	$rootScope;

		vm.transactionTable 	=	{};
		vm.serviceTable			=	{};
		vm.discountTable 		=	{};

		Service.get().$promise.then(function(data){

			vm.serviceList 			=	$filter('orderBy')(data.serviceList, 'strServiceName', false);

		});

		Discount.get().$promise.then(function(data){

			vm.discountList 		=	$filter('orderBy')(data.discountList, 'strDiscountList', false);

		});

		vm.transactionList 			=	[
			{
				strTransactionName 		: 	'Spotcash Unit Purchase',
				intTransactionId 		: 	1
			},
			{
				strTransactionName		: 	'Downpayment',
				intTransactionId		: 	2
			}
		];

	    vm.toggleAllDiscount 				=	function(status){

	    	angular.forEach(vm.discountList, function(discount){

	    		discount.selected 			=	status;

	    	});

	    }//end function

	});