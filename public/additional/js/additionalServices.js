var additionalServices = angular.module('additionalServices', ['ngResource']);

additionalServices.factory('Additional', ['$resource',
  function($resource){
    return $resource('api/v1/additional', {}, {
      query: {method:'GET', isArray:true}
      save: {method:'POST', isArray:false}
    });
  }]);