<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReservationDetail extends Model
{
    protected $table = 'tblReservationDetail';
    protected $primaryKey = 'intReservationDetailId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'intReservationIdFK', 'intInterestIdFK', 'intUnitIdFK', 'intUnitCategoryPriceIdFK', 'intInterestRateIdFK'
    ];

    public function reservation(){
        return $this->belongsTo('App/Reservation', 'intReservationIdFK', 'intReservationId');
    }

    public function getUnitTypeAttribute(){
        return $this->attributes['unitType'];
    }

    public function setUnitTypeAttribute($value){
        $this->attributes['unitType'] = $value;
    }
}
