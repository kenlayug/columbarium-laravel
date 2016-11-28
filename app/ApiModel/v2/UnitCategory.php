<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitCategory extends Model
{
    protected $table = 'tblUnitCategory';
    protected $primaryKey = 'intUnitCategoryId';

    protected $fillable = [
      'intFloorIdFK', 'intLevelNo', 'intUnitTypeIdFK'
    ];

    public function unitCategoryPrices(){

        return $this->hasMany('App\UnitCategoryPrice', 'intUnitCategoryIdFK', 'intUnitCategoryId');

    }//end function

    public function getPriceAttribute(){
        return $this->attributes['price'];
    }

    public function setPriceAttribute($value){
        $this->attributes['price']  =   $value;
    }

}
