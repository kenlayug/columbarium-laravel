<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table        =   'tblRelationship';
    protected $primaryKey   =   'intRelationshipId';
    protected $fillable     =   [
        'strRelationshipName'
    ];
}
