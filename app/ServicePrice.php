<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    protected $table = 'tblServicePrice';
    protected $primaryKey = 'intServicePriceId';

    protected $fillable =   [
        'intServiceIdFK', 'deciPrice'
    ];

    public function service(){
    	return $this->belongsTo('App\Service', 'intServiceIdFK');
    }
}
