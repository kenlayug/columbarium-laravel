'use strict;'

angular.module('app')
	.controller('ctrl.query.package', function($scope, $rootScope, $filter, Package, Additional, Service){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		rs.queriesActive 			=	'active';
		rs.packageQueryActive 		=	'active';

		Package.query().$promise.then(function(data){

			angular.forEach(data, function(packageDetail){

				Package.query({id : packageDetail.intPackageId, method : 'service'}).$promise.then(function(data){

					packageDetail.serviceList 		=	data;

				});

				Package.query({id : packageDetail.intPackageId, method : 'additional'}).$promise.then(function(data){

					packageDetail.additionalList 		=	data;

				});

			});

			vm.packageList				=	$filter('orderBy')(data, 'strPackageName', false);
			vm.filterPackageList		=	vm.packageList;

		});

		Service.get().$promise.then(function(data){

			vm.serviceList 				=	$filter('orderBy')(data.serviceList, 'strServiceName', false);
			vm.filterServiceList		=	vm.serviceList;

		});

		Additional.query().$promise.then(function(data){

			vm.additionalList 			=	$filter('orderBy')(data, 'strAdditionalName', false);
			vm.filterAdditionalList		=	vm.additionalList;

		});

		vm.filterPackages 				=	function(intServiceId, intAdditionalId){

			if (intServiceId != 0){

				vm.filterPackageList 		=	[];
				angular.forEach(vm.packageList, function(packageDetail){

					angular.forEach(packageDetail.serviceList, function(service){

						if (service.intServiceId == intServiceId){

							vm.filterPackageList.push(packageDetail);

						}

					});

				});

			}else{

				vm.filterPackageList 		=	vm.packageList;

			}

			var packageList 			=	vm.filterPackageList;

			if (intAdditionalId != 0){

				angular.forEach(packageList, function(package){

					angular.forEach(packageDetail.additionalList, function(additional){

						if (additional.intAdditionalId == intAdditionalId){

							vm.filterPackageList.push(packageDetail);

						}//end if

					});

				});

			}else{
				vm.filterPackageList 			=	packageList;
			}

		}

	});