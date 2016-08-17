'use strict';

var apiUrl		=	'http://localhost:8000/api/';
angular.module('app')
	.factory('PackageWithService', function($resource){
		return $resource(apiUrl+'v2/packages/services/:serviceId', {
			serviceId 			: 	'@serviceId'
		});
	})
	.factory('Additional', function($resource){
		return $resource(apiUrl+'v1/additional/:id/:method', {
			id 		: 	'@id',
			method	: 	'@method'
		});
	})
	.factory('Service', function($resource){
		return $resource(apiUrl+'v2/services/:id', {
			id 		: 	'@id'
		});
	})
	.factory('Package', function($resource){
		return $resource(apiUrl+'v1/package/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		});
	})
	.factory('ServiceCategory', function($resource){
		return $resource(apiUrl+'v2/service-categories/:id', {
			id 		: 	'@id'
		})
	})
	.factory('AdditionalCategory', function($resource){
		return $resource(apiUrl+'v1/additionalcategory/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		})
	})
	.factory('Interest', function($resource){
		return $resource(apiUrl+'v1/interests/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		});
	})
	.factory('Building', function($resource){
		return $resource(apiUrl+'v2/buildings/:id', {
			id 		: 	'@id'
		});
	})
	.factory('Room', function($resource){
		return $resource(apiUrl+'v2/rooms/:id', {
			id 		: 	'@id'
		});
	})
	.factory('RoomType', function($resource){
		return $resource(apiUrl+'v2/roomtypes/:id', {
			id 		: 	'@id'
		});
	});