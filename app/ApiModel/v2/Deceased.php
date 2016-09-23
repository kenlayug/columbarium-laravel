<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deceased extends Model
{
    protected $table        =   'tblDeceased';
    protected $primaryKey   =   'intDeceasedId';
    protected $fillable     =   [
        'strFirstName',
        'strMiddleName',
        'strLastName',
        'dateDeath',
        'dateBirth',
        'intRelationshipIdFK',
        'intCustomerIdFK',
        'intGender'
    ];
    use SoftDeletes;
    protected $dates        =   ['deleted_at'];

    public function getFullNameAttribute(){

        return $this->attributes['strFullName'];

    }

    public function setFullNameAttribute($value){

        $this->attributes['strFullName']    =   $value;

    }

}
