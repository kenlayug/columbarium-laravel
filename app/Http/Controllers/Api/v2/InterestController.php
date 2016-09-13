<?php

namespace App\Http\Controllers\Api\v2;

use App\Interest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InterestController extends Controller
{
    public function getAllInterests(){

        $interestList = Interest::get([
                                'intInterestId',
                                'intNoOfYear'
                            ]);

        foreach ($interestList as $interest){

            $interest->interest_rate = $interest->interestRates()
                ->where('intAtNeed', '=', 0)
                ->orderBy('created_at', 'desc')
                ->first([
                    'deciInterestRate',
                    'intInterestRateId'
                ]);

        }

        return response()
            ->json(
                [
                    'interestList'      =>  $interestList
                ],
                200
            );
    }

    public function getAllAtNeedInterests(){

        $interestList   =   Interest::get();

        foreach ($interestList as $interest){

            $interest->interest_rate = $interest->interestRates()
                ->where('intAtNeed', '=', 1)
                ->orderBy('created_at', 'desc')
                ->first([
                    'deciInterestRate',
                    'intInterestRateId'
                ]);

        }

        return response()
            ->json(
                [
                    'interestList'      =>  $interestList
                ],
                200
            );

    }
}
