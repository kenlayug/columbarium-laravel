<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    protected $table = 'tblReservation';
    protected $primaryKey = 'intReservationId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'intCustomerIdFK', 'deciAmountPaid'
    ];

    public function reservationDetails(){
        return $this->hasMany('App/ReservationDetail', 'intReservationIdFK', 'intReservationId');
    }

}
