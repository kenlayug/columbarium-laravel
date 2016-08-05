'use strict;'

angular.module('app')
	.controller('ctrl.building', function($rootScope, $scope, $filter, $resource, appSettings){

		$rootScope.maintenanceActive			=	'active';
		$rootScope.buildingActive 				=	'active';

		var vm = $scope;
		var rs = $rootScope;

		var Buildings		=	$resource(appSettings.baseUrl+'v2/buildings', {});
		var BuildingId		=	$resource(appSettings.baseUrl+'v2/buildings/:id', {
			id 			: 	'@id'
		},{
			update 		: 	{
				method 	: 	'PUT',
				isArray	: 	false
			}
		});

		var BuildingArchive		=	$resource(appSettings.baseUrl+'v1/building/archive', {});
		var BuildingReactivate	=	$resource(appSettings.baseUrl+'v1/building/:id/enable', {
			id 			: 	'@id'
		});

		var BuildingActivateAll		=	$resource(appSettings.baseUrl+'v2/buildings/activate', {});
		var BuildingDeactivateAll	=	$resource(appSettings.baseUrl+'v2/buildings/deactivate', {});

		Buildings.query().$promise.then(function(data){

			vm.buildingList		=	$filter('orderBy')(data, 'strBuildingName', false);
			BuildingArchive.query().$promise.then(function(data){

				vm.archiveBuildingList	=	$filter('orderBy')(data, 'strBuildingName', false);
				rs.displayPage();

			});

		});

		vm.saveBuilding		=	function(){

			rs.loading		=	true;
			var building 	=	new Buildings(vm.newBuilding);
			building.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.buildingList.push(data.building);
				vm.buildingList		=	$filter('orderBy')(vm.buildingList, 'strBuildingName', false);
				vm.newBuilding		=	null;
				rs.loading			=	false;

			},
				function(response){

					rs.loading			=	false;
					if (response.status == 404){

						swal('Error!', 'Api not found!', 'error');

					}else if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		vm.getBuilding			=	function(building, index){

			rs.loading			=	true;
			var building 		=	BuildingId.get({id : building.intBuildingId}, function(data){

				data.index			=	index;
				vm.updateBuilding	=	data;
				$('#modalUpdateBuilding').openModal();
				rs.loading			=	false;

			});

		}

		vm.saveUpdate			=	function(){

			rs.loading			=	true;
			BuildingId.update({id : vm.updateBuilding.intBuildingId}, vm.updateBuilding).$promise.then(function(data){

				swal('Success!', data.message, 'success');
				vm.buildingList.splice(vm.updateBuilding.index, 1);
				vm.buildingList.push(data.building);
				$('#modalUpdateBuilding').closeModal();
				vm.buildingList			=	$filter('orderBy')(vm.buildingList, 'strBuildingName', false);
				vm.updateBuilding 		=	null;
				rs.loading			=	false;

			})
				.catch(function(response){

					rs.loading			=	false;
					if (response.status == 404){

						swal('Error!', 'Api not found!', 'error');

					}else if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		vm.deleteBuilding		=	function(building, index){

			rs.loading			=	true;
			var building 		=	new BuildingId({id : building.intBuildingId});
			building.$delete(function(data){

				swal('Success!', data.message, 'success');
				vm.buildingList.splice(index, 1);
				vm.archiveBuildingList.push(data.building);
				vm.archiveBuildingList 			=	$filter('orderBy')(vm.archiveBuildingList, 'strBuildingName', false);
				rs.loading			=	false;

			},
				function(response){

					rs.loading			=	false;
					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				});

		}

		vm.reactivateBuilding			=	function(building, index){

			rs.loading			=	true;
			var building 		=	new BuildingReactivate({id : building.intBuildingId});
			building.$save(function(data){

				swal('Success!', data.message, 'success');
				vm.archiveBuildingList.splice(index, 1);
				vm.buildingList.push(data.building);
				vm.buildingList 			=	$filter('orderBy')(vm.buildingList, 'strBuildingName', false);
				rs.loading			=	false;

			},
				function(response){

					rs.loading			=	false;
					if (response.status == 500){

						swal('Error!', response.data.message, 'error');

					}

				})

		}

		vm.activateAllBuilding		=	function(){

			rs.loading			=	true;
			var buildingList 		=	new BuildingActivateAll();
			buildingList.$save(function(data){

				swal('Success!', data.message, 'success');
				$('#modalArchiveBuilding').closeModal();
				vm.archiveBuildingList		=	[];
				vm.buildingList 			=	$filter('orderBy')(data.buildingList, 'strBuildingName', false);
				rs.loading			=	false;

			});

		}

		vm.deactivateAllBuilding		=	function(){

			rs.loading			=	true;
			var buildingList 		=	new BuildingDeactivateAll();
			buildingList.$save(function(data){

				swal('Success!', data.message, 'success');
				$('#modalArchiveBuilding').closeModal();
				vm.buildingList					=	[];
				vm.archiveBuildingList 			=	$filter('orderBy')(data.buildingList, 'strBuildingName', false);
				rs.loading			=	false;

			});

		}

	});