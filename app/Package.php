<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    protected $table = 'tblPackage';
    protected $primaryKey = 'intPackageId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function packagePrices(){
    	return $this->hasMany('App\PackagePrice', 'intPackageIdFK');
    }

    public function packageAdditionals(){
    	return $this->hasMany('App\PackageAdditional', 'intPackageIdFK');
    }

    public function packageServices(){
    	return $this->hasMany('App\PackageService', 'intPackageIdFK');
    }

    public function getPriceAttribute(){
    	return $this->attributes['price'];
    }

    public function setPriceAttribute($value){
    	$this->attributes['price'] = $value;
    }

    public function getServicesAttribute(){
    	return $this->attributes['services'];
    }

    public function setServicesAttribute($value){
    	$this->attributes['services'] = $value;
    }

    public function getAdditionalsAttribute(){
    	return $this->attributes['additionals'];
    }

    public function setAdditionalsAttribute($value){
    	$this->attributes['additionals'] = $value;
    }

}
