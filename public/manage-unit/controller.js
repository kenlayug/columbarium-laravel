/**
 * Created by kenlayug on 7/15/16.
 */
'use strict';
angular.module('app')
    .controller('ctrl.manage-unit', function($scope, $filter, $resource, appSettings){

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

        var lastSelected    =  null;

        UnitTypes.query().$promise.then(function(data){

            vm.unitTypeList     =   $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

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
                    vm.unitTypeList[index].blockList = $filter('orderBy')(data.blockList, 'strBuildingCode', false);
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

                console.log(vm.unitList);

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

                    });
                    $('#modal1').openModal();
                    swal.close();

                });

            }else{
                swal('Error!', 'This unit is not yet owned.', 'error');
            }

        };

    });