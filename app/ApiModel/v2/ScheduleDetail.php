<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    protected $table        =   'tblScheduleDetail';
    protected $primaryKey   =   'intScheduleDetailId';
    protected $fillable     =   [
        'intSchedServiceIdFK',
        'intScheduleDayIdFK',
        'intTPDetailIdFK',
        'strRemarks',
        'intMinuteDelayCaused'
    ];
}
