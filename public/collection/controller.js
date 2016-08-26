angular.module('app')
    .controller('ctrl.collection', function($scope, $rootScope, $resource, $filter, appSettings, DTOptionsBuilder, $timeout){

        $rootScope.collectionActive = 'active';
        var rs = $rootScope;

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

        // var Downpayments = $resource(appSettings.baseUrl+'v2/reservations/:id/downpayments', {}, {
        //     query: {
        //         method: 'GET',
        //         isArray: false
        //     }
        // });

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
            if ($scope.newPayment.intPaymentType == 2){
                swal('Oops!', 'Cheque payment is not yet available.', 'error');
            }else {

                rs.loading          =   true;
                Downpayment.save($scope.newPayment).$promise.then(function(data){

                    rs.loading          =   false;
                    $scope.downpaymentTransaction   =   data;
                    $scope.downpaymentTransaction.balance   =   $scope.downpayment.detail.deciBalance;
                    $scope.downpaymentPaymentList.push(data.downpayment);
                    $scope.downpaymentPaymentList = $filter('orderBy')($scope.downpaymentPaymentList, 'created_at', false);
                    var balance     =   $scope.downpayment.detail.deciBalance-data.downpayment.deciAmountPaid;
                    $scope.downpaymentTransaction.prevBalance   =   balance + data.downpayment.deciAmountPaid;
                    console.log($scope.downpaymentTransaction);
                    $scope.downpaymentList[$scope.downpayment.index].deciBalance = balance;

                    if (data.paid){

                        $scope.downpaymentList.splice($scope.downpayment.index, 1);
                        if ($scope.downpaymentList.length == 0){
                            $scope.downpaymentCustomerList.splice($scope.customer.index);
                        }
                        $('#downPaymentForm').closeModal();
                        $('#downpayment').closeModal();

                        var customerFound           =   false;
                        angular.forEach($scope.collectionCustomerList, function(customer){

                            if (customer.intCustomerId == data.collection.intCustomerIdFK){

                                customerFound   =   true;

                            }

                        });

                        if (!customerFound){

                            Customers.get({id : data.collection.intCustomerIdFK}).$promise.then(function(data){

                                $scope.collectionCustomerList.push(data);
                                $scope.collectionCustomerList           =   $filter('orderBy')($scope.collectionCustomerList, 'strFullName', false);

                            });

                        }

                    }
                    $('#generateReceiptDownpayment').openModal();
                    $scope.newPayment   =   null;

                });

            }

        }

        $scope.getCollections = function(customer, index){

            rs.loading          =   true;
            Collections.query({id: customer.intCustomerId}).$promise.then(function(data){

                $scope.collectionList   =   data.collectionList;
                $scope.customer         =   customer;
                $scope.customer.index   =   index;
                $('#collection').openModal();
                rs.loading          =   false;

            });

        }

        var collectionToPay = {};

        $scope.getPayments = function(collection, index){

            rs.loading          =   true;
            Payments.query({id: collection.intCollectionId}).$promise.then(function(data){

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

            if ($scope.collectionTransaction.intPaymentType == 2){

                validate        =   true;
                message         =   'Cheque payment is not yet available.';

            }else if ($scope.deciTotalAmountToPay > $scope.collectionTransaction.deciAmountPaid){

                validate        =   true;
                message         =   'Amount to pay is greater than amount paid.';

            }

            if (validate){

                swal('Error!', message, 'error');

            }else {

                $scope.collectionTransaction.collectionListToPay        =   $scope.collectionListToPay;
                rs.loading          =   true;
                CollectionPayment.save({id: collectionToPay.id}, $scope.collectionTransaction).$promise.then(function(data){

                    angular.forEach($scope.collectionTransaction.collectionListToPay, function(collectionToPay){

                        var index           =   $scope.paymentList.indexOf(collectionToPay);

                        $scope.paymentList[index].boolPaid          =   1;
                        $scope.paymentList[index].datePayment       =   data.datePayment;

                    });//end foreach
                    
                    $scope.lastTransaction                              =   data;
                    $scope.lastTransaction.collectionDetail             =   $scope.collectionToPay;
                    $('#pay').closeModal();
                    $('#generateReceiptCollection').openModal();
                    rs.loading          =   false;

                })
                    .catch(function(response){

                        rs.loading          =   false;
                       if (response.status == 500){

                           swal(response.data.message, response.data.error, 'error');

                       }

                    });

            }

        }

        $scope.openPayCollection            =   function(){

            $('#pay').openModal();
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

            angular.forEach($scope.paymentList, function(payment){

                if (payment.boolPaid != 1){
                    payment.selected = toggle;
                }

            });

        }

    });