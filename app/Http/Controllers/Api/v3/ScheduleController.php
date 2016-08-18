<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleDetailLog;
use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleService;

class ScheduleController extends Controller
{
    public function getScheduleForDay($intServiceCategoryId, $dateSchedule){

        $dateSchedule           =   Carbon::parse($dateSchedule)->format('Y-m-d');

        $scheduleList        =   ScheduleService::join('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
            ->join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblSchedService.intSCatIdFK')
            ->where('tblSchedService.intSCatIdFK', '=', $intServiceCategoryId)
            ->orderBy('tblScheduleTime.timeStart', 'asc')
            ->get([
                'tblScheduleTime.timeStart',
                'tblScheduleTime.timeEnd',
                'tblSchedService.intSchedServiceId'
            ]);

        foreach ($scheduleList as $serviceSchedule){

            $scheduleStatus         =   ScheduleDetail::join('tblScheduleDay', 'tblScheduleDay.intScheduleDayId', '=', 'tblScheduleDetail.intScheduleDayIdFK')
                ->join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblScheduleDetail.intDeceasedIdFK')
                ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK')
                ->join('tblSDLog', 'tblScheduleDetail.intScheduleDetailId', '=', 'tblSDLog.intSDIdFK')
                ->where('tblScheduleDay.dateSchedule', '=', $dateSchedule)
                ->where('tblScheduleDetail.intSchedServiceIdFK', '=', $serviceSchedule->intSchedServiceId)
                ->orderBy('tblSDLog.created_at', 'desc')
                ->first([
                    'tblCustomer.strFirstName',
                    'tblCustomer.strMiddleName',
                    'tblCustomer.strLastName',
                    'tblScheduleDetail.intScheduleDetailId',
                    'tblScheduleDay.dateSchedule',
                    'tblSDLog.intScheduleStatus'
                    ]);

            $serviceSchedule->status        =   ($scheduleStatus == null)? ['intScheduleStatus' => 1] : $scheduleStatus;

        }

        return response()
            ->json(
                [
                    'scheduleList'      =>  $scheduleList      
                ],
                200
            );

    }//end function

    public function querySchedule(){

        $scheduleDetailList         =   $this->queryBaseSchedule()
            ->select(
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblScheduleDetail.intScheduleDetailId',
                'tblServiceCategory.strServiceCategoryName',
                'tblScheduleTime.timeStart',
                'tblScheduleTime.timeEnd',
                'tblScheduleDay.dateSchedule');

        return $scheduleDetailList;

    }

    public function queryBaseSchedule(){

        $scheduleList           =   ScheduleService::rightJoin('tblScheduleDetail', 'tblSchedService.intSchedServiceId', '=', 'tblScheduleDetail.intSchedServiceIdFK')
            ->join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblSchedService.intSCatIdFK')
            ->rightJoin('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
            ->rightJoin('tblScheduleDay', 'tblScheduleDay.intScheduleDayId', '=', 'tblScheduleDetail.intScheduleDayIdFK')
            ->join('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblScheduleDetail.intDeceasedIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK');

        return $scheduleList;

    }

    public function queryScheduleDetailLog(){

        $schedule               =   $this->queryBaseSchedule()
            ->select(
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblSdLog.intScheduleStatus',
                'tblScheduleDay.dateSchedule',
                'tblScheduleTime.timeStart',
                'tblScheduleTime.timeEnd',
                'tblSdLog.created_at',
                'tblServiceCategory.strServiceCategoryName')
            ->join('tblSdLog', 'tblScheduleDetail.intScheduleDetailId', '=', 'tblSdLog.intSDIdFK');

        return $schedule;

    }

    public function processSchedule($intScheduleDetailId){

        try{
            $intScheduleStatus      =   0;
            $message                =   null;
            $schedule           =   $this->querySchedule()
                ->where('tblScheduleDetail.intScheduleDetailId', '=', $intScheduleDetailId)
                ->first();
            if ($schedule == null){
                return response()
                    ->json(
                            [
                                'message'       =>  'Schedule does not exist.'
                            ],
                            500
                        );
            }//end if
            $dateSchedule           =   Carbon::parse($schedule->dateSchedule)->toDateString();
            if ($dateSchedule != Carbon::today()->toDateString()){
                return response()
                    ->json(
                            [
                                'message'   =>  'Schedule is not for today.'
                            ],
                            500
                        );
            }//end if

            $scheduleDetailLog      =   ScheduleDetailLog::where('intSDIdFK', '=', $intScheduleDetailId)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($scheduleDetailLog->intScheduleStatus == 2){
                $intScheduleStatus      =   5;
                $message                =   'Scheduled service is now processing.';
            }else if ($scheduleDetailLog->intScheduleStatus == 5){
                $intScheduleStatus      =   6;
                $message                =   'Scheduled service is now finished.';
            }else{
                return response()
                    ->json(
                            [
                                'message'       =>  'Schedule is not reserved.'
                            ],
                            500
                        );
            }//end else

            $scheduleDetailLog      =   ScheduleDetailLog::create([
                'intSDIdFK'         =>  $schedule->intScheduleDetailId,
                'intScheduleStatus' =>  $intScheduleStatus
                ]);
            $scheduleDetailLog      =   $this->queryScheduleDetailLog()
                ->where('tblSdLog.intSDLogId', '=', $scheduleDetailLog->intSDLogId)
                ->first();
            return response()
                ->json(
                    [
                        'message'               =>  $message,
                        'scheduleDetailLog'     =>  $scheduleDetailLog
                    ],
                    201
                );
        }//end try
        catch(Exception $e){
            return response()
                ->json(
                    [
                        'message'       =>  $e->getMessage()
                    ],
                    500
                );
        }//end catch

    }//end function

    public function getScheduleDetailLogsForTheDay(){

        $dateFrom                       =   Carbon::today()
            ->setTime(0, 0, 0);
        $dateTo                         =   Carbon::today()
            ->setTime(23, 59, 59);
        $scheduleDetailLogList          =   $this->queryScheduleDetailLog()
            ->whereBetween('tblSdLog.created_at', [$dateFrom, $dateTo])
            ->where('tblSdLog.intScheduleStatus', '>=', 3)
            ->orderBy('tblSdLog.created_at', 'desc')
            ->take(20)
            ->get();
        return response()
            ->json(
                [
                    'scheduleDetailLogList'     =>  $scheduleDetailLogList
                ],
                201
            );

    }//
}
