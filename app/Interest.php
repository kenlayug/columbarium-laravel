<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    protected $table = 'tblInterest';
    protected $primaryKey = 'intInterestId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function interestRates(){
    	return $this->hasMany('App\Interest', 'intInterestIdFK');
    }

    public function getInterestRateAttribute(){
    	return $this->attributes['interestRate'];
    }

    public function setInterestRateAttribute($value){
    	$this->attributes['interestRate'] = $value;
    }
}
