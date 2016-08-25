<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class TransactionUnit extends Model
{
    protected $table		=	'tblTransactionUnit';
    protected $primaryKey	=	'intTransactionUnitId';
    protected $fillable		=	[
    	'intCustomerIdFK', 'deciAmountPaid', 'intPaymentType', 'intTransactionType'
    ];
}
