/**
 * Created by kenlayug on 7/14/16.
 */
'use strict';
angular.module('app')
    .controller('ctrl.unit-service', function($scope, $rootScope, $resource, $filter, appSettings){

        var vm  =   $scope;
        var rs  =   $rootScope;

        rs.utilityActive            =   'active';
        rs.unitServicingActive      =   'active';

        var UnitServiceId   =   $resource(appSettings.baseUrl+'v2/unit-services/:id', {}, {
            query    :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var UnitService     =   $resource(appSettings.baseUrl+'v2/unit-services', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var UnitType        =   $resource(appSettings.baseUrl+'v2/roomtypes/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Service         =   $resource(appSettings.baseUrl+'v2/services/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var StorageTypes    =   $resource(appSettings.baseUrl+'v2/storage-types', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var UnitStorageTypes    =   $resource(appSettings.baseUrl+'v2/roomtypes/:id/storage-types', {}, {
            get :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var UnitStorageTypesSave    =   $resource(appSettings.baseUrl+'v2/unit-storages/:id', {}, {
            update  :   {
                method  :   'PUT',
                isArray :   false
            }
        });

        UnitType.query().$promise.then(function(data){

            angular.forEach(data.roomTypeList, function(roomType){

                roomType.color = 'light-green';

            });
            vm.unitTypeList     =   $filter('orderBy')(data.roomTypeList, 'strUnitTypeName', false);

        });

        Service.query().$promise.then(function(data){

            vm.serviceList      =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        StorageTypes.query().$promise.then(function(data){

            vm.storageTypeList  =   $filter('orderBy')(data.storageTypeList, 'strStorageTypeName', false);

        });

        vm.updateServiceUtility     =   function(unitType, index){

            if (vm.selectedUnitType != null){

                vm.unitTypeList[vm.selectedUnitType.index].color = 'light-green';

            }

            rs.loading                      =   true;

            vm.selectedUnitType             =   unitType;
            vm.selectedUnitType.index       =   index;
            vm.unitTypeList[index].color    =   'red';
            vm.add                          =   {};
            vm.transfer                     =   {};
            vm.pull                         =   {};
            UnitServiceId.query({id: unitType.intRoomTypeId}).$promise.then(function(data){

                angular.forEach(data.unitServiceList, function(unitService){

                    if (unitService.intServiceTypeId == 1){
                        vm.add      =   unitService;
                    }else if (unitService.intServiceTypeId == 2){
                        vm.transfer =   unitService;
                    }else if (unitService.intServiceTypeId == 3){
                        vm.pull     =   unitService;
                    }

                });
                console.log(vm.transfer.intServiceIdFK);

            });


            angular.forEach(vm.storageTypeList, function(storageType){

                storageType.selected    =   null;
                storageType.intQuantity =   null;

            });

            UnitStorageTypes.get({id : unitType.intRoomTypeId}).$promise.then(function(data){

                angular.forEach(data.storageTypeList, function(savedStorageType){

                    angular.forEach(vm.storageTypeList, function(storageType){

                        if (storageType.intStorageTypeId == savedStorageType.intStorageTypeIdFK){

                            storageType.selected    =   true;
                            storageType.intQuantity =   savedStorageType.intQuantity;

                        }

                    });

                });

                rs.loading                  =   false;

            });

        }

        vm.saveUnitSettings      =   function(){

            var unitServiceList             =   [];

            vm.add.intServiceTypeId         =   1;
            unitServiceList.push(vm.add);
            vm.transfer.intServiceTypeId    =   2;
            unitServiceList.push(vm.transfer);
            vm.pull.intServiceTypeId        =   3;
            unitServiceList.push(vm.pull);

            var data    =   {
                intUnitTypeIdFK :   vm.selectedUnitType.intRoomTypeId,
                unitServiceList :   unitServiceList
            };

            UnitService.save(data).$promise.then(function(data){

                vm.updateUnitStorageType();

            })
                .catch(function(response){

                    if (response.status == 500){
                        swal(response.data.message, response.data.error, 'error');
                    }

                });

        }

        vm.setValue                     =   function(storageType){

            if (storageType.selected == 1){

                storageType.intQuantity = 1;

            }else{

                storageType.intQuantity = null;

            }

        }

        vm.configureUnitStorageType     =   function(unitType){

            angular.forEach(vm.storageTypeList, function(storageType){

                storageType.selected    =   false;
                storageType.intQuantity =   null;

            });

            UnitStorageTypes.get({id : unitType.intRoomTypeId}).$promise.then(function(data){

                angular.forEach(data.storageTypeList, function(savedStorageType){

                    angular.forEach(vm.storageTypeList, function(storageType){

                        if (storageType.intStorageTypeId == savedStorageType.intStorageTypeIdFK){

                            storageType.selected    =   true;
                            storageType.intQuantity =   savedStorageType.intQuantity;

                        }

                    });

                });
                swal('Success!', 'Successfully updated.', 'success');

            });

        }

        vm.openCreateStorageType        =   function(){

            $('#modalNewStorageType').openModal();

        }
        
        vm.createStorageType            =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            StorageTypes.save(vm.newStorage).$promise.then(function(data){

                vm.newStorage       =   null;
                swal('Success!', data.message, 'success');
                vm.storageTypeList.push(data.storageType);
                vm.storageTypeList  =   $filter('orderBy')(vm.storageTypeList, 'strStorageTypeName', false);
                $('#modalNewStorageType').closeModal();

            })
                .catch(function(response){

                    if (response.status == 500){
                        swal(response.data.message, response.data.error, 'error');
                    }

                });

        }

        vm.required                     =   function(storageType){

            if (storageType.selected){
                storageType.required    =   'required';
            }else{
                storageType.required    =   '';
            }

        }

        vm.updateUnitStorageType        =   function(){

            var selectedStorageTypes    =   [];

            angular.forEach(vm.storageTypeList, function(storageType){

                if (storageType.selected){

                    selectedStorageTypes.push(storageType);

                }

            });

            var data                    =   {
                storageTypeList     :   selectedStorageTypes
            };

            UnitStorageTypesSave.update({id : vm.selectedUnitType.intRoomTypeId}, data).$promise.then(function(data){

                swal('Success!', 'Successfully updated.', 'success');
                $('#modalStorageType').closeModal();

            })
                .catch(function(response){

                    if (response.status == 500){

                        swal(response.data.message, response.data.error, 'error');

                    }

                });

        }

    });