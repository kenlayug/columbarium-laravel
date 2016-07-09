<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BusinessDependencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessDependecyList  =   BusinessDependency::orderBy('strBusinessDependencyName')
                                        ->get([
            'strBusinessDependencyName',
            'deciBusinessDependencyValue'
        ]);

        return response()
            ->json(
                [
                    'businessDependencyList'    =>  $businessDependecyList
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
        $businessDependency     =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', $request->strBusinessDependencyName)
                                        ->first();

        if ($businessDependency == null){

            $businessDependency =   BusinessDependency::create([
                'strBusinessDependencyName'     =>  $request->strBusinessDependencyName,
                'deciBusinessDependencyValue'   =>  $request->deciBusinessDependencyValue
            ]);

        }else{

            $businessDependency->deciBusinessDependencyValue    =   $request->deciBusinessDependencyValue;
            $businessDependency->save();

        }

        return response()
            ->json(
                [
                    'businessDependency'    =>  $businessDependency,
                    'message'               =>  'Business dependency is successfully updated.'
                ],
                201
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $businessDependency =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', $id)
                                    ->first([
                                        'strBusinessDependencyName',
                                        'deciBusinessDependencyValue'
                                    ]);

        return response()
            ->json(
                [
                    'businessDependency'    =>  $businessDependency
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
