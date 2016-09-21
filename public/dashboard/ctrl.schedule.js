'use strict;'
angular.module('app')
	.controller('ctrl.schedule', function($scope, $rootScope, $filter, Schedule){

		var vm 				=	$scope;

		vm.dateNow 			=	moment();

		Schedule.get({
			param1 : moment().format('MMMM D, YYYY')
		}).$promise.then(function(data){

			vm.scheduleList 		=	data.scheduleList;

		});

	});