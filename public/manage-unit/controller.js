/**
 * Created by kenlayug on 7/15/16.
 */
'use strict';
angular.module('app')
    .controller('ctrl.manage-unit', function($scope, $filter, $resource, appSettings, $rootScope, SafeBox, Building){

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
        var rs          =   $rootScope;

        rs.transactionActive            =   "active";
        rs.manageUnitActive             =   "active";

        vm.addDeceased      =   {};
        vm.pullDeceased     =   {};

        var intCustomerId   =   0;

        var Customers   =   $resource(appSettings.baseUrl+'v1/customer', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var CustomerGet =   $resource(appSettings.baseUrl+'v2/customers', {}, {
            get :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var CustomerDeceases    =   $resource(appSettings.baseUrl+'v2/customers/:id/deceases', {
            id          :       '@id'
        });

        var CustomerUpdate  =   $resource(appSettings.baseUrl+'v1/customer/:id/update', {}, {
            update  :   {
                method  :   'POST',
                isArray :   false
            }
        });

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

        var AddDeceased     =   $resource(appSettings.baseUrl+'v3/transaction-deceased/add', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var TransferDeceased    =   $resource(appSettings.baseUrl+'v2/transaction-deceased/transfer', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var PullDeceased        =   $resource(appSettings.baseUrl+'v2/transaction-deceased/:id/pull', {}, {
            pull    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var ReturnDeceased      =   $resource(appSettings.baseUrl+'v2/transaction-deceased/:id/return', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var TransferOwnership   =   $resource(appSettings.baseUrl+'v2/units/:unitId/transfer', {}, {
            transfer    :   {
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

        var Deceases        =   $resource(appSettings.baseUrl+'v2/units/:id/deceases', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Deceased        =   $resource(appSettings.baseUrl+'v2/deceases', {});

        var BusinessDependency  =   $resource(appSettings.baseUrl+'v2/business-dependencies/:name', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var lastSelected    =   null;
        var colorStatus     =   [
            'orange darken-1',
            'green darken-3',
            'blue darken-3',
            'red darken-3',
            'yellow darken-2',
            'blue darken-3',
            'red accent-1',
            'yellow darken-2'
        ];

        UnitTypes.query().$promise.then(function(data){

            vm.unitTypeList     =   $filter('orderBy')(data.roomTypeList, 'strUnitTypeName', false);
            rs.displayPage();

        });

        Relationships.query().$promise.then(function(data){

            vm.relationshipList     =   $filter('orderBy')(data.relationshipList, 'strRelationshipName', false);

        });

        Customers.query().$promise.then(function(data){

            vm.customerList     =   $filter('orderBy')(data, 'strFullName', false);

        });

        BusinessDependency.get({name : 'transferOwnerCharge'}).$promise.then(function(data){

            vm.transferOwnerCharge      =   data.businessDependency;

        });

        Building.query().$promise.then(function(data){

            vm.buildingList             =   $filter('orderBy')(data, 'strBuildingName', false);

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
                        block.color             =   'orange';
                        block.transferColor     =   'orange';
                    });
                    vm.unitTypeList[index].blockList = $filter('orderBy')(data.blockList, ['strBuildingCode', 'intFloorNo', 'strRoomName', 'intBlockNo'], false);

                    UnitServices.query({id: unitType.intRoomTypeId}).$promise.then(function(data){

                        angular.forEach(data.unitServiceList, function(unitService){

                            Services.get({id : unitService.intServiceIdFK}).$promise.then(function(serviceData){

                                unitService.service =   serviceData.service;

                            });

                            if (unitService.intServiceTypeId == 1){

                                vm.add       =   unitService;

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

                    unit.color      =   colorStatus[unit.intUnitStatus];
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

                vm.unitStatusCount         =   data.unitStatusCount;

                lastSelected = {};
                lastSelected.unitType   =   vm.unitIndex;
                lastSelected.block      =   intBlockIndex;

            });

        };

        vm.openModal        =   function(unit){

            if (unit.intUnitStatus == 3 || unit.intUnitStatus == 7 || unit.intUnitStatus == 6){

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                UnitInfo.get({id: unit.intUnitId}).$promise.then(function(data){

                    vm.unit         =   data.unit;
                    vm.unit.display =   unit.display;
                    intCustomerId   =   data.unit.intCustomerId;

                    if (data.unit.strMiddleName == null){
                        data.unit.strMiddleName             =   '';
                    }//end if

                    CustomerDeceases.get({id : intCustomerId}).$promise.then(function(data){

                        vm.customerDeceasedList     =   $filter('orderBy')(data.deceasedList, 'strFullName', false);

                    });

                    Deceases.query({id: unit.intUnitId}).$promise.then(function(deceasedData){

                        var storage             =   0;
                        angular.forEach(deceasedData.deceasedList, function(deceased){
                            if (deceased.strMiddleName == null){
                                deceased.strMiddleName              =   '';
                            }//end if
                            storage             =   deceased.intStorageTypeIdFK;
                        });
                        vm.deceasedList          =   $filter('orderBy')(deceasedData.deceasedList, ['strLastName', 'strFirstName', 'strMiddleName'], false);

                        StorageTypes.query({id: data.unit.intRoomTypeId}).$promise.then(function(data){

                            vm.storageTypeList      =   $filter('orderBy')(data.storageTypeList, 'strStorageTypeName', false);
                            angular.forEach(vm.storageTypeList, function(storageType){

                                if (storage == storageType.intStorageTypeId){

                                    vm.maxStorage       =   storageType.intQuantity;

                                }//end if

                            });
                            $('#modal1').openModal();
                            swal.close();

                        });

                    });

                });

            }else if (unit.intUnitStatus == 4){
                swal('Error!', 'Complete your downpayment first before adding deceased to this unit.', 'error');
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
            vm.addDeceased.intUnitId = vm.unit.intUnitId;
            vm.addDeceased.intUnitTypeId = vm.unit.intRoomTypeId;

            angular.forEach(vm.customerDeceasedList, function(deceased){

                if (deceased.strMiddleName == null){
                    deceased.strMiddleName  =   '';
                }//end if
                var strDeceasedName     =   deceased.strLastName+', '+deceased.strFirstName+' '+deceased.strMiddleName;
                if (vm.addDeceased.strDeceasedName == strDeceasedName.trim()){
                    vm.addDeceased.intDeceasedId            =   deceased.intDeceasedId;
                }

            });

            AddDeceased.save(vm.addDeceased).$promise.then(function (data) {

                if (data.transactionDeceased.strMiddleName == null){
                    data.transactionDeceased.strMiddleName          =   '';
                }//end if
                vm.transaction = data;
                vm.addDeceased = {};
                swal.close();
                $('#modal1').closeModal();
                $('#successAddDeceased').openModal();

            })
                .catch(function (response) {

                    if (response.status == 500) {
                        swal('Error!', response.data.error, 'error');
                    } else if (response.status == 422) {
                        swal('Oops.', 'Please fill out required fields.', 'error');
                    }

                });

        }//end function

        var lastTransferSelected    =   null;

        vm.openTransferUnits            =   function(block, intBlockIndex){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            if (lastTransferSelected != null){
                vm.unitTypeList[lastTransferSelected.unitType].blockList[lastTransferSelected.block].transferColor  =   'orange';
            }

            Units.query({id: block.intBlockId}).$promise.then(function(data){

                var unitTable = [];
                var intLevelNoPrev = 0;
                var intLevelNoCurrent = 0;
                var unitList = [];
                var levelLetter =   64;

                vm.transferBlockName    =   block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo;

                angular.forEach(data.unitList, function(unit, index){

                    unit.color          =    colorStatus[unit.intUnitStatus];
                    if(unit.intUnitId == vm.unit.intUnitId){
                        unit.color = 'black';
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

                vm.transferUnitList = unitTable;
                vm.transferBlock    = data.block;
                vm.transferShowUnit =   true;
                swal.close();
                vm.unitTypeList[vm.unitIndex].blockList[intBlockIndex].transferColor = 'orange darken-3';

                lastTransferSelected = {};
                lastTransferSelected.unitType   =   vm.unitIndex;
                lastTransferSelected.block      =   intBlockIndex;

            });

        }

        var lastTransferUnitSelected    =   null;

        vm.selectTransfer           =   function(unit){

            if (unit.intUnitStatus == 3 || unit.intUnitStatus == 4) {

                if (vm.unit.intUnitId == unit.intUnitId){

                    swal('Error!', 'Unit cannot transfer deceased from itself.', 'error');

                }else if (lastTransferUnitSelected != null) {

                    angular.forEach(vm.transferUnitList, function (unitLevel) {

                        angular.forEach(unitLevel, function (unit) {

                            if (lastTransferUnitSelected.intUnitId == unit.intUnitId) {

                                unit.color = colorStatus[unit.intUnitStatus];

                            }

                        });

                    });
                    
                    unit.color = 'grey';
                    lastTransferUnitSelected = unit;

                }else{

                    unit.color = 'grey';
                    lastTransferUnitSelected = unit;

                }


            }else{

                swal('Error!', 'Unit is not owned yet.', 'error');

            }

        }

        vm.processTransferDeceased      =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            var deceasedList    =   [];
            angular.forEach(vm.deceasedList, function(deceased){

                if (deceased.selected){

                    deceasedList.push(deceased);

                }

            });

            if (lastTransferUnitSelected == null){

                swal('Error!', 'Choose receiving unit.', 'error');

            }else if (deceasedList.length == 0){

                swal('Error!', 'Pick deceased to be transferred.', 'error');

            }else if (vm.unit.intUnitId == lastTransferUnitSelected.intUnitId){

                swal('Error!', 'Cannot transfer to the same unit.', 'error');

            }else{

                vm.transferDeceased.intToUnitId     =   lastTransferUnitSelected.intUnitId;
                vm.transferDeceased.intFromUnitId   =   vm.unit.intUnitId;
                vm.transferDeceased.deceasedList    =   deceasedList;
                vm.transferDeceased.intUnitTypeId   =   vm.unit.intRoomTypeId;

                TransferDeceased.save(vm.transferDeceased).$promise.then(function (data) {

                    vm.lastTransaction = data;
                    vm.transferDeceased = null;

                    angular.forEach(vm.unitList, function(unitLevel){

                        angular.forEach(unitLevel, function(unit){

                            if (unit.intUnitId  =   lastTransferUnitSelected.intUnitId){

                                unit.transferColor  =   colorStatus[unit.intUnitStatus];

                            }

                        });

                    });

                    lastTransferUnitSelected    =   null;

                    $('#modal1').closeModal();
                    $('#successTransferDeceased').openModal();
                    swal.close();

                })
                    .catch(function (response) {

                        if (response.status == 500) {

                            swal('Error!', response.data.error, 'error');

                        } else if (response.status == 422) {

                            swal('Error!', 'Please fill out required fields.', 'error');

                        }

                    });

            }

        }

        vm.pullSelected = 0;
        vm.addToPullDeceased            =   function(deceased){

            if (deceased.boolPermanentPull){

                vm.pullSelected++;

            }else{
                vm.pullSelected--;
            }

        }

        vm.changePull                   =   function(deceased){
            if (!deceased.pullSelected){
                if (deceased.boolPermanentPull){
                    deceased.boolPermanentPull          =   false;
                    vm.pullSelected--;
                }//end if
            }//end if
        }//end function

        var customerUpdate  =   false;

        vm.getCustomer                  =   function(strFullName){

            CustomerGet.get({'strCustomerName' : strFullName}).$promise.then(function(data){

                vm.customer             =   data.customer;
                customerUpdate          =   true;
                $('#newCustomer').openModal();

            });

        }

        vm.processPullDeceased          =   function(){

            var deceasedList        =   [];
            var validate            =   false;
            var message             =   null;
            var intPermanentPull    =   0;
            var intBorrow           =   0;

            angular.forEach(vm.deceasedList, function(deceased){

                if (deceased.pullSelected){

                    deceasedList.push(deceased);
                    if (deceased.boolPermanentPull){

                        intPermanentPull++;

                    }//end if
                    else{

                        intBorrow++;

                    }//end else

                }//end if

            });

            angular.forEach(deceasedList, function(deceased){

                if (!deceased.boolPermanentPull){

                    if (deceased.dateReturn == null){
                        validate            =   true;
                        message             =   'Borrowing deceased need to have return date.';
                    }

                }//end if

            });

            vm.pullDeceased.intUnitTypeId       =   vm.unit.intRoomTypeId;
            vm.pullDeceased.deceasedList        =   deceasedList;

            if (validate){
                swal('Error!', message, 'error');
            }else{

                PullDeceased.pull({id: vm.unit.intUnitId}, vm.pullDeceased).$promise.then(function(data){

                    vm.pullDeceasedTransaction                  =   data;
                    vm.pullDeceasedTransaction.pullDeceasedList =   deceasedList;
                    vm.pullDeceasedTransaction.intPermanentPull =   intPermanentPull;
                    vm.pullDeceasedTransaction.intBorrow        =   intBorrow;
                    vm.pullDeceased                             =   null;

                    vm.pullDeceasedTransaction.totalAmountToPay =   vm.pullDeceasedTransaction.service.deciPrice * vm.pullDeceasedTransaction.deceasedList.length;

                    $('#successPullOutDeceased').openModal();
                    $('#modal1').closeModal();

                })
                    .catch(function(response){

                        if (response.status == 500){

                            swal('Error!', response.data.error, 'error');

                        }

                    });

            }//end else

        }//end function

        vm.openReturnModal           =   function(deceased){

            vm.returnDeceased           =   deceased;
            var currentDate             =   new Date();

            vm.returnDeceased.currentDate   =   currentDate;

            if (currentDate > vm.returnDeceased.dateReturn){

                vm.returnDeceased.penalty   =   true;

            }

            $('#return').openModal();

        }

        vm.processReturnDeceased    =   function(){

            console.log(vm.returnDeceased);

            ReturnDeceased.save({id: vm.returnDeceased.intUnitDeceasedId}, vm.returnDeceased).$promise.then(function(data){

                vm.returnDeceasedTransaction        =   data;
                console.log(data);
                $('#modal1').closeModal();
                $('#return').closeModal();
                $('#successReturnDeceased').openModal();

            })
                .catch(function(response){

                    if (response.status == 500){

                        swal('Error!', response.data.error, 'error');

                    }

                });

        }

        vm.transferOwnership        =   {};

        vm.saveCustomer                 =   function(){

            if (customerUpdate){

                CustomerUpdate.save({id : vm.customer.intCustomerId}, vm.customer).$promise.then(function(data){

                    vm.customer                         =   null;
                    vm.customerList                     =   $filter('orderBy')(vm.customerList, 'strFullName', false);
                    vm.transferOwnership.customerName   =   data.strFullName;
                    swal('Success!', 'Customer is successfully updated.', 'success');
                    $('#newCustomer').closeModal();
                    vm.customerList.push(data);

                });

            }else{

                Customers.save(vm.customer).$promise.then(function(data){

                    vm.customer                         =   null;
                    vm.customerList                     =   $filter('orderBy')(vm.customerList, 'strFullName', false);
                    vm.transferOwnership.customerName   =   data.strFullName;
                    swal('Success!', 'Customer is successfully created.', 'success');
                    $('#newCustomer').closeModal();
                    vm.customerList.push(data);

                });

            }

        }

        vm.processTransferOwnership                 =   function(){

            vm.transferOwnership.unit               =   vm.unit;
            var strPrevOwner                        =   vm.unit.strLastName+', '+vm.unit.strFirstName+' '+vm.unit.strMiddleName;
            var validation                          =   false;
            var message                             =   null;

            if (strPrevOwner.trim() == vm.transferOwnership.customerName){

                validation                          =   true;
                message                             =   'New owner should not be the same as the previous owner.'

            }

            if (validation){

                swal('Error!', message, 'error');

            }else{

                if (vm.deceasedList.length != 0){

                    swal({
                        title: "Transfer Ownership",   
                        text: "This unit contains deceased. Are you sure to transfer its ownership?",   
                        type: "warning",   showCancelButton: true,   
                        confirmButtonColor: "#ffa500",   
                        confirmButtonText: "Yes, transfer it!",    
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: false,   
                        showLoaderOnConfirm: true, }, 
                        function(){   

                            processTransferOwnership();
                           
                    });

                }else{
                    processTransferOwnership();
                }            

            }

        }

        $scope.closeBlock           =   function(){

            $scope.showUnit         =   false;
            $scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';
            $scope.lastSelected     =   null;
            $scope.block            =   null;

        }//end function

        $scope.closeBlock1          =   function(){

            $scope.transferShowUnit =   false;
            $scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';
            $scope.lastSelected     =   null;
            $scope.block            =   null;

        }//end function

        var processTransferOwnership            =   function(){
             angular.forEach(vm.customerList, function(customer){
                    if (customer.strMiddleName == null){
                        customer.strMiddleName  =   '';
                    }//end if
                    var strCustomerName     =   customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;
                    if (strCustomerName.trim() == vm.transferOwnership.customerName){
                        vm.transferOwnership.intCustomerId      =   customer.intCustomerId;
                    }//end if
                });
                TransferOwnership.transfer({unitId : vm.unit.intUnitId}, vm.transferOwnership).$promise.then(function(data){

                    vm.transferOwnershipTransaction     =   data;
                    vm.transferOwnership                =   null;
                    $('#successTransferOwnership').openModal();
                    $('#modal1').closeModal();
                    swal.close();

                })
                    .catch(function(response){

                        if (response.status == 500){

                            swal('Error!', response.data.error, 'error');

                        }

                    });
        }

        vm.saveDeceased             =   function(){

            vm.newDeceased.intCustomerId            =   intCustomerId;
            var deceased            =   new Deceased(vm.newDeceased);
            deceased.$save(function(data){

                $('#newDeceased').closeModal();
                vm.customerDeceasedList.push(data.deceased);
                vm.newDeceased                      =   null;
                vm.addDeceased.strDeceasedName      =   data.deceased.strFullName;
                vm.customerDeceasedList             =   $filter('orderBy')(vm.customerDeceasedList, 'strFullName', false);

            },
                function(response){

                    if (response.status == 500){

                        swal('Error!', response.data.message, 'error');

                    }

                });

        }//end function

        vm.openSafeBox          =   function(){

            SafeBox.get().$promise.then(function(data){

                angular.forEach(data.unitDeceasedList, function(unitDeceased){
                    if (unitDeceased.strDeceasedMiddle == null){
                        unitDeceased.strDeceasedMiddle          =   '';
                    }//end if
                    if (unitDeceased.strCustomerMiddle == null){
                        unitDeceased.strCustomerMiddle          =   '';
                    }//end if
                });//end foreach
                vm.safeBoxList          =   $filter('orderBy')(data.unitDeceasedList, ['strCustomerLast', 'strCustomerFirst', 'strCustomerMiddle'], false);

            });

        }//end function

        vm.retrieveDeceased             =   function(deceased, index){

            BusinessDependency.get({name : 'paymentUrn'}).$promise.then(function(data){

                vm.retrieveService          =   data.businessDependency;

            });
            deceased.index                      =   index;
            deceased.strCustomerName            =   deceased.strCustomerLast+', '+deceased.strCustomerFirst+' '+deceased.strCustomerMiddle;
            vm.retrieveDeceased                 =   deceased;
            $('#retrieve').openModal();

        }//end function

        vm.processRetrieveDeceased          =   function(){

            console.log(vm.retrieveDeceased);
            SafeBox.update({id : vm.retrieveDeceased.intDeceasedId}, vm.retrieveDeceased).$promise.then(function(data){

                vm.safeBoxList.splice(vm.retrieveDeceased.index, 1);
                vm.retrieveDeceased                 =   null;
                $('#retrieve').closeModal();

            })
                .catch(function(response){
                    if (response.status == 500){

                        swal('Error!', response.data.message, 'error');

                    }//end if
                    else{
                        swal('Error!', 'Error '+response.status, 'error');
                    }//end function
                });

        }//end function

    });