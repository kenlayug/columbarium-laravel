'use strict';

var apiUrl		=	'http://localhost:8000/api/';
angular.module('app')
	.factory('PackageWithService', function($resource){
		return $resource(apiUrl+'v2/packages/services/:serviceId', {
			serviceId 			: 	'@serviceId'
		});
	})
	.factory('Additional', function($resource){
		return $resource(apiUrl+'v1/additional/:id/:method/:type', {
			id 		: 	'@id',
			method	: 	'@method',
			type 	: 	'@type'
		});
	})
	.factory('Service', function($resource){
		return $resource(apiUrl+'v2/services/:id/:method/:type', {
			id 		: 	'@id',
			method 	: 	'@method',
			type 	: 	'@type'
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
		return $resource(apiUrl+'v3/interests/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		}, {
			update 	: 	{
				method 	: 	'PUT',
				isArray	: 	false
			}
		});
	})
	.factory('BuildingV1', function($resource){
		return $resource(apiUrl+'v1/building/:id/:method/:type', {
			id 		: 	'@id',
			method 	: 	'@method',
			type 	: 	'@type'
		});
	})
	.factory('Building', function($resource){
		return $resource(apiUrl+'v2/buildings/:id/:method/:type', {
			id 		: 	'@id',
			method	: 	'@method',
			type 	: 	'@type'
		});
	})
	.factory('Floor', function($resource){
		return $resource(apiUrl+'v2/floors/:id/:type', {
			id 		: 	'@id',
			type 	: 	'@type'
		});
	})
	.factory('Room', function($resource){
		return $resource(apiUrl+'v2/rooms/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		});
	})
	.factory('RoomType', function($resource){
		return $resource(apiUrl+'v2/roomtypes/:id', {
			id 		: 	'@id'
		});
	})
	.factory('Block', function($resource){
		return $resource(apiUrl+'v2/blocks/:id/:method/:type', {
			id 		: 	'@id',
			method 	: 	'@method',
			type 	: 	'@type'
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
		return $resource(apiUrl+'v3/transaction-units/:id', {
			id 			: 	'@id'
		}, {
			update 		: 	{
				method 	: 	'PUT',
				isArray	: 	false
			}
		});
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
	.factory('ScheduleLog', function($resource){
		return $resource(apiUrl+'v2/service-categories/:intServiceCategoryId/schedule-logs/:intScheduleLogId', {
			intServiceCategoryId 		: 	'@intServiceCategoryId',
			intScheduleLogId 			: 	'@intScheduleLogId'
		});
	})
	.factory('ScheduleTime', function($resource){
		return $resource(apiUrl+'v2/service-categories/:id/time/:dateSchedule', {
            id: '@id',
            dateSchedule: '@dateSchedule'
        });
	})
	.factory('UnitPurchaseReport', function($resource){
		return $resource(apiUrl+'v3/transaction-units/reports/:param1/:param2/:param3', {
			param1 		: 	'@param1',
			param2 		: 	'@param2',
			param3 		: 	'@param3'
		});
	})
	.factory('TransactionDeceasedReport', function($resource){
		return $resource(apiUrl+'v2/transaction-deceased/reports/:date/:method/:type', {
			date 		: 	'@date',
			method 		: 	'@method',
			type 		: 	'@type'
		});
	})
	.factory('TransactionOwnershipReport', function($resource){
		return $resource(apiUrl+'v2/transfer-ownership/reports/:date/:method', {
			date 		: 	'@date',
			method 		: 	'@method'
		});
	})
	.factory('Unit', function($resource){
		return $resource(apiUrl+'v2/units/:id/:method', {
			id 			: 	'@id',
			method 		: 	'@method'
		});
	})
	.factory('Unitv2', function($resource){
		return $resource(apiUrl+'v3/units/:id/:method', {
			id 			: 	'@id',
			method 		: 	'@method'
		});
	})
	.factory('SafeBox', function($resource){
		return $resource(apiUrl+'v2/safe-boxes/:id/:method', {
			id 			: 	'@id',
			method 		: 	'@method'
		}, {
			update 		: 	{
				method 	: 	'PUT',
				isArray	: 	false
			}
		});
	})
	.factory('CollectionReport', function($resource){
		return $resource(apiUrl+'v2/collections/reports/:dateFrom/to/:dateTo', {
			dateFrom 		: 	'@dateFrom',
			dateTo 			: 	'@dateTo'
		});
	})
	.factory('CollectionStatistic', function($resource){
		return $resource(apiUrl+'v2/collections/reports/:dateFilter/:method/:type', {
			dateFilter 		: 	'@dateFilter',
			method 			: 	'@method',
			type 			: 	'@type'
		});
	})
	.factory('Receivable', function($resource){
		return $resource(apiUrl+'v3/receivables', {});
	})
	.factory('Discount', function($resource){
		return $resource(apiUrl+'v3/discounts/:id/:method', {
			id 			: 	'@id',
			method 		: 	'@method'
		}, {
			update 		: 	{
				method 	: 	'PUT',
				isArray	: 	false
			}
		});
	})
	.factory('AssignDiscount', function($resource){
		return $resource(apiUrl+'v3/assign-discounts/:id/:method', {
			id 			: 	'@id',
			method 		: 	'@method'
		});
	})
	.factory('Customer', function($resource){
		return $resource(apiUrl+'v2/customers/:id/:method/:type', {
			id 		: 	'@id',
			method 	: 	'@method',
			type 	: 	'@type'
		});
	})
	.factory('Notification', function($resource){
		return $resource(apiUrl+'v3/notifications/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		});
	})
	.factory('Employee', function($resource){
		return $resource(apiUrl+'v2/employees/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		});
	})
	.factory('Position', function($resource){
		return $resource(apiUrl+'v2/positions/:id/:method', {
			id 		: 	'@id',
			method 	: 	'@method'
		})
	})
	.factory('Login', function($resource){
		return $resource(apiUrl+'v3/auth/:email/:password/:method', {
			email 		: 	'@email',
			password 	: 	'@password',
			method 		: 	'@method'
		});
	})
	.factory('Deceased', function($resource){
		return $resource(apiUrl+'v3/deceased/:method', {
			method 		: 	'@method'
		});
	})
	.factory('FloorV2', function($resource){
		return $resource(apiUrl+'v3/floors/:id/:method/:type', {
			id 			: 	'@id',
			method 		: 	'@method',
			type 		: 	'@type'
		});
	})
	.factory('Overview', function($resource){
		return $resource(apiUrl+'v3/overview/:method/:dateFilter', {
			method 		: 	'@method',
			dateFilter 	: 	'@dateFilter'
		});
	});