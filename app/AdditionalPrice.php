<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalPrice extends Model
{
    protected $table = 'tblAdditionalPrice';
    protected $primaryKey = 'intAdditionalPriceId';

    public function additional(){
    	return $this->belongsTo('App\Additional', 'intAdditionalIdFK');
    }

}
