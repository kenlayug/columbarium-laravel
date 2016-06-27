angular.module('app')
    .controller('ctrl.collection', function($scope, $resource, $filter, appSettings, DTOptionsBuilder){

        $scope.dtOptions = DTOptionsBuilder.newOptions()
            .withDisplayLength(6);

        var Customers = $resource(appSettings.baseUrl+'v2/customers/collections', {}, {
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

        Customers.query().$promise.then(function(data){

            $scope.customerList =   $filter('orderBy')(data.customerList, 'strFullName', false);

        });

        $scope.getCollections = function(customerId){

            Collections.query({id: customerId}).$promise.then(function(data){

                $scope.collectionList = data.collectionList;
                $('#collection').openModal();

            });

        }

        $scope.getPayments = function(collectionId){

            Payments.query({id: collectionId}).$promise.then(function(data){

                $scope.paymentList = data.paymentList;
                $('#modal2').openModal();

            });

        }

        var collection = {};
        $scope.makePayment = function(collectionId, payment, index){

            collection.id = collectionId;
            collection.index = index;
            $scope.payment = payment;
            $('#collection-pay').openModal();

        }

        $scope.processPayment = function(){

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

                        CollectionPayment.save({id: collection.id}, $scope.newPayment).$promise.then(function(data){

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

    });