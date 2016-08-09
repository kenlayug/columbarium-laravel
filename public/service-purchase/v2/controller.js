'use strict;'

angular.module('app')
	.controller('ctrl.service-purchase', ['$scope', '$rootScope', '$filter', 'appSettings', '$resource',
		function($scope, $rootScope, $filter, appSettings, $resource){

		var vm		=	$scope;
		var rs 		=	$rootScope;
		var scheduleService	=	null;
		var intServiceKey	=	0;
		var selectedSchedules	=	[];

		vm.cartList			=	[];
		vm.dateSchedule		=	new Date();
		vm.showAddTime		=	false;

		var Additionals		=	$resource(appSettings.baseUrl+'v1/additional', {});

		var Services 		=	$resource(appSettings.baseUrl+'v2/services/others', {});

		var Packages		=	$resource(appSettings.baseUrl+'v1/package', {});

		var ScheduleTimes   =   $resource(appSettings.baseUrl+'v2/service-categories/:id/time/:dateSchedule', {
            id: '@id',
            dateSchedule: '@dateSchedule'
        });

        var Deceases		=	$resource(appSettings.baseUrl+'v2/deceases', {});

        var Relationships	=	$resource(appSettings.baseUrl+'v2/relationships', {});

        Deceases.get().$promise.then(function(data){

        	vm.deceasedList		=	$filter('orderBy')(data.deceasedList, 'strFullName', false);

        });

        Relationships.get().$promise.then(function(data){

        	vm.relationshipList		=	$filter('orderBy')(data.relationshipList, 'strRelationshipName', false);

        });

		Additionals.query().$promise.then(function(data){

			vm.additionalList	=	$filter('orderBy')(data, 'strAdditionalName', false);

		});

		Services.get().$promise.then(function(data){

			vm.serviceList			=	$filter('orderBy')(data.serviceList, 'strServiceName', false);

		});

		Packages.query().$promise.then(function(data){

			vm.packageList	=	$filter('orderBy')(data, 'strPackageName', false);

		});

		vm.saveDeceased				=	function(){

			var deceased 		=	new Deceases(vm.newDeceased);
			deceased.$save(function(data){

				vm.deceasedList.push(data.deceased);
				$('#newDeceased').closeModal();
				vm.deceasedList				=	$filter('orderBy')(vm.deceasedList, 'strFullName', false);
				vm.newDeceased				=	null;
				vm.serviceDeceased.strDeceasedName			=	data.deceased.strFullName;

			},
				function(response){

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		var copyAdditional			=	function(additional){

			var localAdditional		=	{};

			localAdditional.strAdditionalName		=	additional.strAdditionalName;
			localAdditional.intAdditionalId			=	additional.intAdditionalId;
			localAdditional.deciPrice				=	additional.price.deciPrice;
			localAdditional.intQuantity				=	1;

			return localAdditional;

		}

		vm.openAdditionalCart		=	function(additional){

			$('#addToCartAdditionals').openModal();
			vm.additionalToAdd			=	copyAdditional(additional);

		}

		var copyService				=	function(service){

			var localService				=	{};

			console.log(service);
			localService.intServiceId		=	service.intServiceId;
			localService.strServiceName		=	service.strServiceName;
			if (service.deciPrice == null){
				localService.deciPrice			=	service.price.deciPrice;
			}else{
				localService.deciPrice			=	service.deciPrice;
			}
			localService.intServiceKey		=	intServiceKey++;
			localService.intServiceForm		=	service.intServiceForm;
			localService.intQuantity		=	1;
			localService.intServiceType		=	service.intServiceType;
			localService.intServiceCategoryId	=	service.intServiceCategoryId;

			return localService;

		}

		vm.openServiceCart			=	function(service){

			$('#addToCartServices').openModal();
			vm.serviceToAdd			=	copyService(service);
			vm.serviceScheduleToAdd	=	[];
			for (var intCtr = 0; intCtr < vm.serviceToAdd.intQuantity; intCtr++){

				vm.serviceScheduleToAdd.push(copyService(vm.serviceToAdd));

			}

		}

		vm.changeQuantityService		=	function(){

			angular.forEach(vm.serviceScheduleToAdd, function(serviceSchedule){

				if (serviceSchedule.scheduleTime != null){

					angular.forEach(selectedSchedules, function(selectedSchedule, index){

						if (selectedSchedule.intSchedServiceId == serviceSchedule.scheduleTime.intSchedServiceId
							&& selectedSchedule.dateSchedule == serviceSchedule.scheduleTime.dateSchedule){

							selectedSchedules.splice(index, 1);

						}

					});

				}

			});
			vm.serviceScheduleToAdd	=	[];
			for (var intCtr = 0; intCtr < vm.serviceToAdd.intQuantity; intCtr++){

				vm.serviceScheduleToAdd.push(copyService(vm.serviceToAdd));

			}

		}

		vm.changeScheduleDate			=	function(service, dateSchedule){

			var date 			=	moment(dateSchedule).format('MMMM D, YYYY');
			ScheduleTimes.get({id: service.intServiceCategoryId, dateSchedule : date}).$promise.then(function(data){

				angular.forEach(data.serviceScheduleList, function(schedule){

					angular.forEach(selectedSchedules, function(selectedSchedule){

						if (schedule.intSchedServiceId == selectedSchedule.intSchedServiceId 
							&& selectedSchedule.dateSchedule == moment(vm.dateSchedule).format('MMMM D, YYYY')){

							schedule.status = 'Reserved';

						}

					});

				});
				vm.serviceScheduleList			=	data.serviceScheduleList;

			});

		}

		vm.scheduleService				=	function(service){

			vm.serviceToSchedule			=	service;
			vm.changeScheduleDate(service, vm.dateSchedule);
			$('#scheduleService').openModal();

		}

		vm.saveTime						=	function(){

			vm.newTime.id 				=	vm.serviceToSchedule.intServiceCategoryId;
			var scheduleTime 			=	new ScheduleTimes(vm.newTime);
			scheduleTime.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.serviceScheduleList.push(data.serviceSchedule);
				vm.newTime				=	null;
				vm.showAddTime			=	false;

			},
				function(response){

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		vm.setTime						=	function(scheduleTime){

			if (vm.serviceToSchedule.scheduleTime != null){

				angular.forEach(selectedSchedules, function(selectedSchedule, index){

					if (selectedSchedule.intSchedServiceId == vm.serviceToSchedule.scheduleTime.intSchedServiceId
						&& selectedSchedule.dateSchedule == vm.serviceToSchedule.scheduleTime.dateSchedule){

						selectedSchedules.splice(index, 1);

					}

				});

			}

			scheduleTime.dateSchedule	=	moment(vm.dateSchedule).format('MMMM D, YYYY');
			selectedSchedules.push(scheduleTime);
			vm.serviceToSchedule.scheduleTime 				=	scheduleTime;
			$('#scheduleService').closeModal();

		}

		vm.addScheduleTime				=	function(){

			vm.showAddTime			=	!vm.showAddTime;

		}

		vm.addDeceasedForm			=	function(service){

			vm.serviceDeceased		=	service;
			$('#deceasedForm').openModal();

		}

		vm.addDeceasedToService		=	function(){

			var boolExist		=	false;
			angular.forEach(vm.deceasedList, function(deceased){

				if (deceased.strFullName == vm.serviceDeceased.strDeceasedName){

					boolExist		=	true;

				}

			});

			if (!boolExist){

				swal('Error!', 'Deceased does not exists.', 'error');

			}else{

				$('#deceasedForm').closeModal();
				vm.serviceDeceased			=	null;

			}

		}

		var serviceAddToCart		=	function(service){

			var boolExist			=	false;

			angular.forEach(vm.cartList, function(objectCart){

				if (objectCart.intServiceId != null){

					if (service.intServiceId == objectCart.intServiceId){

						objectCart.intQuantity += service.intQuantity;
						objectCart.serviceScheduleList = objectCart.serviceScheduleList.concat(service.serviceScheduleList);
						boolExist				=	true;

					}

				}

			});

			if (!boolExist){

				vm.cartList.push(service);

			}

		}

		vm.updateSchedule			=	function(service){

			$('#scheduleAddCart').openModal();
			vm.updateService			=	service;
			console.log(service);

		}

		vm.openPackageCart			=	function(package){

			$('#addToCartPackages').openModal();

		}

		vm.addToCart 				=	function(object){

			if (object.intAdditionalId != null){
				
				additionalAddToCart(object);

			}else if (object.intServiceId != null){

				object.serviceScheduleList		=	vm.serviceScheduleToAdd;
				serviceAddToCart(object);

			}

		}

		var additionalAddToCart		=	function(additional){

			var boolExist			=	false;

			angular.forEach(vm.cartList, function(objectCart){

				if (objectCart.intAdditionalId != null){

					if (additional.intAdditionalId == objectCart.intAdditionalId){

						objectCart.intQuantity += additional.intQuantity;
						boolExist				=	true;

					}

				}

			});

			if (!boolExist){

				vm.cartList.push(additional);

			}

		}

	}]);