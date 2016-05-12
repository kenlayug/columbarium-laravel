<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    protected $table = 'tblRequirement';
    protected $primaryKey = 'intRequirementId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
