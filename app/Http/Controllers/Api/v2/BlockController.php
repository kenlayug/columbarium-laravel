<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Block;
use Illuminate\Http\Request;

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
        $blockList  =   Block::all();

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
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $block = Block::create([
                'strBlockName'  => $request->strBlockName,
                'intRoomIdFK'   => $request->intRoomId,
                'intUnitType'   => $request->intUnitType
            ]);

            return response()
                ->json(
                    [
                        'block' => $block,
                        'message' => 'Block is successfully created.'
                    ],
                    201
                );
        }catch(\Exception $e){
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
                204
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
                    'block'     =>  $block,
                    'message'   =>  'Block is successfully deactivated.'
                ],
                204
            );
    }

    public function archive(){

        $blockList  =   Block::onlyTrashed()
                            ->get();

        return response()
            ->json(
                [
                    'blockList' =>  $blockList
                ],
                200
            );

    }

    public function restore($id){

        $block  =   Block::onlyTrashed()
                        ->where('intBlockId', '=', $id)
                        ->first();

        $block->restore();

        return response()
            ->json(
                [
                    'block'     =>  $block,
                    'message'   =>  'Block is successfully reactivated.'
                ],
                204
            );

    }
}