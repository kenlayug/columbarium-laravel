/**
 * Created by kenlayug on 6/14/16.
 */
angular.module('app')
    .controller('ctrl.buy-unit', function($scope, $resource, appSettings, $filter, $http){

        $scope.selected = {};

        var Buildings = $resource(appSettings.baseUrl+'building', {}, {
           query : {method: 'GET', isArray: true}
        });

        var BuildingFloor = $resource(appSettings.baseUrl+'building/:id/floorBlock', {}, {
           query : {method: 'GET', isArray: true}
        });

        var FloorGet = $resource(appSettings.baseUrl+'floor/:id/block', {}, {
           query: {method: 'GET', isArray: true}
        });

        var UnitGet = $resource(appSettings.baseUrl+'unit/:id/show', {}, {
           get: {method: 'GET', isArray: false}
        });

        Buildings.query().$promise.then(function(buildings){

            $scope.buildings = buildings;
            $scope.buildings = $filter('orderBy')($scope.buildings, 'strBuildingName', false);

        });

        $scope.getFloors = function(buildingId, index){

            $scope.selected.buildingIndex = index;
            if ($scope.buildings[index].floors == null){
                $scope.buildings[index].floors = BuildingFloor.query({id : buildingId});
            }

        };

        $scope.getBlocks = function(floorId, index){

            $scope.selected.floorIndex = index;
            if ($scope.buildings[$scope.selected.buildingIndex].floors[index].blocks == null){
                $scope.buildings[$scope.selected.buildingIndex].floors[index].blocks = FloorGet.query({id: floorId});
            }

        };

        $scope.getUnits = function(blockId, index){

            $scope.selected.blockIndex = index;
            if ($scope.buildings[$scope.selected.buildingIndex].floors[$scope.selected.floorIndex].blocks[index].units == null){
                $http.get('api/v1/block/'+blockId+'/unit')
                    .success(function(dataUnit){
                        $http.get('api/v1/block/'+blockId+'/unitcategory')
                            .success(function(dataUnitcategory){
                                var intColumnNo = dataUnit.length/dataUnitcategory;
                                var unitTable = [];
                                var intUnitCtr = 0;
                                for(var intLevelCtr = 0; intLevelCtr < dataUnitcategory; intLevelCtr++){
                                    var unitLevel = [];
                                    for(var intCtr = 0; intCtr < intColumnNo; intCtr++, intUnitCtr++){
                                        var unit = dataUnit[intUnitCtr];
                                        if (dataUnit[intUnitCtr].intUnitStatus > 0){
                                            unit.unitColor = 'green';
                                        }else{
                                            unit.unitColor = 'red';
                                        }
                                        unitLevel.push(unit);
                                    }
                                    unitTable.push(unitLevel);
                                }
                                $scope.units = unitTable;
                            })
                            .error(function(data){
                                swal("Error!", "Something occured.", "error");
                            });
                    })
                    .error(function(data){
                        swal("Error!", "Something occured.", "error");
                    });
            }
            console.log($scope.buildings[$scope.selected.buildingIndex].floors[$scope.selected.floorIndex].blocks[index]);

        }

        $scope.openUnit = function(unitId){

            $('#modalUnit').openModal();
            $scope.unit = UnitGet.get({id: unitId});
            console.log($scope.unit);

        };

    });