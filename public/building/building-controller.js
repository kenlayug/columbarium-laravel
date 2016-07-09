var buildingApp = angular.module('buildingApp', ['datatables'])
	.run(function($rootScope){
		$rootScope.update = {};
	});

buildingApp.controller('ctrl.buildingTable', function($scope, $rootScope, $http, $filter){

	$http.get('api/v1/building')
		.success(function(data){
			$rootScope.buildings = $filter('orderBy')(data, 'strBuildingName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.UpdateBuilding = function(id, index){
		$http.get('api/v1/building/'+id+'/show')
			.success(function(data){
				$rootScope.update.index = index;
				$rootScope.update.intBuildingId = data.intBuildingId;
				$rootScope.update.strBuildingName = data.strBuildingName;
				$rootScope.update.strBuildingCode = data.strBuildingCode;
				$rootScope.update.strBuildingLocation = data.strBuildingLocation;
				$('#modalUpdateBuilding').openModal();
				$('#updateName').prop('class', 'active');
				$('#updateCode').prop('class', 'active');
				$('#updateLocation').prop('class', 'active');
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.DeactivateBuilding = function(id, index){
		swal({
			title: "Deactivate Building",   
            text: "Are you sure to deactivate this building?",   
            type: "warning",   showCancelButton: true,    
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, deactivate it!",     
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
               $http.post('api/v1/building/'+id+'/delete')
               	.success(function(data){
               		$rootScope.buildings.splice(index, 1);
               		$rootScope.deactivatedBuildings.push(data);
               		$rootScope.deactivatedBuildings = $filter('orderBy')($rootScope.deactivatedBuildings, 'strBuildingName', false);
               		swal("Success!", "Building is successfully deactivated.", "success");
               	})
               	.error(function(data){
               		swal("Error!", "Something occured.", "error");
               	});
        });
	};

});

buildingApp.controller('ctrl.newBuilding', function($scope, $rootScope, $http,  $filter){

	$scope.SaveBuilding = function(){

		if($scope.building.strBuildingName == null || $scope.building.strBuildingCode == null || $scope.building.strBuildingLocation == null){
			swal("Error!", "Required fields cannot be null.", "error");
		}else{
			swal({
				title: "Create Building",   
	            text: "Are you sure to create this building?",   
	            type: "warning",   showCancelButton: true,    
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, create it!",     
	            cancelButtonText: "No, cancel pls!",
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	                var data = {
						strBuildingName: $scope.building.strBuildingName,
						strBuildingCode: $scope.building.strBuildingCode,
						strBuildingLocation : $scope.building.strBuildingLocation,
						intFloorNo : $scope.building.intFloorNo
					};

					$http.post('api/v1/building', data)
						.success(function(data){
							if (data == 'error-existing'){
								swal("Error!", "Building name or code is already taken.", "error");
							}else{
								swal("Success!", "Building is successfully saved.", "success");
								$rootScope.buildings.push(data);
								$rootScope.buildings    =   $filter('orderBy')($rootScope.buildings, 'strBuildingName', false);
								$scope.building         =   null;
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

buildingApp.controller('ctrl.updateBuilding', function($rootScope, $scope, $http, $filter){

	$scope.SaveBuilding = function(){
		var data = {
			strBuildingName : $rootScope.update.strBuildingName,
			strBuildingCode : $rootScope.update.strBuildingCode,
			strBuildingLocation : $rootScope.update.strBuildingLocation
		};
		if($scope.update.strBuildingName == null || $scope.update.strBuildingCode == null || $scope.update.strBuildingLocation == null){
			swal("Error!", "Required fields cannot be null.", "error");
		}else{

			swal({
				title: "Update Building",   
	            text: "Are you sure to update this building?",   
	            type: "warning",   showCancelButton: true,   
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, update it!",     
	            cancelButtonText: "No, cancel pls!", 
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	               $http.post('api/v1/building/'+$rootScope.update.intBuildingId+'/update', data)
	               	.success(function(data){
	               		if (data == 'error-existing'){
	               			swal("Error!", "Building name or code is already taken.", "error");
	               		}else{
		               		$rootScope.buildings.splice($rootScope.update.index, 1);
		               		$rootScope.buildings.push(data);
		               		$rootScope.buildings = $filter('orderBy')($rootScope.buildings, 'strBuildingName', false);
		               		$('#modalUpdateBuilding').closeModal();
		               		swal("Success!", "Building is successfully updated.", "success");
		               	}
	               	})
	               	.error(function(data){
	               		swal("Error!", "Something occured.", "error");
	               	});
	        });
		}

	};

});

buildingApp.controller('ctrl.deactivatedTable', function($rootScope, $scope, $http, $filter){

	$http.get('api/v1/building/archive')
		.success(function(data){
			$rootScope.deactivatedBuildings = $filter('orderBy')(data, 'strBuildingName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivateBuilding = function(id, index){
		swal({
			title: "Reactivate Building",   
            text: "Are you sure to reactivate this building?",   
            type: "warning",   showCancelButton: true,    
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, reactivate it!",     
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/building/'+id+'/enable')
                	.success(function(data){
                		swal("Success!", "Building is now successfully reactivated.", "success");
                		$rootScope.deactivatedBuildings.splice(index, 1);
                		$rootScope.buildings.push(data);
                		$rootScope.buildings = $filter('orderBy')($rootScope.buildings, 'strBuildingName', false);
                	})
                	.error(function(data){
                		swal("Error!", "Something occured.", "error");
                	});
        });
	};

});