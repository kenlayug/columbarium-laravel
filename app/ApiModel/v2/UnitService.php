<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class UnitService extends Model
{
    protected $table        =   'tblUnitService';
    protected $primaryKey   =   'intUnitServiceId';
    protected $fillable     =   [
        'intUnitTypeIdFK', 'intServiceTypeId', 'intServiceIdFK'
    ];
}
