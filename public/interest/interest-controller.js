var interestApp = angular.module('interestApp', [])
	.run(function($rootScope){
		$rootScope.update = {};
	});

interestApp.controller('ctrl.newInterest', function($scope, $http, $rootScope){

	$scope.SaveInterest = function(){
		swal({
			title: "Create Interest",   
            text: "Are you sure to create this interest?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   

            	var intAtNeed = 0;
            	var data = {
            		intNoOfYear : $scope.interest.intNoOfYear,
            		intAtNeed : intAtNeed,
            		deciInterestRate : $scope.interest.deciInterestRate
            	};

                $http.post('api/v1/interest', data)
                	.success(function(data){
                		if (data == 'error-existing'){
                			swal("Warning!", "Interest is already existing.", "warning");
                		}else{
                			swal("Success!", "Interest is successfully saved.", "success");
                			$rootScope.interests.push(data);
                		}
                	})
                	.error(function(data){
                		swal("Error!", "Something occured.", "error");
                	});
        });
	};

});

interestApp.controller('ctrl.interestTable', function($rootScope, $scope, $http){

	$http.get('api/v1/interest')
		.success(function(data){
			$rootScope.interests = data;
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.UpdateInterest = function(id, index){
		$http.get('api/v1/'+id+'/show')
			.success(function(data){
				$('#').openModal();
				$rootScope.update.intInterestId = data.intInterestId;
				$rootScope.update.intNoOfYear = data.intNoOfYear;
				$rootScope.update.intAtNeed = data.intAtNeed;
				$rootScope.update.deciInterestRate = data.interest_rate.deciInterestRate;
				$rootScope.update.index = index;
			})
			.error(function(data){
				swal("Error!", "Something occured.", "error");
			});
	};

	$scope.DeactivateInterest = function(id, index){
		swal({
			title: "Deactivate Interest",   
            text: "Are you sure to deactivate this interest?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   

            	$http.post('api/v1/interest/'+id+'/delete')
            		.success(function(data){
            			swal("Success!", "Interest is successfully deactivated.", "success");
            			$rootScope.interests.splice(index, 1);
            			$rootScope.deactivatedInterests.push(data);
            		})
            		.error(function(data){
            			swal("Error!", "Something occured.", "error");
            		});

        });
	};

});

interestApp.controller('ctrl.updateInterest', function($rootScope, $scope, $http){

	$scope.SaveInterest = function(){
		swal({
			title: "Update Interest",   
            text: "Are you sure to update this interest?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   

            	var intAtNeed = 0;
            	var data = {
            		intNoOfYear : $scope.update.intNoOfYear,
            		intAtNeed : intAtNeed,
            		deciInterestRate : $scope.update.deciInterestRate
            	};

                $http.post('api/v1/interest'+$rootScope.update.intInterestId+'/update', data)
                	.success(function(data){
                		$rootScope.interests.push(data);
                		$rootScope.interests.splice($rootScope.update.index, 1);
                		$('#').closeModal();
                	})
                	.error(function(data){
                		swal("Error!", "Something occured.", "error");
                	});
        });
	};

});

interestApp.controller('ctrl.deactivatedTable', function($scope, $rootScope, $http){

	$http.get('api/v1/interest/archive')
		.success(function(data){
			$rootScope.deactivatedInterests = data;
		})
		.error(function(data){
			swal("Error!", "Something occured.", "error");
		});

	$scope.ReactivateInterest = function(id, index){
		swal({
			title: "Reactivate Interest",   
            text: "Are you sure to reactivate this interest?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){ 

                $http.post('api/v1/interest/'+id+'/enable')
                	.success(function(data){
                		swal("Success!", "Interest is successfully reactivated.", "success");
                		$rootScope.deactivatedInterests.splice(index, 1);
                		$rootScope.interests.push(data);
                	})
                	.error(function(data){
                		swal("Error!", "Something occured.", "error");
                	});

        });
	};

});