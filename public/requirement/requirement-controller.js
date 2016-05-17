var requirementApp = angular.module('requirementApp', [])
	.run(function($rootScope){
		$rootScope.requirement = {};
		$rootScope.update = {};
		$rootScope.delete = {};
		$rootScope.hasSucceed = false;
	});

requirementApp.controller('ctrl.requirementTable', function($scope, $rootScope, $http, $filter){
	$http.get('api/v1/requirement')
		.success(function(data){
			console.log(data);
			$rootScope.requirements = $filter('orderBy')(data, 'strRequirementName', false);
		})
		.error(function(data){
			console.log("Error: "+data);
		});

	$scope.UpdateRequirement = function(id, index){
		$http.get('api/v1/requirement/'+id+'/show')
			.success(function(data){
				$rootScope.update.intRequirementId = data.intRequirementId;
				$rootScope.update.strRequirementName = data.strRequirementName;
				$rootScope.update.strRequirementDesc = data.strRequirementDesc;
				$('#modalUpdateRequirement').openModal();
				$rootScope.update.index = index;
			})
			.error(function(data){
				console.log('Error: '+data);
			});
	};

	$scope.DeleteRequirement = function(id, index){
		$rootScope.delete.intRequirementId = id;
		swal({
			title: "Deactivate Requirement",   
            text: "Are you sure to deactivate this requirement?",   
            type: "warning",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, deactivate it!",    
            cancelButtonText: "No, cancel pls!",  
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/requirement/'+$rootScope.delete.intRequirementId+'/delete')
					.success(function(data){
						console.log('deleted...');
				        swal("Success!", "Requirement is successfully deactivated.", "success");
				        $rootScope.requirements.splice(index, 1);
				        $rootScope.deactivatedRequirements.push(data);
				        $rootScope.deactivatedRequirements = $filter('orderBy')($rootScope.deactivatedRequirements, 'strRequirementName', false);
					})
					.error(function(data){
						console.log('Error: '+data);
				        swal("Error!", "Something occured.", "error");
					});
        });
	};
});

requirementApp.controller('ctrl.newRequirement', function($scope, $rootScope, $http, $filter){
	$scope.SaveRequirement = function(){

		var data = {
			strRequirementName : $scope.requirement.strRequirementName,
			strRequirementDesc : $scope.requirement.strRequirementDesc
		};
		var strRequirementName = $scope.requirement.strRequirementName;
		if(strRequirementName == null){
			swal("Error!", "Requirement name cannot be null.", "error");
		}else{
			swal({
				title: "Create Requirement",   
	            text: "Are you sure to create this requirement?",   
	            type: "warning",   showCancelButton: true,    
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, create it!",    
	            cancelButtonText: "No, cancel pls!", 
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	                $http.post('api/v1/requirement', data)
						.success(function(data){
							if (data == "error-existing"){
								swal("Error!", "Requirement already exists.", "error");
							}else{
								$rootScope.requirements.push(data);
								$rootScope.requirements = $filter('orderBy')($rootScope.requirements, 'strRequirementName', false);
						        swal("Success!", "Requirement is successfully created.", "success");
						        $scope.requirement.strRequirementName = "";
						        $scope.requirement.strRequirementDesc = "";
						    }
						})
						.error(function(data){
							console.log('Error: '+data);
							swal("Error", "Something occured.", "error");
						});
	        });
		}
	};
});

requirementApp.controller('ctrl.deactivateTable', function($rootScope, $scope, $http, $filter){
	$http.get('api/v1/requirement/archive')
		.success(function(data){
			$rootScope.deactivatedRequirements = $filter('orderBy')(data, 'strRequirementName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivateRequirement = function(id, index){
		swal({
			title: "Reactivate Requirement",   
            text: "Are you sure to reactivate this requirement?",   
            type: "warning",   showCancelButton: true,    
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, reactivate it!",    
            cancelButtonText: "No, cancel pls!", 
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/requirement/'+id+'/enable')
					.success(function(data){
						swal("Success!", "Requirement successfully reactivated.", "success");
						$rootScope.requirements.push(data);
						$rootScope.requirements = $filter('orderBy')($rootScope.requirements, 'strRequirementName', false);
						$rootScope.deactivatedRequirements.splice(index, 1);
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});
        });
	};
});

requirementApp.controller('ctrl.updateRequirement', function($scope, $rootScope, $http, $filter){
	$scope.SaveRequirement = function(){
		$('modalLoading').openModal();
		var data = {
			strRequirementName : $scope.update.strRequirementName,
			strRequirementDesc : $scope.update.strRequirementDesc
		};
		if ($scope.update.strRequirementName == null){
			swal("Error!", "Requirement name cannot be null.", "error");
		}else{

			swal({
				title: "Update Requirement",   
	            text: "Are you sure to update this requirement?",   
	            type: "info",   showCancelButton: true,    
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, update it!",    
	            cancelButtonText: "No, cancel pls!", 
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	                $http.post('api/v1/requirement/'+$scope.update.intRequirementId+'/update', data)
						.success(function(data){
							if (data == "error-existing"){
								swal("Error!", "Requirement already exists!", "error");
							}else{
								$('#modalUpdateRequirement').closeModal();
								$rootScope.requirements.splice($rootScope.update.index, 1);
								$rootScope.requirements.push(data);	
								$rootScope.requirements = $filter('orderBy')($rootScope.requirements, 'strRequirementName', false);
								swal("Success!", "Requirement is successfully updated.", "success");
							}
						})
						.error(function(data){
							console.log('Error: '+data);
							swal("Error!", "Something occured.", "error");
						});
	        });

		}
		
	};
});