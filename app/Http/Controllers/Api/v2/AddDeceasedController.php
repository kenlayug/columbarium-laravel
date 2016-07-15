<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\AddDeceased;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\Relationship;
use App\ApiModel\v2\Service;
use App\ApiModel\v2\StorageType;
use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\UnitService;
use App\ApiModel\v2\UnitTypeStorage;
use App\ServicePrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v2\AddDeceasedRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AddDeceasedController extends Controller
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
    public function store(AddDeceasedRequest $request)
    {
        try{

            \DB::beginTransaction();

            $intRelationshipId  =   0;
            $relationship       =   null;

            $dateDeath          =   new Carbon($request->dateDeath);

            $storageType        =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $request->intUnitTypeId)
                                        ->where('intStorageTypeIdFK', '=', $request->intStorageTypeId)
                                        ->first();

            $unitDeceased       =   \DB::table('tblUnitDeceased')
                                        ->where('intUnitIdFK', '=', $request->intUnitId)
                                        ->first(['intStorageTypeIdFK']);

            if ($unitDeceased != null && $unitDeceased->intStorageTypeIdFK != $request->intStorageTypeId){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'     =>  'Storage type should be the same as the first ones.'
                        ],
                        500
                    );

            }

            $unitDeceasedCount  =   \DB::table('tblUnitDeceased')
                                        ->where('intUnitIdFK', '=', $request->intUnitId)
                                        ->count();

            if ($unitDeceasedCount >= $storageType->intQuantity){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'     =>  'Unit is already full.'
                        ],
                        500
                    );

            }

            if ($request->newRelationship != null){

                $relationship       =   Relationship::create([
                    'strRelationshipName'   =>  $request->strRelationshipName
                ]);

                $intRelationshipId  =   $relationship->intRelationshipId;

            }else{

                $intRelationshipId  =   $request->intRelationshipId;

            }

            $deceased       =   Deceased::create([
                'strFirstName'          =>  $request->strFirstName,
                'strMiddleName'         =>  $request->strMiddleName,
                'strLastName'           =>  $request->strLastName,
                'intRelationshipIdFK'   =>  $intRelationshipId,
                'dateDeath'             =>  $dateDeath
            ]);

            $deceasedUnit   =   UnitDeceased::create([
                'intUnitIdFK'           =>  $request->intUnitId,
                'intDeceasedIdFK'       =>  $deceased->intDeceasedId,
                'intStorageTypeIdFK'    =>  $request->intStorageTypeId
            ]);

            $storageType    =   StorageType::where('intStorageTypeId', '=', $request->intStorageTypeId)
                                    ->first([
                                        'strStorageTypeName'
                                    ]);

            $unitService    =   UnitService::where('intServiceTypeId', '=', 1)
                                    ->where('intUnitTypeIdFK', '=', $request->intUnitTypeId)
                                    ->first();

            $service        =   Service::where('intServiceId', '=', $unitService->intServiceIdFK)
                                    ->first([
                                        'strServiceName'
                                    ]);

            $servicePrice   =   ServicePrice::where('intServiceIdFK', '=', $unitService->intServiceIdFK)
                                    ->orderBy('created_at', 'desc')
                                    ->first();

            $service->price =   $servicePrice;

            if ($servicePrice->deciPrice    >   $request->deciAmountPaid){

                return response()
                    ->json(
                        [
                            'message'   =>  'Oops.',
                            'error'     =>  'Price to pay is greater than amount paid.'
                        ],
                        500
                    );

            }

            $addDeceased    =   AddDeceased::create([
                'intUnitDeceasedIdFK'   =>  $deceasedUnit->intUnitDeceasedId,
                'intServiceIdFK'        =>  $unitService->intServiceIdFK,
                'intServicePriceIdFK'   =>  $servicePrice->intServicePriceId,
                'intPaymentType'        =>  $request->intPaymentType,
                'deciAmountPaid'        =>  $request->deciAmountPaid,
                'service'               =>  $service
            ]);

            \DB::commit();

            return response()
                ->json(
                    [
                        'lastTransaction'   =>  $addDeceased,
                        'message'           =>  'Transaction successfully processed.',
                        'relationship'      =>  $relationship,
                        'deceased'          =>  $deceased,
                        'service'           =>  $service,
                        'storageType'       =>  $storageType
                    ],
                    201
                );

        }catch (\Exception $e){

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
