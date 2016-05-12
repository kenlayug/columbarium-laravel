<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequirement extends Model
{
    protected $table = 'tblServiceRequirement';
    protected $primaryKey = 'intServiceRequirementId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function getRequirementAttribute(){
    	return $this->attributes['requirement'];
    }

    public function setRequirementAttribute($value){
    	$this->attributes['requirement'] = $value;
    }
}
