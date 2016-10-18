<?php

namespace App\ApiModel\v3;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table 			=	'tblNotification';
    protected $primaryKey 		=	'intNotification';
    protected $fillable 		=	[
    	'intCollectionIdFK',
    	'intDownpaymentIdFK',
    	'intScheduleDetailIdFK',
    	'intNotificationType'
    ];
}
