<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    protected $table = 'tblCollection';
    protected $primaryKey = 'intCollectionId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intCustomerIdFK', 'intUnitCategoryPriceIdFK', 'intInterestRateIdFK', 'dateCollectionStart'
    ];
}
