'use strict;'
angular.module('app')
	.controller('ctrl.assign-discount', function($scope, $rootScope, $filter,
		Discount, Service, AssignDiscount, DTOptionsBuilder, DTColumnBuilder,
		$compile, $q, DTColumnDefBuilder){

		var vm 				=	$scope;
		var rs 				=	$rootScope;

		vm.transactionTable 	=	{};
		vm.serviceTable			=	{};
		vm.discountTable 		=	{};
		vm.transactionList 		=	{};
		vm.discountList 		=	{};

		Service.get().$promise.then(function(data){

			vm.serviceList 			=	$filter('orderBy')(data.serviceList, 'strServiceName', false);

		});

		Discount.get().$promise.then(function(data){

			vm.discountList 		=	$filter('orderBy')(data.discountList, 'strDiscountName', false);

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

	    vm.transactionTable 				=	{};
	    vm.transactionTable.dtOptions 		=	DTOptionsBuilder.newOptions()
	        .withPaginationType('simple_numbers');

        vm.transactionTable.dtColumnDef = [
	        DTColumnDefBuilder.newColumnDef(0),
	        DTColumnDefBuilder.newColumnDef(1).notSortable()
	    ];

	    vm.serviceTable 				=	{};
	    vm.serviceTable.dtOptions 		=	DTOptionsBuilder.newOptions()
	        .withPaginationType('simple_numbers');

        vm.serviceTable.dtColumnDef = [
	        DTColumnDefBuilder.newColumnDef(0),
	        DTColumnDefBuilder.newColumnDef(1),
	        DTColumnDefBuilder.newColumnDef(2).notSortable()
	    ];

	    vm.openAddDiscount		=	function(transaction){

	    	AssignDiscount.get({id : transaction.intTransactionId}).$promise.then(function(data){

	    		vm.transaction 		=	transaction;
	    		angular.forEach(vm.discountList, function(discount){

	    			discount.selected 				=	false;
	    			angular.forEach(data.assignDiscountList, function(assignDiscount){

	    				if (discount.intDiscountId == assignDiscount.intDiscountIdFK){

	    					discount.selected 		=	true;

	    				}//end if

	    			});

	    		});

	    	});

	    }//end function

	    vm.openAddDiscountService		=	function(service){

	    	AssignDiscount.get({id : service.intServiceId, method : 'edit'}).$promise.then(function(data){

	    		vm.service 		=	service;
	    		$('#modalAssignDiscount').openModal();
	    		angular.forEach(vm.discountList, function(discount){

	    			discount.selected 				=	false;
	    			angular.forEach(data.assignDiscountList, function(assignDiscount){

	    				if (discount.intDiscountId == assignDiscount.intDiscountIdFK){

	    					discount.selected 		=	true;

	    				}//end if

	    			});

	    		});

	    	});

	    }//end function

	    vm.openViewDiscount 		=	function(transaction){

	    	AssignDiscount.get({ id : transaction.intTransactionId}).$promise.then(function(data){

	    		angular.forEach(vm.discountList, function(discount){

	    			discount.selected 		=	false;
	    			angular.forEach(data.assignDiscountList, function(assignDiscount){

	    				if (discount.intDiscountId == assignDiscount.intDiscountIdFK){

	    					discount.selected 	=	true;

	    				}//end if

	    			});

	    		});

	    	});

	    }//end function

	    vm.openViewDiscountService 		=	function(service){

	    	AssignDiscount.get({ id : service.intServiceId, method : 'edit'}).$promise.then(function(data){

	    		$('#modalViewDiscount').openModal();
	    		angular.forEach(vm.discountList, function(discount){

	    			discount.selected 		=	false;
	    			angular.forEach(data.assignDiscountList, function(assignDiscount){

	    				if (discount.intDiscountId == assignDiscount.intDiscountIdFK){

	    					discount.selected 	=	true;

	    				}//end if

	    			});

	    		});

	    	});

	    }//end function

	    vm.discountTable 				=	{};
	    vm.discountTable.dtOptions 		=	DTOptionsBuilder.newOptions().withPaginationType('simple_numbers');

        vm.discountTable.dtColumnDefs = [
	        DTColumnDefBuilder.newColumnDef(0).notSortable(),
	        DTColumnDefBuilder.newColumnDef(1),
	        DTColumnDefBuilder.newColumnDef(2)
	    ];

	    vm.transactionTable.dtInstance 	=	{};

	    vm.saveDiscounts 				=	function(){

	    	var discountList			=	[];
	    	angular.forEach(vm.discountList, function(discount){
	    		if (discount.selected){
	    			discountList.push(discount.intDiscountId);
	    		}//end if
	    	});

	    	var assignDiscount 		=	null;
	    	if (vm.transaction != null){

	    		assignDiscount 			=	new AssignDiscount({
		    		intTransactionId 		: 	vm.transaction.intTransactionId,
		    		discountList 			: 	discountList
		    	});

	    	}//end if
	    	else if (vm.service != null){

	    		assignDiscount 			=	new AssignDiscount({
	    			intServiceId	 		: 	vm.service.intServiceId,
	    			discountList 			: 	discountList
	    		});

	    	}//end if

	    	assignDiscount.$save(function(data){

	    		swal('Success!', data.message, 'success');
	    		$('#modalAssignDiscount').closeModal();
	    		vm.transaction 			=	null;
	    		vm.service 				=	null;

	    	},
	    		function(response){

	    			swal('Error!', response.data.message, 'error');

	    		});

	    }//end function

	});