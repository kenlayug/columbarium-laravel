<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitCategoryPrice extends Model
{
    protected $table = 'tblUnitCategoryPrice';
    protected $primaryKey = 'intUnitCategoryPriceId';

    protected $fillable = [
        'deciPrice', 'intUnitCategoryIdFK'
    ];

    public function unitCategory(){
    	return $this->belongsTo('App\UnitCategory', 'intUnitCategoryIdFK');
    }
}
