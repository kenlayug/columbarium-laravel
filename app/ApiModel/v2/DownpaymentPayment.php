<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class DownpaymentPayment extends Model
{
    protected $table            =   'tblDownpaymentPayment';
    protected $primaryKey       =   'intDownpaymentPaymentId';
    protected $fillable         =   [
        'intDownpaymentIdFK',
        'deciAmountPaid',
        'intPaymentType',
        'intChequeIdFK'
    ];

    public function downpayment(){

    	return $this->belongsTo('App\ApiModel\v2\Downpayment', 'intDownpaymentIdFK', 'intDownpaymentId');

    }//end function
}
