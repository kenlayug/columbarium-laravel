<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\Relationship;
use App\ApiModel\v2\Service;
use App\ApiModel\v2\StorageType;
use App\ApiModel\v2\TransactionDeceased;
use App\ApiModel\v2\TransactionDeceasedDetail;
use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\UnitService;
use App\ApiModel\v2\UnitTypeStorage;
use App\ServicePrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v2\AddDeceasedRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TransactionDeceasedController extends Controller
{

    public function add(AddDeceasedRequest $request)
    {
        try{

            \DB::beginTransaction();

            $intRelationshipId  =   0;
            $relationship       =   null;

            $dateDeath          =   new Carbon($request->dateDeath);

            $storageType        =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $request->intUnitTypeId)
                                        ->where('intStorageTypeIdFK', '=', $request->intStorageTypeId)
                                        ->first();

            $unitDeceased       =   UnitDeceased::where('intUnitIdFK', '=', $request->intUnitId)
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

            $transactionDeceased        =   TransactionDeceased::create([
                'intServiceIdFK'        =>  $unitService->intServiceIdFK,
                'intServicePriceIdFK'   =>  $servicePrice->intServicePriceId,
                'intPaymentType'        =>  $request->intPaymentType,
                'deciAmountPaid'        =>  $request->deciAmountPaid,
                'intTransactionType'    =>  1
            ]);

            $transactionDeceasedDetail  =   TransactionDeceasedDetail::create([
                'intTDeceasedIdFK'      =>  $transactionDeceased->intTransactionDeceasedId,
                'intUDeceasedIdFK'      =>  $deceasedUnit->intUnitDeceasedId
            ]);

            \DB::commit();

            return response()
                ->json(
                    [
                        'lastTransaction'   =>  $transactionDeceased,
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

    public function transfer(Request $request){

        try{

            \DB::beginTransaction();

            $unitDeceased   =   null;
            $deceasedList   =   [];
            $storageTypeId  =   0;

            if ($request->intFromUnitId == $request->intToUnitId){

                return response()
                    ->json(
                        [
                            'error'     =>  'Cannot transfer deceased to the same unit.'
                        ],
                        500
                    );

            }

            $unitDeceased   =   UnitDeceased::where('intUnitIdFK', '=', $request->intToUnitId)
                                        ->first([
                                            'intStorageTypeIdFK'
                                        ]);

            $transferUnitDeceased   =   $request->deceasedList[0];

            if ($unitDeceased != null && $unitDeceased->intStorageTypeIdFK != $transferUnitDeceased['intStorageTypeIdFK']){

                return response()
                    ->json(
                        [
                            'error'     =>  'Storage type should be the same as the first ones.'
                        ],
                        500
                    );

            }

            $unitDeceasedCount  =   UnitDeceased::where('intUnitIdFK', '=', $request->intToUnitId)
                                        ->count();

            $maxStorage         =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $request->intUnitTypeId)
                                        ->where('intStorageTypeIdFK', '=', $transferUnitDeceased['intStorageTypeIdFK'])
                                        ->first([
                                            'intQuantity'
                                        ]);

            if ($unitDeceasedCount != 0 && $maxStorage->intQuantity < ($unitDeceasedCount+sizeof($request->deceasedList))){

                return response()
                    ->json(
                        [
                            'error'     =>  'Unit cannot accommodate all deceased to be transferred or unit is already full.'
                        ],
                        500
                    );

            }

            $unitService        =   UnitService::join('tblServicePrice', 'tblServicePrice.intServiceIdFK',  '=',    'tblUnitService.intServiceIdFK')
                                    ->join('tblService', 'tblService.intServiceId', '=', 'tblUnitService.intServiceIdFK')
                                    ->where('intUnitTypeIdFK',   '=',    $request->intUnitTypeId)
                                    ->where('intServiceTypeId',         '=',    2)
                                    ->orderBy('tblServicePrice.created_at', 'desc')
                                    ->first([
                                        'tblServicePrice.intServicePriceId',
                                        'tblServicePrice.intServiceIdFK',
                                        'tblServicePrice.deciPrice',
                                        'tblService.strServiceName'
                                    ]);

            if (($unitService->deciPrice * sizeof($request->deceasedList)) > $request->deciAmountPaid){

                return response()
                    ->json(
                        [
                            'error'     =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                    );

            }

            $transactionDeceased    =   TransactionDeceased::create([
                'intServiceIdFK'            =>  $unitService->intServiceIdFK,
                'intServicePriceIdFK'       =>  $unitService->intServicePriceId,
                'intPaymentType'            =>  $request->intPaymentType,
                'intTransactionType'        =>  2,
                'deciAmountPaid'            =>  $request->deciAmountPaid
            ]);

            foreach ($request->deceasedList as $deceased) {

//                $unitDeceased = \DB::table('tblUnitDeceased')
//                    ->where('intUnitIdFK', '=', $request->intFromUnitId)
//                    ->where('intDeceasedIdFK', '=', $deceased['intDeceasedId'])
//                    ->first();

                $unitDeceased   =   UnitDeceased::where('intUnitIdFK', '=', $request->intFromUnitId)
                                        ->where('intDeceasedIdFK', '=', $deceased['intDeceasedId'])
                                        ->first();

                $unitDeceased->delete();

                $unitDeceased = UnitDeceased::onlyTrashed()
                                    ->where('intUnitIdFK', '=', $request->intToUnitId)
                                    ->where('intDeceasedIdFK', '=', $deceased['intDeceasedId'])
                                    ->first();

                if ($unitDeceased != null) {

                    $unitDeceased->restore();

                } else {

                    $unitDeceased   =   UnitDeceased::create([
                        'intUnitIdFK'           => $request->intToUnitId,
                        'intDeceasedIdFK'       => $deceased['intDeceasedId'],
                        'intStorageTypeIdFK'    => $deceased['intStorageTypeIdFK']
                    ]);

                }//end if ($unitDeceased != null) else

                $storageTypeId              =   $deceased['intStorageTypeIdFK'];

                $transactionDeceasedDetail  =   TransactionDeceasedDetail::create([
                    'intTDeceasedIdFK'      =>  $transactionDeceased->intTransactionDeceasedId,
                    'intUDeceasedIdFK'      =>  $unitDeceased->intUnitDeceasedId
                ]);

                $transferDeceased           =   Deceased::where('intDeceasedId', '=', $deceased['intDeceasedId'])
                                                    ->first([
                                                        'strFirstName',
                                                        'strMiddleName',
                                                        'strLastName',
                                                        'dateDeath'
                                                    ]);

                array_push($deceasedList, $transferDeceased);

            }//end foreach ($request->deceasedList as $deceased)

            $storageType            =   StorageType::where('intStorageTypeId', '=', $storageTypeId)
                                            ->first(['strStorageTypeName']);

            \DB::commit();

            return response()
                ->json(
                    [
                        'lastTransaction'   =>  $transactionDeceased,
                        'deceasedList'      =>  $deceasedList,
                        'service'           =>  $unitService,
                        'storageType'       =>  $storageType
                    ],
                    201
                );

        }catch(\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'     =>  $e->getMessage()
                    ],
                    500
                );

        }

    }

}
