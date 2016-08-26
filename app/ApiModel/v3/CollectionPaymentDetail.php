<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class CollectionPaymentDetail extends Model
{
    protected $table		=	'tblCollectionPaymentDetail';
    protected $primaryKey 	=	'intCollectionPaymentDetailId';
    protected $fillable 	=	[
    	'intCollectionPaymentIdFK',
    	'dateDue'
    ];
    public $timestamps 		=	false;
}
