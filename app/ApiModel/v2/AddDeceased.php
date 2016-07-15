<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddDeceased extends Model
{
    protected $table        =   'tblAddDeceased';
    protected $primaryKey   =   'intAddDeceasedId';
    protected $dates        =   ['deleted_at'];
    use SoftDeletes;
    protected $fillable     =   [
        'intDeceasedIdFK',
        'intUnitDeceasedIdFK',
        'intServiceIdFK',
        'intServicePriceIdFK',
        'intPaymentType',
        'deciAmountPaid'
    ];
}
