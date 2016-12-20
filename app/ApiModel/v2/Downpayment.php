<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\ApiModel\v2\BusinessDependency;

use Carbon\Carbon;

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
    use SoftDeletes;
    protected $dates    =   ['deleted_at'];

    public function downpaymentPayments(){

        return $this->hasMany('App\ApiModel\v2\DownpaymentPayment', 'intDownpaymentIdFK');

    }

    public function downpaymentDiscounts(){

        return $this->hasMany('App\ApiModel\v3\DownpaymentDiscount', 'intDownpaymentIdFK');

    }

    public function unitCategoryPrice(){

        return $this->hasOne('App\UnitCategoryPrice', 'intUnitCategoryPriceId', 'intUnitCategoryPriceIdFK');

    }

    public function unit(){

        return $this->hasOne('App\Unit', 'intUnitId', 'intUnitIdFK');

    }

    public function customer(){

        return $this->belongsTo('App\ApiModel\v4\Customer', 'intCustomerIdFK', 'intCustomerId');

    }

    public function getDeciBalanceAttribute(){

        return $this->deci_downpayment_amount - $this->deci_amount_paid;

    }

    public function getDeciAmountPaidAttribute(){

        $deciTotalPayment       =   $this->downpaymentPayments
            ->sum('deciAmountPaid');

        return $deciTotalPayment;

    }//end function

    public function getBoolDiscountedAttribute(){

        $discountDownpayment    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
            ->first(['deciBusinessDependencyValue']);

        if (Carbon::parse($this->created_at)->addDays($discountDownpayment->deciBusinessDependencyValue) >= Carbon::today()){

            //downpayment within days with discount
            return true;

        }//end if

        return false;

    }//end function

    public function getDeciDownpaymentAmountAttribute(){

        $downpaymentBD          =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
            ->first(['deciBusinessDependencyValue']);

        $discountDownpayment    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'voidReservationNoPayment')
            ->first(['deciBusinessDependencyValue']);

        $unitCategoryPrice      =   $this->unitCategoryPrice;

        $deciDownpaymentAmount  =   $downpaymentBD->deciBusinessDependencyValue * $unitCategoryPrice->deciPrice;

        if (Carbon::parse($this->created_at)->addDays($discountDownpayment->deciBusinessDependencyValue) >= Carbon::today()){

            //downpayment within days with discount
            $deciDiscount       =   0;
            foreach($this->downpaymentDiscounts as $discount){

                $discountRate       =   $discount->discountRate;
                if ($discountRate->intDiscountType == 1){

                    $deciDiscount      +=  ($deciDownpaymentAmount * $discountRate->deciDiscountRate);

                }else{

                    $deciDiscount       +=  $deciDiscountRate;

                }//else

            }//end foreach
            return $deciDownpaymentAmount - $deciDiscount;

        }//end if

        return $deciDownpaymentAmount;

    }//end function

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
