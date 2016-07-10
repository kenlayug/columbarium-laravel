<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtNeed extends Model
{
    protected $table        =   'tblAtNeed';
    protected $primaryKey   =   'intAtNeedId';
    protected $dates        =   ['deleted_at'];
    use SoftDeletes;
    protected $fillable    =   [
        'intCustomerIdFK',
        'deciAmountPaid',
        'intPaymentType'
    ];
}
