(function(){
	
	'use strict';
	angular.module('app')
		.controller('ctrl.user', function($scope, $rootScope, Login){

			var vm 			=	$scope;

			Login.get().$promise.then(function(data){

				vm.user 		=	data.user;

			});

		});

})();