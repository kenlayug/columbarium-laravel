'use strict';
angular.module('app')
	.controller('ctrl.queries', ['$scope', '$filter', 'Package', 'Additional', 'Service',
		'ServiceCategory', 'AdditionalCategory', 'Interest',
		function($scope, $filter, Package, Additional, Service, ServiceCategory, AdditionalCategory,
			Interest){

		var vm				=	$scope;

		Additional.query().$promise.then(function(data){

			vm.additionalList 			=	$filter('orderBy')(data, 'strAdditionalName', false);
			vm.filterAdditionalList		=	vm.additionalList;

		});

		Service.get().$promise.then(function(data){

			vm.serviceList 				=	$filter('orderBy')(data.serviceList, 'strServiceName', false);
			vm.filterServiceList		=	vm.serviceList;

		});

		Package.query().$promise.then(function(data){

			vm.packageList				=	$filter('orderBy')(data, 'strPackageName', false);
			vm.filterPackageList		=	vm.packageList;

		});

		ServiceCategory.get().$promise.then(function(data){

			vm.serviceCategoryList 		=	$filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);

		});

		AdditionalCategory.query().$promise.then(function(data){

			vm.additionalCategoryList	=	$filter('orderBy')(data, 'strAdditionalCategoryName', false);

		});

		Interest.query().$promise.then(function(data){

			vm.interestList 			=	$filter('orderBy')(data, ['intNoOfYear', 'intAtNeed'], false);
			vm.filterInterestList		=	vm.interestList;

		});

		vm.filterServices 				=	function(intServiceCategoryId){

			if (intServiceCategoryId != 0){

				vm.filterServiceList		=	[];
				angular.forEach(vm.serviceList, function(service){

					if (service.intServiceCategoryIdFK == intServiceCategoryId){

						vm.filterServiceList.push(service);

					}

				});

			}else{

				vm.filterServiceList		=	vm.serviceList;

			}

		}

		vm.filterAdditionals 			=	function(intAdditionalCategoryId){

			if (intAdditionalCategoryId != 0){

				vm.filterAdditionalList		=	[];
				angular.forEach(vm.additionalList, function(additional){

					if (additional.intAdditionalCategoryIdFK == intAdditionalCategoryId){

						vm.filterAdditionalList.push(additional);

					}

				});

			}else{

				vm.filterAdditionalList		=	vm.additionalList;

			}

		}

		vm.filterInterests 				=	function(intAtNeed){

			if (intAtNeed != 2){

				vm.filterInterestList		=	[];
				angular.forEach(vm.interestList, function(interest){

					if (interest.intAtNeed == intAtNeed){

						vm.filterInterestList.push(interest);

					}

				});

			}else{

				vm.filterInterestList		=	vm.interestList;

			}

		}

	}]);