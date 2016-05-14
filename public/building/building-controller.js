var buildingApp = angular.module('buildingApp', [])
	.run(function($rootScope){
		$rootScope.update = {};
	});

buildingApp.controller('ctrl.buildingTable', function($scope, $rootScope, $http){

	$http.get('api/v1/building')
		.success(function(data){
			$rootScope.buildings = data;
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
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.DeactivateBuilding = function(id, index){
		swal({
			title: "Deactivate Building",   
            text: "Are you sure to deactivate this building?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
               $http.post('api/v1/building/'+id+'/delete')
               	.success(function(data){
               		$rootScope.buildings.splice(index, 1);
               		$rootScope.deactivatedBuildings.push(data);
               		swal("Success!", "Building is successfully deactivated.", "success");
               	})
               	.error(function(data){
               		swal("Error!", "Something occured.", "error");
               	});
        });
	};

});

buildingApp.controller('ctrl.newBuilding', function($scope, $rootScope, $http){

	$scope.SaveBuilding = function(){

		swal({
			title: "Create Building",   
            text: "Are you sure to create this building?",   
            type: "info",   showCancelButton: true,   
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
							swal("Warning!", "Building name or code is already taken.", "warning");
						}else{
							swal("Success!", "Building is successfully saved.", "success");
							$rootScope.buildings.push(data);
						}
					})
					.error(function(data){
						console.log(data);
						swal("Error!", "Something occured.", "error");
					});
        });

	};

});

buildingApp.controller('ctrl.updateBuilding', function($rootScope, $scope, $http){

	$scope.SaveBuilding = function(){
		var data = {
			strBuildingName : $rootScope.update.strBuildingName,
			strBuildingCode : $rootScope.update.strBuildingCode,
			strBuildingLocation : $rootScope.update.strBuildingLocation
		};

		swal({
			title: "Update Building",   
            text: "Are you sure to update this building?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
               $http.post('api/v1/building/'+$rootScope.update.intBuildingId+'/update', data)
               	.success(function(data){
               		if (data == 'error-existing'){
               			swal("Warning!", "Building name or code is already taken.", "warning");
               		}else{
	               		$rootScope.buildings.splice($rootScope.update.index, 1);
	               		$rootScope.buildings.push(data);
	               		$('#modalUpdateBuilding').closeModal();
	               		swal("Success!", "Building is successfully updated.", "success");
	               	}
               	})
               	.error(function(data){
               		swal("Error!", "Something occured.", "error");
               	});
        });

	};

});

buildingApp.controller('ctrl.deactivatedTable', function($rootScope, $scope, $http){

	$http.get('api/v1/building/archive')
		.success(function(data){
			$rootScope.deactivatedBuildings = data;
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivateBuilding = function(id, index){
		swal({
			title: "Reactivate Building",   
            text: "Are you sure to reactivate this building?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/building/'+id+'/enable')
                	.success(function(data){
                		swal("Success!", "Building is now successfully reactivated.", "success");
                		$rootScope.deactivatedBuildings.splice(index, 1);
                		$rootScope.buildings.push(data);
                	})
                	.error(function(data){
                		swal("Error!", "Something occured.", "error");
                	});
        });
	};

});