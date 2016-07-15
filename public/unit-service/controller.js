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

        UnitType.query().$promise.then(function(data){

            vm.unitTypeList     =   $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

        });

        Service.query().$promise.then(function(data){

            vm.serviceList      =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        var selectedUnitType    =   0;
        vm.configureUnitService =   function(unitType){

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
                selectedUnitType    =   unitType.intRoomTypeId;
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
                intUnitTypeIdFK :   selectedUnitType,
                unitServiceList :   unitServiceList
            };
            console.log(data);

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

    });