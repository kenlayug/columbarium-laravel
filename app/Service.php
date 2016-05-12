<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    protected $table = 'tblService';
    protected $primaryKey = 'intServiceId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function servicePrices(){
    	return $this->hasMany('App\ServicePrice', 'intServiceIdFK');
    }

    public function getPrice(){
    	return $this->attributes['price'];
    }

    public function setPrice($value){
    	$this->attributes['price'] = $value;
    }
}
