<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class ScheduleTime extends Model
{
    protected $table        =   'tblScheduleTime';
    protected $primaryKey   =   'intScheduleTimeId';
    protected $fillable     =   [
        'timeStart'
    ];
}
