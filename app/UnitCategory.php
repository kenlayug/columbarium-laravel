<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitCategory extends Model
{
    protected $table = 'tblUnitCategory';
    protected $primaryKey = 'intUnitCategoryId';

    public function unitCategoryPrices(){
    	return $this->hasMany('App\UnitCategoryPrice', 'intUnitCategoryIdFK');
    }
}
