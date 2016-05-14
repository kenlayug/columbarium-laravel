<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    protected $table = 'tblBuilding';
    protected $primaryKey = 'intBuildingId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function floors(){
    	return $this->hasMany('App\Floor', 'intBuildingIdFK');
    }

    public function getFloorNoAttribute(){
    	return $this->attributes['floorNo'];
    }

    public function setFloorNoAttribute($value){
    	$this->attributes['floorNo'] = $value;
    }

    public function getFloorsAttribute(){
        return $this->attributes['floor'];
    }

    public function setFloorsAttribute($value){
        $this->attributes['floor'] = $value;
    }

    public function getFloorsStatusAttribute(){
        return $this->attributes['floorStatus'];
    }

    public function setFloorsStatusAttribute($value){
        $this->attributes['floorStatus'] = $value;
    }
}
