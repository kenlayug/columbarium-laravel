/**
 * Created by kenlayug on 7/7/16.
 */
'use strict';

angular.module('app')
    .controller('ctrl.utilities', function($scope, $rootScope, $resource, $filter, appSettings){

        var rs                          =   $rootScope;

        rs.utilityActive                =   'active';
        rs.businessDependencyActive     =   'active';

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

        $scope.businessDependencyList   =   {};

        BusinessDependencies.query().$promise.then(function(data){

            $scope.businessDependencyList.downpayment   =   {
                strBusinessDependencyName       :  'downpayment'
            };
            $scope.businessDependencyList.reservationFee   =   {
                strBusinessDependencyName       :  'reservationFee'
            };
            $scope.businessDependencyList.discountPayOnce   =   {
                strBusinessDependencyName       :  'discountPayOnce'
            };
            $scope.businessDependencyList.penalty   =   {
                strBusinessDependencyName       :  'penalty'
            };
            $scope.businessDependencyList.discountSpotdown   =   {
                strBusinessDependencyName       :  'discountSpotdown'
            };
            $scope.businessDependencyList.discountSpecial   =   {
                strBusinessDependencyName       :  'discountSpecial'
            };
            $scope.businessDependencyList.refund   =   {
                strBusinessDependencyName       :  'refund'
            };
            $scope.businessDependencyList.paymentUrn   =   {
                strBusinessDependencyName       :  'paymentUrn'
            };
            $scope.businessDependencyList.gracePeriod   =   {
                strBusinessDependencyName       :  'gracePeriod'
            };
            $scope.businessDependencyList.pcf   =   {
                strBusinessDependencyName       :  'pcf'
            };
            $scope.businessDependencyList.penaltyForNotReturn   =   {
                strBusinessDependencyName       :  'penaltyForNotReturn'
            };
            $scope.businessDependencyList.transferOwnerCharge   =   {
                strBusinessDependencyName       :  'transferOwnerCharge'
            };
            $scope.businessDependencyList.voidReservationNoPayment   =   {
                strBusinessDependencyName       :  'voidReservationNoPayment'
            };
            $scope.businessDependencyList.voidReservationNotFullPayment   =   {
                strBusinessDependencyName       :  'voidReservationNotFullPayment'
            };
            $scope.businessDependencyList.voidOwnershipOverDue   =   {
                strBusinessDependencyName       :  'voidOwnershipOverDue'
            };
            angular.forEach(data.businessDependencyList, function(businessDependency){

                if (businessDependency.strBusinessDependencyName == 'downpayment'){
                    $scope.businessDependencyList.downpayment       =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'reservationFee'){
                    $scope.businessDependencyList.reservationFee    =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'discountPayOnce'){
                    $scope.businessDependencyList.discountPayOnce   =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'penalty'){
                    $scope.businessDependencyList.penalty           =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'discountSpotdown'){
                    $scope.businessDependencyList.discountSpotdown  =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'discountSpecial'){
                    $scope.businessDependencyList.discountSpecial   =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'refund'){
                    $scope.businessDependencyList.refund            =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'maxBonebox'){
                    $scope.businessDependencyList.maxBonebox        =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'maxUrn'){
                    $scope.businessDependencyList.maxUrn            =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'paymentUrn'){
                    $scope.businessDependencyList.paymentUrn        =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'gracePeriod'){
                    $scope.businessDependencyList.gracePeriod       =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'pcf'){
                    $scope.businessDependencyList.pcf       =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'penaltyForNotReturn'){
                    $scope.businessDependencyList.penaltyForNotReturn   =   businessDependency
                }else if (businessDependency.strBusinessDependencyName == 'transferOwnerCharge'){
                    $scope.businessDependencyList.transferOwnerCharge   =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'voidReservationNoPayment'){
                    $scope.businessDependencyList.voidReservationNoPayment  =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName == 'voidReservationNotFullPayment'){
                    $scope.businessDependencyList.voidReservationNotFullPayment  =   businessDependency;
                }else if (businessDependency.strBusinessDependencyName  ==  'voidOwnershipOverDue'){
                    $scope.businessDependencyList.voidOwnershipOverDue  =   businessDependency;
                }

            });

            rs.displayPage();

        });

        $scope.save         =   function(){

            var arr = $.map($scope.businessDependencyList, function(el) { return el });
            var data    =   {
                businessDependencyList      :   arr
            };

            BusinessDependencies.save(data).$promise.then(function(data){

                swal('Success!', data.message, 'success');

            });

        }

    });