'use strict;'

angular.module('app')
	.controller('ctrl.interest', function($scope, $rootScope, Interest, $filter){

		var vm 			=	$scope;
		var rs 			=	$rootScope;

		Interest.get().$promise.then(function(data){

			vm.interestList 			=	$filter('orderBy')(data.interestList, 'intNoOfYear', false);

		});

		Interest.get({method : 'archive'}).$promise.then(function(data){

			vm.archiveInterestList		=	$filter('orderBy')(data.interestList, 'intNoOfYear', false);

		});

		vm.saveInterest 			=	function(){

			var interest 			=	new Interest(vm.interest);
			interest.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.interestList.push(data.interest);
				vm.interest 			=	null;
				vm.interestList			=	$filter('orderBy')(vm.interestList, 'intNoOfYear', false);

			},
				function(response){

					swal('Error!', response.data.message, 'error');

				});

		}//end function

		vm.getInterest 			=	function(interest, index){

			Interest.get({ id : interest.intInterestId}).$promise.then(function(data){

				$('#modalUpdateInterest').openModal();
				vm.updateInterest 				=	{
					'intInterestId'			: 	data.interest.intInterestId,
					'intNoOfYear'			: 	data.interest.intNoOfYear,
					'deciRegInterestRate'	: 	data.interest.interest_rate.regular.deciInterestRate,
					'deciAtNeedInterestRate': 	data.interest.interest_rate.atNeed.deciInterestRate,
					'index'					: 	index
				};

			});

		}//end function

		vm.saveUpdate 		=	function(){

			Interest.update({id : vm.updateInterest.intInterestId}, vm.updateInterest).$promise.then(function(data){

				swal('Success!', data.message, 'success');
				$('#modalUpdateInterest').closeModal();
				vm.interestList.splice(vm.updateInterest.index, 1);
				vm.interestList.push(data.interest);
				vm.interestList 			=	$filter('orderBy')(vm.interestList, 'intNoOfYear', false);
				vm.updateInterest 			=	null;

			})
				.catch(function(response){

					swal('Error!', response.data.message, 'error');

				});

		}//end function

		vm.deleteInterest 		=	function(interest, index){

			var interest 		=	new Interest({id : interest.intInterestId});
			interest.$delete(function(data){

				swal('Success!', data.message, 'success');
				vm.archiveInterestList.push(data.interest);
				vm.interestList.splice(index, 1);
				vm.archiveInterestList			=	$filter('orderBy')(vm.archiveInterestList, 'intNoOfYear', false);

			},
				function(response){

					swal('Error!', response.data.message, 'error');

				});

		}//end function

		vm.activateInterest 		=	function(interest, index){

			var interest 		=	new Interest({id : interest.intInterestId, method : 'reactivate'});
			interest.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.archiveInterestList.splice(index, 1);
				vm.interestList.push(data.interest);
				vm.interestList 			=	$filter('orderBy')(vm.interestList, 'intNoOfYear', false);

			},
				function(response){

					swal('Error!', response.status, 'error');

				});

		}//end function

		vm.activateAll 				=	function(){

			var interest 			=	new Interest({method : 'reactivateAll'});
			interest.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.interestList 		=	$filter('orderBy')(data.interestList, 'intNoOfYear', false);
				vm.archiveInterestList 	=	[];

			});


		}//end function

		vm.deactivateAll 				=	function(){

			var interest 			=	new Interest({method : 'deactivateAll'});
			interest.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.archiveInterestList 		=	$filter('orderBy')(data.interestList, 'intNoOfYear', false);
				vm.interestList 	=	[];

			});


		}//end function

	});