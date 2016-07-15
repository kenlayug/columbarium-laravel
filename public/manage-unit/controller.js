/**
 * Created by kenlayug on 7/15/16.
 */
'use strict';
angular.module('app')
    .controller('ctrl.manage-unit', function($scope, $filter, $resource, appSettings){

        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears :   50,
            onSet: function (ele) {
                if(ele.select){
                    this.close();
                }
            }
        });


        var vm          =   $scope;

        var UnitTypes   =   $resource(appSettings.baseUrl+'v2/roomtypes/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Blocks      =   $resource(appSettings.baseUrl+'v2/blocks/unitTypes/:id', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Units       =   $resource(appSettings.baseUrl+'v2/blocks/:id/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var UnitInfo    =   $resource(appSettings.baseUrl+'v2/units/:id/info', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var StorageTypes    =   $resource(appSettings.baseUrl+'v2/roomtypes/:id/storage-types/info', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Relationships   =   $resource(appSettings.baseUrl+'v2/relationships', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var AddDeceases     =   $resource(appSettings.baseUrl+'v2/add-deceases', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var UnitServices    =   $resource(appSettings.baseUrl+'v2/unit-services/:id', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Services        =   $resource(appSettings.baseUrl+'v2/services/:id', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var lastSelected    =   null;

        UnitTypes.query().$promise.then(function(data){

            vm.unitTypeList     =   $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

        });

        Relationships.query().$promise.then(function(data){

            vm.relationshipList     =   $filter('orderBy')(data.relationshipList, 'strRelationshipName', false);

        });

        vm.getBlocks    =   function(unitType, index){

            if (vm.unitTypeList[index].blockList == null) {

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                Blocks.query({id: unitType.intRoomTypeId}).$promise.then(function (data) {

                    angular.forEach(data.blockList, function(block){
                        block.color =   'orange';
                    });
                    vm.unitTypeList[index].blockList = $filter('orderBy')(data.blockList, ['strBuildingCode', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);

                    UnitServices.query({id: unitType.intRoomTypeId}).$promise.then(function(data){

                        angular.forEach(data.unitServiceList, function(unitService){

                            Services.get({id : unitService.intServiceIdFK}).$promise.then(function(serviceData){

                                unitService.service =   serviceData.service;

                            });

                            if (unitService.intServiceTypeId == 1){

                                vm.add       =   unitService;
                                console.log(vm.add);

                            }else if (unitService.intServiceTypeId == 2){

                                vm.transfer  =   unitService;

                            }else if (unitService.intServiceTypeId == 3){

                                vm.pull      =   unitService;

                            }

                        });

                        swal.close();

                    });
                    swal.close();

                });

            }

            vm.unitIndex    =   index;

        };

        vm.getUnits     =   function(block, intBlockIndex){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            if (lastSelected != null){
                vm.unitTypeList[lastSelected.unitType].blockList[lastSelected.block].color  =   'orange';
            }

            Units.query({id: block.intBlockId}).$promise.then(function(data){

                var unitTable = [];
                var intLevelNoPrev = 0;
                var intLevelNoCurrent = 0;
                var unitList = [];
                var levelLetter =   64;

                vm.blockName    =   block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo;

                angular.forEach(data.unitList, function(unit, index){

                    if (unit.intUnitStatus == 1){
                        unit.color = 'green';
                        if (unit.unitPrice == null){
                            unit.color = 'grey';
                        }
                    }else if(unit.intUnitStatus == 0){
                        unit.color = 'orange';
                    }else if(unit.intUnitStatus == 2){
                        unit.color = 'blue';
                    }else if(unit.intUnitStatus == 3){
                        unit.color = 'red';
                    }else if(unit.intUnitStatus == 4){
                        unit.color = 'yellow';
                    }
                    unit.disable  =   '';
                    intLevelNoCurrent = unit.intLevelNo;
                    if (intLevelNoPrev != intLevelNoCurrent){
                        if (index != 0) {
                            unitTable.push(unitList);
                            unitList = [];
                        }
                        intLevelNoPrev = unit.intLevelNo;
                    }

                    unit.display    =   String.fromCharCode(parseInt(levelLetter)+parseInt(unit.intLevelNo))+unit.intColumnNo;

                    unitList.push(unit);
                    if (index == data.unitList.length-1){
                        unitTable.push(unitList);
                    }

                });

                vm.unitList = unitTable;
                vm.block    = data.block;
                vm.showUnit =   true;
                swal.close();
                vm.unitTypeList[vm.unitIndex].blockList[intBlockIndex].color = 'orange darken-3';

                lastSelected = {};
                lastSelected.unitType   =   vm.unitIndex;
                lastSelected.block      =   intBlockIndex;

            });

        };

        vm.openModal        =   function(unit){

            if (unit.intUnitStatus == 3 || unit.intUnitStatus == 4){

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                UnitInfo.get({id: unit.intUnitId}).$promise.then(function(data){

                    vm.unit         =   data.unit;
                    vm.unit.display =   unit.display;
                    StorageTypes.query({id: data.unit.intRoomTypeId}).$promise.then(function(data){

                        vm.storageTypeList      =   $filter('orderBy')(data.storageTypeList, 'strStorageTypeName', false);
                        $('#modal1').openModal();
                        swal.close();

                    });

                });

            }else{
                swal('Error!', 'This unit is not yet owned.', 'error');
            }

        };

        vm.processAddDeceased   =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            if ((vm.addDeceased.newRelationship == null || vm.addDeceased.strRelationshipName == null) && vm.addDeceased.intRelationshipId == null){
                swal('Oops.', 'Please fill out all required fields.', 'error');
            }else {

                vm.addDeceased.intUnitId = vm.unit.intUnitId;
                vm.addDeceased.intUnitTypeId = vm.unit.intRoomTypeId;
                AddDeceases.save(vm.addDeceased).$promise.then(function (data) {

                    swal.close();
                    $('#successAddDeceased').openModal();
                    if (data.relationship != null) {

                        vm.relationshipList.push(data.relationship);
                        vm.relationshipList = $filter('orderBy')(vm.relationshipList, 'strRelationshipName', false);

                    }
                    vm.transaction = data;
                    vm.addDeceased = null;
                    $('#modal1').closeModal();

                })
                    .catch(function (response) {

                        if (response.status == 500) {
                            swal('Error!', response.data.error, 'error');
                        } else if (response.status == 422) {
                            swal('Oops.', 'Please fill out required fields.', 'error');
                        }

                    });

            }

        }

    });