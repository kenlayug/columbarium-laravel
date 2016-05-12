// var app = angular.module('additionalApp', ['ngResource'])
// 	.run(function($rootScope){

// 	});



// app.controller('ctrl.findAllAddCtrl', function($scope, $http){
// 	$http({
// 		method : "GET",
// 		url : "/api/v1/additional"
// 	}).then(function successCallback(response){
// 		$scope.additionalList = response.data;
// 	});
// });

// app.controller('ctrl.newAdditional', function($scope, $http, $rootScope){
// 	$scope.CreateNewAdditional = function(){
// 		console.log($scope.selectAdditionalCategory);
// 		var data = {
// 			strAdditionalName : $scope.strAdditionalName,
// 			strAdditionalDesc : $scope.strAdditionalDesc,
// 			intAdditionalCategoryId : $scope.selectAdditionalCategory.intAdditionalCategoryId,
// 			deciPrice : $scope.deciPrice
// 		};
// 		console.log(data);	
// 		// $http.post('/api/v1/additional', data)
// 		// 	.success(function(data){

// 		// 	});
// 	}
// });

// app.controller('ctrl.getAllAdditionalCategory', function($scope, $http, $rootScope){
// 	$scope.hasLoaded = false;
// 	$http.get('/api/v1/additionalcategory')
// 		.success(function(additionalCategories){
// 			$rootScope.additionalCategories = additionalCategories;
// 			console.log($rootScope.additionalCategories);
// 			$scope.hasLoaded = true;
// 		});
// });

// app.controller('ctrl.newAdditionalCategory', function($scope, $http, $rootScope){

// 	$scope.CreateNewAdditionalCategory = function(){
// 		$scope.successLoad = false;
// 		var vm = $scope;
// 		var data = {
// 			_token : vm.additionalCategory.token,
// 			strAdditionalCategoryName : vm.additionalCategory.strAdditionalCategoryName
// 		};
// 		$http.post('/api/v1/additionalcategory', data)
// 			.success(function(data){
// 				console.log(data);
// 				$rootScope.additionalCategories.push(data);
// 				console.log($rootScope.additionalCategories);
// 				$scope.successLoad = true;
// 				$('#modalItemCategory').closeModal();
// 			})
// 			.error(function(data){
// 				console.log("Error: "+data);
// 			});
// 	}
// });


var additionalController = angular.module('additionalController',[])
   .run(function($rootScope){

   });

angular.module('additionalController').directive('materialSelect', function() {
   return {
      link: function(scope) {
      	console.log("Updating select...");
         $('select').material_select();
      }
   };
});

additionalController.controller('ctrl.newAdditional',['$scope', '$http', '$rootScope', function($scope, $http, $rootScope){
	$scope.hasLoaded = false;
	$http.get('api/v1/additionalcategory')
      .success(function(data){
         $scope.additionalCategories = data;
         console.log('values are placed...');
         $scope.hasLoaded = true;
      })
      .error(function(data){
         console.log(data);
      });

   var itemCategory = null;

   $scope.getSelectValue = function(selectedUser){
      console.log(selectedUser);
      itemCategory = selectedUser;
   }

   $scope.CreateNewAdditional = function(){
      var data = {
         _token : $scope.token,
         strAdditionalName : $scope.strAdditionalName,
         deciPrice : $scope.deciPrice,
         strAdditionalDesc : $scope.strAdditionalDesc,
         intAdditionalCategoryId : itemCategory.intAdditionalCategoryId
      };
      console.log(data);
      $http.post('api/v1/additional', data)
         .success(function(data){
            console.log(data);
            $rootScope.additionals.push(data);
         })
         .error(function(data){
            console.log(data);
         });

   };

}]);

additionalController.controller('ctrl.tblAdditionals',['$scope', '$http','$rootScope', function($scope, $http, $rootScope){
   
   $http.get('api/v1/additional')
      .success(function(data){
         $rootScope.additionals = data;
         console.log(data);
      });

   $scope.UpdateAdditional = function(intAdditionalId, index){
      console.log(intAdditionalId);
      $http.get('api/v1/additional/'+intAdditionalId)
         .success(function(data){
            console.log(data);
            $('#additionalIdUpdate').val(data.intAdditionalId);
            console.log(data.intAdditionalId);
            $('#additionalNameUpdate').val(data.strAdditionalName);
            $('#additionalDescUpdate').val(data.strAdditionalDesc);
            $('#additionalPriceUpdate').val(data.price.deciPrice);
            $('#modalUpdateItem').openModal();
            $rootScope.indexToUpdate = index;
         })
         .error(function(data){
            console.log(data);
         });
   };

}]);

additionalController.controller('ctrl.updateAdditional', ['$scope', '$http', '$rootScope', function($scope, $http, $rootScope){

   $scope.UpdateAdditional = function(){
      var data = {
         _token : $scope.token,
         strAdditionalName : document.getElementById('additionalNameUpdate').value,
         strAdditionalDesc : document.getElementById('additionalDescUpdate').value,
         deciPrice : document.getElementById('additionalPriceUpdate').value
      };
      console.log(data);

      $http.put('api/v1/additional/'+document.getElementById('additionalIdUpdate').value, data)
         .success(function(data){
            console.log(data);
            $('#modalUpdateItem').closeModal();
            console.log($rootScope.indexToUpdate);
            console.log($rootScope.additionals);
            $rootScope.additionals.splice($rootScope.indexToUpdate, 1);
            console.log($rootScope.additionals);
            // $rootScope.additionals.push(data);
         })
         .error(function(data){
            console.log("Error: "+data);
         });

   };

}]);

