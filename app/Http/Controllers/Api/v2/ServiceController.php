<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\Service;
use App\ServicePrice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceList    =   Service::all([
            'strServiceName',
            'intServiceId'
        ]);

        return response()
            ->json(
                [
                    'serviceList'   =>  $serviceList
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

            $service        =   Service::create([
                'strServiceName'            =>  $request->strServiceName,
                'intServiceCategoryIdFK'    =>  $request->intServiceCategoryId,
                'strServiceDesc'            =>  $request->strServiceDesc
            ]);
            
            $servicePrice   =   ServicePrice::create([
                'intServiceIdFK'    =>  $service->intServiceId,
                'deciPrice'         =>  $request->deciPrice
            ]);

            \DB::commit();

            $service->price =   $service->servicePrices()
                                    ->orderBy('created_at', 'desc')
                                    ->first([
                                        'deciPrice'
                                    ]);

            return response()
                ->json(
                    [
                        'service'   =>  $service,
                        'message'   =>  'Service is successfully created.'
                    ],
                    201
                );

        }catch (\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  'Something occurred.',
                        'error'         =>  $e->getMessage()
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
        $service    =   Service::join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblService.intServiceCategoryId')
                            ->join('tblServicePrice', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
                            ->where('tblService.intServiceId', '=', $id)
                            ->orderBy('tblServicePrice.created_at', 'desc')
                            ->groupBy('tblService.intServiceId')
                            ->get(
                                [
                                    'tblService.intServiceId',
                                    'tblService.strServiceName',
                                    'tblService.strServiceDesc',
                                    'tblServiceCategory.strServiceCategoryName',
                                    'tblServicePrice.deciPrice'
                                ]
                            );

        return response()
            ->json(
                [
                    'service'   =>  $service
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

            $service    =   Service::find($id);

            $service->strServiceName            =   $request->strServiceName;
            $service->intServiceCategoryIdFK    =   $request->intServiceCategoryId;
            $service->strServiceDesc            =   $request->strServiceDesc;
            $service->save();

            $service->price                     =   $service->servicePrices()
                                                        ->orderBy('created_at', 'desc')
                                                        ->first(['deciPrice']);

            if ($service->price->deciPrice  !=  $request->deciPrice){

                $servicePrice   =   ServicePrice::create([
                    'intServiceId'      =>  $service->intServiceId,
                    'deciPrice'         =>  $request->deciPrice
                ]);

                $service->price =   $service->servicePrices()
                                        ->orderBy('created_at', 'desc')
                                        ->first([
                                            'deciPrice'
                                        ]);

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'service'       =>  $service,
                        'message'       =>  'Service is successfully created.'
                    ],
                    201
                );

        }catch(\Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  'Something occurred.',
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
        $service    =   Service::find($id);

        $service->delete();

        return response()
            ->json(
                [
                    'service'   =>  $service,
                    'message'   =>  'Service is successfully deactivated.'
                ],
                200
            );
    }

    public function archive(){

        $serviceList    =   Service::onlyTrashed()
                                ->get([
                                    'intServiceId',
                                    'strServiceName'
                                ]);
        return response()
            ->json(
                [
                    'serviceList'   =>  $serviceList
                ],
                200
            );

    }

    public function enable($id){

        $service    =   Service::onlyTrashed()
                            ->where('intServiceId', '=', $id)
                            ->get();

        $service->restore();

        $service    =   Service::join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblService.intServiceCategoryId')
                            ->join('tblServicePrice', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
                            ->where('tblService.intServiceId', '=', $id)
                            ->orderBy('tblServicePrice.created_at', 'desc')
                            ->groupBy('tblService.intServiceId')
                            ->get(
                                [
                                    'tblService.intServiceId',
                                    'tblService.strServiceName',
                                    'tblService.strServiceDesc',
                                    'tblServiceCategory.strServiceCategoryName',
                                    'tblServicePrice.deciPrice'
                                ]
                            );

        return response()
            ->json(
                [
                    'service'   =>  $service,
                    'message'   =>  'Service is successfully reactivated.'
                ],
                200
            );

    }
}
