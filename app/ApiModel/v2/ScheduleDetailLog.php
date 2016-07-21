<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class ScheduleDetailLog extends Model
{
    protected $table        =   'tblSDLog';
    protected $primaryKey   =   'intSDLogId';
    protected $fillable     =   [
        'intScheduleStatus',
        'intSDIdFK'
    ];
}
