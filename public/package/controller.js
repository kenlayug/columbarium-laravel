/**
 * Created by kenlayug on 7/6/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.package', function($scope, $resource, $filter, appSettings){

        var Packages    =   $resource(appSettings.baseUrl+'v1/package', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var Additionals =   $resource(appSettings.baseUrl+'v1/additional', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var Services     =   $resource(appSettings.baseUrl+'v2/services', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        Packages.query().$promise.then(function(packageList){

            $scope.packageList      =   $filter('orderBy')(packageList, 'strPackageName', false);

        });

        Additionals.query().$promise.then(function(additionalList){

            $scope.additionalList   =   $filter('orderBy')(additionalList, 'strAdditionalName', false);

        });

        Services.query().$promise.then(function(data){

            $scope.serviceList      =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

    });