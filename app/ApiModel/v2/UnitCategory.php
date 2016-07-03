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
    
}
