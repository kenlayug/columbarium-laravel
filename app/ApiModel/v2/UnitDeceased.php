<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitDeceased extends Model
{
    protected $table        =   'tblUnitDeceased';
    protected $primaryKey   =   'intUnitDeceasedId';
    protected $dates        =   ['deleted_at'];
    use SoftDeletes;
    protected $fillable     =   [
        'intUnitIdFK', 'intDeceasedIdFK', 'intStorageTypeIdFK'
    ];

    public function getReturnAttribute(){

        return $this->attributes['return'];

    }

    public function setReturnAttribute($value){

        $this->attributes['return']     =   $value;

    }
}
