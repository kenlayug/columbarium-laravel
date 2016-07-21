<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\TransactionDeceasedDetail;
use App\ApiModel\v2\TransactionOwnership;
use App\ApiModel\v2\UnitDeceased;
use App\Customer;
use App\Interest;
use App\ReservationDetail;
use App\Unit;
use App\UnitCategoryPrice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit   =   Unit::join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                        ->leftJoin('tblUnitCategoryPrice', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnitCategoryPrice.intUnitCategoryIdFK')
                        ->where('tblUnit.intUnitId', '=', $id)
                        ->groupBy('tblUnit.intUnitId')
                        ->first([
                            'tblUnit.intUnitId',
                            'tblUnit.intUnitStatus',
                            'tblUnitCategoryPrice.deciPrice',
                            'tblUnit.intUnitCategoryIdFK'
                        ]);

        return response()
            ->json(
                [
                    'unit'      => $unit
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
        $unit   =   Unit::find($id);

        $unit->intUnitStatus = 1;

        $unit->save();

        return response()
            ->json(
                [
                    'unit'      =>      $unit,
                    'message'   =>      'Unit is successfully activated.'
                ],
                200
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                    ->where('tblUnit.intUnitId', '=', $id)
                    ->first();

        $unit->intUnitStatus = 0;

        $unit->save();

        return response()
            ->json(
                [
                    'unit'      =>  $unit,
                    'message'   =>  'Unit is successfully deactivated.'
                ],
                200
            );
    }

    public function getUnitInfo($id){

        $unit   =   Unit::join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                        ->join('tblBlock', 'tblBlock.intBlockId', '=', 'tblUnit.intBlockIdFK')
                        ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
                        ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                        ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
                        ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
                        ->leftJoin('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblUnit.intCustomerIdFK')
                        ->where('tblUnit.intUnitId', '=', $id)
                        ->first([
                            'tblUnit.intUnitId',
                            'tblUnit.intUnitStatus',
                            'tblBlock.intBlockNo',
                            'tblRoom.strRoomName',
                            'tblFloor.intFloorNo',
                            'tblBuilding.strBuildingName',
                            'tblUnit.intUnitCategoryIdFK',
                            'tblRoomType.strRoomTypeName',
                            'tblRoomType.intRoomTypeId',
                            'tblCustomer.strFirstName',
                            'tblCustomer.strMiddleName',
                            'tblCustomer.strLastName',
                            'tblUnitCategory.intLevelNo',
                            'tblUnit.intColumnNo'
                        ]);

        $unit->unit_price = UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $unit->intUnitCategoryIdFK)
                                ->orderBy('created_at', 'desc')
                                ->first(['deciPrice', 'intUnitCategoryPriceId']);

        if ($unit->intUnitStatus == 2 || $unit->intUnitStatus == 4){

            $unit->interest = ReservationDetail::join('tblInterest', 'tblInterest.intInterestId', '=', 'tblReservationDetail.intInterestIdFK')
                                ->where('tblReservationDetail.intUnitIdFK', '=', $unit->intUnitId)
                                ->first([
                                    'tblInterest.intNoOfYear'
                                ]);

        }

        return response()
            ->json(
                [
                    'unit'              =>          $unit
                ],
                200
            );

    }

    public function getAllDeceased($id){

        $deceasedList       =   UnitDeceased::join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
                                    ->where('tblUnitDeceased.intUnitIdFK', '=', $id)
                                    ->get([
                                        'tblDeceased.strFirstName',
                                        'tblDeceased.strMiddleName',
                                        'tblDeceased.strLastName',
                                        'tblDeceased.intDeceasedId',
                                        'tblUnitDeceased.intStorageTypeIdFK',
                                        'tblUnitDeceased.boolBorrowed',
                                        'tblUnitDeceased.intUnitDeceasedId',
                                        'tblDeceased.dateDeath'
                                    ]);

        foreach ($deceasedList as $deceased) {

            if ($deceased->boolBorrowed){

                $transactionDetail  =   TransactionDeceasedDetail::where('intUDeceasedIdFK', '=', $deceased->intUnitDeceasedId)
                                            ->whereNotNull('dateReturn')
                                            ->orderBy('created_at', 'desc')
                                            ->first(['dateReturn']);

                $deceased->return   =   $transactionDetail;

            }

        }

        return response()
            ->json(
                [
                    'deceasedList'  =>  $deceasedList
                ],
                200
            );

    }

    public function transferOwnership($intUnitId, Request $request){

        try{

            \DB::beginTransaction();

            $intPrevOwnerId         =   null;

            $transferOwnershipCharge    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'transferOwnerCharge')
                                                ->first();

            $customer = Customer::whereRaw("CONCAT(strLastName, ', ',strFirstName, ' ', strMiddleName) = '".$request->customerName."'")
                ->first(['intCustomerId']);


            if ($transferOwnershipCharge == null){

                return response()
                    ->json(
                        [
                            'error'         =>  'Transfership fee is not yet configured in the utility. Please configure it first.'
                        ],
                        500
                    );

            }

            if ($customer == null){

                return response()
                    ->json(
                        [
                            'error'         =>  'Customer does not exists!'
                        ],
                        500
                    );

            }

            if ($transferOwnershipCharge->deciBusinessDependencyValue > $request->deciAmountPaid){

                return response()
                    ->json(
                        [
                            'error'         =>  'Amount to pay is greater than amount paid.'
                        ],
                        500
                    );

            }

            $unit                   =   Unit::find($intUnitId);

            if ($unit->intUnitStatus != 3){

                return response()
                    ->json(
                        [
                            'error'         =>  'Transferring ownership is only available for owned units.'
                        ],
                        500
                    );

            }

            $intPrevOwnerId         =   $unit->intCustomerIdFK;

            $unit->intCustomerIdFK  =   $customer->intCustomerId;

            $unit->save();

            $transactionOwnership   =   TransactionOwnership::create([
                'intPrevOwnerIdFK'          =>  $intPrevOwnerId,
                'intNewOwnerIdFK'           =>  $customer->intCustomerId,
                'intUnitIdFK'               =>  $intUnitId,
                'intPaymentType'            =>  $request->intPaymentType,
                'deciAmountPaid'            =>  $request->deciAmountPaid
            ]);

            $prevOwner              =   Customer::where('intCustomerId', '=', $intPrevOwnerId)
                                            ->first([
                                                'strFirstName',
                                                'strMiddleName',
                                                'strLastName'
                                            ]);

            $newOwner               =   Customer::where('intCustomerId', '=', $customer->intCustomerId)
                                            ->first([
                                                'strFirstName',
                                                'strMiddleName',
                                                'strLastName'
                                            ]);

            $deceasedList           =   UnitDeceased::join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
                                            ->where('intUnitIdFK', '=', $unit->intUnitId)
                                            ->get([
                                                'tblDeceased.strFirstName',
                                                'tblDeceased.strMiddleName',
                                                'tblDeceased.strLastName',
                                                'tblDeceased.dateDeath'
                                            ]);

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'               =>  'Transaction is successfully processed.',
                        'prevOwner'             =>  $prevOwner,
                        'newOwner'              =>  $newOwner,
                        'deceasedList'          =>  $deceasedList,
                        'charge'                =>  $transferOwnershipCharge,
                        'transactionOwnership'  =>  $transactionOwnership
                    ],
                    201
                );

        }catch (\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'         =>  $e->getMessage()
                    ],
                    500
                );

        }

    }
}
