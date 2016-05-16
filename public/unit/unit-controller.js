var unitApp = angular.module('unitApp', ['ui.materialize'])
	.run(function($rootScope){

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

	$scope.GetBlockUnit = function(id){
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
								unitLevel.push(unit);
							}
							unitTable.push(unitLevel);
						}
						$rootScope.units = unitTable;
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

});