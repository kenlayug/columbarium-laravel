angular.module('app')
    .controller('ctrl.collection', function($scope, $rootScope, $resource, $filter, appSettings, DTOptionsBuilder, $timeout){

        $rootScope.collectionActive = 'active';

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withDisplayLength(6);

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

        var Collections = $resource(appSettings.baseUrl+'v2/customers/:id/collections', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Payments = $resource(appSettings.baseUrl+'v2/collections/:id/payments', {}, {
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

        var update = function() {
            $timeout(function() {
                DeleteDownpayment.update();
                update();
            }, 1*60*60*1000);
        };
        update();

        DeleteDownpayment.update().$promise.then(function(data){

            CustomersWithDownpayment.query().$promise.then(function(data){

                $scope.downpaymentCustomerList  =   $filter('orderBy')(data.customerList, 'strFullName', false);
                console.log($scope.downpaymentCustomerList);

            });

        });

        CustomersWithCollection.query().$promise.then(function(data){

            $scope.collectionCustomerList   =   $filter('orderBy')(data.customerList, 'strFullName', false);

        });

        $scope.getReservations = function(customerId, customerName, index){

            Reservations.query({id: customerId}).$promise.then(function(data){

                $scope.reservationList = data.reservationList;
                $scope.customer = {};
                $scope.customer.strFullName = customerName;
                $scope.customer.intCustomerId = customerId;
                $scope.customer.index = index;
                $('#downpayment').openModal();

            });

        }

        $scope.openCollect = function(intDownpaymentId, downpayment, index){

            DownpaymentPayments.query({id: intDownpaymentId}).$promise.then(function(data){

                $scope.downpaymentPaymentList = data.paymentList;
                $scope.downpayment = {};
                $scope.downpayment.balance = data.balance;
                $scope.downpayment.intDownpaymentId = intDownpaymentId;
                $scope.downpayment.index = index;
                $scope.downpayment.detail   =   downpayment;
                $('#downPaymentForm').openModal();

            });

        }

        $scope.processDownpayment = function(intDownpaymentId, index){

            $scope.newPayment.intDownpaymentId = intDownpaymentId;
            if ($scope.newPayment.intPaymentType == 2){
                swal('Oops!', 'Cheque payment is not yet available.', 'error');
            }else {

                Downpayment.save($scope.newPayment).$promise.then(function(data){

                    swal.close();
                    $scope.downpaymentTransaction   =   data;
                    $scope.downpaymentTransaction.balance   =   $scope.downpayment.detail.deciBalance;
                    $scope.downpaymentPaymentList.push(data.downpayment);
                    $scope.downpaymentPaymentList = $filter('orderBy')($scope.downpaymentPaymentList, 'created_at', false);
                    var balance     =   $scope.downpayment.detail.deciBalance-data.downpayment.deciAmountPaid;
                    $scope.downpaymentList[$scope.downpayment.index].deciBalance = balance;

                    if (data.paid){

                        $scope.downpaymentList.splice($scope.downpayment.index, 1);
                        if ($scope.downpaymentList.length == 0){
                            $scope.downpaymentCustomerList.splice($scope.customer.index);
                        }
                        $('#downPaymentForm').closeModal();
                        $('#downpayment').closeModal();

                    }
                    $('#generateReceiptDownpayment').openModal();
                    $scope.newPayment   =   null;

                });

            }

        }

        $scope.getCollections = function(customer, index){

            Collections.query({id: customer.intCustomerId}).$promise.then(function(data){

                $scope.collectionList   =   data.collectionList;
                $scope.customer         =   customer;
                $scope.customer.index   =   index;
                $('#collection').openModal();

            });

        }

        $scope.getPayments = function(collection, index){

            Payments.query({id: collection.intCollectionId}).$promise.then(function(data){

                $scope.paymentList      =   data.paymentList;
                $scope.collection       =   collection;
                $scope.collection.index =   index;

                $('#collectionForm').openModal();

            });

        }

        var collection = {};

        $scope.processCollection = function(){

            var validate        =   false;
            var message         =   null

            console.log('HERE AT PROCESS COLLECTION...');

            if ($scope.collectionToPay.intPaymentType == 2){

                validate        =   true;
                message         =   'Cheque payment is not yet available.';

            }else if (($scope.collectionToPay.deciMonthlyAmortization + $scope.collectionToPay.penalty) > $scope.collectionToPay.deciAmountPaid){

                validate        =   true;
                message         =   'Amount to pay is greater than amount paid.';

            }

            if (validate){

                swal('Error!', message, 'error');

            }else {

                CollectionPayment.save({id: collection.id}, $scope.collectionToPay).$promise.then(function(data){

                    $scope.paymentList[collection.index].boolPaid       =   1;
                    $scope.paymentList[collection.index].datePayment    =   data.datePayment;
                    $scope.lastTransaction                              =   data;
                    $scope.lastTransaction.collectionDetail             =   $scope.collectionToPay;
                    $('#pay').closeModal();
                    $('#generateReceiptCollection').openModal();

                })
                    .catch(function(response){

                       if (response.status == 500){

                           swal(response.data.message, response.data.error, 'error');

                       }

                    });

            }

        }

        $scope.openPayCollection            =   function(collectionToPay, index){

            $('#pay').openModal();
            console.log(collectionToPay);
            collection.id = collectionToPay.intCollectionId;
            collection.index = index;
            $scope.collectionToPay          =   collectionToPay;
            $scope.collectionToPay.dateNow  =   new Date();

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

    });