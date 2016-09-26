(function(){
	
	'use strict';
	angular.module('app')
		.controller('ctrl.unitCount', function($scope, $filter, Unitv2){

			var vm 			=	$scope;

			Unitv2.get({
				method	 	: 	'count'
			}).$promise.then(function(data){

				vm.intUnitCount 			=	data.intUnitCount;

			});

		});

})();