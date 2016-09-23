angular.module('app')
    .controller('ctrl.collection', function($scope, $rootScope, $resource, $filter, $window,
     appSettings, DTOptionsBuilder, $timeout, Customer, Unit){

        $rootScope.collectionActive     =   'active';
        $rootScope.transactionActive    =   'active';
        var rs = $rootScope;
        var vm  =   $scope;
        $scope.collection               =   {
            checkAll            :   false
        };

        var CustomerResource            =   Customer;

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withDisplayLength(6);

        var DowpaymentNotification  =   $resource(appSettings.baseUrl+'v2/downpayments/:method', {
            method      :       '@method'
        });

        var CustomersWithCollection = $resource(appSettings.baseUrl+'v2/customers/collections', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var CustomersWithDownpayment = $resource(appSettings.baseUrl+'v2/customers/downpayments', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Customers               =   $resource(appSettings.baseUrl+'v1/customer/:id/show', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Collections = $resource(appSettings.baseUrl+'v2/customers/:id/collections', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Payments = $resource(appSettings.baseUrl+'v3/collections/:id/payments', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var CollectionPayment = $resource(appSettings.baseUrl+'v2/collections/:id', {}, {
            save: {
                method: 'PUT',
                isArray: false
            }
        });

        var Downpayments = $resource(appSettings.baseUrl+'v2/customers/:id/downpayments', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var DownpaymentPayments  =   $resource(appSettings.baseUrl+'v2/downpayments/:id/payments', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Downpayment = $resource(appSettings.baseUrl+'v2/downpayments', {}, {
            save: {
                method: 'POST',
                isArray: false
            }
        });

        var DeleteDownpayment = $resource(appSettings.baseUrl+'v2/downpayments/due-dates', {}, {
            update: {
                method: 'POST'
            }
        });
        
        var DeleteCollection    =   $resource(appSettings.baseUrl+'v2/collections/due-dates', {}, {
            update  :   {
                method  :   'POST'
            }
        });

        var update = function() {
            $timeout(function() {
                DeleteDownpayment.update();
                DeleteCollection.update();
                update();
            }, 1*60*60*1000);
        };
        update();

        var sendNotifications          =   function(){

            var downpaymentWarning     =   new DownpaymentNotification();
            downpaymentWarning.$save({ method : 'warning'});

        }//end function

        DeleteDownpayment.update().$promise.then(function(data){

            CustomersWithDownpayment.query().$promise.then(function(data){

                $scope.downpaymentCustomerList  =   $filter('orderBy')(data.customerList, 'strFullName', false);

                DeleteCollection.update().$promise.then(function(data){

                    CustomersWithCollection.query().$promise.then(function(collectionData){

                        $scope.collectionCustomerList   =   $filter('orderBy')(collectionData.customerList, 'strFullName', false);
                        rs.displayPage(); 

                    });

                });

            });

        });

        CustomerResource.get({type : 'collectibles'}).$promise.then(function(data){

            angular.forEach(data.customerList, function(customer){

                if (customer.strMiddleName == null){
                    customer.strMiddleName          =   '';
                }//end if

                customer.strFullName    =   customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;

            });

            vm.customerList             =   $filter('orderBy')(data.customerList, ['strLastName', 'strFirstName', 'strMiddleName'], false);
            vm.filterCustomerList       =   [];

            angular.forEach(vm.customerList, function(customer){

                if (customer.deciDownpaymentCollectible != 0){
                    vm.filterCustomerList.push(customer);
                }else if (customer.deciCollectionCollectible != 0){
                    vm.filterCustomerList.push(customer);
                }//end else if
                else if (customer.deciPreNeedCollectible != 0){
                    vm.filterCustomerList.push(customer);
                }//end else if

            });

        });

        $scope.getReservations = function(customerId, customerName, index){

            rs.loading          =   true;
            Reservations.query({id: customerId}).$promise.then(function(data){

                $scope.reservationList = data.reservationList;
                $scope.customer = {};
                $scope.customer.strFullName = customerName;
                $scope.customer.intCustomerId = customerId;
                $scope.customer.index = index;
                $('#downpayment').openModal();
                rs.loading          =   false;

            });

        }

        $scope.openCollect = function(intDownpaymentId, downpayment, index){

            rs.loading          =   true;
            DownpaymentPayments.query({id: intDownpaymentId}).$promise.then(function(data){

                $scope.downpaymentPaymentList = data.paymentList;
                $scope.downpayment = {};
                $scope.downpayment.balance = data.balance;
                $scope.downpayment.intDownpaymentId = intDownpaymentId;
                $scope.downpayment.index = index;
                $scope.downpayment.detail   =   downpayment;
                $('#downPaymentForm').openModal();
                rs.loading          =   false;

            });

        }

        $scope.processDownpayment = function(intDownpaymentId, index){

            $scope.newPayment.intDownpaymentId = intDownpaymentId;

            rs.loading          =   true;
            Downpayment.save($scope.newPayment).$promise.then(function(data){

                rs.loading          =   false;
                $scope.downpaymentTransaction   =   data;
                $scope.downpaymentTransaction.balance   =   $scope.downpayment.detail.deciBalance;
                $scope.downpaymentPaymentList.push(data.downpayment);
                $scope.downpaymentPaymentList = $filter('orderBy')($scope.downpaymentPaymentList, 'created_at', false);
                var balance     =   $scope.downpayment.detail.deciBalance-data.downpayment.deciAmountPaid;
                $scope.downpaymentTransaction.prevBalance   =   balance + data.downpayment.deciAmountPaid;
                $scope.downpaymentList[$scope.downpayment.index].deciBalance = balance;

                if (data.paid){

                    $('#downPaymentForm').closeModal();

                    CustomerResource.get({id : $scope.customer.intCustomerId, type : 'collectibles'}).$promise.then(function(data){

                        vm.collectionList           =   data.collectionList;
                        vm.downpaymentList          =   data.downpaymentList;
                        vm.preNeedCollectionList    =   data.preNeedCollectionList;

                    });

                    $scope.customerList[$scope.customer.index].deciDownpaymentCollectible   -=  
                        $scope.downpaymentTransaction.prevBalance;

                }else{

                    $scope.customerList[$scope.customer.index].deciDownpaymentCollectible   -=  data.downpayment.deciAmountPaid;

                }//end else
                $('#generateReceiptDownpayment').openModal();
                $scope.newPayment   =   null;

            });

        }

        $scope.getCollections = function(customer, index){

            rs.loading          =   true;
            CustomerResource.get({id : customer.intCustomerId, type : 'collectibles'}).$promise.then(function(data){

                vm.collectionList       =   data.collectionList;
                vm.downpaymentList      =   data.downpaymentList;
                vm.preNeedCollectionList    =   data.preNeedCollectionList;
                customer.index          =   index;
                customer.strFullName    =   customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;
                vm.customer             =   customer;
                rs.loading              =   false;
                $('#collection').openModal();

            });

        }//end function

        var collectionToPay = {};

        $scope.getPayments = function(collection, index){

            rs.loading          =   true;
            Payments.query({id: collection.intCollectionId}).$promise.then(function(data){

                angular.forEach(data.paymentList, function(payment, index){

                    if (index != 0 && data.paymentList[index-1].boolPaid != 1){

                        payment.disable             =   true;

                    }//end if

                });
                $scope.paymentList      =   data.paymentList;
                $scope.collection       =   collection;
                $scope.collection.index =   index;
                collectionToPay.id           =   collection.intCollectionId;

                $('#collectionForm').openModal();
                rs.loading          =   false;

            });

        }

        $scope.processCollection = function(){

            var validate        =   false;
            var message         =   null

            if ($scope.deciTotalAmountToPay > $scope.collectionTransaction.deciAmountPaid){

                validate        =   true;
                message         =   'Amount to pay is greater than amount paid.';

            }//end if

            if ($scope.collectionTransaction.intPaymentType == 2){
                
                if ($scope.collectionTransaction.cheque == null){

                    validate    =   true;
                    message     =   'Cheque info is required.';

                }//end if

            }//end function

            if (validate){

                swal('Error!', message, 'error');

            }else {

                if ($scope.collectionTransaction.deciAmountPaid > $scope.deciTotalAmountToPay){

                    swal({
                        title: "Amount Paid is more than amount to pay",   
                        text: "Do you want to get your change or add it to your next transaction?",   
                        type: "warning",   showCancelButton: true,   
                        confirmButtonColor: "#ffa500",   
                        confirmButtonText: "Get my change.",    
                        cancelButtonText: "Add to the next transaction",
                        closeOnConfirm: false,   
                        showLoaderOnConfirm: true, }, 
                        function(isConfirm){

                            if (isConfirm){
                                $scope.collectionTransaction.intBalance         =   1;
                            }else{
                                $scope.collectionTransaction.intBalance         =   0;
                            }//end if else
                            processCollection();
                            swal.close();

                    });

                }//end if
                else {
                    processCollection();
                }//end else

            }//end else

        }//end function

        var processCollection               =   function(){

            $scope.collectionTransaction.collectionListToPay        =   $scope.collectionListToPay;
            rs.loading          =   true;
            CollectionPayment.save({id: collectionToPay.id}, $scope.collectionTransaction).$promise.then(function(data){

                if (data.strServiceName != null){

                    vm.serviceCollect       =   {
                        strServiceName      :   data.strServiceName,
                        deciServicePrice    :   data.deciServicePrice
                    };

                }//end if
                else if (data.strPackageName != null){

                    vm.packageCollect       =   {
                        strPackageName      :   data.strPackageName,
                        deciPackagePrice    :   data.deciPackagePrice
                    };

                }//end else if

                angular.forEach($scope.collectionTransaction.collectionListToPay, function(collectionToPay){

                    var index           =   $scope.paymentList.indexOf(collectionToPay);

                    $scope.paymentList[index].boolPaid          =   1;
                    $scope.paymentList[index].datePayment       =   data.datePayment;
                    $scope.paymentList[index].selected          =   false;

                    if (data.unit == null){

                        $scope.preNeedCollectionList[$scope.collection.index].intMonthsPaid++;

                        if ($scope.preNeedCollectionList[$scope.collection.index].deciCollectible != 0){

                            if ($scope.customerList[$scope.customer.index].deciPreNeedCollectible != 0){

                                $scope.customerList[$scope.customer.index].deciPreNeedCollectible        -=
                                    parseFloat($scope.paymentList[index].deciMonthlyAmortization + $scope.paymentList[index].penalty);

                            }//end if
                            $scope.preNeedCollectionList[$scope.collection.index].deciCollectible        -=
                                parseFloat($scope.paymentList[index].deciMonthlyAmortization + $scope.paymentList[index].penalty);

                        }//end if

                    }//end if
                    else{

                        $scope.collectionList[$scope.collection.index].intMonthsPaid++;

                        if ($scope.collectionList[$scope.collection.index].deciCollectible != 0){

                            if ($scope.customerList[$scope.customer.index].deciCollectionCollectible != 0){

                                $scope.customerList[$scope.customer.index].deciCollectionCollectible        -=
                                    parseFloat($scope.paymentList[index].deciMonthlyAmortization + $scope.paymentList[index].penalty);

                            }//end if
                            $scope.collectionList[$scope.collection.index].deciCollectible        -=
                                parseFloat($scope.paymentList[index].deciMonthlyAmortization + $scope.paymentList[index].penalty);

                        }//end if

                    }//end else
                    

                });//end foreach
                
                $scope.lastTransaction                              =   data;
                $scope.lastTransaction.collectionDetail             =   $scope.collectionToPay;
                $('#pay').closeModal();
                $('#generateReceiptCollection').openModal();
                rs.loading          =   false;
                $scope.collectionTransaction                =   null;

            })
                .catch(function(response){

                    rs.loading          =   false;
                   if (response.status == 500){

                       swal(response.data.message, response.data.error, 'error');

                   }

                });

        }//end function

        $scope.openPayCollection            =   function(){

            var collectionListToPay         =   [];
            var deciTotalAmountToPay        =   0;
            angular.forEach($scope.paymentList, function(payment){

                if (payment.selected){

                    collectionListToPay.push(payment);
                    var deciAmountToPay         =   payment.penalty+payment.deciMonthlyAmortization;
                    deciTotalAmountToPay        +=  deciAmountToPay;

                }

            });
            $scope.collectionListToPay          =   collectionListToPay;
            $scope.deciTotalAmountToPay         =   deciTotalAmountToPay;
            $scope.dateNow  =   new Date();

        }

        $scope.getDownpayments              =   function(intCustomerId, strCustomerName, index){

            Downpayments.query({id: intCustomerId}).$promise.then(function(data){

                $scope.downpaymentList = data.downpaymentList;
                $scope.customer = {};
                $scope.customer.strFullName = strCustomerName;
                $scope.customer.intCustomerId = intCustomerId;
                $scope.customer.index = index;
                $('#downpayment').openModal();

            });

        }

        $scope.toggleAll                =   function(toggle){

            var prevPayment             =   null;
            angular.forEach($scope.paymentList, function(payment, index){

                if (payment.boolPaid != 1){

                    payment.selected = toggle;

                    if (toggle){

                        payment.disable         =   false;

                    }//end if
                    else{

                        if (prevPayment != null && prevPayment.boolPaid != 1){

                            payment.disable     =   true;

                        }//end if
                        else{

                            payment.disable     =   false;

                        }//end else

                    }//end else

                }//end if

                prevPayment             =   payment;

            });

        }//end function

        $scope.generateDownpaymentReceipt           =   function(intDownpaymentPaymentId){

            $window.open('http://localhost:8000/pdf/downpayments-success/'+intDownpaymentPaymentId);

        }//end function

        $scope.generateCollectionReceipt           =   function(intCollectionPaymentId){

            $window.open('http://localhost:8000/pdf/collections-success/'+intCollectionPaymentId);

        }//end function

        $scope.checkPayment                         =   function(payment, index){

            if (payment.selected == false){

                $scope.collection.checkAll           =   false;

                for(var intCtr = index+1; intCtr < $scope.paymentList.length; intCtr++){

                    $scope.paymentList[intCtr].selected         =   false;
                    $scope.paymentList[intCtr].disable          =   true;

                }//end foreach

            }//end if
            else{

                if (index != $scope.paymentList.length-1){

                    $scope.paymentList[index+1].disable         =   false;

                }//end if

                var boolCheckAll            =   true;
                angular.forEach($scope.paymentList, function(payment){

                    if (payment.boolPaid != 1 && (payment.selected == null || payment.selected == false)){

                        boolCheckAll        =   false;

                    }//end function

                });

                if (boolCheckAll){

                    $scope.collection.checkAll      =   true;

                }//end if

            }//end else

        }//end function

        $scope.filterCustomer                   =   function(strCustomerName){

            vm.filterCustomerList           =   [];
            if (strCustomerName == null || strCustomerName == ''){

                angular.forEach(vm.customerList, function(customer){

                    if (customer.deciDownpaymentCollectible != 0){
                        vm.filterCustomerList.push(customer);
                    }else if (customer.deciCollectionCollectible != 0){
                        vm.filterCustomerList.push(customer);
                    }//end else if

                });

            }//end if
            else{

                angular.forEach(vm.customerList, function(customer){

                    if (customer.strFullName.toUpperCase().indexOf(strCustomerName.toUpperCase()) >= 0){
                        vm.filterCustomerList.push(customer);
                    }//end if

                });

            }//end else

        }//end function

        $scope.toggleSearchText                 =   false;
        $scope.toggleSearch                     =   function(){

            $scope.toggleSearchText             =   !$scope.toggleSearchText;

        }//end function

        CustomerResource.get({
            method  :   'notifications'
        }).$promise.then(function(data){

            vm.notifiedCustomerList             =   data.customerList;

        });

        vm.openPastDue                  =   function(customer){

            $('#pastDueSMS').openModal();

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

                if ($scope.newPayment != null){
                
                    $scope.newPayment.cheque       =   cheque;

                }//end if
                else{

                    $scope.collectionTransaction.cheque         =   cheque;

                }//end else
                cheque                  =   null;
                $('#cheque').closeModal();

            }//end else

        }//end function

        $scope.viewUnitDetail         =   function(intUnitId){

            Unit.get({
                id      :   intUnitId,
                method  :   'info'
            }).$promise.then(function(data){

                data.unit.display = String.fromCharCode(parseInt(64)+parseInt(data.unit.intLevelNo))+data.unit.intColumnNo;
                $scope.unitView     =   data.unit;
                $('#unitDetails').openModal();

            });

        }

    });