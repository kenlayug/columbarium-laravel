'use strict;'

angular.module('app')
	.controller('ctrl.query.additional', function($scope, $rootScope, $filter, Additional, AdditionalCategory){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		rs.queriesActive 		=	'active';
		rs.additionalQueryActive 	=	'active';

		Additional.query().$promise.then(function(data){

			vm.additionalList 			=	$filter('orderBy')(data, 'strAdditionalName', false);
			vm.filterAdditionalList		=	vm.additionalList;

		});

		AdditionalCategory.query().$promise.then(function(data){

			vm.additionalCategoryList	=	$filter('orderBy')(data, 'strAdditionalCategoryName', false);

		});

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

	});