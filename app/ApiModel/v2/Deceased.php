<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class Deceased extends Model
{
    protected $table        =   'tblDeceased';
    protected $primaryKey   =   'intDeceasedId';
    protected $fillable     =   [
        'strFirstName',
        'strMiddleName',
        'strLastName',
        'dateDeath',
        'intRelationshipIdFK',
        'intCustomerIdFK'
    ];

    public function getFullNameAttribute(){

        return $this->attributes['strFullName'];

    }

    public function setFullNameAttribute($value){

        $this->attributes['strFullName']    =   $value;

    }

}
