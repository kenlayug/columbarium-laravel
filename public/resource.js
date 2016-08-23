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
		return $resource(apiUrl+'v2/service-categories/:param1', {
			param1 		: 	'@param1'
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
	})
	.factory('Block', function($resource){
		return $resource(apiUrl+'v2/blocks/:id', {
			id 		: 	'@id'
		});
	})
	.factory('Floor', function($resource){
		return $resource(apiUrl+'v2/floors/:param1/:param2', {
			param1 			: 	'@param1',
			param2			: 	'@param2'
		});
	})
	.factory('UnitCategory', function($resource){
		return $resource(apiUrl+'v2/unit-categories/:id', {
			id 				: 	'@id'
		});
	})
	.factory('SalesReport', function($resource){
		return $resource(apiUrl+'v3/transaction-purchases/reports/:param1/:param2', {
			param1 				: 	'@param1',
			param2 				: 	'@param2'
		});
	})
	.factory('TransactionUnit', function($resource){
		return $resource(apiUrl+'v3/transaction-units', {});
	})
	.factory('Schedule', function($resource){
		return $resource(apiUrl+'v3/schedules/:param1/:param2/:param3', {
			param1 		: 	'@param1',
			param2 		: 	'@param2',
			param3 		: 	'@param3'
		},{
			update		: 	{
				method 	: 	'PUT',
				isArray	: 	false
			}
		});
	})
	.factory('ScheduleTime', function($response){
		return $resource(apiUrl+'v2/service-categories/:id/time/:dateSchedule', {
            id: '@id',
            dateSchedule: '@dateSchedule'
        });
	})
	.factory('UnitPurchaseReport', function($resource){
		return $resource(apiUrl+'v3/transaction-units/reports/:param1/:param2', {
			param1 		: 	'@param1',
			param2 		: 	'@param2'
		});
	})
	.factory('TransactionDeceasedReport', function($resource){
		return $resource(apiUrl+'v2/transaction-deceased/reports/:date/:method', {
			date 		: 	'@date',
			method 		: 	'@method'
		});
	})
	.factory('TransactionOwnershipReport', function($resource){
		return $resource(apiUrl+'v2/transfer-ownership/reports/:date/:method', {
			date 		: 	'@date',
			method 		: 	'@method'
		});
	});