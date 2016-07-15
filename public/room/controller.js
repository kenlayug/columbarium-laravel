/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .controller('ctrl.room', function($scope, $rootScope, $filter, $resource, appSettings){

        $rootScope.roomActive = 'active';

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

        });

        Rooms.query().$promise.then(function(data){

            $scope.roomList =   $filter('orderBy')(data.roomList, 'strRoomName', false);

        });

        RoomType.query().$promise.then(function(data){

            $scope.roomTypeList = $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

        });

        $scope.getFloors = function(buildingId, index){

            if ($scope.buildingList[index].floorList == null) {
                Floor.query({id: buildingId}).$promise.then(function(data){
                    $scope.buildingList[index].floorList = data.floorList;
                });
            }

            selected.building = index;

        }

        $scope.getRooms = function(floorId, index){

            if ($scope.buildingList[selected.building].floorList[index].roomList == null){

                Room.query({id: floorId}).$promise.then(function(data){

                    $scope.buildingList[selected.building].floorList[index].roomList = $filter('orderBy')(data.roomList, 'strRoomName', false);

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

            swal({
                    title: "Create Room Type",
                    text: "Are you sure to create this room type?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, create it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

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
                        })
                        .catch(function(response) {
                            if (response.status == 500){
                                swal('Error!', 'Something occured.', 'error');
                            }
                        });
                    });

        }

        $scope.saveNewRoom = function(){

            var roomTypes = $("input[name='roomTypes[]']:checked").map(function() {
                return this.value;
            }).get();
            $scope.newRoom.roomTypeList = roomTypes;
            $scope.newRoom.intFloorId   = selected.floorId;
            console.log($scope.newRoom.strRoomName);

            swal({
                    title: "Create Room",
                    text: "Are you sure to create this room?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, create it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

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

                    })
                        .catch(function(response){
                            if (response.status == 500){
                                swal('Error!', response.data.error, 'error');
                            }
                        });

                });

        }

        $scope.openUpdate = function(roomId){

            $('#modalUpdateRoom').openModal();
            RoomId.get({id: roomId}).$promise.then(function(data){

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

            });

        }

        $scope.saveUpdate = function(){

            var roomTypeList = $("input[name='updateRoomTypes[]']:checked").map(function() {
                return this.value;
            }).get();

            $scope.updateRoom.roomTypeList = roomTypeList;
            
            swal({
                    title: "Update Room",
                    text: "Are you sure to update this room?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                   RoomId.update({id: $scope.updateRoom.intRoomId}, $scope.updateRoom)
                       .$promise.then(function(data){

                       swal('Success!', data.message, 'success');
                       $('#modalUpdateRoom').closeModal();

                   });

                });

        }

        $scope.deleteRoom = function(roomId, index){

            swal({
                    title: "Deactivate Room",
                    text: "Are you sure to deactivate this room?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, deactivate it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                    RoomId.delete({id: roomId}).$promise.then(function(data){

                        $scope.buildingList[selected.building].floorList[selected.floor].roomList.splice(index, 1);
                        angular.forEach($scope.roomList, function(room, index){
                            if (room.intRoomId == roomId){
                                $scope.roomList.splice(index, 1);
                            }
                        });
                        swal('Success!', data.message, 'success');

                    });

                });

        }

    });