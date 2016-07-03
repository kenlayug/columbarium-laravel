<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $table        =   'tblRoom';
    protected $primaryKey   =   'intRoomId';
    protected $fillable     =   [
        'strRoomName', 'intFloorIdFK', 'intMaxBlock'
    ];
    protected $dates        =   ['deleted_at'];

    use SoftDeletes;

    public function floor(){
        return $this->belongsTo('App\ApiModel\v2\Floor', 'intFloorIdFK');
    }

    public function roomDetails(){
        return $this->hasMany('App\ApiModel\v2\RoomDetail', 'intRoomIdFK');
    }

    public function getRoomDetailsAttribute(){
        return $this->attributes['roomDetails'];
    }

    public function setRoomDetailsAttribute($value){
        $this->attributes['roomDetails'] = $value;
    }

    public function getBlockCountAttribute(){
        return $this->attributes['blockCount'];
    }

    public function setBlockCountAttribute($value){
        $this->attributes['blockCount'] = $value;
    }

}
