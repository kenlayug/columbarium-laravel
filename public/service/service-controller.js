var serviceApp = angular.module('serviceApp', [])
	.run(function($rootScope){
		$rootScope.update = {};
	});

serviceApp.controller('ctrl.serviceTable', function($scope, $rootScope, $http){

	$http.get('api/v1/service')
		.success(function(data){
			$rootScope.services = data;
		})
		.error(function(data){
			console.log('Error:'+data);
		});

	$scope.GetRequirement = function(id){
		$http.get('api/v1/service/'+id+'/requirement')
			.success(function(data){
				$('#modalListOfRequirement').openModal();
				$rootScope.serviceRequirements = data;
			})
			.error(function(data){

			});
	};

	$scope.UpdateService = function(id, index){
		$http.get('api/v1/service/'+id)
			.success(function(data){
				$rootScope.update.intServiceId = data.intServiceId;
				$rootScope.update.strServiceName = data.strServiceName;
				$rootScope.update.strServiceDesc = data.strServiceDesc;
				$rootScope.update.deciPrice = data.price.deciPrice;
				$('#updateName').prop('class', 'active');
				$('#updatePrice').prop('class', 'active');
				$('#updateDesc').prop('class', 'active');
				$http.get('api/v1/service/'+id+'/requirement')
					.success(function(data){
						angular.forEach(data, function(requirement){
							var checkbox = '#'+requirement.intRequirementIdFK;
							console.log(checkbox);
							$(checkbox).prop('checked', true);
						});
					})
					.error(function(data){
						console.log(data);
					});
				$rootScope.update.index = index;
				$('#modalUpdateService').openModal();
			})
			.error(function(data){
				console.log('Error:'+data);
			});
	};

	$scope.DeleteService = function(id, index){
		swal({
			title: "Deactivate Service",   
            text: "Are you sure to deactivate this service?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.delete('api/v1/service/'+id)
					.success(function(data){
						swal("Success!", "Service is successfully deactivated.", "success");
						$rootScope.services.splice(index, 1);
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});
        });
	}

});

serviceApp.controller('ctrl.updateRequirement', function($scope, $rootScope, $http, $filter){
	$scope.SaveRequirement = function(){
		var requirements = $("input[name='requirement[]']:checked").map(function() {
	    		return this.value;
	    	}).get();
		var data = {
			strServiceName : $scope.update.strServiceName,
			strServiceDesc : $scope.update.strServiceDesc,
			deciPrice : $scope.update.deciPrice,
			requirementList : requirements
		};

		swal({
			title: "Update Service",   
            text: "Are you sure to update this service?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.put('api/v1/service/'+$scope.update.intServiceId, data)
					.success(function(data){
						swal("Success!", "Service is successfully updated.", "success");
						$('#modalUpdateService').closeModal();
						$rootScope.services.splice($rootScope.update.index, 1);
						$rootScope.services.push(data);
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});
        });
		
	};
});

serviceApp.controller('ctrl.getRequirement', function($scope, $rootScope, $http, $filter){
	$http.get('api/v1/requirement')
		.success(function(data){
			$scope.requirements = data;
		})
		.error(function(data){
			console.log('Error:'+data);
		});
});

serviceApp.controller('ctrl.newService', function($scope, $rootScope, $http){

	$scope.CreateNewService = function(){
		var requirements = $("input[name='requirement[]']:checked").map(function() {
	    		return this.value;
	    	}).get();

		var data = {
			strServiceName : $scope.strServiceName,
			strServiceDesc : $scope.strServiceDesc,
			deciPrice : $scope.deciPrice,
			requirementList : requirements
		};

		swal({
			title: "Create New Service",   
            text: "Are you sure to save this service?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/service', data)
					.success(function(data){
						swal("Success!", "Service is successfully created.", "success");
						$rootScope.services.push(data);
					})
					.error(function(data){
						console.log(data);
						swal("Error!", "Something occured.", "error");
					});
        });
		
	};

});