<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $table        =   'tblRoom';
    protected $primaryKey   =   'intRoomId';
    protected $fillable     =   [
        'intRoomNo', 'intFloorIdFK'
    ];
    protected $dates        =   ['deleted_at'];

    use SoftDeletes;

    public function floor(){
        return $this->belongsTo('App\Floor', $this->getForeignKey(), 'intFloorId');
    }

    public function roomTypes(){
        return $this->hasMany('App\ApiModel\v2\RoomType', 'intRoomIdFK', 'intRoomId');
    }

}
