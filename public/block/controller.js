/**
 * Created by kenlayug on 6/22/16.
 */
angular.module('app')
    .controller('ctrl.block', function($scope, $rootScope, $resource, $filter, appSettings){

        $rootScope.blockActive  =   'active';
        $rootScope.maintenanceActive  =   'active';

        var Buildings = $resource(appSettings.baseUrl+'v1/building', {}, {
            query: {
                method: 'GET',
                isArray: true
            }
        });

        var Floors = $resource(appSettings.baseUrl+'v2/buildings/:id/floors/rooms', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Rooms = $resource(appSettings.baseUrl+'v2/floors/:id/rooms/unit-type', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var RoomTypes    =   $resource(appSettings.baseUrl+'v2/rooms/:id/roomtypes/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Blocks = $resource(appSettings.baseUrl+'v2/rooms/:id/blocks', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Block = $resource(appSettings.baseUrl+'v2/blocks', {}, {
            save: {
                method: 'POST',
                isArray: false
            }
        });

        var BlockId = $resource(appSettings.baseUrl+'v2/blocks/:id', {}, {
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

        var Units = $resource(appSettings.baseUrl+'v2/blocks/:id/units', {}, {
            get: {
                method: 'GET',
                isArray: false
            }
        });

        var Unit = $resource(appSettings.baseUrl+'v2/units/:id', {}, {
            get: {
                method: 'GET',
                isArray: false
            },
            delete: {
                method: 'DELETE',
                isArray: false
            },
            enable: {
                method: 'PUT',
                isArray: false
            }
        });

        var selected = {};
        $scope.newRoom = {};

        Buildings.query().$promise.then(function(data){

            $scope.buildingList = data;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);

        });

        $scope.getFloors = function(buildingId, index){

            if ($scope.buildingList[index].floorList == null){

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                Floors.query({id: buildingId}).$promise.then(function(data){

                    $scope.buildingList[index].floorList = data.floorList;
                    swal.close();

                });

            }
            selected.building = index;

        }

        $scope.getRooms = function(floorId, index){

            if ($scope.buildingList[selected.building].floorList[index].roomList == null){

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                Rooms.query({id: floorId}).$promise.then(function(data){

                    $scope.buildingList[selected.building].floorList[index].roomList = data.roomList;
                    swal.close();

                });

            }

            selected.floor = index;
            selected.floorId = floorId;

        }

        $scope.getBlocks = function(roomId, index){

            if ($scope.buildingList[selected.building].floorList[selected.floor].roomList[index].blockList == null){

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                Blocks.query({id: roomId}).$promise.then(function(data){

                    $scope.buildingList[selected.building].floorList[selected.floor].roomList[index].blockList = data.blockList;
                    swal.close();

                });

            }
            selected.room = index;
            selected.roomId = roomId;

        }

        $scope.openCreate = function(roomId){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            RoomTypes.query({id: roomId}).$promise.then(function(data){

                $scope.roomTypeList =   $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);
                $('#modalCreateBlock').openModal();
                swal.close();

            });

        }

        $scope.createBlock = function(){

            $scope.newBlock.intRoomId = selected.roomId;
            $scope.newBlock.intFloorId = selected.floorId;
            if ($scope.newBlock.strBlockName == undefined){
                swal('Error!', 'Required fields cannot be blank.', 'error');
            }
            swal({
                    title: "Create Block",
                    text: "Are you sure to create this block?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, create it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                    Block.save($scope.newBlock).$promise.then(function(data){

                        $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.push(data.block);
                        $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList =
                            $filter('orderBy')($scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList, 'strBlockName', false);
                        swal('Success!', data.message, 'success');
                        $('#modalCreateBlock').closeModal();

                    })
                        .catch(function(response){

                            if (response.status == 500){

                                swal('Error!', response.data.message, 'error');

                            }

                        });

                });

        }

        $scope.updateBlock = function(blockId, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            BlockId.get({id: blockId}).$promise.then(function(data){

                $scope.updateBlock = data.block;
                $scope.updateBlock.intBlockId = blockId;
                $('#modalUpdateBlock').openModal();
                selected.block = index;
                swal.close();

            });

        }

        $scope.saveUpdate = function(){

            swal({
                    title: "Update Block",
                    text: "Are you sure to update this block?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, update it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                    BlockId.update({id: $scope.updateBlock.intBlockId}, $scope.updateBlock).$promise.then(function(data){

                        $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.splice(selected.block, 1);
                        $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.push(data.block);
                        $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList =
                            $filter('orderBy')($scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList,
                                'strBlockName', false);

                        swal('Success!', data.message, 'success');
                        $('#modalUpdateBlock').closeModal();

                    })
                        .catch(function(response){

                            if (response.status == 500){
                                swal('Error!', response.data.message, 'error');
                            }

                        });

                });

        }

        $scope.deleteBlock = function(blockId, index){

            swal({
                    title: "Deactivate Block",
                    text: "Are you sure to deactivate this block?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, deactivate it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                    console.log(blockId);
                    BlockId.delete({id: blockId}).$promise.then(function(data){

                        $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.splice(index, 1);
                        swal('Success!', data.message, 'success');

                    });

                });

        }

        $scope.getUnits = function(blockId){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            Units.get({id: blockId}).$promise.then(function(data){

                var unitTable = [];
                var intLevelNoPrev = 0;
                var intLevelNoCurrent = 0;
                var unitList = [];
                var levelLetter =   parseInt(64);
                angular.forEach(data.unitList, function(unit, index){

                    if (unit.intUnitStatus > 0){
                        unit.color = 'green';
                    }else{
                        unit.color = 'red';
                    }
                    unit.levelLetter = String.fromCharCode(levelLetter + parseInt(unit.intLevelNo));
                    intLevelNoCurrent = unit.intLevelNo;
                    if (intLevelNoPrev != intLevelNoCurrent){
                        if (index != 0) {
                            unitTable.push(unitList);
                            unitList = [];
                        }
                        intLevelNoPrev = unit.intLevelNo;
                    }

                    unitList.push(unit);
                    if (index == data.unitList.length-1){
                        unitTable.push(unitList);
                    }

                });
                $scope.unitList = unitTable;
                $scope.block = data.block;
                swal.close();

            });

        }

        $scope.openUnit = function(unitId){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            Unit.get({id: unitId}).$promise.then(function(data){

                $scope.unit = data.unit;
                if (data.unit.intUnitStatus == 0){
                    $scope.unit.strUnitStatus = 'Deactivated';
                }else if(data.unit.intUnitStatus == 1){
                    $scope.unit.strUnitStatus = 'Active';
                }
                $('#modalUnit').openModal();
                swal.close();

            });

        }

        $scope.deactivateUnit = function(unitId){

            swal({
                    title: "Deactivate Unit",
                    text: "Are you sure to deactivate this unit?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, deactivate it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                    Unit.delete({id: unitId}).$promise.then(function(data){

                        swal('Success!', data.message, 'success');
                        $('#modalUnit').closeModal();
                        angular.forEach($scope.unitList, function(unitLevel){
                            angular.forEach(unitLevel, function(unit){
                                if (unit.intUnitId == data.unit.intUnitId){
                                    unit.color = 'red';
                                }
                            });
                        });

                    });

                });

        }

        $scope.activateUnit = function(unitId){

            swal({
                    title: "Activate Unit",
                    text: "Are you sure to activate this unit?",
                    type: "warning",   showCancelButton: true,
                    confirmButtonColor: "#ffa500",
                    confirmButtonText: "Yes, activate it!",
                    cancelButtonText: "No, cancel pls!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true },
                function(){

                    Unit.enable({id: unitId}, null).$promise.then(function(data){

                        swal('Success!', data.message, 'success');
                        $('#modalUnit').closeModal();
                        angular.forEach($scope.unitList, function(unitLevel){
                            angular.forEach(unitLevel, function(unit){
                                if (unit.intUnitId == data.unit.intUnitId){
                                    unit.color = 'green';
                                }
                            });
                        });

                    });

                });

        }

    });