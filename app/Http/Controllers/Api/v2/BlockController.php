<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Block;
use App\ApiModel\v2\Room;
use App\ApiModel\v2\UnitCategory;
use App\Unit;
use App\UnitCategoryPrice;
use Illuminate\Http\Request;
use App\Http\Requests\Api\v2\BlockRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blockList  =   Block::join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->orderBy('tblBuilding.strBuildingCode', 'asc')
            ->get();

        foreach($blockList as $block){

            $unitList           =   Unit::where('intBlockIdFK', '=', $block->intBlockId);
            $unitLevel          =   $unitList->groupBy('intUnitCategoryIdFK')
                ->count();
            $unitColumn         =   $unitList->max('intColumnNo');
            $block->row         =   $unitLevel;
            $block->column      =   $unitColumn;

        }

        return response()
            ->json(
                [
                    'blockList' =>  $blockList
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
    public function store(BlockRequest $request)
    {
        try {
            \DB::beginTransaction();

            $lastBlock  =   Block::withTrashed()
                                ->where('intRoomIdFK', '=', $request->intRoomId)
                                ->orderBy('created_at', 'desc')
                                ->first(['intBlockNo']);

            $room               =   Room::find($request->intRoomId);

            $intBlockCount      =   Block::where('intRoomIdFK', '=', $request->intRoomId)
                                        ->count();

            if ($room->intMaxBlock == $intBlockCount){

                return response()
                    ->json(
                        [
                            'error'     =>  'Max block is already reached.'
                        ],
                        500
                    );

            }

            $nextBlockNo = 1;
            if ($lastBlock != null){
                $nextBlockNo = ($lastBlock->intBlockNo)+1;
            }

            $block = Block::create([
                'intBlockNo'    => $nextBlockNo,
                'intRoomIdFK'   => $request->intRoomId,
                'intUnitTypeIdFK'   => $request->intUnitType
            ]);

            //adds unit category
            for($intCtr = $request->intLevelNo-1; $intCtr >= 0; $intCtr--){

                $unitCategory = null;
                $unitCategory = UnitCategory::where('intFloorIdFK', '=', $request->intFloorId)
                                    ->where('intLevelNo', '=', $intCtr+1)
                                    ->where('intUnitTypeIdFK', '=', $request->intUnitType)
                                    ->first();

                if ($unitCategory == null){

                    $unitCategory = UnitCategory::create([
                        'intFloorIdFK'  =>  $request->intFloorId,
                        'intUnitTypeIdFK'   =>  $request->intUnitType,
                        'intLevelNo'    =>  $intCtr+1
                    ]);

                }//end if ($unitCategory == null)

                for($intSubCtr = 0; $intSubCtr < $request->intColumnNo; $intSubCtr++){

                    $unit = Unit::create([
                        'intBlockIdFK'          =>  $block->intBlockId,
                        'intUnitCategoryIdFK'   =>  $unitCategory->intUnitCategoryId,
                        'intColumnNo'           =>  $intSubCtr+1,
                        'intUnitStatus'         =>  1
                    ]);

                }//end for($intSubCtr = 0; $intSubCtr < $request->intColumnNo; $intSubCtr++)

            }//end for($intCtr = 0; $intCtr < $request->intLevelNo; $intCtr++)

            \DB::commit();
            return response()
                ->json(
                    [
                        'block' => $this->queryBlock($block->intBlockId),
                        'message' => 'Block is successfully created.'
                    ],
                    201
                );
        }catch(\Exception $e){
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
        $block = Block::find($id);

        return response()
            ->json(
                [
                    'block' =>  $block
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
        $block  =   Block::find($id);

        $block->strBlockName    =   $request->strBlockName;
        $block->save();

        return response()
            ->json(
                [
                    'block'     =>  $block,
                    'message'   =>  'Block is successfully updated.'
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
        $block  =   Block::find($id);

        $block->delete();

        return response()
            ->json(
                [
                    'block'     =>  $this->queryArchiveBlock($id),
                    'message'   =>  'Block is successfully deactivated.'
                ],
                201
            );
    }

    public function archive(){

        return response()
            ->json(
                [
                    'blockList' =>  $this->queryArchiveBlock(null)
                ],
                200
            );

    }

    public function queryArchiveBlock($id){

        $blockList  =   Block::onlyTrashed()
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK');

        if ($id){

            return $blockList->first();

        }

        return $blockList->get();

    }//end function

    public function queryBlock($id){

        $block  =   Block::join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->where('tblBlock.intBlockId', '=', $id)
            ->first();


        $unitList           =   Unit::where('intBlockIdFK', '=', $block->intBlockId);
        $unitLevel          =   $unitList->groupBy('intUnitCategoryIdFK')
            ->count();
        $unitColumn         =   $unitList->max('intColumnNo');
        $block->row         =   $unitLevel;
        $block->column      =   $unitColumn;

        return $block;

    }//end function

    public function restore($id){

        $block  =   Block::onlyTrashed()
                        ->where('intBlockId', '=', $id)
                        ->first();

        $block->restore();

        return response()
            ->json(
                [
                    'block'     =>  $this->queryBlock($id),
                    'message'   =>  'Block is successfully reactivated.'
                ],
                201
            );

    }

    public function getUnits($id){

        $unitList   =   Unit::join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                            ->where('tblUnit.intBlockIdFK', '=',$id)
                            ->orderBy('tblUnitCategory.intLevelNo', 'desc')
                            ->orderBy('tblUnit.intColumnNo', 'asc')
                            ->get([
                                'tblUnit.intUnitId',
                                'tblUnit.intUnitStatus',
                                'tblUnitCategory.intLevelNo',
                                'tblUnit.intColumnNo',
                                'tblUnit.intUnitCategoryIdFK'
                            ]);

        $unitStatusCount    =   array(
            0, 0, 0, 0, 0, 0, 0
        );

        foreach ($unitList as $unit){

            if ($unit->intUnitStatus == 5){
                $unitStatusCount[2]++;
            }else if ($unit->intUnitStatus == 7){
                $unitStatusCount[4]++;
            }else{
                $unitStatusCount[$unit->intUnitStatus]++;
            }//end else

            $unit->unit_price = UnitCategoryPrice::where('intUnitCategoryIdFK', '=', $unit->intUnitCategoryIdFK)
                ->orderBy('created_at', 'desc')
                ->first(['intUnitCategoryPriceId']);

        }

        $block      =   Block::join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
            ->join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
            ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->where('tblBlock.intBlockId', '=', $id)
            ->first([
                'tblBlock.intBlockNo',
                'tblBlock.intBlockId',
                'tblRoomType.intRoomTypeId',
                'tblRoomType.strUnitTypeName',
                'tblBuilding.strBuildingCode',
                'tblFloor.intFloorNo',
                'tblRoom.strRoomName'
            ]);

        return response()
            ->json(
                [
                    'unitList'  =>  $unitList,
                    'block'     =>  $block,
                    'unitStatusCount'   =>  $unitStatusCount
                ],
                200
            );

    }

    public function getBlocksWithUnitType($unitTypeId){

        $blockList      =   Block::join('tblRoom', 'tblRoom.intRoomId', '=', 'tblBlock.intRoomIdFK')
                                ->join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
                                ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
                                ->where('tblBlock.intUnitTypeIdFK', '=', $unitTypeId)
                                ->orderBy('tblBuilding.strBuildingCode')
                                ->get([
                                    'tblBuilding.strBuildingCode',
                                    'tblBuilding.strBuildingName',
                                    'tblFloor.intFloorNo',
                                    'tblRoom.strRoomName',
                                    'tblBlock.intBlockNo',
                                    'tblBlock.intBlockId'
                                ]);

        return response()
            ->json(
                [
                    'blockList'         =>  $blockList
                ],
                200
            );

    }
}
