<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    protected $table = 'tblBlock';
    protected $primaryKey = 'intBlockId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
      'intBlockNo', 'intUnitType', 'intRoomIdFK'
    ];
}
