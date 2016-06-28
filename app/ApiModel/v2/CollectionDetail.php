<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionDetail extends Model
{
    protected $table = 'tblCollectionPayment';
    protected $primaryKey = 'tblCollectionPaymentId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intCollectionIdFK', 'intPaymentType'
    ];
}
