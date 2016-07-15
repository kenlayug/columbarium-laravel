/**
 * Created by kenlayug on 7/14/16.
 */
'use strict';
angular.module('app')
    .controller('ctrl.unit-service', function($scope, $resource, $filter, appSettings){

        var vm  =   $scope;

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

            vm.unitTypeList     =   $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

        });

        Service.query().$promise.then(function(data){

            vm.serviceList      =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        StorageTypes.query().$promise.then(function(data){

            vm.storageTypeList  =   $filter('orderBy')(data.storageTypeList, 'strStorageTypeName', false);

        });

        vm.selectedUnitType = 0;
        vm.configureUnitService =   function(unitType){

            vm.selectedUnitType    =   unitType.intRoomTypeId;
            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            vm.add          =   null;
            vm.transfer     =   null;
            vm.pull         =   null;
            UnitServiceId.query({id: unitType.intRoomTypeId}).$promise.then(function(data){

                swal.close();
                angular.forEach(data.unitServiceList, function(unitService){

                    if (unitService.intServiceTypeId == 1){
                        vm.add      =   unitService;
                    }else if (unitService.intServiceTypeId == 2){
                        vm.transfer =   unitService;
                    }else if (unitService.intServiceTypeId == 3){
                        vm.pull     =   unitService;
                    }

                });

                $('#configureUnitService').openModal();

            });

        }

        vm.saveUnitService      =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            var unitServiceList             =   [];

            vm.add.intServiceTypeId         =   1;
            unitServiceList.push(vm.add);
            vm.transfer.intServiceTypeId    =   2;
            unitServiceList.push(vm.transfer);
            vm.pull.intServiceTypeId        =   3;
            unitServiceList.push(vm.pull);

            var data    =   {
                intUnitTypeIdFK :   vm.selectedUnitType,
                unitServiceList :   unitServiceList
            };

            UnitService.save(data).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $('#configureUnitService').closeModal();

            })
                .catch(function(response){

                    if (response.status == 500){
                        swal(response.data.message, response.data.error, 'error');
                    }

                });

        }

        vm.configureUnitStorageType     =   function(unitType){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

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

                vm.updateUnitType               =   {};
                vm.updateUnitType.intUnitTypeId =   unitType.intRoomTypeId;
                $('#modalStorageType').openModal();
                swal.close();

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

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            var selectedStorageTypes    =   [];

            angular.forEach(vm.storageTypeList, function(storageType){

                if (storageType.selected){

                    selectedStorageTypes.push(storageType);

                }

            });

            var data                    =   {
                storageTypeList     :   selectedStorageTypes
            };

            UnitStorageTypesSave.update({id : vm.updateUnitType.intUnitTypeId}, data).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $('#modalStorageType').closeModal();

            })
                .catch(function(response){

                    if (response.status == 500){

                        swal(response.data.message, response.data.error, 'error');

                    }

                });

        }

    });