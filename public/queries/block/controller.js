'use strict';

angular.module('app')
	.controller('ctrl.query.block', function($scope, $rootScope, $filter, Building, RoomType, Room, Block){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		vm.intFloorNo 	=	0;

		Building.query().$promise.then(function(data){

			vm.buildingList 			=	$filter('orderBy')(data, 'strBuildingName', false);
			angular.forEach(vm.buildingList, function(building){

				if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

					vm.intFloorNo		=	building.floorNo;

				}

			});

		});

		Room.get().$promise.then(function(data){

			vm.roomList 				=	$filter('orderBy')(data.roomList, 
				['strBuildingName', 'intFloorNo','strRoomName'], false);
			vm.filterRoomList 			=	vm.roomList;

		});

		Block.get().$promise.then(function(data){

			vm.blockList 				=	$filter('orderBy')(data.blockList, ['strBuildingName', 'intFloorNo',
			 'strRoomName', 'intBlockNo'], false);
			vm.filterBlockList 			=	vm.blockList;

		});

		RoomType.get({ id : 'units'}).$promise.then(function(data){

			vm.unitTypeList 			=	$filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

		});

		vm.filterBlocks 		=	function(){

			var filterRoom 		=	vm.blockFilter;
			if (filterRoom.intBuildingId > 0 || (filterRoom.intBuildingId != undefined && filterRoom.intBuildingId != 0)){

				vm.filterRoomList 			=	[];
				vm.filterBlockList 			=	[];
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

			}else{

				vm.intFloorNo 				=	0;
				vm.filterRoomList 			=	vm.roomList;
				vm.filterBlockList 			=	vm.blockList;
				angular.forEach(vm.buildingList, function(building){

					if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

						vm.intFloorNo		=	building.floorNo;

					}

				});

			}

			var filterRoomList 			=	vm.filterRoomList;
			var filterBlockList 		=	vm.filterBlockList;
			if (filterRoom.intFloorNo > 0 || (filterRoom.intFloorNo != undefined && filterRoom.intFloorNo != 0)){

				vm.filterRoomList 			=	[];
				vm.filterBlockList 			=	[];
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

			}

			filterBlockList 			=	vm.filterBlockList;
			if (filterRoom.intRoomId > 0 || (filterRoom.intRoomId != undefined && filterRoom.intRoomId != 0)){

				vm.filterBlockList 			=	[];
				angular.forEach(filterBlockList, function(block){

					if (block.intRoomId == filterRoom.intRoomId){

						vm.filterBlockList.push(block);

					}

				});

			}

			filterBlockList 			=	vm.filterBlockList;
			if (filterRoom.intUnitTypeId > 0 || (filterRoom.intUnitTypeId != undefined && filterRoom.intUnitTypeId != 0)){

				vm.filterBlockList 		=	[];
				angular.forEach(filterBlockList, function(block){

					if (block.intUnitTypeIdFK == filterRoom.intUnitTypeId){

						vm.filterBlockList.push(block);

					}

				});

			}
			
		}

	});