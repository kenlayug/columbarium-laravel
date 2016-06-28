<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class Downpayment extends Model
{
    protected $table = 'tblDownpayment';
    protected $primaryKey = 'intDownpaymentId';
    protected $fillable = [
        'intReservationDetailIdFK', 'deciAmount', 'intPaymentType'
    ];

    public function getUnitTypeAttribute(){
        return $this->attributes['unitType'];
    }

    public function setUnitTypeAttribute($value){
        $this->attributes['unitType'] = $value;
    }

    public function getPaymentTypeAttribute(){
        return $this->attributes['paymentType'];
    }

    public function setPaymentTypeAttribute($value){
        $this->attributes['paymentType'] = $value;
    }
}
