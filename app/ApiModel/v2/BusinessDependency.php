<?php

namespace App\ApiModel\v2;

use Illuminate\Database\Eloquent\Model;

class BusinessDependency extends Model
{
    protected $table        =   'tblBusinessDependency';
    protected $primaryKey   =   'intBusinessDependencyId';

    protected $fillable     =   [
        'strBusinessDependencyName', 'deciBusinessDependencyValue'
    ];
}
