<?php

namespace App\Business\v1;

use App\ApiModel\v2\BusinessDependency;

class CollectionBusiness
{
    public function getMonthlyAmortization($unitPrice, $interestRate, $yearsToPay){

        try{

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first(['deciBusinessDependencyValue']);
            $downPayment = $unitPrice*$downpaymentPercentage->deciBusinessDependencyValue;
            $balance = $unitPrice-$downPayment;
            $monthsToPay = $yearsToPay*12;
            $monthlyAmortization = ((($balance*($interestRate*.01))*$yearsToPay)+$balance)/$monthsToPay;
            return $monthlyAmortization;

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
