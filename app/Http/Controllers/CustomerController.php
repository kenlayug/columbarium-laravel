<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::select('intCustomerId', 'strFirstName', 'strMiddleName', 'strLastName', 'strContactNo', 'strAddress')
                        ->get();
        foreach ($customers as $customer){
            $customer->full_name = $customer->strFirstName.' '.substr($customer->strMiddleName, 0, 1).'. '.$customer->strLastName;
        }
        return response()->json($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->strFirstName = $request->strFirstName;
        $customer->strMiddleName = $request->strMiddleName;
        $customer->strLastName = $request->strLastName;
        $customer->strContactNo = $request->strContactNo;
        $customer->strAddress = $request->strAddress;
        $customer->intGender = $request->intGender;
        $customer->intCivilStatus = $request->intCivilStatus;
        $customer->save();
        $customer->full_name = $customer->strFirstName.' '.substr($customer->strMiddleName, 0, 1).'. '.$customer->strLastName;
        return response()->json($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
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
        $customer = Customer::find($id);
        $customer->strFirstName = $request->strFirstName;
        $customer->strMiddleName = $request->strMiddleName;
        $customer->strLastName = $request->strLastName;
        $customer->strContactNo = $request->strContactNo;
        $customer->strAddress = $request->strAddress;
        $customer->intGender = $request->intGender;
        $customer->intCivilStatus = $request->intCivilStatus;
        $customer->save();
        $customer->full_name = $customer->strFirstName.' '.substr($customer->strMiddleName, 0, 1).'. '.$customer->strLastName;
        return response()->json($customer);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json($customer);
    }

    public function enable($id){
        $customer = Customer::onlyTrashed()
                        ->where('intCustomerId', '=', $id)
                        ->first();
        $customer->restore();
        $customer->full_name = $customer->strFirstName.' '.substr($customer->strMiddleName, 0, 1).'. '.$customer->strLastName;
        return response()->json($customer);
    }

    public function getDeactivated(){
        $customers = Customer::onlyTrashed()
                        ->get();
        foreach ($customers as $customer){
            $customer->full_name = $customer->strFirstName.' '.substr($customer->strMiddleName, 0, 1).'. '.$customer->strLastName;
        }
        return response()->json($customers);
    }
}
