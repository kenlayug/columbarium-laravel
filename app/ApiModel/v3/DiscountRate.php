<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class DiscountRate extends Model
{
    protected $table 			=	'tblDiscountRate';
    protected $primaryKey 		=	'intDiscountRateId';
    protected $fillable			=	[
    	'intDiscountIdFK',
    	'intDiscountType',
    	'deciDiscountRate'
    ];
}
