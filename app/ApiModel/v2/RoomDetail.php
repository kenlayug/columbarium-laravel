<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomDetail extends Model
{
    protected $table        =   'tblRoomDetail'     ;
    protected $primaryKey   =   'intRoomDetailId'   ;
    protected $fillable     =   [
        'intRoomIdFK', 'intRoomTypeIdFK'
    ];
    protected $dates        =   [
        'deleted_at'
    ];
    use SoftDeletes;

    public function room(){
        return $this->belongsTo('App\ApiModel\v2\Room', 'intRoomIdFK');
    }

}
