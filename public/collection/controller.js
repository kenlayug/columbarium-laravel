angular.module('app')
    .controller('ctrl.collection', function($scope, $resource, $filter, appSettings){

        var Customers = $resource(appSettings.baseUrl+'v2/customers/collections', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        Customers.query().$promise.then(function(data){

            $scope.customerList =   $filter('orderBy')(data.customerList, 'strFullName', false);

        });

    });