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

        $scope.openPrice = function(floorId, floorNo, intUnitType){

            selected.floorNo = floorNo;
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

        $scope.setPrice = function(unitCategoryId, intLevelNo, index){

            UnitCategoryPrices.get({id: unitCategoryId})
                .$promise
                .then(function(data){

                    var deciPrevPrice = 0;
                    if (data.unitCategoryPrice != null){
                        deciPrevPrice = data.unitCategoryPrice.deciPrice;
                    }

                    swal({   title: "Configure Price",
                            text: "Enter the desired price for Level "+intLevelNo+":",
                            type: "input",   showCancelButton: true,
                            closeOnConfirm: false,
                            confirmButtonColor: "#ffa500",
                            confirmButtonText: "Save Price",
                            animation: "slide-from-top",
                            inputType: "number",
                            inputPlaceholder: "Prev. Price: P"+parseInt(deciPrevPrice),
                            showLoaderOnConfirm: true, },
                        function(inputValue){
                            if (inputValue === false) return false;
                            if (inputValue === "") {
                                swal.showInputError("Price cannot be null!");
                                return false;
                            }
                            if (inputValue < 1){
                                swal.showInputError("Price should be more than 0.");
                                return false;
                            }
                            if (inputValue > 999999){
                                swal.showInputError("Price can't be over 999,999.");
                                return false;
                            }
                            UnitCategoryPrices.update({id: unitCategoryId},
                                {
                                    deciPrice : inputValue
                                }
                            ).$promise.then(function(data){

                                swal('Success!', data.message, 'success');
                                $scope.unitCategoryList[index].color = 'green';

                            });

                        });

                });

        }

    });