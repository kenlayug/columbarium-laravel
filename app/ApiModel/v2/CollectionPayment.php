<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionPayment extends Model
{
    protected $table = 'tblCollectionPayment';
    protected $primaryKey = 'intCollectionPaymentId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intCollectionIdFK', 'intPaymentType', 'deciAmountPaid', 'intChequeIdFK'
    ];
}
