<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\UnitCategory;
use App\UnitCategoryPrice;
use Illuminate\Http\Request;

use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitCategoryList          =   UnitCategory::join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblUnitCategory.intUnitTypeIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblUnitCategory.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->get([
                'tblBuilding.intBuildingId',
                'tblBuilding.strBuildingName',
                'tblFloor.intFloorId',
                'tblFloor.intFloorNo',
                'tblUnitCategory.intUnitCategoryId',
                'tblUnitCategory.intLevelNo',
                'tblRoomType.intRoomTypeId',
                'tblRoomType.strRoomTypeName',
                'tblRoomType.strUnitTypeName'
                ]);

        foreach($unitCategoryList as $unitCategory){

            $unitCategory->price           =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $unitCategory->intUnitCategoryId)
                ->orderBy('created_at', 'desc')
                ->first([
                    'deciPrice'
                    ]);

        }

        return response()
            ->json(
                    [
                        'unitCategoryList'     =>  $unitCategoryList
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

            \DB::beginTransaction();
            foreach($request->unitCategoryList as $unitCategoryPrice){

                $unitCategoryPriceToUpdate  =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $unitCategoryPrice['intUnitCategoryId'])
                                        ->orderBy('created_at', 'desc')
                                        ->first([
                                            'deciPrice'
                                        ]);

                $price          =   $unitCategoryPrice['price'];
                 if ($unitCategoryPriceToUpdate == null || $unitCategoryPriceToUpdate->deciPrice   !=  $price['deciPrice']){

                    $unitCategoryPrice = UnitCategoryPrice::create([
                        'intUnitCategoryIdFK'       =>  $unitCategoryPrice['intUnitCategoryId'],
                        'deciPrice'                 =>  $price['deciPrice']
                    ]);

                }


            }

            DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Unit price is successfully updated.'
                    ],
                    201
                );

        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                        [
                            'message'   =>  $e->getMessage()
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
        $unitCategoryPrice   =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $id)
                                ->orderBy('created_at', 'desc')
                                ->first();

        return response()
            ->json(
                [
                    'unitCategoryPrice'      =>  $unitCategoryPrice
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

            \DB::beginTransaction();
            foreach($request->unitCategoryList as $unitCategoryPrice){

                $unitCategoryPrice  =   UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $unitCategoryPrice['intUnitCategoryId'])
                                        ->orderBy('created_at', 'desc')
                                        ->first([
                                            'deciPrice'
                                        ]);

                $price          =   $unitCategoryPrice['price'];
                 if ($unitCategoryPrice == null || $unitCategoryPrice->deciPrice   !=  $price['deciPrice']){

                    $unitCategoryPrice = UnitCategoryPrice::create([
                        'intUnitCategoryIdFK'       =>  $unitCategoryPrice['intUnitCategoryId'],
                        'deciPrice'                 =>  $price['deciPrice']
                    ]);

                }


            }

            DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>  'Unit price is successfully updated.'
                    ],
                    201
                );

        }catch(Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                        [
                            'message'   =>  $e->getMessage()
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
        //
    }
}
