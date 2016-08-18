<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\Relationship;
use App\ApiModel\v2\Service;
use App\ApiModel\v2\StorageType;
use App\ApiModel\v2\TransactionDeceased;
use App\ApiModel\v2\TransactionDeceasedDetail;
use App\ApiModel\v2\UnitDeceased;
use App\ApiModel\v2\UnitService;
use App\ApiModel\v2\UnitTypeStorage;
use App\Unit;

class TransactionDeceasedController extends Controller
{
    public function add(Request $request){

        try{

            \DB::beginTransaction();

            $intRelationshipId = 0;

            $service        =   UnitService::join('tblService', 'tblService.intServiceId', '=', 'tblUnitService.intServiceIdFK')
                ->join('tblServicePrice', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
                ->where('tblUnitService.intUnitTypeIdFK', '=', $request->intUnitTypeId)
                ->orderBy('tblServicePrice.created_at', 'desc')
                ->first();

            if ($service->deciPrice > $request->deciAmountPaid){

                return response()
                    ->json(
                            [
                                'message'       =>  'Amount to pay is greater than amount paid.'
                            ],
                            500
                        );

            }//end if

            $storageType        =   UnitTypeStorage::where('intUnitTypeIdFK', '=', $request->intUnitTypeId)
                                        ->where('intStorageTypeIdFK', '=', $request->intStorageTypeId)
                                        ->first();

            $deceased = Deceased::find($request->intDeceasedId);
            
            $deceased->dateInterment            =   $request->dateInterment;
            $deceased->save();

            if ($deceased == null){

                \DB::rollback();
                return response()
                    ->json(
                            [
                                'message'       =>  'Deceased does not exist.'
                            ],
                            500
                        );

            }//end if

            $unitDeceased       =   UnitDeceased::where('intUnitIdFK', '=', $request->intUnitId)
                                        ->first(['intStorageTypeIdFK']);

            $unit               =   Unit::find($request->intUnitId);

            if ($unitDeceased != null && $unitDeceased->intStorageTypeIdFK != $request->intStorageTypeId){

                \DB::rollBack();
                return response()
                    ->json(
                        [
                            'error'     =>  'Storage type should be the same as the first ones.'
                        ],
                        500
                    );

            }//end if for storage type

            $unitDeceasedCount  =   UnitDeceased::where('intUnitIdFK', '=', $request->intUnitId)
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

            }//end if for deceased count

            $deceasedUnit   =   UnitDeceased::create([
                'intUnitIdFK'           =>  $request->intUnitId,
                'intDeceasedIdFK'       =>  $deceased->intDeceasedId,
                'intStorageTypeIdFK'    =>  $request->intStorageTypeId
            ]);

            $transactionDeceased        =   TransactionDeceased::create([
                'intServiceIdFK'        =>  $service->intServiceIdFK,
                'intServicePriceIdFK'   =>  $service->intServicePriceId,
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
                            'message'   =>  'Transaction is successfully processed.'
                        ],
                        201
                    );

        }catch(Exception $e){

            \DB::rollback();
            return response()
                ->json(
                        [
                            'message'   =>  $e->getMessage()
                        ],
                        500
                    );

        }

    }
}
