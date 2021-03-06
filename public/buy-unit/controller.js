/**
 * Created by kenlayug on 6/14/16.
 */
angular.module('app')
    .controller('ctrl.unit-purchase', function($scope, $rootScope, $resource, appSettings,
     $filter, $window, TransactionUnit, AssignDiscount, Customer, Building){

        $rootScope.unitPurchaseActive = 'active';
        $rootScope.transactionActive    =   'active';

        $scope.dateNow          =   moment();

        var rs              =   $rootScope;
        var color           =   [
            'orange darken-1',
            'green darken-3',
            'blue darken-3',
            'red darken-3',
            'yellow darken-2',
            'blue darken-3',
            'pink darken-3',
            'yellow darken-2'
            ];
        var status          =   [
            'Deactivated',
            'Available', 
            'Reserved', 
            'Owned', 
            'At Need', 
            'Reserved',
            'Partially Owned',
            'At Need'
            ];

        $scope.transactionList        =   [
            '',
            '',
            'Reservation',
            'Spotcash',
            'At Need'
        ];

        var CustomerResource    =   Customer;

        $scope.dateNow          =   moment().format('MM/DD/YYYY');

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

        var CustomerGet =   $resource(appSettings.baseUrl+'v1/customer/:id/show', {}, {
            get :   {
                method  :   'GET',
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

        Building.query().$promise.then(function(data){

            $scope.buildingList         =   $filter('orderBy')(data, 'strBuildingName', false);

        });

        Customers.query().$promise.then(function(customers){

            $scope.customerList = customers;
            $scope.customerList = $filter('orderBy')($scope.customerList, 'strFullName', false);

        });

        UnitType.query().$promise.then(function(data){

            $scope.unitTypeList =   $filter('orderBy')(data.roomTypeList, 'strUnitTypeName', false);
            rs.displayPage();

        });

        BusinessDependency.get({name: 'reservationFee'}).$promise.then(function(data){

            $scope.reservationFee   =   data.businessDependency;

        });

        BusinessDependency.get({name: 'downpayment'}).$promise.then(function(data){

            $scope.downpayment      =   data.businessDependency;

        });

        AssignDiscount.get({id : 1}).$promise.then(function(data){

            $scope.discountPayOnce      =   data.assignDiscountList;

        });

        BusinessDependency.get({name: 'pcf'}).$promise.then(function(data){

            $scope.pcf      =   data.businessDependency;

        });

        BusinessDependency.get({name: 'voidReservationNotFullPayment'}).$promise.then(function(data){

            $scope.voidReservationNotFullPayment      =   data.businessDependency;

        });

        $scope.getBlocks = function(unitTypeId, index){

            if ($scope.unitTypeList[index].blockList    ==  null) {

                rs.loading          =   true;

                Blocks.query({id: unitTypeId}).$promise.then(function (data) {

                    angular.forEach(data.blockList, function(block){

                        block.color = 'orange';

                    });
                    $scope.unitIndex = index;
                    $scope.unitTypeList[index].blockList = data.blockList;
                    rs.loading          =   false;

                });

            }

        }

        $scope.getUnits = function(block, intBlockIndex){

            if ($scope.block == null || $scope.block.intBlockId != block.intBlockId){

                if ($scope.lastSelected != null){

                    $scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';

                }

                rs.loading          =   true;

                Units.get({id: block.intBlockId}).$promise.then(function(data){

                    var unitTable = [];
                    var intLevelNoPrev = 0;
                    var intLevelNoCurrent = 0;
                    var unitList = [];
                    var levelLetter =   64;

                    $scope.blockName    =   block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo;

                    angular.forEach(data.unitList, function(unit, index){

                        unit.color      =   color[unit.intUnitStatus];
                        unit.strUnitStatus  =   status[unit.intUnitStatus];
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

                    $scope.unitStatusCount          =   data.unitStatusCount;

                    $scope.unitList = unitTable;
                    $scope.block    = data.block;
                    $scope.showUnit =   true;
                    swal.close();
                    $scope.unitTypeList[$scope.unitIndex].blockList[intBlockIndex].color = 'orange darken-3';

                    $scope.lastSelected = {};
                    $scope.lastSelected.unitType = $scope.unitIndex;
                    $scope.lastSelected.block   =   intBlockIndex;

                    rs.loading          =   false;

                });

            }

        }

        $scope.openUnit = function(unit){

            rs.loading          =   true;

            Unit.get({id: unit.intUnitId}).$promise.then(function(data){

                $('#modalAddToCart').openModal();
                if (data.unit.strMiddleName == null){
                    data.unit.strMiddleName = '';
                }
                data.unit.display       =   String.fromCharCode(parseInt(64)+parseInt(data.unit.intLevelNo))+data.unit.intColumnNo;
                $scope.unit = data.unit;
                $scope.unit.strUnitStatus = status[$scope.unit.intUnitStatus];

                $scope.unit.show   =   true;
                angular.forEach($scope.reservationCart, function(unitCart){

                    if (unit.intUnitId == unitCart.intUnitId){

                        $scope.unit.show   =   false;

                    }

                });

                rs.loading          =   false;

            });

        };

        $scope.buyUnitPrice = 0;
        $scope.reservation.totalUnitPrice = 0;
        $scope.addToCart = function(unitToBeAdded){

            $scope.reservation.totalUnitPrice += parseFloat(unitToBeAdded.unitPrice.deciPrice);
            angular.forEach($scope.unitList, function(unitLevel){

                angular.forEach(unitLevel, function(unit){

                    if (unit.intUnitId == unitToBeAdded.intUnitId){
                        unit.color = 'grey';
                        unitToBeAdded.display       =   unit.display;
                    }

                });

            });
            $scope.reservationCart.push(unitToBeAdded);

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
                        unit.color = color[1];
                    }

                });

            });

            $('#modalAddToCart').closeModal();

        }

        $scope.changeInterest = function(intTransactionType){

            rs.loading          =   true;

            angular.forEach($scope.reservationCart, function(reservation){

                if (reservation.interest != null) {
                    reservation.interest = null;
                }

            });

            if (intTransactionType == 2){

                Interests.query().$promise.then(function(data){

                    $scope.interestList = data.interestList;
                    $scope.interestList = $filter('orderBy')($scope.interestList, 'intNoOfYear', false);
                    rs.loading          =   false;

                });

            }else if (intTransactionType == 4){

                InterestAtNeeds.query().$promise.then(function(data){

                    $scope.interestList = data.interestList;
                    $scope.interestList = $filter('orderBy')($scope.interestList, 'intNoOfYear', false);
                    rs.loading          =   false;

                });

            }else if(intTransactionType == 3){
                rs.loading          =   false;
                $scope.deciTotalDiscount         =   0;
                angular.forEach($scope.reservationCart, function(unit){

                    unit.deciDiscount           =   0;

                    angular.forEach($scope.discountPayOnce, function(discount){

                        if (discount.discount_rate.intDiscountType == 1){

                            unit.deciDiscount   +=  parseFloat(unit.unitPrice.deciPrice * discount.discount_rate.deciDiscountRate);

                        }//end if
                        else{

                            unit.deciDiscount    +=   parseFloat(discount.discount_rate.deciDiscountRate);

                        }//end else
                        $scope.deciTotalDiscount += unit.deciDiscount;

                    });

                });
                console.log($scope.reservationCart);
            }//end if

        }//end function

        $scope.setInterest = function(index){

            $('#modalInterest').openModal();
            $scope.interestIndex = index;

        }

        var reservationTransaction = function(){

            var intCustomerId       =   0;
            angular.forEach($scope.customerList, function(customer){

                var strCustomerName     =   customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;
                if ($scope.reservation.strCustomerName == strCustomerName){

                    intCustomerId       =   customer.intCustomerId;

                }

            });

            var data = {
                'intCustomerId'         :   intCustomerId,
                'deciAmountPaid'        :   $scope.reservation.deciAmountPaid,
                'unitList'              :   $scope.reservationCart
            }

            if (parseFloat($scope.reservation.deciAmountPaid) < parseFloat($scope.reservationCart.length * $scope.reservationFee.deciBusinessDependencyValue)){
                swal('Oops!', 'Amount to pay is greater than amount paid.', 'error');
            }else {

                rs.loading          =   true;
                Reservations.save(data).$promise.then(function (data) {

                    $scope.lastTransaction                          =   data;
                    $scope.lastTransaction.cart                     =   $scope.reservationCart;
                    $scope.lastTransaction.customer                 =   $scope.reservation.strCustomerName;
                    $scope.lastTransaction.totalAmountToPay         =   0;
                    $scope.lastTransaction.intTransactionType       =   $scope.reservation.intTransactionType;

                    angular.forEach($scope.lastTransaction.cart, function(unit){

                        $scope.lastTransaction.totalAmountToPay += (parseFloat(computeMonthly(unit)*(unit.interest.intNoOfYear*12))+(parseFloat(unit.unitPrice.deciPrice)*parseFloat($scope.downpayment.deciBusinessDependencyValue)));

                    });

                    rs.loading          =   false;
                    angular.forEach($scope.reservationCart, function(unitCart){

                        angular.forEach($scope.unitList, function(unitLevel){

                            angular.forEach(unitLevel, function(unit){

                                if (unit.intUnitId  ==  unitCart.intUnitId){

                                    unit.color  =   color[2];

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

                        rs.loading          =   false;
                        if (response.status == 500) {
                            swal(response.data.message, response.data.error, 'error');
                        }

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

            if (parseFloat($scope.reservation.deciAmountPaid) < parseFloat($scope.reservation.totalUnitPrice * $scope.pcf.deciBusinessDependencyValue)){
                swal('Oops!', 'Amount to pay is greater than amount paid.', 'error');
            }else {

                rs.loading          =   true;
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

                    rs.loading          =   false;
                    angular.forEach($scope.reservationCart, function(unitCart){

                        angular.forEach($scope.unitList, function(unitLevel){

                            angular.forEach(unitLevel, function(unit){

                                if (unit.intUnitId  ==  unitCart.intUnitId){

                                    unit.color  =   color[4];

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

                        rs.loading          =   false;
                        if (response.status ==  500){
                            swal(response.data.message, response.data.error, 'error');
                        }

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

            if (parseFloat($scope.reservation.deciAmountPaid) < parseFloat($scope.reservation.totalUnitPrice-($scope.reservation.totalUnitPrice*$scope.discountPayOnce.deciBusinessDependencyValue))){
                swal('Oops!', 'Amount to pay is greater than amount paid.', 'error');
            }else {

                BuyUnits.save(data).$promise.then(function(data){

                    $scope.lastTransaction                          =   data;
                    $scope.lastTransaction.cart                     =   $scope.reservationCart;
                    $scope.lastTransaction.customer                 =   $scope.reservation.strCustomerName;
                    $scope.lastTransaction.totalAmountToPay         =   0;
                    $scope.lastTransaction.intTransactionType       =   $scope.reservation.intTransactionType;
                    $scope.lastTransaction.reservation             =   $scope.reservation;

                    rs.loading          =   false;
                    angular.forEach($scope.reservationCart, function(unitCart){

                        angular.forEach($scope.unitList, function(unitLevel){

                            angular.forEach(unitLevel, function(unit){

                                if (unit.intUnitId  ==  unitCart.intUnitId){

                                    unit.color  =   color[3];

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

            }

        }

        $scope.processTransaction = function(){

            var intCustomerId = 0;
            angular.forEach($scope.customerList, function(customer){

                if (customer.strMiddleName == null){
                    customer.strMiddleName = '';
                }

                var strCustomerName     =   customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;
                strCustomerName         =   strCustomerName.trim();
                if ($scope.reservation.strCustomerName == strCustomerName){

                    intCustomerId       =   customer.intCustomerId;

                }

            });

            var data = {
                'intCustomerId'         :   intCustomerId,
                'deciAmountPaid'        :   $scope.reservation.deciAmountPaid,
                'unitList'              :   $scope.reservationCart,
                'intTransactionType'    :   $scope.reservation.intTransactionType,
                'intPaymentType'        :   $scope.reservation.intPaymentType,
                'cheque'                :   $scope.reservation.cheque
            }

            var transactionUnit         =   new TransactionUnit(data);
            transactionUnit.$save(function(data){

                rs.loading          =   false;
                $scope.unitStatusCount[$scope.reservation.intTransactionType] += $scope.reservationCart.length;
                angular.forEach($scope.reservationCart, function(unitCart){

                    angular.forEach($scope.unitList, function(unitLevel){

                        angular.forEach(unitLevel, function(unit){

                            if (unit.intUnitId  ==  unitCart.intUnitId){

                                unit.color  =   color[$scope.reservation.intTransactionType];
                                unit.strUnitStatus  =   status[$scope.reservation.intTransactionType];
                                unit.strCustomerName    =   $scope.reservation.strCustomerName;

                            }

                        });

                    });

                });
                $scope.reservation                  =   {};
                $scope.reservation.totalUnitPrice   =   0;
                $('#availUnit').closeModal();
                $('#receipt').openModal();
                $scope.lastTransaction                      =   data.transactionUnit;
                $scope.lastTransaction.intTransactionType   =   data.transactionType;
                $scope.lastTransaction.detailList           =   data.transactionUnitDetailList;
                $scope.lastTransaction.cartList             =   $scope.reservationCart;
                if ($scope.lastTransaction.strMiddleName == null){
                    $scope.lastTransaction.strMiddleName = '';
                }
                $scope.reservationCart              =   [];
                $scope.lastTransaction.deciTotalUnitPrice   =   0;
                angular.forEach(data.transactionUnitDetailList, function(unit){
                    $scope.lastTransaction.deciTotalUnitPrice   +=  unit.deciPrice;
                });
                $scope.lastTransaction.deciTotalDiscount        =   $scope.deciTotalDiscount;

                CustomerResource.get({type : 'units'}).$promise.then(function(data){

                    angular.forEach(data.customerList, function(customer){

                        if (customer.strMiddleName == null){

                            customer.strMiddleName      =   '';

                        }//end if

                    });
                    $scope.customerUnitList         =   $filter('orderBy')(data.customerList, ['strLastName', 'strFirstName', 'strMiddleName'], false);

                });

            },
                function(response){

                    if (response.status == 500){

                        swal('Error!', response.data.message, 'error');

                    }

                });

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

            rs.loading          =   true;

            if (update){

                update  =   false;
                rs.loading          =   true;
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
                    rs.loading          =   false;

                });

            }else{

                rs.loading          =   true;
                Customers.save($scope.customer).$promise.then(function(data){

                    $scope.customerList.push(data);
                    $scope.customerList =   $filter('orderBy')($scope.customerList, 'strFullName', false);
                    swal('Success!', 'Customer is successfully added.', 'success');
                    $scope.customer     =   null;
                    $('#newCustomer').closeModal();
                    $scope.reservation.strCustomerName  =   data.strFullName;
                    rs.loading          =   false;

                });

            }

        }

        var update  =   false;
        $scope.getCustomer      =   function(){

            rs.loading          =   true;
            var intCustomerId   =   0;

            angular.forEach($scope.customerList, function(customer){

                if (customer.strMiddleName == null){
                    customer.strMiddleName = '';
                }
                var strCustomerName     =   customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;
                console.log($scope.reservation.strCustomerName);
                console.log(strCustomerName);
                if ($scope.reservation.strCustomerName == strCustomerName){

                    intCustomerId       =   customer.intCustomerId;

                }

            });

            CustomerGet.get({id : intCustomerId}).$promise.then(function(data){

                $scope.customer =   data;
                console.log(data);
                update  =   true;
                rs.loading          =   false;

            })
                .catch(function(response){

                    rs.loading          =   false;
                    if (response.status == 404){
                        swal(response.data.message, response.data.error, 'error');
                        $('#newCustomer').closeModal();
                    }
                    
                });

        }

        $scope.generateReceipt      =   function(id){

            $window.open('http://localhost:8000/pdf/unit-purchase-success/'+id);

        }//end function

        $scope.cancelReservation        =   function(unitTo){

            var transactionUnit         =   new TransactionUnit({id : unitTo.intUnitId});
            transactionUnit.$delete(function(data){

                swal('Success!', data.message, 'success');
                $('#modalAddToCart').closeModal();
                angular.forEach($scope.unitList, function(unitLevel){

                    angular.forEach(unitLevel, function(unit){

                        if (unit.intUnitId  ==  unitTo.intUnitId){

                            unit.color  =   color[1];

                        }

                    });

                });


            });

        }//end function

        $scope.switchAvailType              =   function(unit){

            unit.deciDiscount           =   0;
            console.log(unit);

            angular.forEach($scope.discountPayOnce, function(discount){

                if (discount.discount_rate.intDiscountType == 1){

                    unit.deciDiscount   +=  parseFloat(unit.unitPrice.deciPrice * discount.discount_rate.deciDiscountRate);

                }//end if
                else{

                    unit.deciDiscount    +=   parseFloat(discount.discount_rate.deciDiscountRate);

                }//end else

            });
            $scope.switchDeciTotalDiscount = unit.deciDiscount;

            $scope.unit                     =   unit;

            TransactionUnit.get({id : unit.intUnitId}).$promise.then(function(data){

                $scope.unitDetail               =   data.transactionUnitDetail;
                InterestAtNeeds.query().$promise.then(function(data){

                    $scope.interestList             =   $filter('orderBy')(data.interestList, 'intNoOfYear', false);

                });

            });

        }//end function

        $scope.switchType                   =   function(intTransactionType){

            $scope.switch                   =   null;
            $scope.switch                   =   {
                intTransactionType          :   intTransactionType
            };

        }//end function

        $scope.processSwitchAvailType       =   function(){

            $scope.switch.cheque            =   $scope.reservation.cheque;

            TransactionUnit.update({id : $scope.unitDetail.intUnitId}, $scope.switch).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                angular.forEach($scope.unitList, function(unitLevel){

                    angular.forEach(unitLevel, function(unit){

                        if (unit.intUnitId  ==  $scope.unitDetail.intUnitId){

                            unit.color  =   color[$scope.switch.intTransactionType];

                        }

                    });

                });
                $scope.reservation.cheque   =   null;
                $scope.switch               =   null;
                $scope.unitDetail           =   null;
                $('#switch').closeModal();
                $('#modalAddToCart').closeModal();


            })
                .catch(function(response){

                    if (response.status == 500){

                        swal('Error!', response.data.message, 'error');

                    }//end if

                });


        }//end function

        CustomerResource.get({type : 'units'}).$promise.then(function(data){


            angular.forEach(data.customerList, function(customer){

                if (customer.strMiddleName == null){

                    customer.strMiddleName      =   '';

                }//end if

            });
            $scope.customerUnitList         =   $filter('orderBy')(data.customerList, ['strLastName', 'strFirstName', 'strMiddleName'], false);

        });

        $scope.openPurchasedUnit            =   function(customer){

            CustomerResource.get({id : customer.intCustomerId, type : 'units'}).$promise.then(function(data){

                angular.forEach(data.unitList, function(unit){

                    unit.display    =   String.fromCharCode(parseInt(64)+parseInt(unit.intLevelNo))+unit.intColumnNo;


                });

                $scope.purchasedUnitList        =   $filter('orderBy')(data.unitList, ['strBuildingName',
                 'intFloorNo', 'strRoomName', 'intBlockNo', 'intLevelNo', 'intColumnNo'], false);
                $scope.customer                 =   customer;
                $('#purchaseduUnit').openModal();

            });

        }//end function

        $scope.closeBlock           =   function(){

            $scope.showUnit         =   false;
            $scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';
            $scope.lastSelected     =   null;
            $scope.block            =   null;

        }//end function

        $scope.addCheque            =   function(cheque){

            var validate        =   false;
            var message         =   null;

            if (cheque.strBankName == null || cheque.strBankName == ''){

                validate            =   true;
                message             =   'Bank name cannot be blank.';

            }//end if
            else if (cheque.strReceiver == null || cheque.strReceiver == ''){

                validate            =   true;
                message             =   'Receiver cannot be blank.';

            }//end else if
            else if (cheque.strChequeNo == null || cheque.strChequeNo == ''){

                validate            =   true;
                message             =   'Cheque number cannot be blank.';

            }//end else if
            else if (cheque.dateCheque == null){

                validate            =   true;
                message             =   'Cheque date cannot be blank.';

            }//end else if
            else if (new Date(cheque.dateCheque) > new Date()){

                validate            =   true;
                message             =   'Post-dated cheques are not allowed.';

            }//end else if

            if (validate){

                swal('Error!', message, 'error');

            }//end if
            else{

                $scope.reservation.cheque       =   cheque;
                cheque                  =   null;
                $('#cheque').closeModal();

            }//end else

        }//end function

        $scope.age          =   0;
        $scope.computeAge           =   function(dateBirthday){
            
            $scope.age          =   moment().diff(moment(dateBirthday), 'years');

        }//end function

    });