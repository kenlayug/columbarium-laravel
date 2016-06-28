<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyUnitDetail extends Model
{
    protected $table = 'tblBuyUnitDetail';
    protected $primaryKey = 'intBuyUnitDetailId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;
    protected $fillable = [
        'intBuyUnitIdFK', 'intUnitIdFK', 'intUnitCategoryPriceIdFK'
    ];
}
