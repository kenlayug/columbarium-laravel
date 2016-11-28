<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Collection extends Model
{
    protected $table = 'tblCollection';
    protected $primaryKey = 'intCollectionId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intCustomerIdFK', 'intUnitCategoryPriceIdFK', 'intInterestRateIdFK', 'dateCollectionStart', 'intUnitIdFK',
        'intServicePriceIdFK', 'intPackagePriceIdFK', 'intTPurchaseDetailIdFK'
    ];

    public function collectionPayments(){

        return $this->hasMany('App\ApiModel\v2\CollectionPayment', 'intCollectionIdFK');

    }//end function

    public function customer(){

        return $this->belongsTo('App\ApiModel\v4\Customer', 'intCustomerIdFK');

    }//end function

    public function unitCategoryPrice(){

        return $this->hasOne('App\UnitCategoryPrice', 'intUnitCategoryPriceId', 'intUnitCategoryPriceIdFK');

    }//end function

    public function unit(){

        return $this->hasOne('App\Unit', 'intUnitId', 'intUnitIdFK');

    }//end function

    public function servicePrice(){

        return $this->hasOne('App\ServicePrice', 'intServicePriceId', 'intServicePriceIdFK');

    }//end function

    public function packagePrice(){

        return $this->hasOne('App\PackagePrice', 'intPackagePriceId', 'intPackagePriceIdFK');

    }//end function

    public function interestRate(){

        return $this->hasOne('App\ApiModel\v3\InterestRate', 'intInterestRateId', 'intInterestRateIdFK');

    }//end function

    public function getDateLastPaymentAttribute(){

        $lastCollectionPayment      =   $this->collectionPayments()
            ->orderBy('created_at', 'desc')
            ->first();

        $dateLastPayment            =   Carbon::parse($this->dateCollectionStart)
            ->subMonth();

        if ($lastCollectionPayment){

            $dateLastPayment        =   Carbon::parse($lastCollectionPayment->collectionPaymentDetails()
                ->orderBy('dateDue', 'desc')
                ->first()
                ->dateDue);

        }//end if

        return $dateLastPayment;

    }//end function

    public function getDateNextDueAttribute(){

        return $this->attributes['date_next_due'];

    }//end function

    public function setDateNextDueAttribute($value){

        $this->attributes['date_next_due']  =   $value;

    }//end function

    public function getIntMonthsPaidAttribute(){

        $collectionPaymentList      =   $this->collectionPayments;
        $intMonthsPaid              =   0;

        foreach($collectionPaymentList as $collectionPayment){

            $intMonthsPaid          +=  $collectionPayment->collectionPaymentDetails()
                ->count();

        }//end foreach

        return $intMonthsPaid;

    }//end function

    public function getDeciCollectibleAttribute(){

        $dateLastPayment            =   $this->date_last_payment;

        $this->date_next_due        =   Carbon::parse($dateLastPayment)
            ->addMonth();

        $dateNow                    =   Carbon::today();
        $deciAmountToReceive        =   0;

        while($dateNow >= $this->date_next_due){

            $deciAmountToReceive    +=  ($this->deci_monthly_amortization + $this->deci_penalty);
            $this->date_next_due    =   Carbon::parse($this->date_next_due)->addMonth();

        }//end for

        return $deciAmountToReceive;

    }//end function

    public function getDeciPreNeedCollectibleAttribute(){

        $dateLastPayment            =   $this->date_last_payment;

        $this->date_next_due        =   Carbon::parse($dateLastPayment)
            ->addMonth();

        $dateNow                    =   Carbon::today();
        $deciAmountToReceive        =   0;
        $deciMonthly                =   0;

        if (!$this->intUnitIdFK){

            if ($this->intServicePriceIdFK){

                //collection with service
                $deciMonthly        =   $this->servicePrice->deciPrice/12;

            }else{

                //collection with package
                $deciMonthly        =   $this->packagePrice->deciPrice/12;

            }//end else

        }//end if

        while($dateNow >= $this->date_next_due){

            $deciAmountToReceive    +=  ($deciMonthly + $this->deci_penalty);
            $this->date_next_due    =   Carbon::parse($this->date_next_due)->addMonth();

        }//end for

        return round($deciAmountToReceive, 2);

    }//end function

    public function getDeciMonthlyAmortizationAttribute(){

        $monthlyAmortization        =   0;
        if ($this->intUnitIdFK){

            $downpaymentPercentage  =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'downpayment')
                ->first(['deciBusinessDependencyValue']);

            $unitCategoryPrice      =   $this->unitCategoryPrice;

            $interestRate           =   $this->interestRate;
            $interest               =   $interestRate->interest;

            $downPaymentPrice       =   $unitCategoryPrice->deciPrice * $downpaymentPercentage->deciBusinessDependencyValue;

            $balance                =   $unitCategoryPrice->deciPrice - $downPaymentPrice;

            $monthsToPay            =   $interest->intNoOfYear*12;

            $monthlyAmortization    =   ((($balance*($interestRate->deciInterestRate))*$interest->intNoOfYear)+$balance)/$monthsToPay;

        }else{

            if ($this->servicePrice){

                $monthlyAmortization    =   $this->servicePrice->deciPrice/12;

            }else{

                $monthlyAmortization    =   $this->packagePrice->deciPrice/12;

            }//end else

        }//end else

        return round($monthlyAmortization, 2);

    }//end function

    public function getDeciPenaltyAttribute(){

        $penalty                    =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'penalty')
            ->first(['deciBusinessDependencyValue']);
        $gracePeriod                =   BusinessDependency::where('strBusinessDependencyName', 'LIKE', 'gracePeriod')
            ->first(['deciBusinessDependencyValue']);

        $dateNow                =   Carbon::today();

        if (array_key_exists('date_next_due', $this->attributes)){

            $dateDueWithPenalty     =   Carbon::parse($this->date_next_due)
                ->addDays($gracePeriod->deciBusinessDependencyValue);

        }//end if
        else{

            $dateDueWithPenalty     =   Carbon::parse($this->date_last_payment)
                ->addMonth()
                ->addDays($gracePeriod->deciBusinessDependencyValue);

        }//end else

        $intMonthDue            =   0;

        if ($dateNow >= $dateDueWithPenalty){
            $intMonthDue            =   $dateNow->diffInMonths($dateDueWithPenalty)+1;
        }

        $totalPenaltyPercentage = 0;

        for($intCtr = 1; $intCtr <= $intMonthDue; $intCtr++){

            $intOverDue =   $intMonthDue-$intCtr;
            $penaltyPercentageToAdd = $intOverDue*$penalty->deciBusinessDependencyValue;
            $totalPenaltyPercentage += $penaltyPercentageToAdd+$penalty->deciBusinessDependencyValue;

        }

        if ($this->intUnitIdFK){

            //collection for units
            $penaltyAmount  =   $this->deci_monthly_amortization*$totalPenaltyPercentage;

        }else{

            if ($this->servicePrice){

                //collection for services
                $penaltyAmount  =   round($this->servicePrice->deciPrice/12, 2) * $totalPenaltyPercentage;

            }else{

                //collection for packages
                $penaltyAmount  =   round($this->packagePrice->deciPrice/12, 2) * $totalPenaltyPercentage;

            }//end else

        }//end else

        return round($penaltyAmount, 2);

    }//end function

    public function getPaymentPaidAttribute(){
    	return $this->attributes['deciPaymentPaid'];
    }

    public function setPaymentPaidAttribute($value){
    	$this->attributes['deciPaymentPaid']		=	$value;
    }

    public function getCollectionDateAttribute(){
        return $this->attributes['dateCollection'];
    }

    public function setCollectionDateAttribute($value){
        $this->attributes['dateCollection']         =   $value;
    }

    public function getPenaltyAttribute(){
        return $this->attributes['deciPenalty'];
    }

    public function setPenaltyAttribute($value){
        $this->attributes['deciPenalty']            =   $value;
    }

    public function getMonthlyAttribute(){
        return $this->attributes['deciMonthlyAmortization'];
    }

    public function setMonthlyAttribute($value){
        $this->attributes['deciMonthlyAmortization']    =   $value;
    }
}
