<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interest;
use App\Floor;
use App\Building;
use App\Interest;
use App\InterestRate;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MaintenanceSeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interest           =   Interest::create([
            'intNoOfYear'       =>  1
            ]);

        $interestRate       =   InterestRate::create([
            'deciInterestRate'  =>  0,
            'intInterestIdFK'   =>  $interest->intInterestId
            ]);

        $interest           =   Interest::create([
            'intNoOfYear'       =>  1,
            'intAtNeed'         =>  1
            ]);
        
        $interestRate       =   InterestRate::create([
            'deciInterestRate'  =>  .14,
            'intInterestIdFK'   =>  $interest->intInterestId
            ]);

        $building           =   Building::create([
            'strBuildingName'   =>  'Building PUP',
            'strBuildingCode'   =>  'BP',
            'strBuildingLocation'   =>  'North Blue'
            ]);

        for($intCtr = 0; $intCtr < 3; $intCtr++){

            $floor          =   Floor::create([
                'intBuildingIdFK'       =>  $building->intBuildingId,
                'intFloorNo'            =>  $intCtr
                ]);

        }//end for

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
