'use strict;'
angular.module('app')
	.controller('ctrl.query.interest', function($scope, $rootScope, $filter, Interest){

		var rs 			=	$rootScope;
		var vm 			=	$scope;

		rs.queriesActive 			=	'active';
		rs.interestQueryActive		=	'active';

		Interest.get().$promise.then(function(data){

			vm.interestList 			=	$filter('orderBy')(data.interestList, 'intNoOfYear', false);

		});

	});