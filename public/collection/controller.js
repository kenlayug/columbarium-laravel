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

        var CustomersWithDownpayment = $resource(appSettings.baseUrl+'v2/customers/reservations', {}, {
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

        var Reservations = $resource(appSettings.baseUrl+'v2/customers/:id/reservations', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Downpayments = $resource(appSettings.baseUrl+'v2/reservations/:id/downpayments', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Downpayment = $resource(appSettings.baseUrl+'v2/downpayments', {}, {
            save: {
                method: 'POST',
                isArray: false
            }
        });

        var DeleteDownpayment = $resource(appSettings.baseUrl+'v2/reservations/due-date', {}, {
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

        $scope.openCollect = function(reservationDetailId, reservationDetail, index){

            Downpayments.query({id: reservationDetailId}).$promise.then(function(data){

                $scope.downpaymentList = data.downpaymentList;
                $scope.reservation = {};
                $scope.reservation.balance = data.balance;
                $scope.reservation.intReservationDetailId = reservationDetailId;
                $scope.reservation.index = index;
                $scope.reservation.detail   =   reservationDetail;
                $('#downPaymentForm').openModal();

            });

        }

        $scope.processDownpayment = function(reservationDetailId, index){

            $scope.newPayment.intReservationDetailId = reservationDetailId;
            if ($scope.newPayment.intPaymentType == 2){
                swal('Oops!', 'Cheque payment is not yet available.', 'error');
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

                        Downpayment.save($scope.newPayment).$promise.then(function(data){

                            swal.close();
                            $scope.downpaymentTransaction   =   data;
                            $scope.downpaymentTransaction.balance   =   $scope.reservation.detail.balance;
                            $scope.downpaymentList.push(data.downpayment);
                            $scope.downpaymentList = $filter('orderBy')($scope.downpaymentList, 'created_at', false);
                            $scope.reservation.detail.balance -= data.downpayment.deciAmount;
                            $scope.reservationList[index].balance = $scope.reservation.detail.balance;

                            if (data.paid){

                                $scope.reservationList.splice(index, 1);
                                if ($scope.reservationList.length == 0){
                                    $scope.downpaymentCustomerList.splice($scope.customer.index);
                                }
                                $('#downPaymentForm').closeModal();
                                $('#downpayment').closeModal();

                            }
                            $('#generateReceiptDownpayment').openModal();
                            $scope.newPayment   =   null;

                        });

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
        $scope.makePayment = function(collectionId, payment, index){

            collection.id = collectionId;
            collection.index = index;
            $scope.payment = payment;
            $('#collection-pay').openModal();

        }

        $scope.processCollection = function(){

            if ($scope.collectionPayment.intPaymentType == 2){
                swal('Oops!', 'Cheque payment is not yet available.', 'error');
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

                        CollectionPayment.save({id: collection.id}, $scope.collectionPayment).$promise.then(function(data){

                            swal('Success!', data.message, 'success');
                            $scope.paymentList[collection.index].boolPaid = 1;
                            $scope.paymentList[collection.index].datePayment = data.datePayment;
                            $('#collection-pay').closeModal();

                        })
                            .catch(function(response){

                               if (response.status == 500){

                                   swal(response.data.message, response.data.error, 'error');

                               }

                            });

                    });

            }

        }

        $scope.openPayCollection            =   function(){

            $('#pay').openModal();

        }

    });