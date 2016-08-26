<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class TransactionUnitDetail extends Model
{
    protected $table		=	'tblTransactionUnitDetail';
    protected $primaryKey	=	'intTransactionUnitDetailId';
    protected $fillable		=	[
    	'intTransactionUnitIdFK', 'intUnitIdFK', 'intUnitCategoryPriceIdFK'
    ];

    public function getPriceAttribute(){
    	return $this->attributes['deciPrice'];
    }

    public function setPriceAttribute($value){
    	$this->attributes['deciPrice']		=	$value;
    }
}
