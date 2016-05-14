var floorApp = angular.module('floorApp', ['ui.materialize'])
	.run(function($rootScope){
		$rootScope.configure = {};
	});

floorApp.controller('ctrl.buildingCollapsible', function($rootScope, $scope, $http){

	$http.get('api/v1/building/floor')
		.success(function(data){
			$rootScope.buildings = data;
			angular.forEach($rootScope.buildings, function(building){
				var index = 0;
				angular.forEach(building.floor, function(floor){
					if(building.floorStatus[index]){
						floor.icon = 'btn tooltipped modal-trigger btn-floating green right';
					}else{
						floor.icon = 'btn tooltipped modal-trigger btn-floating black right';
					}
					index++;
				});
			});
			console.log($rootScope.buildings);
		})
		.error(function(data){	
			swal("Error!", "Something occured.", "error");
		});

	$scope.ConfigureFloor = function(id, index, buildingId){
		$rootScope.configure.intFloorId = id;
		$rootScope.configure.index = index;
		$rootScope.configure.intBuildingId = buildingId;
		$('#modalConfigure').openModal();

		$http.get('api/v1/floor/'+id)
			.success(function(data){
				angular.forEach(data.details, function(floorDetail){
							var checkbox = '#'+floorDetail.intFloorTypeIdFK;
							console.log(checkbox);
							$(checkbox).prop('checked', true);
						});
			})
	};

});

floorApp.controller('ctrl.configureFloor', function($rootScope, $scope, $http){

	$http.get('api/v1/floortype')
		.success(function(data){
			$rootScope.floorTypes = data;
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ConfigureFloor = function(){
		swal({
			title: "Configure Floor",   
            text: "Are you sure to save this floor configuration?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                var floorTypes = $("input[name='floorTypes[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

		    	var data = {
		    		floorTypeList : floorTypes
		    	};

		    	console.log(data);

		    	$http.post('api/v1/floor/'+$rootScope.configure.intFloorId+'/configure', data)
		    		.success(function(data){
		    			if (data == 'success'){
		    				swal("Success!", "Floor is successfully configured.", "success");
		    				$('#modalConfigure').closeModal();
		    				angular.forEach($rootScope.buildings, function(building){
		    					if (building.intBuildingId == $rootScope.configure.intBuildingId){
		    						building.floor[$rootScope.configure.intFloorId].icon = 'btn tooltipped modal-trigger btn-floating green right';
		    					}
		    				});
		    			}
		    		})
		    		.error(function(data){
		    			console.log(data);
		    			swal("Error!", "Something occured.", "error");
		    		});
        });
	};

});

floorApp.controller('ctrl.newFloorType', function($rootScope, $scope, $http){

	$scope.SaveFloorType = function(){

		swal({
			title: "Create Floor Type",   
            text: "Are you sure to create this floor type?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                
            	var data = {
            		strFloorTypeName : $scope.floorType.strFloorTypeName
            	};

            	$http.post('api/v1/floortype', data)
            		.success(function(data){
            			if (data == 'error-existing'){
            				swal("Warning!", "Floor type already exists.", "warning");
            			}else{
	            			swal({   title: "This will close automatically.",   
				                     text: "Floor type added.",   
				                     timer: 1000,   
				                     showConfirmButton: false 
				                  });
	            			$rootScope.floorTypes.push(data);
	            			$('#modalNewFloorType').closeModal();
	            		}
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});

        });

	};

});

floorApp.controller('ctrl.floorTable', function($rootScope, $scope, $http){
	$http.get('api/v1/building/floor')
		.success(function(data){
			$rootScope.buildings = data;
			angular.forEach($rootScope.buildings, function(building){
				var floorNotYet = 0;
				angular.forEach(building.floorStatus, function(floorStatus){
					if (!floorStatus){
						floorNotYet++;
					}
				});
				building.noFloorConfig = floorNotYet;
			});
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});
});