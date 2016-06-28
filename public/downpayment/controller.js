angular.module('app')
    .controller('ctrl.downpayment', function($resource, $scope, $filter, appSettings, $timeout, $window){

        var Customers = $resource(appSettings.baseUrl+'v2/customers/reservations', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var CustomersWithVoid = $resource(appSettings.baseUrl+'v2/customers/reservations/void', {}, {
            query: {
                method: 'GET',
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

        DeleteDownpayment.update().$promise.then(function(data){

            Customers.query().$promise.then(function(data){

                $scope.customerList = $filter('orderBy')(data.customerList, 'strFullName', false);

            });

            CustomersWithVoid.query().$promise.then(function(data){

                $scope.voidCustomerList = $filter('orderBy')(data.customerList, 'strFullName', false);

            });

        });
        var update = function() {
            $timeout(function() {
                DeleteDownpayment.update();
                update();
            }, 1*60*60*1000);
        };
        update();

        $scope.getReservations = function(customerId, customerName, index){

            Reservations.query({id: customerId}).$promise.then(function(data){

                $scope.reservationList = data.reservationList;
                $scope.customer = {};
                $scope.customer.strFullName = customerName;
                $scope.customer.intCustomerId = customerId;
                $scope.customer.index = index;
                $('#modalViewReservations').openModal();

            });

        }

        $scope.openCollect = function(reservationDetailId, index){

            Downpayments.query({id: reservationDetailId}).$promise.then(function(data){

                $scope.downpaymentList = data.downpaymentList;
                $scope.reservation = {};
                $scope.reservation.balance = data.balance;
                $scope.reservation.intReservationDetailId = reservationDetailId;
                $scope.reservation.index = index;
                $('#modalViewDownpayments').openModal();

            });

        }

        $scope.processPayment = function(reservationDetailId, index){

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

                            swal('Success!', data.message, 'success');
                            $scope.downpaymentList.push(data.downpayment);
                            $scope.downpaymentList = $filter('orderBy')($scope.downpaymentList, 'created_at', false);
                            $scope.reservation.balance -= data.downpayment.deciAmount;
                            $scope.reservationList[index].balance = $scope.reservation.balance;
                            if (data.paid){

                                $scope.reservationList.splice(index, 1);
                                if ($scope.reservationList.length == 0){
                                    $scope.customerList.splice($scope.customer.index);
                                }

                            }

                            console.log()
                            $window.open('http://localhost:8000/pdf/downpayments/'+data.downpayment.intDownpaymentId);


                        });

                    });

            }

        }

    });