<?php

namespace App\Business\v1;

class CollectionBusiness
{
    public function getMonthlyAmortization($unitPrice, $interestRate, $yearsToPay){

        try{

            $downPayment = $unitPrice*.30;
            $balance = $unitPrice-$downPayment;
            $monthsToPay = $yearsToPay*12;
            $monthlyAmortization = ((($balance*($interestRate*.01))*$yearsToPay)+$balance)/$monthsToPay;
            return $monthlyAmortization;

        }catch(\Exception $e){
            return $e->getMessage();
        }

    }
}
