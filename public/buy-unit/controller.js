/**
 * Created by kenlayug on 6/14/16.
 */
angular.module('app')
    .controller('ctrl.buy-unit', function($scope, $resource, appSettings, $filter, $http){

        $scope.selected = {};

        var Buildings = $resource(appSettings.baseUrl+'v1/building', {}, {
           query : {method: 'GET', isArray: true}
        });

        var Floors = $resource(appSettings.baseUrl+'v2/buildings/:id/floors', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Rooms = $resource(appSettings.baseUrl+'v2/floors/:id/rooms', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Blocks = $resource(appSettings.baseUrl+'v2/rooms/:id/blocks', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Units = $resource(appSettings.baseUrl+'v2/blocks/:id/units', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Unit = $resource(appSettings.baseUrl+'v2/units/:id/info', {}, {
            get: {
                method: 'GET',
                isArray: false
            }
        });

        Buildings.query().$promise.then(function(buildings){

            $scope.buildingList = buildings;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);

        });

        $scope.getFloors = function(buildingId, index){

            $scope.selected.buildingIndex = index;
            if ($scope.buildingList[index].floorList == null){
                Floors.query({id : buildingId}).$promise.then(function(data){

                    $scope.buildingList[index].floorList = data.floorList;

                });
            }

        };

        $scope.getRooms = function(floorId, index){

            $scope.selected.floorIndex = index;
            if ($scope.buildingList[$scope.selected.buildingIndex].floorList[index].roomList == null){
                Rooms.query({id: floorId}).$promise.then(function(data){

                    $scope.buildingList[$scope.selected.buildingIndex].floorList[index].roomList = data.roomList;

                });
            }

        };

        $scope.getBlocks = function(roomId, index){

            $scope.selected.roomIndex = index;
            if ($scope.buildingList[$scope.selected.buildingIndex].floorList[$scope.selected.floorIndex]
                    .roomList[index].blockList == null){

                Blocks.query({id: roomId}).$promise.then(function(data){

                    $scope.buildingList[$scope.selected.buildingIndex].floorList[$scope.selected.floorIndex]
                        .roomList[index].blockList = data.blockList;

                });

            }

        }

        $scope.getUnits = function(blockId){

            Units.get({id: blockId}).$promise.then(function(data){

                var unitTable = [];
                var intLevelNoPrev = 0;
                var intLevelNoCurrent = 0;
                var unitList = [];
                angular.forEach(data.unitList, function(unit, index){

                    if (unit.intUnitStatus > 0){
                        unit.color = 'green';
                    }else{
                        unit.color = 'red';
                    }
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

            });

        }

        $scope.openUnit = function(unitId){

            Unit.get({id: unitId}).$promise.then(function(data){

                $('#modalUnit').openModal();
                $scope.unit = data.unit;
                if (data.unit.intUnitStatus  == 1){
                    $scope.unit.strUnitStatus = 'Available';
                }else if(data.unit.intUnitStatus == 2){
                    $scope.unit.strUnitStatus = 'Reserved';
                }else if(data.unit.intUnitStatus == 3){
                    $scope.unit.strUnitStatus = 'Owned';
                }else if(data.unit.intUnitStatus == 0){
                    $scope.unit.strUnitStatus = 'Deactivated';
                }

            });

        };

    });