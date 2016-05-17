<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitCategoryPrice extends Model
{
    protected $table = 'tblUnitCategoryPrice';
    protected $primaryKey = 'intUnitCategoryPrice';

    public function unitCategory(){
    	return $this->belongsTo('App\UnitCategory', 'intUnitCategoryIdFK');
    }
}
