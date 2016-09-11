'use strict;'

angular.module('app')
	.controller('ctrl.discount', function($scope, $rootScope, $filter, Discount){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		rs.maintenanceActive 		=	'active';
		rs.discountActive			=	'active';

		vm.discountTypeList 		=	[
			'',
			'Percentage',
			'Amount'
		];

		Discount.get().$promise.then(function(data){

			vm.discountList 		=	$filter('orderBy')(data.discountList, 'strDiscountName', false);
			Discount.get({ id : 'archive'}).$promise.then(function(archiveData){

				vm.archiveDiscountList 	=	$filter('orderBy')(archiveData.discountList, 'strDiscountName', false);

			});

		});


		vm.saveDiscount 		=	function(){

			var discount 		=	new Discount(vm.discount);
			discount.$save(function(data){

				vm.discountList.push(data.discount);
				swal('Success!', data.message, 'success');
				vm.discountList 		=	$filter('orderBy')(vm.discountList, 'strDiscountName', false);
				vm.discount 			=	null;

			},
				function(response){

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}else if (response.status == 404){

						swal('Error!', 'Api not found.', 'error');

					}//end else if

				});

		}//end function

		vm.getDiscount 		=	function(discount, index){

			Discount.get({id : discount.intDiscountId}).$promise.then(function(data){

				vm.updateDiscount 			=	data.discount;
				vm.updateDiscount.index 	=	index;
				$('#modalUpdateItem').openModal();

			});

		}//end function

		vm.fUpdateDiscount	=	function(){

			Discount.update({id : vm.updateDiscount.intDiscountId}, vm.updateDiscount).$promise.then(function(data){

				vm.discountList.splice(vm.updateDiscount.index, 1);
				vm.discountList.push(data.discount);
				swal('Success!', data.message, 'success');
				$('#modalUpdateItem').closeModal();
				vm.updateDiscount 			=	null;

			})
				.catch(function(response){

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}//end if

				});

		}//end function

		vm.deleteDiscount 		=	function(discount, index){

			var discount 		=	new Discount({id : discount.intDiscountId});
			discount.$delete(function(data){

				vm.archiveDiscountList.push(data.discount);
				vm.discountList.splice(index, 1);
				swal('Success!', data.message, 'success');
				vm.archiveDiscountList 			=	$filter('orderBy')(vm.archiveDiscountList, 'strDiscountName', false);

			});

		}//end function

		vm.reactivateDiscount 	=	function(discount, index){

			var discount 		=	new Discount({id : discount.intDiscountId, method : 'reactivate'});
			discount.$save(function(data){

				vm.archiveDiscountList.splice(index, 1);
				vm.discountList.push(data.discount);
				swal('Success!', data.message, 'success');
				vm.discountList 			=	$filter('orderBy')(vm.discountList, 'strDiscountName', false);

			});

		}//end function

	});