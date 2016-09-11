<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class AssignDiscount extends Model
{
    protected $table 		=	'tblAssignDiscount';
    protected $primaryKey 	=	'intAssignDiscountId';
    protected $fillable 	=	[
    	'intServiceIdFK',
    	'intDiscountIdFK',
    	'intTransactionId'
    ];
}
