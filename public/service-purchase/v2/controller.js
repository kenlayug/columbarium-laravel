'use strict;'

angular.module('app')
	.controller('ctrl.service-purchase', ['$scope', '$rootScope', '$filter', '$window', 'appSettings', '$resource',
		function($scope, $rootScope, $filter, $window, appSettings, $resource, Service){

		var vm		=	$scope;
		var rs 		=	$rootScope;

		var color           =   [
            'orange darken-1',
            'green darken-3',
            'blue darken-3',
            'red darken-3',
            'yellow darken-2',
            'blue darken-3',
            'red accent-1',
            'yellow darken-2'
            ];

		rs.transactionActive 			=	"active";
		rs.servicePurchaseActive		=	"active";

		var scheduleService	=	null;
		var intServiceKey	=	0;
		var selectedSchedules	=	[];
		var selectedDeceasedList 	=	[];
		var update 			=	false;

		vm.cartList			=	[];
		vm.dateSchedule		=	new Date();
		vm.showAddTime		=	false;
		vm.transactionPurchase	=	{};

		vm.newTime 			=	{};

		var ScheduleLog 	=	$resource(appSettings.baseUrl+'v2/service-categories/:id/schedule-logs', {
			id 		: 	'@id'
		});

		var Additionals		=	$resource(appSettings.baseUrl+'v1/additional', {});

		var Services 		=	$resource(appSettings.baseUrl+'v2/services/others', {});

		var ServiceId 		=	$resource(appSettings.baseUrl+'v2/services/:id/requirements', {
			id 		: 	'@id'
		});

		var UnitServices    =   $resource(appSettings.baseUrl+'v2/unit-services/:id', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Service        =   $resource(appSettings.baseUrl+'v2/services/:id', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            }
        });

		var Packages		=	$resource(appSettings.baseUrl+'v1/package', {});

		var PackageInclusion	=	$resource(appSettings.baseUrl+'v1/package/:id/:inclusion', {
			id 			: 	'@id',
			inclusion 	: 	'@inclusion'
		});

		var ScheduleTimes   =   $resource(appSettings.baseUrl+'v2/service-categories/:id/schedule-logs/:slId/:dateSchedule', {
            id: '@id',
            slId: '@slId',
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

        var UnitType    =   $resource(appSettings.baseUrl+'v2/roomtypes/units', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Blocks = $resource(appSettings.baseUrl+'v2/blocks/unitTypes/:id', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var Units = $resource(appSettings.baseUrl+'v2/blocks/:id/units', {}, {
            query: {
                method: 'GET',
                isArray: false
            }
        });

        var StorageTypes    =   $resource(appSettings.baseUrl+'v2/roomtypes/:id/storage-types/info', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var UnitDeceases        =   $resource(appSettings.baseUrl+'v2/units/:id/deceases', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var Relationships	=	$resource(appSettings.baseUrl+'v2/relationships', {});

        var ServicePurchases 	=	$resource(appSettings.baseUrl+'v3/transaction-purchases', {});

        Deceases.get().$promise.then(function(data){

        	vm.deceasedList		=	$filter('orderBy')(data.deceasedList, 'strFullName', false);
        	console.log(vm.deceasedList);

        });

        Customers.query().$promise.then(function(data){

        	vm.customerList			=	$filter('orderBy')(data, 'strFullName', false);

        });

        UnitType.query().$promise.then(function(data){

            $scope.unitTypeList =   $filter('orderBy')(data.roomTypeList, 'strUnitTypeName', false);

        });

        vm.getBlocks 				=	function(unitType, index){

        	if (unitType.blockList    ==  null) {

                rs.loading          =   true;

                Blocks.query({id: unitType.intRoomTypeId}).$promise.then(function (data) {

                    angular.forEach(data.blockList, function(block){

                        block.color = 'orange';

                    });
                    unitType.blockList = data.blockList;
                    rs.loading          =   false;
                    vm.unitTypeIndex 	=	index;

                });

            }

        }//end function

        $scope.getUnits = function(block, intBlockIndex){

            if ($scope.block == null || $scope.block.intBlockId != block.intBlockId){

                if ($scope.lastSelected != null){

                    $scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';

                }

                rs.loading          =   true;

                Units.get({id: block.intBlockId}).$promise.then(function(data){

                    var unitTable = [];
                    var intLevelNoPrev = 0;
                    var intLevelNoCurrent = 0;
                    var unitList = [];
                    var levelLetter =   64;

                    $scope.blockName    =   block.strBuildingCode+'-'+block.intFloorNo+'-'+block.strRoomName+'-Block '+block.intBlockNo;

                    angular.forEach(data.unitList, function(unit, index){

                        unit.color      =   color[unit.intUnitStatus];
                        unit.strUnitStatus  =   status[unit.intUnitStatus];
                        unit.disable  =   '';
                        intLevelNoCurrent = unit.intLevelNo;
                        if (intLevelNoPrev != intLevelNoCurrent){
                            if (index != 0) {
                                unitTable.push(unitList);
                                unitList = [];
                            }
                            intLevelNoPrev = unit.intLevelNo;
                        }

                        unit.display    =   String.fromCharCode(parseInt(levelLetter)+parseInt(unit.intLevelNo))+unit.intColumnNo;

                        unitList.push(unit);
                        if (index == data.unitList.length-1){
                            unitTable.push(unitList);
                        }

                    });

                    $scope.unitStatusCount          =   data.unitStatusCount;

                    $scope.unitList = unitTable;
                    $scope.block    = data.block;
                    $scope.showUnit =   true;
                    swal.close();
                    $scope.unitTypeList[$scope.unitTypeIndex].blockList[intBlockIndex].color = 'orange darken-3';

                    $scope.lastSelected = {};
                    $scope.lastSelected.unitType = $scope.unitTypeIndex;
                    $scope.lastSelected.block   =   intBlockIndex;
                    console.log($scope.lastSelected);

                    rs.loading          =   false;

                });

            }

        }

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
			ServiceId.get({id : vm.serviceToAdd.intServiceId, method : 'requirement'}).$promise.then(function(data){

				vm.serviceToAdd.requirementList 		=	data.requirementList;
				angular.forEach(data.requirementList, function(requirement){

					if (requirement.strRequirementName == 'Deceased Form'){

						vm.serviceToAdd.deceasedForm 		=	true;

					}//end if
					else if (requirement.strRequirementName == 'Unit Form'){

						vm.serviceToAdd.unitForm 			=	true;

					}//end else if

				});

			});
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

		vm.changeScheduleDate			=	function(service, dateSchedule, scheduleLog){

			rs.loading					=	true;
			var date 					=	moment(dateSchedule).format('MMMM D, YYYY');
			ScheduleTimes.get({id: service.intServiceCategoryId, slId: scheduleLog.intScheduleLogId, dateSchedule : date}).$promise.then(function(data){

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

			ScheduleLog.get({
				id : service.intServiceCategoryId
			}).$promise.then(function(data){

				vm.scheduleLogList 				=	$filter('orderBy')(data.scheduleLogList, 'intScheduleLogNo', false);
				vm.serviceToSchedule			=	service;
				vm.changeScheduleDate(service, vm.dateSchedule, vm.scheduleLogList[0]);
				vm.scheduleLog 					=	vm.scheduleLogList[0];
				$('#scheduleService').openModal();

			});

		}

		vm.saveTime						=	function(){

			rs.loading					=	true;
			console.log(vm.newTime);
			vm.newTime.id 				=	vm.serviceToSchedule.intServiceCategoryId;
			vm.newTime.slId 			=	vm.scheduleLog.intScheduleLogId;
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

		vm.scheduleDeceasedList 	=	[];
		vm.addDeceasedToService		=	function(){

			if (vm.serviceDeceased.intDeceasedId != null){

				angular.forEach(selectedDeceasedList, function(selectedDeceased, index){

					if (selectedDeceased.intDeceasedId == vm.serviceDeceased.intDeceasedId
						&& vm.serviceDeceased.intServiceId == vm.serviceDeceased.intServiceId){

						selectedDeceasedList.splice(index, 1);

					}//end if

				});

			}//end if

			var boolExist		=	false;
			var boolDeceasedSelected 			=	false;
			angular.forEach(vm.deceasedList, function(deceased){

				if (deceased.strFullName.trim() == vm.serviceDeceased.strDeceasedName){

					boolExist		=	true;
					vm.serviceDeceased.intDeceasedId	=	deceased.intDeceasedId;
					if (deceased.strMiddleName == null){
						deceased.strMiddleName			=	'';
					}//end if

					angular.forEach(selectedDeceasedList, function(selectedDeceased){

						if (selectedDeceased.intDeceasedId == deceased.intDeceasedId
							&& vm.serviceDeceased.intServiceId == selectedDeceased.intServiceId){

							boolDeceasedSelected 		=	true;

						}//end if

					});

					var scheduleBoolExist 			=	false;
					angular.forEach(vm.scheduleDeceasedList, function(scheduleDeceased){

						if (deceased.intDeceasedId == scheduleDeceased.intDeceasedId){

							scheduleBoolExist 			=	true;

						}//end if

					});

					if (!scheduleBoolExist){

						vm.scheduleDeceasedList.push(deceased);
						vm.scheduleDeceasedList 		=	$filter('orderBy')(vm.scheduleDeceasedList, ['strLastName', 'strFirstName', 'strMiddleName'], false);

					}//end if
					
				}//end if

			});

			if (!boolExist){

				swal('Error!', 'Deceased does not exists.', 'error');

			}else if(boolDeceasedSelected){

				swal('Error!', 'Deceased is already selected for the same service.', 'error');

			}else{

				selectedDeceasedList.push({
					intServiceId 		: 	vm.serviceDeceased.intServiceId,
					intDeceasedId 		: 	vm.serviceDeceased.intDeceasedId
				});
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

		vm.removeScheduleSelected 	=	function(schedule){

			console.log('HERE AT SCHEDULE SELECTED...');
			angular.forEach(selectedSchedules, function(selectedSchedule, index){

				if (selectedSchedule.intSchedServiceId == schedule.scheduleTime.intSchedServiceId
					&& selectedSchedule.dateSchedule == schedule.scheduleTime.dateSchedule){

					console.log('HERE!!!!');
					selectedSchedules.splice(index, 1);

				}//end if

			});

		}//end function

		var serviceAddToCart		=	function(service){

			var validation			=	false;
			var message				=	null;
			console.log(service);

			if (vm.transactionPurchase.boolPreNeed == undefined || !vm.transactionPurchase.boolPreNeed){

				angular.forEach(service.serviceList, function(serviceSchedule){

					var boolDeceasedRequired 		=	false;

					if (serviceSchedule.scheduleTime == null && service.intServiceType == 1){

						validation			=	true;
						message				=	'One or more services do not have schedule yet. Please assign first.';

					}else if (serviceSchedule.strDeceasedName == null && service.deceasedForm == 1){

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

							console.log(objectCart);

							objectCart.intQuantity += service.intQuantity;
							objectCart.serviceList = objectCart.serviceList.concat(service.serviceList);
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

							serviceToAdd 		=	copyService(service);

							ServiceId.get({id : serviceToAdd.intServiceId, method : 'requirement'}).$promise.then(function(data){

								serviceToAdd.requirementList 		=	data.requirementList;
								angular.forEach(serviceToAdd.requirementList, function(requirement){

									if (requirement.strRequirementName == 'Deceased Form'){

										serviceToAdd.deceasedForm 		=	true;

									}//end if
									else if (requirement.strRequirementName == 'Unit Form'){

										serviceToAdd.unitForm 			=	true;

									}//end else if

								});//end foreach

								localPackage.serviceList.push(serviceToAdd);

							});//end function

						}//end for

					});//end foreach

				}//end for

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
			console.log(vm.objectToRemove);

			if (vm.objectToRemove.intQuantity >= vm.objectToRemove.intQuantityToRemove){

				$('#editCart').closeModal();

				vm.objectToRemove.intQuantity 	-=	vm.objectToRemove.intQuantityToRemove;

				vm.transactionPurchase.deciTotalAmountToPay 	-=	(vm.objectToRemove.intQuantityToRemove * vm.objectToRemove.deciPrice);

				if (vm.objectToRemove.strAdditionalName == null && (vm.objectToRemove.serviceList != null || vm.objectToRemove.serviceList.length != 0)){

					if (vm.objectToRemove.serviceList[vm.objectToRemove.serviceList.length-1].intDeceasedId != null){

						angular.forEach(selectedDeceasedList, function(selectedDeceased, index){

							if (selectedDeceased.intDeceasedId == vm.objectToRemove.serviceList[vm.objectToRemove.serviceList.length-1].intDeceasedId
								&& selectedDeceased.intServiceId == vm.objectToRemove.intServiceId){

								selectedDeceasedList.splice(index, 1);

							}//end if

						});

					}//end if
					vm.removeScheduleSelected(vm.objectToRemove.serviceList[vm.objectToRemove.serviceList.length-1]);
					vm.objectToRemove.serviceList.splice(vm.objectToRemove.serviceList.length-1, 1);

				}//end if

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

				angular.forEach(vm.customerList, function(customer){

					if (customer.strMiddleName == null){
						customer.strMiddleName		=	'';
					}//end if
					var strCustomerName		=	customer.strLastName+', '+customer.strFirstName+' '+customer.strMiddleName;
					if (strCustomerName.trim() == vm.transactionPurchase.strCustomerName){
						vm.transactionPurchase.intCustomerId		=	customer.intCustomerId;
					}//end if

				});
				vm.transactionPurchase.deceasedList 			=	vm.scheduleDeceasedList;
				rs.loading					=	true;
				var transactionPurchase 			=	new ServicePurchases(vm.transactionPurchase);
				console.log(vm.transactionPurchase);
				transactionPurchase.$save(function(data){

					vm.success 				=	{
						transactionPurchase 		: 	data.transactionPurchase,
						transactionPurchaseList 	: 	data.transactionPurchaseDetail
					};
					$('#successPackage').openModal();
					$('#serviceBillOut').closeModal();
					vm.transactionPurchase 			=	{};
					vm.cartList						=	[];
					selectedSchedules				=	[];
					rs.loading						=	false;
					boolMonthly 					=	false;

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

	vm.openUnits 				=	function(deceased){

		if (vm.transactionPurchase.strCustomerName == null){
			swal('Error!', 'Customer name cannot be blank before adding to unit.', 'error');
		}//end if
		else{

			var boolExist 				=	false;
			angular.forEach(vm.customerList, function(customer){

				if (customer.strFullName.trim() == vm.transactionPurchase.strCustomerName){

					boolExist			=	true;

				}//end if

			});

			if (boolExist){

				$('#unitForm').openModal();
				vm.deceased 		=	deceased;

			}//end if
			else{

				swal('Error!', 'Customer does not exist.', 'error');

			}//end else

		}//end else

	}//end function

	vm.selectUnit 				=	function(unit){

		if (unit.intUnitStatus == 3 || unit.intUnitStatus == 6 || unit.intUnitStatus == 7){

			if (vm.transactionPurchase.strCustomerName == unit.strCustomerName.trim()){

				UnitDeceases.query({id: unit.intUnitId}).$promise.then(function(deceasedData){

                        var storage             =   0;
                        angular.forEach(deceasedData.deceasedList, function(deceased){
                            if (deceased.strMiddleName == null){
                                deceased.strMiddleName              =   '';
                            }//end if
                            storage             =   deceased.intStorageTypeIdFK;
                        });
                        vm.deceasedList          =   $filter('orderBy')(deceasedData.deceasedList, ['strLastName', 'strFirstName', 'strMiddleName'], false);

                        StorageTypes.query({id: unit.intRoomTypeId}).$promise.then(function(data){

                            vm.storageTypeList      =   $filter('orderBy')(data.storageTypeList, 'strStorageTypeName', false);
                            angular.forEach(vm.storageTypeList, function(storageType){

                                if (storage == storageType.intStorageTypeId){

                                    vm.maxStorage       =   storageType.intQuantity;

                                }//end if

                            });
                            swal.close();

                            UnitServices.query({id: unit.intRoomTypeId}).$promise.then(function(data){

		                        angular.forEach(data.unitServiceList, function(unitService){

		                            Service.get({id : unitService.intServiceIdFK}).$promise.then(function(serviceData){

		                                unitService.service =   serviceData.service;

			                            if (unitService.intServiceTypeId == 1){

			                                vm.add       =   unitService;
			                                vm.intermentService 	=	copyService(unitService.service);

			                            }//end if

		                            });

		                        });

		                    });

							$('#addDeceased').openModal();
							vm.addDeceased 				=	{};
							vm.addDeceased.intUnitId 	=	unit.intUnitId;
							vm.addDeceased.strDeceasedName		=	vm.deceased.strFullName;

                        });
				});

			}//end if
			else{

				swal('Error!', 'Customer is not the owner of this unit.', 'error');

			}//end else

		}else{

			swal('Error!', 'This unit cannot be used yet.', 'error');

		}//end else

	}//end function

	vm.addDeceasedToUnit 				=	function(deceased){

		var validate 				=	false;
		var message					=	null;
		if (deceased.dateInterment == null){
			validate 			=	true;
			message				=	'Date of interment cannot be blank.';
		}//end if
		else if (deceased.timeInterment == null){
			validate 			=	true;
			message				=	'Time of interment cannot be blank.';
		}//end else if
		else if (deceased.intStorageTypeId == null){
			validate 			=	true;
			message				=	'Storage type cannot be blank.';
		}//end else if

		if (validate){

			swal('Error!', message, 'error');

		}//end if
		else{

			var boolExist 					=	false;
			vm.deceased.intermentInfo 		=	deceased;

			angular.forEach(vm.cartList, function(objectCart){

				if (vm.intermentService.intServiceId == objectCart.intServiceId){

					objectCart.intQuantity++;
					boolExist				=	true;

				}

			});

			if (!boolExist){

				vm.cartList.push(vm.intermentService);

			}//end if

			vm.transactionPurchase.deciTotalAmountToPay 		+=	parseFloat(vm.intermentService.deciPrice);

			$('#addDeceased').closeModal();
			$('#unitForm').closeModal();
			vm.block 			=	null;
			$scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';
			$scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].unitList


		}//end else
		
	}//end function

	var boolMonthly 				=	false;
	vm.changePaymentType 			=	function(intPaymentType){

		if (intPaymentType == 2){

			boolMonthly 			=	true;
			vm.transactionPurchase.deciTotalAmountToPay 	/= 	12;

		}//end function
		else if (intPaymentType == 1 && boolMonthly){

			vm.transactionPurchase.deciTotalAmountToPay 	*=	12;

		}//end else if

	}//end function

	$scope.generateReceipt      =   function(id){

        $window.open('http://localhost:8000/pdf/service-purchase-success/'+id);

    }//end function

    $scope.closeBlock           =   function(){

        $scope.showUnit         =   false;
        $scope.unitTypeList[$scope.lastSelected.unitType].blockList[$scope.lastSelected.block].color = 'orange';
        $scope.lastSelected     =   null;
        $scope.block            =   null;

    }//end function

}]);
