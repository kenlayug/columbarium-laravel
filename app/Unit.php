<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'tblUnit';
    protected $primaryKey = 'intUnitId';

    protected $fillable = [
        'intBlockIdFK', 'intUnitType', 'intUnitCategoryIdFK', 'intColumnNo', 'intUnitStatus'
    ];

    public function getUnitPriceAttribute(){
        return $this->attributes['unitPrice'];
    }

    public function setUnitPriceAttribute($value){
        $this->attributes['unitPrice'] = $value;
    }

    public function getInterestAttribute(){
        return $this->attributes['interest'];
    }

    public function setInterestAttribute($value){
        $this->attributes['interest'] = $value;
    }
}
