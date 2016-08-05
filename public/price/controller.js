'use strict';

angular.module('app')
    .controller('ctrl.price', function($scope, $rootScope, $resource, appSettings, $filter){

        $rootScope.priceActive = 'active';
        $rootScope.maintenanceActive    =   'active';
        var selected = {};
        var rs          =   $rootScope;

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

        var UnitCategoryPriceUpdate =   $resource(appSettings.baseUrl+'v2/unit-categories', {});

        Buildings.query().$promise.then(function(buildingList){

            $scope.buildingList = buildingList;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);
            rs.displayPage();

        });

        $scope.getFloors = function(buildingId, index){

            if ($scope.buildingList[index].floorList == null){

                rs.loading          =   true;
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
                    rs.loading          =   false;

                });

            }
            selected.building = index;

        }

        $scope.openPrice = function(floorId, floorNo, intUnitType, unitType){

            rs.loading          =   true;
            selected.floorNo = floorNo;
            $scope.floorNo  =   floorNo;
            $scope.unitType =   unitType;
            UnitCategories.query({
                floorId:        floorId,
                unitTypeId:     intUnitType
            }).$promise.then(function(data){

                $scope.unitCategoryList = data.unitCategoryList;
                console.log($scope.unitCategoryList);

                var levelLetter =   64;
                angular.forEach($scope.unitCategoryList, function(unitCategory){

                    if (unitCategory.deciPrice == null){
                        unitCategory.color  = 'red';
                    }else{
                        unitCategory.color  = 'green';
                    }
                    unitCategory.display    =   String.fromCharCode(parseInt(levelLetter)+parseInt(unitCategory.intLevelNo));

                });
                rs.loading          =   false;

            });

        }

        $scope.savePrice = function(){

            rs.loading          =   true;
            var unitCategoryPrice   =   new UnitCategoryPriceUpdate({ unitCategoryList : $scope.unitCategoryList});
            unitCategoryPrice.$save(function(data){

                swal('Success!', data.message, 'success');
                rs.loading          =   false;

            });

        }

        $scope.closePrice   =   function(){

            $scope.unitCategoryList =   null;
            $scope.floorNo          =   null;

        }

    });