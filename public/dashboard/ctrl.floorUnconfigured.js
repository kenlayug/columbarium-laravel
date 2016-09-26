(function(){
	
	'use strict';
	angular.module('app')
		.controller('ctrl.floorUnconfigured', function($scope, $rootScope, FloorV2){

			var vm 			=	$scope;

			FloorV2.get({
				type 	: 	'unconfigured'
			}).$promise.then(function(data){

				vm.intFloorUnconfigured 		=	data.intFloorUnconfigured;
				console.log(vm.intFloorUnconfigured);

			});

		});

})();