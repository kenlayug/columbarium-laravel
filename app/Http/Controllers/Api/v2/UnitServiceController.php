<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\UnitService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            foreach ($request->unitServiceList as $unitService){

                $unitServiceToBeUpdated = UnitService::where('intUnitTypeIdFK', '=', $request->intUnitTypeIdFK)
                                            ->where('intServiceTypeId', '=', $unitService['intServiceTypeId'])
                                            ->first();

                if ($unitServiceToBeUpdated != null) {

                    $unitServiceToBeUpdated->intServiceIdFK = $unitService['intServiceIdFK'];

                    $unitServiceToBeUpdated->save();

                }else{

                    $unitServiceToBeUpdated =   UnitService::create([
                        'intUnitTypeIdFK'   =>  $request->intUnitTypeIdFK,
                        'intServiceTypeId'  =>  $unitService['intServiceTypeId'],
                        'intServiceIdFK'    =>  $unitService['intServiceIdFK']
                    ]);

                }

            }

            \DB::commit();
            return response()
                ->json(
                    [
                        'message'   =>  'Unit Services are successfully updated.'
                    ],
                    201
                );

        }catch(\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  'Oops.',
                        'error'     =>  $e->getMessage()
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
        $unitServiceList    =   UnitService::where('intUnitTypeIdFK', '=', $id)
                                    ->get([
                                        'intUnitTypeIdFK', 'intServiceIdFK', 'intServiceTypeId'
                                    ]);

        return response()
            ->json(
                [
                    'unitServiceList'   =>  $unitServiceList
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
