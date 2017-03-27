/**
 * Created by kenlayug on 7/20/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.service-purchase', function($scope, $filter, $resource, appSettings){

        var vm                  =   $scope;
        var update              =   false;
        var scheduleStatus      =   [
            '',
            'Available',
            'Reserved',
            'Cancelled',
            'Rescheduled'
        ];
        var selectedSchedule    =   [];
        var intServiceUnique    =   0;

        vm.newServicePurchase               =   {};
        vm.newServicePurchase.dateNow       =   new Date();
        vm.newServicePurchase.serviceList   =   [];
        vm.newServicePurchase.packageList   =   [];
        vm.schedule                         =   {};
        vm.schedule.dateSchedule            =   new Date();


        var Additionals     =   $resource(appSettings.baseUrl+'v1/additional', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var Customers       =   $resource(appSettings.baseUrl+'v1/customer', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var CustomerId      =   $resource(appSettings.baseUrl+'v1/customer/:id/update', {}, {
            update  :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var CustomerName    =   $resource(appSettings.baseUrl+'v2/customers', {}, {
            get     :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var Packages        =   $resource(appSettings.baseUrl+'v1/package', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var PackageServices =   $resource(appSettings.baseUrl+'v1/package/:id/service', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var Requirements    =   $resource(appSettings.baseUrl+'v2/services/:id/requirements', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var ScheduleTimes   =   $resource(appSettings.baseUrl+'v2/service-categories/:id/time/:dateSchedule', {
            id: '@id',
            dateSchedule: '@dateSchedule'
        }, {
            save    :   {
                method  :   'POST',
                isArray :   false
            },
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Services        =   $resource(appSettings.baseUrl+'v2/services/others', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var TransactionPurchases    =   $resource(appSettings.baseUrl+'v2/transaction-purchases', {}, {
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        Services.query().$promise.then(function(data){

            angular.forEach(data.serviceList, function(service){

                service.strAvailName    =   service.strServiceName;

            });

            vm.serviceList      =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        Additionals.query().$promise.then(function(additionalList){

            angular.forEach(additionalList, function(additional){

                additional.strAvailName    =   additional.strAdditionalName;

            });

            vm.additionalList   =   $filter('orderBy')(additionalList, 'strAdditionalName', false);

        });

        Packages.query().$promise.then(function(packageList){

            angular.forEach(packageList, function(packageItem){

                packageItem.strAvailName    =   packageItem.strPackageName;

            });

            vm.packageList      =   $filter('orderBy')(packageList, 'strPackageName', false);

        });

        Customers.query().$promise.then(function(customerList){

            vm.customerList     =   $filter('orderBy')(customerList, 'strFullName', false);

        });

        vm.updateCustomer       =   function(strCustomerName, index){

            CustomerName.get({strCustomerName: strCustomerName}).$promise.then(function(data){

                vm.customer         =   data.customer;
                update              =   true;
                vm.customer.index   =   index;
                $('#newCustomer').openModal();

            });

        }

        vm.saveCustomer         =   function(){


            if (update){

                CustomerId.update({id: vm.customer.intCustomerId}, vm.customer).$promise.then(function(data){

                    vm.customerList.splice(vm.customer.index, 1);
                    vm.customerList.push(data);
                    vm.customerList         =   $filter('orderBy')(vm.customerList, 'strFullName', false);
                    vm.customer             =   null;
                    update                  =   false;
                    $('#newCustomer').closeModal();
                    swal('Success!', 'Customer is successfully updated.', 'success');

                });

            }else {

                Customers.save(vm.customer).$promise.then(function (data) {

                    swal('Success!', 'Customer is successfully added.', 'success');
                    vm.customerList.push(data);
                    $('#newCustomer').closeModal();
                    vm.customerList = $filter('orderBy')(vm.customerList, 'strFullName', false);
                    vm.newServicePurchase.strCustomerName = data.strFullName;
                    vm.customer     =   null;

                })
                    .catch(function (response) {

                        if (response.status == 500) {
                            swal('Error!', response.data.error, 'error');
                        }

                    });

            }

        }

        var copyService         =   function(serviceToCopy){

            var service                     =   {};
            service.strServiceName          =   serviceToCopy.strServiceName;
            service.intServiceCategoryId    =   serviceToCopy.intServiceCategoryId;
            service.intServiceId            =   serviceToCopy.intServiceId;
            service.intUniqueKey            =   intServiceUnique;

            if (serviceToCopy.intPackageIdFK != null){

                service.intPackageIdFK      =   serviceToCopy.intPackageIdFK;

            }

            intServiceUnique                =   intServiceUnique+1;

            return service;

        }

        vm.updatePurchaseServiceList        =   function(service){

            var intQuantity     =   0;
            var arrIndex        =   [];
            var intDifference   =   0;
            angular.forEach(vm.newServicePurchase.serviceList, function(purchaseService, index){

                if (purchaseService.intServiceId == service.intServiceId && purchaseService.intPackageIdFK == null){

                    intQuantity     = intQuantity+1;
                    arrIndex.push(index);

                }

            });

            if (intQuantity > service.intQuantity){

                intDifference   =   parseInt(intQuantity-service.intQuantity);
                for (var intCtr = 0, intIndex = intQuantity-1; intCtr < intDifference; intCtr++, intIndex--){

                    vm.newServicePurchase.serviceList.splice(arrIndex[intIndex], 1);

                }

            }else if (intQuantity < service.intQuantity){

                intDifference   =   parseInt(service.intQuantity-intQuantity);
                for (var intCtr = 0; intCtr < intDifference; intCtr++) {

                    var serviceToPush       =   copyService(service);
                    vm.newServicePurchase.serviceList.push(serviceToPush);

                }


            }

        }

        vm.updatePurchasePackageList  =   function(packageItem){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            var intQuantity     =   0;
            var arrIndex        =   [];
            var intDifference   =   0;

            angular.forEach(vm.newServicePurchase.packageList, function(purchasePackage, index){

                if (purchasePackage.intPackageId == packageItem.intPackageId){

                    intQuantity     = intQuantity+1;
                    arrIndex.push(index);

                }

            });

            if (intQuantity > packageItem.intQuantity){

                intDifference   =   parseInt(intQuantity-packageItem.intQuantity);
                for (var intCtr = 0, intIndex = intQuantity-1; intCtr < intDifference; intCtr++, intIndex--){

                    PackageServices.query({id: packageItem.intPackageId}).$promise.then(function(data){

                        angular.forEach(data, function(service){

                            for (var intCtr = 0; intCtr < service.intQuantity; intCtr++){

                                var deleteThis =   true;

                                angular.forEach(vm.newServicePurchase.serviceList, function(purchaseService, index){

                                    if ((purchaseService.intServiceId == service.intServiceId
                                        && purchaseService.intPackageIdFK == service.intPackageIdFK)
                                        && deleteThis){

                                        vm.newServicePurchase.serviceList.splice(index, 1);
                                        deleteThis  =   false;

                                    }//end if

                                });//end forEach

                            }//end for

                        });//end forEach

                        swal.close();

                    });//end query

                    vm.newServicePurchase.packageList.splice(arrIndex[intIndex], 1);

                }//end for

            }else if (intQuantity < packageItem.intQuantity){

                intDifference   =   parseInt(packageItem.intQuantity-intQuantity);
                for (var intCtr = 0; intCtr < intDifference; intCtr++) {

                    vm.newServicePurchase.packageList.push(packageItem);
                    PackageServices.query({id: packageItem.intPackageId}).$promise.then(function(data){

                        angular.forEach(data, function(service){

                            for (var intCtr = 0; intCtr < service.intQuantity; intCtr++){

                                var serviceToPush       =   copyService(service);
                                vm.newServicePurchase.serviceList.push(serviceToPush);


                            }//end for

                        });//end forEach

                        swal.close();

                    });//end query

                }//end for

            }//end else if

        }//end function

        var getScheduleTimes        =   function(service){

            console.log('getting schedule times...');

            var dateSchedule        =   moment(vm.schedule.dateSchedule).format('MMMM D, YYYY');
            ScheduleTimes.query({id: service.intServiceCategoryId, dateSchedule : dateSchedule}).$promise.then(function(data){

                angular.forEach(data.serviceScheduleList, function(serviceSchedule){

                    if (serviceSchedule.status == null){

                        serviceSchedule.displayStatus   =   scheduleStatus[1];
                        angular.forEach(selectedSchedule, function(schedule){

                            if (schedule.intSchedServiceId == serviceSchedule.intSchedServiceId
                                && schedule.dateSchedule == dateSchedule){

                                console.log('FOUND!');
                                serviceSchedule.displayStatus               =   scheduleStatus[2];
                                serviceSchedule.status                      =   {};
                                serviceSchedule.status.intScheduleStatus    =   2;

                            }

                        });

                    }else {

                        serviceSchedule.displayStatus   =   scheduleStatus[serviceSchedule.status.intScheduleStatus]

                    }

                });

                vm.serviceScheduleList      =   $filter('orderBy')(data.serviceScheduleList, 'timeStart', false);
                vm.serviceCategoryToSched   =   data.serviceCategory;

            });

        }

        vm.scheduleService          =   function(service, index){

            $('#scheduleService').openModal();
            service.index           =   index;
            vm.serviceToSchedule    =   service;
            getScheduleTimes(service);

        }

        vm.createTime               =   function(intServiceCategoryId){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            ScheduleTimes.save({id: intServiceCategoryId}).$promise.then(function(data){

                vm.serviceScheduleList.push(data.serviceSchedule);
                vm.serviceScheduleList      =   $filter('orderBy')(vm.serviceScheduleList, 'timeStart', false);
                swal.close();

            })
                .catch(function(response){

                    if (response.status == 500){

                        swal('Error!', response.data.error, 'error');

                    }else if (response.status == 404){
                        swal('Error!', 'Page not found!', 'error');
                    }

                });

        }

        vm.getScheduleDate          =   function(){

            getScheduleTimes(vm.serviceToSchedule);

        }

        vm.setServiceSchedule       =   function(serviceSchedule){

            serviceSchedule.dateSchedule    =   moment(vm.schedule.dateSchedule).format('MMMM DD, YYYY');
            if (vm.serviceToSchedule.schedule != null){

                angular.forEach(selectedSchedule, function(selectedServiceSchedule, index){

                    if (selectedServiceSchedule.dateSchedule == vm.serviceToSchedule.schedule.dateSchedule
                        && vm.serviceToSchedule.schedule.intSchedServiceId == selectedServiceSchedule.intSchedServiceId){

                        selectedSchedule.splice(index, 1);

                    }

                });

            }
            selectedSchedule.push(serviceSchedule);
            angular.forEach(vm.newServicePurchase.serviceList, function(service){

                if (service.intUniqueKey   ==  vm.serviceToSchedule.intUniqueKey){

                    service.schedule = serviceSchedule;

                }

            });
            $('#scheduleService').closeModal();

        }

        vm.computeTotal                     =   function(){

            var deciTotalAmountToPay        =   0;
            var intPurchaseCtr              =   0;
            vm.newServicePurchase.selectedServiceList   =   [];
            vm.newServicePurchase.selectedAdditionalList   =   [];
            vm.newServicePurchase.selectedPackageList   =   [];

            angular.forEach(vm.additionalList, function(additional){

                if (additional.selected){

                    deciTotalAmountToPay    +=  parseFloat(additional.price.deciPrice * additional.intQuantity);
                    vm.newServicePurchase.selectedAdditionalList.push(additional);
                    intPurchaseCtr++;

                }

            });

            angular.forEach(vm.serviceList, function(service){

                if (service.selected){

                    deciTotalAmountToPay    +=  parseFloat(service.price.deciPrice * service.intQuantity);
                    vm.newServicePurchase.selectedServiceList.push(service);
                    intPurchaseCtr++;

                }

            });

            angular.forEach(vm.packageList, function(packageItem){

                if (packageItem.selected){

                    deciTotalAmountToPay    +=  parseFloat(packageItem.price.deciPrice * packageItem.intQuantity);
                    vm.newServicePurchase.selectedPackageList.push(packageItem);
                    intPurchaseCtr++;

                }

            });

            vm.newServicePurchase.deciTotalAmountToPay      =   deciTotalAmountToPay;

            if (intPurchaseCtr == 0){

                swal('Error!', 'Pick one or more additional/service/package first.', 'error');

            }
            vm.newServicePurchase.intPurchaseCtr            =   intPurchaseCtr;

        }

        vm.processServicePurchase           =   function(){

            var validation      =   false;
            var message         =   null;

            if (vm.newServicePurchase.deciTotalAmountToPay > vm.newServicePurchase.deciAmountPaid){

                validation      =   true;
                message         =   'Amount to pay is greater than amount paid.';

            }else if (vm.newServicePurchase.strCustomerName == null){

                validation      =   true;
                message         =   'Customer cannot be blank.';

            }else if (vm.newServicePurchase.boolFuture != 1){

                angular.forEach(vm.newServicePurchase.serviceList, function(service){

                    if (service.schedule == null){

                        validation  =   true;
                        message     =   'One of the selected services have no schedule yet.';

                    }

                });


            }else if (vm.newServicePurchase.intPaymentMode == null){

                validation          =   true;
                message             =   'Mode of payment cannot be blank.';

            }else if (vm.newServicePurchase.boolFuture == 1){

                if (vm.newServicePurchase.intPaymentType == 2){

                    validation      =   true;
                    message         =   'Installment is not yet available.';

                }else if (vm.newServicePurchase.intPaymentType == null){

                    validation      =   true;
                    message         =   'Type of payment cannot be blank.'

                }

            }

            if (validation){

                swal('Error!', message, 'error');

            }else{

                TransactionPurchases.save(vm.newServicePurchase).$promise.then(function(data){

                    swal('Success!', data.message, 'success');
                    vm.newServicePurchase               =   null;
                    vm.newServicePurchase               =   {};
                    vm.newServicePurchase.dateNow       =   new Date();
                    vm.newServicePurchase.serviceList   =   [];
                    vm.newServicePurchase.packageList   =   [];
                    vm.schedule                         =   {};
                    vm.schedule.dateSchedule            =   new Date();

                    angular.forEach(vm.additionalList, function(additional){

                        additional.selected             =   null;
                        additional.intQuantity          =   null;

                    });

                    angular.forEach(vm.serviceList, function(service){

                        service.selected             =   null;
                        service.intQuantity          =   null;

                    });

                    angular.forEach(vm.packageList, function(packageItem){

                        packageItem.selected             =   null;
                        packageItem.intQuantity          =   null;

                    });

                })
                    .catch(function(response){

                        if (response.status == 500){

                            swal('Error!', response.data.error, 'error');

                        }

                    });

            }

        }

    });