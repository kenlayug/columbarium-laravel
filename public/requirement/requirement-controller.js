var requirementApp = angular.module('requirementApp', [])
	.run(function($rootScope){
		$rootScope.update = {};
		$rootScope.delete = {};
		$rootScope.hasSucceed = false;
	});

angular.module('requirementApp').directive('successAlert', function($timeout) {
   return {
   	  template: '<div id="card-alert" class="card green" style="margin-top: 20px; height: 70px; width: 410px; margin-left: 40px;">'+
                      '<div class="card-content white-text">'+
                        '<p><i class="mdi-navigation-check"></i> SUCCESS : The requirement has been added.</p>'+
                      '</div>'+
                      '<button ng-click="Close()" type="button" class="close white-text" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">×</span>'+
                      '</button>'+
                    '</div>',
      link: function(scope, element, attrs) {
      		var isClickable = angular.isDefined(attrs.isClickable) && scope.$eval(attrs.isClickable) === true ? true : false;

	        scope.onHandleClick = function() {
	            if (!isClickable) return;
	            console.log('onHandleClick');
	        };
      }
   };
});

requirementApp.controller('ctrl.closeAlert', function($scope, $rootScope){
	$scope.Close = function(){
		$('#divAlert').html('');
	};
});

requirementApp.controller('ctrl.requirementTable', function($scope, $rootScope, $http){
	$http.get('api/v1/requirement')
		.success(function(data){
			console.log(data);
			$rootScope.requirements = data;
		})
		.error(function(data){
			console.log("Error: "+data);
		});

	$scope.UpdateRequirement = function(id, index){
		$http.get('api/v1/requirement/'+id)
			.success(function(data){
				$rootScope.update.intRequirementId = data.intRequirementId;
				$rootScope.update.strRequirementName = data.strRequirementName;
				$rootScope.update.strRequirementDesc = data.strRequirementDesc;
				$('#modalUpdateRequirement').openModal();
				$rootScope.requirements.splice(index, 1);
			})
			.error(function(data){
				console.log('Error: '+data);
			});
	};

	$scope.DeleteRequirement = function(id, index){
		$rootScope.delete.intRequirementId = id;
		$rootScope.requirements.splice(index, 1);
		swal({
			title: "Deactivate Requirement",   
            text: "Are you sure to deactivate this requirement?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.delete('api/v1/requirement/'+$rootScope.delete.intRequirementId)
					.success(function(data){
						console.log('deleted...');
				        swal("Success!", "Requirement is successfully deactivated.", "success");

					})
					.error(function(data){
						console.log('Error: '+data);
				        swal("Error!", "Something occured.", "error");
					});
        });
	};
});

requirementApp.controller('ctrl.deleteRequirement', function($scope, $rootScope, $http){
	$scope.DeleteRequirement = function(){
		$('#modalLoading').openModal();
		$http.delete('api/v1/requirement/'+$rootScope.delete.intRequirementId)
			.success(function(data){
				$('#modalLoading').closeModal();
				$('#modalDeactivateRequirement').closeModal();
				console.log('deleted...');
			})
			.error(function(data){
				console.log('Error: '+data);
			});
	};
});

requirementApp.controller('ctrl.newRequirement', function($scope, $rootScope, $http){
	$scope.SaveRequirement = function(){

		var data = {
			strRequirementName : $scope.requirement.strRequirementName,
			strRequirementDesc : $scope.requirement.strRequirementDesc
		};
		swal({
			title: "Create New Requirement",   
            text: "Are you sure to save this requirement?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.post('api/v1/requirement', data)
					.success(function(data){
						// $('#modalLoading').closeModal();
						console.log('Success...');
						$rootScope.requirements.push(data);
				        // $rootScope.hasSucceed = true;
				        // console.log($rootScope.hasSucceed);
				        swal("Success!", "Requirement is successfully saved.", "success");
					})
					.error(function(data){
						console.log('Error: '+data);
						swal("Error", "Something occured.", "error");
					});
        });
	};
});

requirementApp.controller('ctrl.updateRequirement', function($scope, $rootScope, $http){
	$scope.SaveRequirement = function(){
		$('modalLoading').openModal();
		var data = {
			strRequirementName : $scope.update.strRequirementName,
			strRequirementDesc : $scope.update.strRequirementDesc
		};

		swal({
			title: "Update Requirement",   
            text: "Are you sure to update this requirement?",   
            type: "info",   showCancelButton: true,   
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   
                $http.put('api/v1/requirement/'+$scope.update.intRequirementId, data)
					.success(function(data){
						$('#modalUpdateRequirement').closeModal();
						$rootScope.requirements.push(data);	
						swal("Success!", "Requirement is successfully updated.", "success");
					})
					.error(function(data){
						console.log('Error: '+data);
						swal("Error!", "Something occured.", "error");
					});
        });

		
	};
});