<?php

namespace App\Business\v1;

use App\Business\v1\SmsGateway;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\DownpaymentPayment;

use Carbon\Carbon;
use Guzzle;

class NotificationBusiness{

	public function sendDueDownpayment($downpayment){

		$deciTotalDownpayment           =   DownpaymentPayment::where('intDownpaymentIdFK', '=', $downpayment->intDownpaymentId)
            ->sum('deciAmountPaid');

        $downpaymentBD                  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $deciAmountToPay                =   $downpayment->deciPrice * $downpaymentBD->deciBusinessDependencyValue;

        $smsGateway     =   new SmsGateway();
        $deviceNo       =   env('GATEWAY_ID', '123');

        $strPrefixName  =   $downpayment->intGender == 1? 'Mr.' : ($downpayment->intCivilStatus == 1? 'Ms.' : 'Mrs.');

        $intNoOfDays        =   Carbon::parse($downpayment->dateDueDate)->diffInDays(Carbon::today());

        $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$downpayment->strFirstName.' '.$downpayment->strLastName.'. We want to remind you that your downpayment for Unit '.chr(64+$downpayment->intLevelNo).$downpayment->intColumnNo.' is not yet complete.';

        $strMessagePartTwo      =   '2/3 You still have '.$intNoOfDays.' day/s to finish your balance. Your current balance is P'.number_format($deciAmountToPay - $deciTotalDownpayment).'. If balance is not finished within these days, reservation will be forfeited.';

        $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

        $number             =   $downpayment->strContactNo;

        $response           =   Guzzle::post(
            'http://smsgateway.me/api/v3/messages/send',
            [
                'form_params'       =>  [
                    'email'     =>  env('GATEWAY_EMAIL', 'localhost@yahoo.com'),
                    'password'  =>  env('GATEWAY_PASSWORD', 'password'),
                    'device'    =>  env('GATEWAY_ID', '123'),
                    'number'    =>  $number,
                    'message'   =>  $strMessagePartOne
                ]
            ]
            );

        $response           =   Guzzle::post(
            'http://smsgateway.me/api/v3/messages/send',
            [
                'form_params'       =>  [
                    'email'     =>  env('GATEWAY_EMAIL', 'localhost@yahoo.com'),
                    'password'  =>  env('GATEWAY_PASSWORD', 'password'),
                    'device'    =>  env('GATEWAY_ID', '123'),
                    'number'    =>  $number,
                    'message'   =>  $strMessagePartTwo
                ]
            ]
            );

        $response           =   Guzzle::post(
            'http://smsgateway.me/api/v3/messages/send',
            [
                'form_params'       =>  [
                    'email'     =>  env('GATEWAY_EMAIL', 'localhost@yahoo.com'),
                    'password'  =>  env('GATEWAY_PASSWORD', 'password'),
                    'device'    =>  env('GATEWAY_ID', '123'),
                    'number'    =>  $number,
                    'message'   =>  $strMessagePartThree
                ]
            ]
            );

        $downpayment->boolNotFullWarning       =   true;
        $downpayment->save();

	}//end function

}//end class
