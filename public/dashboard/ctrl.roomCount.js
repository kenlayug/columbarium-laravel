(function(){
	
	'use strict';
	angular.module('app')
		.controller('ctrl.roomCount', function($scope, Room){

			var vm 			=	$scope;

			Room.get({
				method 	: 	'count'
			}).$promise.then(function(data){

				vm.intRoomCount 		=	data.intRoomCount;

			});

		});

})();