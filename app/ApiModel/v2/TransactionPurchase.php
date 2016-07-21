<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionPurchase extends Model
{
    protected $table            =   'tblTransactionPurchase';
    protected $primaryKey       =   'intTransactionPurchaseId';
    protected $dates            =   ['deleted_at'];
    use SoftDeletes;

    protected $fillable         =   [
        'intCustomerIdFK',
        'intPaymentType',
        'intPaymentMode',
        'deciAmountPaid'
    ];
}
