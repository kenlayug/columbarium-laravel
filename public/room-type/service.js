/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .factory('RoomType', function($resource, appSettings){
       return $resource(appSettings.baseUrl+'v2/roomtypes', {}, {
           save: {
               method: 'POST',
               isArray: false
           },
           query: {
               method: 'GET',
               isArray: true
           }
       });
    });