<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageService extends Model
{
    protected $table = 'tblPackageService';
    protected $primaryKey = 'intPackageServiceId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function package(){
    	return $this->belongsTo('App\Package', 'intPackageId', 'intPackageIdFK');
    }
}
