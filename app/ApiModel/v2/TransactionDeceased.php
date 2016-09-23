<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDeceased extends Model
{
    protected $table        =   'tblTransactionDeceased';
    protected $primaryKey   =   'intTransactionDeceasedId';
    protected $dates        =   ['deleted_at'];
    use SoftDeletes;
    protected $fillable     =   [
        'intPaymentType',
        'intTransactionType',
        'deciAmountPaid',
        'intChequeIdFK'
    ];
}
