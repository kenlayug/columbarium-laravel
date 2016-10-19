(function(){
	'use strict';
	angular.module('app')
		.controller('ctrl.logout', function($scope, $rootScope, $window, $location, Login){

			var vm 			=	$scope;

			vm.logout			=	function(){

				Login.get({method : 'logout'}).$promise.then(function(data){

					swal('Success!', data.message, 'success');
					$window.location.href = '/login-page';

				});

			}//end function

		});
})();