/**
 * Created by kenlayug on 7/7/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.utilities', function($scope, $resource, $filter, appSettings){

        var BusinessDependencies    =   $resource(appSettings.baseUrl+'v2/business-dependencies', {}, {
            query   :   {
                method  :   'GET',
                isArray :   false
            },
            save    :   {
                method  :   'POST',
                isArray :   false
            }
        });

        BusinessDependencies.query().$promise.then(function(data){

            $scope.businessDependencyList   =   $filter('orderBy')(data.businessDependencyList, 'strBusinessDependencyName', false);
            // angular.forEach(data.businessDependencyList, function(businessDependency){
            //
            //     if (businessDependency.strBusinessDependencyName == 'downpayment'){
            //         $scope.businessDependencyList.downpayment       =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == 'reservationFee'){
            //         $scope.businessDependencyList.reservationFee    =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == 'discountPayOnce'){
            //         $scope.businessDependencyList.discountPayOnce   =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == 'penalty'){
            //         $scope.businessDependencyList.penalty           =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == 'discountSpotdown'){
            //         $scope.businessDependencyList.discountSpotdown  =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == 'discountSpecial'){
            //         $scope.businessDependencyList.discountSpecial   =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == 'refund'){
            //         $scope.businessDependencyList.refund            =   businessDependency;
            //     }else if (businessDependency.strBusinessDependencyName == '')
            //
            // });

        });

        $scope.save         =   function(businessDependencyName, businessDependencyValue, index){

            var data    =   {
                strBusinessDependencyName   :   businessDependencyName,
                deciBusinessDependencyValue :   businessDependencyValue
            };

            BusinessDependencies.save(data).$promise.then(function(data){

                swal('Success!', data.message, 'success');
                $scope.businessDependencyList.splice(index, 1);
                $scope.businessDependencyList.push(data.businessDependency);
                $scope.businessDependencyList   =   $filter('orderBy')($scope.businessDependencyList, 'strBusinessDependencyName', false);

            });

        }

    });