<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table        =   'tblRoomType'   ;
    protected $primaryKey   =   'intRoomTypeId' ;
    protected $fillable     =   [
        'strRoomTypeName', 'boolUnit'
    ];

    public function room(){
        return $this->belongsTo('App\ApiModel\v2\Room', 'intRoomIdFK', 'intRoomId');
    }
}
