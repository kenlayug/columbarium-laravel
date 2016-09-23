<?php

namespace App\Business\v1;

use App\Business\v1\SmsGateway;

use App\ApiModel\v2\BusinessDependency;
use App\ApiModel\v2\Collection;
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

    public function sendForfeitedOwnership($collection){

        $collection             =   Collection::select(
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblCustomer.intGender',
            'tblCustomer.intCivilStatus',
            'tblCustomer.strContactNo',
            'tblUnit.intColumnNo',
            'tblUnitCategory.intLevelNo',
            'tblService.strServiceName',
            'tblPackage.strPackageName'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->leftJoin('tblUnit', 'tblUnit.intUnitId', '=', 'tblCollection.intUnitIdFK')
            ->leftJoin('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->leftJoin('tblServicePrice', 'tblServicePrice.intServicePriceId', '=', 'tblCollection.intServicePriceIdFK')
            ->leftJoin('tblService', 'tblService.intServiceId', '=', 'tblServicePrice.intServiceIdFK')
            ->leftJoin('tblPackagePrice', 'tblPackagePrice.intPackagePriceId', '=', 'tblCollection.intPackagePriceIdFK')
            ->leftJoin('tblPackage', 'tblPackage.intPackageId', '=', 'tblPackagePrice.intPackageIdFK')
            ->where('tblCollection.intCollectionId', '=', $collection->intCollectionId)
            ->first();

        $strPrefixName  =   $collection->intGender == 1? 'Mr.' : ($collection->intCivilStatus == 1? 'Ms.' : 'Mrs.');

        $strMessagePartOne          =   null;
        $strMessagePartTwo          =   null;
        $strMessagePartThree        =   null;

        if ($collection->intColumnNo){
            
            $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$collection->strFirstName.' '.$collection->strLastName.'. We want to inform you that your ownership for the Unit '.chr(64+$collection->intLevelNo).$collection->intColumnNo.' is forfeited due to unability to pay.';

            $strMessagePartTwo      =   '2/3 If unit have deceased, you can claim them in the Columbarium.';

            $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

        }//end if
        else{

            $strName            =   $collection->strServiceName ? $collection->strServiceName: $collection->strPackageName;

            $strMessagePartOne     =   '1/2 Good day '.$strPrefixName.' '.$collection->strFirstName.' '.$collection->strLastName.'. We want to inform you that your collection for the '.$strName.' is forfeited due to unability to pay.';

            $strMessagePartTwo    =   '2/2 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

        }//end else

        $number             =   $collection->strContactNo;

        if ($strMessagePartOne){

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
        }//end if

        if ($strMessagePartTwo){

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

        }//end if

        if ($strMessagePartThree){

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

        }//end if

    }//end function

    public function sendDueCollection($collection){

        $collection             =   Collection::select(
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblCustomer.intGender',
            'tblCustomer.intCivilStatus',
            'tblCustomer.strContactNo',
            'tblCollection.dateCollectionStart',
            'tblCollectionPaymentDetail.dateDue',
            'tblUnit.intColumnNo',
            'tblUnitCategory.intLevelNo'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblCollection.intCustomerIdFK')
            ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblCollection.intUnitIdFK')
            ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
            ->leftJoin('tblCollectionPayment', 'tblCollection.intCollectionId', '=', 'tblCollectionPayment.intCollectionIdFK')
            ->leftJoin('tblCollectionPaymentDetail', 'tblCollectionPayment.intCollectionPaymentId', '=', 'tblCollectionPaymentDetail.intCollectionPaymentIdFK')
            ->where('tblCollection.intCollectionId', '=', $collection->intCollectionId)
            ->orderBy('tblCollectionPayment.created_at', 'desc')
            ->orderBy('tblCollectionPaymentDetail.dateDue', 'desc')
            ->first();

        $gracePeriod        =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
            ->first(['deciBusinessDependencyValue']);

        $dateDue            =   null;
        if ($collection->dateDue){

            $dateDue        =   Carbon::parse($collection->dateDue)
                ->addMonth();

        }//end if
        else{

            $dateDue        =   Carbon::parse($collection->dateCollectionStart);

        }//end else

        $strPrefixName  =   $collection->intGender == 1? 'Mr.' : ($collection->intCivilStatus == 1? 'Ms.' : 'Mrs.');

        $strMessagePartOne     =   '1/3 Good day '.$strPrefixName.' '.$collection->strFirstName.' '.$collection->strLastName.'. We want to inform you that your bill for the Unit '.chr(64+$collection->intLevelNo).$collection->intColumnNo.' is due on '.$dateDue->toFormattedDateString().'.';

        $strMessagePartTwo      =   '2/3 Additional charges will apply for late payments.';

        $strMessagePartThree    =   '3/3 If payment has been made, ignore this message. Thank you and have a nice day. -- Columbarium and Crematorium Management System';

        $number             =   $collection->strContactNo;

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

    }//end function

}//end class
