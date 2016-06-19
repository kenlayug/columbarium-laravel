<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $table = 'tblRoom';
    protected $primaryKey = 'intRoomId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intRoomNo', 'intFloorIdFK', 'intRoomTypeIdFK'
    ];
}
