/**
 * Created by kenlayug on 7/1/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.service', function($scope, $resource, $filter, appSettings){

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

        var ServiceEnable   =   $resource(appSettings.baseUrl+'v2/services/{id}/enable', {}, {
            enable  :   {
                method  :   'POST',
                isArray :   false
            }
        });

        ServiceCategories.query().$promise.then(function(data){

            $scope.serviceCategoryList  =   $filter('orderBy')(data.serviceCategoryList, 'strServiceCategoryName', false);

        });

        Services.query().$promise.then(function(data){

            $scope.serviceList          =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        ServiceArchive.query().$promise.then(function(data){

            $scope.archiveServiceList   =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        $scope.saveServiceCategory      =   function(){

            ServiceCategories.save($scope.newServiceCategory).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceCategoryList.push(data.serviceCategory);
                $scope.serviceCategoryList  =   $filter('orderBy')($scope.serviceCategoryList, 'strServiceCategoryName', false);

            })
                .catch(function(response){

                    if(response.status  ==  500){

                        swal(response.data.message, response.data.error, 'error');

                    }

                });

        }

        $scope.saveService              =   function(){

            Services.save($scope.newService).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceList.push(data.service);
                $scope.serviceList          =   $filter('orderBy')($scope.serviceList, 'strServiceName', false);

            });

        }

        $scope.getService               =   function(id, index){

            ServiceId.get({id: id}).$promise.then(function(data){

                $scope.updateService        =   data.service;
                $scope.updateService.index  =   index;

            });
            $('#').openModal();

        }

        $scope.updateService            =   function(){

            ServiceId.update({id: $scope.updateService.intServiceId}, $scope.updateService).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.serviceList.splice($scope.updateService.index, 1);
                $scope.serviceList.push(data.service);
                $scope.serviceList          =   $filter('orderBy')($scope.serviceList, 'strServiceName', false);
                $('#').closeModal();

            });

        }

        $scope.deleteService            =   function(id, index){

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

            ServiceEnable.enable({id: id}).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.archiveServiceList.splice(index, 1);
                $scope.serviceList.push(data.service);
                $scope.serviceList      =   $filter('orderBy')($scope.serviceList, 'strServiceName', false);

            });

        }

    });