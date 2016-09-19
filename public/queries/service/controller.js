'use strict;'
angular.module('app')
	.controller('ctrl.query.service', function($scope, $rootScope, $filter, Service, ServiceCategory){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		rs.queriesActive 			=	'active';
		rs.serviceQueryActive 		=	'active';

		Service.get().$promise.then(function(data){

			vm.serviceList 				=	$filter('orderBy')(data.serviceList, 'strServiceName', false);
			vm.filterServiceList		=	vm.serviceList;

		});

		ServiceCategory.get().$promise.then(function(data){

			vm.serviceCategoryList 		=	$filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);

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

	});