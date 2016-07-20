<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class TransactionOwnership extends Model
{
    protected $table            =   'tblTransactionOwnership';
    protected $primaryKey       =   'intTransactionOwnershipId';

    protected $fillable         =   [
        'intPrevOwnerIdFK', 'intNewOwnerIdFK', 'deciAmountPaid', 'intPaymentType', 'intUnitIdFK'
    ];
}
