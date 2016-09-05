'use strict;'

angular.module('app')
	.controller('ctrl.query.schedule', function($scope, $rootScope, $filter, ServiceCategory, Schedule){

		var vm 						=	$scope;
		var rs 						=	$rootScope;

		vm.scheduleStatusList		=	[
			'', 'Available', 'Reserved', 'Rescheduled', 'Cancelled', 'Ongoing', 'Done'
		];

		ServiceCategory.get({param1 : "scheduled"}).$promise.then(function(data){

			vm.serviceList 			=	$filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);
			vm.filter					=	{
				dateSchedule 			: 	moment().format('MM/DD/YYYY'),
				intServiceCategoryId	: 	data.serviceCategoryList[0].intServiceCategoryId,
				intStatus 				: 	0
			};
			vm.getSchedule();

		});

		vm.getSchedule 				=	function(){

			vm.loading 			=	true;
			Schedule.get({
				'param1'		: 	vm.filter.intServiceCategoryId,
				'param2'		: 	'dates',
				'param3'		: 	moment(vm.filter.dateSchedule).format('MMMM DD, YYYY')
			}).$promise.then(function(data){

				var scheduleList 			=	[];
				data.scheduleList 			=	$filter('orderBy')(data.scheduleList, 'created_at', false);
				angular.forEach(data.scheduleList, function(schedule){
					schedule.timeStart		=	moment(schedule.timeStart, 'HH:mm').format('hh:mm a');
					schedule.timeEnd		=	moment(schedule.timeEnd, 'HH:mm').format('hh:mm a');
					if (schedule.strMiddleName == null){
						schedule.strMiddleName			=	'';
					}
					angular.forEach(scheduleList, function(selectedSchedule, index){
						if (schedule.timeStart == selectedSchedule.timeStart){
							if (schedule.status <= selectedSchedule.status){
								scheduleList.splice(index, 1);
							}//end if
						}//end if
					});

					if (vm.filter.intStatus 	!=	0){

						if (vm.filter.intStatus == schedule.status){

							scheduleList.push(schedule);

						}//end if

					}//end if
					else{
						scheduleList.push(schedule);
					}//end else
				});

				vm.scheduleList 		=	$filter('orderBy')(scheduleList, 'timeStart', false);
				vm.loading					=	false;

			});

		}//end function

	});