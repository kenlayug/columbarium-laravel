<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FloorDetail extends Model
{
    protected $table = 'tblFloorDetail';
    protected $primaryKey = 'intFloorDetailId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function floor(){
    	return $this->belongsTo('App\Floor', 'intFloorIdFK');
    }
}
