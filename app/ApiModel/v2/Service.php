<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    protected $table = 'tblService';
    protected $primaryKey = 'intServiceId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
        'strServiceName', 'intServiceCategoryIdFK', 'strServiceDesc', 'boolUnit'
    ];

    public function servicePrices(){
        return $this->hasMany('App\ServicePrice', 'intServiceIdFK');
    }

    public function getPriceAttribute(){
        return $this->attributes['price'];
    }

    public function setPriceAttribute($value){
        $this->attributes['price']  =   $value;
    }
}
