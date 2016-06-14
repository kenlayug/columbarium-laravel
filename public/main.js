'use strict';

var apiUrlBase = 'http://localhost:8000/api/v1/';

angular.module('app', [
    'ngResource',
    'datatables',
    'ui.materialize'
])
    .constant('appSettings', {
        baseUrl : apiUrlBase
    })
    .run(['$rootScope', function($rootScope){

    }]);