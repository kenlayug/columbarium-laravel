<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class TransactionPurchaseDetail extends Model
{
    protected $table            =   'tblTPurchaseDetail';
    protected $primaryKey       =   'intTPurchaseDetailId';
    protected $fillable         =   [
        'intTPurchaseIdFK',
        'intTPurchaseDetailType',
        'intAdditionalIdFK',
        'intAdditionalPriceIdFK',
        'intServiceIdFK',
        'intServicePriceIdFK',
        'intPackageIdFK',
        'intPackagePriceIdFK',
        'intQuantity'
    ];
}
