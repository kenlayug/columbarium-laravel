'use strict';

var apiUrlBase = 'http://localhost:8000/api/';

angular.module('app', [
    'ngResource',
    'datatables',
    'ui.materialize',
    'ui.utils.masks',
    'angularMaterializeDatePicker',
    'angularMoment',
    'btford.socket-io',
])
    .constant('appSettings', {
        baseUrl : apiUrlBase
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

        $rootScope.displayPage             =   function(){

            $rootScope.loading          =   false;
            document.getElementById("body").style.display = '';

        }
        
    }]);