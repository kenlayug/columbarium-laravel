/**
 * Created by kenlayug on 7/6/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.package', function($scope, $resource, $filter, appSettings){

        $scope.totalServicePrice    =   0;
        $scope.totalAdditionalPrice =   0;
        $scope.totalPackagePrice    =   0;

        var Packages        =   $resource(appSettings.baseUrl+'v1/package', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var PackageGet      =   $resource(appSettings.baseUrl+'v1/package/:id/show', {}, {
            get     :   {
                method  :   'GET',
                isArray :   false
            }
        });

        var PackageUpdate   =   $resource(appSettings.baseUrl+'v1/package/:id/update', {}, {
            update  :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var PackageAdditional   =   $resource(appSettings.baseUrl+'v1/package/:id/additional', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var PackageService      =   $resource(appSettings.baseUrl+'v1/package/:id/service', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var PackageDelete       =   $resource(appSettings.baseUrl+'v1/package/:id', {}, {
            delete  :   {
                method  :   'DELETE',
                isArray :   false
            }
        });

        var PackageArchive      =   $resource(appSettings.baseUrl+'v1/package/archive', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var PackageEnable       =   $resource(appSettings.baseUrl+'v1/package/:id/enable', {}, {
            enable  :   {
                method  :   'POST',
                isArray :   false
            }
        });

        var Additionals     =   $resource(appSettings.baseUrl+'v1/additional', {}, {
            query   :   {
                method  :   'GET',
                isArray :   true
            }
        });

        var Services     =   $resource(appSettings.baseUrl+'v2/services', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            }
        });

        Packages.query().$promise.then(function(packageList){

            $scope.packageList              =   $filter('orderBy')(packageList, 'strPackageName', false);

        });

        PackageArchive.query().$promise.then(function(archiveList){

            $scope.archivePackageList       =   $filter('orderBy')(archiveList, 'strPackageName', false);

        });

        Additionals.query().$promise.then(function(additionalList){

            $scope.additionalList           =   $filter('orderBy')(additionalList, 'strAdditionalName', false);

        });

        Services.query().$promise.then(function(data){

            $scope.serviceList              =   $filter('orderBy')(data.serviceList, 'strServiceName', false);

        });

        $scope.updateTotalAdditionalPrice   =   function(){

            $scope.totalAdditionalPrice =   0;

            angular.forEach($scope.additionalList, function(additional){

                if (additional.selected){
                    if (additional.intQuantity != null) {
                        $scope.totalAdditionalPrice += (additional.price.deciPrice * additional.intQuantity);
                    }
                }

            });

        }

        $scope.updateTotalServicePrice   =   function(){

            $scope.totalServicePrice    =   0;

            angular.forEach($scope.serviceList, function(service){

                if (service.selected){

                    if (service.intQuantity != null) {

                        $scope.totalServicePrice += (service.price.deciPrice * service.intQuantity);

                    }

                }

            });

        }

        $scope.updateTotalPackagePrice  =   function(){

            $scope.totalPackagePrice    =   0;
            $scope.totalPackagePrice    =   $scope.totalAdditionalPrice + $scope.totalServicePrice;

        }

        $scope.createPackage            =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            $scope.newPackage.additionalList    =   [];
            $scope.newPackage.serviceList       =   [];

            angular.forEach($scope.additionalList, function(additional){

                if (additional.selected){

                    $scope.newPackage.additionalList.push(additional);

                }

            });

            angular.forEach($scope.serviceList, function(service){

                if (service.selected){

                    $scope.newPackage.serviceList.push(service);

                }

            });

            Packages.save($scope.newPackage).$promise.then(function(data){

                swal('Success!', 'Package is successfully saved.', 'success');
                $scope.packageList.push(data);
                $scope.packageList  =   $filter('orderBy')($scope.packageList, 'strPackageName', false);
                $scope.newPackage   =   null;
                resetInclusions();

            });

        }

        var resetInclusions         =   function(){

            angular.forEach($scope.additionalList, function(additional){

                additional.selected     =   null;
                additional.intQuantity  =   null;

            });

            angular.forEach($scope.serviceList, function(service){

                service.selected        =   null;
                service.intQuantity     =   null;

            });

            $scope.totalPackagePrice    =   0;
            $scope.totalServicePrice    =   0;
            $scope.totalAdditionalPrice =   0;

        }

        $scope.getPackage           =   function(id, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            PackageGet.get({id  :   id}).$promise.then(function(data){

                swal.close();
                $scope.updatePackage        =   data;
                $scope.updatePackage.index  =   index;

                angular.forEach($scope.additionalList, function(additional){

                    angular.forEach(data.additionals, function(packageAdditional){

                        if (packageAdditional.intAdditionalIdFK ==  additional.intAdditionalId){

                            additional.selected         =   true;
                            additional.intQuantity      =   packageAdditional.intQuantity;
                            console.log(additional);
                            $scope.totalAdditionalPrice +=  (additional.price.deciPrice * additional.intQuantity);

                        }

                    });

                });

                angular.forEach($scope.serviceList, function(service){

                    angular.forEach(data.services, function(packageService){

                        if (packageService.intServiceIdFK ==  service.intServiceId){

                            service.selected        =   true;
                            service.intQuantity     =   packageService.intQuantity;
                            $scope.totalServicePrice +=  (service.price.deciPrice * service.intQuantity);

                        }

                    });

                });

                $('#modalUpdatePackage').openModal();

            });

        }

        $scope.fUpdatePackage       =   function(){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            $scope.updatePackage.additionalList    =   [];
            $scope.updatePackage.serviceList       =   [];
            $scope.updatePackage.deciPrice         =    $scope.updatePackage.price.deciPrice;

            angular.forEach($scope.additionalList, function(additional){

                if (additional.selected){

                    $scope.updatePackage.additionalList.push(additional);

                }

            });

            angular.forEach($scope.serviceList, function(service){

                if (service.selected){

                    $scope.updatePackage.serviceList.push(service);

                }

            });

            PackageUpdate.update({id    :   $scope.updatePackage.intPackageId}, $scope.updatePackage).$promise.then(function(data){

                swal('Success!', 'Package is successfully updated.', 'success');
                resetInclusions();
                $('#modalUpdatePackage').closeModal();
                $scope.packageList.splice($scope.updatePackage.index, 1);
                $scope.packageList.push(data);
                $scope.packageList  =   $filter('orderBy')($scope.packageList, 'strPackageName', false);

            });

        }

        $scope.closeUpdate      =   function(){

            resetInclusions();

        }

        $scope.viewInclusions   =   function(packageId){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            PackageAdditional.query({id: packageId}).$promise.then(function(additionalList){

                PackageService.query({id: packageId}).$promise.then(function(serviceList){

                    $scope.packageAdditionalList    =   $filter('orderBy')(additionalList, 'strAdditionalName', false);
                    $scope.packageServiceList       =   $filter('orderBy')(serviceList, 'strServiceName', false);
                    $('#modalPackageInclusion').openModal();
                    swal.close();

                });

            });

        }

        $scope.deletePackage    =   function(id, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            PackageDelete.delete({id: id}).$promise.then(function(data){

                swal('Success!', 'Package is successfully deactivated.', 'success');
                $scope.packageList.splice(index, 1);
                $scope.archivePackageList.push(data);
                $scope.archivePackageList   =   $filter('orderBy')($scope.archivePackageList, 'strPackageName', false);

            });

        }

        $scope.enablePackage    =   function(id, index){

            swal({
                title               :   'Please wait...',
                text                :   'Processing your request.',
                showConfirmButton   :   false
            });

            PackageEnable.enable({id: id}).$promise.then(function(data){

                swal('Success!', 'Package is successfully reactivated.', 'success');
                $scope.archivePackageList.splice(index, 1);
                $scope.packageList.push(data);
                $scope.packageList          =   $filter('orderBy')($scope.packageList, 'strPackageName', false);

            });

        }

    });