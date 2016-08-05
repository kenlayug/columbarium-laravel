/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .controller('ctrl.room', function($scope, $rootScope, $filter, $resource, appSettings){

        $rootScope.roomActive = 'active';
        $rootScope.maintenanceActive    =   'active';

        var rs      =   $rootScope;

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

            $scope.roomList =   $filter('orderBy')(data.roomList, 'strRoomName', false);

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
                    if (roomDetail.strRoomTypeName == 'Unit Type'){
                        $scope.updateBlock = true;
                    }
                });
                rs.loading          =   false;

            });

        }

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
                rs.loading          =   false;

            });

        }

    });