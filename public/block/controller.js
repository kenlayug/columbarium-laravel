/**
 * Created by kenlayug on 6/22/16.
 */
angular.module('app')
    .controller('ctrl.block', function($scope, $rootScope, $resource, $filter, appSettings, Block){

        $rootScope.blockActive  =   'active';
        $rootScope.maintenanceActive  =   'active';

        var BlockResource           =   Block;

        var rs = $rootScope;

        var color           =   [
            'orange darken-1',
            'green darken-3',
            'blue darken-3',
            'red darken-3',
            'yellow darken-2',
            'blue darken-3',
            'red accent-1',
            'yellow darken-2'
            ];

        var blockSelected       =   null;

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
            rs.displayPage();

        });

        BlockResource.get().$promise.then(function(data){

            $scope.blockList            =   $filter('orderBy')(data.blockList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);

        });

        BlockResource.get({type : 'archive'}).$promise.then(function(data){

            $scope.archiveBlockList         =   $filter('orderBy')(data.blockList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);

        });

        $scope.getFloors = function(buildingId, index){

            if ($scope.buildingList[index].floorList == null){

                rs.loading          =   true;
                Floors.query({id: buildingId}).$promise.then(function(data){

                    $scope.buildingList[index].floorList = data.floorList;
                    rs.loading          =   false;

                });

            }
            selected.building = index;

        }

        $scope.getRooms = function(floorId, index){

            if ($scope.buildingList[selected.building].floorList[index].roomList == null){

                rs.loading          =   true;
                Rooms.query({id: floorId}).$promise.then(function(data){

                    $scope.buildingList[selected.building].floorList[index].roomList = $filter('orderBy')
                        (data.roomList, 'strRoomName', false);
                    rs.loading          =   false;

                });

            }

            selected.floor = index;
            selected.floorId = floorId;

        }

        $scope.getBlocks = function(roomId, index){

            if ($scope.buildingList[selected.building].floorList[selected.floor].roomList[index].blockList == null){

                rs.loading          =   true;
                Blocks.query({id: roomId}).$promise.then(function(data){

                    angular.forEach(data.blockList, function(block){

                        block.color     =   'orange';

                    });

                    $scope.buildingList[selected.building].floorList[selected.floor].roomList[index].blockList = data.blockList;
                    rs.loading          =   false;

                });

            }
            selected.room = index;
            selected.roomId = roomId;

        }

        $scope.openCreate = function(roomId){

            rs.loading          =   true;
            RoomTypes.query({id: roomId}).$promise.then(function(data){

                $scope.roomTypeList =   $filter('orderBy')(data.roomTypeList, 'strUnitTypeName', false);
                console.log($scope.roomTypeList);
                $('#modalCreateBlock').openModal();
                $scope.newBlock     =   null;
                rs.loading          =   false;

            });

        }

        $scope.createBlock = function(){

            $scope.newBlock.intRoomId = selected.roomId;
            $scope.newBlock.intFloorId = selected.floorId;
            if ($scope.newBlock.intColumnNo == undefined || $scope.newBlock.intLevelNo == undefined){
                swal('Error!', 'Required fields cannot be blank.', 'error');
            }else {

                rs.loading          =   true;
                console.log($scope.newBlock);
                Block.save($scope.newBlock).$promise.then(function (data) {

                    data.block.color = 'orange';

                    $scope.blockList.push(data.block);
                    $scope.blockList                =   $filter('orderBy')($scope.blockList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);

                    $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.push(data.block);
                    $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList =
                        $filter('orderBy')($scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList, 'strBlockName', false);
                    swal('Success!', data.message, 'success');
                    $('#modalCreateBlock').closeModal();
                    rs.loading          =   false;
                    $scope.newBlock     =   null;

                })
                    .catch(function (response) {

                        rs.loading          =   false;
                        if (response.status == 500) {

                            swal('Error!', response.data.error, 'error');

                        }

                    });
            }

        }

        $scope.updateBlock = function(blockId, index){

            rs.loading          =   true;
            BlockId.get({id: blockId}).$promise.then(function(data){

                $scope.updateBlock = data.block;
                $scope.updateBlock.intBlockId = blockId;
                $('#modalUpdateBlock').openModal();
                selected.block = index;
                rs.loading          =   false;

            });

        }

        $scope.saveUpdate = function(){

            rs.loading          =   true;
            BlockId.update({id: $scope.updateBlock.intBlockId}, $scope.updateBlock).$promise.then(function(data){

                $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.splice(selected.block, 1);
                $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.push(data.block);
                $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList =
                    $filter('orderBy')($scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList,
                        'strBlockName', false);

                swal('Success!', data.message, 'success');
                $('#modalUpdateBlock').closeModal();
                rs.loading          =   false;

            })
                .catch(function(response){

                    rs.loading          =   false;
                    if (response.status == 500){
                        swal('Error!', response.data.message, 'error');
                    }

                });

        }

        $scope.deleteBlock = function(blockId, index){

            rs.loading          =   true;
            BlockId.delete({id: blockId}).$promise.then(function(data){

                $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList.splice(index, 1);
                swal('Success!', data.message, 'success');
                angular.forEach($scope.blockList, function(block, index){

                    if (block.intBlockId == blockId){

                        $scope.blockList.splice(index, 1);

                    }//end if

                });
                $scope.archiveBlockList.push(data.block);
                $scope.archiveBlockList         =   $filter('orderBy')($scope.archiveBlockList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);
                rs.loading          =   false;

            });

        }

        $scope.getUnits = function(blockId, index){

            rs.loading          =   true;
            if (blockSelected != null){

                $scope.buildingList[blockSelected.building].floorList[blockSelected.floor].roomList[blockSelected.room].blockList[blockSelected.block].color = 'orange';
                blockSelected   =   null;

            }

            Units.get({id: blockId}).$promise.then(function(data){

                var unitTable = [];
                var intLevelNoPrev = 0;
                var intLevelNoCurrent = 0;
                var unitList = [];
                var levelLetter =   parseInt(64);
                angular.forEach(data.unitList, function(unit, index){

                    unit.color      =   color[unit.intUnitStatus];
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
                $scope.block.display            =   data.block.strBuildingCode+'-'+data.block.intFloorNo+'-'+data.block.strRoomName+'-Block No. '+data.block.intBlockNo;

                $scope.buildingList[selected.building].floorList[selected.floor].roomList[selected.room].blockList[index].color = 'orange darken-3';
                blockSelected               =   {};
                blockSelected.building      =   selected.building;
                blockSelected.floor         =   selected.floor;
                blockSelected.room          =   selected.room;
                blockSelected.block         =   index;
                rs.loading          =   false;


            });


        }

        $scope.openUnit = function(unitId){

            rs.loading          =   true;
            Unit.get({id: unitId}).$promise.then(function(data){

                $scope.unit = data.unit;
                if (data.unit.intUnitStatus == 0){
                    $scope.unit.strUnitStatus = 'Deactivated';
                }else if(data.unit.intUnitStatus == 1){
                    $scope.unit.strUnitStatus = 'Active';
                }
                $('#modalUnit').openModal();
                rs.loading          =   false;

            });

        }

        $scope.deactivateUnit = function(unitId){

            rs.loading          =   true;
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
                rs.loading          =   false;

            })
                .catch(function(response){

                    swal('Error!', response.data.message, 'error');

                });

        }

        $scope.activateUnit = function(unitId){

            rs.loading          =   true;
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
                rs.loading          =   false;

            });

        }

        $scope.closeBlockView       =   function(){

            $scope.unitList     =   null;
            $scope.block        =   null;
            $scope.buildingList[blockSelected.building].floorList[blockSelected.floor].roomList[blockSelected.room].blockList[blockSelected.block].color = 'orange';
            blockSelected   =   null;

        }//end function

        $scope.reactivateBlock      =   function(block, index){

            var block           =   new BlockResource({id : block.intBlockId, method : 'reactivate'});
            block.$save(function(data){

                angular.forEach($scope.buildingList, function(building){

                    if (building.intBuildingId == data.block.intBuildingId){

                        angular.forEach(building.floorList, function(floor){

                            if (floor.intFloorId == data.block.intFloorId){

                                angular.forEach(floor.roomList, function(room){

                                    if (room.intRoomId == data.block.intRoomId){

                                        data.block.color            =   'orange';
                                        room.blockList.push(data.block);
                                        room.blockList      =   $filter('orderBy')(room.blockList, 'intBlockNo', false);

                                    }//end if

                                });

                            }//end if

                        });

                    }//end if

                });

                swal('Success!', data.message, 'success');
                $scope.archiveBlockList.splice(index, 1);
                $scope.blockList.push(data.block);
                $scope.blockList            =   $filter('orderBy')($scope.blockList, ['strBuildingName', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);

            });

        }//end function

    });