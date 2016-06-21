/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .factory('Room', function($resource, appSettings){

        return $resource(appSettings.baseUrl+'v2/rooms', {}, {
            save: {
                method: 'POST',
                isArray: false
            }
        });

    })
    .factory('RoomId', function($resource, appSettings){

        return $resource(appSettings.baseUrl+'v2/rooms/:id', {}, {
            get:{
                method: 'GET',
                isArray: false
            },
            update:{
                method: 'PUT',
                isArray: false
            },
            delete:{
                method: 'DELETE',
                isArray: false
            }
        });

    });