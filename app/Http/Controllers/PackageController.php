<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Database\QueryException;

use App\Package;
use App\PackageAdditional;
use App\PackageService;
use App\PackagePrice;
use App\Additional;

use DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packageList = Package::select('strPackageName', 'strPackageDesc', 'intPackageId')
                        ->get();
        foreach ($packageList as $package) {
            $package->price = $package->packagePrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
        }
        return response()->json($packageList);
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
            if(Package::where('strPackageName', '=', $request->strPackageName)
                    ->count() != 0){
                return response()->json('error-existing');
            }
            $package = new Package();
            $package->strPackageName = $request->strPackageName;
            $package->strPackageDesc = $request->strPackageDesc;
            $package->save();

            foreach ($request->additionalList as $additional) {
                $packageAdditional = new PackageAdditional();
                $packageAdditional->intPackageIdFK      =   $package->intPackageId;
                $packageAdditional->intAdditionalIdFK   =   $additional['intAdditionalId'];
                $packageAdditional->intQuantity         =   $additional['intQuantity'];
                $packageAdditional->save();
            }

            foreach ($request->serviceList as $service) {
                $packageService = new PackageService();
                $packageService->intPackageIdFK =   $package->intPackageId;
                $packageService->intServiceIdFK =   $service['intServiceId'];
                $packageService->intQuantity    =   $service['intQuantity'];
                $packageService->save();
            }

            $packagePrice = new PackagePrice();
            $packagePrice->intPackageIdFK = $package->intPackageId;
            $packagePrice->deciPrice = $request->deciPrice;
            $packagePrice->save();

            \DB::commit();
            $package->price = $package->packagePrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();
            return response()->json($package);

        }catch(Exception $e){
            \DB::rollback();
            return response()->json($e);
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
        $package = Package::select('intPackageId', 'strPackageName', 'strPackageDesc')
                    ->where('intPackageId', '=', $id)
                    ->first();
        $package->services = PackageService::select('intServiceIdFK', 'intQuantity')
                                ->where('intPackageIdFK', '=', $id)
                                ->get();
        $package->additionals = PackageAdditional::select('intAdditionalIdFK', 'intQuantity')
                                    ->where('intPackageIdFK', '=', $id)
                                    ->get();
        $package->price = $package->packagePrices()
                            ->select('deciPrice')
                            ->orderBy('created_at', 'desc')
                            ->first();
        return response()->json($package);
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
            $package = Package::find($id);
            $package->strPackageName = $request->strPackageName;
            $package->strPackageDesc = $request->strPackageDesc;
            $package->save();

            $package->price = $package->packagePrices()
                                ->select('deciPrice')
                                ->orderBy('created_at', 'desc')
                                ->first();

            if ($package->price->deciPrice != $request->deciPrice){
                $packagePrice = new PackagePrice();
                $packagePrice->intPackageIdFK = $id;
                $packagePrice->deciPrice = $request->deciPrice;
                $packagePrice->save();
                $package->price = $package->packagePrices()
                                    ->select('deciPrice')
                                    ->orderBy('created_at', 'desc')
                                    ->first();
            }

            $package->additional = $package->packageAdditionals()
                                    ->select('intAdditionalIdFK')
                                    ->get();
            //adding additionals to the Package
            foreach ($request->additionalList as $addToAdd) {
                $boolNotExist = true;
                foreach ($package->additional as $additional) {
                    if ($addToAdd['intAdditionalId'] == $additional->intAdditionalIdFK){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $packageAdditional = PackageAdditional::onlyTrashed()
                                            ->where('intAdditionalIdFK', '=', $addToAdd['intAdditionalId'])
                                            ->where('intPackageIdFK', '=', $id)
                                            ->first();
                    if ($packageAdditional == null){
                        $packageAdditional = new PackageAdditional();
                        $packageAdditional->intPackageIdFK      =   $id;
                        $packageAdditional->intAdditionalIdFK   =   $addToAdd['intAdditionalId'];
                        $packageAdditional->intQuantity         =   $addToAdd['intQuantity'];
                        $packageAdditional->save();
                    }else{
                        $packageAdditional->restore();
                        $packageAdditional->intQuantity         =   $addToAdd['intQuantity'];
                        $packageAdditional->save();
                    }
                }
            }

            //removing additionals from the package
            foreach ($package->additional as $additional) {
                $boolNotExist = true;
                foreach ($request->additionalList as $addToAdd) {
                    if ($addToAdd['intAdditionalId'] == $additional->intAdditionalIdFK){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $packageAdditional = PackageAdditional::where('intPackageIdFK', '=', $id)
                                            ->where('intAdditionalIdFK', '=', $additional->intAdditionalIdFK)
                                            ->first();
                    $packageAdditional->delete();
                }
            }

            $package->services = $package->packageServices()
                                    ->select('intServiceIdFK')
                                    ->get();
            //adding services to the package
            foreach ($request->serviceList as $serviceToAdd) {
                $boolNotExist = true;
                foreach ($package->services as $service) {
                    if ($service->intServiceIdFK == $serviceToAdd['intServiceId']){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $packageService = PackageService::onlyTrashed()
                                        ->where('intServiceIdFK', '=', $serviceToAdd['intServiceId'])
                                        ->where('intPackageIdFK', '=', $id)
                                        ->first();
                    if ($packageService == null){
                        $packageService = new PackageService();
                        $packageService->intPackageIdFK =   $id;
                        $packageService->intServiceIdFK =   $serviceToAdd['intServiceId'];
                        $packageService->intQuantity    =   $serviceToAdd['intQuantity'];
                        $packageService->save();
                    }else{
                        $packageService->restore();
                        $packageService->intQuantity    =   $serviceToAdd['intQuantity'];
                        $packageService->save();
                    }
                }
            }

            //removing services from the package
            foreach ($package->services as $service) {
                $boolNotExist = true;
                foreach ($request->serviceList as $serviceToAdd) {
                    if ($serviceToAdd['intServiceId'] == $service->intServiceIdFK){
                        $boolNotExist = false;
                    }
                }
                if ($boolNotExist){
                    $packageService = PackageService::where('intPackageIdFK', '=', $id)
                                        ->where('intServiceIdFK', '=', $service->intServiceIdFK)
                                        ->first();
                    $packageService->delete();
                }
            }

            \DB::commit();
            return response()->json($package);

        }catch(Exception $e){
            \DB::rollback();
            return response()->json($e);
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
        $package = Package::find($id);
        $package->delete();
        return response()->json($package);
    }

    public function getAdditionalOfPackage($id){
        $additionals = PackageAdditional::select('tblAdditional.strAdditionalName', 'tblAdditional.intAdditionalId', 'tblPackageAdditional.intQuantity')
                        ->join('tblAdditional', 'tblAdditional.intAdditionalId', '=', 'tblPackageAdditional.intAdditionalIdFK')
                        ->where('intPackageIdFK', '=', $id)
                        ->get();
        return response()->json($additionals);
    }

    public function getServiceOfPackage($id){
        $services = PackageService::select('tblPackageService.intPackageIdFK',
            'tblService.strServiceName',
            'tblService.intServiceId',
            'tblPackageService.intQuantity',
            'tblServiceCategory.intServiceCategoryId',
            'tblService.intServiceForm',
            'tblServiceCategory.intServiceType'
        )
                    ->join('tblService', 'tblService.intServiceId', '=', 'tblPackageService.intServiceIdFK')
                    ->join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblService.intServiceCategoryIdFK')
                    ->where('intPackageIdFK', '=', $id)
                    ->get();
        return response()->json($services);
    }

    public function getDeactivated(){
        $packageList = Package::onlyTrashed()
                        ->select('intPackageId', 'strPackageName')
                        ->get();
        return response()->json($packageList);
    }

    public function reactivate($id){
        $package = Package::onlyTrashed()
                    ->select('intPackageId', 'strPackageName', 'strPackageDesc')
                    ->where('intPackageId', '=', $id)
                    ->first();
        $package->restore();
        $package->price = $package->packagePrices()
                            ->select('deciPrice')
                            ->orderBy('created_at', 'desc')
                            ->first();
        return response()->json($package);
    }

}
