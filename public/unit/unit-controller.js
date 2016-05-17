var unitApp = angular.module('unitApp', ['ui.materialize'])
	.run(function($rootScope){
		$rootScope.unit = {};
	});

unitApp.controller('ctrl.buildingCollapsible', function($scope, $rootScope, $http){

	$http.get('api/v1/building')
		.success(function(data){
			$rootScope.buildings = data;
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.GetBuilding = function(id, index){
		$http.get('api/v1/building/'+id+'/floorBlock')
			.success(function(data){
				$rootScope.buildings[index].floors = data;
				$rootScope.buildingIndex = index;
				$rootScope.buildingCode = $rootScope.buildings[index].strBuildingCode;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.GetFloorBlock = function(id, index){
		$http.get('api/v1/floor/'+id+'/block')
			.success(function(data){
				$rootScope.buildings[$rootScope.buildingIndex].floors[index].blocks = data;
				angular.forEach($rootScope.buildings[$rootScope.buildingIndex].floors[index].blocks, function(block){
					if (block.intUnitType == 1){
						block.strUnitType = 'Columbary Vaults';
					}else{
						block.strUnitType = 'Full Body Crypts';
					}
				});
				$rootScope.floorIndex = index;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.GetBlockUnit = function(id, index){
		$http.get('api/v1/block/'+id+'/unit')
			.success(function(dataUnit){
				$http.get('api/v1/block/'+id+'/unitcategory')
					.success(function(dataUnitcategory){
						var intColumnNo = dataUnit.length/dataUnitcategory;
						var unitTable = [];
						var intUnitCtr = 0;
						for(var intLevelCtr = 0; intLevelCtr < dataUnitcategory; intLevelCtr++){
							var unitLevel = [];
							for(var intCtr = 0; intCtr < intColumnNo; intCtr++, intUnitCtr++){
								var unit = dataUnit[intUnitCtr];
								if (dataUnit[intUnitCtr].intUnitStatus > 0){
									unit.unitColor = 'green';
								}else{
									unit.unitColor = 'red';
								}
								unitLevel.push(unit);
							}
							unitTable.push(unitLevel);
						}
						$rootScope.units = unitTable;
						console.log($rootScope.units);
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

});

unitApp.controller('ctrl.unitTable', function($rootScope, $scope, $http){

	$scope.OpenUnit = function(id){
		$http.get('api/v1/unit/'+id+'/show')
			.success(function(data){
				$rootScope.unit = {};
				if (data.intUnitStatus > 0){
					$rootScope.unit.strUnitStatus = 'Active';	
					$rootScope.unit.colorStatus = 'green';
					$rootScope.unit.unitActive = true;
					$rootScope.unit.unitDeactive = false;
				}else{
					$rootScope.unit.strUnitStatus = 'Deactivated';	
					$rootScope.unit.colorStatus = 'red';
					$rootScope.unit.unitDeactive = true;
					$rootScope.unit.unitActive = false;
				}
				$rootScope.unit.intUnitId = id;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
		$('#modal1').openModal();
	};

});

unitApp.controller('ctrl.updateUnit', function($scope, $rootScope, $http){

	$scope.DeactivateUnit = function(){

		swal({
			title: "Deactivate Unit",   
            text: "Are you sure to deactivate this unit?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/unit/'+$rootScope.unit.intUnitId+'/delete')
					.success(function(data){
						swal('Success!', 'Unit is successfully deactivated', 'success');
						$('#modal1').closeModal();
						$rootScope.unit.unitActive = false;
						angular.forEach($rootScope.units, function(unitLevel){
							angular.forEach(unitLevel, function(unitColumn){
								if (unitColumn.intUnitId == $rootScope.unit.intUnitId){
									unitColumn.unitColor = 'red';
								}
							});
						});
					})
					.error(function(data){
						swal('Error!', 'Something occured.', 'error');
					});
        });

	};

	$scope.ActivateUnit = function(){

		swal({
			title: "Activate Unit",   
            text: "Are you sure to activate this unit?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/unit/'+$rootScope.unit.intUnitId+'/enable')
					.success(function(data){
						swal('Success!', 'Unit is successfully activated.', 'success');
						$('#modal1').closeModal();
						$rootScope.unit.unitDeactive = false;
						angular.forEach($rootScope.units, function(unitLevel){
							angular.forEach(unitLevel, function(unitColumn){
								if (unitColumn.intUnitId == $rootScope.unit.intUnitId){
									unitColumn.unitColor = 'green';
								}
							});
						});
					})
					.error(function(data){
						swal('Error!', 'Something occured.', 'error');
					});
        });

	};

});