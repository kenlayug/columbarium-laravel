<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Block;
use App\ApiModel\v2\RoomDetail;
use App\ApiModel\v2\Room;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomList   =   Room::join('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->join('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->get([
                'tblRoom.intRoomId',
                'tblRoom.strRoomName',
                'tblRoom.intMaxBlock',
                'tblFloor.intFloorId',
                'tblFloor.intFloorNo',
                'tblBuilding.intBuildingId',
                'tblBuilding.strBuildingName',
                'tblBuilding.strBuildingCode'
            ]);

        foreach ($roomList as $room){
            $room->block_count  =   Block::where('intRoomIdFK', '=', $room->intRoomId)
                                        ->count();
            $room->room_details =   RoomDetail::join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblRoomDetail.intRoomTypeIdFK')
                ->where('intRoomIdFK', '=', $room->intRoomId)
                ->get([
                    'tblRoomType.intRoomTypeId',
                    'tblRoomType.strRoomTypeName'
                    ]);
        }

        return response()
            ->json(
                [
                    'roomList'  =>  $roomList
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
        try {
            \DB::beginTransaction();

            if($request->intMaxBlock == null){
                $request->intMaxBlock = 0;
            }

            $room = Room::create([
                'intFloorIdFK' => $request->intFloorId,
                'strRoomName' => $request->strRoomName,
                'intMaxBlock' => $request->intMaxBlock
            ]);

            //add floorType to floor
            foreach ($request->roomTypeList as $roomType) {
                $roomType = RoomDetail::create([
                    'intRoomIdFK'       =>  $room->intRoomId,
                    'intRoomTypeIdFK'   =>  $roomType
                ]);
            }

            $room->block_count  =   Block::where('intRoomIdFK', '=', $room->intRoomId)
                                        ->count();

            \DB::commit();
            return response()
                ->json(
                    [
                        'room' => $room,
                        'message' => 'Room is successfully created.'
                    ],
                    201
                );
        }catch(\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  'Error occured.',
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
        $room   =   Room::find($id);

        $room->room_details = RoomDetail::where('intRoomIdFK', '=', $id)
                                ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblRoomDetail.intRoomTypeIdFK')
                                ->get(['tblRoomDetail.intRoomTypeIdFK', 'tblRoomType.strRoomTypeName']);

        return response()
            ->json(
                [
                    'room'  =>  $room
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
        try {
            \DB::beginTransaction();
            $roomDetailList = RoomDetail::where('intRoomIdFK', '=', $id)
                                ->get();

            //add roomType to room
            foreach ($request->roomTypeList as $roomType) {
                $boolNotExist = true;
                foreach ($roomDetailList as $roomDetail) {
                    if ($roomDetail->intRoomTypeIdFK == $roomType){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $roomDetail = RoomDetail::onlyTrashed()
                        ->where('intRoomIdFK', '=', $id)
                        ->where('intRoomTypeIdFK', '=', $roomType)
                        ->first();
                    if ($roomDetail == null){
                        $roomDetail = RoomDetail::create([
                            'intRoomIdFK'       =>  $id,
                            'intRoomTypeIdFK'   =>  $roomType
                        ]);
                    }else{
                        $roomDetail->restore();
                    }
                }
            }//end foreach ($request->roomTypeList as $roomType)

            //remove floorType from floor
            foreach ($roomDetailList as $roomDetail) {
                $boolNotExist = true;
                foreach ($request->roomTypeList as $roomType) {
                    if ($roomDetail->intRoomTypeIdFK == $roomType){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $roomTypeToRemove = RoomDetail::where('intRoomIdFK', '=', $id)
                                            ->where('intRoomTypeIdFK', '=', $roomDetail->intRoomTypeIdFK)
                                            ->first();
                    $roomTypeToRemove->delete();
                }
            }//end foreach($roomDetailList as $roomDetail)

            $room = Room::find($id);

            $room->strRoomName  =   $request->strRoomName;
            $room->intMaxBlock  =   $request->intMaxBlock;

            $room->save();

            \DB::commit();

            return response()
                ->json(
                    [
                        'room'      => $room,
                        'message'   => 'Room is successfully updated.'
                    ],
                    200
                );

        }catch(\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  'Something occured.',
                        'error'     =>  $e->getMessage()
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
        $room   =   Room::find($id);
        
        $room->delete();
        
        return response()
            ->json(
                [
                    'room'      =>  $room,
                    'message'   =>  'Room is successfully deactivated.'
                ]
            );
    }

    public function getBlocks($id){

        $blockList  =   Block::where('tblBlock.intRoomIdFK', '=', $id)
                            ->join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblBlock.intUnitTypeIdFK')
                            ->get([
                                'tblBlock.intBlockId',
                                'tblBlock.intBlockNo',
                                'tblRoomType.intRoomTypeId',
                                'tblRoomType.strRoomTypeName'
                            ]);

        return response()
            ->json(
                [
                    'blockList'     =>  $blockList
                ],
                200
            );

    }

    public function getRoomTypeWithUnit($id){

        $roomTypeList   =   RoomDetail::join('tblRoomType', 'tblRoomType.intRoomTypeId', '=', 'tblRoomDetail.intRoomTypeIdFK')
                                ->where('tblRoomDetail.intRoomIdFK', '=', $id)
                                ->where('tblRoomType.boolUnit', '=', true)
                                ->get([
                                    'tblRoomType.intRoomTypeId',
                                    'tblRoomType.strRoomTypeName'
                                ]);

        return response()
            ->json(
                [
                    'roomTypeList'  =>  $roomTypeList
                ],
                200
            );

    }
}
