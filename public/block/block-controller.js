var blockApp = angular.module('blockApp', ['ui.materialize'])
	.run(function($rootScope){
		$rootScope.block = {};
		$rootScope.update = {};
		$rootScope.tableShow = true;
		$rootScope.levelShow = false;
		console.log($rootScope.tableShow+" -- "+$rootScope.levelShow);
		$rootScope.unitcategory = {};
		$rootScope.NoConfigFloor = false;
	});

blockApp.controller('ctrl.buildingCollapsible', function($scope, $rootScope, $http, $filter){

	$http.get('api/v1/building')
		.success(function(data){
			$rootScope.buildings = $filter('orderBy')(data, 'strBuildingName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.GetBuilding = function(id, index){
		$http.get('api/v1/building/'+id+'/floor')
			.success(function(data){
				$rootScope.NoConfigFloor = false;
				if(data.length == 0){
					$rootScope.NoConfigFloor = true;
				}
				$rootScope.buildings[index].floors = data;
				$rootScope.buildingIndex = index;
				$rootScope.buildingCode = $rootScope.buildings[index].strBuildingCode;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.GetFloorBlock = function(id, index){
		$http.get('api/v1/floor/'+id+'/block')
			.success(function(data){
				$rootScope.buildings[$rootScope.buildingIndex].floors[index].blocks = $filter('orderBy')(data, 'strBlockName', false);
				angular.forEach($rootScope.buildings[$rootScope.buildingIndex].floors[index].blocks, function(block){
					if (block.intUnitType == 1){
						block.icon = 'dashboard';
					}else{
						block.icon = 'view_quilt';
					}
					console.log(block.intUnitType);
				});
				$rootScope.floorIndex = index;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.CreateBlock = function(id, index){
		$http.get('api/v1/floor/'+id+'/floortype')
			.success(function(data){
				$rootScope.unitTypes = data;
				$rootScope.block.intFloorId = id;
				$rootScope.floorIndex = index;
				$('#modalCreateBlock').openModal();
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.PriceConfig = function(id, index){
		$http.get('api/v1/block/'+id+'/unitCategory')
			.success(function(data){
				$rootScope.tableShow = false;
				$rootScope.unitCategories = data;

			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.UpdateBlock = function(id, index){
		$http.get('api/v1/block/'+id+'/show')
			.success(function(data){
				$('#modalUpdateBlock').openModal();
				$rootScope.update.intBlockId = data.intBlockId;
				$rootScope.update.strBlockName = data.strBlockName;
				$rootScope.blockIndex = index;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.DeactivateBlock = function(id, index){
		swal({
			title: "Deactivate Block",   
            text: "Are you sure to deactivate this block?",   
            type: "warning",   showCancelButton: true,  
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, deactivate it!",    
            cancelButtonText: "No, cancel pls!", 
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/block/'+id+'/delete')
            		.success(function(data){
        				swal("Success!", "Block is successfully deactivated.", "success");
        				$rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks.splice(index, 1);
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});
        });
	};

});

blockApp.controller('ctrl.newBlock', function($scope, $rootScope, $http, $filter){

	$scope.SaveBlock = function(){

		var intUnitType = 0;
		if ($("input[name=unitType]:checked").val() == 'Columbary Vault'){
			intUnitType = 1;
		}else{
			intUnitType = 2;
		}
		console.log(intUnitType);
		var data = {
			strBlockName : $scope.block.strBlockName,
			intFloorId : $scope.block.intFloorId,
			intLevelNo : $scope.block.intLevelNo,
			intColumnNo : $scope.block.intColumnNo,
			intUnitType : intUnitType
		};

		swal({
			title: "Create Block",   
            text: "Are you sure to create this block?",   
            type: "warning",   showCancelButton: true,  
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, create it!",    
            cancelButtonText: "No, cancel pls!", 
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/block', data)
            		.success(function(data){
            			if (data == 'error-existing'){
            				swal("Error!", "Block name is already taken.", "error");
            			}else{
            				swal("Success!", "Block is successfully created.", "success");
            				$('#modalCreateBlock').closeModal();
            				if (data.intUnitType == 1){
            					data.icon = 'dashboard';
            				}else{
            					data.icon = 'view_quilt';
            				}
            				$scope.block.strBlockName = "";
            				$scope.block.intLevelNo = "";
            				$scope.block.intColumnNo = "";
            				$rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks.push(data);
            				$rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks = $filter('orderBy')($rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks, 'strBlockName', false);
            			}
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});
        });

	};

});

blockApp.controller('ctrl.updateBlock', function($rootScope, $scope, $http, $filter){

	$scope.SaveBlock = function(){
		var data = {
			strBlockName : $rootScope.update.strBlockName
		};

		swal({
			title: "Update Block",   
            text: "Are you sure to update this block?",   
            type: "warning",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, update it!",    
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/block/'+$rootScope.update.intBlockId+'/update', data)
            		.success(function(data){
            			if (data == 'error-existing'){
            				swal("Error!", "Block name is already taken.", "error");
            			}else{
            				swal("Success!", "Block is successfully updated.", "success");
            				$('#modalUpdateBlock').closeModal();
            				$rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks.splice($rootScope.blockIndex, 1);
            				$rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks.push(data);
            				$rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks = $filter('orderBy')($rootScope.buildings[$rootScope.buildingIndex].floors[$rootScope.floorIndex].blocks, 'strBlockName', false);
            			}
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});
        });

	};

});

blockApp.controller('ctrl.blockTable', function($rootScope, $scope, $http, $filter){

	$http.get('api/v1/block')
		.success(function(data){
			$rootScope.blocks = $filter('orderBy')(data, 'strBlockName', false);
			angular.forEach($rootScope.blocks, function(block){
				if (block.intUnitType == 1){
					block.strUnitType = 'Columbary Vaults';
				}else{
					block.strUnitType = 'Full Body Crypts';
				}
			});
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

});

blockApp.controller('ctrl.deactivatedTable', function($rootScope, $scope, $http, $filter){

	$http.get('api/v1/block/archive')
		.success(function(data){
			$rootScope.deactivatedBlocks = $filter('orderBy')(data, 'strBlockName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivateBlock = function(id, index){

		swal({
			title: "Reactivate Block",   
            text: "Are you sure to reactivate this block?",   
            type: "warning",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, reactivate it!",    
            cancelButtonText: "No, cancel pls!",
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/block/'+id+'/enable')
            		.success(function(data){
            			swal("Success!", "Block is successfully reactivated.", "success");
            			$rootScope.deactivatedBlocks.splice(index, 1);
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});
        });

	};

});

blockApp.controller('ctrl.configPrice', function($scope, $rootScope, $http){

	$scope.CloseConfig = function(){
		$rootScope.tableShow = true;
		console.log($rootScope.tableShow);
	};

	$scope.OpenConfig = function(id, index){
		$http.get('api/v1/unitcategory/'+id+'/show')
			.success(function(data){

				var deciPrice = 0.00;
				if (data.price != null){
					deciPrice = data.price.deciPrice;
				}

				swal({   title: "Configure Price",   
                         text: "Enter the desired price for Level "+data.intLevelNo+":",   
                         type: "input",   showCancelButton: true,   
                         closeOnConfirm: false,
                         confirmButtonColor: "#ffa500",   
             			 confirmButtonText: "Save Price",
                         animation: "slide-from-top",   
                         inputType: "number",
                         inputPlaceholder: "Prev. Price: P"+deciPrice,
                         showLoaderOnConfirm: true, }, 
                         function(inputValue){   
                            if (inputValue === false) return false;      
                            if (inputValue === "") {     
                            	swal.showInputError("Price cannot be null!");     
                            	return false;
                            }
                            var data = {
                            	deciPrice: inputValue
                            };
                            $http.post('api/v1/unitcategory/'+id+'/update', data)
                            	.success(function(data){
                            		swal("Success!", "Price is successfully saved.", "success");
                            	})
                            	.error(function(data){
                            		swal("Error!", "Something occured.", "error");
                            	});
                        	
                    });

			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

});