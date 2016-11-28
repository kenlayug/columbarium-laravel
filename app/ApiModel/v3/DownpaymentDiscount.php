<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class DownpaymentDiscount extends Model
{
    protected $table 		=	'tblDownpaymentDiscount';
    protected $primaryKey 	=	'intDownpaymentDiscountId';

    protected $fillable 	=	[
    	'intDownpaymentIdFK',
    	'intDiscountRateIdFK'
    ];

    public function discountRate(){

    	return $this->belongsTo('App\ApiModel\v3\DiscountRate', 'intDiscountRateIdFK');

    }//end function
}
