'use strict;'
angular.module('app')
	.controller('ctrl.notification', function($scope, $rootScope, $filter, Notification){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		vm.notificationTypeList 		=	[
			'',
			'Downpayment Forfeition',
			'Collection Due',
			'Schedule'
		];

		vm.notificationIconList 			=	[
			'',
			'error_outline',
			'error_outline',
			'schedule'
		];

		vm.notificationColorList 			=	[
			'',
			'red',
			'red',
			'yellow'
		];

		Notification.get().$promise.then(function(data){

			vm.notificationList 		=	data.notificationList;

		});

	});