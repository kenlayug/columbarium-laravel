<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
use App\ApiModel\v2\Downpayment;
use App\ApiModel\v2\DownpaymentPayment;
use App\ReservationDetail;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Business\v1\SmsGateway;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DownpaymentController extends Controller
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
        try {

            \DB::beginTransaction();

            $collection       =   null;

            $payment = DownpaymentPayment::create([
                'intDownpaymentIdFK' => $request->intDownpaymentId,
                'intPaymentType' => $request->intPaymentType,
                'deciAmountPaid' => $request->deciAmountPaid
            ]);

            $downpayment = Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                            ->where('tblDownpayment.intDownpaymentId', '=', $request->intDownpaymentId)
                            ->first(['tblUnitCategoryPrice.deciPrice', 'tblDownpayment.intUnitIdFK']);

            $paymentPaid = DownpaymentPayment::where('intDownpaymentIdFK', '=', $request->intDownpaymentId)
                                ->sum('deciAmountPaid');

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                            ->first();

            $discountSpotdown       =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'discountSpotdown')
                                            ->first(['deciBusinessDependencyValue']);


            $downpaymentPrice   =   $downpayment->deciPrice*$downpaymentPercentage->deciBusinessDependencyValue;

            $dateNow                =   Carbon::today();
            $dateWithDiscount       =   Carbon::parse($downpayment->created_at)->addDays(7);

            if ($dateNow <= $dateWithDiscount){
                $downpaymentPrice   =   $downpaymentPrice-($downpaymentPrice*$discountSpotdown->deciBusinessDependencyValue);
            }

            $unitId             =   $downpayment->intUnitIdFK;

            $downpaymentFinished = false;
            if ($downpaymentPrice-$paymentPaid <= 0){
                $downpayment            =   Downpayment::find($request->intDownpaymentId);
                $downpayment->boolPaid  =   true;
                $downpayment->save();
                $downpaymentFinished    =   true;

                $startDate = Carbon::parse($downpayment->created_at)->addMonth(1);
                $collection = Collection::create([
                    'intCustomerIdFK'               =>  $downpayment->intCustomerIdFK,
                    'intUnitIdFK'                   =>  $downpayment->intUnitIdFK,
                    'intUnitCategoryPriceIdFK'      =>  $downpayment->intUnitCategoryPriceIdFK,
                    'intInterestRateIdFK'           =>  $downpayment->intInterestRateIdFK,
                    'dateCollectionStart'           =>  $startDate
                ]);

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'downpayment'       =>  $payment,
                        'message'           =>  'Payment is successfully processed.',
                        'paid'              =>  $downpaymentFinished,
                        'intUnitId'         =>  $unitId,
                        'downpaymentPrice'  =>  $downpaymentPrice,
                        'collection'        =>  $collection,
                        'balance'           =>  $downpaymentPrice-$paymentPaid
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
        //
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

    public function deleteDueDateDownpayment(){

        try {

            \DB::beginTransaction();

            $this->sendWarningDeadlines();

            $downpaymentList = Downpayment::leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
                ->where('tblDownpayment.boolPaid', '=', false)
                ->whereNull('tblDownpaymentPayment.intDownpaymentPaymentId')
                ->groupBy('tblDownpayment.intDownpaymentId')
                ->get([
                    'tblDownpayment.intDownpaymentId',
                    'tblDownpayment.intCustomerIdFK',
                    'tblDownpayment.intUnitIdFK',
                    'tblDownpayment.created_at'
                ]);

            $voidDownpaymentNoPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                ->first();

            $voidDownpaymentNotFullPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
                ->first();

            foreach ($downpaymentList as $downpayment) {

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNoPayment->deciBusinessDependencyValue);
                $current = Carbon::now();

                if ($current >= $date) {

                    $downpayment->delete();

                    $unit = Unit::find($downpayment->intUnitIdFK);
                    $unit->intUnitStatus = 1;
                    $unit->save();

                }

            }

            $downpaymentList = Downpayment::where('tblDownpayment.boolPaid', '=', false)
                                ->get([
                                    'tblDownpayment.intDownpaymentId',
                                    'tblDownpayment.created_at',
                                    'tblDownpayment.intUnitIdFK'
                                ]);

            foreach ($downpaymentList as $downpayment) {

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNotFullPayment->deciBusinessDependencyValue);
                $current = Carbon::now();

                if ($current >= $date) {
                    $downpayment->delete();

                    $unit = Unit::find($downpayment->intUnitIdFK);
                    $unit->intUnitStatus = 1;
                    $unit->save();

                    $collection = Collection::where('intUnitIdFK', '=', $unit->intUnitId)
                                    ->first();
                    $collection->delete();
                }

            }

            \DB::commit();

            return response()
                ->json(
                    [
                        'message'       =>      'Deleted downpayment due dates...'
                    ],
                    200
                );

        }catch (\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'     =>  $e->getMessage()
                    ],
                    500
                );

        }

    }

    public function getAllPayments($id){

        $paymentList            =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $id)
                                        ->get();
        $totalAmountPaid        =   0;
        foreach ($paymentList as $payment){

            $totalAmountPaid += $payment->deciAmountPaid;

        }

        $downpayment            =   Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                                        ->where('tblDownpayment.intDownpaymentId', '=', $id)
                                        ->first([
                                            'tblUnitCategoryPrice.deciPrice'
                                        ]);

        $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                        ->first();

        $balance        =   ($downpayment->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue) - $totalAmountPaid;

        return response()
            ->json(
                [
                    'paymentList'   =>  $paymentList,
                    'balance'       =>  $balance
                ],
                200
            );

    }//end function

    public function getBalance($id){

        $paymentList            =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $id)
                                        ->get();
        $totalAmountPaid        =   0;
        foreach ($paymentList as $payment){

            $totalAmountPaid += $payment->deciAmountPaid;

        }

        $downpayment            =   Downpayment::join('tblUnitCategoryPrice', 'tblUnitCategoryPrice.intUnitCategoryPriceId', '=', 'tblDownpayment.intUnitCategoryPriceIdFK')
                                        ->where('tblDownpayment.intDownpaymentId', '=', $id)
                                        ->first([
                                            'tblUnitCategoryPrice.deciPrice'
                                        ]);

        $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                                        ->first();

        $balance        =   ($downpayment->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue) - $totalAmountPaid;

        return $balance;

    }

    public function sendWarningDeadlines(){

        $smsGateway     =   new SmsGateway();
        $deviceNo       =   env('GATEWAY_ID', '123');

        $voidDownpaymentNoPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
                ->first();

        $voidDownpaymentNotFullPayment = BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNotFullPayment')
            ->first();

        $downpaymentList = Downpayment::leftJoin('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->whereNull('tblDownpaymentPayment.intDownpaymentPaymentId')
            ->groupBy('tblDownpayment.intDownpaymentId')
            ->get([
                'tblDownpayment.intDownpaymentId',
                'tblDownpayment.intCustomerIdFK',
                'tblDownpayment.intUnitIdFK',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblCustomer.intGender',
                'tblCustomer.intCivilStatus',
                'tblCustomer.strContactNo',
                'tblDownpayment.created_at',
                'tblDownpayment.boolNoPaymentWarning'
            ]);

        $currentDate                =   Carbon::today();

        foreach($downpaymentList as $downpayment){

            $downpaymentWarningDate        =   Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNoPayment->deciBusinessDependencyValue - 3);

            if (($downpaymentWarningDate->isToday() || $downpaymentWarningDate < $currentDate) && !($downpayment->boolNoPaymentWarning)){

                $strPrefixName  =   $downpayment->intGender == 1? 'Mr.' : ($downpayment->intCivilStatus == 1? 'Ms.' : 'Mrs.');

                $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$downpayment->strFirstName.'. We want to remind you that no payment has been made within the last 4 days in your downpayment at the Columbarium.';

                $strMessagePartTwo      =   '2/3 After 3 more days, your reservation will be forfeited. To prevent this from happening, please make your first payment transaction within the following days.';

                $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

                $number             =   $downpayment->strContactNo;

                $result1             =   $smsGateway->sendMessageToNumber($number, $strMessagePartOne, $deviceNo);
                $result2             =   $smsGateway->sendMessageToNumber($number, $strMessagePartTwo, $deviceNo);
                $result3             =   $smsGateway->sendMessageToNumber($number, $strMessagePartThree, $deviceNo);

                if ($result1['response']['success']){

                    $downpayment->boolNoPaymentWarning       =   true;
                    $downpayment->save();

                }//end if

            }//end if


        }//end foreach

        $intCtr = 0;

        $downpaymentList = Downpayment::join('tblDownpaymentPayment', 'tblDownpayment.intDownpaymentId', '=', 'tblDownpaymentPayment.intDownpaymentIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
            ->where('tblDownpayment.boolPaid', '=', false)
            ->groupBy('tblDownpayment.intDownpaymentId')
            ->get([
                'tblDownpayment.intDownpaymentId',
                'tblDownpayment.created_at',
                'tblDownpayment.intUnitIdFK',
                'tblDownpayment.boolNotFullWarning',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblCustomer.intGender',
                'tblCustomer.intCivilStatus',
                'tblCustomer.strContactNo',
                'tblDownpayment.intUnitIdFK'
            ]);

            foreach ($downpaymentList as $downpayment) {

                $deciBalance            =   $this->getBalance($downpayment->intDownpaymentId);

                $date = Carbon::parse($downpayment->created_at)->addDays($voidDownpaymentNotFullPayment->deciBusinessDependencyValue - 7);

                if (($currentDate >= $date || $date->isToday()) && !($downpayment->boolNotFullWarning)) {
                    
                    $intCtr++;

                    $strPrefixName  =   $downpayment->intGender == 1? 'Mr.' : ($downpayment->intCivilStatus == 1? 'Ms.' : 'Mrs.');

                    $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$downpayment->strFirstName.'. We want to remind you that your downpayment for Unit '.$downpayment->intUnitIdFK.' is not yet complete.';

                    $strMessagePartTwo      =   '2/3 You still have 7 days to finish your balance. Your current balance is P'.number_format($deciBalance).'. If balance is not finished within these days, reservation will be forfeited.';

                    $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

                    $number             =   $downpayment->strContactNo;

                    $result             =   $smsGateway->sendMessageToNumber($number, $strMessagePartOne, $deviceNo);
                    $result             =   $smsGateway->sendMessageToNumber($number, $strMessagePartTwo, $deviceNo);
                    $result             =   $smsGateway->sendMessageToNumber($number, $strMessagePartThree, $deviceNo);

                    if ($result['response']['success']){

                        $downpayment->boolNotFullWarning       =   true;
                        $downpayment->save();

                    }//end if

                }//end if

            }//end foreach

    }//end function

}
