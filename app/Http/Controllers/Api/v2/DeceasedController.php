<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\Relationship;

use DB;

class DeceasedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deceasedList           =   Deceased::where('intCustomerIdFK', '=', null)
            ->get();

        foreach($deceasedList as $deceased){

            $deceased->full_name    =   $deceased->strLastName.', '.$deceased->strFirstName.' '.$deceased->strMiddleName;

        }

        return response()
            ->json(
                    [
                        'deceasedList'      =>  $deceasedList
                    ],
                    200
                );
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
        try{
            \DB::beginTransaction();
            $intRelationshipId      =   0;

            if ($request->strRelationshipName != null){

                $relationship       =   Relationship::create([
                    'strRelationshipName'   =>  $request->strRelationshipName
                ]);

                $intRelationshipId  =   $relationship->intRelationshipId;

            }else{

                $intRelationshipId  =   $request->intRelationshipId;

            }

            $deceased           =   Deceased::create([
                    'strFirstName'          =>  $request->strFirstName,
                    'strMiddleName'         =>  $request->strMiddleName,
                    'strLastName'           =>  $request->strLastName,
                    'dateDeath'             =>  $request->dateDeath,
                    'intRelationshipIdFK'   =>  $intRelationshipId,
                    'intCustomerIdFK'       =>  $request->intCustomerId? $request->intCustomerId : null,
                ]);

            $deceased->full_name    =   $deceased->strLastName.', '.$deceased->strFirstName.' '.$deceased->strMiddleName;

            \DB::commit();
            return response()
                ->json(
                        [
                            'deceased'      =>  $deceased
                        ],
                        201
                    );

        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                        [
                            'message'   =>  $e->getMessage()
                        ],
                        500
                    );

        }
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
