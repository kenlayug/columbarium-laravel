var packageController = angular.module('packageController', [])
	.run(function($rootScope){
		$rootScope.totalAmount = 0;
		$rootScope.update = {};
	});

packageController.controller('ctrl.prepareAdditional', function($scope, $http, $rootScope, $filter){

	$scope.totalAdditionalPrice = 0;
	$scope.checkAdditional = [];

	$http.get('api/v1/additional')
		.success(function(data){
			$rootScope.additionals = $filter('orderBy')(data, 'strAdditionalName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.AddAdditional = function(deciPrice, index){
		console.log("Here in AddAdditional function...");
		if ($scope.checkAdditional[index]){
			$scope.totalAdditionalPrice = $scope.totalAdditionalPrice+parseInt(deciPrice);
			$rootScope.totalAmount = $rootScope.totalAmount+parseInt(deciPrice);
		}else{
			$scope.totalAdditionalPrice = $scope.totalAdditionalPrice-parseInt(deciPrice);
			$rootScope.totalAmount = $rootScope.totalAmount-parseInt(deciPrice);
		}
	}

});

packageController.controller('ctrl.prepareService', function($scope, $rootScope, $http, $filter){
	
	$scope.totalServicePrice = 0;
	$scope.checkService = [];

	$http.get('api/v1/service')
		.success(function(data){
			$rootScope.services = $filter('orderBy')(data, 'strServiceName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.AddService = function(deciPrice, index){
		console.log("Here in AddService function...");
		if ($scope.checkService[index]){
			$scope.totalServicePrice = $scope.totalServicePrice+parseInt(deciPrice);
			$rootScope.totalAmount = $rootScope.totalAmount+parseInt(deciPrice);
		}else{
			$scope.totalServicePrice = $scope.totalServicePrice-parseInt(deciPrice);
			$rootScope.totalAmount = $rootScope.totalAmount-parseInt(deciPrice);
		}
	}

});

packageController.controller('ctrl.newPackage', function($scope, $rootScope, $http, $filter){

	$scope.CreatePackage = function(){

		var additionals = $("input[name='additionals[]']:checked").map(function() {
    		return this.value;
    	}).get();

    	var services = $("input[name='services[]']:checked").map(function() {
    		return this.value;
    	}).get();

    	if ((additionals.length + services.length) < 2){
    		swal("Error!", "Select two or more additionals or services!", "error");
    	}else if($scope.strPackageName == null){
    		swal("Error!", "Package name cannot be null!", "error");
    	}else{

			swal({
				title: "Create Package",   
	            text: "Are you sure to create this package?",   
	            type: "info",   showCancelButton: true,  
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, create it!",    
	            cancelButtonText: "No, cancel pls!",   
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   

	                var data = {
	                	strPackageName : $scope.strPackageName,
	                	strPackageDesc : $scope.strPackageDesc,
	                	deciPrice : $scope.deciPrice,
	                	additionalList : additionals,
	                	serviceList : services
	                };
	                console.log(data);

	                $http.post('api/v1/package', data)
	                	.success(function(data){
	                		if (data === 'error-existing'){
	                			swal("Error!", "Package already exists.", "error");
	                		}else{
	                			angular.forEach($rootScope.services, function(service){
									var checkbox = '#Service'+service.intServiceId;
									$(checkbox).prop('checked', false);
								});
								angular.forEach($rootScope.additionals, function(additional){
									var checkbox = '#'+additional.intAdditionalId;
									$(checkbox).prop('checked', false);
								});
								$scope.strPackageName = "";
								$scope.strPackageDesc = "";
								$scope.deciPrice = "";
		                		swal("Success!", "Package is successfully saved.", "success");
		                		$rootScope.packages.push(data);
		                		$rootScope.packages = $filter('orderBy')($rootScope.packages, 'strPackageName', false);
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

packageController.controller('ctrl.packageTable', function($scope, $rootScope, $http, $filter){

	$http.get('api/v1/package')
		.success(function(data){
			$rootScope.packages = $filter('orderBy')(data, 'strPackageName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.UpdatePackage = function(id, index){
		$http.get('api/v1/package/'+id+'/show')
			.success(function(data){
				$rootScope.update.strPackageName = data.strPackageName;
				$rootScope.update.strPackageDesc = data.strPackageDesc;
				$rootScope.update.intPackageId = data.intPackageId;
				$rootScope.update.index = index;
				$rootScope.update.deciPrice = parseInt(data.price.deciPrice);

				$http.get('api/v1/package/'+id+'/service')
					.success(function(data){
						angular.forEach($rootScope.services, function(service){
							var checkbox = '#Service'+service.intServiceId;
							$(checkbox).prop('checked', false);
						});
						angular.forEach(data, function(service){
							var checkbox = '#Service'+service.intServiceId;
							$(checkbox).prop('checked', true);
						});
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});

				$http.get('api/v1/package/'+id+'/additional')
					.success(function(data){
						angular.forEach($rootScope.additionals, function(additional){
							var checkbox = '#'+additional.intAdditionalId;
							$(checkbox).prop('checked', false);
						});
						angular.forEach(data, function(additional){
							var checkbox = '#'+additional.intAdditionalId;
							$(checkbox).prop('checked', true);
						});
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});

				$('#modalUpdatePackage').openModal();
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.DeactivatePackage = function(id, index){

		swal({
			title: "Deactivate Package",   
            text: "Are you sure to deactivate this package?",   
            type: "info",   showCancelButton: true,    
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, deactivate it!",    
            cancelButtonText: "No, cancel pls!",  
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/package/'+id+'/delete')
					.success(function(data){
						swal("Success!", "Package is successfully deactivated.", "success");
						$rootScope.packages.splice(index, 1);
						$rootScope.deactivatedPackages.push(data);
						$rootScope.deactivatedPackages = $filter('orderBy')($rootScope.deactivatedPackages, 'strPackageName', false);
					})
					.error(function(data){
						swal("Error!", "Something occured.", "error");
					});
        });

	};

	$scope.ViewPackage = function(id){

		$('#modalListOfRequirement').openModal();
		$http.get('api/v1/package/'+id+"'/additional")
			.success(function(data){
				$rootScope.packageAdditionals = $filter('orderBy')(data, 'strAdditionalName', false);
				console.log(data);
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});

		$http.get('api/v1/package/'+id+'/service')
			.success(function(data){
				$rootScope.packageServices = $filter('orderBy')(data, 'strServiceName', false);
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});

	};

});

packageController.controller('ctrl.updatePackage', function($scope, $rootScope, $http, $filter){

	$scope.SavePackage = function(){

		var additionals = $("input[name='additionals[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

		    	var services = $("input[name='services[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

		if ((additionals.length + services.length) < 2){
			swal("Error!", "Select two or more additionals or services!", "error");
		}else if($rootScope.update.strPackageName == null){
			swal("Error!", "Package name cannot be null.", "error");
		}else{

			var data = {
				strPackageName : $rootScope.update.strPackageName,
				strPackageDesc: $rootScope.update.strPackageDesc,
				deciPrice : $rootScope.update.deciPrice,
				serviceList : services,
				additionalList : additionals
			};

			swal({
				title: "Update Package",   
	            text: "Are you sure to update this package?",   
	            type: "info",   showCancelButton: true,   
	            confirmButtonColor: "#ffa500",   
	            confirmButtonText: "Yes, update it!",    
	            cancelButtonText: "No, cancel pls!",   
	            closeOnConfirm: false,   
	            showLoaderOnConfirm: true, }, 
	            function(){   
	            	$http.post('api/v1/package/'+$rootScope.update.intPackageId+'/update', data)
						.success(function(data){
							if (data == 'error-existing'){
								swal("Warning!", "Package already exists.", "warning");
							}else{
								swal("Success!", "Package is successsfully updated.", "success");
								$rootScope.packages.splice($rootScope.update.index, 1);
								$rootScope.packages.push(data);
								$rootScope.packages = $filter('orderBy')($rootScope.packages, 'strPackageName', false);
							}
						})
						.error(function(data){
							console.log(data);
							if (data == 'error-existing'){
								swal("Warning!", "Package already exists.", "warning");
							}else{
								swal("Error!", "Something occured.", "error");
							}
						});
	        });

		}

	};

});

packageController.controller('ctrl.deactivatedTable', function($scope, $rootScope, $http, $filter){

	$http.get('api/v1/package/archive')
		.success(function(data){
			$rootScope.deactivatedPackages = $filter('orderBy')(data, 'strPackageName', false);
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivatePackage = function(id, index){
		swal({
			title: "Reactivate Package",   
            text: "Are you sure to reactivate this package?",   
            type: "info",   showCancelButton: true,    
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, reactivate it!",    
            cancelButtonText: "No, cancel pls!",  
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/package/'+id+'/enable')
            		.success(function(data){
            			swal("Success!", "Package is successfully reactivated.", "success");
            			$rootScope.deactivatedPackages.splice(index, 1);
            			$rootScope.packages.push(data);
            			$rootScope.packages = $filter('orderBy')($rootScope.packages, 'strPackageName', false);
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});
        });
	};

});