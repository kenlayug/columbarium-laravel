<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class ScheduleService extends Model
{
    protected $table        =   'tblSchedService';
    protected $primaryKey   =   'intSchedServiceId';

    protected $fillable     =   [
        'intSCatIdFK',
        'intScheduleTimeIdFK'
    ];

    public function getTimeStartAttribute(){

        return $this->attributes['timeStart'];

    }

    public function setTimeStartAttribute($value){

        $this->attributes['timeStart']    =   $value;

    }

    public function getStatus(){

        return $this->attributes['status'];

    }

    public function setStatus($value){

        $this->attributes['status'] =   $value;

    }
}