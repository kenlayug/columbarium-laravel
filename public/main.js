'use strict';

var apiUrlBase = 'http://localhost:8000/api/';

angular.module('app', [
    'ngResource',
    'datatables',
    'ui.materialize',
    'ui.utils.masks'
])
    .constant('appSettings', {
        baseUrl : apiUrlBase
    })
    .run(['$rootScope', function($rootScope){
        $rootScope.update = {};
    }]);