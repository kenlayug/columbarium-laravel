/**
 * Created by kenlayug on 6/14/16.
 */
angular.module('app')
    .controller('ctrl.buy-unit', function($scope, $resource, appSettings, $filter, $http){

        $scope.selected = {};
        $scope.reservationCart = [];
        $scope.reservation = {};

        var Buildings = $resource(appSettings.baseUrl+'v1/building', {}, {
           query : {method: 'GET', isArray: true}
        });

        var Floors = $resource(appSettings.baseUrl+'v2/buildings/:id/floors/rooms', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Rooms = $resource(appSettings.baseUrl+'v2/floors/:id/rooms/blocks', {}, {
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

        var Customers = $resource(appSettings.baseUrl+'v1/customer', {}, {
            query: {
                method: 'GET',
                isArray: true
            }
        });

        var Interests = $resource(appSettings.baseUrl+'v2/interests/normal', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var InterestAtNeeds = $resource(appSettings.baseUrl+'v2/interests/at-need', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Reservations = $resource(appSettings.baseUrl+'v2/reservations', {}, {
            save: {
                method: 'POST',
                isArray: false
            }
        });

        Buildings.query().$promise.then(function(buildings){

            $scope.buildingList = buildings;
            $scope.buildingList = $filter('orderBy')($scope.buildingList, 'strBuildingName', false);

        });

        Customers.query().$promise.then(function(customers){

            $scope.customerList = customers;
            $scope.customerList = $filter('orderBy')($scope.customerList, 'strFullName', false);

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

                    angular.forEach(data.blockList, function(block){

                        if (block.intUnitType == 1){
                            block.icon = 'view_quilt';
                        }else{
                            block.icon = 'dashboard';
                        }

                    });

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

                    if (unit.intUnitStatus == 1){
                        unit.color = 'green';
                    }else if(unit.intUnitStatus == 0){
                        unit.color = 'orange';
                    }else if(unit.intUnitStatus == 2){
                        unit.color = 'blue';
                    }else if(unit.intUnitStatus == 3){
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

                if (data.block.intUnitType == 1){
                    data.block.strUnitType = 'Columbary Vaults';
                    data.block.icon = 'view_quilt';
                }else{
                    data.block.strUnitType = 'Full Body Crypts';
                    data.block.icon = 'dashboard';
                }

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
                }else if(data.unit.intUnitStatus == 4){
                    $scope.unit.strUnitStatus = 'Partially Owned';
                }
                else if(data.unit.intUnitStatus == 0){
                    $scope.unit.strUnitStatus = 'Deactivated';
                }

                if (data.unit.intUnitType == 1){
                    $scope.unit.strUnitType = 'Columbary Vault';
                }else{
                    $scope.unit.strUnitType = 'Full Body Crypt';
                }

            });

        };

        $scope.addToCart = function(unitToBeAdded){

            $scope.reservationCart.push(unitToBeAdded);
            angular.forEach($scope.unitList, function(unitLevel){

                angular.forEach(unitLevel, function(unit){

                    if (unit.intUnitId == unitToBeAdded.intUnitId){
                        unit.color = 'gray';
                    }

                });

            });
            $('#modalUnit').closeModal();

        }

        $scope.removeToCart = function(unitId, index){

            $scope.reservationCart.splice(index, 1);
            angular.forEach($scope.unitList, function(unitLevel){

                angular.forEach(unitLevel, function(unit){

                    if (unit.intUnitId == unitId){
                        unit.color = 'green';
                    }

                });

            });

        }

        $scope.billOut = function(){

            $('#modalBillOut').openModal();

        }

        $scope.changeInterest = function(intTransactionType){

            angular.forEach($scope.reservationCart, function(reservation){

                if (reservation.interest != null) {
                    reservation.interest = null;
                }

            });

            if (intTransactionType == 2){

                Interests.query().$promise.then(function(data){

                    $scope.interestList = data.interestList;
                    $scope.interestList = $filter('orderBy')($scope.interestList, 'intNoOfYear', false);

                });

            }else if (intTransactionType == 3){

                InterestAtNeeds.query().$promise.then(function(data){

                    $scope.interestList = data.interestList;
                    $scope.interestList = $filter('orderBy')($scope.interestList, 'intNoOfYear', false);

                });

            }else if(intTransactionType == 1){

            }

        }

        $scope.setInterest = function(index){

            $('#modalInterest').openModal();
            $scope.interestIndex = index;

        }

        var reservationTransaction = function(){

            var data = {
                'strCustomerName'       :   $scope.reservation.strCustomerName,
                'deciAmountPaid'        :   $scope.reservation.deciAmountPaid,
                'unitList'              :   $scope.reservationCart
            }

            if (parseFloat($scope.reservation.deciAmountPaid) < parseFloat($scope.reservationCart.length * 3000)){
                swal('Oops!', 'Amount to pay is greater than amount paid.', 'error');
            }else {

                swal({
                        title: "Process Reservation",
                        text: "Are you sure to process this reservation?",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#ffa500",
                        confirmButtonText: "Yes, process it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function () {

                        Reservations.save(data).$promise.then(function (data) {

                            var deciChange = $filter('currency')(($scope.reservation.deciAmountPaid-$scope.reservationCart.length * 3000), "₱");
                            swal(data.message, 'Your change is '+deciChange+'.', 'success');
                            $('#modalBillOut').closeModal();

                        })
                            .catch(function (response) {

                                if (response.status == 500) {
                                    swal(response.data.message, response.data.error, 'error');
                                }

                            });

                    });

            }

        }

        var atNeedTransaction = function(){



        }

        $scope.processTransaction = function(){

            if ($scope.reservation.intTransactionType == 2){

                reservationTransaction();

            }else if ($scope.reservation.intTransactionType == 3){

                atNeedTransaction();

            }

        }

    });