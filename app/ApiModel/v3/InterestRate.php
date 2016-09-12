<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class InterestRate extends Model
{
    protected $table 		=	'tblInterestRate';
    protected $primaryKey 	=	'intInterestRateId';
    protected $fillable 	=	[
    	'intInterestIdFK',
    	'intAtNeed',
    	'deciInterestRate'
    ];
}
