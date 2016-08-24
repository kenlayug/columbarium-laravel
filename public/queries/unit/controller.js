'use strict;'

angular.module('app')
	.controller('ctrl.query.unit', function($scope, $rootScope, $filter, Building, Room, RoomType, Block, Unit){

		var vm 				=	$scope;
		var rs 				=	$rootScope;

		vm.unitStatusList 	=	[
			'',
			'Available',
			'Reserved',
			'Owned',
			'At Need',
			'Deactivated'
		];

		Building.query().$promise.then(function(data){

			vm.buildingList 		=	$filter('orderBy')(data, 'strBuildingName', false);
			angular.forEach(vm.buildingList, function(building){

				if (vm.intFloorNo == null || vm.intFloorNo < building.floorNo){

					vm.intFloorNo 			=	building.floorNo;

				}//end if

			});

		});

		Room.get().$promise.then(function(data){

			vm.roomList 			=	$filter('orderBy')(data.roomList, ['strBuildingName', 'intFloorNo', 'strRoomName'], false);
			vm.filterRoomList 		=	vm.roomList;

		});

		Block.get().$promise.then(function(data){

			vm.blockList 			=	$filter('orderBy')(data.blockList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'strBlockName'], false);
			vm.filterBlockList 		=	vm.blockList;

		});

		RoomType.get({id: 'units'}).$promise.then(function(data){

			vm.unitTypeList 		=	$filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

		});

		Unit.get().$promise.then(function(data){

			angular.forEach(data.unitList, function(unit){

				if (unit.strMiddleName == null){
					unit.strMiddleName			=	'';
				}//end if

			});
			vm.unitList 		=	$filter('orderBy')(data.unitList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'intBlockNo', 'intUnitId'], false);
			vm.filterUnitList 	=	vm.unitList;

		});

		vm.filterBlocks 		=	function(){

			var filterRoom 		=	vm.blockFilter;
			if (filterRoom.intBuildingId > 0 || (filterRoom.intBuildingId != undefined && filterRoom.intBuildingId != 0)){

				vm.filterRoomList 			=	[];
				vm.filterBlockList 			=	[];
				vm.filterUnitList 			=	[];
				angular.forEach(vm.buildingList, function(building){

					if (building.intBuildingId == filterRoom.intBuildingId){

						vm.intFloorNo 			=	 building.floorNo;

					}

				});
				angular.forEach(vm.roomList, function(room){

					if (room.intBuildingId == filterRoom.intBuildingId){

						vm.filterRoomList.push(room);

					}

				});
				angular.forEach(vm.blockList, function(block){

					if (block.intBuildingId == filterRoom.intBuildingId){

						vm.filterBlockList.push(block);

					}

				});
				angular.forEach(vm.unitList, function(unit){

					if (unit.intBuildingId == filterRoom.intBuildingId){

						vm.filterUnitList.push(unit);

					}//end if

				});

			}else{

				vm.intFloorNo 				=	0;
				vm.filterRoomList 			=	vm.roomList;
				vm.filterBlockList 			=	vm.blockList;
				vm.filterUnitList 			=	vm.unitList;
				angular.forEach(vm.buildingList, function(building){

					if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

						vm.intFloorNo		=	building.floorNo;

					}

				});

			}

			var filterRoomList 			=	vm.filterRoomList;
			var filterBlockList 		=	vm.filterBlockList;
			var filterUnitList 			=	vm.filterUnitList;
			if (filterRoom.intFloorNo > 0 || (filterRoom.intFloorNo != undefined && filterRoom.intFloorNo != 0)){

				vm.filterRoomList 			=	[];
				vm.filterBlockList 			=	[];
				vm.filterUnitList 			=	[];
				angular.forEach(filterRoomList, function(room){

					if (room.intFloorNo == filterRoom.intFloorNo){

						vm.filterRoomList.push(room);

					}

				});
				angular.forEach(filterBlockList, function(block){

					if (block.intFloorNo == filterRoom.intFloorNo){

						vm.filterBlockList.push(block);

					}

				});
				angular.forEach(filterUnitList, function(unit){

					if (unit.intFloorNo == filterRoom.intFloorNo){
						vm.filterUnitList.push(unit);
					}

				});

			}

			filterBlockList 			=	vm.filterBlockList;
			filterUnitList 				=	vm.filterUnitList;
			if (filterRoom.intRoomId > 0 || (filterRoom.intRoomId != undefined && filterRoom.intRoomId != 0)){

				vm.filterBlockList 			=	[];
				vm.filterUnitList 			=	[];
				angular.forEach(filterBlockList, function(block){

					if (block.intRoomId == filterRoom.intRoomId){

						vm.filterBlockList.push(block);

					}

				});
				angular.forEach(filterUnitList, function(unit){

					if (unit.intRoomId == filterRoom.intRoomId){
						vm.filterUnitList.push(unit);
					}

				});

			}

			filterBlockList 			=	vm.filterBlockList;
			filterUnitList 				=	vm.filterUnitList;
			if (filterRoom.intUnitTypeId > 0 || (filterRoom.intUnitTypeId != undefined && filterRoom.intUnitTypeId != 0)){

				vm.filterBlockList 		=	[];
				vm.filterUnitList 		=	[];
				angular.forEach(filterBlockList, function(block){

					if (block.intUnitTypeIdFK == filterRoom.intUnitTypeId){

						vm.filterBlockList.push(block);

					}

				});
				angular.forEach(filterUnitList, function(unit){

					if (unit.intRoomTypeId == filterRoom.intUnitTypeId){
						vm.filterUnitList.push(unit);
					}

				});

			}

			filterUnitList 				=	vm.filterUnitList;
			if (filterRoom.intBlockNo > 0 || (filterRoom.intBlockNo != undefined && filterRoom.intBlockNo != 0)){

				vm.filterUnitList 			=	[];
				angular.forEach(filterUnitList, function(unit){

					if (filterRoom.intBlockNo == unit.intBlockNo){
						vm.filterUnitList.push(unit);
					}

				});

			}//end if

			filterUnitList 				=	vm.filterUnitList;
			if (filterRoom.intUnitStatus > 1 || (filterRoom.intUnitStatus != undefined && filterRoom.intUnitStatus != 0)){

				vm.filterUnitList 			=	[];
				angular.forEach(filterUnitList, function(unit){

					if (unit.intUnitStatus == filterRoom.intUnitStatus){
						vm.filterUnitList.push(unit);
					}//end if

				});

			}//end if
			
		}

	});