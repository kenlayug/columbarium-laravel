'use strict';
angular.module('app')
	.controller('ctrl.query.room', function($scope, $rootScope, $filter, Room, RoomType, Building){

		var vm				=	$scope;
		var rs 				=	$rootScope;

		vm.intFloorNo		=	0;
		vm.roomFilter 		=	{};
		vm.roomTypeAll 		=	{
			selected 	: 	true
		};

		Room.get().$promise.then(function(data){

			vm.roomList 			=	$filter('orderBy')(data.roomList, ['strBuildingName', 'intFloorNo', 'strRoomName'], false);
			vm.filterRoomList 		=	vm.roomList;

		});

		RoomType.get().$promise.then(function(data){

			angular.forEach(data.roomTypeList, function(roomType){

				roomType.selected 		=	true;

			});
			vm.roomTypeList 		=	$filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

		});

		Building.query().$promise.then(function(data){

			vm.buildingList 		=	 $filter('orderBy')(data, 'strBuildingName', false);
			angular.forEach(vm.buildingList, function(building){

				if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

					vm.intFloorNo		=	building.floorNo;

				}

			});

		});

		vm.filterRooms 		=	function(){

			var filterRoom 		=	vm.roomFilter;
			if (filterRoom.intBuildingId > 0 || filterRoom.intBuildingId != undefined){

				vm.filterRoomList 			=	[];
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

			}else{

				vm.intFloorNo 				=	0;
				vm.filterRoomList 			=	vm.roomList;
				angular.forEach(vm.buildingList, function(building){

					if (vm.intFloorNo == 0 || vm.intFloorNo < building.floorNo){

						vm.intFloorNo		=	building.floorNo;

					}

				});

			}

			var filterRoomList 			=	vm.filterRoomList;
			if (filterRoom.intFloorNo > 0 || (filterRoom.intFloorNo != undefined && filterRoom.intFloorNo != 0)){

				vm.filterRoomList 			=	[];
				angular.forEach(filterRoomList, function(room){

					if (room.intFloorNo == filterRoom.intFloorNo){

						vm.filterRoomList.push(room);

					}

				});

			}

			filterRoomList 			=	vm.filterRoomList;
			vm.filterRoomList		=	[];
			angular.forEach(filterRoomList, function(room){

				vm.roomTypeAll.selected 		=	true;
				angular.forEach(vm.roomTypeList, function(roomType){

					if (roomType.selected){

						angular.forEach(room.roomDetails, function(roomDetail){

							if (roomDetail.intRoomTypeId == roomType.intRoomTypeId){

								var boolExist		=	false;
								angular.forEach(vm.filterRoomList, function(filteredRoom){

									if (filteredRoom.intRoomId == room.intRoomId){

										boolExist	=	true;

									}

								});
								if (!boolExist){
									vm.filterRoomList.push(room);
								}

							}

						});

					}else{
						vm.roomTypeAll.selected 	=	false;
					}

				});

			});
			
		}

		vm.toggleAll 					=	function(selected){

			angular.forEach(vm.roomTypeList, function(roomType){

				roomType.selected 			=	selected

			});

			vm.filterRooms();


		}

	});