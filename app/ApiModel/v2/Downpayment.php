<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;

class Downpayment extends Model
{
    protected $table = 'tblDownpayment';
    protected $primaryKey = 'intDownpaymentId';
    protected $fillable = [
        'intCustomerIdFK',
        'intUnitIdFK',
        'intUnitCategoryPriceIdFK',
        'intInterestRateIdFK',
        'dateDueDate'
    ];
    use SoftDelete;
    protected $dates    =   ['deleted_at'];


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

    public function getBalanceAttribute(){
        return $this->attributes['deciBalance'];
    }

    public function setBalanceAttribute($value){

        $this->attributes['deciBalance']    =   $value;

    }
}
