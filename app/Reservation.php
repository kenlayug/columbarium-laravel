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

    public function getDownpaymentAttribute(){
        return $this->attributes['downpayment'];
    }

    public function setDownpaymentAttribute($value){
        $this->attributes['downpayment'] = $value;
    }

    public function getBalanceAttribute(){
        return $this->attributes['balance'];
    }

    public function setBalanceAttribute($value){
        $this->attributes['balance'] = $value;
    }

    public function getPaymentTypeAttribute(){
        return $this->attributes['paymentType'];
    }

    public function setPaymentTypeAttribute($value){
        $this->attributes['paymentType'] = $value;
    }

}
