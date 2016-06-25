<?php

namespace App\Http\Controllers\Api\v2;

use App\Interest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InterestController extends Controller
{
    public function getAllInterests(){

        $interestList = Interest::where('intAtNeed', '=', 0)
                            ->get([
                                'intInterestId',
                                'intNoOfYear'
                            ]);

        foreach ($interestList as $interest){

            $interest->interest_rate = $interest->interestRates()
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

        $interestList   =   Interest::where('intAtNeed', '=', 1)
                                ->get();

        foreach ($interestList as $interest){

            $interest->interest_rate = $interest->interestRates()
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
