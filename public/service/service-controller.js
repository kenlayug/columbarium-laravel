var serviceApp = angular.module('serviceApp', [])
	.run(function($rootScope){

	});

serviceApp.controller('ctrl.serviceTable', function($scope, $rootScope, $http){

	$http.get('api/v1/service')
		.success(function(data){
			$rootScope.services = data;
		})
		.error(function(data){
			console.log('Error:'+data);
		});

});

serviceApp.controller('ctrl.getRequirement', function($scope, $rootScope, $http){
	$http.get('api/v1/requirement')
		.success(function(data){
			$rootScope.requirements = data;
		})
		.error(function(data){
			console.log('Error:'+data);
		});
});