<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional extends Model
{
    protected $table = 'tblAdditional';
    protected $primaryKey = 'intAdditionalId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function additionalPrices(){
    	return $this->hasMany('App\AdditionalPrice', 'intAdditionalIdFK');
    }

    public function additionalCategory(){
    	return $this->hasOne('App\AdditionalCategory', 'intAdditionalCategoryId')
    			->select('strAdditionalCategoryName');
    }

    public function getPriceAttribute(){
    	return $this->attributes['price'];
    }

    public function setPriceAttribute($value){
    	$this->attributes['price'] = $value;
    }

    public function getCategoryAttribute(){
    	return $this->attributes['category'];
    }

    public function setCategoryAttribute($value){
    	$this->attributes['category'] = $value;
    }

}
