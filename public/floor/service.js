/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .factory('FloorRoom', function($resource, appSettings){

        return $resource(appSettings.baseUrl+'v2/floors/:id/rooms', {}, {

            query: {
                method: 'GET',
                isArray: true
            }

        });

    });