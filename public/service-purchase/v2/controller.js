'use strict;'

angular.module('app')
	.controller('ctrl.service-purchase', ['$scope', '$rootScope', '$filter', 'appSettings', '$resource',
		function($scope, $rootScope, $filter, appSettings, $resource){

		var vm		=	$scope;
		var rs 		=	$rootScope;
		var scheduleService	=	null;
		var intServiceKey	=	0;
		var selectedSchedules	=	[];
		var update 			=	false;

		vm.cartList			=	[];
		vm.dateSchedule		=	new Date();
		vm.showAddTime		=	false;
		vm.transactionPurchase	=	{};

		var Additionals		=	$resource(appSettings.baseUrl+'v1/additional', {});

		var Services 		=	$resource(appSettings.baseUrl+'v2/services/others', {});

		var ServiceId 		=	$resource(appSettings.baseUrl+'v2/services/:id/requirements', {
			id 		: 	'@id'
		});

		var Packages		=	$resource(appSettings.baseUrl+'v1/package', {});

		var PackageInclusion	=	$resource(appSettings.baseUrl+'v1/package/:id/:inclusion', {
			id 			: 	'@id',
			inclusion 	: 	'@inclusion'
		});

		var ScheduleTimes   =   $resource(appSettings.baseUrl+'v2/service-categories/:id/time/:dateSchedule', {
            id: '@id',
            dateSchedule: '@dateSchedule'
        });

        var Deceases		=	$resource(appSettings.baseUrl+'v2/deceases', {});

        var Customers		=	$resource(appSettings.baseUrl+'v1/customer/:id/:method', {
        	id 		: 		'@id',
        	method	: 		'@method'
        }, {
        	update 	: 	{
        		method 	: 	'POST',
        		isArray	: 	false
        	}
        });

        var CustomerGet =   $resource(appSettings.baseUrl+'v2/customers', {}, {
            get :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var Relationships	=	$resource(appSettings.baseUrl+'v2/relationships', {});

        var ServicePurchases 	=	$resource(appSettings.baseUrl+'v3/transaction-purchases', {});

        Deceases.get().$promise.then(function(data){

        	vm.deceasedList		=	$filter('orderBy')(data.deceasedList, 'strFullName', false);

        });

        Customers.query().$promise.then(function(data){

        	vm.customerList			=	$filter('orderBy')(data, 'strFullName', false);

        });

        vm.updateCustomer			=	function(strCustomerName){

        	update 			=	true;

        	CustomerGet.get({strCustomerName : strCustomerName}).$promise.then(function(data){

        		data.customer.dateBirthday			=	moment(data.customer.dateBirthday);
        		vm.customer 		=	data.customer;

        	});

        }

        vm.saveCustomer				=	function(){

        	rs.loading				=	true;
        	if (update){

        		Customers.update({ id : vm.customer.intCustomerId, method : 'update'}, vm.customer).$promise.then(function(data){

        			vm.transactionPurchase.strCustomerName		=	data.strFullName;
        			angular.forEach(vm.customerList, function(customer, index){

        				if (customer.intCustomerId == data.intCustomerId){

        					vm.customerList.splice(index, 1);

        				}

        			});
        			$('#newCustomer').closeModal();
        			vm.customerList.push(data);
        			vm.customerList				=	$filter('orderBy')(vm.customerList, 'strFullName', false);
        			update 						=	false;
        			rs.loading					=	false;

        		})
        			.catch(function(response){

        				if (response.status == 500){

        					swal('Error!', response.data.message, 'error');

        				}
        				rs.loading					=	false;

        			});

        	}else{

        		var customer 			=	new Customers(vm.customer);
        		customer.$save(function(data){

        			vm.transactionPurchase.strCustomerName	=	data.strFullName;
        			vm.customerList.push(data);
        			vm.customerList			=	$filter('orderBy')(vm.customerList, 'strFullName', false);
        			$('#newCustomer').closeModal();
        			vm.customer 		=	null;
        			rs.loading					=	false;

        		},
        			function(response){

        				if (response.status == 500){

        					swal('Error!', response.data.message, 'error');

        				}
        				rs.loading					=	false;

        			});

        	}

        }

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

			rs.loading					=	true;
			var deceased 		=	new Deceases(vm.newDeceased);
			deceased.$save(function(data){

				vm.deceasedList.push(data.deceased);
				$('#newDeceased').closeModal();
				vm.deceasedList				=	$filter('orderBy')(vm.deceasedList, 'strFullName', false);
				vm.newDeceased				=	null;
				vm.serviceDeceased.strDeceasedName			=	data.deceased.strFullName;
				rs.loading					=	false;

			},
				function(response){

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}
					rs.loading					=	false;

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

			localService.intServiceId		=	service.intServiceId;
			localService.strServiceName		=	service.strServiceName;
			if (service.price != null){
				localService.deciPrice			=	service.price.deciPrice;
			}else if (service.deciPrice != null){
				localService.deciPrice			=	service.deciPrice;
			}
			localService.intServiceKey		=	intServiceKey++;
			localService.intServiceForm		=	service.intServiceForm;
			localService.intQuantity		=	1;
			localService.intServiceType		=	service.intServiceType;
			localService.intServiceCategoryId	=	service.intServiceCategoryId;
			localService.deceasedColor		=	'red';
			localService.scheduleColor		=	'red';

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

			if (vm.serviceScheduleToAdd.length > vm.serviceToAdd.intQuantity){

				for (var intCtr = vm.serviceScheduleToAdd.length-1; intCtr >= vm.serviceToAdd.intQuantity; intCtr--){

					if (vm.serviceScheduleToAdd[intCtr].scheduleTime != null){
						angular.forEach(selectedSchedules, function(selectedSchedule, index){

							if (selectedSchedule.intSchedServiceId == vm.serviceScheduleToAdd[intCtr].scheduleTime.intSchedServiceId
								&& selectedSchedule.dateSchedule == vm.serviceScheduleToAdd[intCtr].scheduleTime.dateSchedule){

								selectedSchedules.splice(index, 1);

							}

						});
					}
					vm.serviceScheduleToAdd.splice(intCtr, 1);

				}

			}else{

				for (var intCtr = vm.serviceScheduleToAdd.length; intCtr < vm.serviceToAdd.intQuantity; intCtr++){

					vm.serviceScheduleToAdd.push(copyService(vm.serviceToAdd));

				}

			}

		}

		vm.changeScheduleDate			=	function(service, dateSchedule){

			rs.loading					=	true;
			var date 					=	moment(dateSchedule).format('MMMM D, YYYY');
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
				rs.loading						=	false;

			});

		}

		vm.scheduleService				=	function(service){

			vm.serviceToSchedule			=	service;
			vm.changeScheduleDate(service, vm.dateSchedule);
			$('#scheduleService').openModal();

		}

		vm.saveTime						=	function(){

			rs.loading					=	true;
			vm.newTime.id 				=	vm.serviceToSchedule.intServiceCategoryId;
			var scheduleTime 			=	new ScheduleTimes(vm.newTime);
			scheduleTime.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.serviceScheduleList.push(data.serviceSchedule);
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
			vm.serviceToSchedule.scheduleColor				=	'light-green';
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
				vm.serviceDeceased.deceasedColor		=	'light-green';
				vm.serviceDeceased			=	null;

			}

		}

		vm.clearScheduleSelected	=	function(serviceScheduleList){

			angular.forEach(serviceScheduleList, function(serviceSchedule){

				if (serviceSchedule.scheduleTime != null){

					angular.forEach(selectedSchedules, function(selectedSchedule, index){

						if (selectedSchedule.intSchedServiceId == serviceSchedule.scheduleTime.intSchedServiceId
							&& selectedSchedule.dateSchedule == serviceSchedule.scheduleTime.dateSchedule){

							selectedSchedules.splice(index, 1);

						}

					});

				}

			});

		}

		var serviceAddToCart		=	function(service){

			var validation			=	false;
			var message				=	null;

			if (vm.transactionPurchase.boolPreNeed == undefined || !vm.transactionPurchase.boolPreNeed){

				angular.forEach(service.serviceList, function(serviceSchedule){

					if (serviceSchedule.scheduleTime == null && service.intServiceType == 1){

						validation			=	true;
						message				=	'One or more services do not have schedule yet. Please assign first.';

					}else if (serviceSchedule.strDeceasedName == null && service.intServiceForm == 1){

						validation			=	true;
						message				=	'Deceased info is required.';

					}

				});

			}

			if (validation){

				swal('Error!', message, 'error');

			}else{

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

				$('#addToCartServices').closeModal();

			}

		}

		var packageAddToCart		=	function(package){

			var validation			=	false;
			var message				=	null;

			if (vm.transactionPurchase.boolPreNeed != 1){

				angular.forEach(package.serviceList, function(serviceSchedule){

					if (serviceSchedule.scheduleTime == null && serviceSchedule.intServiceType == 1){

						validation			=	true;
						message				=	'One or more services do not have schedule yet. Please assign first.';

					}else if (serviceSchedule.strDeceasedName == null && serviceSchedule.intServiceForm == 1){

						validation			=	true;
						message				=	'Deceased info is required.';

					}

				});

			}

			if (validation){

				swal('Error!', message, 'error');

			}else{

				var boolExist			=	false;

				angular.forEach(vm.cartList, function(objectCart){

					if (objectCart.intPackageId != null){

						if (package.intPackageId == objectCart.intPackageId){

							objectCart.intQuantity += package.intQuantity;
							objectCart.serviceList = objectCart.serviceList.concat(package.serviceList);
							boolExist				=	true;

						}

					}

				});

				if (!boolExist){

					vm.cartList.push(package);

				}

				$('#addToCartPackages').closeModal();

			}

		}

		vm.updateSchedule			=	function(objectCart){

			$('#scheduleAddCart').openModal();
			vm.updateObjectCart			=	objectCart;

		}

		var copyPackage				=	function(package, intQuantity){

			var localPackage		=	{};

			localPackage.intPackageId	=	package.intPackageId;
			localPackage.strPackageName	=	package.strPackageName;
			if (package.deciPrice == null){
				localPackage.deciPrice		=	package.price.deciPrice;
			}else{
				localPackage.deciPrice		=	package.deciPrice;
			}
			localPackage.intQuantity	=	intQuantity;
			localPackage.additionalList	=	PackageInclusion.query({id : package.intPackageId, inclusion : 'additional'});
			localPackage.serviceList 	=	[];

			if (package.serviceList != null){

				vm.clearScheduleSelected(package.serviceList);

			}

			PackageInclusion.query({id : package.intPackageId, inclusion : 'service'}).$promise.then(function(data){

				for (var intQuantityCtr = 0; intQuantityCtr < intQuantity; intQuantityCtr++){
					angular.forEach(data, function(service){

						for (var intCtr = 0; intCtr < service.intQuantity; intCtr++){

							localPackage.serviceList.push(copyService(service));

						}

					});

				}

			});

			return localPackage;

		}

		vm.openPackageCart			=	function(package){

			$('#addToCartPackages').openModal();
			vm.packageToAdd			=	copyPackage(package, 1);

		}

		vm.changePackageQuantity	=	function(package){

			if (package.intQuantity > 0){

				vm.packageToAdd			=	copyPackage(package, package.intQuantity);

			}

		}

		var computeTotalAmountToPay		=	function(){

			var deciTotalAmountToPay		=	0;
			angular.forEach(vm.cartList, function(objectCart){

				deciTotalAmountToPay	+=	(objectCart.deciPrice * objectCart.intQuantity);

			});
			return deciTotalAmountToPay;

		}

		vm.addToCart 				=	function(object){

			if (object.intAdditionalId != null){
				
				additionalAddToCart(object);

			}else if (object.intServiceId != null){

				object.serviceList		=	vm.serviceScheduleToAdd;
				serviceAddToCart(object);

			}else if (object.intPackageId != null){

				packageAddToCart(object);

			}

			vm.transactionPurchase.deciTotalAmountToPay	=	computeTotalAmountToPay();
			vm.animation			=	'animated tada infinite';

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

		var copyRequirement		=	function(requirement){

			var localRequirement		=	{};

			localRequirement.intRequirementId		=	requirement.intRequirementId;
			localRequirement.strRequirementName		=	requirement.strRequirementName;

			return localRequirement;

		}

		var addRequirement		=	function(requirement, includedRequirementList){

			angular.forEach(includedRequirementList, function(includedRequirement){

				if (requirement.intRequirementId == includedRequirement.intRequirementId){

					return true;

				}

			});
			return false;

		}

		var requirementList			=	[];
		var getServiceRequirement		=	function(intServiceId, includedRequirementList){

			ServiceId.get({id : intServiceId}).$promise.then(function(data){

				angular.forEach(data.requirementList, function(requirement){

					var boolExist	=	addRequirement(requirement, includedRequirementList);
					if (!boolExist){

						requirementList.push(requirement);

					}

				});

			});

		}

		vm.billOut			=	function(){

			requirementList		=	[];

			angular.forEach(vm.cartList, function(objectCart){

				if (objectCart.intServiceId != null){

					getServiceRequirement(objectCart.intServiceId, requirementList);

				}else if (objectCart.intPackageId != null){

					PackageInclusion.query({id : objectCart.intPackageId, inclusion : 'service'}).$promise.then(function(data){

						angular.forEach(data, function(service){

							getServiceRequirement(service.intServiceId, requirementList);

						});

					});

				}

			});
			vm.requirementList 		=	requirementList;

		}

		vm.openRemoveObject				=	function(objectCart, index){

			$('#editCart').openModal();
			objectCart.index						=	index;
			vm.objectToRemove						=	objectCart;
			vm.objectToRemove.intQuantityToRemove	=	1;

		}

		vm.removeObject 				=	function(){

			if (vm.objectToRemove.intQuantity >= vm.objectToRemove.intQuantityToRemove){

				$('#editCart').closeModal();

				if (vm.objectToRemove.intAdditional == null){

					vm.clearScheduleSelected(vm.objectToRemove.serviceList);

				}//end if

				vm.objectToRemove.intQuantity 	-=	vm.objectToRemove.intQuantityToRemove;
				if (vm.objectToRemove.intQuantity == 0){

					vm.cartList.splice(vm.objectToRemove.index, 1);

				}//end if

			}else{

				swal('Error!', 'Quantity to remove is greater than quantity in the cart.', 'error');

			}//end else

		}//end function removeObject

		vm.processTransaction				=	function(){

			vm.transactionPurchase.cartList		=	vm.cartList;

			var validation						=	false;
			var message							=	null;

			if (vm.transactionPurchase.strCustomerName == null){

				validation				=	true;
				message					=	'Customer name is required.';

			}else if (vm.transactionPurchase.deciAmountPaid == null){

				validation				=	true;
				message					=	'Amount paid cannot be blank.';

			}else if (vm.deciTotalAmountToPay > vm.transactionPurchase.deciAmountPaid){

				validation				=	true;
				message					=	'Amount to pay is greater than amount paid.';

			}else if (vm.transactionPurchase.intPaymentMode == null){

				validation				=	true;
				message					=	'Pick your mode of payment.';

			}else if (vm.transactionPurchase.boolPreNeed == 1 && vm.transactionPurchase.intPaymentType == null){

				validation				=	true;
				message					=	'Pick your payment type.';

			}

			if (validation){

				swal('Error!', message, 'error');

			}else{

				rs.loading					=	true;
				var transactionPurchase 			=	new ServicePurchases(vm.transactionPurchase);
				transactionPurchase.$save(function(data){

					swal('Success!', data.message, 'success');
					$('#serviceBillOut').closeModal();
					vm.transactionPurchase 			=	{};
					vm.cartList						=	[];
					selectedSchedules				=	[];
					rs.loading						=	false;

				},
					function(response){

						if (response.status == 500){

							swal('Error!', response.data.message, 'error');

						}
						rs.loading					=	false;

					});

			}//end else

		}

	vm.changePreNeed			=	function(){

		console.log(vm.transactionPurchase.boolPreNeed);
		if (vm.transactionPurchase.boolPreNeed == true && vm.cartList.length != 0){

			swal('Error!', 'Remove all in the cart first before changing this. Pre need is not checked.', 'error');
			vm.transactionPurchase.boolPreNeed = false;

		}else if (vm.transactionPurchase.boolPreNeed != true && vm.cartList.length != 0){

			swal('Error!', 'Remove all in the cart first before changing this.', 'error');
			vm.transactionPurchase.boolPreNeed = true;

		}

	}

}]);