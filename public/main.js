'use strict';

var apiUrlBase = 'http://localhost:8000/api/';

angular.module('app', [
    'ngResource',
    'datatables',
    'datatables.options',
    'datatables.directive',
    'datatables.select',
    'ui.materialize',
    'ui.utils.masks',
    'angularMaterializeDatePicker',
    'angularMoment',
    'btford.socket-io',
    'luegg.directives',
])
    .constant('appSettings', {
        baseUrl : apiUrlBase
    })
    .filter('percentage', ['$filter', function ($filter) {
      return function (input, decimals) {
        return $filter('number')(input * 100, decimals) + '%';
      };
    }])
    .filter('range', function() {
      return function(input, total) {
        total = parseInt(total);

        for (var i=0; i<total; i++) {
          input.push(i);
        }

        return input;
      };
    })
    .factory('mySocket', function (socketFactory) {
        var myIoSocket = io.connect('http://localhost:8890');

        var mySocket = socketFactory({
            ioSocket: myIoSocket
        });

        return mySocket;
    })
    .run(['$rootScope', function($rootScope){
        $rootScope.update = {};

        $rootScope.dateNow          =   moment();

        $rootScope.displayPage             =   function(){

            $rootScope.loading          =   false;

        }

        $rootScope.displayPage();
        
    }]);