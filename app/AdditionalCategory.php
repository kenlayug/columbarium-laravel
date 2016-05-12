<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalCategory extends Model
{
    protected $table = 'tblAdditionalCategory';
    protected $primaryKey = 'intAdditionalCategoryId';

    public function additionals(){
    	return $this->hasMany('App\Additional', 'intAdditionalCategoryId');
    }
}
