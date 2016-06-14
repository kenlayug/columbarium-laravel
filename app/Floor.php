<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    protected $table = 'tblFloor';
    protected $primaryKey = 'intFloorId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function building(){
    	return $this->belongsTo('App\Building', 'intBuildingIdFK');
    }

    public function floorDetails(){
    	return $this->hasMany('App\FloorDetail', 'intFloorIdFK');
    }

}
