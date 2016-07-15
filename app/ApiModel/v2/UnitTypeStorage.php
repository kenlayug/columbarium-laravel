<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitTypeStorage extends Model
{
    protected $table        =   'tblUnitTypeStorage';
    protected $primaryKey   =   'intUnitTypeStorageId';
    protected $dates        =   ['deleted_at'];
    protected $fillable     =   [
        'intUnitTypeIdFK', 'intStorageTypeIdFK', 'intQuantity'
    ];
    use SoftDeletes;
}
