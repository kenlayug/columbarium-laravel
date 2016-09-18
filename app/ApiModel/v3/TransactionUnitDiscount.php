<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class TransactionUnitDiscount extends Model
{
    protected $table 			=	'tblTransactionUnitDiscount';
    protected $primaryKey 		=	'intTransactionUnitDiscountId';
    protected $fillable 		=	[
    	'intTransactionUnitIdFK',
    	'intDiscountRateIdFK'
    ];
}
