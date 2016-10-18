<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\ApiModel\v3\Notification;

use App\ApiModel\v2\Downpayment;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificationList       =   Notification::orderBy('created_at')
            ->take(20)
            ->get();

        $uniformNotificationList    =   array();

        foreach($notificationList as $notification){

            $message            =   null;
            $strCustomerName    =   null;
            if ($notification->intNotificationType == 1){

                $downpayment        =   Downpayment::select(
                    'tblCustomer.strFirstName',
                    'tblCustomer.strMiddleName',
                    'tblCustomer.strLastName',
                    'tblCustomer.intGender',
                    'tblUnit.intColumnNo',
                    'tblUnitCategory.intLevelNo'
                    )
                    ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDownpayment.intCustomerIdFK')
                    ->join('tblUnit', 'tblUnit.intUnitId', '=', 'tblDownpayment.intUnitIdFK')
                    ->join('tblUnitCategory', 'tblUnitCategory.intUnitCategoryId', '=', 'tblUnit.intUnitCategoryIdFK')
                    ->where('tblDownpayment.intDownpaymentId', '=', $notification->intDownpaymentIdFK)
                    ->first();

                $hisHer             =   $downpayment->intGender == 1? 'his' : 'her';
                $message            =   ' have 7 more days to pay for '.$hisHer.' reservation\'s downpayment at ';

                $strCustomerName        =   $downpayment->strFirstName.' '.$downpayment->strLastName;

            }//end if

            $uniformNotification        =   array(
                'customer'              =>  $strCustomerName,
                'message'               =>  $message,
                'dateNotification'      =>  Carbon::parse($notification->created_at)->toDateTimeString(),
                'intNotificationType'   =>  $notification->intNotificationType,
                'emphasis'              =>  'Unit '.chr(64+$downpayment->intLevelNo).$downpayment->intColumnNo,
                'boolNew'               =>  !$notification->boolRead
                );

            array_push($uniformNotificationList, $uniformNotification);

        }//end foreach

        return response()
            ->json(
                [
                    'notificationList'      =>  $uniformNotificationList
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
}
