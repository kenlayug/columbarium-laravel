/**
 * Created by kenlayug on 7/20/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.service-purchase', function($scope, $filter, $resource, appSettings){

        var vm                  =   $scope;
        var update              =   false;

        vm.newServicePurchase           =   {};
        vm.newServicePurchase.dateNow   =   new Date();
        vm.availList                    =   [];
        vm.additionalSelected           =   false;
        vm.serviceSelected              =   false;
        vm.packageSelected              =   false;


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

        var Requirements    =   $resource(appSettings.baseUrl+'v2/services/:id/requirements', {}, {
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

        var prevSelectedCategoryList = null;

        vm.fetchAvailOptions        =   function(){

            console.log('Fetching...');

        }

    });