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
		$http.get('api/v1/service/'+id+'/show')
			.success(function(data){
				$rootScope.update.intServiceId = data.intServiceId;
				$rootScope.update.strServiceName = data.strServiceName;
				$rootScope.update.strServiceDesc = data.strServiceDesc;
				$rootScope.update.deciPrice = parseInt(data.price.deciPrice, 10);
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
                $http.post('api/v1/service/'+id+'/delete')
					.success(function(data){
						swal("Success!", "Service is successfully deactivated.", "success");
						$rootScope.services.splice(index, 1);
						$rootScope.deactivatedServices.push(data);
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

		if($scope.update.strServiceName == null){
			swal("Error!", "Service name cannot be null.", "error");
		}else{

			swal({
				title: "Update Service",   
	            text: "Are you sure to update this service?",   
	            type: "info",   showCancelButton: true,   
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, update it!",    
	            cancelButtonText: "No, cancel pls!",  
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	                $http.post('api/v1/service/'+$scope.update.intServiceId+'/update', data)
						.success(function(data){
							swal("Success!", "Service is successfully updated.", "success");
							$('#modalUpdateService').closeModal();
							$rootScope.services.splice($rootScope.update.index, 1);
							$rootScope.services.push(data);
							$rootScope.services = $filter('orderBy')($rootScope.services, 'strServiceName', false);
						})
						.error(function(data){
							swal("Error!", "Something occured.", "error");
						});
	        });
		}
		
	};
});

serviceApp.controller('ctrl.getRequirement', function($scope, $rootScope, $http, $filter){
	$http.get('api/v1/requirement')
		.success(function(data){
			$scope.requirements = $filter('orderBy')(data, 'strRequirementName', false);
		})
		.error(function(data){
			console.log('Error:'+data);
		});
});

serviceApp.controller('ctrl.deactivatedTable', function($scope, $rootScope, $http, $filter){
	$http.get('api/v1/service/archive')
		.success(function(data){
			$rootScope.deactivatedServices = $filter('orderBy')(data, 'strServiceName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivateService = function(id, index){
		
		swal({
			title: "Reactivate Service",   
            text: "Are you sure to reactivate this service?",   
            type: "info",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, reactivate it!",    
            cancelButtonText: "No, cancel pls!",  
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/service/'+id+'/enable')
				.success(function(data){
					swal("Success!", "Service is successfully reactivated.", "success");
					$rootScope.deactivatedServices.splice(index, 1);
					$rootScope.services.push(data);
					$rootScope.services = $filter('orderBy')($rootScope.services, 'strServiceName', false);
				})
				.error(function(data){
					swal("Error!", "Something occured.", "error");
				});
        });

	};
});

serviceApp.controller('ctrl.newService', function($scope, $rootScope, $http){

	$scope.CreateNewService = function(){

        console.log('Here at save Requirement...');
		var requirements = $("input[name='requirement[]']:checked").map(function() {
	    		return this.value;
	    	}).get();

		var data = {
			strServiceName : $scope.strServiceName,
			strServiceDesc : $scope.strServiceDesc,
			deciPrice : $scope.deciPrice,
			requirementList : requirements
		};

		if ($scope.strServiceName == null){
			swal("Error!", "Service name cannot be null.", "error");
		}else{

			swal({
				title: "Create Service",   
	            text: "Are you sure to create this service?",   
	            type: "info",   showCancelButton: true,   
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, create it!",    
	            cancelButtonText: "No, cancel pls!",  
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	                $http.post('api/v1/service', data)
						.success(function(data){
							console.log(data);
							if (data === "error-exist"){
								swal("Warning!", "Service already exists.", "warning");
							}else{
								swal("Success!", "Service is successfully created.", "success");
								$rootScope.services.push(data);
								$scope.strServiceName = "";
								$scope.strServiceDesc = "";
								$scope.deciPrice = "";
								angular.forEach(requirements, function(requirement){
									$('#'+requirement).prop('checked', false);
								});
							}
						})
						.error(function(data){
							console.log(data);
							swal("Error!", "Something occured.", "error");
						});
	        });

		}
		
	};

});