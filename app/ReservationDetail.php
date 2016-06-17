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

    public function reservation(){
        return $this->belongsTo('App/Reservation', 'intReservationIdFK', 'intReservationId');
    }
}
