(function(){
	'use strict';
	angular.module('app')
		.controller('ctrl.employee', function($scope, $rootScope, $filter, Position, Employee){

			var vm 			=	$scope;
			var rs 			=	$rootScope;

			Position.get().$promise.then(function(data){

				sortPosition(data.positionList);

			});

			Employee.get().$promise.then(function(data){

				sortEmployee(data.employeeList);

			});

			var sortEmployee 				=	function(employeeList){

				vm.employeeList 			=	$filter('orderBy')(employeeList, ['strLastName', 'strFirstName', 'strMiddleName'], false);

			}//end function

			var sortPosition				=	function(positionList){

				vm.positionList 			=	$filter('orderBy')(positionList, 'strPositionName', false);

			}//end function

			vm.savePosition 				=	function(){

				var position 				=	new Position(vm.position);
				position.$save(function(data){

					swal('Success!', data.message, 'success');
					vm.position.push(data.position);
					sortPosition(vm.positionList);
					vm.position 		=	null;
					$('#modalCreatePosition').closeModal();

				},
					function(response){

						swal('Error!', response.data.message, 'error');

					});

			}//end function

			vm.saveEmployee 				=	function(){

				var employee 			=	new Employee(vm.employee);
				employee.$save(function(data){

					swal('Success!', data.message, 'success');
					vm.employeeList.push(data.employee);
					sortEmployee(vm.employeeList);
					vm.employee 			=	null;

				},
					function(response){

						swal('Error!', response.data.message, 'error');

					});

			}//end function

		});
})();