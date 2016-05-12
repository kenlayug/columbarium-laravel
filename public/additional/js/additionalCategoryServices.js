var additionalCategoryServices = angular.module('additionalCategoryServices', ['ngResource']);

additionalServices.factory('AdditionalCategory', ['$resource',
  function($resource){
    return $resource('api/v1/additionalcategory', {}, {
      query: {method:'GET', isArray:true}
      save: {method:'POST', isArray:false}
    });
  }]);