<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ApiModel\v2\TransactionDeceased;
use App\ApiModel\v2\TransactionPurchase;
use App\ApiModel\v2\TransactionOwnership;

use App\ApiModel\v3\TransactionUnit;

class ReceiptController extends Controller
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
        $receiptAll             =   array();
        $transactionUnit        =   TransactionUnit::find($id);
        if ($transactionUnit){
            $transactionUnit    =   array(
                'id'        =>  $id,
                'name'      =>  'transaction-unit-success'
                );
            array_push($receiptAll, $transactionUnit);
        }
        $transactionDeceased    =   TransactionDeceased::find($id);
        if ($transactionDeceased){
            $transactionDeceased    =   array(
                'id'        =>  $id,
                'name'      =>  'manage-unit-success'
                );
            array_push($receiptAll, $transactionDeceased);
        }
        $transactionPurchase    =   TransactionPurchase::find($id);
        if ($transactionPurchase){
            $transactionPurchase    =   array(
                'id'        =>  $id,
                'name'      =>  'service-purchase-success'
                );
            array_push($receiptAll, $transactionPurchase);
        }
        $transactionOwnership   =   TransactionOwnership::find($id);
        if ($transactionOwnership){
            $transactionOwnership   =   array(
                'id'        =>  $id,
                'name'      =>  'transaction-ownership-success'
                );
            array_push($receiptAll, $transactionOwnership);
        }
        
        return response()
            ->json(
                [
                    'receiptList'           =>  $receiptAll
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
