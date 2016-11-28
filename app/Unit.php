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

    public function block(){

        return $this->belongsTo('App\ApiModel\v2\Block', 'intBlockId', 'intBlockIdFK');

    }//end function

    public function unitCategory(){

        return $this->belongsTo('App\ApiModel\v2\UnitCategory', 'intUnitCategoryIdFK', 'intUnitCategoryId');

    }//end function

    public function getUnitDisplayAttribute(){

        return chr(64+$this->unitCategory->intLevelNo).$this->intColumnNo;

    }//end function

    public function getDeciUnitPrice(){

        return $this->unitCategory->unitCategoryPrices()
            ->orderBy('created_at', 'desc')
            ->first()
            ->deciPrice;

    }//end function

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
