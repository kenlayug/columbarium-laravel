<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\RequirementRequest;
use App\Http\Controllers\Controller;

use App\Requirement;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirementList = Requirement::select('strRequirementName', 'strRequirementDesc', 'intRequirementId')
                            ->get();
        return response()->json($requirementList);
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
    public function store(RequirementRequest $request)
    {
        if (Requirement::where('strRequirementName', 'LIKE', $request->strRequirementName)
                ->count() != 0){
            return response()->json("error-existing");
        }
        $requirement = new Requirement();
        $requirement->strRequirementName = $request->strRequirementName;
        $requirement->strRequirementDesc = $request->strRequirementDesc;
        $requirement->save();
        return response()->json($requirement);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requirement = Requirement::select('strRequirementName', 'strRequirementDesc', 'intRequirementId')
                        ->where('intRequirementId', '=', $id)
                        ->first();
        return response()->json($requirement);
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
    public function update(RequirementRequest $request, $id)
    {
        $requirement = Requirement::find($id);
        if ((Requirement::where('strRequirementName', 'LIKE', $request->strRequirementName)
                ->count() != 0) && !($requirement->strRequirementName == $request->strRequirementName)){
            return response()->json("error-existing");
        }
        $requirement->strRequirementName = $request->strRequirementName;
        $requirement->strRequirementDesc = $request->strRequirementDesc;
        $requirement->save();
        return response()->json($requirement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requirement = Requirement::find($id);
        $requirement->delete();
        return response()->json($requirement);
    }

    public function getAllDeactivated(){
        $requirementList = Requirement::onlyTrashed()
                            ->select('strRequirementName', 'intRequirementId')
                            ->get();
        return response()->json($requirementList);
    }

    public function reactivate($id){
        $requirement = Requirement::onlyTrashed()
                        ->where('intRequirementId', '=', $id)
                        ->first();
        $requirement->restore();
        return response()->json($requirement);
    }
}
