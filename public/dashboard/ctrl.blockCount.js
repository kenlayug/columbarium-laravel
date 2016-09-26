(function(){
	
	'use strict';
	angular.module('app')
		.controller('ctrl.blockCount', function($scope, $rootScope, Block){

			var vm 			=	$scope;

			Block.get({
				method 		: 	'count'
			}).$promise.then(function(data){

				vm.intBlockCount 			=	data.intBlockCount;

			});

		});

})();