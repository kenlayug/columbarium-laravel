var additionalController = angular.module('app');

additionalController.controller('ctrl.newAdditional', function($scope, $rootScope, $http, $filter){
   $http.get('api/v1/additionalcategory')
      .success(function(data){
         $rootScope.additionalCategories = $filter('orderBy')(data, 'strAdditionalCategoryName', false);
      })
      .error(function(data){
         swal("Error!", "Something occured.", "error");
      });

   $scope.SaveNewAdditional = function(){

      if($scope.additional.strAdditionalName == null || $scope.additional.strAdditionalName == " " || $scope.additional.intAdditionalCategoryId == null){
         swal("Error!", "Required fields cannot be null.", "error");
      }else{

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
                   $scope.additional  =   null;
               }
            })
            .error(function(data){
               swal("Error!", "Something occured.", "error");
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

      $http.post('api/v1/additional/'+id+"/delete")
         .success(function(data){
            swal("Success!", "Additional is successfully deactivated.", "success");
            $rootScope.additionals.splice(index, 1);
            $rootScope.archiveAdditionalList.push(data);
            $rootScope.archiveAdditionalList = $filter('orderBy')($rootScope.archiveAdditionalList, 'strAdditionalName', false);
         })
         .error(function(data){ 
            swal("Error!", "Something occured.", "error");
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
            $rootScope.update.deciPrice = parseInt(data.price.deciPrice);
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

         var data = {
            strAdditionalName : $rootScope.update.strAdditionalName,
            strAdditionalDesc : $rootScope.update.strAdditionalDesc,
            deciPrice : $rootScope.update.deciPrice
         };

         $http.post('api/v1/additional/'+$rootScope.update.intAdditionalId+"/update", data)
            .success(function(additional){
               if(data == 'error-existing'){
                  swal("Error!", "Additional already exists.", "error");
               }else{
                  swal("Success!", "Additional is successfully updated.", "success");
                   additional.category = additional.additional_category;
                   swal(additional.price.deciPrice);
                  $rootScope.additionals.splice($rootScope.update.index, 1);
                  $rootScope.additionals.push(additional);
                  $rootScope.additionals = $filter('orderBy')($rootScope.additionals, 'strAdditionalName', false);
                  $('#modalUpdateItem').closeModal();
               }
            })
            .error(function(data){ 
               swal("Error!", "Something occured.", "error");
            });

      }

   };

});

additionalController.controller('ctrl.deactivatedTable', function($rootScope, $scope, $http, $filter, Additional){

   Additional.query({type : 'archive'}).$promise.then(function(data){

      $rootScope.archiveAdditionalList        =  $filter('orderBy')(data, 'strAdditionalName', false);

   });

   $scope.ReactivateAdditional = function(id, index){

      var additional       =       new Additional({id : id, method : 'enable'});
      additional.$save(function(data){

         swal("Success!", "Additional is successfully reactivated.", "success");
         data.category    =   data.additional_category;
         $rootScope.archiveAdditionalList.splice(index, 1);
         $rootScope.additionals.push(data);
         $rootScope.additionals = $filter('orderBy')($rootScope.additionals, 'strAdditionalName', false);

      },
         function(response){

            swal('Error!', 'Something occured.', 'error');

         });

   };

   $scope.DeactivateAll       =  function(){

      var additional       =  new Additional({method : 'deactivate'});
      additional.$save(function(data){

         swal('Success!', data.message, 'success');
         $rootScope.archiveAdditionalList          =  $filter('orderBy')(data.additionalList, 'strAdditionalName', false);
         $rootScope.additionals                    =  [];

      });

   }//end function

   $scope.ReactivateAll       =  function(){

      var additional       =  new Additional({method : 'reactivate'});
      additional.$save(function(data){

         swal('Success!', data.message, 'success');
         $rootScope.additionals          =  $filter('orderBy')(data.additionalList, 'strAdditionalName', false);
         $rootScope.archiveAdditionalList                    =  [];

      });

   }//end function

});