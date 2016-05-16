<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterestRate extends Model
{
    protected $table = 'tblInterestRate';
    protected $primaryKey = 'intInterestRateId';

    public function interest(){
    	return $this->belongsTo('App\Interest', 'intInterestIdFK');
    }
}
