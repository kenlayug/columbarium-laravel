<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Database\QueryException;
use App\Interest;
use App\InterestRate;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->queryInterest());
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
            $boolAtNeed         =   0;

            if ($request->intAtNeed != null){

                $boolAtNeed         =   $request->intAtNeed;

            }

            $interest = new Interest();
            $interest->intNoOfYear = $request->intNoOfYear;
            $interest->intAtNeed = $boolAtNeed;

            $this->validateInterest($request);

            $interest->save();
            $interestRate = new InterestRate();
            $interestRate->intInterestIdFK = $interest->intInterestId;
            $interestRate->deciInterestRate = $request->deciInterestRate;
            $interestRate->save();
            \DB::commit();
            $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();
            return response()
                ->json(
                    [
                        'interest'      =>  $interest,
                        'message'       =>  'Interest is successfully saved.'
                    ],
                    201
                );

        }catch(QueryException $e){
            \DB::rollback();
            return response()->json(
                    [
                        'message'       =>  'Interest already exists.'
                    ],
                    500
                );
        }catch(Exception $e){

            \DB::rollback();
            return response()->json(
                    [
                        'message'       =>  $e->getMessage()
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
        $interest = Interest::select('intInterestId', 'intNoOfYear', 'intAtNeed')
                        ->where('intInterestId', '=', $id)
                        ->first();
        $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();
        return response()->json($interest);
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

            $interest = Interest::find($id);
            \DB::beginTransaction();

            $this->validateInterest($request);

            $interest->intNoOfYear = $request->intNoOfYear;
            $interest->intAtNeed = $request->intAtNeed;
            $interest->save();
            $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();
            if ($interest->interest_rate->deciInterestRate != $request->deciInterestRate){
                $interestRate = new InterestRate();
                $interestRate->intInterestIdFK = $interest->intInterestId;
                $interestRate->deciInterestRate = $request->deciInterestRate;
                $interestRate->save();
                $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();

            }
            \DB::commit();
            return response()->json(
                    [
                        'message'       =>  'Interest is successfully updated.',
                        'interest'      =>  $interest
                    ],
                    201
                );

        }catch(QueryException $e){
            \DB::rollback();
            return response()->json(
                    [
                        'message'       =>  'Interest already exists.'
                    ],
                    500
                );
        }catch(Exception $e){

            \DB::rollback();
            return response()->json(
                    [
                        'message'       =>  $e->getMessage()
                    ],
                    500
                );

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $interest = Interest::find($id);
        $interest->delete();
        return response()->json(
                [
                    'message'   =>  'Interest is successfully deactivated.',
                    'interest'  =>  $interest
                ],
                201
            );
    }

    public function getDeactivated(){
        $interestList = Interest::onlyTrashed()
                            ->select('intInterestId', 'intNoOfYear', 'intAtNeed')
                            ->get();
        return response()->json($interestList);
    }

    public function reactivate($id){
        $interest = Interest::onlyTrashed()
                        ->select('intInterestId', 'intNoOfYear', 'intAtNeed')
                        ->where('intInterestId', '=', $id)
                        ->first();
        $interest->restore();
        $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();
        return response()->json(
                [
                    'message'       =>  'Interest is successfully reactivated.',
                    'interest'      =>  $interest
                ],
                201
            );
    }

    public function validateInterest($interest){

        if ($interest->intNoOfYear < 1){

                return response()
                    ->json(
                            [
                                'message'       =>  'Years to pay cannot be less than 1.'
                            ],
                            500
                        );

            }

            if ($interest->deciInterestRate < 0){

                return response()
                    ->json(
                            [
                                'message'       =>  'Interest rate cannot be negative.'
                            ],
                            500
                        );

            }

    }

    public function queryInterest(){

        $interestList = Interest::select('intInterestId', 'intNoOfYear', 'intAtNeed')
                            ->get();
        foreach ($interestList as $interest) {
            $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();
        }
        return $interestList;

    }

    public function activateAll(){

        $archiveList        =   Interest::onlyTrashed()
            ->restore();

        return response()
            ->json(
                    [
                        'message'       =>  'All interests are now reactivated.',
                        'interestList'   =>  $this->queryInterest()
                    ],
                    201
                );

    }

    public function deactivateAll(){

        $interestList       =   Interest::all();
        foreach ($interestList as $interest) {
            $interest->delete();
        }

        return response()
            ->json(
                    [
                        'message'       =>  'All interests are now deactivated.',
                        'interestList'  =>  Interest::onlyTrashed()->get()
                    ],
                    201
                );

    }

}
