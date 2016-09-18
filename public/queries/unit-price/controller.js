'use strict;'
angular.module('app')
	.controller('ctrl.query.unit-price', function($scope, $rootScope, $filter, Building, UnitCategory,
		RoomType){

		var vm			=	$scope;
		var rs 			=	$rootScope;

		rs.queriesActive 		=	'active';
		rs.priceQueryActive		=	'active';

		vm.intFloorNo	=	0;

		Building.query().$promise.then(function(data){

			vm.buildingList 			=	$filter('orderBy')(data, 'strBuildingName', false);
			angular.forEach(data, function(building){

				if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

					vm.intFloorNo	=	building.floorNo;

				}

			});

		});

		UnitCategory.get().$promise.then(function(data){

			var levelLetter 			=	64;
			angular.forEach(data.unitCategoryList, function(unitCategory){

				unitCategory.display    =   String.fromCharCode(parseInt(levelLetter)+parseInt(unitCategory.intLevelNo));

			});
			vm.unitCategoryList 			=	$filter('orderBy')(data.unitCategoryList, ['strBuildingName', 'intFloorNo',
				'strRoomTypeName', 'intLevelNo'], false);
			vm.filterUnitCategoryList 		=	vm.unitCategoryList;

		});

		RoomType.get({id : 'units'}).$promise.then(function(data){

			vm.unitTypeList 		=	$filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

		});


		vm.filterUnitPrices				=	function(){

			var filterRoom 		=	vm.filter;
			if (filterRoom.intBuildingId > 0 || (filterRoom.intBuildingId != undefined && filterRoom.intBuildingId != 0)){

				vm.filterUnitCategoryList 			=	[];
				angular.forEach(vm.buildingList, function(building){

					if (building.intBuildingId == filterRoom.intBuildingId){

						vm.intFloorNo 			=	 building.floorNo;

					}

				});
				angular.forEach(vm.unitCategoryList, function(unitCategory){

					if (unitCategory.intBuildingId == filterRoom.intBuildingId){

						vm.filterUnitCategoryList.push(unitCategory);

					}

				});

			}else{

				vm.intFloorNo 				=	0;
				vm.filterUnitCategoryList 			=	vm.unitCategoryList;
				angular.forEach(vm.buildingList, function(building){

					if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

						vm.intFloorNo		=	building.floorNo;

					}

				});

			}

			var filterUnitCategoryList 		=	vm.filterUnitCategoryList;
			if (filterRoom.intFloorNo > 0 || (filterRoom.intFloorNo != undefined && filterRoom.intFloorNo != 0)){

				vm.filterUnitCategoryList		=	[];
				angular.forEach(filterUnitCategoryList, function(unitCategory){

					if (unitCategory.intFloorNo == filterRoom.intFloorNo){

						vm.filterUnitCategoryList.push(unitCategory);

					}

				});

			}

			filterUnitCategoryList 			=	vm.filterUnitCategoryList;
			if (filterRoom.intUnitTypeId > 0 || (filterRoom.intUnitTypeId != undefined && filterRoom.intUnitTypeId != 0)){

				vm.filterUnitCategoryList		=	[];
				angular.forEach(filterUnitCategoryList, function(unitCategory){

					if (unitCategory.intRoomTypeId == filterRoom.intUnitTypeId){

						vm.filterUnitCategoryList.push(unitCategory);

					}

				});

			}

		}

	});