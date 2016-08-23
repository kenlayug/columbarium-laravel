<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    protected $table = 'tblCollection';
    protected $primaryKey = 'intCollectionId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intCustomerIdFK', 'intUnitCategoryPriceIdFK', 'intInterestRateIdFK', 'dateCollectionStart', 'intUnitIdFK'
    ];

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
}
