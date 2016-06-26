<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class Downpayment extends Model
{
    protected $table = 'tblDownpayment';
    protected $primaryKey = 'intDownpaymentId';
    protected $fillable = [
        'intReservationDetailIdFK', 'deciAmount', 'intPaymentType'
    ];
}
