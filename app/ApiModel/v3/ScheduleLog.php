<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class ScheduleLog extends Model
{
    protected $table 			=	'tblScheduleLog';
    protected $primaryKey		=	'intScheduleLogId';
    protected $fillable			=	[
    	'intServiceCategoryIdFK',
    	'intRoomIdFK'
    ];
}
