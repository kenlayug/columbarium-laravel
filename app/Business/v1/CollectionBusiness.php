<?php

namespace App\Business\v1;

use App\ApiModel\v2\BusinessDependency;

class CollectionBusiness
{
    public function getMonthlyAmortization($unitPrice, $interestRate, $yearsToPay){

        try{

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first(['deciBusinessDependencyValue']);

            $downPaymentPrice = $unitPrice*$downpaymentPercentage->deciBusinessDependencyValue;

            $balance = $unitPrice-$downPaymentPrice;

            $monthsToPay = $yearsToPay*12;

//            $interestAmount     =   $balance*

            $monthlyAmortization = ((($balance*($interestRate))*$yearsToPay)+$balance)/$monthsToPay;

            return round($monthlyAmortization, 2);

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
