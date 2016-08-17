<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    protected $table = 'tblBlock';
    protected $primaryKey = 'intBlockId';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    protected $fillable = [
      'intBlockNo', 'intUnitTypeIdFK', 'intRoomIdFK'
    ];

    public function getRowAttribute(){
    	return $this->attributes['row'];
    }

    public function setRowAttribute($value){
    	$this->attributes['row'] 		=	$value;
    }

    public function getColumnAttribute(){
    	return $this->attributes['column'];
    }

    public function setColumnAttribute($value){
    	$this->attributes['column'] 		=	$value;
    }
}
