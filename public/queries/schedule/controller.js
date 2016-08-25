'use strict;'

angular.module('app')
	.controller('ctrl.query.schedule', function($scope, $rootScope, $filter, ServiceCategory){

		var vm 						=	$scope;
		var rs 						=	$rootScope;

		ServiceCategory.get().$promise.then(function(data){

			vm.serviceList 			=	$filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);
			vm.filter					=	{
				dateSchedule 			: 	moment().format('MM/DD/YYYY')
			};

		});

	});