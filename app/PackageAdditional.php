<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageAdditional extends Model
{
    protected $table = 'tblPackageAdditional';
    protected $primaryKey = 'intPackageAdditionalId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function package(){
    	return $this->belongsTo('App\Package', 'intPackageIdFK');
    }

    public function getAdditionalAttribute(){
    	return $this->attributes['additional'];
    }

    public function setAdditionalAttribute($value){
    	$this->attributes['additional'] = $value;
    }
}
