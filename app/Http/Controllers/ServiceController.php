<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Service;
use App\ServicePrice;

use DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceList = Service::select('intServiceId', 'strServiceName', 'strServiceDesc')
                        ->get();
        foreach ($serviceList as $service) {
            $service->price = $service->servicePrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        }
        return response()->json($serviceList);
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
            $service = new Service();
            $service->strServiceName = $request->strServiceName;
            $service->strServiceDesc = $request->strServiceDesc;
            $service->save();
            $servicePrice = new ServicePrice();
            $servicePrice->intServiceIdFK = $service->intServiceId;
            $servicePrice->deciPrice = $request->deciPrice;
            $servicePrice->save();
            foreach ($request->requirementList as $requirement) {
                $serviceRequirement = new ServiceRequirement();
                $serviceRequirement->intServiceIdFK = $service->intServiceId;
                $serviceRequirement->intRequirementIdFK = $requirement;
                $serviceRequirement->save();
            }
            \DB::commit();
        }catch(Exception $e){
            \DB::rollback();
        }
        return response()->json($service);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::select('intServiceId', 'strServiceName', 'strServiceDesc')
                    ->where('intServiceId', '=', $id)
                    ->first();
        if ($service != null){
            $service->price = $service->servicePrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        }
        return response()->json($service);
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
            $service = Service::find($id);
            $service->strServiceName = $request->strServiceName;
            $service->strServiceDesc = $request->strServiceDesc;
            $service->save();

            $service->price = $service->servicePrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();

            if ($service->price->deciPrice != $request->deciPrice){
                $servicePrice = new ServicePrice();
                $servicePrice->intServiceIdFK = $service->intServiceId;
                $servicePrice->deciPrice = $request->deciPrice;
                $servicePrice->save();
            }
            \DB::commit();

        }catch(Exception $e){
            \DB::rollback();
        }
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
    }
}
