var floorApp = angular.module('floorApp', ['ui.materialize'])
	.run(function($rootScope){
		$rootScope.configure = {};
	});

floorApp.controller('ctrl.buildingCollapsible', function($rootScope, $scope, $http, $filter){

	$http.get('api/v1/building/floor')
		.success(function(data){
			
			angular.forEach(data, function(building){
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
			angular.forEach(data, function(building){
				var floorNotYet = 0;
				angular.forEach(building.floorStatus, function(floorStatus){
					if (!floorStatus){
						floorNotYet++;
					}
				});
				building.noFloorConfig = floorNotYet;
			});

			$rootScope.buildings = $filter('orderBy')(data, 'strBuildingName', false);
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
				angular.forEach($rootScope.floorTypes, function(floorType){
					var checkbox = '#'+floorType.intFloorTypeId;
					$(checkbox).prop('checked', false);
				});
				angular.forEach(data.details, function(floorDetail){
					var checkbox = '#'+floorDetail.intFloorTypeIdFK;
					console.log(checkbox);
					$(checkbox).prop('checked', true);
				});
			})
	};

});

floorApp.controller('ctrl.configureFloor', function($rootScope, $scope, $http,  $filter){

	$http.get('api/v1/floortype')
		.success(function(data){
			$rootScope.floorTypes = $filter('orderBy')(data, 'strFloorTypeName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ConfigureFloor = function(){
		var floorTypes = $("input[name='floorTypes[]']:checked").map(function() {
		    		return this.value;
		    	}).get();
		if(floorTypes.length == 0){
    		swal("Error!", "You must select one or more floor types.", "error");
    	}else{
			swal({
				title: "Configure Floor",   
	            text: "Are you sure to save this floor configuration?",   
	            type: "warning",   showCancelButton: true,    
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, save it!",     
	            cancelButtonText: "No, cancel pls!",
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   

			    	var data = {
			    		floorTypeList : floorTypes
			    	};

			    	console.log(data);

			    	$http.post('api/v1/floor/'+$rootScope.configure.intFloorId+'/configure', data)
			    		.success(function(data){
			    			if (data == 'success'){
			    				swal("Success!", "Floor is successfully configured.", "success");
			    				$('#modalConfigure').closeModal();
			    				angular.forEach($rootScope.floorTypes, function(floorType){
			    					var checkbox = '#'+floorType.intFloorTypeId;
			    					$(checkbox).prop('checked', false);
			    				});
			    				angular.forEach($rootScope.buildings, function(building){
			    					if (building.intBuildingId == $rootScope.configure.intBuildingId){
			    						angular.forEach(building.floor, function(floor){
			    							if (floor.intFloorId == $rootScope.configure.intFloorId){
			    								if (floor.icon != 'btn tooltipped modal-trigger btn-floating green right'){
			    									building.noFloorConfig = building.noFloorConfig - 1;
			    								}
			    								floor.icon = 'btn tooltipped modal-trigger btn-floating green right';
			    							}
			    						});
			    					}
			    				});
			    			}
			    		})
			    		.error(function(data){
			    			console.log(data);
			    			swal("Error!", "Something occured.", "error");
			    		});
	        });
		}
	};

});

floorApp.controller('ctrl.newFloorType', function($rootScope, $scope, $http){

	$scope.SaveFloorType = function(){

		swal({
			title: "Create Floor Type",   
            text: "Are you sure to create this floor type?",   
            type: "warning",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, create it!",     
            cancelButtonText: "No, cancel pls!", 
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                
            	var data = {
            		strFloorTypeName : $scope.floorType.strFloorTypeName
            	};

            	$http.post('api/v1/floortype', data)
            		.success(function(data){
            			if (data == 'error-existing'){
            				swal("Error!", "Floor type already exists.", "error");
            			}else{
	            			swal({   title: "This will close automatically.",   
				                     text: "Floor type added.",   
				                     type: "success",
				                     timer: 1000,   
				                     showConfirmButton: false 
				                  });
	            			$rootScope.floorTypes.push(data);
	            			$rootScope.floorTypes = $filter('orderBy')($rootScope.floorTypes, 'strFloorTypeName', false);
	            			$scope.floorType.strFloorTypeName = "";
	            			$('#modalNewFloorType').closeModal();
	            		}
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});

        });

	};

});

floorApp.controller('ctrl.floorTable', function($rootScope, $scope, $http, $filter){


});