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
        $interestList = Interest::select('intInterestId', 'intNoOfYear', 'intAtNeed')
                            ->get();
        foreach ($interestList as $interest) {
            $interest->interest_rate = $interest->interestRates()
                                        ->select('deciInterestRate')
                                        ->orderBy('created_at', 'desc')
                                        ->first();
        }
        return response()->json($interestList);
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
            $interest = new Interest();
            $interest->intNoOfYear = $request->intNoOfYear;
            $interest->intAtNeed = $request->intAtNeed;
            $interest->save();
            $interestRate = new InterestRate();
            $interestRate->intInterestIdFK = $interest->intInterestId;
            $interestRate->deciInterestRate = $request->deciInterestRate;
            $interestRate->save();
            \DB::commit();
            return response()->json($interest);

        }catch(QueryException $e){
            \DB::rollback();
            return response()->json('error-existing');
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
            return response()->json($interest);

        }catch(QueryException $e){
            \DB::rollback();
            return response()->json('error-existing');
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
        return response()->json($interest);
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
        return response()->json($interest);
    }
}
