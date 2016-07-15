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
        'intRelationshipIdFK'
    ];
}
