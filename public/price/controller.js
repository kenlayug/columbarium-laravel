'use strict';

angular.module('app')
    .controller('ctrl.price', function($scope, $resource, appSettings, $filter){

        var selected = {};

        var Buildings = $resource(appSettings.baseUrl+'v1/building', {}, {
            query: {
                method: 'GET',
                isArray: true
            }
        });

        var Floors = $resource(appSettings.baseUrl+'v2/buildings/:id/floors/blocks', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var UnitCategories = $resource(appSettings.baseUrl+'v2/floors/:floorId/unit-categories/:unitTypeId', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var UnitCategoryPrices = $resource(appSettings.baseUrl+'v2/unit-categories/:id', {}, {
            get: {
                method: 'GET',
                isArray: false
            },
            update: {
                method: 'PUT',
                isArray: false
            }
        });

        Buildings.query().$promise.then(function(buildingList){

            $scope.buildingList = buildingList;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);

        });

        $scope.getFloors = function(buildingId, index){

            if ($scope.buildingList[index].floorList == null){

                Floors.query({id: buildingId}).$promise.then(function(data){

                    angular.forEach(data.floorList, function(floor){

                        angular.forEach(floor.unitType, function(unit){

                            if (unit.intUnitType == 1){
                                floor.columbary = true;
                            }else{
                                floor.fullBody = true;
                            }

                        });

                    });

                    $scope.buildingList[index].floorList = data.floorList;

                });

            }
            selected.building = index;

        }

        $scope.openPrice = function(floorId, floorNo, intUnitType, unitType){

            selected.floorNo = floorNo;
            $scope.floorNo  =   floorNo;
            $scope.unitType =   unitType;
            UnitCategories.query({
                floorId:        floorId,
                unitTypeId:     intUnitType
            }).$promise.then(function(data){

                $scope.unitCategoryList = data.unitCategoryList;
                angular.forEach($scope.unitCategoryList, function(unitCategory){

                    if (unitCategory.deciPrice == null){
                        unitCategory.color = 'red';
                    }else{
                        unitCategory.color = 'green';
                    }

                });

            });

        }

        $scope.saveButton   =   false;
        $scope.savePrice = function(unitCategoryId, intLevelNo, price, index){

            $scope.saveButton   =   true;
            UnitCategoryPrices.update({id: unitCategoryId},
                {
                    deciPrice : price
                }
            ).$promise.then(function(data){

                $scope.saveButton   =   false;
                swal('Success!', data.message, 'success');
                $scope.unitCategoryList[index].deciPrice    =   data.unitCategory.deciPrice;
                $scope.unitCategoryList[index].color        =   'green';

            });

        }

        $scope.closePrice   =   function(){

            $scope.unitCategoryList =   null;
            $scope.floorNo          =   null;

        }

    });