<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyUnit extends Model
{
    protected $table = 'tblBuyUnit';
    protected $primaryKey = 'intBuyUnitId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;
    protected $fillable = [
        'intCustomerIdFK', 'deciAmountPaid', 'intPaymentType'
    ];
}
