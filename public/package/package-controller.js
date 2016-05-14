var packageController = angular.module('packageController', [])
	.run(function($rootScope){
		$rootScope.totalAmount = 0;
		$rootScope.update = {};
	});

packageController.controller('ctrl.prepareAdditional', function($scope, $http, $rootScope){

	$scope.totalAdditionalPrice = 0;
	$scope.checkAdditional = [];

	$http.get('api/v1/additional')
		.success(function(data){
			$rootScope.additionals = data;
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

packageController.controller('ctrl.prepareService', function($scope, $rootScope, $http){
	
	$scope.totalServicePrice = 0;
	$scope.checkService = [];

	$http.get('api/v1/service')
		.success(function(data){
			$rootScope.services = data;
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

packageController.controller('ctrl.newPackage', function($scope, $rootScope, $http){

	$scope.CreatePackage = function(){

		swal({
			title: "Create Package",   
            text: "Are you sure to create this package?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   

            	var additionals = $("input[name='additionals[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

		    	var services = $("input[name='services[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

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
                			swal("Warning!", "Package already exists.", "warning");
                		}else{
	                		swal("Success!", "Package is successfully saved.", "success");
	                		$rootScope.packages.push(data);
	                	}
                	})
                	.error(function(data){
                		console.log(data);
                		swal("Error!", "Something occured.", "error");
                	});
        });

	};

});

packageController.controller('ctrl.packageTable', function($scope, $rootScope, $http){

	$http.get('api/v1/package')
		.success(function(data){
			$rootScope.packages = data;
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
				$rootScope.update.deciPrice = data.price.deciPrice;

				$http.get('api/v1/package/'+id+'/service')
					.success(function(data){
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
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/package/'+id+'/delete')
					.success(function(data){
						swal("Success!", "Package is successfully deactivated.", "success");
						$rootScope.packages.splice(index, 1);
						$rootScope.deactivatedPackages.push(data);
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
				$rootScope.packageAdditionals = data;
				console.log(data);
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});

		$http.get('api/v1/package/'+id+'/service')
			.success(function(data){
				$rootScope.packageServices = data;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});

	};

});

packageController.controller('ctrl.updatePackage', function($scope, $rootScope, $http){

	$scope.SavePackage = function(){

		var additionals = $("input[name='additionals[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

		    	var services = $("input[name='services[]']:checked").map(function() {
		    		return this.value;
		    	}).get();

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
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/package/'+$rootScope.update.intPackageId+'/update', data)
					.success(function(data){
						if (data == 'error-existing'){
							swal("Warning!", "Package already exists.", "warning");
						}else{
							swal("Success!", "Package is successsfully updated.", "success");
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

	};

});

packageController.controller('ctrl.deactivatedTable', function($scope, $rootScope, $http){

	$http.get('api/v1/package/archive')
		.success(function(data){
			$rootScope.deactivatedPackages = data;
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivatePackage = function(id, index){
		swal({
			title: "Reactivate Package",   
            text: "Are you sure to reactivate this package?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
            	$http.post('api/v1/package/'+id+'/enable')
            		.success(function(data){
            			swal("Success!", "Package is successfully reactivated.", "success");
            			$rootScope.deactivatedPackages.splice(index, 1);
            			$rootScope.packages.push(data);
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});
        });
	};

});