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
}
