/**
 * Created by kenlayug on 6/20/16.
 */
angular.module('app')
    .service('BuildingService', function($resource, appSettings){

        this.default = $resource(appSettings+'v1/building', {}, {
            query: {
                method: 'GET',
                isArray: true
            }
        });

    });