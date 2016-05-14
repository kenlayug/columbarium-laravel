var additionalController = angular.module('additionalController',[])
   .run(function($rootScope){
      $rootScope.update = {};
   });

additionalController.controller('ctrl.newAdditional', function($scope, $rootScope, $http){
   $http.get('api/v1/additionalcategory')
      .success(function(data){
         $rootScope.additionalCategories = data;
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.SaveNewAdditional = function(){

      swal({
         title: "Save New Additional",   
         text: "Are you sure to save this additional?",   
         type: "info",   showCancelButton: true,   
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            var data = {
               strAdditionalName : $scope.additional.strAdditionalName,
               strAdditionalDesc : $scope.additional.strAdditionalDesc,
               deciPrice : $scope.additional.deciPrice,
               intAdditionalCategoryId : $scope.additional.intAdditionalCategoryId
            };

            $http.post('api/v1/additional', data)
               .success(function(data){
                  swal("Success!", "Additional is successfully saved.", "success");
                  $rootScope.additionals.push(data);
               })
               .error(function(data){
                  swal("Error!", "Something occured.", "error");
               });

     });

   };

});

additionalController.controller('ctrl.newAdditionalCategory', function($scope, $rootScope, $http){

   $scope.SaveAdditionalCategory = function(){

      var data = {
         strAdditionalCategoryName : $scope.additionalCategory.strAdditionalCategoryName
      };

      swal({
         title: "Save additional category",   
         text: "Are you sure to save this additional category?",   
         type: "info",   showCancelButton: true,   
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            $http.post('api/v1/additionalcategory', data)
               .success(function(data){
                  swal({   title: "This will close automatically.",   
                     text: "Additional category added.",   
                     timer: 1000,   
                     showConfirmButton: false 
                  });
                  $rootScope.additionalCategories.push(data);
                  $('#modalItemCategory').closeModal();
               })
               .error(function(data){
                  swal("Error!", "Something occured.", "error");
               });

     });

   };

});

additionalController.controller('ctrl.additionalTable', function($scope, $rootScope, $http){

   $http.get('api/v1/additional')
      .success(function(data){
         $rootScope.additionals = data;
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.DeactivateAdditional = function(id, index){

      swal({
         title: "Deactivate Additional",   
         text: "Are you sure to deactivate this additional?",   
         type: "info",   showCancelButton: true,   
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            $http.post('api/v1/additional/'+id+"/delete")
               .success(function(data){
                  swal("Success!", "Additional is successfully deactivated.", "success");
                  $rootScope.additionals.splice(index, 1);
               })
               .error(function(data){ 
                  swal("Error!", "Something occured.", "error");
               });

     });

   };

   $scope.UpdateAdditional = function(id, index){

      $rootScope.update.index = index;
      $rootScope.update.intAdditionalId = id;
      $http.get('api/v1/additional/'+id+'/show')
         .success(function(data){
            $rootScope.update.intAdditionalId = data.intAdditionalId;
            $rootScope.update.strAdditionalName = data.strAdditionalName;
            $rootScope.update.strAdditionalDesc = data.strAdditionalDesc;
            $rootScope.update.deciPrice = data.price.deciPrice;
            $('#modalUpdateItem').openModal();
         })
         .error(function(data){
            swal("Error!", "Something occured.", "error");
         });

   };

});

additionalController.controller('ctrl.updateAdditional', function($scope, $rootScope, $http){

   $scope.SaveAdditional = function(){

      swal({
         title: "Save additional category",   
         text: "Are you sure to save this additional category?",   
         type: "info",   showCancelButton: true,   
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            var data = {
               strAdditionalName : $rootScope.update.strAdditionalName,
               strAdditionalDesc : $rootScope.update.strAdditionalDesc,
               deciPrice : $rootScope.update.deciPrice
            };

            $http.post('api/v1/additional/'+$rootScope.update.intAdditionalId+"/update", data)
               .success(function(data){
                  swal("Success!", "Additional is successfully updated.", "success");
                  $rootScope.additionals.splice($rootScope.update.index, 1);
                  $rootScope.additionals.push(data);
                  $('#modalUpdateItem').closeModal();
               })
               .error(function(data){ 
                  swal("Error!", "Something occured.", "error");
               });

     });

   };

});

additionalController.controller('ctrl.deactivatedTable', function($rootScope, $scope, $http){

   $http.get('api/v1/additional/archive')
      .success(function(data){
         $rootScope.deactivatedAdditionals = data;
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.ReactivateAdditional = function(id, index){

      swal({
         title: "Reactivate Additional",   
         text: "Are you sure to reactivate this additional?",   
         type: "info",   showCancelButton: true,   
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            $http.post('api/v1/additional/'+id+"/enable")
               .success(function(data){
                  swal("Success!", "Additional is successfully reactivated.", "success");
                  $rootScope.deactivatedAdditionals.splice(index, 1);
                  $rootScope.additionals.push(data);
               })
               .error(function(data){ 
                  swal("Error!", "Something occured.", "error");
               });

     });

   };

});