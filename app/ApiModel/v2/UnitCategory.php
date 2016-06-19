<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitCategory extends Model
{
    protected $table = 'tblUnitCategory';
    protected $primaryKey = 'intUnitCategoryId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
      'intFloorIdFK', 'intLevelNo'
    ];

    public function unitCategoryPrices(){
        return $this->hasMany('App\UnitCategoryPrice', $this->getForeignKey(), $this->primaryKey);
    }
}
