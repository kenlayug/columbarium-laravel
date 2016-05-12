<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequirement extends Model
{
    protected $table = 'tblServiceRequirement';
    protected $primaryKey = 'intServiceRequirementId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
