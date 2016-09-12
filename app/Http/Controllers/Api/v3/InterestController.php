<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v3\Interest;
use App\ApiModel\v3\InterestRate;

use DB;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(
                [
                    'interestList'      =>  $this->queryInterest(null)
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

            DB::beginTransaction();

            $interest           =   Interest::create([
                'intNoOfYear'       =>  $request->intNoOfYear
                ]);

            InterestRate::create([
                'intInterestIdFK'   =>  $interest->intInterestId,
                'intAtNeed'         =>  false,
                'deciInterestRate'  =>  $request->deciRegInterestRate
                ]);

            InterestRate::create([
                'intInterestIdFK'   =>  $interest->intInterestId,
                'intAtNeed'         =>  true,
                'deciInterestRate'  =>  $request->deciAtNeedInterestRate
                ]);

            DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Interest is successfully created.',
                        'interest'      =>  $this->queryInterest($interest->intInterestId)
                    ],
                    201
                );

        }catch(Exception $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  $e->getMessage
                    ],
                    500
                );

        }//end catch
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()
            ->json(
                [
                    'interest'      =>  $this->queryInterest($id)
                ],
                200
            );
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
        try{

            DB::beginTransaction();
            $interest           =   Interest::find($id);

            $interest->intNoOfYear      =   $request->intNoOfYear;
            $interest->save();

            $interest           =   $this->queryInterest($id);

            if ($interest->interest_rate['regular']->deciInterestRate != $request->deciRegInterestRate){

                InterestRate::create([
                    'intInterestIdFK'       =>  $interest->intInterestId,
                    'intAtNeed'             =>  false,
                    'deciInterestRate'      =>  $request->deciRegInterestRate
                    ]);

            }//end if

            if ($interest->interest_rate['atNeed']->deciInterestRate != $request->deciAtNeedInterestRate){

                InterestRate::create([
                    'intInterestIdFK'       =>  $interest->intInterestId,
                    'intAtNeed'             =>  true,
                    'deciInterestRate'      =>  $request->deciAtNeedInterestRate
                    ]);

            }//end if

            DB::commit();

            return response()
                ->json(
                    [
                        'message'           =>  'Interest is successfully updated.',
                        'interest'          =>  $this->queryInterest($id)
                    ],
                    201
                );

        }catch(Exception $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  $e->getMessage()
                    ],
                    500
                );

        }//end catch
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interest           =   Interest::find($id);

        $interest->delete();

        return response()
            ->json(
                [
                    'message'       =>  'Interest is successfully deactivated.',
                    'interest'      =>  $interest
                ],
                201
            );
    }

    public function archive(){

        $interestList           =   Interest::onlyTrashed()
            ->select('intInterestId', 'intNoOfYear')
            ->get();

        return response()
            ->json(
                [
                    'interestList'      =>  $interestList
                ],
                200
            );

    }//end function

    public function reactivate($id){

        $interest           =   Interest::onlyTrashed()
            ->where('intInterestId', '=', $id)
            ->first()
            ->restore();

        return response()
            ->json(
                [
                    'message'           =>  'Interest is successfully reactivated.',
                    'interest'          =>  $this->queryInterest($id)
                ],
                201
            );

    }//end function

    public function deactivateAll(){

        $interestList       =   Interest::all();

        foreach($interestList as $interest){

            $interest->delete();

        }//end foreach

        return response()
            ->json(
                [
                    'message'       =>  'All Interests are successfully deactivated.',
                    'interestList'  =>  Interest::onlyTrashed()
                        ->get()
                ],
                201
            );

    }//end function

    public function reactivateAll(){

        $interestList       =   Interest::onlyTrashed()
            ->get();

        foreach($interestList as $interest){

            $interest->restore();

        }//end foreach

        return response()
            ->json(
                [
                    'message'       =>  'All Interests are successfully reactivated.',
                    'interestList'  =>  $this->queryInterest(null)
                ],
                201
            );

    }//end function

    public function queryInterest($id){

        $interestList       =   Interest::select(
            'intInterestId',
            'intNoOfYear'
            );

        if ($id){

            $interest       =   $interestList->where('intInterestId', '=', $id)
                ->first();

            return $this->getInterestRate($interest);


        }//end if

        $interestList       =   $interestList->get();
        $list               =   array();
        foreach($interestList as $interest){

            array_push($list, $this->getInterestRate($interest));

        }//end foreach

        return $list;

    }//end function

    public function getInterestRate($interest){

        $interest->interest_rate        =   array(
            'regular'   =>  $this->queryInterestRate($interest->intInterestId, 0),
            'atNeed'    =>  $this->queryInterestRate($interest->intInterestId, 1)
            );

        return $interest;

    }//end function

    public function queryInterestRate($id, $intAtNeed){

        $interestRate       =   InterestRate::select(
            'intAtNeed',
            'deciInterestRate'
            )
            ->where('intInterestIdFK', '=', $id)
            ->where('intAtNeed', '=', $intAtNeed)
            ->orderBy('created_at', 'desc')
            ->first();

        return $interestRate;

    }//end function
}
