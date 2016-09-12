/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .controller('ctrl.room', function($scope, $rootScope, $filter, $resource, appSettings, Room){

        $rootScope.roomActive = 'active';
        $rootScope.maintenanceActive    =   'active';

        var rs      =   $rootScope;
        var RoomResource        =   Room;

        var Building = $resource(appSettings.baseUrl+'v1/building', {}, {
           query: {
               method: 'GET',
               isArray: true
           }
        });

        var Floor = $resource(appSettings.baseUrl+'v2/buildings/:id/floors', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Room = $resource(appSettings.baseUrl+'v2/floors/:id/rooms', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var RoomType = $resource(appSettings.baseUrl+'v2/roomtypes', {}, {
            query: {
                method: 'GET',
                isArray: false
            },
            save: {
                method: 'POST',
                isArray: false
            }
        });

        var Rooms = $resource(appSettings.baseUrl+'v2/rooms', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            },
            save: {
                method: 'POST',
                isArray: false
            }
        });

        var RoomId = $resource(appSettings.baseUrl+'v2/rooms/:id', {}, {
            get: {
                method: 'GET',
                isArray: false
            },
            update: {
                method: 'PUT',
                isArray: false
            },
            delete: {
                method: 'DELETE',
                isArray: false
            }
        });

        var selected = {};
        $scope.newRoom = {};
        $scope.roomType = {};
        $scope.showBlock = false;
        $scope.updateBlock = false;

        Building.query().$promise.then(function(buildingList){

            $scope.buildingList = buildingList;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);
            rs.displayPage();

        });

        Rooms.query().$promise.then(function(data){

            $scope.roomList =   $filter('orderBy')(data.roomList, ['strBuildingName', 'intFloorNo','strRoomName'], false);

        });

        RoomResource.get({method : 'archive'}).$promise.then(function(data){

            $scope.archiveRoomList          =   $filter('orderBy')(data.roomList, ['strBuildingName', 'intFloorNo', 'strRoomName'], false);

        });

        RoomType.query().$promise.then(function(data){

            $scope.roomTypeList = $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

        });

        $scope.getFloors = function(buildingId, index){

            if ($scope.buildingList[index].floorList == null) {
                rs.loading          =   true;
                Floor.query({id: buildingId}).$promise.then(function(data){
                    $scope.buildingList[index].floorList = data.floorList;
                    rs.loading          =   false;
                });
            }

            selected.building = index;

        }

        $scope.getRooms = function(floorId, index){

            if ($scope.buildingList[selected.building].floorList[index].roomList == null){

                rs.loading          =   true;
                Room.query({id: floorId}).$promise.then(function(data){

                    $scope.buildingList[selected.building].floorList[index].roomList = $filter('orderBy')(data.roomList, 'strRoomName', false);
                    rs.loading          =   false;

                });

            }

            selected.floor = index;
            selected.floorId = floorId;

        }

        $scope.createRoom = function(){

            $('#modalCreateRoom').openModal();

        }

        $scope.unitTypeChecked = 0;
        document.getElementById("maxBlock").disabled = true;
        $scope.showBlocks = function(roomType){

            if (roomType.selected == null || roomType.selected == false){
                if (roomType.boolUnit == 1){
                    $scope.unitTypeChecked++;
                    roomType.selected = true;
                }
            }else{
                if (roomType.boolUnit == 1){
                    alert('Unit type unchecked.');
                    $scope.unitTypeChecked--;
                    roomType.selected = false;
                }
            }
            if ($scope.unitTypeChecked == 0){
                document.getElementById("maxBlock").disabled = true;
            }else{
                document.getElementById("maxBlock").disabled = false;
            }

        }

        $scope.createRoomType = function(){

            rs.loading          =   true;
            RoomType.save($scope.newRoomType).$promise
                .then(function(data){
                    swal({
                        title: "Success!",
                        type: "success",
                        text: data.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    $('#modalRoomType').closeModal();
                    $scope.newRoomType = null;
                    $scope.roomTypeList.push(data.roomType);
                    $scope.roomTypeList = $filter('orderBy')($scope.roomTypeList, 'strRoomTypeName', false);
                    rs.loading          =   false;
                })
                .catch(function(response) {

                    rs.loading          =   false;
                    if (response.status == 500){
                        swal('Error!', 'Something occured.', 'error');
                    }
                });

        }

        $scope.saveNewRoom = function(){

            var roomTypes = $("input[name='roomTypes[]']:checked").map(function() {
                return this.value;
            }).get();
            $scope.newRoom.roomTypeList = roomTypes;
            $scope.newRoom.intFloorId   = selected.floorId;
            rs.loading          =   true;

            Rooms.save($scope.newRoom).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.buildingList[selected.building].floorList[selected.floor].roomList.push(data.room);
                $scope.roomList.push(data.room);
                $scope.roomList =   $filter('orderBy')($scope.roomList, 'strRoomName', false);
                $('#modalCreateRoom').closeModal();

                angular.forEach($scope.roomTypeList, function(roomType){
                    var checkbox = '#'+roomType.intRoomTypeId;
                    $(checkbox).prop('checked', false);
                });

                $scope.newRoom  =   null;
                $scope.unitTypeChecked = 0;
                rs.loading          =   false;

            })
                .catch(function(response){
                    rs.loading          =   false;
                    if (response.status == 500){
                        swal('Error!', response.data.error, 'error');
                    }
                });


        }

        $scope.openUpdate = function(roomId){

            rs.loading          =   true;
            RoomId.get({id: roomId}).$promise.then(function(data){

                $scope.updateUnitTypeChecked      =   0;
                $('#modalUpdateRoom').openModal();
                $scope.updateBlock = false;
                $scope.updateRoom = data.room;
                $scope.updateRoom.intMaxBlock = parseInt($scope.updateRoom.intMaxBlock);
                angular.forEach($scope.roomTypeList, function(roomType){
                    var checkbox = '#update'+roomType.intRoomTypeId;
                    $(checkbox).prop('checked', false);
                });
                angular.forEach(data.room.roomDetails, function(roomDetail){
                    var checkbox = '#update'+roomDetail.intRoomTypeIdFK;
                    $(checkbox).prop('checked', true);
                    if (roomDetail.boolUnit){
                        $scope.updateUnitTypeChecked++;
                    }
                });
                rs.loading          =   false;

            });

        }

        $scope.checkUpdateSelectRoomType         =   function(roomType){

            if (roomType.selected){

                if (roomType.boolUnit){

                    $scope.updateUnitTypeChecked++;

                }//end if

            }//end if
            else {

                if (roomType.boolUnit){

                    $scope.updateUnitTypeChecked--;

                }//end if

            }//end else

        }//end function

        $scope.saveUpdate = function(){

            var roomTypeList = $("input[name='updateRoomTypes[]']:checked").map(function() {
                return this.value;
            }).get();
            rs.loading          =   true;

            $scope.updateRoom.roomTypeList = roomTypeList;

           RoomId.update({id: $scope.updateRoom.intRoomId}, $scope.updateRoom)
               .$promise.then(function(data){

               swal('Success!', data.message, 'success');
               $('#modalUpdateRoom').closeModal();
               angular.forEach($scope.roomList, function(room, index){

                    if (room.intRoomId == data.room.intRoomId){

                        $scope.roomList.splice(index, 1);

                    }//end if

               });

               $scope.roomList.push(data.room);
               $scope.roomList          =   $filter('orderBy')($scope.roomList, ['strBuildingName', 'intFloorNo', 'strRoomName'], false);
               rs.loading          =   false;

           });

        }

        $scope.deleteRoom = function(roomId, index){

            rs.loading          =   true;
            RoomId.delete({id: roomId}).$promise.then(function(data){

                $scope.buildingList[selected.building].floorList[selected.floor].roomList.splice(index, 1);
                angular.forEach($scope.roomList, function(room, index){
                    if (room.intRoomId == roomId){
                        $scope.roomList.splice(index, 1);
                    }
                });
                swal('Success!', data.message, 'success');
                $scope.archiveRoomList.push(data.room);
                $scope.archiveRoomList          =   $filter('orderBy')($scope.archiveRoomList, ['strBuildingName', 'intFloorNo', 'strRoomName'], false);
                rs.loading          =   false;

            });

        }//end function

        $scope.reactivateRoom       =   function(room, index){

            var room            =   new RoomResource({id : room.intRoomId, method : 'reactivate'});
            room.$save(function(data){

                swal('Success!', data.message, 'success');
                $scope.archiveRoomList.splice(index, 1);
                $scope.roomList.push(data.room);
                $scope.roomList             =   $filter('orderBy')($scope.roomList, ['strBuildingName', 'intFloorNo', 'strRoomName'], false);
                angular.forEach($scope.buildingList, function(building){

                    if (building.intBuildingId == data.room.intBuildingId){

                        angular.forEach(building.floorList, function(floor){

                            if (floor.intFloorNo == data.room.intFloorNo){

                                floor.roomList.push(data.room);
                                floor.roomList      =   $filter('orderBy')(floor.roomList, 'strRoomName', false);

                            }//end if

                        });

                    }//end if

                });

            },
                function(response){
                    swal('Error!', response.status, 'error');
                });

        }//end function

    });