(function(){
	'use strict';
	angular.module('app')
		.controller('ctrl.login', function($scope, $rootScope, $window, $location, Login){

			var vm 		=	$scope;
			var rs 		=	$rootScope;

			vm.login 		=	function(info){

				console.log(info);
				var login 		=	new Login({
					email 		: 	info.strEmail,
					password 	: 	info.strPassword
				});

				login.$save(function(data){

					swal('Success!', data.message, 'success');
					$window.location.href = '/';

				},
					function(response){

						swal('Error!', response.data.message, 'error');

					});

			}//end function

		});
})();