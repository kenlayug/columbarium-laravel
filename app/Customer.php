<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $table = 'tblCustomer';
    protected $primaryKey = 'intCustomerId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function setFullNameAttribute($value){
        $this->attributes['strFullName'] = $value;
    }
}
