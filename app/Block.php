<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    protected $table = 'tblBlock';
    protected $primaryKey = 'intBlockId';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
