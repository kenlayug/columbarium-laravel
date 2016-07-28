<?php

namespace App\Http\Controllers\Api\v2;

use App\ApiModel\v2\ScheduleDay;
use App\ApiModel\v2\ScheduleDetail;
use App\ApiModel\v2\ScheduleService;
use App\ApiModel\v2\ScheduleTime;
use App\ApiModel\v2\ServiceCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use LRedis;

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
        $serviceCategory    =   ServiceCategory::create([
            'strServiceCategoryName'    =>  $request->strServiceCategoryName,
            'intMinuteOfService'        =>  $request->intMinuteOfService
        ]);

        $redis              =   \LRedis::connection();
        $redis->publish('new-service-category', json_encode($serviceCategory));

        $redis->publish('message', 'Service Category is successfully created.');

        return response()
            ->json(
                [
                    'message'           =>  'Service Category is successfully created.',
                    'serviceCategory'   =>  $serviceCategory
                ],
                201
            );
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

    public function createNewTime($id){

        try{

            \DB::beginTransaction();

            $timeStart              =   null;

            $serviceCategory        =   ServiceCategory::find($id);

            $serviceSchedule        =   ScheduleService::join('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
                                            ->where('intSCatIdFK', '=', $id)
                                            ->orderBy('tblScheduleTime.timeStart', 'desc')
                                            ->first();

            if ($serviceSchedule == null){

                $timeStart          =   Carbon::createFromTime(8, 0, 0);

            }else if ($serviceSchedule != null){

                $timeStart          =   Carbon::parse($serviceSchedule->timeStart);

            }

            $timeStart->addMinutes($serviceCategory->intMinuteOfService);

            $scheduleTime       =   ScheduleTime::where('timeStart', '=', $timeStart)
                                        ->first();

            if ($scheduleTime == null) {

                $scheduleTime = ScheduleTime::create([
                    'timeStart' => $timeStart
                ]);

            }//end if

            $serviceSchedule    =   ScheduleService::create([
                'intSCatIdFK'           =>  $id,
                'intScheduleTimeIdFK'   =>  $scheduleTime->intScheduleTimeId
            ]);

            \DB::commit();

            $serviceSchedule    =   ScheduleService::join('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
                                        ->where('tblSchedService.intSchedServiceId', '=', $serviceSchedule->intSchedServiceId)
                                        ->first([
                                            'tblScheduleTime.timeStart',
                                            'tblSchedService.intSchedServiceId'
                                        ]);

            $serviceSchedule->time_start    =   Carbon::parse($serviceSchedule->timeStart)->toDateTimeString();

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

        $serviceScheduleList        =   ScheduleService::join('tblScheduleTime', 'tblScheduleTime.intScheduleTimeId', '=', 'tblSchedService.intScheduleTimeIdFK')
                                            ->where('tblSchedService.intSCatIdFK', '=', $id)
                                            ->get([
                                                'tblScheduleTime.timeStart',
                                                'tblSchedService.intSchedServiceId'
                                            ]);

        $serviceCategory            =   ServiceCategory::find($id);

        foreach ($serviceScheduleList as $serviceSchedule){

            $timeStart        =   Carbon::parse($serviceSchedule->timeStart);
            $serviceSchedule->time_start    =   $timeStart->toDateTimeString();

            $serviceSchedule->status        =   ScheduleDetail::join('tblScheduleDay', 'tblScheduleDay.intScheduleDayId', '=', 'tblScheduleDetail.intScheduleDayIdFK')
                                                    ->join('tblSDLog', 'tblScheduleDetail.intScheduleDetailId', '=', 'tblSDLog.intSDIdFK')
                                                    ->where('tblScheduleDay.dateSchedule', '=', $date)
                                                    ->where('tblScheduleDetail.intSchedServiceIdFK', '=', $serviceSchedule->intSchedServiceId)
                                                    ->orderBy('tblSDLog.created_at', 'desc')
                                                    ->first([
                                                        'tblSDLog.intScheduleStatus'
                                                    ]);

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
}
