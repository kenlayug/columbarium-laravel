/**
 * Created by kenlayug on 6/13/16.
 */
var app = angular.module('app');

app.controller('ctrl.customer', function($scope, $resource, $filter, appSettings){

    var Customers = $resource(appSettings.baseUrl+'customer', {}, {
       query: {method:'GET', isArray: true},
        save: {method: 'POST', isArray: false}
    });

    var CustomerGet = $resource(appSettings.baseUrl+'customer/:id/show', {}, {
       get: {method:'GET', isArray: false}
    });

    var CustomerUpdate = $resource(appSettings.baseUrl+'customer/:id/update', {}, {
       save: {method:'POST', isArray: false}
    });

    var CustomerDeactivate = $resource(appSettings.baseUrl+'customer/:id/delete', {}, {
       delete: {method: 'POST', isArray: false}
    });

    var CustomerArchive = $resource(appSettings.baseUrl+'customer/archive', {}, {
       query: {method: 'GET', isArray: true}
    });

    var CustomerReactivate = $resource(appSettings.baseUrl+'customer/:id/enable', {}, {
       reactivate: {method: 'POST', isArray: false}
    });

    Customers.query().$promise.then(function(data){
        $scope.customers = data;
        $scope.customers = $filter('orderBy')($scope.customers, 'strFullName', false);
    });

    CustomerArchive.query().$promise.then(function(data){
        $scope.deactivatedCustomers = data;
        $scope.deactivatedCustomers = $filter('orderBy')($scope.deactivatedCustomers, 'strFullName', false);
    });

    $scope.validateCustomer = function(customer){

        if (customer.strFirstName == '' || customer.strFirstName == null || customer.strFirstName == ' '
            || customer.strLastName == '' || customer.strLastName == null || customer.strLastName == ' '
            || customer.strAddress == '' || customer.strAddress == null || customer.strAddress == ' '
            || customer.strContactNo == '' || customer.strContactNo == null || customer.strContactNo == ' '
            || customer.intGender == null
            || customer.intCivilStatus == null
            || customer.dateBirthday == null){

            swal('Error!', 'Please fill out all required fields.', 'error');

        }

    };

    $scope.createCustomer = function(){

        $scope.validateCustomer($scope.newCustomer);

        swal({
                title: "Create Customer",
                text: "Are you sure to create this customer?",
                type: "warning",   showCancelButton: true,
                confirmButtonColor: "#ffa500",
                confirmButtonText: "Yes, create it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true, },
            function(){

                Customers.save($scope.newCustomer).$promise.then(function(data){
                    if (data == 'error-existing'){
                        swal('Error!', 'Customer already exists.', 'error');
                    } else if (data == 'error-null'){
                        swal('Error!', 'Please fill out all required fields.', 'error');
                    }else{
                        swal('Success!', 'Customer is successfully created.', 'success');
                        $scope.customers.push(data);
                        $scope.customers = $filter('orderBy')($scope.customers, 'strCustomerName', false);
                    }
                });

        });

    };

    $scope.updateCustomer = function(id, index){

        $scope.updateCustomer = CustomerGet.get({id: id});
        $scope.updateCustomer.index = index;
        $('#modalUpdate').openModal();

    };

    $scope.saveUpdate = function(){

        $scope.validateCustomer($scope.updateCustomer);

        swal({
                title: "Update Customer",
                text: "Are you sure to update this customer?",
                type: "warning",   showCancelButton: true,
                confirmButtonColor: "#ffa500",
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true, },
            function(){

                CustomerUpdate.save({id: $scope.updateCustomer.intCustomerId}, $scope.updateCustomer)
                    .$promise.then(function(data){
                    if (data == 'error-existing'){
                        swal('Error!', 'Customer already exists.', 'error');
                    } else if (data == 'error-null'){
                        swal('Error!', 'Please fill out all required fields.', 'error');
                    } else {
                        swal('Success!', 'Customer is successfully updated.', 'success');
                        $scope.customers.splice($scope.updateCustomer.index, 1);
                        $scope.customers.push(data);
                        $scope.customers = $filter('orderBy')($scope.customers, 'strFullName', false);
                        $('#modalUpdate').closeModal();
                    }
                });

            });

    };

    $scope.deleteCustomer = function(id, index){

        swal({
                title: "Deactivate Customer",
                text: "Are you sure to deactivate this customer?",
                type: "warning",   showCancelButton: true,
                confirmButtonColor: "#ffa500",
                confirmButtonText: "Yes, deactivate it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true, },
            function(){

                CustomerDeactivate.delete({id: id})
                    .$promise.then(function(data){

                    swal('Success!', 'Customer is successfully deactivated.', 'success');
                    $scope.customers.splice(index, 1);

                    $scope.deactivatedCustomers.push(data);
                    $scope.deactivatedCustomers = $filter('orderBy')($scope.deactivatedCustomers, 'strFullName', false);

                });

        });

    };

    $scope.reactivateCustomer = function(id, index){

        swal({
                title: "Reactivate Customer",
                text: "Are you sure to reactivate this customer?",
                type: "warning",   showCancelButton: true,
                confirmButtonColor: "#ffa500",
                confirmButtonText: "Yes, reactivate it!",
                cancelButtonText: "No, cancel pls!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true, },
            function(){

                CustomerReactivate.reactivate({id: id})
                    .$promise.then(function(data){

                    swal('Success!', 'Customer is successfully reactivated.', 'success');
                    $scope.deactivatedCustomers.splice(index, 1);
                    $scope.customers.push(data);
                    $scope.customers = $filter('orderBy')($scope.customers, 'strFullName', false);

                });

        });

    };

});