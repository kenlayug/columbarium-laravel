/**
 * Created by kenlayug on 6/14/16.
 */
angular.module('app')
    .controller('ctrl.unit-purchase', function($scope, $resource, appSettings, $filter, $window){

        $scope.selected         =   {};
        $scope.reservationCart  =   [];
        $scope.reservation      =   {};
        $scope.showUnit         =   false;

        var UnitType    =   $resource(appSettings.baseUrl+'v2/roomtypes/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Blocks = $resource(appSettings.baseUrl+'v2/blocks/unitTypes/:id', {}, {
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

        var CustomerUpdate  =   $resource(appSettings.baseUrl+'v1/customer/:id/update', {}, {
            update  :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var BusinessDependency  =   $resource(appSettings.baseUrl+'v2/business-dependencies/:name', {}, {
            get :   {
                method  :   'GET',
                isArray :   false
            }
        })

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

        var BuyUnits = $resource(appSettings.baseUrl+'v2/buy-units', {}, {
            save: {
                method: 'POST',
                isArray: false
            }
        });

        var AtNeeds  =   $resource(appSettings.baseUrl+'v2/at-needs', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        Customers.query().$promise.then(function(customers){

            $scope.customerList = customers;
            $scope.customerList = $filter('orderBy')($scope.customerList, 'strFullName', false);

        });

        UnitType.query().$promise.then(function(data){

            $scope.unitTypeList =   $filter('orderBy')(data.roomTypeList, 'strRoomTypeName', false);

        });

        BusinessDependency.get({name: 'reservationFee'}).$promise.then(function(data){

            $scope.reservationFee   =   data.businessDependency;

        });

        BusinessDependency.get({name: 'downpayment'}).$promise.then(function(data){

            $scope.downpayment      =   data.businessDependency;

        });

        BusinessDependency.get({name: 'discountPayOnce'}).$promise.then(function(data){

            $scope.discountPayOnce      =   data.businessDependency;

        });

        BusinessDependency.get({name: 'pcf'}).$promise.then(function(data){

            $scope.pcf      =   data.businessDependency;

        });

        $scope.getBlocks = function(unitTypeId, index){

            if ($scope.unitTypeList[index].blockList    ==  null) {

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                Blocks.query({id: unitTypeId}).$promise.then(function (data) {

                    $scope.unitTypeList[index].blockList = data.blockList;
                    swal.close();

                });

            }

        }

        $scope.getUnits = function(block){

            if ($scope.block == null || $scope.block.intBlockId != block.intBlockId){

                swal({
                    title               :   'Please wait...',
                    text                :   'Processing your request.',
                    showConfirmButton   :   false
                });

                Units.get({id: block.intBlockId}).$promise.then(function(data){

                    var unitTable = [];
                    var intLevelNoPrev = 0;
                    var intLevelNoCurrent = 0;
                    var unitList = [];
                    var levelLetter =   64;

                    $scope.blockName    =   block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo;

                    angular.forEach(data.unitList, function(unit, index){

                        if (unit.intUnitStatus == 1){
                            unit.color = 'green';
                        }else if(unit.intUnitStatus == 0){
                            unit.color = 'orange';
                        }else if(unit.intUnitStatus == 2){
                            unit.color = 'blue';
                        }else if(unit.intUnitStatus == 3 || unit.intUnitStatus == 4){
                            unit.color = 'red';
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

                    if (data.block.intUnitType == 1){
                        data.block.strUnitType = 'Columbary Vaults';
                        data.block.icon = 'view_quilt';
                    }else{
                        data.block.strUnitType = 'Full Body Crypts';
                        data.block.icon = 'dashboard';
                    }

                    $scope.unitList = unitTable;
                    $scope.block    = data.block;
                    $scope.showUnit =   true;
                    swal.close();

                });

            }

        }

        $scope.openUnit = function(unit){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            Unit.get({id: unit.intUnitId}).$promise.then(function(data){

                $('#modalAddToCart').openModal();
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

                $scope.unit.show   =   true;
                angular.forEach($scope.reservationCart, function(unitCart){

                    if (unit.intUnitId == unitCart.intUnitId){

                        $scope.unit.show   =   false;

                    }

                });

                swal.close();

            });

        };

        $scope.buyUnitPrice = 0;
        $scope.reservation.totalUnitPrice = 0;
        $scope.addToCart = function(unitToBeAdded){

            $scope.reservationCart.push(unitToBeAdded);
            $scope.reservation.totalUnitPrice += parseFloat(unitToBeAdded.unitPrice.deciPrice);
            angular.forEach($scope.unitList, function(unitLevel){

                angular.forEach(unitLevel, function(unit){

                    if (unit.intUnitId == unitToBeAdded.intUnitId){
                        unit.color = 'grey';
                    }

                });

            });

            $('#modalAddToCart').closeModal();
            $scope.animation    =   'tada animated infinite';

        }

        $scope.removeToCart = function(unitToBeRemoved){

            $scope.reservation.totalUnitPrice -= parseFloat(unitToBeRemoved.unitPrice.deciPrice);
            angular.forEach($scope.reservationCart, function(unitCart, index){

                if(unitToBeRemoved.intUnitId    ==  unitCart.intUnitId){
                    $scope.reservationCart.splice(index, 1);
                }

            });

            angular.forEach($scope.unitList, function(unitLevel){

                angular.forEach(unitLevel, function(unit){

                    if (unit.intUnitId == unitToBeRemoved.intUnitId){
                        unit.color = 'green';
                    }

                });

            });

            $('#modalAddToCart').closeModal();

        }

        $scope.changeInterest = function(intTransactionType){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            angular.forEach($scope.reservationCart, function(reservation){

                if (reservation.interest != null) {
                    reservation.interest = null;
                }

            });

            if (intTransactionType == 2){

                Interests.query().$promise.then(function(data){

                    $scope.interestList = data.interestList;
                    $scope.interestList = $filter('orderBy')($scope.interestList, 'intNoOfYear', false);
                    swal.close();

                });

            }else if (intTransactionType == 3){

                InterestAtNeeds.query().$promise.then(function(data){

                    $scope.interestList = data.interestList;
                    $scope.interestList = $filter('orderBy')($scope.interestList, 'intNoOfYear', false);
                    swal.close();

                });

            }else if(intTransactionType == 1){
                swal.close();
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

                            $scope.lastTransaction                          =   data;
                            $scope.lastTransaction.cart                     =   $scope.reservationCart;
                            $scope.lastTransaction.customer                 =   $scope.reservation.strCustomerName;
                            $scope.lastTransaction.totalAmountToPay         =   0;
                            $scope.lastTransaction.intTransactionType       =   $scope.reservation.intTransactionType;

                            angular.forEach($scope.lastTransaction.cart, function(unit){

                                $scope.lastTransaction.totalAmountToPay += (parseFloat(computeMonthly(unit)*(unit.interest.intNoOfYear*12))+(parseFloat(unit.unitPrice.deciPrice)*parseFloat($scope.downpayment.deciBusinessDependencyValue)));

                            });

                            swal.close();
                            angular.forEach($scope.reservationCart, function(unitCart){

                                angular.forEach($scope.unitList, function(unitLevel){

                                    angular.forEach(unitLevel, function(unit){

                                        if (unit.intUnitId  ==  unitCart.intUnitId){

                                            unit.color  =   'blue';

                                        }

                                    });

                                });

                            });
                            $scope.reservationCart              =   [];
                            $scope.reservation                  =   {};
                            $scope.reservation.totalUnitPrice   =   0;
                            $('#availUnit').closeModal();
                            $('#receipt').openModal();
                            
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

            var data = {
                'strCustomerName'       :   $scope.reservation.strCustomerName,
                'deciAmountPaid'        :   $scope.reservation.deciAmountPaid,
                'unitList'              :   $scope.reservationCart,
                'intPaymentType'        :   $scope.reservation.intPaymentType
            }

            if (parseFloat($scope.reservation.deciAmountPaid) < parseFloat($scope.reservationCart.length * 3000)){
                swal('Oops!', 'Amount to pay is greater than amount paid.', 'error');
            }else {

                swal({
                        title: "Process At Need Transaction",
                        text: "Are you sure to process this transaction?",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#ffa500",
                        confirmButtonText: "Yes, process it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function () {

                        AtNeeds.save(data).$promise.then(function(data){

                            $scope.lastTransaction                          =   data;
                            $scope.lastTransaction.cart                     =   $scope.reservationCart;
                            $scope.lastTransaction.customer                 =   $scope.reservation.strCustomerName;
                            $scope.lastTransaction.totalAmountToPay         =   0;
                            $scope.lastTransaction.intTransactionType       =   $scope.reservation.intTransactionType;
                            $scope.lastTransaction.reservation              =   $scope.reservation;

                            angular.forEach($scope.lastTransaction.cart, function(unit){

                                $scope.lastTransaction.totalAmountToPay += (parseFloat(computeMonthly(unit)*(unit.interest.intNoOfYear*12))+(parseFloat(unit.unitPrice.deciPrice)*parseFloat($scope.downpayment.deciBusinessDependencyValue)));

                            });

                            swal.close();
                            angular.forEach($scope.reservationCart, function(unitCart){

                                angular.forEach($scope.unitList, function(unitLevel){

                                    angular.forEach(unitLevel, function(unit){

                                        if (unit.intUnitId  ==  unitCart.intUnitId){

                                            unit.color  =   'red';

                                        }

                                    });

                                });

                            });
                            $scope.reservationCart              =   [];
                            $scope.reservation                  =   {};
                            $scope.reservation.totalUnitPrice   =   0;
                            $('#availUnit').closeModal();
                            $('#receipt').openModal();

                        })
                            .catch(function(response){

                                if (response.status ==  500){
                                    swal(response.data.message, response.data.error, 'error');
                                }

                            });

                    });

            }

        }

        var buyUnitTransaction = function(){

            var data = {
                'strCustomerName'       :   $scope.reservation.strCustomerName,
                'deciAmountPaid'        :   $scope.reservation.deciAmountPaid,
                'unitList'              :   $scope.reservationCart,
                'intPaymentType'        :   $scope.reservation.intPaymentType
            }

            if (parseFloat($scope.reservation.deciAmountPaid) < parseFloat($scope.reservationCart.length * $scope.reservationFee)){
                swal('Oops!', 'Amount to pay is greater than amount paid.', 'error');
            }else {

                swal({
                        title: "Process Payment",
                        text: "Are you sure to process this payment?",
                        type: "warning", showCancelButton: true,
                        confirmButtonColor: "#ffa500",
                        confirmButtonText: "Yes, process it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    },
                    function () {

                        BuyUnits.save(data).$promise.then(function(data){

                            $scope.lastTransaction                          =   data;
                            $scope.lastTransaction.cart                     =   $scope.reservationCart;
                            $scope.lastTransaction.customer                 =   $scope.reservation.strCustomerName;
                            $scope.lastTransaction.totalAmountToPay         =   0;
                            $scope.lastTransaction.intTransactionType       =   $scope.reservation.intTransactionType;
                            $scope.lastTransaction.reservation             =   $scope.reservation;

                            console.log($scope.lastTransaction);
                            swal.close();
                            angular.forEach($scope.reservationCart, function(unitCart){

                                angular.forEach($scope.unitList, function(unitLevel){

                                    angular.forEach(unitLevel, function(unit){

                                        if (unit.intUnitId  ==  unitCart.intUnitId){

                                            unit.color  =   'red';

                                        }

                                    });

                                });

                            });
                            $scope.reservationCart              =   [];
                            $scope.reservation                  =   {};
                            $scope.reservation.totalUnitPrice   =   0;
                            $('#availUnit').closeModal();
                            $('#receipt').openModal();

                        })
                            .catch(function(response){

                                if (response.status == 500){

                                    swal(response.data.message, response.data.error, 'error');

                                }

                            });

                    });

            }

        }

        $scope.processTransaction = function(){

            if ($scope.reservation.intTransactionType == 2){

                reservationTransaction();

            }else if ($scope.reservation.intTransactionType == 3){

                atNeedTransaction();

            }else if ($scope.reservation.intTransactionType == 1){

                buyUnitTransaction();

            }

        }

        $scope.viewUnitDetail         =   function(unit){

            $scope.unitView     =   unit;
            $('#unitDetails').openModal();

        }

        var computeMonthly      =   function(unit){

            var downpayment =   parseFloat(unit.unitPrice.deciPrice)*parseFloat($scope.downpayment.deciBusinessDependencyValue);
            var balance     =   parseFloat(unit.unitPrice.deciPrice)-parseFloat(downpayment);
            var monthlyAmortization     =   (parseFloat(balance)+((parseFloat(balance)*parseFloat(unit.interest.interestRate.deciInterestRate))*parseFloat(unit.interest.intNoOfYear)))/(parseFloat(unit.interest.intNoOfYear)*parseFloat(12));

            return monthlyAmortization;

        }

        $scope.getMonthly       =   function(unit){

            var monthly     =   computeMonthly(unit);
            angular.forEach($scope.reservationCart, function(unitCart){

                if (unitCart.intUnitId  ==  unit.intUnitId){
                    unit.monthly    =   monthly;
                }

            });

        }

        $scope.saveCustomer     =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            if (update){

                update  =   false;
                CustomerUpdate.update({id: $scope.customer.intCustomerId}, $scope.customer).$promise.then(function(data){

                    angular.forEach($scope.customerList, function(customer, index){

                        if ($scope.customer.intCustomerId == customer.intCustomerId){
                            $scope.customerList.splice(index, 1);
                        }

                    });

                    $scope.customerList.push(data);
                    $scope.customerList =   $filter('orderBy')($scope.customerList, 'strFullName', false);
                    $scope.customer =   null;
                    swal('Success!', 'Customer is successfully updated.', 'success');
                    $('#newCustomer').closeModal();
                    $scope.reservation.strCustomerName  =   data.strFullName;

                });

            }else{

                Customers.save($scope.customer).$promise.then(function(data){

                    $scope.customerList.push(data);
                    $scope.customerList =   $filter('orderBy')($scope.customerList, 'strFullName', false);
                    swal('Success!', 'Customer is successfully added.', 'success');
                    $scope.customer     =   null;
                    $('#newCustomer').closeModal();
                    $scope.reservation.strCustomerName  =   data.strFullName;

                });

            }

        }

        var update  =   false;
        $scope.getCustomer      =   function(customerName){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            CustomerGet.get({strCustomerName:customerName}).$promise.then(function(data){

                $scope.customer =   data.customer;
                update  =   true;
                swal.close();

            });

        }

        $scope.generateReceipt      =   function(id){



        }

    });