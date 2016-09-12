<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    protected $table 		=	'tblInterest';
    protected $primaryKey	=	'intInterestId';

    use SoftDeletes;

    protected $dates 		=	[
    	'deleted_at'
    ];
    protected $fillable		=	[
    	'intNoOfYear'
    ];
}
