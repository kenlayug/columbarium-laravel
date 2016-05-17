var additionalController = angular.module('additionalController',[])
   .run(function($rootScope){
      $rootScope.update = {};
   });

additionalController.controller('ctrl.newAdditional', function($scope, $rootScope, $http, $filter){
   $http.get('api/v1/additionalcategory')
      .success(function(data){
         $rootScope.additionalCategories = $filter('orderBy')(data, 'strAdditionalCategoryName', false);
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.SaveNewAdditional = function(){

      if($scope.additional.strAdditionalName == null || $scope.additional.intAdditionalCategoryId == null){
         swal("Error!", "Required fields cannot be null.", "error");
      }else{
         swal({
            title: "Create Additional",   
            text: "Are you sure to create this additional?",   
            type: "warning",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, create it!",    
            cancelButtonText: "No, cancel pls!",
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
                     if (data == 'error-existing'){
                        swal("Error!", "Additional already exists.", "error");
                     }else{
                        swal("Success!", "Additional is successfully created.", "success");
                        $rootScope.additionals.push(data);
                        $rootScope.additionals = $filter('orderBy')($rootScope.additionals, 'strAdditionalName', false);
                        $('#createName').prop('class', 'inactive');
                        $scope.additional.strAdditionalName = "";
                        $('#createPrice').prop('class', 'inactive');
                        $scope.additional.deciPrice = "";
                        $('#createDesc').prop('class', 'inactive');
                        $scope.additional.strAdditionalDesc = "";
                     }
                  })
                  .error(function(data){
                     swal("Error!", "Something occured.", "error");
                  });

        });
      }

   };

});

additionalController.controller('ctrl.newAdditionalCategory', function($scope, $rootScope, $http, $filter){

   $scope.SaveAdditionalCategory = function(){

      var data = {
         strAdditionalCategoryName : $scope.additionalCategory.strAdditionalCategoryName
      };

      if ($scope.additionalCategory.strAdditionalCategoryName == null){
         swal("Error!", "Additional category name cannot be null!", "error");
      }else{

         swal({
            title: "Save additional category",   
            text: "Are you sure to save this additional category?",   
            type: "info",   showCancelButton: true,  
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, save it!",    
            cancelButtonText: "No, cancel pls!", 
            closeOnConfirm: false,   
            showLoaderOnConfirm: true, }, 
            function(){   

               $http.post('api/v1/additionalcategory', data)
                  .success(function(data){
                     if (data == 'error-existing'){
                        swal("Error!", "Additional category already exists.", "error");
                     }else{
                        swal({   title: "This will close automatically.",   
                           text: "Additional category added.",   
                           timer: 1000,   
                           showConfirmButton: false 
                        });
                        $rootScope.additionalCategories.push(data);
                        $rootScope.additionalCategories = $filter('orderBy')($rootScope.additionalCategories, 'strAdditionalCategoryName', false);
                        $('#modalItemCategory').closeModal();
                        $scope.additionalCategory.strAdditionalCategoryName = "";
                     }
                  })
                  .error(function(data){
                     swal("Error!", "Something occured.", "error");
                  });

        });
      }

   };

});

additionalController.controller('ctrl.additionalTable', function($scope, $rootScope, $http, $filter){

   $http.get('api/v1/additional')
      .success(function(data){
         $rootScope.additionals = $filter('orderBy')(data, 'strAdditionalName', false);
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.DeactivateAdditional = function(id, index){

      swal({
         title: "Deactivate Additional",   
         text: "Are you sure to deactivate this additional?",   
         type: "warning",   showCancelButton: true,  
         confirmButtonColor: "#ffa500",   
         confirmButtonText: "Yes, deactivate it!",    
         cancelButtonText: "No, cancel pls!", 
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            $http.post('api/v1/additional/'+id+"/delete")
               .success(function(data){
                  swal("Success!", "Additional is successfully deactivated.", "success");
                  $rootScope.additionals.splice(index, 1);
                  $rootScope.deactivatedAdditionals.push(data);
                  $rootScope.deactivatedAdditionals = $filter('orderBy')($rootScope.deactivatedAdditionals, 'strAdditionalName', false);
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
            $('#lblUpdateName').prop('class', 'active');
            $('#lblUpdatePrice').prop('class', 'active');
            $('#lblUpdateDesc').prop('class', 'active');
            $('#modalUpdateItem').openModal();
         })
         .error(function(data){
            swal("Error!", "Something occured.", "error");
         });

   };

});

additionalController.controller('ctrl.updateAdditional', function($scope, $rootScope, $http, $filter){

   $scope.SaveAdditional = function(){

      if ($rootScope.update.strAdditionalName == null){
         swal("Error!", "Additional name cannot be null.", "error");
      }else{

         swal({
            title: "Update Additional",   
            text: "Are you sure to update this additional?",   
            type: "warning",   showCancelButton: true,   
            confirmButtonColor: "#ffa500",   
            confirmButtonText: "Yes, update it!",    
            cancelButtonText: "No, cancel pls!",
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
                     if(data == 'error-existing'){
                        swal("Error!", "Additional already exists.", "error");
                     }else{
                        swal("Success!", "Additional is successfully updated.", "success");
                        $rootScope.additionals.splice($rootScope.update.index, 1);
                        $rootScope.additionals.push(data);
                        $rootScope.additionals = $filter('orderBy')($rootScope.additionals, 'strAdditionalName', false);
                        $('#modalUpdateItem').closeModal();
                     }
                  })
                  .error(function(data){ 
                     swal("Error!", "Something occured.", "error");
                  });

        });

      }

   };

});

additionalController.controller('ctrl.deactivatedTable', function($rootScope, $scope, $http, $filter){

   $http.get('api/v1/additional/archive')
      .success(function(data){
         $rootScope.deactivatedAdditionals = $filter('orderBy')(data, 'strAdditionalName', false);
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.ReactivateAdditional = function(id, index){

      swal({
         title: "Reactivate Additional",   
         text: "Are you sure to reactivate this additional?",   
         type: "warning",   showCancelButton: true,   
         confirmButtonColor: "#ffa500",   
         confirmButtonText: "Yes, reactivate it!",    
         cancelButtonText: "No, cancel pls!",
         closeOnConfirm: false,   
         showLoaderOnConfirm: true, }, 
         function(){   

            $http.post('api/v1/additional/'+id+"/enable")
               .success(function(data){
                  swal("Success!", "Additional is successfully reactivated.", "success");
                  $rootScope.deactivatedAdditionals.splice(index, 1);
                  $rootScope.additionals.push(data);
                  $rootScope.additionals = $filter('orderBy')($rootScope.additionals, 'strAdditionalName', false);
               })
               .error(function(data){ 
                  swal("Error!", "Something occured.", "error");
               });

     });

   };

});