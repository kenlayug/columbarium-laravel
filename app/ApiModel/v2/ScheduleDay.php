<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class ScheduleDay extends Model
{
    protected $table            =   'tblScheduleDay';
    protected $primaryKey       =   'intScheduleDayId';
    protected $fillable         =   [
        'dateSchedule'
    ];
}
