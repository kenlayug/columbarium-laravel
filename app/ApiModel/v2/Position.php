<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table 		=	'tblPosition';
    protected $primaryKey 	=	'intPositionId';
    protected $fillable 	=	[
    	'strPositionName',
    	'intUserAuth'
    ];
}
