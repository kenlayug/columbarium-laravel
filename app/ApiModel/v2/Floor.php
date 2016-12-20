<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table    =   'tblFloor';
    protected $primaryKey   =   'intFloorId';

    public function rooms(){
        return $this->hasMany('App\ApiModel\v2\Room', 'intFloorIdFK', 'intFloorId');
    }

    public function building(){

        return $this->belongsTo('App\Building', 'intBuildingIdFK', 'intBuildingId');

    }

    public function getUnitTypeAttribute(){
        return $this->attributes['unitType'];
    }

    public function setUnitTypeAttribute($value){
        $this->attributes['unitType'] = $value;
    }

}
