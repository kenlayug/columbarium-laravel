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
        'intMinuteDelayCaused',
        'intDeceasedIdFK'
    ];

    public function getStatusAttribute(){
        return $this->attributes['status'];
    }

    public function setStatusAttribute($value){
        $this->attributes['status']  =   $value;
    }
}
