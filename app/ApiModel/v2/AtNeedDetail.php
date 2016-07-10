<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtNeedDetail extends Model
{
    protected $table        =   'tblAtNeedDetail';
    protected $primaryKey   =   'intAtNeedDetailId';
    protected $dates        =   ['deleted_at'];
    use SoftDeletes;
    protected $fillable     =   [
        'intAtNeedIdFK',
        'intUnitIdFK',
        'intUnitCategoryPriceIdFK',
        'intInterestIdFK',
        'intInterestRateIdFK',
        'boolDownpayment'
    ];
}
