/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .controller('ctrl.room', function($scope, $filter, $resource, appSettings){

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
        $scope.roomType = {};
        $scope.showBlock = false;
        $scope.updateBlock = false;

        Building.query().$promise.then(function(buildingList){

            $scope.buildingList = buildingList;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);

        });

        RoomType.query().$promise.then(function(data){

            $scope.roomTypeList = data.roomTypeList;
            $scope.roomTypeList = $filter('orderBy')($scope.roomTypeList, 'strRoomTypeName', false);
            console.log($scope.roomTypeList);

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

                    $scope.buildingList[selected.building].floorList[index].roomList = data.roomList;

                });

            }

            selected.floor = index;
            selected.floorId = floorId;

        }

        $scope.createRoom = function(){

            $('#modalCreateRoom').openModal();

        }

        $scope.showBlocks = function(strRoomType){

            if (strRoomType == 'Unit Type'){
                $scope.showBlock = !$scope.showBlock;
                if ($scope.showBlock == false){
                    $scope.newRoom.intMaxBlock = null;
                }
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
                        $('#modalCreateRoom').closeModal();

                    })
                        .catch(function(response){
                            if (response.status == 500){
                                swal('Error!', response.data.message, 'error');
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

    });