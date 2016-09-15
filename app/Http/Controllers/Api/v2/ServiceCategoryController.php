<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleService;
use App\ApiModel\v2\ScheduleTime;
use App\ApiModel\v2\ServiceCategory;

use App\ApiModel\v3\ScheduleLog;

use Illuminate\Http\Request;
use Carbon\Carbon;
use LRedis;

use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceCategoryList    =   ServiceCategory::all([
            'strServiceCategoryName',
            'intServiceCategoryId'
        ]);

        return response()
            ->json(
                [
                    'serviceCategoryList'   =>  $serviceCategoryList
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

            DB::beginTransaction();

            $serviceCategory    =   ServiceCategory::create([
                'strServiceCategoryName'    =>  $request->strServiceCategoryName,
                'intServiceType'            =>  $request->intServiceType,
                'intServiceSchedulePerDay'  =>  $request->intServiceSchedulePerDay? $request->intServiceSchedulePerDay : 0,
                'intServiceDayInterval'     =>  $request->intServiceDayInterval? $request->intServiceDayInterval : 0
            ]);

            if ($request->intServiceSchedulePerDay){

                $intCtr             =   1;
                foreach($request->scheduleList as $schedule){

                    $room                   =   $schedule['room'];
                    $scheduleLog            =   ScheduleLog::create([
                        'intScheduleLogNo'              =>  $intCtr,
                        'intServiceCategoryIdFK'        =>  $serviceCategory->intServiceCategoryId,
                        'intRoomIdFK'                   =>  $room? $room['intRoomId'] : null
                        ]);
                    $intCtr++;

                }//end foreach

            }//end if

            DB::commit();
            return response()
                ->json(
                    [
                        'message'           =>  'Service Category is successfully created.',
                        'serviceCategory'   =>  $serviceCategory
                    ],
                    201
                );

        }catch(Exception $e){

            DB::rollBack();
            return response()
                ->json(
                    [
                        'message'   =>  $e->getMessage()
                    ],
                    500
                );

        }//end catch
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

    public function getScheduleLog($id){

        $scheduleLogList        =   ScheduleLog::leftJoin('tblRoom', 'tblRoom.intRoomId', '=', 'tblScheduleLog.intRoomIdFK')
            ->where('tblScheduleLog.intServiceCategoryIdFK', '=', $id)
            ->get();

        return response()
            ->json(
                [
                    'scheduleLogList'       =>  $scheduleLogList
                ],
                200
            );

    }//end function

    public function createNewTimeScheduleLog($id, $slId, Request $request){

        try{

            \DB::beginTransaction();

            $scheduleTime           =   ScheduleTime::where('timeStart', '=', $request->timeStart)
                ->where('timeEnd', '=', $request->timeEnd)
                ->first();

            if ($scheduleTime == null){

                $scheduleTime       =   ScheduleTime::create([
                        'timeStart'     =>  $request->timeStart,
                        'timeEnd'       =>  $request->timeEnd
                    ]);

            }

            $serviceSchedule        =   ScheduleService::where('intSLogIdFK', '=', $id)
                ->where('intScheduleTimeIdFK', '=', $scheduleTime->intScheduleTimeId)
                ->first();

            if ($serviceSchedule == null){

                $serviceSchedule    =   ScheduleService::create([
                        'intSLogIdFK'           =>  $id,
                        'intScheduleTimeIdFK'   =>  $scheduleTime->intScheduleTimeId
                    ]);

            }else{

                \DB::rollBack();
                return response()
                    ->json(
                            [
                                'message'   =>  'Time slot already exists.'
                            ],
                            500
                        );

            }

            $timeStart        =   Carbon::parse($scheduleTime->timeStart);
            $serviceSchedule->timeStart   =   $timeStart->toDateTimeString();

            $timeEnd        =   Carbon::parse($scheduleTime->timeEnd);
            $serviceSchedule->timeEnd   =   $timeEnd->toDateTimeString();

            $serviceSchedule->status        =   'Available';

            \DB::commit();

            return response()
                ->json(
                    [
                        'serviceSchedule'       =>  $serviceSchedule,
                        'message'               =>  'Schedule time is successfully added.'
                    ],
                    201
                );

        }catch(\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'         =>  $e->getMessage()
                    ],
                    500
                );

        }//end catch

    }//end function

    public function getAllTimeScheduleLog($id, $slId, $dateSchedule){

        $date       =   Carbon::parse($dateSchedule)->toDateString();
        $scheduleStatusList     =   [
            '',
            'Available',
            'Reserved',
            'Rescheduled',
            'Cancelled',
            'Ongoing',
            'Done'
        ];

        $serviceScheduleList        =   ScheduleService::join('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
            ->where('tblSchedService.intSLogIdFK', '=', $slId)
            ->orderBy('tblScheduleTime.timeStart', 'asc')
            ->get([
                'tblScheduleTime.timeStart',
                'tblScheduleTime.timeEnd',
                'tblSchedService.intSchedServiceId'
            ]);

        $serviceCategory            =   ScheduleLog::select(
            'tblServiceCategory.strServiceCategoryName',
            'tblRoom.strRoomName',
            'tblBuilding.strBuildingName',
            'tblBuilding.strBuildingCode',
            'tblFloor.intFloorNo',
            'tblScheduleLog.intScheduleLogId'
            )
            ->join('tblServiceCategory', 'tblServiceCategory.intServiceCategoryId', '=', 'tblScheduleLog.intServiceCategoryIdFK')
            ->leftJoin('tblRoom', 'tblRoom.intRoomId', '=', 'tblScheduleLog.intRoomIdFK')
            ->leftJoin('tblFloor', 'tblFloor.intFloorId', '=', 'tblRoom.intFloorIdFK')
            ->leftJoin('tblBuilding', 'tblBuilding.intBuildingId', '=', 'tblFloor.intBuildingIdFK')
            ->where('tblScheduleLog.intScheduleLogId', '=', $slId)
            ->first();

        foreach ($serviceScheduleList as $serviceSchedule){

            $timeStart        =   Carbon::parse($serviceSchedule->timeStart);
            $serviceSchedule->timeStart    =   $timeStart->toDateTimeString();

            $timeEnd        =   Carbon::parse($serviceSchedule->timeEnd);
            $serviceSchedule->timeEnd    =   $timeEnd->toDateTimeString();

            $scheduleStatus         =   ScheduleDetail::join('tblScheduleDay', 'tblScheduleDay.intScheduleDayId', '=', 'tblScheduleDetail.intScheduleDayIdFK')
                ->join('tblSDLog', 'tblScheduleDetail.intScheduleDetailId', '=', 'tblSDLog.intSDIdFK')
                ->where('tblScheduleDay.dateSchedule', '=', $date)
                ->where('tblScheduleDetail.intSchedServiceIdFK', '=', $serviceSchedule->intSchedServiceId)
                ->orderBy('tblSDLog.created_at', 'desc')
                ->first([
                    'tblSDLog.intScheduleStatus'
                ]);

            $serviceSchedule->status        =   ($scheduleStatus == null || $scheduleStatus->intScheduleStatus == 3 || $scheduleStatus->intScheduleStatus == 4)? 'Available' : $scheduleStatusList[$scheduleStatus->intScheduleStatus];

        }

        return response()
            ->json(
                [
                    'serviceScheduleList'   =>  $serviceScheduleList,
                    'scheduleLog'       =>  $serviceCategory
                ],
                200
            );

    }//end function

    public function createNewTime($id, Request $request){

        try{

            \DB::beginTransaction();

            $scheduleTime           =   ScheduleTime::where('timeStart', '=', $request->timeStart)
                ->where('timeEnd', '=', $request->timeEnd)
                ->first();

            if ($scheduleTime == null){

                $scheduleTime       =   ScheduleTime::create([
                        'timeStart'     =>  $request->timeStart,
                        'timeEnd'       =>  $request->timeEnd
                    ]);

            }

            $serviceSchedule        =   ScheduleService::where('intSLogIdFK', '=', $id)
                ->where('intScheduleTimeIdFK', '=', $scheduleTime->intScheduleTimeId)
                ->first();

            if ($serviceSchedule == null){

                $serviceSchedule    =   ScheduleService::create([
                        'intSLogIdFK'           =>  $id,
                        'intScheduleTimeIdFK'   =>  $scheduleTime->intScheduleTimeId
                    ]);

            }else{

                \DB::rollBack();
                return response()
                    ->json(
                            [
                                'message'   =>  'Time slot already exists.'
                            ],
                            500
                        );

            }

            $timeStart        =   Carbon::parse($scheduleTime->timeStart);
            $serviceSchedule->timeStart   =   $timeStart->toDateTimeString();

            $timeEnd        =   Carbon::parse($scheduleTime->timeEnd);
            $serviceSchedule->timeEnd   =   $timeEnd->toDateTimeString();

            $serviceSchedule->strStatus        =   'Available';

            \DB::commit();

            return response()
                ->json(
                    [
                        'serviceSchedule'       =>  $serviceSchedule,
                        'message'               =>  'Schedule time is successfully added.'
                    ],
                    201
                );

        }catch(\Exception $e){

            \DB::rollBack();
            return response()
                ->json(
                    [
                        'error'         =>  $e->getMessage()
                    ],
                    500
                );

        }//end catch

    }//end function

    public function getAllTime($id, $dateSchedule){

        $date       =   Carbon::parse($dateSchedule)->toDateString();
        $scheduleStatusList     =   [
            '',
            'Available',
            'Reserved',
            'Rescheduled',
            'Cancelled',
            'Ongoing',
            'Done'
        ];

        $serviceScheduleList        =   ScheduleService::join('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
                                            ->where('tblSchedService.intSCatIdFK', '=', $id)
                                            ->orderBy('tblScheduleTime.timeStart', 'asc')
                                            ->get([
                                                'tblScheduleTime.timeStart',
                                                'tblScheduleTime.timeEnd',
                                                'tblSchedService.intSchedServiceId'
                                            ]);

        $serviceCategory            =   ServiceCategory::find($id);

        foreach ($serviceScheduleList as $serviceSchedule){

            $timeStart        =   Carbon::parse($serviceSchedule->timeStart);
            $serviceSchedule->time_start    =   $timeStart->toDateTimeString();

            $timeEnd        =   Carbon::parse($serviceSchedule->timeEnd);
            $serviceSchedule->time_end    =   $timeEnd->toDateTimeString();

            $scheduleStatus         =   ScheduleDetail::join('tblScheduleDay', 'tblScheduleDay.intScheduleDayId', '=', 'tblScheduleDetail.intScheduleDayIdFK')
                ->join('tblSDLog', 'tblScheduleDetail.intScheduleDetailId', '=', 'tblSDLog.intSDIdFK')
                ->where('tblScheduleDay.dateSchedule', '=', $date)
                ->where('tblScheduleDetail.intSchedServiceIdFK', '=', $serviceSchedule->intSchedServiceId)
                ->orderBy('tblSDLog.created_at', 'desc')
                ->first([
                    'tblSDLog.intScheduleStatus'
                ]);

            $serviceSchedule->status        =   ($scheduleStatus == null || $scheduleStatus->intScheduleStatus == 3 || $scheduleStatus->intScheduleStatus == 4)? 'Available' : $scheduleStatusList[$scheduleStatus->intScheduleStatus];

        }

        return response()
            ->json(
                [
                    'serviceScheduleList'   =>  $serviceScheduleList,
                    'serviceCategory'       =>  $serviceCategory
                ],
                200
            );

    }//end function

    public function getAllScheduleServiceCategory(){
        $serviceCategoryList            =   ServiceCategory::where('intServiceType', '=', 1)
            ->get([
                'intServiceCategoryId',
                'strServiceCategoryName'
                ]);
        return response()
            ->json(
                [
                    'serviceCategoryList'       =>  $serviceCategoryList
                ],
                200
            );
    }//end function

    public function getScheduledServices(){

        $serviceCategoryList            =   ServiceCategory::select(
            'strServiceCategoryName',
            'intServiceCategoryId'
            )
            ->where('intServiceType', '=', 2)
            ->get();

        return response()
            ->json(
                [
                    'serviceCategoryList'       =>  $serviceCategoryList
                ],
                200
            );

    }//end function
}
