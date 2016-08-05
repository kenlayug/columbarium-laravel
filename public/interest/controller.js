'use strict;'

angular.module('app')
	.controller('ctrl.interest', function($scope, $filter, $rootScope, $resource, appSettings, DTOptionsBuilder, DTColumnDefBuilder){

		$rootScope.interestActive 		=	'active';
		$rootScope.maintenanceActive	=	'active';
		$rootScope.loading				=	true;

		var vm			=	$scope;
		var rs 			=	$rootScope;
		var queryInterest				=	false;
		var queryArchive				=	false;

		vm.dtOptions = DTOptionsBuilder.newOptions()
			.withOption('responsive', true);
		vm.dtOptions.withDisplayLength(3);

		var Interest	=	$resource(appSettings.baseUrl+'v2/interests', {}, {
			query		: 	{
				method	: 	'GET',
				isArray	: 	true
			}
		});

		var InterestId	=	$resource(appSettings.baseUrl+'v2/interests/:id', { id : '@id'},
			{
				update : {
					method : 'PUT',
					isArray : false
				}

			}
		);

		var InterestArchive		=	$resource(appSettings.baseUrl+'v1/interests/archive', {}, {
			query		: 	{
				method	: 	'GET',
				isArray	: 	true
			}
		});

		var InterestActivate	=	$resource(appSettings.baseUrl+'v1/interests/:id/enable', {
			id : '@id'
		});

		var InterestActivateAll	=	$resource(appSettings.baseUrl+'v2/interests/activateAll', {});

		var InterestDeactivateAll	=	$resource(appSettings.baseUrl+'v2/interests/deactivateAll', {});

		Interest.query().$promise.then(function(data){

			vm.interestList			=	$filter('orderBy')(data, 'intNoOfYear', false);
	        queryInterest			=	true;
	        if (queryArchive){

	        	rs.displayPage();

	        }

		});

		InterestArchive.query().$promise.then(function(data){

			vm.archiveInterestList	=	$filter('orderBy')(data, 'intNoOfYear', false);
			queryArchive			=	true;
			if (queryInterest){

			    rs.displayPage();

			}

		});

		vm.saveInterest			=	function(){

			$rootScope.loading	=	true;
			var interest 		=	new Interest(vm.interest);
			interest.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.interestList.push(data.interest);
				vm.interestList			=	$filter('orderBy')(vm.interestList, 'intNoOfYear', false);
				vm.interest 		=	null;
				$rootScope.loading	=	false;

			},
				function(response){

					$rootScope.loading	=	false;
					if(response.status == 500){

						swal('Error!', response.data.message, 'error');

					}else if (response.status == 404){

						swal('Error!', 'Api not found!', 'error');

					}

				});

		}

		vm.getInterest			=	function(interest, index){

			$rootScope.loading	=	true;
			var interest 		=	InterestId.get({id : interest.intInterestId}, function(data){

				data.index				=	index;
				data.deciInterestRate	=	data.interestRate.deciInterestRate;
				vm.updateInterest		=	data;
				$('#modalUpdateInterest').openModal();
				$rootScope.loading	=	false;

			});

		}

		vm.saveUpdate			=	function(){

			$rootScope.loading	=	true;
			InterestId.update({id : vm.updateInterest.intInterestId}, vm.updateInterest).$promise.then(function(data){

				swal('Success!', data.message, 'success');
				$('#modalUpdateInterest').closeModal();
				vm.interestList.splice(vm.updateInterest.index, 1);
				vm.interestList.push(data.interest);
				vm.interestList			=	$filter('orderBy')(vm.interestList, 'intNoOfYear', false);
				vm.updateInterest 		=	null;
				$rootScope.loading	=	false;

			})
				.catch(function(response){
			
					$rootScope.loading	=	false;

					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		};

		vm.deleteInterest		=	function(interest, index){

			$rootScope.loading	=	true;

			var interest 		=	new InterestId({id : interest.intInterestId});
			interest.$delete(interest, function(data){

				swal('Success!', data.message, 'success');
				vm.interestList.splice(index, 1);
				vm.archiveInterestList.push(data.interest);
				vm.archiveInterestList		=	$filter('orderBy')(vm.archiveInterestList, 'intNoOfYear', false);
				$rootScope.loading	=	false;

			},
				function(response){

				$rootScope.loading	=	false;
					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		vm.activateInterest		=	function(interest, index){

			$rootScope.loading	=	true;
			var interest 		=	new InterestActivate({id : interest.intInterestId});
			interest.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.archiveInterestList.splice(index, 1);
				vm.interestList.push(data.interest);
				vm.interestList 		=	$filter('orderBy')(vm.interestList, 'intNoOfYear', false);
				$rootScope.loading	=	false;

			},
				function(response){

					$rootScope.loading	=	false;
					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		vm.activateAll 			=	function(){

			$rootScope.loading	=	true;
			var interests 		=	new InterestActivateAll();
			interests.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.interestList 		=	data.interestList;
				vm.archiveInterestList	=	[];
				$rootScope.loading	=	false;

			});

		}

		vm.deactivateAll 			=	function(){

			$rootScope.loading	=	true;
			var interests 		=	new InterestDeactivateAll();
			interests.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.archiveInterestList 		=	data.interestList;
				vm.interestList	=	[];
				$rootScope.loading	=	false;

			});

		}

	});