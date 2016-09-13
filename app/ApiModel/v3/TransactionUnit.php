<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class TransactionUnit extends Model
{
    protected $table		=	'tblTransactionUnit';
    protected $primaryKey	=	'intTransactionUnitId';
    protected $fillable		=	[
    	'intCustomerIdFK', 'deciAmountPaid', 'intPaymentType', 'intChequeIdFK'
    ];

    public function getAmountAttribute(){
    	return $this->attributes['deciAmount'];
    }

    public function setAmountAttribute($value){
    	$this->attributes['deciAmount']		=	$value;
    }
}
