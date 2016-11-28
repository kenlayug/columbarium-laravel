<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectionPayment extends Model
{
    protected $table = 'tblCollectionPayment';
    protected $primaryKey = 'intCollectionPaymentId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'intCollectionIdFK', 'intPaymentType', 'deciAmountPaid', 'intChequeIdFK'
    ];

    public function collectionPaymentDetails(){

    	return $this->hasMany('App\ApiModel\v3\CollectionPaymentDetail', 'intCollectionPaymentIdFK');

    }//end function

    public function collection(){

        return $this->belongsTo('App\ApiModel\v2\Collection', 'intCollectionIdFK', 'intCollectionId');

    }//end function
}
