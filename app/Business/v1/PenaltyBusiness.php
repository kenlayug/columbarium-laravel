<?php

namespace App\Business\v1;


use App\ApiModel\v2\BusinessDependency;

class PenaltyBusiness
{
    public function getPenalty($deciCollectionPrice, $intMonthDue){

        $penaltyPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'penalty')
                                    ->first(['deciBusinessDependencyValue']);

        $totalPenaltyPercentage = 0;

        for($intCtr = 1; $intCtr <= $intMonthDue; $intCtr++){

            $intOverDue =   $intMonthDue-$intCtr;
            $penaltyPercentageToAdd = $intOverDue*$penaltyPercentage->deciBusinessDependencyValue;
            $totalPenaltyPercentage += $penaltyPercentageToAdd+$penaltyPercentage->deciBusinessDependencyValue;

        }

        $penaltyAmount = $deciCollectionPrice*$totalPenaltyPercentage;

        return round($penaltyAmount, 2);

    }
}
