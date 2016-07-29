/**
 * Created by kenlayug on 7/1/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.service', function($scope, $resource, $filter, appSettings, mySocket, $rootScope){

        var Requirements        =   $resource(appSettings.baseUrl+'v1/requirement', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var ServiceCategories   =   $resource(appSettings.baseUrl+'v2/service-categories', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var Services        =   $resource(appSettings.baseUrl+'v2/services', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var ServiceId       =   $resource(appSettings.baseUrl+'v2/services/:id', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            },
            update  :   {
                method  :   'PUT',
                isArray :   false
            },
            delete  :   {
                method  :   'DELETE',
                isArray :   false
            }
        });

        var ServiceArchive  =   $resource(appSettings.baseUrl+'v2/services/archive', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var ServiceEnable   =   $resource(appSettings.baseUrl+'v2/services/:id/enable', {}, {
            enable  :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var ServiceRequirement  =   $resource(appSettings.baseUrl+'v2/services/:id/requirements', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        Requirements.query().$promise.then(function(data){

            $scope.requirementList      =   $filter('orderBy')(data, 'strRequirementName', false);

        });

        ServiceCategories.query().$promise.then(function(data){

            $scope.serviceCategoryList  =   $filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);

        });

        Services.query().$promise.then(function(data){

            $scope.serviceList          =   $filter('orderBy')(data.serviceList, 'strServiceName', false);
            $rootScope.loading          =   'loaded';

        });

        ServiceArchive.query().$promise.then(function(data){

            $scope.archiveServiceList   =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        $scope.saveServiceCategory      =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            ServiceCategories.save($scope.newServiceCategory).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceCategoryList.push(data.serviceCategory);
                $scope.serviceCategoryList  =   $filter('orderBy')($scope.serviceCategoryList, 'strServiceCategoryName', false);
                $scope.newServiceCategory   =   null;
                $('#modalServiceCategory').closeModal();

            })
                .catch(function(response){

                    if(response.status  ==  500){

                        swal(response.data.message, response.data.error, 'error');

                    }

                });

        }

        $scope.saveService              =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            $scope.newService.requirementList   =   $("input[name='requirement[]']:checked").map(function() {
                return this.value;
            }).get();

            Services.save($scope.newService).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceList.push(data.service);
                $scope.serviceList          =   $filter('orderBy')($scope.serviceList, 'strServiceName', false);
                $scope.newService           =   null;

            })
                .catch(function(response){

                    if (response.status ==  500){
                        swal(response.data.message, response.data.error, 'error');
                    }

                });

        }

        $scope.viewRequirements         =   function(id){

            ServiceRequirement.query({id: id}).$promise.then(function(data){

                $scope.serviceRequirementList   =   $filter('orderBy')(data.requirementList, 'strRequirementName', false);
                $('#modalViewRequirement').openModal();

            });

        }

        $scope.getService               =   function(id, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            ServiceId.get({id: id}).$promise.then(function(data){

                $scope.updateService        =   data.service;
                $scope.updateService.index  =   index;
                ServiceRequirement.query({id: id}).$promise.then(function(data){

                    angular.forEach($scope.requirementList, function(requirement){
                        var checkbox = '#'+requirement.intRequirementIdFK;
                        $(checkbox).prop('checked', true);
                    });

                    angular.forEach(data.requirementList, function(requirement){
                        var checkbox = '#'+requirement.intRequirementId;
                        $(checkbox).prop('checked', true);
                    });

                });
                $('#modalUpdateService').openModal();
                swal.close();

            });

        }

        $scope.fUpdateService            =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            $scope.updateService.requirementList   =   $("input[name='requirement[]']:checked").map(function() {
                return this.value;
            }).get();

            $scope.updateService.deciPrice          =   $scope.updateService.price.deciPrice;

            ServiceId.update({id: $scope.updateService.intServiceId}, $scope.updateService).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceList.splice($scope.updateService.index, 1);
                $scope.serviceList.push(data.service);
                $scope.serviceList          =   $filter('orderBy')($scope.serviceList, 'strServiceName', false);
                $('#modalUpdateService').closeModal();

            })
                .catch(function(response){

                    if(response.status  ==  500){

                        swal(response.data.message, response.data.error, 'error');

                    }

                });

        }

        $scope.deleteService            =   function(id, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            ServiceId.delete({id: id}).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceList.splice(index, 1);

            })
                .catch(function(response){

                    if (response.status ==  500){

                        swal(data.message, data.error, 'error');

                    }

                });

        }

        $scope.enableService            =   function(id, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            ServiceEnable.enable({id: id}).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.archiveServiceList.splice(index, 1);
                $scope.serviceList.push(data.service);
                $scope.serviceList      =   $filter('orderBy')($scope.serviceList, 'strServiceName', false);

            });

        }

        mySocket.on('new-service-category', function(data){

            $scope.serviceCategoryList.push(JSON.parse(data));
            $scope.serviceCategoryList      =   $filter('orderBy')($scope.serviceCategoryList, 'strServiceCategoryName', false);

        });

    });