<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagePrice extends Model
{
    protected $table = 'tblPackagePrice';
    protected $primaryKey = 'intPackagePriceId';

    public function package(){
    	return $this->belongsTo('App\Package', 'intPackageIdFK');
    }
}
