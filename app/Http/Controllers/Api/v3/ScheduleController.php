<?php

namespace App\Http\Controllers\Api\v3;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\ApiModel\v2\ServiceCategory;
use App\ApiModel\v2\Deceased;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleDetailLog;
use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleService;

use DB;

class ScheduleController extends Controller
{
    public function getScheduleForDay($intScheduleLogId, $dateSchedule){

        $dateSchedule           =   Carbon::parse($dateSchedule)->format('Y-m-d');

        $boolSchedule           =   false;

        if ($intScheduleLogId != 0){

            $scheduleList           =   $this->querySchedule()
                ->where('tblScheduleDay.dateSchedule', '=', $dateSchedule)
                ->where('tblScheduleLog.intScheduleLogId', '=', $intScheduleLogId)
                ->get();

            foreach($scheduleList as $schedule){
                $scheduleStatus         =   ScheduleDetailLog::where('intSDIdFK', '=', $schedule->intScheduleDetailId)
                    ->orderBy('created_at', 'desc')
                    ->first(['intScheduleStatus']);
                $schedule->status       =   $scheduleStatus->intScheduleStatus;
            }//end foreach
            $boolSchedule           =   true;

        }else{

            $scheduleList           =   Deceased::select(
                'tblDeceased.strFirstName as strDeceasedFirst',
                'tblDeceased.strMiddleName as strDeceasedMiddle',
                'tblDeceased.strLastName as strDeceasedLast',
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblUnitDeceased.intUnitIdFK',
                'tblDeceased.dateInterment'
                )
                ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK')
                ->join('tblUnitDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
                ->where('tblDeceased.dateInterment', '=', $dateSchedule)
                ->get();
        
        }//end else

        return response()
            ->json(
                [
                    'scheduleList'      =>  $scheduleList,
                    'boolSchedule'      =>  $boolSchedule  
                ],
                200
            );

    }//end function

    public function getAllScheduleForDate($dateFilter){

        $serviceScheduleList           =   $this->querySchedule()
            ->where('tblScheduleDay.dateSchedule', '=', Carbon::parse($dateFilter))
            ->get();

        foreach($serviceScheduleList as $serviceSchedule){
            $scheduleStatus         =   ScheduleDetailLog::where('intSDIdFK', '=', $serviceSchedule->intScheduleDetailId)
                ->orderBy('created_at', 'desc')
                ->first(['intScheduleStatus']);
            $serviceSchedule->status       =   $scheduleStatus->intScheduleStatus;
        }//end foreach

        $intermentScheduleList           =   Deceased::select(
            'tblDeceased.strFirstName as strDeceasedFirst',
            'tblDeceased.strMiddleName as strDeceasedMiddle',
            'tblDeceased.strLastName as strDeceasedLast',
            'tblCustomer.strFirstName',
            'tblCustomer.strMiddleName',
            'tblCustomer.strLastName',
            'tblUnitDeceased.intUnitIdFK',
            'tblDeceased.dateInterment',
            'tblDeceased.timeInterment'
            )
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK')
            ->join('tblUnitDeceased', 'tblDeceased.intDeceasedId', '=', 'tblUnitDeceased.intDeceasedIdFK')
            ->where('tblDeceased.dateInterment', '=', Carbon::parse($dateFilter))
            ->get();

        $scheduleList                   =   array();

        foreach($intermentScheduleList as $intermentSchedule){

            $schedule               =   array(
                'strServiceName'        =>  'Interment',
                'strDeceasedName'       =>  $intermentSchedule->strDeceasedLast.', '.$intermentSchedule->strDeceasedFirst.' '.$intermentSchedule->strDeceasedMiddle,
                'strCustomerName'       =>  $intermentSchedule->strLastName.', '.$intermentSchedule->strFirstName.' '.$intermentSchedule->strMiddleName,
                'timeStart'             =>  Carbon::parse($intermentSchedule->timeInterment)
                    ->toDateTimeString(),
                'intUnitId'             =>  $intermentSchedule->intUnitIdFK,
                'intStatus'             =>  1
                );

            array_push($scheduleList, $schedule);

        }//end foreach

        foreach($serviceScheduleList as $serviceSchedule){

            $schedule               =   array(
                'strServiceName'        =>  $serviceSchedule->strServiceCategoryName,
                'strDeceasedName'       =>  $serviceSchedule->strFirstName? $serviceSchedule->strDeceasedLast.', '.$serviceSchedule->strDeceasedFirst.' '.$serviceSchedule->strDeceasedMiddle : '',
                'strCustomerName'       =>  $serviceSchedule->strLastName.', '.$serviceSchedule->strFirstName.' '.$serviceSchedule->strMiddleName,
                'timeStart'             =>  Carbon::parse($serviceSchedule->timeStart)
                    ->toDateTimeString(),
                'intUnitId'             =>  '',
                'intStatus'             =>  $serviceSchedule->status
                );

            array_push($scheduleList, $schedule);

        }//end foreach

        $collectionScheduleList         =   collect($scheduleList);
        $sortedScheduleList             =   $collectionScheduleList->sortBy('timeStart');

        return response()
            ->json(
                [
                    'scheduleList'      =>  $sortedScheduleList->values()->all()
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
                'tblDeceased.strFirstName as strDeceasedFirst',
                'tblDeceased.strMiddleName as strDeceasedMiddle',
                'tblDeceased.strLastName as strDeceasedLast',
                'tblScheduleDetail.intScheduleDetailId',
                'tblServiceCategory.strServiceCategoryName',
                'tblScheduleTime.timeStart',
                'tblScheduleTime.timeEnd',
                'tblScheduleDay.dateSchedule',
                'tblScheduleDetail.created_at');

        return $scheduleDetailList;

    }

    public function queryBaseSchedule(){

        $scheduleList           =   ScheduleService::rightJoin('tblScheduleDetail', 'tblSchedService.intSchedServiceId', '=', 'tblScheduleDetail.intSchedServiceIdFK')
            ->join('tblScheduleLog', 'tblScheduleLog.intScheduleLogId', '=', 'tblSchedService.intSLogIdFK')
            ->join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblScheduleLog.intServiceCategoryIdFK')
            ->rightJoin('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
            ->rightJoin('tblScheduleDay', 'tblScheduleDay.intScheduleDayId', '=', 'tblScheduleDetail.intScheduleDayIdFK')
            ->leftJoin('tblDeceased', 'tblDeceased.intDeceasedId', '=', 'tblScheduleDetail.intDeceasedIdFK')
            ->join('tblCustomer', 'tblCustomer.intCustomerId', '=', 'tblDeceased.intCustomerIdFK');

        return $scheduleList;

    }

    public function queryScheduleDetailLog(){

        $schedule               =   $this->queryBaseSchedule()
            ->select(
                'tblCustomer.strFirstName',
                'tblCustomer.strMiddleName',
                'tblCustomer.strLastName',
                'tblSDLog.intScheduleStatus',
                'tblScheduleDay.dateSchedule',
                'tblScheduleTime.timeStart',
                'tblScheduleTime.timeEnd',
                'tblSDLog.created_at',
                'tblServiceCategory.strServiceCategoryName')
            ->join('tblSDLog', 'tblScheduleDetail.intScheduleDetailId', '=', 'tblSDLog.intSDIdFK');

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
                ->where('tblSDLog.intSDLogId', '=', $scheduleDetailLog->intSDLogId)
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

    public function reschedule($intScheduleDetailId, Request $request){

        try{
            \DB::beginTransaction();
            $dateSchedule           =   Carbon::parse($request->dateSchedule)
                ->format('Y-m-d');
            $scheduleDetail         =   ScheduleDetail::where('intScheduleDetailId', '=', $intScheduleDetailId)
                ->first();
            $scheduleDetailLog      =   ScheduleDetailLog::create([
                'intSDIdFK'         =>  $scheduleDetail->intScheduleDetailId,
                'intScheduleStatus' =>  3
                ]);
            $scheduleDay            =   ScheduleDay::where('dateSchedule', '=', $dateSchedule)
                ->first();
            if ($scheduleDay == null){
                $scheduleDay        =   ScheduleDay::create([
                    'dateSchedule'      =>  $dateSchedule
                    ]);
            }//end if
            $scheduleDetail                 =   ScheduleDetail::create([
                'intSchedServiceIdFK'       =>  $request->intScheduleServiceId,
                'intScheduleDayIdFK'        =>  $scheduleDay->intScheduleDayId,
                'intTPDetailIdFK'           =>  $scheduleDetail->intTPDetailIdFK,
                'intDeceasedIdFK'           =>  $scheduleDetail->intDeceasedIdFK
                ]);
            $scheduleDetailLogForReschedule =   ScheduleDetailLog::create([
                'intSDIdFK'     =>  $scheduleDetail->intScheduleDetailId,
                'intScheduleStatus' =>  2
                ]);
            $scheduleDetailLog      =   $this->queryScheduleDetailLog()
                ->where('tblSDLog.intSDLogId', '=', $scheduleDetailLog->intSDLogId)
                ->first();
            $scheduleDetailLogForReschedule      =   $this->queryScheduleDetailLog()
                ->where('tblSDLog.intSDLogId', '=', $scheduleDetailLogForReschedule->intSDLogId)
                ->first();
            $scheduleDetail                 =   $this->querySchedule()
                ->where('tblScheduleDetail.intScheduleDetailId', '=', $scheduleDetail->inScheduleDetailId)
                ->first();
            \DB::commit();
            return response()
                ->json(
                    [
                        'message'           =>  'Schedule is successfully rescheduled.',
                        'scheduleDetailLog' =>  $scheduleDetailLog,
                        'scheduleDetailLogForReschedule'    =>  $scheduleDetailLogForReschedule
                    ],
                    201
                );
        }catch(Exception $e){
            \DB::rollBack();
            return response()
                ->json(
                    [
                        'message'       =>  $e->getMessage()
                    ],
                    500
                );
        }//try catch

    }//end public function

    public function getScheduleDetailLogsForTheDay(){

        $dateFrom                       =   Carbon::today()
            ->setTime(0, 0, 0);
        $dateTo                         =   Carbon::today()
            ->setTime(23, 59, 59);
        $scheduleDetailLogList          =   $this->queryScheduleDetailLog()
            ->whereBetween('tblSDLog.created_at', [$dateFrom, $dateTo])
            ->orderBy('tblSDLog.created_at', 'desc')
            ->take(20)
            ->get();
        return response()
            ->json(
                [
                    'scheduleDetailLogList'     =>  $scheduleDetailLogList
                ],
                201
            );

    }//end function

    public function cancel($intScheduleDetailId){
        $scheduleDetailLog          =   ScheduleDetailLog::create([
            'intSDIdFK'             =>  $intScheduleDetailId,
            'intScheduleStatus'     =>  4
            ]);
        $scheduleDetailLog      =   $this->queryScheduleDetailLog()
            ->where('tblSDLog.intSDLogId', '=', $scheduleDetailLog->intSDLogId)
            ->first();
        return response()
            ->json(
                [
                    'message'       =>  'Schedule is successfully cancelled.',
                    'scheduleDetailLog' =>  $scheduleDetailLog
                ],
                201
            );
    }//end function

}
