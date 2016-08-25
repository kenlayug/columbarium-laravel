'use strict;'

angular.module('app')
	.controller('ctrl.assign-schedule', function($scope, $rootScope, $filter, Schedule, ServiceCategory){

		var vm				=	$scope;
		var rs 				=	$rootScope;

		vm.scheduleStatusList		=	[
			'', 'Available', 'Reserved', 'Rescheduled', 'Cancelled', 'Ongoing', 'Done'
		];

		vm.icons					=	[
			'', '', '', 'restore', 'not_interested', 'query_builder', 'offline_pin'
		];

		vm.filter			=	{
			intServiceCategoryId 		: 		1,
			dateSchedule				: 		moment().format('D MMMM, YYYY')
		};

		vm.changeScheduleList 			=	function(){

			Schedule.get({
				'param1'		: 	vm.filter.intServiceCategoryId,
				'param2'		: 	'dates',
				'param3'		: 	moment(vm.filter.dateSchedule).format('MMMM DD, YYYY')
			}).$promise.then(function(data){

				angular.forEach(data.scheduleList, function(schedule){
					schedule.timeStart		=	moment(schedule.timeStart, 'HH:mm').format('hh:mm a');
					schedule.timeEnd		=	moment(schedule.timeEnd, 'HH:mm').format('hh:mm a');
					if (schedule.status.strMiddleName == null && schedule.status != 1){
						schedule.status.strMiddleName			=	'';
					}
				});

				vm.scheduleList 		=	$filter('orderBy')(data.scheduleList, 'timeStart', false);

			});

		}

		ServiceCategory.get().$promise.then(function(data){
			vm.serviceCategoryList 				=	$filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);
			vm.filter.intServiceCategoryId		=	vm.serviceCategoryList[0].intServiceCategoryId;
			vm.changeScheduleList();
		});

		Schedule.get().$promise.then(function(data){
			angular.forEach(data.scheduleDetailLogList, function(scheduleDetailLog){
				scheduleDetailLog.timeStart		=	moment(scheduleDetailLog.timeStart, 'HH:mm').format('hh:mm a');
				scheduleDetailLog.timeEnd		=	moment(scheduleDetailLog.timeEnd, 'HH:mm').format('hh:mm a');
				if (scheduleDetailLog.strMiddleName == null){
					scheduleDetailLog.strMiddleName			=	'';
				}
			});
			vm.scheduleDetailLogList			=	$filter('orderBy')(data.scheduleDetailLogList, 'created_at', false);
		});

		vm.processSchedule				=	function(schedule, action){

			swal({
				title	: 	'Are you sure to '+action+' this schedule?',
				text 	: 	'This action cannot be undo.',
				type	: 	'warning',
				showCancelButton	: 	true,
				closeOnConfirm 		: 	false,
				showLoaderOnConfirm 	: 	true
			}, function(){
				var scheduleDetail 		=	new Schedule({
					param1			: 	schedule.status.intScheduleDetailId
				});

				scheduleDetail.$save(function(data){
					swal('Success!', data.message, 'success');
					if (data.scheduleDetailLog.strMiddleName == null){
						data.scheduleDetailLog.strMiddleName	=	'';
					}//end if
					vm.scheduleDetailLogList.push(data.scheduleDetailLog);
					vm.scheduleDetailLogList		=	$filter('orderBy')(vm.scheduleDetailLogList, 'created_at', false);
					if (action == 'process'){
						schedule.status.intScheduleStatus 				=	5;
					}else{
						schedule.status.intScheduleStatus 				=	6;
					}//end if else
				},
					function(response){
						if (response.status == 500){
							swal('Error!', response.data.message, 'error');
						}
					});
			});

		}//end function

	});