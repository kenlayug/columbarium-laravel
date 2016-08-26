'use strict;'

angular.module('app')
	.controller('ctrl.assign-schedule', function($scope, $rootScope, $filter, $resource, appSettings, Schedule, ServiceCategory){

		var vm				=	$scope;
		var rs 				=	$rootScope;

		vm.dateNow			=	moment().format('MMMM DD, YYYY');

		var ScheduleTime   =   $resource(appSettings.baseUrl+'v2/service-categories/:id/time/:dateSchedule', {
            id: '@id',
            dateSchedule: '@dateSchedule'
        });

		vm.scheduleStatusList		=	[
			'', 'Available', 'Reserved', 'Rescheduled', 'Cancelled', 'Ongoing', 'Done'
		];

		vm.icons					=	[
			'', '', 'alarm_on', 'restore', 'not_interested', 'query_builder', 'offline_pin'
		];

		vm.changeScheduleList 			=	function(){

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

					scheduleList.push(schedule);
				});

				vm.scheduleList 		=	$filter('orderBy')(scheduleList, 'timeStart', false);
				vm.loading					=	false;

			});

		}

		ServiceCategory.get({param1 : 'scheduled'}).$promise.then(function(data){
			vm.serviceCategoryList 				=	$filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);
			vm.filter			=	{
				intServiceCategoryId 		: 		vm.serviceCategoryList[0].intServiceCategoryId,
				dateSchedule				: 		moment().format('D MMMM, YYYY')
			};
			// vm.changeScheduleList();
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
					param1			: 	schedule.intScheduleDetailId
				});

				scheduleDetail.$save(function(data){
					swal('Success!', data.message, 'success');
					if (data.scheduleDetailLog.strMiddleName == null){
						data.scheduleDetailLog.strMiddleName	=	'';
					}//end if
					vm.scheduleDetailLogList.push(data.scheduleDetailLog);
					vm.scheduleDetailLogList		=	$filter('orderBy')(vm.scheduleDetailLogList, 'created_at', false);
					if (action == 'process'){
						schedule.status 				=	5;
					}else{
						schedule.status 				=	6;
					}//end if else
				},
					function(response){
						if (response.status == 500){
							swal('Error!', response.data.message, 'error');
						}
					});
			});

		}//end function

		vm.reschedule 					=	function(schedule){

			$('#scheduleService').openModal();
			vm.dateSchedule 			=	new Date();
			vm.scheduleToReschedule		=	schedule;
			vm.serviceToSchedule		=	vm.filter.intServiceCategoryId;
			vm.changeScheduleDate(vm.filter.intServiceCategoryId, vm.dateSchedule);

		}//end function

		vm.addScheduleTime				=	function(){

			vm.showAddTime			=	!vm.showAddTime;

		}//end function

		vm.changeScheduleDate			=	function(intServiceCategoryId, dateSchedule){

			rs.loading					=	true;
			var date 					=	moment(dateSchedule).format('MMMM D, YYYY');
			ScheduleTime.get({id: intServiceCategoryId, dateSchedule : date}).$promise.then(function(data){

				vm.serviceScheduleList			=	$filter('orderBy')(data.serviceScheduleList, 'timeStart', false);
				rs.loading						=	false;

			});

		}

		vm.saveTime						=	function(){

			rs.loading					=	true;
			vm.newTime.id 				=	vm.filter.intServiceCategoryId;
			var scheduleTime 			=	new ScheduleTime(vm.newTime);
			scheduleTime.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.serviceScheduleList.push(data.serviceSchedule);
				vm.serviceScheduleList	=	$filter('orderBy')(vm.serviceScheduleList, 'timeStart', false);
				vm.newTime				=	null;
				vm.showAddTime			=	false;
				rs.loading				=	false;

			},
				function(response){

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}
					rs.loading					=	false;

				});

		}

		vm.setTime						=	function(scheduleTime){

			scheduleTime.dateSchedule	=	moment(vm.dateSchedule).format('MMMM D, YYYY');
			Schedule.update({param1 : vm.scheduleToReschedule.intScheduleDetailId},{
				dateSchedule 			: 	scheduleTime.dateSchedule,
				intScheduleServiceId	: 	scheduleTime.intSchedServiceId
			}).$promise.then(function(data){
				swal('Success!', data.message, 'success');
				$('#scheduleService').closeModal();
				vm.scheduleToReschedule.status 		=	3;
				// vm.scheduleList.push(data.scheduleDetail);
				// vm.scheduleList.
				vm.changeScheduleList();
				if (data.scheduleDetailLog.strMiddleName == null){
					data.scheduleDetailLog.strMiddleName	=	'';
				}//end if
				if (data.scheduleDetailLogForReschedule.strMiddleName == null){
					data.scheduleDetailLogForReschedule.strMiddleName	=	'';
				}//end if
				vm.scheduleDetailLogList.push(data.scheduleDetailLog);
				vm.scheduleDetailLogList.push(data.scheduleDetailLogForReschedule);
				vm.scheduleDetailLogList			=	$filter('orderBy')(vm.scheduleDetailLogList, 'created_at', false);
			})
				.catch(function(response){
					if (response.status == 500){
						swal('Error!', response.data.message, 'error');
					}//end if
				});

		}

		vm.cancelSchedule				=	function(schedule){

			swal({
				title	: 	'Are you sure to cancel this schedule?',
				text 	: 	'This action cannot be undo.',
				type	: 	'warning',
				showCancelButton	: 	true,
				closeOnConfirm 		: 	false,
				showLoaderOnConfirm 	: 	true
			}, function(){
				var scheduleDetail 		=	new Schedule({
					param1			: 	schedule.intScheduleDetailId
				});

				scheduleDetail.$delete(function(data){
					swal('Success!', data.message, 'success');
					if (data.scheduleDetailLog.strMiddleName == null){
						data.scheduleDetailLog.strMiddleName	=	'';
					}//end if
					vm.scheduleDetailLogList.push(data.scheduleDetailLog);
					vm.scheduleDetailLogList		=	$filter('orderBy')(vm.scheduleDetailLogList, 'created_at', false);
					schedule.status 				=	4;
				},
					function(response){
						if (response.status == 500){
							swal('Error!', response.data.message, 'error');
						}
					});
			});

		}//end function

	});